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
                            Transaksi Permintaan Barang
                        </h5>
                    </div>


                    <form method="post" action="" class="mx-5">
                        <div class="mb-2 mt-4 row">
                            <div class="col-4 mb-3">
                                <label class="fw-bold fs-5">Nama Barang :</label>
                            </div>
                            <div class="col-4 mb-3">
                                <label class="fw-bold fs-5">Harga :</label>
                            </div>
                            <div class="col-3 mb-3">
                                <label class="fw-bold fs-5">Jumlah :</label>
                            </div>
                        </div>

                        <div class="mb-2 row">
                            <div class="col-4 mb-3">
                                <label class="fw-bold">Tepung</label>
                            </div>
                            <div class="col-4 mb-3">
                                <label class="fw-bold">Rp 5.000</label>
                            </div>
                            <div class="col-3 mb-3">
                                <input type="text" class="form-control" placeholder="masukkan jumlah">
                            </div>
                        </div>

                        <div class="d-flex justify-content-end me-5 mt-5">
                            <a class="btn btn-secondary px-4 me-3" style="border-radius: 15px;"
                                href="../admin/transaksi.php">Kembali</a>
                            <button type="button" class="btn btn-primary px-4"
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