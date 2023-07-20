<?php
// Fungsi untuk mencari foto berdasarkan NIM di direktori
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

// Contoh penggunaan
$directory = 'images/santri/'; // Ganti dengan path direktori yang sesuai
$nim = $_GET['nis']; // Ganti dengan NIM yang ingin Anda cari

$matchingFiles = searchPhotoByNIM($directory, $nim);

if (empty($matchingFiles)) {
    echo "Tidak ditemukan foto untuk NIM $nim.";
} else {
    echo "Foto yang cocok dengan NIM $nim:";
    foreach ($matchingFiles as $file) {
        echo "<br>" . $file;
        echo "<br> <img src='images/santri/" . $file . "' height='100' /> ";
        echo "<a href='kembalikan.php?nis=$nim&foto=$file'>Kembalikan</a>";
    }
}
