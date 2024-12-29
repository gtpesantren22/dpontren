<?php
include 'fungsi.php';

$kks = $_GET['kls'];
$kls = explode('-', $kks);
$kelas = $kls[0];
$jurusan = $kls[1];
$rombel = $kls[2];
$lembaga = $kls[3];

ini_set('memory_limit', '512M'); // Sesuaikan dengan kebutuhan
set_time_limit(0); // Menghilangkan batas waktu eksekusi

/// create a zip file
$zip_file = "images/all-santri-image.zip";
touch($zip_file);
// end


// open zip file
$zip = new ZipArchive;
$this_zip = $zip->open($zip_file);


if ($this_zip) {

    // Query untuk mengambil data file dari database
    $sql = "SELECT nis,nama,foto FROM tb_santri WHERE aktif = 'Y' AND t_formal = '$lembaga' AND k_formal = '$kelas' AND r_formal = '$rombel' AND jurusan = '$jurusan' AND foto != '' "; // Sesuaikan dengan tabel Anda
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Loop melalui hasil dan menambahkan file ke dalam ZIP
        while ($row = $result->fetch_assoc()) {
            $file_name = $row['foto'];
            $new_file_name = $row['nis'] . '_' . $row['nama'] . '.jpg';
            $file_path = "images/santri/" . $file_name; // Asumsikan file tersimpan di folder ../image/

            // Cek apakah file ada sebelum menambahkannya ke dalam ZIP
            if (file_exists($file_path)) {
                $zip->addFile($file_path, $new_file_name); // Menambahkan file ke ZIP
            }
        }
    } else {
        echo "Tidak ada file ditemukan di database.";
    }

    // Menutup ZIP
    $zip->close();


    // download this created zip file
    if (file_exists($zip_file)) {
        ob_clean(); // Bersihkan buffer output
        flush();
        //name when download
        $demo_name = "foto_santri_$kks.zip";

        header('Content-type: application/zip');
        header('Content-Disposition: attachment; filename="' . $demo_name . '"');
        readfile($zip_file); // auto download

        //delete this zip file after download
        unlink($zip_file);
    }

    $conn->close();
}
