<?php
include 'fungsi.php';

$nis = $_GET['nis'];
$foto = $_GET['foto'];

$sql = mysqli_query($conn, "UPDATE tb_santri SET foto = '$foto' WHERE nis = '$nis' ");
if ($sql) {
    echo "<script>
            window.location='fotodata.php'
        </script>";
}
