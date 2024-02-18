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
                            Manajemen Data User
                        </h5>
                    </div>


                    <form method="post" action="">
                        <div class="mb-3 mt-4 row ms-5">
                            <label for="inputNama" class="col-sm-3 me-0 col-form-label">Nama Lengkap:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="inputNama">
                            </div>
                        </div>
                        <div class="mb-3 mt-3 row ms-5">
                            <label for="username" class="col-sm-3 me-0 col-form-label">Username :</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="username">
                            </div>
                        </div>
                        <div class="mb-3 mt-3 row ms-5">
                            <label for="email" class="col-sm-3 me-0 col-form-label">Email :</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control" id="email">
                            </div>
                        </div>
                        <div class="mb-3 mt-3 row ms-5">
                            <label for="alamat" class="col-sm-3 me-0 col-form-label">Alamat :</label>
                            <div class="col-sm-8">
                                <textarea type="text" style="border-color: black;" class="form-control" id="inputGejala"
                                    name="alamat" rows="2"></textarea>
                            </div>
                        </div>
                        <div class="mb-3 mt-3 row ms-5">
                            <label for="noHp" class="col-sm-3 me-0 col-form-label">No Handphone :</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="noHp">
                            </div>
                        </div>
                        <div class="mb-3 mt-3 row ms-5">
                            <label for="password" class="col-sm-3 me-0 col-form-label">Password :</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" id="password">
                            </div>
                        </div>
                        <div class="mb-3 mt-3 row ms-5">
                            <label for="password2" class="col-sm-3 me-0 col-form-label">Konfirmasi Password :</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" id="password2">
                            </div>
                        </div>
                        <div class="mb-3 mt-3 row ms-5">
                            <label for="password2" class="col-sm-3 me-0 col-form-label">Instansi :</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="password2">
                            </div>
                        </div>
                        <div class="mb-4 mt-2 row ms-5">
                            <label for="profil" class="col-form-label">Foto Profil</label>
                            <div class="col-sm-3">
                                <img src="../img/default.png" class="img-preview" style="width: 70px;">
                            </div>
                            <div class="col-sm-8">
                                <a class="btn btn-sm btn-outline-danger" id="delete" onclick="">Hapus Foto</a>
                                <div class="input-group mb-3">
                                    <input type="file" class="form-control" style="border: 1px solid black;" id="profil"
                                        name="foto" onchange="previewImg()">
                                </div>
                                <label for="foto" class="foto">*kosongkan jika tidak ingin mengganti foto</label>
                            </div>
                        </div>
                        <div class="mb-3 mt-2 row ms-5">
                            <label for="hp" class="col-sm-3 me-0 col-form-label">Level</label>
                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col-sm-3 form-check">
                                        <input class="form-check-input" style="border: 1px solid black;" type="radio"
                                            name="role" id="admin" value="admin" checked>
                                        <label class="form-check-label" for="admin">
                                            Admin
                                        </label>
                                    </div>
                                    <div class="col-sm-3 form-check">
                                        <input class="form-check-input" style="border: 1px solid black;" type="radio"
                                            name="role" id="manajer" value="manajer">
                                        <label class="form-check-label" for="manajer">
                                            Manajer
                                        </label>
                                    </div>
                                    <div class="col-sm-3 form-check">
                                        <input class="form-check-input" style="border: 1px solid black;" type="radio"
                                            name="role" id="Pelanggan" value="Pelanggan">
                                        <label class="form-check-label" for="Pelanggan">
                                            Pelanggan
                                        </label>
                                    </div>
                                    <div class="col-sm-3 form-check">
                                        <input class="form-check-input" style="border: 1px solid black;" type="radio"
                                            name="role" id="Pelanggan" value="Pelanggan">
                                        <label class="form-check-label" for="Pelanggan">
                                            Pemasok
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end me-5">
                            <a class="btn btn-secondary mt-3 px-4 me-3" style="border-radius: 15px;"
                                href="../admin/user.php">Kembali</a>
                            <button type="button" class="btn btn-primary mt-3 px-4"
                                style="border-radius: 15px;">Submit</button>
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