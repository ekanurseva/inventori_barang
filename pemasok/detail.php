<?php 
    require_once '../controller/TransaksiPembelian.php';
    validasi_pemasok();

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
            
            if(isset($_POST['delete'])) {
                if(delete($_POST) > 0 ) {
                    $_SESSION["berhasil"] = "Barang Pesanan Berhasil Dihapus!";
                } else {
                    $_SESSION["gagal"] = "Barang Pesanan Gagal Dihapus!";
                }
                header("Refresh:0");
            }

            if(isset($_POST['status_pesanan'])) {
                if(update_status($_POST) > 0 ) {
                    $_SESSION["berhasil"] = "Status Berhasil Diubah!";
                } else {
                    $_SESSION["gagal"] = "Status Gagal Diubah!";
                }
                header("Refresh:0");
            }
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

                    <?php if(isset($_SESSION['berhasil'])) : ?>
                        <div class="my-3">
                            <div class="alert alert-success" role="alert">
                                <i class="bi bi-check-circle"></i> <?= $_SESSION['berhasil']; ?>
                            </div>
                        </div>
                    <?php elseif(isset($_SESSION['gagal'])) : ?>
                        <div class="my-3">
                            <div class="alert alert-danger" role="alert">
                                <i class="bi bi-x-circle"></i> <?= $_SESSION['gagal']; ?>
                            </div>
                        </div>
                    <?php endif; ?>

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
                                    <?php if($transaksi['status'] == "Belum Diproses") : ?>
                                        <th class="text-center" scope="col">Aksi</th>
                                    <?php endif; ?>
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
                                        <?php if($transaksi['status'] == "Belum Diproses") : ?>
                                            <td>
                                                <a href="../edit/pesanan.php?id=<?= enkripsi($barang['idmasuk']); ?>&dari=<?= $_GET['id']; ?>" class="btn btn-sm btn-primary">
                                                    <i class="bi bi-pencil-fill"></i>
                                                </a>
                                                |
                                                <button type="button" class="btn  btn-danger btn-sm" id="delete" data-bs-toggle="modal" data-bs-target="#delete_<?= $barang['idmasuk']; ?>">
                                                    <i class="bi bi-trash-fill"></i>
                                                </button>
                                            </td>
                                        <?php endif; ?>
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
                                    <?php if($transaksi['status'] == "Belum Diproses") : ?>
                                        <td></td>
                                    <?php endif; ?>
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
                                <input type="hidden" name="idtransaksi" value="<?= $transaksi['idtransaksi']; ?>">
                                <div class="modal-body">
                                    <label for="status" class="form-label">Pilih status pemesanan</label>
                                    <select class="form-select" aria-label="Default select example" name="status">
                                        <?php if($transaksi['status'] == "Belum Diproses")  :?>
                                            <option value="Diproses" <?= $transaksi['status'] == "Diproses" ? 'selected' : ''; ?>>Diproses</option>
                                        <?php elseif($transaksi['status'] == "Diproses")  : ?>
                                            <option value="Belum Diproses" <?= $transaksi['status'] == "Belum Diproses" ? 'selected' : ''; ?>>Belum Diproses</option>
                                            <option value="Diproses" <?= $transaksi['status'] == "Diproses" ? 'selected' : ''; ?>>Diproses</option>
                                            <option value="Selesai" <?= $transaksi['status'] == "Selesai" ? 'selected' : ''; ?>>Selesai</option>
                                        <?php endif; ?>
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

                <?php foreach($data_barang as $dabar) : ?>
                    <!-- Modal -->
                    <div class="modal fade" id="delete_<?= $dabar['idmasuk']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Hapus Barang Pesanan</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Yakin ingin menghapus data barang pesanan ini?
                                </div>
                                <div class="modal-footer">
                                    <form action="" method="post">
                                        <input type="hidden" name="idmasuk" value="<?= $dabar['idmasuk']; ?>">                                    
                                        <input type="hidden" name="idbahan" value="<?= $dabar['idbahan']; ?>">                                    
                                        <input type="hidden" name="qty" value="<?= $dabar['qty']; ?>">                                    

                                        <button type="submit" class="btn btn-danger" name="delete">Hapus</button>
                                    </form>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
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

<?php 
    if(isset($_POST['status_pesanan']) || isset($_POST['delete'])) {
        
    } else {
        $_SESSION = [];
        session_unset();
        session_destroy();
    }
?>