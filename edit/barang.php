<?php 
    require_once '../controller/BarangController.php';

    if(isset($_GET['id'])) {
        $id = dekripsi($_GET['id']);

        $data = query("SELECT * FROM barang WHERE idbarang = '$id'");

        if(count($data) == 0) {
            echo "<script>
                    document.location.href='../admin/barang.php';
                </script>";
            exit;    
        } else {
            $data = $data[0];
            
            if(isset($_POST['submit'])) {
                $errors = update($_POST);

                if(is_numeric($errors)) {
                    if($errors > 0) {
                        $_SESSION["berhasil"] = "Data Barang Berhasil Diubah!";
                    } else {
                        $_SESSION["gagal"] = "Data Barang Gagal Diubah!";
                    }
                    echo "
                        <script>
                            document.location.href='../admin/barang.php';
                        </script>
                    ";
                }
            }

            if(isset($_POST['hapus_foto'])) {
                if(delete_foto($_POST) > 0 ) {
                    $_SESSION["berhasil"] = "Foto Berhasil Dihapus!";
                } else {
                    $_SESSION["gagal"] = "Foto Gagal Dihapus!";
                }

                header("Refresh:0");
            }
        }
    } else {
        echo "<script>
                document.location.href='../admin/barang.php';
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
                <div class="contents px-3 py-3">
                    <div class="box1">
                        <h5 class="text-dark text-center mb-0 ms-4 fw-bold">
                            <span style="color: rgb(72 60 60);">
                                Manajemen Data Barang /
                            </span>
                            <span> Edit Barang</span>
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

                    <form method="post" action="" enctype="multipart/form-data">
                        <input type="hidden" name="idbarang" value="<?= $data['idbarang']; ?>">
                        <input type="hidden" name="oldnama_barang" value="<?= $data['nama_barang']; ?>">
                        <input type="hidden" name="oldfoto" value="<?= $data['foto']; ?>">

                        <div class="mb-3 mt-3 row ms-5">
                            <label for="nama_barang" class="col-sm-2 me-0 col-form-label">Nama Barang :</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control <?= isset($errors['nama_barang']) ? "is-invalid" : ""; ?>" id="nama_barang" name="nama_barang" value="<?= isset($_POST['nama_barang']) ? $_POST['nama_barang'] : $data['nama_barang']; ?>">
                                <?php if(isset($errors['nama_barang'])) : ?>
                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                        <?= $errors['nama_barang']; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        <div class="mb-3 mt-3 row ms-5">
                            <label for="merk" class="col-sm-2 me-0 col-form-label">Merk Barang :</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control <?= isset($errors['merk']) ? "is-invalid" : ""; ?>" id="merk" name="merk" value="<?= isset($_POST['merk']) ? $_POST['merk'] : $data['merk']; ?>">
                                <?php if(isset($errors['merk'])) : ?>
                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                        <?= $errors['merk']; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="mb-3 mt-3 row ms-5">
                            <label for="kategori" class="col-sm-2 me-0 col-form-label">Kategori Barang
                                :</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control <?= isset($errors['kategori']) ? "is-invalid" : ""; ?>" id="kategori" name="kategori" value="<?= isset($_POST['kategori']) ? $_POST['kategori'] : $data['kategori']; ?>">
                                <?php if(isset($errors['kategori'])) : ?>
                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                        <?= $errors['kategori']; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="mb-3 mt-3 row ms-5">
                            <label for="gudang" class="col-sm-2 me-0 col-form-label">Gudang Barang :</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control <?= isset($errors['gudang']) ? "is-invalid" : ""; ?>" id="gudang" name="gudang" value="<?= isset($_POST['gudang']) ? $_POST['gudang'] : $data['gudang']; ?>">
                                <?php if(isset($errors['gudang'])) : ?>
                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                        <?= $errors['gudang']; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="mb-3 mt-3 row ms-5">
                            <label for="rak" class="col-sm-2 me-0 col-form-label">Rak Barang :</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control <?= isset($errors['rak']) ? "is-invalid" : ""; ?>" id="rak" name="rak" value="<?= isset($_POST['rak']) ? $_POST['rak'] : $data['rak']; ?>">
                                <?php if(isset($errors['rak'])) : ?>
                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                        <?= $errors['rak']; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="mb-3 mt-3 row ms-5">
                            <label for="stok" class="col-sm-2 me-0 col-form-label">Stok Barang :</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control <?= isset($errors['stok']) ? "is-invalid" : ""; ?>" id="stok" name="stok" value="<?= isset($_POST['stok']) ? $_POST['stok'] : $data['stok']; ?>">
                                <?php if(isset($errors['stok'])) : ?>
                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                        <?= $errors['stok']; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="mb-3 mt-3 row ms-5">
                            <label for="satuan" class="col-sm-2 me-0 col-form-label">Satuan :</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control <?= isset($errors['satuan']) ? "is-invalid" : ""; ?>" id="satuan" name="satuan" value="<?= isset($_POST['satuan']) ? $_POST['satuan'] : $data['satuan']; ?>">
                                <?php if(isset($errors['satuan'])) : ?>
                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                        <?= $errors['satuan']; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="mb-3 mt-3 row ms-5">
                            <label for="harga" class="col-sm-2 me-0 col-form-label">Harga Satuan :</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control <?= isset($errors['harga']) ? "is-invalid" : ""; ?>" id="harga" name="harga" value="<?= isset($_POST['harga']) ? $_POST['harga'] : $data['harga']; ?>">
                                <?php if(isset($errors['harga'])) : ?>
                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                        <?= $errors['harga']; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="mb-3 mt-3 row ms-5">
                            <label for="keterangan" class="col-sm-2 me-0 col-form-label">Keterangan Barang:</label>
                            <div class="col-sm-8">
                                <textarea <?= isset($errors['keterangan']) ? '' : 'style="border: 1px solid black;"'; ?> class="form-control <?= isset($errors['keterangan']) ? 'is-invalid' : ''; ?>" id="keterangan" name="keterangan" rows="2"><?= isset($_POST['keterangan']) ? $_POST['keterangan'] : $data['keterangan']; ?></textarea>
                                <?php if(isset($errors['keterangan'])) : ?>
                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                        <?= $errors['keterangan']; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="mb-3 mt-3 row ms-5">
                            <label class="col-form-label">Foto Barang :</label>
                            <div class="col-sm-2">
                                <img src="../img/barang/<?= $data['foto']; ?>" class="img-preview" style="width: 70px;">
                            </div>
                            <div class="col-sm-8">
                                <?php if($data['foto'] != "default.png") : ?>
                                    <button type="button" class="btn btn-sm btn-outline-danger" id="delete" data-bs-toggle="modal" data-bs-target="#exampleModal">Hapus Foto</button>
                                <?php endif; ?>
                                <div class="input-group mb-3">
                                    <input type="file" class="form-control <?= isset($errors['foto']) ? 'is-invalid' : ''; ?>" <?= isset($errors['foto']) ? '' : 'style="border: 1px solid black;"'; ?> id="foto" name="foto" onchange="previewImg()">
                                    <?php if(isset($errors['foto'])) : ?>
                                        <div id="validationServer03Feedback" class="invalid-feedback">
                                            <?= $errors['foto']; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>


                        <div class="d-flex justify-content-end me-5">
                            <a class="btn btn-secondary mt-3 px-4 me-3" style="border-radius: 15px;"
                                href="../admin/barang.php">Kembali</a>
                            <button type="submit" class="btn btn-primary mt-3 px-4"
                                style="border-radius: 15px;" name="submit">Update</button>
                        </div>
                    </form>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Hapus Foto</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Yakin ingin menghapus foto?
                                </div>
                                <div class="modal-footer">
                                    <form action="" method="post">
                                        <input type="hidden" name="idbarang" value="<?= $data['idbarang']; ?>">
                                        <input type="hidden" name="foto" value="<?= $data['foto']; ?>">

                                        <button type="submit" class="btn btn-danger" name="hapus_foto">Hapus</button>
                                    </form>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- konten selesai -->

        </div>


    </div>

    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>

    <script>
      function previewImg() {
        const sampul = document.querySelector('#foto');
        const imgPreview = document.querySelector('.img-preview');

        const fileSampul = new FileReader();
        fileSampul.readAsDataURL(sampul.files[0]);

        fileSampul.onload = function(e) {
          imgPreview.src = e.target.result;
        }
      }
    </script>
</body>

</html>

<?php 
    if(isset($_POST['submit']) || isset($_POST['hapus_foto'])) {
        
    } else {
        $_SESSION = [];
        session_unset();
        session_destroy();
    }
?>