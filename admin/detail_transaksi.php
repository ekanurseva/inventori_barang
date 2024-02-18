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
                        <h5 class="text-dark mb-0 ms-4 text-center fw-bold">
                            Detail Transaksi Permintaan Barang
                        </h5>
                    </div>

                    <div class="text-center mt-4">
                        <div class="row">
                            <div class="col-1">
                                <a href="../admin/transaksi.php" class="btn btn-outline-secondary btn-sm">Kembali</a>
                            </div>
                            <div class="col-10">
                                <h6>Nama Pemasok : <b>Pemasok 1</b></h6>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-4">
                                <h6>12-12-2023 | 10:12:05</h6>
                            </div>
                            <div class="col-sm-4">
                                <h6>S001001</h6>
                            </div>
                            <div class="col-sm-4">
                                Status : <b>Belum Diproses</b>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 ">
                        <a class="btn btn-primary" href="../insert/permintaan.php">Tambah Permintaan</a>
                    </div>

                    <div class="mt-4">
                        <table class="table table-hover text-center">
                            <thead>
                                <tr class="table-secondary">
                                    <th class="text-center" scope="col">Barang Pesanan</th>
                                    <th class="text-center" scope="col">Jumlah</th>
                                    <th class="text-center" scope="col">Total</th>
                                    <th class="text-center" scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        Tepung
                                    </td>
                                    <td>
                                        2
                                    </td>
                                    <td>
                                        Rp 100.000
                                    </td>
                                    <td>
                                        <a href="../edit/transaksi.php" class="btn btn-sm btn-primary">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>
                                        |
                                        <button type="button" class="btn btn-danger btn-sm" id="delete">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <th>Total Pembayaran</th>
                                    <th>
                                        Rp 100.000
                                    </th>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- konten selesai -->
            </div>

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