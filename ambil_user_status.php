<?php
session_start();
include('fungsi.php');
// $uid = $_SESSION['UID'];
$time = time();
$res = mysqli_query($conn, "SELECT * FROM log_santri a JOIN tb_santri b ON a.nis=b.nis WHERE b.aktif = 'Y' ");
$i = 1;
$html = '';
while ($row = mysqli_fetch_assoc($res)) {
	$status = 'Offline';
	$class = "btn-danger";
	if ($row['last_login'] > $time) {
		$status = 'Online';
		$class = "btn-success";
	}
	$html .= '<tr>
                  <th scope="row">' . $i . '</th>
                  <td>' . $row['nama'] . '</td>
                  <td>' . $row['desa'] . ' - ' . $row['kec'] . ' - ' . $row['kab'] . '</td>
                  <td><button type="button" class="btn btn-sm ' . $class . '">' . $status . '</button></td>
               </tr>';
	$i++;
}
echo $html;
