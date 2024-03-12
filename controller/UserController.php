<?php
require_once 'MainController.php';

function uploadFoto($dari)
{
    $namaFile = $_FILES['foto']['name'];
    $tmpName = $_FILES['foto']['tmp_name'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    //generate nama gambar baru
    if ($namaFile != "") {
        $namaFileBaru = uniqid();
        $namaFileBaru .= '.';
        $namaFileBaru .= $ekstensiGambar;
        //parameternya file namenya, lalu tujuannya
        if ($dari == "register") {
            move_uploaded_file($tmpName, 'img/profil/' . $namaFileBaru);
        } else {
            move_uploaded_file($tmpName, '../img/profil/' . $namaFileBaru);
        }

        return $namaFileBaru;
    }
}

function validation($data)
{
    $errors = [];

    $username = htmlspecialchars($data['username']);
    $password = htmlspecialchars($data['password']);
    $password2 = htmlspecialchars($data['password2']);
    $nama = htmlspecialchars($data['nama']);
    $email = htmlspecialchars($data['email']);
    $telepon = htmlspecialchars($data['telepon']);
    $alamat = htmlspecialchars($data['alamat']);
    $instansi = htmlspecialchars($data['instansi']);
    $level = htmlspecialchars($data['level']);
    $namaFile = $_FILES['foto']['name'];

    if ($username == "") {
        $errors['username'] = "Username harus diisi!";
    } else {
        if (isset($data['oldusername'])) {
            if ($data['oldusername'] != $username) {
                $cari_user = query("SELECT username FROM user WHERE username = '$username'");

                if (count($cari_user) > 0) {
                    $errors['username'] = "Username sudah dipakai!";
                }
            }
        } else {
            $cari_user = query("SELECT username FROM user WHERE username = '$username'");

            if (count($cari_user) > 0) {
                $errors['username'] = "Username sudah dipakai!";
            }
        }
    }

    if ($password == "" || $password2 == "") {
        $errors['password'] = "Password dan konfirmasi password harus diisi!";
    } elseif (strlen($password) < 8 || strlen($password2) < 8) {
        $errors['password'] = "Password minimal 8 karakter!";
    } elseif ($password != $password2) {
        $errors['password'] = "Password dan konfirmasi password harus sama!";
    }

    if ($email == "") {
        $errors['email'] = "Email harus diisi!";
    } else {
        if (isset($data['oldemail'])) {
            if ($data['email'] != $email) {
                $cari_user = query("SELECT email FROM user WHERE email = '$email'");

                if (count($cari_user) > 0) {
                    $errors['email'] = "Email sudah dipakai!";
                }
            }
        } else {
            $cari_user = query("SELECT email FROM user WHERE email = '$email'");

            if (count($cari_user) > 0) {
                $errors['email'] = "Email sudah dipakai!";
            }
        }
    }

    if ($nama == "") {
        $errors['nama'] = "Nama harus diisi!";
    }

    if ($telepon == "") {
        $errors['telepon'] = "Telepon harus diisi!";
    }

    if ($alamat == "") {
        $errors['alamat'] = "Alamat harus diisi!";
    }

    if ($level == "Pemasok") {
        if ($instansi == "") {
            $errors['instansi'] = "Jika level adalah Pemasok maka instansi harus diisi!";
        }
    }

    if ($level == "") {
        $errors['level'] = "Level harus diisi!";
    }

    if ($namaFile != "") {
        $ukuranFile = $_FILES['foto']['size'];

        $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
        $ekstensiGambar = explode('.', $namaFile);
        $ekstensiGambar = strtolower(end($ekstensiGambar));

        //cek apakah ekstensinya ada atau tidak di dalam array $ekstensiGambarValid
        if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
            $errors['foto'] = "Foto harus berekstensi .jgp, .jpeg, atau .png!";
        } elseif ($ukuranFile > 5000000) {
            $errors['foto'] = "Ukuran foto maksimal 5MB!";
        }

    }

    return $errors;
}

function register($data)
{
    global $conn;
    $errors = validation($data);

    if (count($errors) > 0) {
        return $errors;
    } else {
        $username = htmlspecialchars($data['username']);
        $password = htmlspecialchars($data['password']);
        $password2 = htmlspecialchars($data['password2']);
        $nama = htmlspecialchars($data['nama']);
        $email = htmlspecialchars($data['email']);
        $telepon = htmlspecialchars($data['telepon']);
        $alamat = htmlspecialchars($data['alamat']);
        $level = htmlspecialchars($data['level']);
        $namaFile = $_FILES['foto']['name'];

        if ($namaFile != "") {
            $foto = uploadFoto($data['dari']);
        } else {
            $foto = "default.png";
        }

        if ($data['instansi'] == "") {
            $instansi = NULL;
        } else {
            $instansi = htmlspecialchars($data['instansi']);
        }

        $password = password_hash($password2, PASSWORD_DEFAULT);

        mysqli_query($conn, "INSERT INTO user VALUES (NULL, '$username', '$password', '$nama', '$email', '$telepon', '$alamat', '$instansi', '$level', '$foto')");
        return mysqli_affected_rows($conn);
    }
}

function login($data)
{
    $username = htmlspecialchars($data["username"]);
    $password = htmlspecialchars($data["password"]);

    $result = query("SELECT * FROM user WHERE username = '$username'");

    if (count($result) == 1) {
        if (password_verify($password, $result[0]["password"])) {

            $enkripsi = enkripsi($result[0]['iduser']);

            setcookie('SIIB', $enkripsi, time() + 10800);

            if ($result[0]['level'] == "User") {
                echo "<script>
                            document.location.href='pelanggan/index.php';
                        </script>";
            } elseif ($result[0]['level'] == "Admin") {
                echo "<script>
                            document.location.href='admin/index.php';
                        </script>";
            } elseif ($result[0]['level'] == "Pemasok") {
                echo "<script>
                            document.location.href='pemasok/index.php';
                        </script>";
            } elseif ($result[0]['level'] == "Manajer") {
                echo "<script>
                            document.location.href='manajer/index.php';
                        </script>";
            }

            exit;
        }
    }

    $error = true;

    return $error;
}

function update($data)
{
    global $conn;
    $errors = validation($data);

    if (count($errors) > 0) {
        return $errors;
    } else {
        $iduser = $data['iduser'];
        $username = htmlspecialchars($data['username']);
        $oldpassword = htmlspecialchars($data['oldpassword']);
        $oldfoto = $data['oldfoto'];
        $password = htmlspecialchars($data['password']);
        $password2 = htmlspecialchars($data['password2']);
        $nama = htmlspecialchars($data['nama']);
        $email = htmlspecialchars($data['email']);
        $telepon = htmlspecialchars($data['telepon']);
        $alamat = htmlspecialchars($data['alamat']);
        $level = htmlspecialchars($data['level']);
        $namaFile = $_FILES['foto']['name'];

        if ($namaFile != "") {
            $foto = uploadFoto($data['dari']);

            if ($oldfoto != "default.png") {
                unlink("../img/profil/$oldfoto");
            }
        } else {
            $foto = $oldfoto;
            ;
        }

        if ($data['instansi'] == "") {
            $instansi = NULL;
        } else {
            $instansi = htmlspecialchars($data['instansi']);
        }

        if ($oldpassword != $password) {
            $password = password_hash($password2, PASSWORD_DEFAULT);
        }

        $query = "UPDATE user SET 
                    username = '$username',
                    password = '$password',
                    nama = '$nama',
                    email = '$email',
                    telepon = '$telepon',
                    alamat = '$alamat',
                    instansi = '$instansi',
                    level = '$level',
                    foto = '$foto'
                  WHERE iduser = '$iduser'
                ";
        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }
}

function delete_foto($data)
{
    global $conn;

    $iduser = $data['iduser'];
    $foto = $data['foto'];

    if ($foto != "default.png") {
        unlink("../img/profil/$foto");
    }

    $query = "UPDATE user SET 
                foto = 'default.png'
                WHERE iduser = '$iduser'
            ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function delete($data)
{
    global $conn;

    $iduser = $data['iduser'];
    $foto = $data['foto'];

    if ($foto != "default.png") {
        unlink("../img/profil/$foto");
    }

    mysqli_query($conn, "DELETE FROM user WHERE iduser = $iduser");

    return mysqli_affected_rows($conn);
}

function validation_pw($data)
{
    $errors = [];

    $password = htmlspecialchars($data['password']);
    $password2 = htmlspecialchars($data['password2']);

    if ($password == "" || $password2 == "") {
        $errors['password'] = "Password dan konfirmasi password harus diisi!";
    } elseif (strlen($password) < 8 || strlen($password2) < 8) {
        $errors['password'] = "Password minimal 8 karakter!";
    } elseif ($password != $password2) {
        $errors['password'] = "Password dan konfirmasi password harus sama!";
    }

    return $errors;
}

function update_password($data)
{
    global $conn;
    $errors = validation_pw($data);

    if (count($errors) > 0) {
        return $errors;
    } else {
        $iduser = $data['iduser'];
        $password = mysqli_real_escape_string($conn, $data["password"]);
        $password2 = mysqli_real_escape_string($conn, $data["password2"]);


        $password = password_hash($password2, PASSWORD_DEFAULT);

        $query = "UPDATE user SET 
                    password = '$password'
                WHERE iduser = '$iduser'
                ";
        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }
}
?>