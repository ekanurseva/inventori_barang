<?php 
    require_once '../controller/BahanPemasokController.php';

    if(isset($_GET['id'])) {
        $id = dekripsi($_GET['id']);

        $data = query("SELECT * FROM bahan_pemasok WHERE idbahan = '$id'");

        if(count($data) == 0) {
            echo "<script>
                    document.location.href='../pemasok/barang.php';
                </script>";
            exit;    
        } else {
            $data = $data[0];
            
            if(isset($_POST['submit'])) {
                $errors = update($_POST);

                if(is_numeric($errors)) {
                    if($errors > 0) {
                        $_SESSION["berhasil"] = "Data Bahan Baku Berhasil Diubah!";
                    } else {
                        $_SESSION["gagal"] = "Data Bahan Baku Gagal Diubah!";
                    }
                    echo "
                        <script>
                            document.location.href='../pemasok/barang.php';
                        </script>
                    ";
                }
            }
        }
    } else {
        echo "<script>
                document.location.href='../pemasok/barang.php';
            </script>";
        exit;
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
                <!-- konten -->
                <div class="contents px-3 py-3">
                    <div class="box1">
                        <h5 class="text-dark text-center mb-0 ms-4 fw-bold">
                            Manajemen Data Barang
                        </h5>
                    </div>


                    <form method="post" action="">
                        <input type="hidden" name="idbahan" value="<?= $data['idbahan']; ?>">
                        <input type="hidden" name="oldnama_bahan" value="<?= $data['nama_bahan']; ?>">

                        <div class="mb-3 mt-3 row ms-5">
                            <label for="nama_bahan" class="col-sm-2 me-0 col-form-label">Nama Barang :</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control <?= isset($errors['nama_bahan']) ? 'is-invalid' : ''; ?>" id="nama_bahan" name="nama_bahan" value="<?= isset($_POST['nama_bahan']) ? $_POST['nama_bahan'] : $data['nama_bahan']; ?>">
                                <?php if(isset($errors['nama_bahan'])) : ?>
                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                        <?= $errors['nama_bahan']; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="mb-3 mt-3 row ms-5">
                            <label for="stok" class="col-sm-2 me-0 col-form-label">Stok :</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control <?= isset($errors['stok']) ? 'is-invalid' : ''; ?>" id="stok" name="stok" value="<?= isset($_POST['stok']) ? $_POST['stok'] : $data['stok']; ?>">
                                <?php if(isset($errors['stok'])) : ?>
                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                        <?= $errors['stok']; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="mb-3 mt-3 row ms-5">
                            <label for="satuan" class="col-sm-2 me-0 col-form-label">Satuan :</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control <?= isset($errors['satuan']) ? 'is-invalid' : ''; ?>" id="satuan" name="satuan" value="<?= isset($_POST['satuan']) ? $_POST['satuan'] : $data['satuan']; ?>">
                                <?php if(isset($errors['satuan'])) : ?>
                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                        <?= $errors['satuan']; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="mb-3 mt-3 row ms-5">
                            <label for="harga" class="col-sm-2 me-0 col-form-label">Harga :</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control <?= isset($errors['harga']) ? 'is-invalid' : ''; ?>" id="harga" name="harga" value="<?= isset($_POST['harga']) ? $_POST['harga'] : $data['harga']; ?>">
                                <?php if(isset($errors['harga'])) : ?>
                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                        <?= $errors['harga']; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>


                        <div class="d-flex justify-content-end me-5">
                            <a class="btn btn-secondary mt-3 px-4 me-3" style="border-radius: 15px;"
                                href="../pemasok/barang.php">Kembali</a>
                            <button type="submit" class="btn btn-primary mt-3 px-4"
                                style="border-radius: 15px;" name="submit">Update</button>
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

    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
</body>

</html>