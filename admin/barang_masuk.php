<?php 
    require_once '../controller/TransaksiPembelian.php';

    $data_transaksi = query("SELECT * FROM transaksi_pembelian WHERE status ='Selesai'");
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
                            Manajemen Barang Masuk
                        </h5>
                    </div>

                    <div class="mt-4">
                        <table id="example" class="table table-hover text-center">
                            <thead>
                                <tr class="table-secondary">
                                    <th class="text-center" scope="col">No</th>
                                    <th class="text-center" scope="col">Pemasok</th>
                                    <th class="text-center" scope="col">Nomor Bukti</th>
                                    <th class="text-center" scope="col">Tanggal Masuk</th>
                                    <th class="text-center" scope="col">Status</th>
                                    <th class="text-center" scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $i = 1;
                                    foreach($data_transaksi as $transaksi) :
                                        $idpemasok = $transaksi['idpemasok'];
                                        $pemasok = query("SELECT nama FROM user WHERE iduser = $idpemasok")[0];

                                        $idtransaksi = $transaksi['idtransaksi'];
                                        $barang_masuk = query("SELECT no_bukti, tgl_masuk FROM barang_masuk WHERE idtransaksi = $idtransaksi");
                                ?>  
                                    <tr>
                                        <td>
                                            <?= $i; ?>
                                        </td>
                                        <td>
                                            <?= $pemasok['nama']; ?>
                                        </td>
                                        <td>
                                            <?php if($barang_masuk[0]['no_bukti'] == NULL)  : ?>
                                                -
                                            <?php else : ?>
                                                <?= $transaksi['kode_transaksi']; ?>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if($barang_masuk[0]['tgl_masuk'] == NULL)  : ?>
                                                -
                                            <?php else : ?>
                                                <?= date("d-m-Y | H:i:s", strtotime($barang_masuk[0]['tgl_masuk'])); ?>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?= $transaksi['status']; ?>
                                        </td>
                                        <td>
                                            <a href="../admin/detail_barang_masuk.php?id=<?= enkripsi($idtransaksi); ?>" class="btn btn-sm btn-primary">
                                                Detail
                                            </a>
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
            </div>

            <!-- Modal Input Permintaan = Pilih Pemasok -->
            <div class="modal fade" id="barang_masuk" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="ciriLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="ciriLabel">Daftar Barang Masuk</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <form action="barang_masuk.php" method="post">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="kriteria" class="form-label">Inputkan Barang Masuk</label>

                                    <div class="">
                                        <input type="text" class="form-control mt-3" value="S001001" readonly disabled>
                                        <input type="text" class="form-control mt-3" placeholder="Masukkan Pemasok">
                                        <input type="text" class="form-control mt-3" placeholder="Masukkan Barang">
                                        <input type="text" class="form-control mt-3" placeholder="Masukkan Jumlah">
                                        <input type="text" class="form-control mt-3"
                                            placeholder="Masukkan Harga Barang">
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" name="submit_ciri" class="btn btn-primary">Pilih</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Modal Input Penimbangan = Pilih Balita Selesai -->
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