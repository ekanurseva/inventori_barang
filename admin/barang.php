<?php 
    require_once '../controller/BarangController.php';

    $data_barang = query("SELECT * FROM barang");

    if(isset($_POST['idbarang'])) {
        if(delete($_POST) > 0 ) {
            $_SESSION["berhasil"] = "Barang Berhasil Dihapus!";
            
        } else {
            $_SESSION["gagal"] = "Barang Gagal Dihapus!";
        }
        echo "
            <script>
                document.location.href='barang.php';
            </script>
        ";
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
                        <h5 class="text-dark text-center mb-0 ms-4 fw-bold">
                            Manajemen Data Barang
                        </h5>
                    </div>

                    <div class="mt-4 ">
                        <div class="row">
                            <div class="col-sm-3">
                                <a class="btn btn-primary" href="../insert/barang.php">Tambah Data Barang</a>
                            </div>
                            <!-- <div class="col-sm-4">
                                <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                    data-bs-target="#bahan_baku">
                                    Tambah Bahan Baku
                                </button>
                            </div> -->
                        </div>
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

                    <div class="mt-4 box3">
                        <h4 class="text-center">Tabel Barang</h4>
                        <hr>
                        <table id="example" class="table table-hover text-center">
                            <thead>
                                <tr class="table-secondary">
                                    <th class="text-center" scope="col">No</th>
                                    <th class="text-center" scope="col">Nama Barang</th>
                                    <th class="text-center" scope="col">Kategori</th>
                                    <th class="text-center" scope="col">Merk</th>
                                    <th class="text-center" scope="col">Stok</th>
                                    <th class="text-center" scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $i = 1;
                                    foreach($data_barang as $barang) :
                                ?>
                                    <tr>
                                        <td>
                                            <?= $i; ?>
                                        </td>
                                        <td>
                                            <?= $barang['nama_barang']; ?>
                                        </td>
                                        <td>
                                            <?= $barang['kategori']; ?>
                                        </td>
                                        <td>
                                            <?= $barang['merk']; ?>
                                        </td>
                                        <td>
                                            <?= $barang['stok']; ?> <?= $barang['satuan']; ?>
                                        </td>

                                        <td>
                                            <a class="text-decoration-none" href="../edit/barang.php?id=<?= enkripsi($barang['idbarang']); ?>">
                                                <button class="btn btn-primary"><i class="bi bi-pencil-fill"></i></button>
                                            </a>
                                            |
                                            <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                                data-bs-target="#detail_barang_<?= $barang['idbarang']; ?>">
                                                <i class="bi bi-info-lg"></i>
                                            </button>
                                            |
                                            <button type="button" class="btn  btn-danger" id="delete" data-bs-toggle="modal" data-bs-target="#delete_<?= $barang['idbarang']; ?>">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
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

                <!-- Modal -->
                <?php foreach($data_barang as $dabar) : ?>
                    <div class="modal fade" id="detail_barang_<?= $dabar['idbarang']; ?>" data-bs-backdrop="static" data-bs-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content p-3">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">
                                        Informasi <?= $dabar['nama_barang']; ?>
                                    </h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-sm-3 text-center">
                                            <img src="../img/barang/<?= $dabar['foto']; ?>" class="img-preview" style="width: 130px;">
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="row m-0 p-0">
                                                <div class="col-sm-4">
                                                    <h6>Kategori</h6>
                                                </div>
                                                <div class="col-sm-8">
                                                    <h7>: <?= $dabar['kategori']; ?></h7>
                                                </div>

                                                <div class="col-sm-4">
                                                    <h6>Merk</h6>
                                                </div>
                                                <div class="col-sm-8">
                                                    <h7>: <?= $dabar['merk']; ?></h7>
                                                </div>

                                                <div class="col-sm-4">
                                                    <h6>Gudang</h6>
                                                </div>
                                                <div class="col-sm-8">
                                                    <h7>: <?= $dabar['gudang']; ?></h7>
                                                </div>

                                                <div class="col-sm-4">
                                                    <h6>Rak</h6>
                                                </div>
                                                <div class="col-sm-8">
                                                    <h7>: <?= $dabar['rak']; ?></h7>
                                                </div>

                                                <div class="col-sm-4">
                                                    <h6>Stok</h6>
                                                </div>
                                                <div class="col-sm-8">
                                                    <h7>: <?= $dabar['stok']; ?> <?= $dabar['satuan']; ?></h7>
                                                </div>

                                                <div class="col-sm-4">
                                                    <h6>Harga Satuan</h6>
                                                </div>
                                                <div class="col-sm-8">
                                                    <h7>: Rp. <?= number_format($dabar['harga'], 0 , ',' , '.'); ?></h7>
                                                </div>

                                                <div class="col-sm-4">
                                                    <h6>Keterangan</h6>
                                                </div>
                                                <div class="col-sm-8">
                                                    <?php if($dabar['keterangan'] == "" || $dabar['keterangan'] == null) : ?>
                                                        <h7>: -</h7>
                                                    <?php else : ?> 
                                                        <h7>: <?= $dabar['keterangan']; ?></h7>
                                                    <?php endif; ?> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="delete_<?= $dabar['idbarang']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Hapus Barang</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Yakin ingin menghapus data barang?
                                    </div>
                                    <div class="modal-footer">
                                        <form action="" method="post">
                                            <input type="hidden" name="idbarang" value="<?= $dabar['idbarang']; ?>">
                                            <input type="hidden" name="foto" value="<?= $dabar['foto']; ?>">

                                            <button type="submit" class="btn btn-danger" name="hapus_foto">Hapus</button>
                                        </form>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
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
    if(!isset($_POST['idbarang'])) {
        $_SESSION = [];
        session_unset();
        session_destroy();
    }
?>