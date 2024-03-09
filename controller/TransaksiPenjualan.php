<?php 
    require_once 'MainController.php';

    function validation($data) {
        $errors = [];
        $data_barang = query("SELECT * FROM barang");
        $data_kosong = 0;

        foreach($data_barang as $barang) {
            $kode_input = "barang_" . $barang['idbarang'];

            if($data[$kode_input] == 0) {
                $data_kosong++;
            } elseif($data[$kode_input] > $barang['stok']) {
                $errors[$kode_input] = "Barang " . $barang['nama_barang'] . " tidak memiliki stok yang cukup, stok yang tersedia hanya " . $barang['stok'] . " " . $barang['satuan'];
            } elseif(!is_numeric($data[$kode_input])) {
                $errors[$kode_input] = "Kolom harus diisi angka!";
            }
        }

        if($data_kosong == count($data_barang)) {
            $errors['kosong'] = "Mohon isi minimal salah satu bahan!";
        }

        return $errors;

    }

    function create($data) {
        global $conn;
        $errors = validation($data);

        if(count($errors) > 0) {
            return $errors;

        } else {
            $kode_transaksi = $data['kode_transaksi'];
            $idpelanggan = $data['idpelanggan'];
            $dari = $data['dari'];

            $berhasil = 0;

            if($dari != "") {
                $id = dekripsi($dari);
                $data_transaksi = query("SELECT * FROM transaksi_penjualan WHERE idtransaksi = '$id'")[0];
                $berhasil++;
            } else {
                try {
                    mysqli_query($conn, "INSERT INTO transaksi_penjualan VALUES (NULL, CURRENT_TIMESTAMP(), '$kode_transaksi', 'Belum Diproses', '$idpelanggan')");
    
                    $berhasil++;
                } catch (\Throwable $th) {
    
                }
    
                $data_transaksi = query("SELECT * FROM transaksi_penjualan WHERE kode_transaksi = '$kode_transaksi'")[0];
            }
            $data_barang = query("SELECT * FROM barang");

            $idtransaksi = $data_transaksi['idtransaksi'];

            foreach($data_barang as $barang) {
                $kode_input = "barang_" . $barang['idbarang'];
                $qty = $data[$kode_input];
                $idbarang = $barang['idbarang'];

                $stok = $barang['stok'] - $qty;

                if($qty != 0) {
                    $cek_data = query("SELECT * FROM barang_keluar WHERE idtransaksi = '$idtransaksi' AND idbarang = '$idbarang'");

                    if(count($cek_data) > 0) {
                        $stok_akhir = $cek_data[0]['qty'] + $qty;
                        try {
                            mysqli_query($conn, "UPDATE barang_keluar SET qty = '$stok_akhir' WHERE idtransaksi = '$idtransaksi' AND idbarang = '$idbarang'");
                            mysqli_query($conn, "UPDATE barang SET stok = '$stok' WHERE idbarang = '$idbarang'");
                            $berhasil++;
                        } catch (\Throwable $th) {
                            
                        }
                    } else {
                        try {
                            mysqli_query($conn, "INSERT INTO barang_keluar VALUES (NULL, NULL, NULL, '$qty', '$idbarang', '$idtransaksi')");
                            mysqli_query($conn, "UPDATE barang SET stok = '$stok' WHERE idbarang = '$idbarang'");
                            $berhasil++;
                        } catch (\Throwable $th) {
                            
                        }
                    }
                } 
            }

            return $berhasil;
        }
    }

    function update_status($data) {
        global $conn;

        $idtransaksi = $data['idtransaksi'];
        $status = $data['status'];

        if($status == "Selesai") {
            $transaksi = query("SELECT * FROM transaksi_penjualan WHERE idtransaksi = '$idtransaksi'")[0];

            try {
                mysqli_query($conn, "UPDATE transaksi_penjualan SET status = '$status' WHERE idtransaksi = '$idtransaksi'");
                mysqli_query($conn, "UPDATE barang_keluar SET tgl_keluar = CURRENT_TIMESTAMP() WHERE idtransaksi = '$idtransaksi'");

                return 1;
            } catch (\Throwable $th) {
                //throw $th;
            }
        } else {
            mysqli_query($conn, "UPDATE transaksi_penjualan SET status = '$status' WHERE idtransaksi = '$idtransaksi'");
            return mysqli_affected_rows($conn);
        }

    }

    function update($data) {
        global $conn;

        $errors = [];

        $idkeluar = $data['idkeluar'];
        $idbarang = $data['idbarang'];
        $oldqty = $data['oldqty'];
        $qty = htmlspecialchars($data['qty']);

        $barang = query("SELECT * FROM barang WHERE idbarang = '$idbarang'")[0];
        $oldstok = $oldqty + $barang['stok'];

        $berhasil = 0;

        if($qty == 0) {
            $errors['qty'];
        } elseif($qty > $oldstok) {
            $errors['qty'] = "Barang " . $barang['nama_barang'] . " tidak memiliki stok yang cukup, stok yang tersedia hanya " . $oldstok . " " . $barang['satuan'];
        } elseif(!is_numeric($qty)) {
            $errors['qty'] = "Kolom harus diisi angka!";
        }

        if(count($errors) > 0) {
            return $errors;

        } else {
            try {
                mysqli_query($conn, "UPDATE barang_keluar SET qty = '$qty' WHERE idkeluar = '$idkeluar'");
                $berhasil++;
            } catch (\Throwable $th) {
            
            }
            $stok_now = $oldstok - $qty;

            try {
                mysqli_query($conn, "UPDATE barang SET stok = '$stok_now' WHERE idbarang = '$idbarang'");
                $berhasil++;
            } catch (\Throwable $th) {
            
            }

            return $berhasil;
        }
    }

    function delete($data) {
        global $conn;

        $idkeluar = $data['idkeluar'];
        $idbarang = $data['idbarang'];
        $qty = $data['qty'];

        $berhasil = 0;

        try {
            mysqli_query($conn, "DELETE FROM barang_keluar WHERE idkeluar = '$idkeluar'");
            $berhasil++;
        } catch (\Throwable $th) {
            //throw $th;
        }

        try {
            $bahan = query("SELECT * FROM barang WHERE idbarang = '$idbarang'")[0];
            $stok = $bahan['stok'];

            $stok_now = $stok + $qty;

            mysqli_query($conn, "UPDATE barang SET stok = '$stok_now' WHERE idbarang = '$idbarang'");
            $berhasil++;
        } catch (\Throwable $th) {
            //throw $th;
        }

        return $berhasil;
    }
?>