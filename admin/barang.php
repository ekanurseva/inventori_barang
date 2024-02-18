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
                            Manajemen Data Barang
                        </h5>
                    </div>

                    <div class="mt-4 ">
                        <div class="row">
                            <div class="col-sm-3">
                                <a class="btn btn-primary" href="../insert/barang.php">Tambah Data Barang</a>
                            </div>
                            <!-- <div class="col-sm-4">
                                <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                    data-bs-target="#bahan_baku">
                                    Tambah Bahan Baku
                                </button>
                            </div> -->
                        </div>
                    </div>

                    <div class="mt-4 box3">
                        <h4 class="text-center">Tabel Barang</h4>
                        <hr>
                        <table id="example" class="table table-hover text-center">
                            <thead>
                                <tr class="table-secondary">
                                    <th class="text-center" scope="col">Nama Barang</th>
                                    <th class="text-center" scope="col">Kategori</th>
                                    <th class="text-center" scope="col">Merk</th>
                                    <th class="text-center" scope="col">Stok</th>
                                    <th class="text-center" scope="col">Satuan</th>
                                    <th class="text-center" scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        Es Cincau
                                    </td>
                                    <td>
                                        Happy Es
                                    </td>
                                    <td>
                                        merk barang
                                    </td>
                                    <td>
                                        3
                                    </td>
                                    <td>
                                        Dus
                                    </td>

                                    <td>
                                        <a class="text-decoration-none" href="../edit/barang.php">
                                            <button class="btn btn-primary"><i class="bi bi-pencil-fill"></i></button>
                                        </a>
                                        |
                                        <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                            data-bs-target="#detail_barang">
                                            <i class="bi bi-info-lg"></i>
                                        </button>
                                        |
                                        <a class="delete bg-danger" id="delete" onclick="confirmDelete()">
                                            <button class="btn btn-danger"><i class="bi bi-trash-fill"></i></button>
                                        </a>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="detail_barang" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content p-3">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">
                                    Informasi Es Cincau
                                </h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-sm-3 text-center">
                                        <img src="../img/cincau.jpg" class="img-preview" style="width: 130px;">
                                    </div>
                                    <div class="col-sm-9">
                                        <div class="row m-0 p-0">
                                            <div class="col-sm-4">
                                                <h6>Kategori</h6>
                                            </div>
                                            <div class="col-sm-8">
                                                <h7>: Happy Es</h7>
                                            </div>

                                            <div class="col-sm-4">
                                                <h6>Merk</h6>
                                            </div>
                                            <div class="col-sm-8">
                                                <h7>: Merk barang</h7>
                                            </div>

                                            <div class="col-sm-4">
                                                <h6>Gudang</h6>
                                            </div>
                                            <div class="col-sm-8">
                                                <h7>: A</h7>
                                            </div>

                                            <div class="col-sm-4">
                                                <h6>Rak</h6>
                                            </div>
                                            <div class="col-sm-8">
                                                <h7>: 1</h7>
                                            </div>

                                            <div class="col-sm-4">
                                                <h6>Stok</h6>
                                            </div>
                                            <div class="col-sm-8">
                                                <h7>: 20</h7>
                                            </div>

                                            <div class="col-sm-4">
                                                <h6>Satuan</h6>
                                            </div>
                                            <div class="col-sm-8">
                                                <h7>: Dus</h7>
                                            </div>

                                            <div class="col-sm-4">
                                                <h6>Harga Satuan</h6>
                                            </div>
                                            <div class="col-sm-8">
                                                <h7>: Rp. 5000</h7>
                                            </div>

                                            <div class="col-sm-4">
                                                <h6>Keterangan</h6>
                                            </div>
                                            <div class="col-sm-8">
                                                <h7>: -</h7>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                            </div>
                        </div>
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
    <script>
        $(document).ready(function () {
            $("#example").DataTable();
        });
    </script>
</body>

</html>