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
                <div class="contents px-3 py-3 mx-3">
                    <div class="box1">
                        <h5 class="text-dark text-center mb-0 ms-4 fw-bold">
                            Manajemen Data Barang
                        </h5>
                    </div>

                    <div class="mt-4 ">
                        <div class="row">
                            <div class="col-1">
                                <a href="index.php" class="btn btn-outline-secondary">Kembali</a>
                            </div>
                            <div class="col-4">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#bahan_baku">
                                    Tambah Bahan Baku
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="mt-3 box3">
                        <table id="example" class="table table-hover text-center">
                            <thead>
                                <tr class="table-secondary">
                                    <th class="text-center" scope="col">Nama Barang</th>
                                    <th class="text-center" scope="col">Stok</th>
                                    <th class="text-center" scope="col">Satuan</th>
                                    <th class="text-center" scope="col">Harga</th>
                                    <th class="text-center" scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        Tepung
                                    </td>
                                    <td>
                                        30
                                    </td>
                                    <td>
                                        Dus
                                    </td>
                                    <td>
                                        Rp 20.000
                                    </td>
                                    <td>
                                        <a class="text-decoration-none" href="../edit/bahan_baku.php">
                                            <button class="btn btn-primary"><i class="bi bi-pencil-fill"></i></button>
                                        </a>
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

                <!-- Modal Bahan Baku -->
                <form method="post">
                    <div class="modal fade" id="bahan_baku" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5 text-dark" id="bahan_baku">Tambah Barang</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="bahan_baku" class="form-label">Barang :</label>
                                        <input type="text" class="form-control" style="border: 1px black solid"
                                            name="bahan_baku" id="bahan_baku" placeholder="masukkan barang">
                                    </div>
                                    <div class="mb-3">
                                        <label for="stok" class="form-label">Stok :</label>
                                        <input type="text" class="form-control" style="border: 1px black solid"
                                            name="stok" id="stok" placeholder="masukkan jumlah stok">
                                    </div>
                                    <div class="mb-3">
                                        <label for="satuan" class="form-label">Satuan :</label>
                                        <input type="text" class="form-control" style="border: 1px black solid"
                                            name="satuan" id="satuan" placeholder="masukkan satuan barang">
                                    </div>
                                    <div class="mb-3">
                                        <label for="harga" class="form-label">Harga :</label>
                                        <input type="number" class="form-control" style="border: 1px black solid"
                                            name="harga" id="harga" placeholder="masukkan harga barang">
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Kembali</button>
                                    <button type="button" name="bahan_baku" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- Modal Bahan Baku Selesai -->


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