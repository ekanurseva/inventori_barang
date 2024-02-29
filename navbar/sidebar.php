<?php 
    validasi_admin();
?>

<div class="sidebar" id="side_nav">
    <!--PROFIL-->
    <div class="content-side">
        <div class="profil pt-3">
            <div class="row d-flex align-items-center">
                <div class="col-sm-5 me-0">
                    <img src="../img/profil/<?= $user['foto']; ?>" class="rounded-circle" alt="profi">
                    <a href="../admin/profil.php">
                        <button class="rounded-circle"><i class="bi bi-pencil-fill"></i></button>
                    </a>
                </div>
                <div class="col-sm-7 text-white p-0 m-0">
                    <h6 class="fw-bold">
                        <?= $user['nama']; ?>
                    </h6>
                </div>
            </div>
        </div>
        <!--PROFIL SELESAI-->

        <!-- menu -->
        <div class="">
            <ul class="list-unstyled pt-3 fw-medium">
                <li class="">
                    <a href="../admin/barang.php" class="text-decoration-none d-block">
                        <span>Manajemen Barang</span>
                    </a>
                </li>
                <li class="">
                    <a href="../admin/barang_masuk.php" class="text-decoration-none d-block">
                        <span>Manajemen Barang Masuk</span>
                    </a>
                </li>
                <li class="">
                    <a href="../admin/barang_keluar.php" class="text-decoration-none d-block">
                        <span>Manajemen Barang Keluar</span>
                    </a>
                </li>
                <li class="">
                    <a href="../admin/laporan.php" class="text-decoration-none d-block">
                        <span>Manajemen Laporan</span>
                    </a>
                </li>
                <li class="">
                    <a href="../admin/transaksi.php" class="text-decoration-none d-block">
                        <span>Transaksi Permintaan Barang</span>
                    </a>
                </li>
                <li class="">
                    <a href="../admin/transaksi_pesan.php" class="text-decoration-none d-block">
                        <span>Transaksi Pesanan</span>
                    </a>
                </li>
                <li class="">
                    <a href="../admin/user.php" class="text-decoration-none d-block">
                        <span>Manajemen User</span>
                    </a>
                </li>
                <li class="">
                    <a href="../admin/pemasok.php" class="text-decoration-none d-block">
                        <span>Manajemen Pemasok</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>