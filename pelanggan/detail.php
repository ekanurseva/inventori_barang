<?php 
    require_once '../controller/TransaksiPenjualan.php';
    validasi();

    if(isset($_GET['id'])) {
        $id = dekripsi($_GET['id']);

        $transaksi = query("SELECT * FROM transaksi_penjualan WHERE idtransaksi = '$id'");
        
        if(count($transaksi) == 0) {
            echo "<script>
                    document.location.href='riwayat.php';
                </script>";
            exit;    
        } else {
            $transaksi = $transaksi[0];
            $data_barang = query("SELECT * FROM barang_keluar JOIN barang ON barang_keluar.idbarang = barang.idbarang WHERE idtransaksi = '$id'");

            $idpelanggan = $transaksi['idpelanggan'];
            $nama_pelanggan = query("SELECT nama FROM user WHERE iduser = $idpelanggan")[0];
        }
    } else {
        echo "<script>
                document.location.href='riwayat.php';
            </script>";
        exit;
    }
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- bootstrap css -->
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
        require_once('../navbar/navbar_pelanggan.php');
        ?>
        <!-- navbar selesai -->

        <div class="main-container m-0">
            <div class="d-flex">
                <!-- konten -->
                <div class="contents p-5 pt-3">
                    <h4 class="text-center fw-bold">DETAIL TRANSAKSI</h4>

                    <div class="text-center mt-4">
                        <div class="row">
                            <div class="col-sm-4">
                                Status : <b><?= $transaksi['status']; ?></b>
                            </div>
                            <div class="col-sm-4">
                                <h6><?= $transaksi['kode_transaksi']; ?></h6>
                            </div>
                            <div class="col-sm-4">
                                <h6><?= date("d-m-Y | H:i:s", strtotime($transaksi['tgl_transaksi'])); ?></h6>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 ">
                        <a class="btn btn-primary" href="../pelanggan">Tambah Pesanan</a>
                    </div>

                    <div class="mt-4">
                        <table id="example" class="table table-hover text-center">
                            <thead>
                                <tr class="table-secondary">
                                    <th class="text-center" scope="col">No</th>
                                    <th class="text-center" scope="col">Barang Pesanan</th>
                                    <th class="text-center" scope="col">Jumlah</th>
                                    <th class="text-center" scope="col">Total</th>
                                    <th class="text-center" scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $i = 1;
                                    $total = 0;
                                    foreach($data_barang as $barang) :
                                        $jumlah = $barang['qty'] * $barang['harga'];
                                        $total += $jumlah;
                                ?>
                                    <tr>
                                        <td>
                                            <?= $i; ?>
                                        </td>
                                        <td>
                                            <?= $barang['nama_barang']; ?>
                                        </td>
                                        <td>
                                            2
                                        </td>
                                        <td>
                                            Rp <?= number_format($jumlah, 0, ',', '.'); ?>
                                        </td>
                                        <td>
                                            <a href="../edit/pesanan.php" class="btn btn-sm btn-primary">
                                                <i class="bi bi-pencil-fill"></i>
                                            </a>
                                            |
                                            <button type="button" class="btn btn-danger btn-sm" id="delete">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php 
                                    $i++;
                                    endforeach;
                                ?>
                                <tr>
                                    <th>Total Pembayaran</th>
                                    <td></td>
                                    <td></td>
                                    <th>
                                        Rp Rp <?= number_format($total, 0, ',', '.'); ?>
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
    <script>
        $(document).ready(function () {
            $("#example").DataTable();
        });
    </script>
</body>

</html>