<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <table border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>NIS</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Kelas</th>
                <th>Madin</th>
                <th>Foto</th>
                <th>#</th>
            </tr>
        </thead>

        <tbody>
            <?php
            include 'fungsi.php';
            $no = 1;
            $sql = mysqli_query($conn, "SELECT * FROM tb_santri WHERE aktif = 'Y' ");
            while ($r = mysqli_fetch_assoc($sql)) {
                $t = array('Bayar', 'Ust/Usdtz', 'Khaddam', 'Gratis', 'Berhenti');
            ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $r['nis'] ?></td>
                    <td><?= $r['nama'] ?></td>
                    <td><?= $r['desa'] . ' - ' . $r['kec'] . ' - ' . $r['kab'] ?></td>
                    <td><?= $r['k_formal'] . ' - ' . $r['t_formal'] ?></td>
                    <td><?= $r['k_madin'] . ' - ' . $r['r_madin'] ?></td>
                    <td><?= $r['foto'] !=  '' ? 'Ada Fotonya' : '' ?></td>
                    <td>
                        <a href="<?= 'cariFoto.php?nis=' . $r['nis'] ?>"><button class="btn btn-primary btn-minier">Cari</button></a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>

</html>