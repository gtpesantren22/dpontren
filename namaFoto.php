<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export Foto</title>

    <style>
        table {
            border-collapse: collapse;
            /* Menggabungkan border antara sel */
            width: 100%;
            /* Mengatur lebar tabel */
            margin: 20px 0;
            /* Memberikan margin atas dan bawah */
            font-size: 16px;
            /* Ukuran font */
            text-align: left;
            /* Rata teks ke kiri */
            /
        }

        th,
        td {
            border: 1px solid #ddd;
            /* Border pada setiap sel */
            padding: 8px;
            /* Jarak isi sel dengan border */
        }

        th {
            background-color: #f4f4f4;
            /* Warna latar belakang header tabel */
            color: #333;
            /* Warna teks header */
            font-weight: bold;
            /* Teks tebal */
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
            /* Warna untuk baris genap */
        }

        tr:hover {
            background-color: #f1f1f1;
            /* Warna saat baris di-hover */
        }
    </style>
</head>
<?php
$kks = $_GET['kls'];
$kls = explode('-', $kks);
$kelas = $kls[0];
$jurusan = $kls[1];
$rombel = $kls[2];
$lembaga = $kls[3];
?>

<body>
    Download Foto --> <button onclick="window.location.href='<?= 'exportFoto.php?kls=' . $kks ?>'"><?= $kks ?></button><br>
    <table>
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
            </tr>
        </thead>
        <tbody>
            <?php
            include 'fungsi.php';
            $no = 1;

            $sql = mysqli_query($conn, "SELECT * FROM tb_santri WHERE aktif = 'Y' AND t_formal = '$lembaga' AND k_formal = '$kelas' AND r_formal = '$rombel' AND jurusan = '$jurusan' ");
            while ($row = mysqli_fetch_object($sql)):
            ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row->nis ?></td>
                    <td><?= $row->nisn ?></td>
                    <td><?= $row->nama ?></td>
                    <td><?= $row->tempat ?></td>
                    <td><?= $row->tanggal ?></td>
                    <td><?= $row->desa . ' - ' . $row->kec . ' - ' . $row->kab ?></td>
                    <td><?= $row->k_formal . ' - ' . $row->t_formal ?></td>
                </tr>
            <?php endwhile ?>
        </tbody>
    </table>
</body>

</html>