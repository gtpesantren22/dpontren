<?php
include 'fungsi.php';

$nis = $_GET['nis'];

ini_set('memory_limit', '512M'); // Sesuaikan dengan kebutuhan
set_time_limit(0); // Menghilangkan batas waktu eksekusi

$dataS = mysqli_fetch_assoc(mysqli_query($conn_psb, "SELECT * FROM tb_santri WHERE nis = $nis "));

/// create a zip file
$zip_file = "images/berkas_" . $dataS['nama'] . ".zip";
touch($zip_file);
// end


// open zip file
$zip = new ZipArchive;
$this_zip = $zip->open($zip_file);


if ($this_zip) {

    // Query untuk mengambil data file dari database
    $sql = "SELECT a.*, b.diri, b.ayah, b.ibu 
        FROM berkas_file a 
        LEFT JOIN foto_file b ON a.nis = b.nis 
        WHERE a.nis = '$nis'";

    $result = $conn_psb->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Daftar file yang akan dicek dari tabel
            $file_fields = ['akta', 'kk', 'ktp_ayah', 'ktp_ibu', 'skl', 'ijazah', 'kip', 'diri', 'ayah', 'ibu']; // nama kolom file

            foreach ($file_fields as $field) {
                if (!empty($row[$field])) {
                    $file_path = "https://psb.ppdwk.com/assets/berkas/akta/" . $row[$field];
                    $new_file_name =  basename($row[$field]);

                    if (file_exists($file_path)) {
                        $zip->addFile($file_path, $new_file_name);
                    }
                }
            }
        }
    }

    // Menutup ZIP
    $zip->close();


    // download this created zip file
    if (file_exists($zip_file)) {
        ob_clean(); // Bersihkan buffer output
        flush();
        //name when download
        $demo_name = $zip_file;

        header('Content-type: application/zip');
        header('Content-Disposition: attachment; filename="' . $demo_name . '"');
        readfile($zip_file); // auto download

        //delete this zip file after download
        unlink($zip_file);
    }

    $conn->close();
}
