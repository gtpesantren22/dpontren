<?php
session_start();
include 'fungsi.php';

if (!isset($_SESSION['04bb9374-8e84-48c8-b858-cfaa2087b56f'])) {
    echo "
    <script>
    alert('Silahkan login dulu');
    window.location = 'login.php';
    </script>
    ";
}

$lembaga = $_POST['lembaga'];
$jkl = $_POST['jkl'];

/// create a zip file
$zip_file = "images/all-santri-image.zip";
touch($zip_file);
// end


// open zip file
$zip = new ZipArchive;
$this_zip = $zip->open($zip_file);


if ($this_zip) {

    // Query untuk mengambil data file dari database
    $sql = "SELECT foto FROM tb_santri WHERE aktif = 'Y' AND t_formal = '$lembaga' AND jkl = '$jkl' AND foto != '' "; // Sesuaikan dengan tabel Anda
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Loop melalui hasil dan menambahkan file ke dalam ZIP
        while ($row = $result->fetch_assoc()) {
            $file_name = $row['foto'];
            $file_path = "images/santri/" . $file_name; // Asumsikan file tersimpan di folder ../image/

            // Cek apakah file ada sebelum menambahkannya ke dalam ZIP
            if (file_exists($file_path)) {
                $zip->addFile($file_path, $file_name); // Menambahkan file ke ZIP
            }
        }
    } else {
        echo "Tidak ada file ditemukan di database.";
    }

    // Menutup ZIP
    $zip->close();


    // download this created zip file
    if (file_exists($zip_file)) {
        //name when download
        $demo_name = "santri-all-images.zip";

        header('Content-type: application/zip');
        header('Content-Disposition: attachment; filename="' . $demo_name . '"');
        readfile($zip_file); // auto download

        //delete this zip file after download
        unlink($zip_file);
    }

    $conn->close();
}
