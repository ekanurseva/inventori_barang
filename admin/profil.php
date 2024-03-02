<?php 
    session_start();
    require_once '../controller/UserController.php';

    if(isset($_POST['submit'])) {
        $errors = update($_POST);

        if(is_numeric($errors)) {
            if($errors > 0) {
                $_SESSION["berhasil"] = "Data User Berhasil Diubah!";
            } else {
                $_SESSION["gagal"] = "Data User Gagal Diubah!";
            }
        }
    }

    if(isset($_POST['hapus_foto'])) {
        if(delete_foto($_POST) > 0 ) {
            $_SESSION["berhasil"] = "Foto Berhasil Dihapus!";
        } else {
            $_SESSION["gagal"] = "Foto Gagal Dihapus!";
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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

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
                            Update Profil
                        </h5>
                    </div>

                    <?php if(isset($_SESSION['berhasil'])) : ?>
                        <div class="my-3">
                            <div class="alert alert-success" role="alert">
                                <?= $_SESSION['berhasil']; ?>
                            </div>
                        </div>
                    <?php elseif(isset($_SESSION['gagal'])) : ?>
                        <div class="my-3">
                            <div class="alert alert-danger" role="alert">
                                <?= $_SESSION['gagal']; ?>
                            </div>
                        </div>
                    <?php endif; ?>


                    <form method="post" action="" enctype="multipart/form-data">
                        <input type="hidden" name="iduser" value="<?= $user['iduser']; ?>">
                        <input type="hidden" name="instansi" value="<?= $user['instansi']; ?>">
                        <input type="hidden" name="level" value="<?= $user['level']; ?>">
                        <input type="hidden" name="oldusername" value="<?= $user['username']; ?>">
                        <input type="hidden" name="oldpassword" value="<?= $user['password']; ?>">
                        <input type="hidden" name="oldemail" value="<?= $user['email']; ?>">
                        <input type="hidden" name="dari" value="edit_user">
                        <input type="hidden" name="oldfoto" value="<?= $user['foto']; ?>">

                        <div class="mb-3 mt-4 row ms-5">
                            <label for="username" class="col-sm-3 me-0 col-form-label">Username :</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control <?= isset($errors['username']) ? 'is-invalid' : ''; ?>" id="username" name="username" value="<?= isset($_POST['username']) ? $_POST['username'] : $user['username']; ?>">
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
                                <input type="password" class="form-control<?= isset($errors['password']) ? 'is-invalid' : ''; ?>" id="password" name="password" value="<?= isset($_POST['password']) ? $_POST['password'] : $user['password']; ?>">
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
                                <input type="password" class="form-control " id="password2" name="password2" value="<?= $user['password']; ?>">
                            </div>
                        </div>

                        <div class="mb-3 mt-3 row ms-5">
                            <label for="nama" class="col-sm-3 me-0 col-form-label">Nama Lengkap:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control <?= isset($errors['nama']) ? 'is-invalid' : ''; ?>" id="nama" name="nama" value="<?= isset($_POST['nama']) ? $_POST['nama'] : $user['nama']; ?>">
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
                                <input type="email" class="form-control <?= isset($errors['email']) ? 'is-invalid' : ''; ?>" id="email" name="email" value="<?= isset($_POST['email']) ? $_POST['email'] : $user['email']; ?>">
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
                                <input type="text" class="form-control <?= isset($errors['telepon']) ? 'is-invalid' : ''; ?>" id="telepon" name="telepon" value="<?= isset($_POST['telepon']) ? $_POST['telepon'] : $user['telepon']; ?>">
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
                                <textarea class="form-control <?= isset($errors['alamat']) ? 'is-invalid' : ''; ?>" id="alamat" name="alamat" rows="2"><?= isset($_POST['alamat']) ? $_POST['alamat'] : $user['alamat']; ?></textarea>
                                <?php if(isset($errors['alamat'])) : ?>
                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                        <?= $errors['alamat']; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="mb-4 mt-2 row ms-5">
                            <label for="foto" class="col-form-label">Foto Profil</label>
                            <div class="col-sm-3">
                                <img src="../img/profil/<?= $user['foto']; ?>" class="img-preview" style="width: 70px;">
                            </div>
                            <div class="col-sm-8">
                                <?php if($user['foto'] != "default.png") : ?>
                                    <button type="button" class="btn btn-sm btn-outline-danger" id="delete" data-bs-toggle="modal" data-bs-target="#exampleModal">Hapus Foto</button>
                                <?php endif; ?>
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

                        <div class="d-flex justify-content-end me-5">
                            <a class="btn btn-secondary mt-3 px-4 me-3" style="border-radius: 15px;"
                                href="../admin/index.php">Kembali</a>
                            <button type="submit" class="btn btn-primary mt-3 px-4"
                                style="border-radius: 15px;" name="submit">Update</button>
                        </div>
                    </form>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Hapus Foto</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Yakin ingin menghapus foto?
                                </div>
                                <div class="modal-footer">
                                    <form action="" method="post">
                                        <input type="hidden" name="iduser" value="<?= $user['iduser']; ?>">
                                        <input type="hidden" name="foto" value="<?= $user['foto']; ?>">

                                        <button type="submit" class="btn btn-danger" name="hapus_foto">Hapus</button>
                                    </form>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                                </div>
                            </div>
                        </div>
                    </div>
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

    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
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

<?php 
    $_SESSION = [];
    session_unset();
    session_destroy();
?>