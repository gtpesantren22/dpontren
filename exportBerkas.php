<?php
include 'fungsi.php';

$nis = $_GET['nis'];

ini_set('memory_limit', '512M'); // Sesuaikan dengan kebutuhan
set_time_limit(0); // Menghilangkan batas waktu eksekusi

$dataS = mysqli_fetch_assoc(mysqli_query($conn_psb, "SELECT * FROM tb_santri WHERE nis = $nis "));

/// create a zip file
$zipFilename = "images/berkas_" . $dataS['nama'] . ".zip";
// touch($zip_file);
// end


// open zip file
$zip = new ZipArchive;
// $this_zip = $zip->open($zip_file);

$sql = "SELECT a.*, b.diri, b.ayah, b.ibu 
        FROM berkas_file a 
        LEFT JOIN foto_file b ON a.nis = b.nis 
        WHERE a.nis = '$nis'";

$result = $conn_psb->query($sql);

if ($zip->open($zipFilename, ZipArchive::CREATE) === TRUE) {
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
    $zip->close();

    // Download ZIP
    header('Content-Type: application/zip');
    header('Content-disposition: attachment; filename=' . $zipFilename);
    header('Content-Length: ' . filesize($zipFilename));
    readfile($zipFilename);
    unlink($zipFilename); // hapus file zip setelah di-download
} else {
    echo "Gagal membuat file ZIP.";
}
