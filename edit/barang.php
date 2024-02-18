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
                <div class="contents px-3 py-3">
                    <div class="box1">
                        <h5 class="text-dark text-center mb-0 ms-4 fw-bold">
                            <span style="color: rgb(72 60 60);">
                                Manajemen Data Barang /
                            </span>
                            <span> Edit Barang</span>
                        </h5>
                    </div>


                    <form method="post" action="">
                        <div class="mb-3 mt-3 row ms-5">
                            <label for="inputNama" class="col-sm-2 me-0 col-form-label">Nama Barang :</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="inputNama">
                            </div>
                        </div>
                        <div class="mb-3 mt-3 row ms-5">
                            <label for="inputMerk" class="col-sm-2 me-0 col-form-label">Merk Barang :</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="inputMerk">
                            </div>
                        </div>
                        <div class="mb-3 mt-3 row ms-5">
                            <label for="inputKategori" class="col-sm-2 me-0 col-form-label">Kategori Barang :</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="inputKategori">
                            </div>
                        </div>
                        <div class="mb-3 mt-3 row ms-5">
                            <label for="inputGudang" class="col-sm-2 me-0 col-form-label">Gudang Barang :</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="inputGudang">
                            </div>
                        </div>
                        <div class="mb-3 mt-3 row ms-5">
                            <label for="inputRak" class="col-sm-2 me-0 col-form-label">Rak Barang :</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="inputRak">
                            </div>
                        </div>
                        <div class="mb-3 mt-3 row ms-5">
                            <label for="inputStok" class="col-sm-2 me-0 col-form-label">Stok Barang :</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="inputStok">
                            </div>
                        </div>
                        <div class="mb-3 mt-3 row ms-5">
                            <label for="inputSatuan" class="col-sm-2 me-0 col-form-label">Satuan :</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="inputSatuan">
                            </div>
                        </div>
                        <div class="mb-3 mt-3 row ms-5">
                            <label for="inputSatuan" class="col-sm-2 me-0 col-form-label">Harga Satuan :</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="inputSatuan">
                            </div>
                        </div>
                        <div class="mb-3 mt-3 row ms-5">
                            <label for="inputSatuan" class="col-sm-2 me-0 col-form-label">Keterangan Barang:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="inputSatuan">
                            </div>
                        </div>
                        <div class="mb-3 mt-3 row ms-5">
                            <label class="col-form-label">Foto Barang :</label>
                            <div class="col-sm-2">
                                <img src="../img/default.png" class="img-preview" style="width: 70px;">
                            </div>
                            <div class="col-sm-8">
                                <div class="input-group mb-3">
                                    <input type="file" class="form-control" style="border: 1px solid black;" id="profil"
                                        name="foto" onchange="previewImg()">
                                </div>
                            </div>
                        </div>


                        <div class="d-flex justify-content-end me-5">
                            <a class="btn btn-secondary mt-3 px-4 me-3" style="border-radius: 15px;"
                                href="../admin/barang.php">Kembali</a>
                            <button type="button" class="btn btn-primary mt-3 px-4"
                                style="border-radius: 15px;">Update</button>
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
    <script>
        $(document).ready(function () {
            $("#example").DataTable();
        });
    </script>
</body>

</html>