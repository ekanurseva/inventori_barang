<?php 
    require_once '../controller/TransaksiPembelian.php';
    validasi_pemasok();

    if(isset($_GET['id']) && isset($_GET['dari'])) {
        $id = dekripsi($_GET['id']);

        $data = query("SELECT * FROM barang_masuk WHERE idmasuk = '$id'");

        if(count($data) == 0) {
            echo "<script>
                    document.location.href='../pemasok/detail.php?id=". $_GET['dari'] ."';
                </script>";
            exit;    
        } else {
            $data = $data[0];

            $idbahan = $data['idbahan'];
            $bahan = query("SELECT * FROM bahan_pemasok WHERE idbahan = '$idbahan'")[0];
            
            if(isset($_POST['submit'])) {
                $errors = update($_POST);

                if(is_numeric($errors)) {
                    if($errors > 1) {
                        $_SESSION["berhasil"] = "Data Pembelian Berhasil Diubah!";
                    } else {
                        $_SESSION["gagal"] = "Data Pembelian Gagal Diubah!";
                    }
                    echo "
                        <script>
                            document.location.href='../pemasok/detail.php?id=". $_GET['dari'] ."';
                        </script>
                    ";
                }
            }
        }
    } else {
        echo "<script>
                document.location.href='../pemasok/pesanan.php';
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
                            Detail Transaksi Permintaan Barang
                        </h5>
                    </div>


                    <form method="post" action="">
                        <input type="hidden" name="idmasuk" value="<?= $data['idmasuk']; ?>">
                        <input type="hidden" name="idbahan" value="<?= $idbahan; ?>">
                        <input type="hidden" name="oldqty" value="<?= $data['qty']; ?>">

                        <div class="mb-3 mt-4 row ms-5">
                            <div class="col-4 mb-3">
                                <label class="fw-bold fs-5">Nama Barang :</label>
                            </div>
                            <div class="col-5 mb-3">
                                <label class="fw-bold fs-5" for="qty">Jumlah :</label>
                            </div>

                            <div class="col-4 mt-2">
                                <label class="fw-bold"><?= $bahan['nama_bahan']; ?></label>
                            </div>
                            <div class="col-5 mt-2">
                                <input type="number" class="form-control <?= isset($errors['qty']) ? 'is-invalid' : ''; ?>" placeholder="masukkan jumlah" id="qty" name="qty" value="<?= isset($_POST['qty']) ? $_POST['qty'] : $data['qty']; ?>">
                                <?php if(isset($errors['qty'])) : ?>
                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                        <?= $errors['qty']; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>


                        <div class="d-flex justify-content-end me-5">
                            <a class="btn btn-secondary mt-3 px-4 me-3" style="border-radius: 15px;"
                                href="../pemasok/detail.php?id=<?= $_GET['dari']; ?>">Kembali</a>
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
</body>

</html>