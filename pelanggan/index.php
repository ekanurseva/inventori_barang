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

                    <form method="post" action="">
                        <div class="mb-5 mt-5">
                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-2 row align-items-center">
                                        <div class="col-2">
                                            <img src="../img/cincau.jpg" alt="image produk" style="width: 80px;">
                                        </div>
                                        <div class="col-5">
                                            <div class="fw-bold fs-5">
                                                <label>Cincau manis cap panda</label>
                                            </div>
                                            <div class="fw-bold">
                                                <label>Rp 5.000</label>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <input type="text" class="form-control" placeholder="jumlah">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="mb-2 row align-items-center">
                                        <div class="col-2">
                                            <img src="../img/cincau.jpg" alt="image produk" style="width: 80px;">
                                        </div>
                                        <div class="col-5">
                                            <div class="fw-bold fs-5">
                                                <label>Cincau</label>
                                            </div>
                                            <div class="fw-bold">
                                                <label>Rp 5.000</label>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <input type="text" class="form-control" placeholder="jumlah">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="d-flex justify-content-end me-5">
                            <button type="button" class="btn btn-primary px-4"
                                style="border-radius: 15px;">Submit</button>
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