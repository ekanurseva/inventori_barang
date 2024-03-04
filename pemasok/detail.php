<?php 
    require_once '../controller/TransaksiPembelian.php';

    if(isset($_GET['id'])) {
        $id = dekripsi($_GET['id']);

        $transaksi = query("SELECT * FROM transaksi_pembelian WHERE idtransaksi = '$id'");
        
        if(count($transaksi) == 0) {
            echo "<script>
            document.location.href='transaksi.php';
            </script>";
            exit;    
        } else {
            $transaksi = $transaksi[0];
            $data_barang = query("SELECT * FROM barang_masuk WHERE idtransaksi = '$id'");

            $idpemasok = $transaksi['idpemasok'];
            $nama_pemasok = query("SELECT nama FROM user WHERE iduser = $idpemasok")[0];
            
            // if(isset($_POST['submit'])) {
            //     $errors = update($_POST);

            //     if(is_numeric($errors)) {
            //         if($errors > 0) {
            //             $_SESSION["berhasil"] = "Data User Berhasil Diubah!";
            //             echo "
            //                 <script>
            //                     document.location.href='../admin/user.php';
            //                 </script>
            //             ";
            //         } else {
            //             $_SESSION["gagal"] = "Data User Gagal Diubah!";
            //             echo "
            //                 <script>
            //                     document.location.href='../admin/user.php';
            //                 </script>
            //             ";
            //         }
            //     }
            // }

            // if(isset($_POST['hapus_foto'])) {
            //     if(delete_foto($_POST) > 0 ) {
            //         $_SESSION["berhasil"] = "Foto Berhasil Dihapus!";
            //         echo "
            //             <script>
            //                 document.location.href='../admin/user.php';
            //             </script>
            //         ";
            //     } else {
            //         $_SESSION["gagal"] = "Foto Gagal Dihapus!";
            //         echo "
            //             <script>
            //                 document.location.href='../admin/user.php';
            //             </script>
            //         ";
            //     }
            // }
        }
    } else {
        echo "<script>
                document.location.href='transaksi.php';
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

                <!-- konten -->
                <div class="contents px-3 py-3 mx-3">
                    <div class="box1">
                        <h5 class="text-dark mb-0 ms-4 text-center fw-bold">
                            Detail Transaksi Pesanan Barang
                        </h5>
                    </div>

                    <div class="text-center mt-4">
                        <div class="row">
                            <div class="col-1">
                                <a href="../pemasok/pesanan.php" class="btn btn-outline-secondary btn-sm">Kembali</a>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-sm-4">
                                <div class="row">
                                    <div class="col-sm-5 me-0 fw-bold">
                                        Status Pesanan
                                    </div>
                                    <div class="col-sm-7 ms-0">
                                        <h6>: <?= $transaksi['status']; ?>
                                            <button type="button" style="border: none; background: none;"
                                                data-bs-toggle="modal" data-bs-target="#statusModal"><i
                                                    class="bi bi-pencil-fill"></i></button>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                            <?php if($data_barang[0]['no_bukti'] == NULL) :?>
                                    <h6>-</h6>
                                <?php else : ?>
                                    <h6><?= $data_barang[0]['no_bukti']; ?></h6>
                                <?php endif; ?>
                            </div>
                            <div class="col-sm-4">
                                <h6><?= date("d-m-Y | H:i:s", strtotime($transaksi['tgl_transaksi'])); ?></h6>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <table class="table table-hover text-center">
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
                                        $idbarang = $barang['idbahan'];
                                        $bahan = query("SELECT * FROM bahan_pemasok WHERE idbahan = $idbarang")[0];

                                        $harga = $bahan['harga'] * $barang['qty'];
                                        $total += $harga;
                                ?>
                                    <tr>
                                        <td>
                                            <?= $i; ?>
                                        </td>
                                        <td>
                                            <?= $bahan['nama_bahan']; ?>
                                        </td>
                                        <td>
                                            <?= $barang['qty']; ?>
                                        </td>
                                        <td>
                                            Rp <?= number_format($harga, 0, ',', '.'); ?>
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
                                    <th colspan="3">Total Pembayaran</th>
                                    <th>
                                        Rp <?= number_format($total, 0, ',', '.'); ?>
                                    </th>
                                    <td></td>
                                </tr>
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
                                        <option selected hidden value="Selesai">Belum Diproses</option>
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
</body>

</html>