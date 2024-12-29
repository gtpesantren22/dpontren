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
                <th>Lembaga</th>
                <th>Kelas</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include 'fungsi.php';
            $no = 1;
            $sql = mysqli_query($conn, "SELECT t_formal FROM tb_santri WHERE aktif = 'Y' GROUP BY t_formal ");
            while ($row = mysqli_fetch_object($sql)):
            ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row->t_formal ?></td>
                    <td>
                        <?php
                        $lembaga = mysqli_query($conn, "SELECT * FROM kl_formal WHERE lembaga = '$row->t_formal' ORDER BY nm_kelas ASC ");
                        while ($hasilMTs = mysqli_fetch_assoc($lembaga)) { ?>
                            <button onclick="window.location.href='<?= 'exportFoto.php?kls=' . $hasilMTs['nm_kelas'] ?>'"><?= $hasilMTs['nm_kelas'] ?></button>
                        <?php } ?>
                    </td>
                </tr>
            <?php endwhile ?>
        </tbody>
    </table>
</body>

</html>