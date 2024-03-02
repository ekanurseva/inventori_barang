<?php 
    require_once 'controller/MainController.php';

    if(isset($_COOKIE['SIIB'])) {
        $user = cari_user();

        if($user['level'] == "User") {
            echo "<script>
                    document.location.href='pelanggan/index.php';
                </script>";
        } elseif($user['level'] == "Admin") {
            echo "<script>
                    document.location.href='admin/index.php';
                </script>";
        } elseif($user['level'] == "Pemasok") {
            echo "<script>
                    document.location.href='pemasok/index.php';
                </script>";
        } elseif($user['level'] == "Manajer") {
            echo "<script>
                    document.location.href='manajer/index.php';
                </script>";
        }
    } else {
        echo "<script>
                document.location.href='logout.php';
            </script>";
        exit;
    }
?>