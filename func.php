<?php

$conn = mysqli_connect("localhost", "root", "", "db_santri");
$conn2 = mysqli_connect("localhost", "root", "", "psb22");

// $conn = mysqli_connect("localhost", "u9048253_dwk", "PesantrenDWKIT2021", "u9048253_santri");
// $conn2 = mysqli_connect("localhost", "u9048253_dwk", "PesantrenDWKIT2021", "u9048253_psb22");

$t = array('Bayar', 'Ust/Usdtz', 'Khaddam', 'Gratis', 'Berhenti');
$tl = array('', 'MTs', 'SMP', 'MA', 'SMK');

// ok
