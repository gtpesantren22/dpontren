<?php
include '../fungsi.php';

echo "<option value=''>Pilih Provinsi</option>";

$query = "SELECT * FROM provinsi ORDER BY nama ASC";
$dewan1 = $conn->prepare($query);
$dewan1->execute();
$res1 = $dewan1->get_result();
while ($row = $res1->fetch_assoc()) {
	echo "<option value='" . $row['id_prov'] . "'>" . $row['nama'] . "</option>";
}
?>
<!-- OK -->