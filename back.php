<?php

include 'fungsi.php';

$nis = $_GET['nis'];

$sql = mysqli_query($conn, "UPDATE tb_santri SET aktif = 'Y' WHERE nis = '$nis' ");

if ($sql) {
    echo "
        <script>
            alert('Data sudah dipindah');
            window.location = 's_aktif.php';
        </script>
        ";
} else {
    echo "
        <script>
            alert('Gagal dipindah');
            window.location = 's_no.php';
        </script>
    ";
}
