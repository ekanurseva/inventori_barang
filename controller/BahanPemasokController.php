<?php 
    require_once 'MainController.php';

    function validation($data) {
        $errors = [];

        $nama_bahan = htmlspecialchars($data['nama_bahan']);
        $stok = htmlspecialchars($data['stok']);
        $satuan = htmlspecialchars($data['satuan']);
        $harga = htmlspecialchars($data['harga']);

        if($nama_bahan == "") {
            $errors['nama_bahan'] = "Nama barang harus diisi!";
        } else {
            if(isset($data['oldnama_bahan'])) {
                if($data['oldnama_bahan'] != $nama_bahan) {
                    $cari_data = query("SELECT nama_bahan FROM bahan_pemasok WHERE nama_bahan = '$nama_bahan'");

                    if(count($cari_data) > 0) {
                        $errors['nama_bahan'] = "Nama barang sudah dipakai!";
                    }
                } 
            } else {
                $cari_data = query("SELECT nama_bahan FROM bahan_pemasok WHERE nama_bahan = '$nama_bahan'");

                if(count($cari_data) > 0) {
                    $errors['nama_bahan'] = "Nama barang sudah dipakai!";
                }
            }
            
        }

        if($stok == "") {
            $errors['stok'] = "Stok harus diisi!";
        } elseif(!is_numeric($stok)) {
            $errors['stok'] = "Stok harus diisi angka!";
        }
        
        if($satuan == "") {
            $errors['satuan'] = "Satuan harus diisi!";
        }

        if($harga == "") {
            $errors['harga'] = "Harga harus diisi!";
        } elseif(!is_numeric($harga)) {
            $errors['harga'] = "Harga harus diisi angka!";
        }

        return $errors;
    }

    function create($data) {
        global $conn;
        $errors = validation($data);

        if(count($errors) > 0) {
            return $errors;
        } else {
            $idpemasok = htmlspecialchars($data['idpemasok']);
            $nama_bahan = htmlspecialchars($data['nama_bahan']);
            $stok = htmlspecialchars($data['stok']);
            $satuan = htmlspecialchars($data['satuan']);
            $harga = htmlspecialchars($data['harga']);

            mysqli_query($conn, "INSERT INTO bahan_pemasok VALUES (NULL, '$idpemasok', '$nama_bahan', '$stok', '$satuan', '$harga')");

            return mysqli_affected_rows($conn);
        }
    }

    function update($data) {
        global $conn;
        $errors = validation($data);

        if(count($errors) > 0) {
            return $errors;
        } else {
            $idbahan = htmlspecialchars($data['idbahan']);
            $nama_bahan = htmlspecialchars($data['nama_bahan']);
            $stok = htmlspecialchars($data['stok']);
            $satuan = htmlspecialchars($data['satuan']);
            $harga = htmlspecialchars($data['harga']);

            $query = "UPDATE bahan_pemasok SET
                        nama_bahan = '$nama_bahan',
                        stok = '$stok',
                        satuan = '$satuan',
                        harga = '$harga'
                      WHERE idbahan = '$idbahan'
                    ";
            
            mysqli_query($conn, $query);

            return mysqli_affected_rows($conn);
        }
    }

    function delete($data) {
        global $conn;

        $idbahan = $data['idbahan'];

        mysqli_query($conn, "DELETE FROM bahan_pemasok WHERE idbahan = $idbahan");

        return mysqli_affected_rows($conn);
    }
?>