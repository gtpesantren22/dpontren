<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export Foto</title>
</head>


<body>

    <table border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>NIS</th>
                <th>NISN</th>
                <th>Nama</th>
                <th>Tmp Lahir</th>
                <th>Tgl Lahir</th>
                <th>Alamat</th>
                <th>Kelas</th>
                <th>ID</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include 'fungsi.php';
            $no = 1;

            $sql = mysqli_query($conn, "SELECT * FROM cetak_kartu");
            while ($row = mysqli_fetch_object($sql)):
                $ID = getID($row->nama);
            ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row->nis ?></td>
                    <td><?= $row->nisn ?></td>
                    <td><?= $row->nama ?></td>
                    <td><?= $row->tempat ?></td>
                    <td><?= $row->tanggal ?></td>
                    <td><?= $row->alamat ?></td>
                    <td><?= $row->kelas ?></td>
                    <td><?php
                        if (isset($ID['data']['data'][0]['peserta_didik_id']) && !empty($ID['data']['data'][0]['peserta_didik_id'])) {
                            // echo "<pre>";
                            print_r($ID['data']['data'][0]['peserta_didik_id']);
                            // echo "</pre>";
                        } else {
                            echo "Kosong. Catat tanyakn ke ghule";
                        }
                        ?>
                    </td>
                </tr>
            <?php endwhile ?>
        </tbody>
    </table>
</body>

</html>