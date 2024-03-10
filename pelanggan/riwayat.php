<?php
require_once '../controller/TransaksiPenjualan.php';
validasi();

$user = cari_user();
$iduser = $user['iduser'];

$data_transaksi = query("SELECT * FROM transaksi_penjualan WHERE idpelanggan = '$iduser' ORDER BY tgl_transaksi DESC");
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
                    <h4 class="text-center fw-bold">RIWAYAT TRANSAKSI</h4>

                    <div class="mt-4 ">
                        <div class="row">
                            <div class="col-1">
                                <a href="../pelanggan/index.php" class="btn btn-outline-secondary">Kembali</a>
                            </div>
                            <div class="col-4">
                                <a class="btn btn-primary" href="../pelanggan/index.php">
                                    Buat Pesanan
                                </a>
                            </div>
                        </div>

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


                        <div class="mb-5 mt-5">
                            <table id="example" class="table table-hover text-center">
                                <thead>
                                    <tr class="table-secondary">
                                        <th class="text-center" scope="col">No</th>
                                        <th class="text-center" scope="col">Tanggal Transaksi</th>
                                        <th class="text-center" scope="col">Kode Transaksi</th>
                                        <th class="text-center" scope="col">Status</th>
                                        <th class="text-center" scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($data_transaksi as $transaksi):
                                        ?>
                                        <tr>
                                            <td>
                                                <?= $i; ?>
                                            </td>
                                            <td>
                                                <?= date("d-m-Y | H:i:s", strtotime($transaksi['tgl_transaksi'])); ?>
                                            </td>
                                            <td>
                                                <?= $transaksi['kode_transaksi']; ?>
                                            </td>
                                            <td>
                                                <?= $transaksi['status']; ?>
                                            </td>
                                            <td>
                                                <a href="../pelanggan/detail.php?id=<?= enkripsi($transaksi['idtransaksi']); ?>"
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
if (isset($_POST['submit']) || isset($_POST['delete'])) {

} else {
    $_SESSION = [];
    session_unset();
    session_destroy();
}
?>