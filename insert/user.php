<?php 
    session_start();
    require_once '../controller/UserController.php';

    if(isset($_POST['submit'])) {
        $errors = register($_POST);

        if(is_numeric($errors)) {
            if($errors > 0) {
                $_SESSION["berhasil"] = "Data User Berhasil Ditambah!";
                echo "
                    <script>
                        document.location.href='../admin/user.php';
                    </script>
                ";
            } else {
                $_SESSION["gagal"] = "Data User Gagal Ditambah!";
                echo "
                    <script>
                        document.location.href='../admin/user.php';
                    </script>
                ";
            }
        }
    }
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <title>Sistem Informasi Inventory Barang</title>

    <!-- css -->
    <link rel="stylesheet" href="../style.css">

    <!-- logo -->
    <link rel="Icon" href="">
</head>

<body>
    <div class="content">
        <!-- navbar -->
        <?php
        require_once('../navbar/navbar.php');
        ?>
        <!-- navbar selesai -->

        <div class="main-container m-0">
            <div class="d-flex">
                <!-- sidebar -->
                <?php
                require_once('../navbar/sidebar.php');
                ?>
                <!-- sidebar selesai -->

                <!-- konten -->
                <div class="contents px-3 py-3">
                    <div class="box1">
                        <h5 class="text-dark text-center mb-0 ms-4 fw-bold">
                            Manajemen Data User
                        </h5>
                    </div>


                    <form method="post" action="" enctype="multipart/form-data">
                        <input type="hidden" name="dari" value="tambah_user">

                        <div class="mb-3 mt-4 row ms-5">
                            <label for="username" class="col-sm-3 me-0 col-form-label">Username :</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control <?= isset($errors['username']) ? 'is-invalid' : ''; ?>" id="username" name="username" value="<?= isset($_POST['username']) ? $_POST['username'] : ''; ?>">
                                <?php if(isset($errors['username'])) : ?>
                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                        <?= $errors['username']; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="mb-3 mt-3 row ms-5">
                            <label for="password" class="col-sm-3 me-0 col-form-label">Password :</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control <?= isset($errors['password']) ? 'is-invalid' : ''; ?>" id="password" name="password">
                                <?php if(isset($errors['password'])) : ?>
                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                        <?= $errors['password']; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        <div class="mb-3 mt-3 row ms-5">
                            <label for="password2" class="col-sm-3 me-0 col-form-label">Konfirmasi Password :</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control " id="password2" name="password2" >
                            </div>
                        </div>

                        <div class="mb-3 mt-3 row ms-5">
                            <label for="nama" class="col-sm-3 me-0 col-form-label">Nama Lengkap:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control <?= isset($errors['nama']) ? 'is-invalid' : ''; ?>" id="nama" name="nama" value="<?= isset($_POST['nama']) ? $_POST['nama'] : ''; ?>">
                                <?php if(isset($errors['nama'])) : ?>
                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                        <?= $errors['nama']; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="mb-3 mt-3 row ms-5">
                            <label for="email" class="col-sm-3 me-0 col-form-label">Email :</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control <?= isset($errors['email']) ? 'is-invalid' : ''; ?>" id="email" name="email" value="<?= isset($_POST['email']) ? $_POST['email'] : ''; ?>">
                                <?php if(isset($errors['email'])) : ?>
                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                        <?= $errors['email']; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="mb-3 mt-3 row ms-5">
                            <label for="telepon" class="col-sm-3 me-0 col-form-label">No Handphone :</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control <?= isset($errors['telepon']) ? 'is-invalid' : ''; ?>" id="telepon" name="telepon" value="<?= isset($_POST['telepon']) ? $_POST['telepon'] : ''; ?>">
                                <?php if(isset($errors['telepon'])) : ?>
                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                        <?= $errors['telepon']; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="mb-3 mt-3 row ms-5">
                            <label for="alamat" class="col-sm-3 me-0 col-form-label">Alamat :</label>
                            <div class="col-sm-8">
                                <textarea <?= isset($errors['alamat']) ? '' : 'style="border: 1px solid black;"'; ?> class="form-control <?= isset($errors['alamat']) ? 'is-invalid' : ''; ?>" id="alamat" name="alamat" rows="2"><?= isset($_POST['alamat']) ? $_POST['alamat'] : ''; ?></textarea>
                                <?php if(isset($errors['alamat'])) : ?>
                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                        <?= $errors['alamat']; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        <div class="mb-3 mt-3 row ms-5">
                            <label for="instansi" class="col-sm-3 me-0 col-form-label">Instansi :</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control <?= isset($errors['instansi']) ? 'is-invalid' : ''; ?>" id="instansi" name="instansi" value="<?= isset($_POST['instansi']) ? $_POST['instansi'] : ''; ?>">
                                <?php if(isset($errors['instansi'])) : ?>
                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                        <?= $errors['instansi']; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="mb-4 mt-2 row ms-5">
                            <label for="foto" class="col-form-label">Foto Profil</label>
                            <div class="col-sm-3">
                                <img src="../img/profil/default.png" class="img-preview" style="width: 70px;">
                            </div>
                            <div class="col-sm-8">
                                <div class="input-group mb-3">
                                    <input type="file" class="form-control <?= isset($errors['foto']) ? 'is-invalid' : ''; ?>" <?= isset($errors['foto']) ? '' : 'style="border: 1px solid black;"'; ?> id="foto" name="foto" onchange="previewImg()">
                                    <?php if(isset($errors['foto'])) : ?>
                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                        <?= $errors['foto']; ?>
                                    </div>
                                <?php endif; ?>
                                </div>
                                <label for="foto" class="foto">*kosongkan jika tidak ingin mengganti foto</label>
                            </div>
                        </div>
                        <div class="mb-3 mt-2 row ms-5">
                            <label for="hp" class="col-sm-3 me-0 col-form-label">Level</label>
                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col-sm-3 form-check">
                                        <input class="form-check-input" style="border: 1px solid black;" type="radio"
                                            name="level" id="admin" value="Admin" checked>
                                        <label class="form-check-label" for="admin">
                                            Admin
                                        </label>
                                    </div>
                                    <div class="col-sm-3 form-check">
                                        <input class="form-check-input" style="border: 1px solid black;" type="radio"
                                            name="level" id="manajer" value="Manajer" >
                                        <label class="form-check-label" for="manajer">
                                            Manajer
                                        </label>
                                    </div>
                                    <div class="col-sm-3 form-check">
                                        <input class="form-check-input" style="border: 1px solid black;" type="radio"
                                            name="level" id="User" value="User" >
                                        <label class="form-check-label" for="User">
                                            Pelanggan
                                        </label>
                                    </div>
                                    <div class="col-sm-3 form-check">
                                        <input class="form-check-input" style="border: 1px solid black;" type="radio"
                                            name="level" id="Pemasok" value="Pemasok" >
                                        <label class="form-check-label" for="Pemasok">
                                            Pemasok
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="d-flex justify-content-end me-5">
                            <a class="btn btn-secondary mt-3 px-4 me-3" style="border-radius: 15px;"
                                href="../admin/user.php">Kembali</a>
                            <button type="submit" class="btn btn-primary mt-3 px-4"
                                style="border-radius: 15px;" name="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- konten selesai -->

        </div>


    </div>

    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>

    <script>
      function previewImg() {
        const sampul = document.querySelector('#foto');
        const imgPreview = document.querySelector('.img-preview');

        const fileSampul = new FileReader();
        fileSampul.readAsDataURL(sampul.files[0]);

        fileSampul.onload = function(e) {
          imgPreview.src = e.target.result;
        }
      }
    </script>
</body>

</html>