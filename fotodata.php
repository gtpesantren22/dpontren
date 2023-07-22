<?php
function searchPhotoByNIM($directory, $nim)
{
    $files = scandir($directory);
    $matchingFiles = [];

    // Loop melalui setiap file dalam direktori
    foreach ($files as $file) {
        // Melewati direktori "." dan ".."
        if ($file === '.' || $file === '..') continue;

        // Jika nama file berisi NIM yang dicari
        if (strpos($file, $nim) === 0) {
            $matchingFiles[] = $file;
        }
    }

    return $matchingFiles;
}

?>
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
                <th>Cek</th>
                <th>#</th>
            </tr>
        </thead>

        <tbody>
            <?php
            include 'fungsi.php';
            $no = 1;
            $sql = mysqli_query($conn, "SELECT * FROM tb_santri WHERE aktif = 'Y' AND foto = '' ");
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
                        <?php
                        $directory = 'https://psb.ppdwk.com/assets/berkas/'; // Ganti dengan path direktori yang sesuai
                        $nim = $r['nis']; // Ganti dengan NIM yang ingin Anda cari

                        $matchingFiles = searchPhotoByNIM($directory, $nim);

                        if (empty($matchingFiles)) {
                            echo "Tidak ditemukan foto untuk NIM $nim.";
                        } else {
                            echo "Foto yang cocok dengan NIM $nim:";
                            foreach ($matchingFiles as $file) {
                                echo "<br>" . $file;
                                echo "<br> <img src='https://psb.ppdwk.com/assets/santri/" . $file . "' height='100' /> ";
                                echo "<a href='kembalikan.php?nis=$nim&foto=$file'>Kembalikan</a>";
                            }
                        }
                        ?>
                    </td>
                    <td>
                        <a href="<?= 'cariFoto.php?nis=' . $r['nis'] ?>"><button class="btn btn-primary btn-minier">Cari</button></a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>

</html>