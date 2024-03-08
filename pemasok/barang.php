<?php 
    require_once '../controller/BahanPemasokController.php';
    validasi_pemasok();

    if(isset($_POST['submit'])) {
        $errors = create($_POST);
        if(is_numeric($errors)) {
            if($errors > 0) {
                $_SESSION["berhasil"] = "Data Bahan Baku Berhasil Ditambah!";
            } else {
                $_SESSION["gagal"] = "Data Bahan Baku Gagal Ditambah!";
            }
            header("Refresh:0");
        } else {
            $_SESSION["error"] = "Terdapat data yang tidak valid, silahkan cek kembali form tambah bahan baku!";
        }
    }

    if(isset($_POST['delete'])) {
        if(delete($_POST) > 0 ) {
            $_SESSION["berhasil"] = "Bahan Baku Berhasil Dihapus!";
        } else {
            $_SESSION["gagal"] = "Bahan Baku Gagal Dihapus!";
        }
        header("Refresh:0");
    }

    $data_bahan = query("SELECT * FROM bahan_pemasok");
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
                        <h5 class="text-dark text-center mb-0 ms-4 fw-bold">
                            Manajemen Data Barang
                        </h5>
                    </div>

                    <div class="mt-4 ">
                        <div class="row">
                            <div class="col-1">
                                <a href="index.php" class="btn btn-outline-secondary">Kembali</a>
                            </div>
                            <div class="col-4">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#bahan_baku">
                                    Tambah Bahan Baku
                                </button>
                            </div>
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
                    <?php elseif(isset($_SESSION['error'])) : ?>
                        <div class="my-3">
                            <div class="alert alert-warning" role="alert">
                                <i class="bi bi-exclamation-triangle"></i> <?= $_SESSION['error']; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="mt-3 box3">
                        <table id="example" class="table table-hover text-center">
                            <thead>
                                <tr class="table-secondary">
                                    <th class="text-center" scope="col">No</th>
                                    <th class="text-center" scope="col">Nama Barang</th>
                                    <th class="text-center" scope="col">Stok</th>
                                    <th class="text-center" scope="col">Harga</th>
                                    <th class="text-center" scope="col">Aksi</th>
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
                                            Rp <?= number_format($bahan['harga'], 0, ',', '.'); ?>
                                        </td>
                                        <td>
                                            <a class="text-decoration-none" href="../edit/bahan_baku.php?id=<?= enkripsi($bahan['idbahan']); ?>">
                                                <button class="btn btn-primary"><i class="bi bi-pencil-fill"></i></button>
                                            </a>
                                            |
                                            <button type="button" class="btn  btn-danger" id="delete" data-bs-toggle="modal" data-bs-target="#delete_<?= $bahan['idbahan']; ?>">
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

                <!-- Modal Bahan Baku -->
                <div class="modal fade" id="bahan_baku" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5 text-dark" id="bahan_baku">Tambah Barang</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                            </div>
                                <form method="post">
                                    <input type="hidden" name="idpemasok" value="<?= $user['iduser']; ?>">
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="nama_bahan" class="form-label">Barang :</label>
                                            <input type="text" class="form-control <?= isset($errors['nama_bahan']) ? 'is-invalid' : ''; ?>" <?= isset($errors['nama_bahan']) ? '' : 'style="border: 1px black solid"'; ?> 
                                                name="nama_bahan" id="nama_bahan" placeholder="masukkan barang" value="<?= isset($_POST['nama_bahan']) ? $_POST['nama_bahan'] : ''; ?>">
                                            <?php if(isset($errors['nama_bahan'])) : ?>
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    <?= $errors['nama_bahan']; ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="mb-3">
                                            <label for="stok" class="form-label">Stok :</label>
                                            <input type="number" class="form-control <?= isset($errors['stok']) ? 'is-invalid' : ''; ?>" <?= isset($errors['stok']) ? '' : 'style="border: 1px black solid"'; ?>
                                                name="stok" id="stok" placeholder="masukkan jumlah stok" value="<?= isset($_POST['stok']) ? $_POST['stok'] : ''; ?>">
                                            <?php if(isset($errors['stok'])) : ?>
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    <?= $errors['stok']; ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="mb-3">
                                            <label for="satuan" class="form-label">Satuan :</label>
                                            <input type="text" class="form-control <?= isset($errors['satuan']) ? 'is-invalid' : ''; ?>" <?= isset($errors['satuan']) ? '' : 'style="border: 1px black solid"'; ?>
                                                name="satuan" id="satuan" placeholder="masukkan satuan barang" value="<?= isset($_POST['satuan']) ? $_POST['satuan'] : ''; ?>">
                                            <?php if(isset($errors['satuan'])) : ?>
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    <?= $errors['satuan']; ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="mb-3">
                                            <label for="harga" class="form-label">Harga :</label>
                                            <input type="number" class="form-control <?= isset($errors['harga']) ? 'is-invalid' : ''; ?>" <?= isset($errors['harga']) ? '' : 'style="border: 1px black solid"'; ?>
                                                name="harga" id="harga" placeholder="masukkan harga barang" value="<?= isset($_POST['harga']) ? $_POST['harga'] : ''; ?>">
                                            <?php if(isset($errors['harga'])) : ?>
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    <?= $errors['harga']; ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Kembali</button>
                                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <!-- Modal Bahan Baku Selesai -->


                <?php foreach($data_bahan as $dahan) : ?>
                    <div class="modal fade" id="delete_<?= $dahan['idbahan']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Hapus Bahan Baku</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Yakin ingin menghapus data bahan baku?
                                    </div>
                                    <div class="modal-footer">
                                        <form action="" method="post">
                                            <input type="hidden" name="idbahan" value="<?= $dahan['idbahan']; ?>">

                                            <button type="submit" class="btn btn-danger" name="delete">Hapus</button>
                                        </form>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>


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
    if(isset($_POST['submit']) || isset($_POST['delete'])) {
        
    } else {
        $_SESSION = [];
        session_unset();
        session_destroy();
    }
?>