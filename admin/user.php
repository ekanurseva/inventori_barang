<?php 
    require_once '../controller/UserController.php';

    $data_user = query("SELECT * FROM user");

    if(isset($_POST['iduser'])) {
        if(delete($_POST) > 0 ) {
            $_SESSION["berhasil"] = "User Berhasil Dihapus!";
        } else {
            $_SESSION["gagal"] = "User Gagal Dihapus!";
        }
        echo "
            <script>
                document.location.href='user.php';
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
                        <h5 class="text-dark mb-0 ms-4 text-center fw-bold">
                            Manajemen User
                        </h5>
                    </div>

                    <div class="mt-4 ">
                        <a class="btn btn-primary" href="../insert/user.php">Tambah Data</a>
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

                    <div class="mt-4">
                        <table id="example" class="table table-hover text-center">
                            <thead>
                                <tr class="table-secondary">
                                    <th class="text-center" scope="col">No</th>
                                    <th class="text-center" scope="col">Nama</th>
                                    <th class="text-center" scope="col">Username</th>
                                    <th class="text-center" scope="col">No Handphone</th>
                                    <th class="text-center" scope="col">Email</th>
                                    <th class="text-center" scope="col">Level</th>
                                    <th class="text-center" scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $i = 1;
                                    foreach($data_user as $daus) :
                                ?>
                                    <tr>
                                        <td>
                                            <?= $i; ?>
                                        </td>
                                        <td>
                                            <?= $daus['nama']; ?>
                                        </td>
                                        <td>
                                            <?= $daus['username']; ?>
                                        </td>
                                        <td>
                                            <?= $daus['telepon']; ?>
                                        </td>
                                        <td>
                                            <?= $daus['email']; ?>
                                        </td>
                                        <td>
                                            <?= $daus['level']; ?>
                                        </td>
                                        <td>
                                            <a href="../edit/user.php?id=<?= enkripsi($daus['iduser']); ?>" class="btn btn-sm btn-primary">
                                                <i class="bi bi-pencil-fill"></i>
                                            </a>
                                            |
                                            <button type="button" class="btn  btn-danger btn-sm" id="delete" data-bs-toggle="modal" data-bs-target="#delete_<?= $daus['iduser']; ?>">
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

                    <?php foreach($data_user as $du) : ?>
                        <!-- Modal -->
                        <div class="modal fade" id="delete_<?= $du['iduser']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Hapus User</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Yakin ingin menghapus data user?
                                    </div>
                                    <div class="modal-footer">
                                        <form action="" method="post">
                                            <input type="hidden" name="iduser" value="<?= $du['iduser']; ?>">
                                            <input type="hidden" name="foto" value="<?= $du['foto']; ?>">

                                            <button type="submit" class="btn btn-danger" name="hapus_foto">Hapus</button>
                                        </form>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
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
    if(!isset($_POST['iduser'])) {
        $_SESSION = [];
        session_unset();
        session_destroy();
    }
?>