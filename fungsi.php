<?php

$conn = mysqli_connect("localhost", "root", "", "db_santri");
$conn2 = mysqli_connect("localhost", "root", "", "psb24");
$conn_info = mysqli_connect("localhost", "root", "", "db_info");

// $conn = mysqli_connect("localhost", "u9048253_dwk", "PesantrenDWKIT2021", "u9048253_santri");
// $conn2 = mysqli_connect("localhost", "u9048253_dwk", "PesantrenDWKIT2021", "u9048253_psb24");
// $conn_info = mysqli_connect("localhost", "u9048253_dwk", "PesantrenDWKIT2021", "u9048253_info");

$t = array('Bayar', 'Ust/Usdtz', 'Khaddam', 'Gratis', 'Berhenti');
$tl = array('', 'MTs', 'SMP', 'MA', 'SMK');

$bulan = array('', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
// ok