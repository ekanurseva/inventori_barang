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
            $berhasil = 0;

            try {
                mysqli_query($conn, "INSERT INTO transaksi_pembelian VALUES (NULL, CURRENT_TIMESTAMP(), '$kode_transaksi', '$idpemasok')");

                $berhasil++;
            } catch (\Throwable $th) {

            }

            $data_bahan = query("SELECT * FROM bahan_pemasok WHERE idpemasok = '$idpemasok'");
            $data_transaksi = query("SELECT * FROM transaksi_pembelian WHERE kode_transaksi = '$kode_transaksi'")[0];
            $idtransaksi = $data_transaksi['idtransaksi'];

            foreach($data_bahan as $bahan) {
                $kode_input = "bahan_" . $bahan['idbahan'];
                $qty = $data[$kode_input];
                $idbahan = $bahan['idbahan'];

                if($qty != 0) {
                    try {
                        mysqli_query($conn, "INSERT INTO barang_masuk VALUES (NULL, NULL, NULL, NULL, '$qty', 'Belum Diproses', '$idtransaksi', '$idbahan')");
                        $berhasil++;
                    } catch (\Throwable $th) {
                        
                    }
                } 
            }

            return $berhasil;
        }
    }
?>