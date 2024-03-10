<?php
require_once '../controller/TransaksiPembelian.php';

$data_pemasok = query("SELECT * FROM user WHERE level = 'Pemasok'");
$data_transaksi = query("SELECT * FROM transaksi_pembelian ORDER BY tgl_transaksi DESC");
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
                if ($user['level'] === "Admin") {
                    require_once('../navbar/sidebar.php');
                }
                ?>
                <!-- sidebar selesai -->

                <!-- konten -->
                <div class="contents px-3 py-3 mx-3">
                    <div class="box1">
                        <h5 class="text-dark mb-0 ms-4 text-center fw-bold">
                            Transaksi Permintaan Barang
                        </h5>
                    </div>

                    <?php
                    if ($user['level'] === "Manajer") {
                        echo '<div class="mt-4 "> 
                                <a href="../admin/laporan.php" class="btn btn-outline-secondary">Kembali</a> 
                            </div>';
                    } else {
                        echo '
                        <div class="mt-4 ">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#pesanan">
                            Buat Permintaan Barang
                            </button>
                        </div>
                        ';
                    }
                    ?>

                    <?php if (isset($_SESSION['berhasil'])): ?>
                        <div class="my-3">
                            <div class="alert alert-success" role="alert">
                                <i class="bi bi-check-circle"></i>
                                <?= $_SESSION['berhasil']; ?>
                            </div>
                        </div>
                    <?php elseif (isset($_SESSION['gagal'])): ?>
                        <div class="my-3">
                            <div class="alert alert-danger" role="alert">
                                <i class="bi bi-x-circle"></i>
                                <?= $_SESSION['gagal']; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="mt-4">
                        <table id="example" class="table table-hover text-center">
                            <thead>
                                <tr class="table-secondary">
                                    <th class="text-center" scope="col">No</th>
                                    <th class="text-center" scope="col">Pemasok</th>
                                    <th class="text-center" scope="col">Tanggal Transaksi</th>
                                    <th class="text-center" scope="col">Status</th>
                                    <th class="text-center" scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($data_transaksi as $transaksi):
                                    $idpemasok = $transaksi['idpemasok'];
                                    $pemasok = query("SELECT nama FROM user WHERE iduser = $idpemasok")[0];
                                    ?>
                                    <tr>
                                        <td>
                                            <?= $i; ?>
                                        </td>
                                        <td>
                                            <?= $pemasok['nama']; ?>
                                        </td>
                                        <td>
                                            <?= date("d-m-Y | H:i:s", strtotime($transaksi['tgl_transaksi'])); ?>
                                        </td>
                                        <td>
                                            <?= $transaksi['status']; ?>
                                        </td>
                                        <td>
                                            <a href="../admin/detail_transaksi.php?id=<?= enkripsi($transaksi['idtransaksi']); ?>"
                                                class="btn btn-sm btn-primary">
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
            <div class="modal fade" id="pesanan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="ciriLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="ciriLabel">Transaksi Permintaan Barang</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <form action="../insert/permintaan.php" method="get">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="kriteria" class="form-label">Pilih Pemasok Untuk Melakukan
                                        Permintaan Barang</label>

                                    <div class="">
                                        <select id="kriteria" class="form-select" style="border: 1px solid black;"
                                            aria-label="Default select example" name="pemasok">
                                            <option value="" selected hidden>--Pilih Pemasok--</option>
                                            <?php foreach ($data_pemasok as $pemasok): ?>
                                                <option value="<?= enkripsi($pemasok['iduser']); ?>"><?= $pemasok['nama']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
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

</html>

<?php
if (!isset($_POST['iduser'])) {
    $_SESSION = [];
    session_unset();
    session_destroy();
}
?>