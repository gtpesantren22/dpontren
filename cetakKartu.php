<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        table {
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }
    </style>
</head>

<body>
    <table>
        <tbody>
            <?php
            include 'fungsi.php';
            $jkl = $_GET['jkl'];
            $lembaga = $_GET['lembaga'];

            $counter = 0;
            $data = mysqli_query($conn, "SELECT * FROM tb_santri WHERE aktif = 'Y' AND t_formal = '$lembaga' AND jkl = '$jkl' ORDER BY k_formal ASC, jurusan ASC, r_formal ASC, nama ASC ");
            foreach ($data as $d) :
                $d['foto'] == '' ? $ft = 'https://psbtest.ppdwk.com/assets/img/foto-kosong.jpg' :  $ft = 'images/santri/' . $d['foto'];

                if ($counter % 2 === 0) {
                    // Baris baru dimulai
                    echo '<tr style="border-left: 3px solid blue; border-top: 3px solid blue; border-bottom: 3px solid blue;">';
                }
            ?>

                <td><img src="<?= $ft ?>" height="100"></td>
                <td><?= $d['nis'] ?><br>
                    <?= $d['nama'] ?><br>
                    <?= $d['k_formal'] . ' ' . $d['jurusan'] . ' ' . $d['r_formal'] . ' - ' . $d['t_formal'] ?><br>
                    <?= $d['tempat'] . ', ' . date('d-M-Y', strtotime($d['tanggal'])) ?><br>
                    <?= $d['desa'] . ' - ' . $d['kec'] . ' - ' . $d['kab'] ?>
                </td>

            <?php
                if ($counter % 2 === 1) {
                    // Akhir baris
                    echo '</tr>';
                }

                $counter++;
            endforeach;

            // Menutup baris terakhir jika jumlah data ganjil
            if ($counter % 2 === 1) {
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>

</body>

<script>
    window.print()
</script>

</html>