<?php 
    require_once 'MainController.php';

    function validation($data) {
        $errors = [];
        $idpemasok = $data['idpemasok'];
        $data_bahan = query("SELECT * FROM bahan_pemasok WHERE idpemasok = '$idpemasok'");
        $data_kosong = 0;

        foreach($data_bahan as $bahan) {
            $kode_input = "bahan_" . $bahan['idbahan'];

            if($data[$kode_input] == 0) {
                $data_kosong++;
            } elseif($data[$kode_input] > $bahan['stok']) {
                $errors[$kode_input] = "Bahan " . $bahan['nama_bahan'] . " tidak memiliki stok yang cukup, stok yang tersedia hanya " . $bahan['stok'] . " " . $bahan['satuan'];
            } elseif(!is_numeric($data[$kode_input])) {
                $errors[$kode_input] = "Kolom harus diisi angka!";
            }
        }

        if($data_kosong == count($data_bahan)) {
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
            $idpemasok = $data['idpemasok'];
            $dari = $data['dari'];

            $berhasil = 0;

            if($dari != "") {
                $id = dekripsi($dari);
                $data_transaksi = query("SELECT * FROM transaksi_pembelian WHERE idtransaksi = '$id'")[0];
                $berhasil++;
            } else {
                try {
                    mysqli_query($conn, "INSERT INTO transaksi_pembelian VALUES (NULL, CURRENT_TIMESTAMP(), '$kode_transaksi', 'Belum Diproses', '$idpemasok')");
    
                    $berhasil++;
                } catch (\Throwable $th) {
    
                }
    
                $data_transaksi = query("SELECT * FROM transaksi_pembelian WHERE kode_transaksi = '$kode_transaksi'")[0];
            }
            $data_bahan = query("SELECT * FROM bahan_pemasok WHERE idpemasok = '$idpemasok'");
            $idtransaksi = $data_transaksi['idtransaksi'];

            foreach($data_bahan as $bahan) {
                $kode_input = "bahan_" . $bahan['idbahan'];
                $qty = $data[$kode_input];
                $idbahan = $bahan['idbahan'];

                $stok = $bahan['stok'] - $qty;

                if($qty != 0) {
                    $cek_data = query("SELECT * FROM barang_masuk WHERE idtransaksi = '$idtransaksi' AND idbahan = '$idbahan'");

                    if(count($cek_data) > 0) {
                        $stok_akhir = $cek_data[0]['qty'] + $qty;
                        try {
                            mysqli_query($conn, "UPDATE barang_masuk SET qty = '$stok_akhir' WHERE idtransaksi = '$idtransaksi' AND idbahan = '$idbahan'");
                            mysqli_query($conn, "UPDATE bahan_pemasok SET stok = '$stok' WHERE idbahan = '$idbahan'");
                            $berhasil++;
                        } catch (\Throwable $th) {
                            
                        }
                    } else {
                        try {
                            mysqli_query($conn, "INSERT INTO barang_masuk VALUES (NULL, NULL, NULL, NULL, '$qty', '$idtransaksi', '$idbahan')");
                            mysqli_query($conn, "UPDATE bahan_pemasok SET stok = '$stok' WHERE idbahan = '$idbahan'");
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
            $transaksi = query("SELECT * FROM transaksi_pembelian WHERE idtransaksi = '$idtransaksi'")[0];
            $no_bukti = $transaksi['kode_transaksi'];
            try {
                mysqli_query($conn, "UPDATE transaksi_pembelian SET status = '$status' WHERE idtransaksi = '$idtransaksi'");
                mysqli_query($conn, "UPDATE barang_masuk SET no_bukti = '$no_bukti', tgl_masuk = CURRENT_TIMESTAMP() WHERE idtransaksi = '$idtransaksi'");

                return 1;
            } catch (\Throwable $th) {
                //throw $th;
            }
        } else {
            mysqli_query($conn, "UPDATE transaksi_pembelian SET status = '$status' WHERE idtransaksi = '$idtransaksi'");
            return mysqli_affected_rows($conn);
        }

    }
?>