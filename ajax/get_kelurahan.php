<?php
include '../fungsi.php';
$kecamatan = $_POST['kecamatan'];

echo "<option value=''>Pilih Kelurahan</option>";

$query = "SELECT * FROM kelurahan WHERE id_kec=? ORDER BY nama ASC";
$dewan1 = $conn->prepare($query);
$dewan1->bind_param("s", $kecamatan);
$dewan1->execute();
$res1 = $dewan1->get_result();
while ($row = $res1->fetch_assoc()) {
	echo "<option value='" . $row['id_kel'] . "'>" . $row['nama'] . "</option>";
}
?>
<!-- OK -->