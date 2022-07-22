<?php
require "Excel.class.php";

#koneksi ke mysql
//$mysqli = new mysqli("localhost", "root", "", "psb21");
//$mysqli = new mysqli("localhost", "root", "", "db_new");
$mysqli = mysqli_connect("localhost", "u9048253_dwk", "PesantrenDWKIT2021", "u9048253_santri");

if ($mysqli->connect_error) {
	die('Connect Error (' . $mysqli->connect_error . ') ');
}
#akhir koneksi

#ambil data
$query = "SELECT id, nis, nik, no_kk, nama, tempat, tanggal, jkl, desa, kec, kab, prov, k_formal, t_formal, 
k_madin, r_madin, komplek, kamar, bapak, ibu, hp, pass, foto, stts, t_kos, ket FROM tb_santri WHERE aktif = 'Y' AND stts != '' ORDER BY kamar,komplek";

$sql = $mysqli->query($query);
$arrmhs = array();
while ($row = $sql->fetch_assoc()) {
	array_push($arrmhs, $row);
}
#akhir data

$excel = new Excel();
#Send Header
$excel->setHeader('Data Satri Baru 2021.xls');
#$excel->EX();
$excel->BOF();

#header tabel

$excel->writeLabel(0, 0, "ID");
$excel->writeLabel(0, 1, "NIS");
$excel->writeLabel(0, 2, "NIK");
$excel->writeLabel(0, 3, "NO KK");
$excel->writeLabel(0, 4, "NAMA");
$excel->writeLabel(0, 5, "TMP LAHIR");
$excel->writeLabel(0, 6, "TGL LAHIR");
$excel->writeLabel(0, 7, "JKL");
$excel->writeLabel(0, 8, "DESA");
$excel->writeLabel(0, 9, "KEC");
$excel->writeLabel(0, 10, "KAB");
$excel->writeLabel(0, 11, "PROV");
$excel->writeLabel(0, 12, "KLS FORML");
$excel->writeLabel(0, 13, "TING F");
$excel->writeLabel(0, 14, "KLS MADIN");
$excel->writeLabel(0, 15, "RM MADIN");
$excel->writeLabel(0, 16, "KOMPLEK");
$excel->writeLabel(0, 17, "KAMAR");
$excel->writeLabel(0, 18, "NAMA AYAH");
$excel->writeLabel(0, 19, "NAMA IBU");
$excel->writeLabel(0, 20, "HP");
$excel->writeLabel(0, 21, "PASS");
$excel->writeLabel(0, 22, "FOTO");
$excel->writeLabel(0, 23, "STTS");
$excel->writeLabel(0, 24, "T KOS");
$excel->writeLabel(0, 25, "KET");

// $excel->writeLabel(0, 0, "ID");
// $excel->writeLabel(0, 1, "NAMA");
// $excel->writeLabel(0, 2, "NOMOR");

#isi data
$i = 1;
foreach ($arrmhs as $baris) {
	$j = 0;
	foreach ($baris as $value) {
		$excel->writeLabel($i, $j, $value);
		$j++;
	}
	$i++;
}

$excel->EOF();

exit();