<?php 
    require_once '../controller/TransaksiPenjualan.php';
    validasi();
    $user = cari_user();

    $data_barang = query("SELECT * FROM barang");

    $kode_transaksi = "SIIB-" . time();

    $jumlah_barang = ceil(count($data_barang) / 2);
    $jumlah_barang2 = count($data_barang) - $jumlah_barang;

    $data_barang1 = query("SELECT * FROM barang LIMIT $jumlah_barang");
    $data_barang2 = query("SELECT * FROM barang LIMIT $jumlah_barang2 OFFSET $jumlah_barang");

    if(isset($_POST['submit'])) {
        $errors = create($_POST);

        if(is_numeric($errors)) {
            if($errors > 1) {
                if(isset($_GET['dari'])) {
                    $_SESSION["berhasil"] = "Transaksi Berhasil Ditambahkan!";
                    echo "
                        <script>
                            document.location.href='detail.php?id=" . $_GET['dari'] . "';
                        </script>
                    ";
                } else {
                    $_SESSION["berhasil"] = "Transaksi Berhasil Dibuat!";
                    echo "
                        <script>
                            document.location.href='../pelanggan/riwayat.php';
                        </script>
                    ";
                }
            } else {
                $_SESSION["gagal"] = "Transaksi Gagal Dibuat!";
                echo "
                    <script>
                        document.location.href='../pelanggan/riwayat.php';
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
        require_once('../navbar/navbar_pelanggan.php');
        ?>
        <!-- navbar selesai -->

        <div class="main-container m-0">
            <div class="d-flex">
                <!-- konten -->
                <div class="contents p-5 pt-3">
                    <h4 class="text-center fw-bold">PRODUK</h4>

                    <?php if(isset($errors['kosong'])) : ?>
                        <div class="my-3">
                            <div class="alert alert-danger" role="alert">
                                <i class="bi bi-x-circle"></i> <?= $errors['kosong']; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <form method="post" action="">
                        <input type="hidden" name="idpelanggan" value="<?= $user['iduser']; ?>">
                        <input type="hidden" name="kode_transaksi" value="<?= $kode_transaksi; ?>">
                        <input type="hidden" name="dari" value="<?= isset($_GET['dari']) ? $_GET['dari'] : ''; ?>">

                        <div class="mb-5 mt-5">
                            <div class="row">
                                <div class="col-6">
                                    <?php foreach($data_barang1 as $barang1) : ?>
                                        <div class="mb-2 row align-items-center">
                                            <div class="col-2">
                                                <img src="../img/barang/<?= $barang1['foto']; ?>" alt="image produk" style="width: 80px;">
                                            </div>
                                            <div class="col-5">
                                                <div class="fw-bold fs-5">
                                                    <label><?= $barang1['nama_barang']; ?></label>
                                                </div>
                                                <div class="fw-bold">
                                                    <label>Rp <?= number_format($barang1['harga'], 0, ',', '.'); ?></label>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control <?= isset($errors['barang_' . $barang1['idbarang']]) ? 'is-invalid' : ''; ?>" placeholder="jumlah" name="barang_<?= $barang1['idbarang'] ?>" value="<?= isset($_POST['barang_' . $barang1['idbarang']]) ? $_POST['barang_' . $barang1['idbarang']] : '0'; ?>">
                                                <?php if(isset($errors['barang_' . $barang1['idbarang']])) : ?>
                                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                                        <?= $errors['barang_' . $barang1['idbarang']]; ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>

                                <div class="col-6">
                                    <?php foreach($data_barang2 as $barang2) : ?>
                                        <div class="mb-2 row align-items-center">
                                            <div class="col-2">
                                                <img src="../img/barang/<?= $barang2['foto']; ?>" alt="image produk" style="width: 80px;">
                                            </div>
                                            <div class="col-5">
                                                <div class="fw-bold fs-5">
                                                    <label><?= $barang2['nama_barang']; ?></label>
                                                </div>
                                                <div class="fw-bold">
                                                    <label>Rp <?= number_format($barang2['harga'], 0, ',', '.'); ?></label>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control <?= isset($errors['barang_' . $barang2['idbarang']]) ? 'is-invalid' : ''; ?>" placeholder="jumlah" name="barang_<?= $barang2['idbarang'] ?>" value="<?= isset($_POST['barang_' . $barang2['idbarang']]) ? $_POST['barang_' . $barang2['idbarang']] : '0'; ?>">
                                                <?php if(isset($errors['barang_' . $barang2['idbarang']])) : ?>
                                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                                        <?= $errors['barang_' . $barang2['idbarang']]; ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>

                        </div>

                        <div class="d-flex justify-content-end me-5">
                            <button type="submit" class="btn btn-primary px-4"
                                style="border-radius: 15px;" name="submit">Submit</button>
                            <?php if(isset($_GET['dari'])) : ?>
                                <a class="btn btn-secondary px-4 ms-3"
                                    style="border-radius: 15px;" href="detail.php?id=<?= $_GET['dari']; ?>">Kembali</a>
                            <?php endif; ?>
                        </div>
                    </form>
                </div>
                <!-- konten selesai -->
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