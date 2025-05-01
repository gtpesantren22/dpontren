<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export Berkas PSB</title>

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

<body>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>JKL</th>
                <th>Lembaga</th>
                <th>Ket</th>
                <th>#</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include 'fungsi.php';
            $no = 1;
            $sql = mysqli_query($conn_psb, "SELECT * FROM tb_santri WHERE nis != 0 ORDER BY nama ASC ");
            while ($row = mysqli_fetch_object($sql)):
            ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row->nama ?></td>
                    <td><?= $row->desa ?></td>
                    <td><?= $row->jkl ?></td>
                    <td><?= $row->lembaga ?></td>
                    <td><?= $row->ket ?></td>
                    <td>
                        <button onclick="window.location.href='<?= 'exportBerkas.php?nis=' . $row->nis ?>'">Download Berkas</button>
                    </td>
                </tr>
            <?php endwhile ?>
        </tbody>
    </table>
</body>

</html>