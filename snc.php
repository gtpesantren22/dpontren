<?php

$tj = $_POST['tujuan'];
$data = $_POST['data'];
$tgl = date('d-m-Y H:i');


$dbes = "db_" . $tj;
$dbu = 'db_santri';
$conn = mysqli_connect("localhost", "root", "", "db_santri");
$conn2 = mysqli_connect("localhost", "root", "", "$dbes");

// $dbes = "u9048253_" . $tj;
// $dbu = 'u9048253_santri';
// $conn = mysqli_connect("localhost", "u9048253_dwk", "PesantrenDWKIT2021", "u9048253_santri");
// $conn2 = mysqli_connect("localhost", "u9048253_dwk", "PesantrenDWKIT2021", "$dbes");

$s1 = mysqli_query($conn2, "TRUNCATE TABLE $data");
$s2 = mysqli_query($conn2, "CREATE TABLE $dbes.$data SELECT * FROM $dbu.$data");
$s3 = mysqli_query($conn, "INSERT INTO snkr VALUES('', '$tj', '$data', '$tgl') ");

if ($s1 && $s2 && $s3) {
    echo "
        <script>
        alert('Sinkronisasi data behasil');
        window.location.href = 'snkr.php';
        </script>
        ";
} else {
    echo "
        <script>
        alert('Sinkronisasi Gagal');
        window.location.href = 'snkr.php';
        </script>
        ";
}
