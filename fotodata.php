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

    // $directory = 'https://psb.ppdwk.com/assets/berkas/'; // Ganti dengan path direktori yang sesuai
    // $nim = $r['nis']; // Ganti dengan NIM yang ingin Anda cari

    // $matchingFiles = searchPhotoByNIM($directory, $nim);

    // if (empty($matchingFiles)) {
    //     echo "Tidak ditemukan foto untuk NIM $nim.";
    // } else {
    //     echo "Foto yang cocok dengan NIM $nim:";
    //     foreach ($matchingFiles as $file) {
    //         echo "<br>" . $file;
    //         echo "<br> <img src='https://psb.ppdwk.com/assets/santri/" . $file . "' height='100' /> ";
    //         echo "<a href='kembalikan.php?nis=$nim&foto=$file'>Kembalikan</a>";
    //     }
    // }
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
            $conn2 = mysqli_connect("localhost", "u9048253_dwk", "PesantrenDWKIT2021", "u9048253_psb23");
            $no = 1;
            $sql = mysqli_query($conn, "SELECT * FROM tb_santri WHERE aktif = 'Y' AND nis LIKE '2023%' ");
            while ($r = mysqli_fetch_assoc($sql)) {
                $t = array('Bayar', 'Ust/Usdtz', 'Khaddam', 'Gratis', 'Berhenti');
                $nis = $r['nis'];
                $foto = mysqli_fetch_assoc(mysqli_query($conn2, "SELECT * FROM foto_file WHERE nis = '$nis' "));
            ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $nis ?></td>
                    <td><?= $r['nama'] ?></td>
                    <td><?= $r['desa'] . ' - ' . $r['kec'] . ' - ' . $r['kab'] ?></td>
                    <td><?= $r['k_formal'] . ' - ' . $r['t_formal'] ?></td>
                    <td><?= $r['k_madin'] . ' - ' . $r['r_madin'] ?></td>
                    <td><?= $r['foto'] !=  '' ? 'Ada Fotonya' : '' ?></td>
                    <td>
                        <form action="" method="post">
                            <label for="photo_url">URL Foto: <?= 'https://psb.ppdwk.com/assets/berkas/' . $foto['diri'] ?></label>
                            <input type="hidden" name="nis" value="<?= $nis ?>">
                            <input type="hidden" name="photo_url" id="photo_url" value="<?= 'https://psb.ppdwk.com/assets/berkas/' . $foto['diri'] ?>" required>
                            <input type="submit" value="Upload">
                        </form>
                        <!-- <img src="<?= 'https://psb.ppdwk.com/assets/berkas/' . $foto['diri'] ?>" alt="" height="90"> -->
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

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $photo_url = $_POST["photo_url"];
    $nis = $_POST["nis"];

    // Validasi link foto, misalnya pastikan link memiliki format gambar yang diperbolehkan
    $allowed_formats = array("jpg", "jpeg", "png", "gif");
    $url_info = pathinfo($photo_url);
    $extension = strtolower($url_info["extension"]);
    if (!in_array($extension, $allowed_formats)) {
        die("Format file tidak diperbolehkan. Hanya menerima format JPG, JPEG, PNG, dan GIF.");
    }

    // Mendapatkan nama file untuk menyimpannya
    $file_name = $nis . '-' . rand() . "." . $extension;

    // Simpan foto dari link ke server
    if (copy($photo_url, "images/santri/" . $file_name)) {
        $sqUp = mysqli_query($conn, "UPDATE tb_santri SET foto = '$file_name' WHERE nis = '$nis' ");
        if ($sqUp) {
            echo "
            <script>window.location = 'fotodata.php' </script>
            ";
        }
    } else {
        echo "Gagal mengupload foto.";
    }
}
?>