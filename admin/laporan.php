<?php
require_once '../controller/MainController.php';

$barang_masuk = query("SELECT * FROM transaksi_pembelian WHERE status ='Selesai'");
$barang_keluar = query("SELECT * FROM transaksi_penjualan WHERE status ='Selesai'");
$permintaan_barang = query("SELECT * FROM transaksi_pembelian");
$barang = query("SELECT * FROM barang");
$user = cari_user();

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
                if ($user['level'] === "Admin") {
                    require_once('../navbar/sidebar.php');
                }
                ?>
                <!-- sidebar selesai -->

                <!-- konten -->
                <div class="contents px-3 py-3 mx-3">
                    <div class="box1">
                        <h5 class="text-dark text-center mb-0 ms-4 fw-bold">
                            Manajemen Laporan
                        </h5>
                    </div>

                    <?php
                    if ($user['level'] === "Manajer") {
                        echo '<div class="mt-4 "> 
                                <a href="../manajer/index.php" class="btn btn-outline-secondary">Kembali</a> 
                            </div>';
                    }
                    ?>

                    <div class="mt-4 ">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="card bg-primary text-white">
                                    <h6 class="card-header fw-bold">Laporan Barang Masuk</h6>
                                    <div class="card-body">
                                        <h6 class="card-title text-center">Jumlah Barang Masuk</h6>
                                        <p class="card-text text-center">
                                            <?= count($barang_masuk); ?>
                                        </p>
                                        <div class="text-center">
                                            <div class="row">
                                                <div class="col-6">
                                                    <a class="btn btn-outline-light btn-sm"
                                                        href="../admin/barang_masuk.php">
                                                        View Detail
                                                    </a>
                                                </div>
                                                <div class="col-6">
                                                    <button class="btn btn-light btn-sm" type="button"
                                                        data-bs-toggle="modal" data-bs-target="#masuk">
                                                        Cetak Laporan
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="card bg-primary text-white">
                                    <h6 class="card-header fw-bold">Laporan Barang Keluar</h6>
                                    <div class="card-body">
                                        <h6 class="card-title text-center">Jumlah Barang Keluar</h6>
                                        <p class="card-text text-center">
                                            <?= count($barang_keluar); ?>
                                        </p>
                                        <div class="text-center">
                                            <div class="row">
                                                <div class="col-6">
                                                    <a class="btn btn-outline-light btn-sm"
                                                        href="../admin/barang_keluar.php">
                                                        View Detail
                                                    </a>
                                                </div>
                                                <div class="col-6">
                                                    <button class="btn btn-light btn-sm" type="button"
                                                        data-bs-toggle="modal" data-bs-target="#keluar">
                                                        Cetak Laporan
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="card bg-primary text-white">
                                    <h6 class="card-header fw-bold">Laporan Permintaan Barang</h6>
                                    <div class="card-body">
                                        <h6 class="card-title text-center">Jumlah Permintaan Barang</h6>
                                        <p class="card-text text-center">
                                            <?= count($permintaan_barang); ?>
                                        </p>
                                        <div class="text-center">
                                            <div class="row">
                                                <div class="col-6">
                                                    <a class="btn btn-outline-light btn-sm"
                                                        href="../admin/transaksi.php">
                                                        View Detail
                                                    </a>
                                                </div>
                                                <div class="col-6">
                                                    <button class="btn btn-light btn-sm" type="button"
                                                        data-bs-toggle="modal" data-bs-target="#permintaan">
                                                        Cetak Laporan
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-sm-4">
                                <div class="card bg-primary text-white">
                                    <h6 class="card-header fw-bold">Laporan Daftar Barang</h6>
                                    <div class="card-body">
                                        <h6 class="card-title text-center">Jumlah Barang</h6>
                                        <p class="card-text text-center">
                                            <?= count($barang); ?>
                                        </p>
                                        <div class="text-center">
                                            <div class="row">
                                                <div class="col-6">
                                                    <a class="btn btn-outline-light btn-sm" href="../admin/barang.php">
                                                        View Detail
                                                    </a>
                                                </div>
                                                <div class="col-6">
                                                    <a class="btn btn-light btn-sm" href="../laporan/barang.php"
                                                        target="_blank">
                                                        Cetak Laporan
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="card bg-primary text-white">
                                    <h6 class="card-header fw-bold">Laporan Stok Barang</h6>
                                    <div class="card-body">
                                        <h6 class="card-title text-center">Jumlah Barang</h6>
                                        <p class="card-text text-center">
                                            <?= count($barang); ?>
                                        </p>
                                        <div class="text-center">
                                            <div class="row">
                                                <div class="col-6">
                                                    <a class="btn btn-outline-light btn-sm" href="../admin/barang.php">
                                                        View Detail
                                                    </a>
                                                </div>
                                                <div class="col-6">
                                                    <a class="btn btn-light btn-sm" href="../laporan/stok.php"
                                                        target="_blank">
                                                        Cetak Laporan
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Barang Masuk -->
                <div class="modal fade modal-dialog-scrollable" id="masuk" data-bs-backdrop="static"
                    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Pilih tanggal untuk mencetak
                                    laporan barang masuk</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form id="laporanForm">
                                <input type="hidden" name="ke" id="ke" value="masuk.php">
                                <div class="modal-body">
                                    <p>Pilih range tanggal laporan barang masuk yang ingin ditampilkan</p>

                                    <label for="dari" class="form-label">Dari</label>
                                    <input type="date" class="form-control" id="dari" name="dari">

                                    <label for="sampai" class="form-label mt-3">Sampai</label>
                                    <input type="date" class="form-control" id="sampai" name="sampai">

                                    <p class="mt-5">*kosongkan jika ingin melihat seluruh laporan barang masuk</p>
                                </div>

                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" id="submitBtn">Pilih</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Modal Barang Masuk selesai -->

                <!-- Modal Barang Keluar -->
                <div class="modal fade modal-dialog-scrollable" id="keluar" data-bs-backdrop="static"
                    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Pilih tanggal untuk mencetak
                                    laporan barang keluar</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form id="laporanForm">
                                <input type="hidden" name="ke2" id="ke2" value="keluar.php">
                                <div class="modal-body">
                                    <p>Pilih range tanggal laporan barang keluar yang ingin ditampilkan</p>

                                    <label for="dari" class="form-label">Dari</label>
                                    <input type="date" class="form-control" id="dari2" name="dari2">

                                    <label for="sampai" class="form-label mt-3">Sampai</label>
                                    <input type="date" class="form-control" id="sampai2" name="sampai2">

                                    <p class="mt-5">*kosongkan jika ingin melihat seluruh laporan barang keluar</p>
                                </div>

                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" id="submitBtn2">Pilih</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Modal Barang Keluar selesai -->

                <!-- Modal Barang Permintaan -->
                <div class="modal fade modal-dialog-scrollable" id="permintaan" data-bs-backdrop="static"
                    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Pilih tanggal untuk mencetak
                                    laporan permintaan barang</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form id="laporanForm">
                                <input type="hidden" name="ke" id="ke3" value="permintaan.php">
                                <div class="modal-body">
                                    <p>Pilih range tanggal laporan permintaan barang yang ingin ditampilkan</p>

                                    <label for="dari" class="form-label">Dari</label>
                                    <input type="date" class="form-control" id="dari3" name="dari3">

                                    <label for="sampai" class="form-label mt-3">Sampai</label>
                                    <input type="date" class="form-control" id="sampai3" name="sampai3">

                                    <p class="mt-5">*kosongkan jika ingin melihat seluruh laporan permintaan barang</p>
                                </div>

                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" id="submitBtn3">Pilih</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Modal Barang Permintaan selesai -->
            </div>


        </div>
    </div>

    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>

    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#example").DataTable();
        });
    </script>

    <script>
        document.getElementById('submitBtn').addEventListener('click', function () {
            var dari = document.getElementById('dari').value;
            var sampai = document.getElementById('sampai').value;
            var ke = document.getElementById('ke').value;

            var url = '../laporan/' + ke + '?dari=' + dari + '&sampai=' + sampai;

            window.open(url, '_blank');
        });

        document.getElementById('submitBtn2').addEventListener('click', function () {
            var dari2 = document.getElementById('dari2').value;
            var sampai2 = document.getElementById('sampai2').value;
            var ke2 = document.getElementById('ke2').value;

            var url = '../laporan/' + ke2 + '?dari=' + dari2 + '&sampai=' + sampai2;

            window.open(url, '_blank');
        });

        document.getElementById('submitBtn3').addEventListener('click', function () {
            var dari3 = document.getElementById('dari3').value;
            var sampai3 = document.getElementById('sampai3').value;
            var ke3 = document.getElementById('ke3').value;

            var url = '../laporan/' + ke3 + '?dari=' + dari3 + '&sampai=' + sampai3;

            window.open(url, '_blank');
        });
    </script>
</body>

</html>