<?php
require_once 'controller/UserController.php';
setcookie('SIIB', '', time() - 3600);

if (isset($_GET['key'])) {
    $email = dekripsi($_GET['key']);

    $result = mysqli_query($conn, "SELECT email FROM user WHERE email = '$email'");

    if (!mysqli_fetch_assoc($result)) {
        $_SESSION["gagal"] = "Email tidak ditemukan";
        echo "
            <script>
                document.location.href='login.php';
            </script>";
        exit();
    } else {
        $data = query("SELECT * FROM user WHERE email = '$email'")[0];
    }
} else {
    echo "<script>
            document.location.href='login.php';
        </script>";
}

if (isset($_POST['submit'])) {
    $errors = update_password($_POST);

    if (is_numeric($errors)) {
        $_SESSION["berhasil"] = "Ubah Password Berhasil!";
        echo "
        <script>
          document.location.href='login.php';
        </script>
        ";
    } else {
        $_SESSION["gagal"] = "Ubah Password Gagal!";
        echo "
              <script>
                document.location.href='login.php';
              </script>
          ";
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
                <h4 class="text-white">Ubah Password</h4>
                <hr class="mb-5" style="color: white; opacity: 1;">
                <div class="m-5">
                    <form method="post" action="">
                        <input type="hidden" name="iduser" value="<?= $data['iduser']; ?>">

                        <div class="mb-3 fs-5">
                            <input type="text" class="form-control" name="nama" placeholder="Nama"
                                value="<?= $data['nama']; ?>" disabled>
                        </div>
                        <div class="mb-3 fs-5">
                            <input type="password"
                                class="form-control <?= isset($errors['password']) ? 'is-invalid' : ''; ?>"
                                placeholder="Password" name="password">
                            <?php if (isset($errors['password'])): ?>
                                <div id="validationServer03Feedback" class="invalid-feedback">
                                    <?= $errors['password']; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="mb-4 fs-5">
                            <input type="password" class="form-control" name="password2"
                                placeholder="Konfirmasi Password" id="password2">
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-light mt-3 px-4" style="border-radius: 15px;"
                                    name="submit">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
    <script src="bootstrap-5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>