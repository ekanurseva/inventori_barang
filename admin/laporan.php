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
                <div class="contents px-3 py-3 mx-3">
                    <div class="box1">
                        <h5 class="text-dark text-center mb-0 ms-4 fw-bold">
                            Manajemen Laporan
                        </h5>
                    </div>

                    <div class="mt-4 ">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="card bg-primary text-white">
                                    <h6 class="card-header fw-bold">Laporan Barang Masuk</h6>
                                    <div class="card-body">
                                        <h6 class="card-title text-center">Jumlah Barang Masuk</h6>
                                        <p class="card-text text-center">5</p>
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
                                        <p class="card-text text-center">5</p>
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
                                        <p class="card-text text-center">5</p>
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
                                        <p class="card-text text-center">5</p>
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
                                        <p class="card-text text-center">5</p>
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
                            <form action="../laporan/masuk.php" method="post">
                                <div class="modal-body">
                                    <p>Pilih range tanggal laporan barang masuk yang ingin ditampilkan</p>

                                    <label for="dari" class="form-label">Dari</label>
                                    <input type="date" class="form-control" id="dari" name="dari">

                                    <label for="sampai" class="form-label mt-3">Sampai</label>
                                    <input type="date" class="form-control" id="sampai" name="sampai">

                                    <p class="mt-5">*kosongkan jika ingin melihat seluruh laporan barang masuk</p>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" name="laporan_masuk"
                                        target="_blank">Pilih</button>
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
                            <form action="../laporan/keluar.php" method="post">
                                <div class="modal-body">
                                    <p>Pilih range tanggal laporan barang keluar yang ingin ditampilkan</p>

                                    <label for="dari" class="form-label">Dari</label>
                                    <input type="date" class="form-control" id="dari" name="dari">

                                    <label for="sampai" class="form-label mt-3">Sampai</label>
                                    <input type="date" class="form-control" id="sampai" name="sampai">

                                    <p class="mt-5">*kosongkan jika ingin melihat seluruh laporan barang keluar</p>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" name="laporan_keluar"
                                        target="_blank">Pilih</button>
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
                            <form action="../laporan/permintaan.php" method="post">
                                <div class="modal-body">
                                    <p>Pilih range tanggal laporan permintaan barang yang ingin ditampilkan</p>

                                    <label for="dari" class="form-label">Dari</label>
                                    <input type="date" class="form-control" id="dari" name="dari">

                                    <label for="sampai" class="form-label mt-3">Sampai</label>
                                    <input type="date" class="form-control" id="sampai" name="sampai">

                                    <p class="mt-5">*kosongkan jika ingin melihat seluruh laporan permintaan barang</p>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" name="laporan_permintaan"
                                        target="_blank">Pilih</button>
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
</body>

</html>