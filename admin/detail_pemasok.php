<?php 
    require_once '../controller/UserController.php';

    if(isset($_GET['id'])) {
        $id = dekripsi($_GET['id']);

        $pemasok = query("SELECT * FROM user WHERE iduser = '$id'");
        
        if(count($pemasok) == 0) {
            echo "<script>
                    document.location.href='pemasok.php';
                </script>";
            exit;    
        } else {
            $pemasok = $pemasok[0];
            
            $data_bahan = query("SELECT * FROM bahan_pemasok WHERE idpemasok = $id");
        }
    } else {
        echo "<script>
                document.location.href='pemasok.php';
            </script>";
        exit;
    }
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
                require_once('../navbar/sidebar.php');
                ?>
                <!-- sidebar selesai -->

                <!-- konten -->
                <div class="contents px-3 py-3 mx-3">
                    <div class="box1">
                        <h5 class="text-dark mb-0 ms-4 text-center fw-bold">
                            Detail Data Pemasok
                        </h5>
                    </div>

                    <div class="mt-4">
                        <div class="row mt-4">
                            <div class="col-sm-4">
                                <h6 class="fw-bold">Nama Pemasok</h6>
                                <h6 class="fw-bold">Instansi</h6>
                                <h6 class="fw-bold">Email</h6>
                                <h6 class="fw-bold">Alamat</h6>
                                <h6 class="fw-bold">No Handphone</h6>
                            </div>
                            <div class="col-sm-4">
                                <h6 class="fw-bold">: <?= $pemasok['nama']; ?></h6>
                                <h6 class="fw-bold">: <?= $pemasok['instansi']; ?></h6>
                                <h6 class="fw-bold">: <?= $pemasok['email']; ?></h6>
                                <h6 class="fw-bold">: <?= $pemasok['alamat']; ?></h6>
                                <h6 class="fw-bold">: <?= $pemasok['telepon']; ?></h6>
                            </div>
                        </div>
                    </div>

                    <div class="mt-3">
                        <h6 class="text-center fw-bold">Bahan Baku/Barang Yang Dimiliki</h6>
                        <hr>
                        <table id="example" class="table table-hover text-center">
                            <thead>
                                <tr class="table-secondary">
                                    <th class="text-center" scope="col">No</th>
                                    <th class="text-center" scope="col">Nama Barang</th>
                                    <th class="text-center" scope="col">Stok</th>
                                    <th class="text-center" scope="col">Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $i = 1;
                                    foreach($data_bahan as $bahan) :
                                ?>
                                    <tr>
                                        <td>
                                            <?= $i; ?>
                                        </td>
                                        <td>
                                            <?= $bahan['nama_bahan']; ?>
                                        </td>
                                        <td>
                                            <?= $bahan['stok']; ?> <?= $bahan['satuan']; ?>
                                        </td>
                                        <td>
                                            Rp. <?= number_format($bahan['harga'], 0, ',', '.'); ?>
                                        </td>
                                    </tr>
                                <?php 
                                    $i++;
                                    endforeach;
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- konten selesai -->

                <!-- Modal Status -->
                <div class="modal fade modal-dialog-scrollable" id="statusModal" data-bs-backdrop="static"
                    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Ubah Status Pemesanan</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="" method="post">
                                <div class="modal-body">
                                    <label for="status" class="form-label">Pilih status pemesanan</label>
                                    <select class="form-select" aria-label="Default select example" name="status">
                                        <option selected hidden value="Selesai">Selesai</option>
                                        <option value="Belum Diproses">Belum Diproses</option>
                                        <option value="Diproses">Diproses</option>
                                        <option value="Selesai">Selesai</option>
                                    </select>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" name="status_pesanan">Pilih</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Modal Status selesai -->
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