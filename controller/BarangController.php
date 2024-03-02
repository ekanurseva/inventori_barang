<?php 
    require_once 'MainController.php';

    function uploadFoto() {
        $namaFile = $_FILES['foto']['name'];
        $tmpName = $_FILES['foto']['tmp_name'];
        $ekstensiGambar = explode('.', $namaFile);
        $ekstensiGambar = strtolower(end($ekstensiGambar));

        if($namaFile != "") {
            $namaFileBaru = uniqid();
            $namaFileBaru .= '.';
            $namaFileBaru .= $ekstensiGambar;
            move_uploaded_file($tmpName, '../img/barang/'.$namaFileBaru);

            return $namaFileBaru;
        }
    }

    function validation($data) {
        $errors = [];

        $nama_barang = htmlspecialchars($data['nama_barang']);
        $kategori = htmlspecialchars($data['kategori']);
        $merk = htmlspecialchars($data['merk']);
        $gudang = htmlspecialchars($data['gudang']);
        $rak = htmlspecialchars($data['rak']);
        $stok = htmlspecialchars($data['stok']);
        $satuan = htmlspecialchars($data['satuan']);
        $harga = htmlspecialchars($data['harga']);
        $namaFile = $_FILES['foto']['name'];

        if($nama_barang == "") {
            $errors['nama_barang'] = "Nama barang harus diisi!";
        } else {
            if(isset($data['oldnama_barang'])) {
                if($data['oldnama_barang'] != $nama_barang) {
                    $cari_data = query("SELECT nama_barang FROM barang WHERE nama_barang = '$nama_barang'");

                    if(count($cari_data) > 0) {
                        $errors['nama_barang'] = "Nama barang sudah dipakai!";
                    }
                } 
            } else {
                $cari_data = query("SELECT nama_barang FROM barang WHERE nama_barang = '$nama_barang'");

                if(count($cari_data) > 0) {
                    $errors['nama_barang'] = "Nama barang sudah dipakai!";
                }
            }
            
        }

        if($kategori == "") {
            $errors['kategori'] = "Kategori harus diisi!";
        }

        if($merk == "") {
            $errors['merk'] = "Merk harus diisi!";
        }

        if($gudang == "") {
            $errors['gudang'] = "Gudang harus diisi!";
        }

        if($rak == "") {
            $errors['rak'] = "Rak harus diisi!";
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

        if($namaFile != "") {
            $ukuranFile = $_FILES ['foto']['size'];

            $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
            $ekstensiGambar = explode('.', $namaFile);
            $ekstensiGambar = strtolower(end($ekstensiGambar));
    
            if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
                $errors['foto'] = "Foto harus berekstensi .jgp, .jpeg, atau .png!";
            } elseif($ukuranFile > 5000000) {
                $errors['foto'] = "Ukuran foto maksimal 5MB!";    
            }
            
        }
        
        return $errors;
    }

    function create($data) {
        global $conn;
        $errors = validation($data);

        if(count($errors) > 0) {
            return $errors;
        } else {
            $nama_barang = htmlspecialchars($data['nama_barang']);
            $kategori = htmlspecialchars($data['kategori']);
            $merk = htmlspecialchars($data['merk']);
            $gudang = htmlspecialchars($data['gudang']);
            $rak = htmlspecialchars($data['rak']);
            $stok = htmlspecialchars($data['stok']);
            $satuan = htmlspecialchars($data['satuan']);
            $harga = htmlspecialchars($data['harga']);
            $keterangan = htmlspecialchars($data['keterangan']);
            $namaFile = $_FILES['foto']['name'];

            if($namaFile != "") {
                $foto = uploadFoto();
            } else {
                $foto = "default.png";
            }

            mysqli_query($conn, "INSERT INTO barang VALUES (NULL, '$nama_barang', '$kategori', '$merk', '$gudang', '$rak', '$stok', '$satuan', '$harga', '$foto', '$keterangan')");

            return mysqli_affected_rows($conn);
        }
    }
    
    function update($data) {
        global $conn;
        $errors = validation($data);

        if(count($errors) > 0) {
            return $errors;
        } else {
            $idbarang = $data['idbarang'];
            $oldfoto = $data['oldfoto'];
            $nama_barang = htmlspecialchars($data['nama_barang']);
            $kategori = htmlspecialchars($data['kategori']);
            $merk = htmlspecialchars($data['merk']);
            $gudang = htmlspecialchars($data['gudang']);
            $rak = htmlspecialchars($data['rak']);
            $stok = htmlspecialchars($data['stok']);
            $satuan = htmlspecialchars($data['satuan']);
            $harga = htmlspecialchars($data['harga']);
            $keterangan = htmlspecialchars($data['keterangan']);
            $namaFile = $_FILES['foto']['name'];

            if($namaFile != "") {
                $foto = uploadFoto();

                if($oldfoto != "default.png") {
                    unlink("../img/barang/$oldfoto");
                }
            } else {
                $foto = $oldfoto;;
            }

            $query = "UPDATE barang SET 
                    nama_barang = '$nama_barang',
                    kategori = '$kategori',
                    merk = '$merk',
                    gudang = '$gudang',
                    rak = '$rak',
                    stok = '$stok',
                    satuan = '$satuan',
                    harga = '$harga',
                    foto = '$foto',
                    keterangan = '$keterangan'
                  WHERE idbarang = '$idbarang'
                ";
            mysqli_query($conn, $query);

            return mysqli_affected_rows($conn);
        }
    }

    function delete_foto($data) {
        global $conn;

        $idbarang = $data['idbarang'];
        $foto = $data['foto'];

        if($foto != "default.png") {
            unlink("../img/barang/$foto");
        }

        $query = "UPDATE barang SET 
                foto = 'default.png'
                WHERE idbarang = '$idbarang'
            ";
        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }

    function delete($data) {
        global $conn;

        $idbarang = $data['idbarang'];
        $foto = $data['foto'];

        if($foto != "default.png") {
            unlink("../img/barang/$foto");
        }

        mysqli_query($conn, "DELETE FROM barang WHERE idbarang = $idbarang");

        return mysqli_affected_rows($conn);
    }
?>