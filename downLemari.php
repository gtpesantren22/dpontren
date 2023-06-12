<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <?php
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=Data Lemari " . $_GET['jk'] . ".xls");
    ?>
</head>

<body>
    <h3>Data Lemari</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Komplek</th>
                <th>Kamar</th>
                <th>Lemari</th>
                <th>Loker</th>
                <th>Wali Asuh</th>
                <th>Ket</th>
                <th>Pemilik</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include 'fungsi.php';
            $no = 1;
            $jkl = $_GET['jk'];
            $sql = mysqli_query($conn, "SELECT * FROM lemari_data WHERE jkl = '$jkl' ORDER BY komplek ASC, kamar ASC, lemari ASC, loker ASC ");
            foreach ($sql as $row) :
                $nis = $row['nis'];
                if ($nis != '') {
                    $nm = mysqli_fetch_assoc(mysqli_query($conn, "SELECT nama FROM tb_santri WHERE nis = $nis "));
                    $isi = $nm['nama'];
                } else {
                    $isi = 'Lemari Kosong';
                }
            ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row['komplek'] ?></td>
                    <td><?= $row['kamar'] ?></td>
                    <td><?= $row['lemari'] ?></td>
                    <td><?= $row['loker'] ?></td>
                    <td><?= $row['wali'] ?></td>
                    <td><?= $row['ket'] ?></td>
                    <td><?= $isi ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>