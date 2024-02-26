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
        require_once('../navbar/navbar.php');
        ?>
        <!-- navbar selesai -->

        <div class="main-container m-0">
            <div class="d-flex">
                <!-- konten -->
                <div class="contents p-5 pt-3">
                    <div class="mb-5 mt-3">
                        <div class="row">
                            <div class="card bg-primary text-white col-3 me-4">
                                <h6 class="card-header fw-bold">Data User</h6>
                                <div class="card-body">
                                    <h6 class="card-title text-center">Jumlah User</h6>
                                    <p class="card-text text-center">5</p>
                                    <div class="text-center">
                                        <a class="btn btn-light btn-sm" href="../admin/user.php">
                                            View
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="card bg-primary text-white col-3 me-4">
                                <h6 class="card-header fw-bold">Manajemen Laporan</h6>
                                <div class="card-body">
                                    <h6 class="card-title text-center">Jumlah Jenis Laporan</h6>
                                    <p class="card-text text-center">5</p>
                                    <div class="text-center">
                                        <a class="btn btn-light btn-sm" href="../admin/laporan.php">
                                            View
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="card bg-primary text-white col-3">
                                <h6 class="card-header fw-bold">Update Profil</h6>
                                <div class="card-body">
                                    <h6 class="card-title text-center">Manajer 1</h6>
                                    <p class="card-text text-center">PT. Apa</p>
                                    <div class="text-center">
                                        <a class="btn btn-light btn-sm" href="../manajer/profil.php">
                                            View
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- konten selesai -->
            </div>


            <!-- Modal Bahan Baku -->
            <form method="post">
                <div class="modal fade" id="bahan_baku" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5 text-dark" id="bahan_baku">Tambah Bahan Baku</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-2">
                                    <label for="bahan_baku" class="form-label">Bahan Baku :</label>
                                    <input type="text" class="form-control" name="bahan_baku" id="bahan_baku"
                                        placeholder="masukkan bahan baku">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
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
    <script src="bootstrap-5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>