<?php 
    $conn = mysqli_connect("localhost","root","","inventory");

    if (mysqli_connect_errno()){
        echo "Gagal melakukan koneksi ke MySQL: " . mysqli_connect_error();
    }

    function query($query) {
        global $conn;
        $result = mysqli_query($conn, $query);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }

    function jumlah_data($data) {
        global $conn;
        $query = mysqli_query($conn, $data);

        $jumlah_data = mysqli_num_rows($query);

        return $jumlah_data;
    }

    function generateRandomKey()
    {
        $keyLength = 32;
        $randomBytes = openssl_random_pseudo_bytes($keyLength, $strong);
        
        if (!$strong) {
            $randomBytes = random_bytes($keyLength);
        }
        
        return base64_encode($randomBytes);
    }

    function enkripsi($kata)
    {
        $key = generateRandomKey();
        $string = openssl_encrypt($kata, 'AES-256-CBC', $key, 0, substr($key, 0, 16));
        $hasilEnkripsi = base64_encode($key . $string);
        
        return $hasilEnkripsi;
    }

    function dekripsi($kata)
    {
        $string = base64_decode($kata);
        $key = substr($string, 0, 44);
        $enkripsi = substr($string, 44);
        $hasil = openssl_decrypt($enkripsi, 'AES-256-CBC', $key, 0, substr($key, 0, 16));
        
        return $hasil;
    }

    function cari_user() {
        if (!isset($_COOKIE['SIIB'])) {
            echo "<script>
                    document.location.href='../logout.php';
                  </script>";
            exit;
        }
        
        $id = dekripsi($_COOKIE['SIIB']);
        
        $result = query("SELECT * FROM user WHERE iduser = '$id'");

        if(count($result) == 1) {
            $result = $result[0];
            return $result;
        } else {
            echo "<script>
                    document.location.href='../logout.php';
                  </script>";
            exit;
        }

    }

    
    function validasi() {
        $result = cari_user();
        
        if ($result['level'] != "User") {
            echo "<script>
                    document.location.href='../logout.php';
                  </script>";
            exit;
        }
    }

    function validasi_admin() {
        $result = cari_user();
        
        if ($result['level'] != "Admin") {
            echo "<script>
                    document.location.href='../logout.php';
                  </script>";
            exit;
        }
    }

    function validasi_pemasok() {
        $result = cari_user();
        
        if ($result['level'] != "Pemasok") {
            echo "<script>
                    document.location.href='../logout.php';
                  </script>";
            exit;
        }
    }

    function validasi_manajer() {
        $result = cari_user();
        
        if ($result['level'] != "Manajer") {
            echo "<script>
                    document.location.href='../logout.php';
                  </script>";
            exit;
        }
    }
?>