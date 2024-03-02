<?php 
    session_start();
    require_once 'controller/UserController.php';

    if(isset($_POST['submit'])) {
        $errors = register($_POST);
        
        if(is_numeric($errors)) {
            if($errors > 0) {
                $_SESSION["berhasil"] = "Registrasi Berhasil!";
                echo "
                    <script>
                        document.location.href='login.php';
                    </script>
                ";
            } else {
                $_SESSION["gagal"] = "Registrasi Gagal!";
                echo "
                    <script>
                        document.location.href='login.php';
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

    <!-- bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- font -->
    <link href="https://fonts.googleapis.com/css2?family=Chakra+Petch:wght@400;500&display=swap" rel="stylesheet">

    <title>Sistem Informasi Inventory Barang</title>

    <!-- css -->
    <link rel="stylesheet" href="style.css">

    <!-- logo -->
    <link rel="Icon" href="">
</head>

<body>
    <div class="content d-flex justify-content-center">
        <div class="d-flex align-items-center">
            <div class="box1 container-sm" style="width: 550px; padding: 25px; background: #192a80;">
                <h4 class="text-white">Registrasi</h4>
                <hr class="mb-5" style="color: white; opacity: 1;">
                
                <form method="post" action="" enctype="multipart/form-data">
                    <input type="hidden" name="level" id="" value="User">
                    <input type="hidden" name="instansi" id="" value="">
                    <input type="hidden" name="dari" id="" value="register">
                    <div class="mb-3">
                        <input type="text" class="form-control <?= isset($errors['username']) ? 'is-invalid' : ''; ?>" placeholder="Username" name="username" value="<?= isset($_POST['username']) ? $_POST['username'] : ""; ?>">
                        <?php if(isset($errors['username'])) : ?>
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= $errors['username']; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="mb-3">
                        <input type="password" class="form-control <?= isset($errors['password']) ? 'is-invalid' : ''; ?>" placeholder="Password" name="password">
                        <?php if(isset($errors['password'])) : ?>
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= $errors['password']; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="mb-3">
                        <input type="password" class="form-control" placeholder="Konfirmasi Password" name="password2">
                    </div>

                    <div class="mb-3">
                        <input type="text" class="form-control <?= isset($errors['nama']) ? 'is-invalid' : ''; ?>" placeholder="Nama" name="nama" value="<?= isset($_POST['nama']) ? $_POST['nama'] : ""; ?>">
                        <?php if(isset($errors['nama'])) : ?>
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= $errors['nama']; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="mb-3">
                        <input type="email" class="form-control <?= isset($errors['email']) ? 'is-invalid' : ''; ?>" placeholder="Email" name="email" value="<?= isset($_POST['email']) ? $_POST['email'] : ""; ?>">
                        <?php if(isset($errors['email'])) : ?>
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= $errors['email']; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="mb-3">
                        <input type="number" class="form-control <?= isset($errors['telepon']) ? 'is-invalid' : ''; ?>" placeholder="No Telepon" name="telepon" value="<?= isset($_POST['telepon']) ? $_POST['telepon'] : ""; ?>">
                        <?php if(isset($errors['telepon'])) : ?>
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= $errors['telepon']; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="mb-3">
                        <textarea class="form-control <?= isset($errors['alamat']) ? 'is-invalid' : ''; ?>" id="exampleFormControlTextarea1" rows="3" name="alamat" placeholder="Alamat"><?= isset($_POST['alamat']) ? $_POST['alamat'] : ""; ?></textarea>
                        <?php if(isset($errors['alamat'])) : ?>
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= $errors['alamat']; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="mb-3">
                        <label for="formFileSm" class="form-label text-white">Foto Profil</label>
                        <input class="form-control form-control-sm <?= isset($errors['foto']) ? 'is-invalid' : ''; ?>" id="formFileSm" type="file" name="foto">
                        <?php if(isset($errors['foto'])) : ?>
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= $errors['foto']; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <button type="submit" class="btn btn-light mt-3 px-4" style="border-radius: 15px;" name="submit">Submit</button>
                    <div class="mt-3">
                        <a class="text-white" href="login.php">Login</a>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
</body>

</html>