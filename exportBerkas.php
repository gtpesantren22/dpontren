<?php
include 'fungsi.php';

$nis = isset($_GET['nis']) ? intval($_GET['nis']) : 0;

if (!$nis) {
    die('NIS tidak valid.');
}

ini_set('memory_limit', '512M');
set_time_limit(0);

// Ambil data santri
$dataS = mysqli_fetch_assoc(mysqli_query($conn_psb, "SELECT * FROM tb_santri WHERE nis = $nis"));

if (!$dataS) {
    die("Data santri tidak ditemukan.");
}

// Sanitasi nama file zip
$nama_santri = preg_replace('/[^a-zA-Z0-9_-]/', '_', $dataS['nama']);

// Buat folder jika belum ada
$zip_folder = __DIR__ . "/images";
if (!is_dir($zip_folder)) {
    mkdir($zip_folder, 0755, true); // buat folder images jika belum ada
}

// Full path ke file ZIP
$zip_file = $zip_folder . "/berkas_" . $nama_santri . ".zip";

// Inisialisasi ZipArchive
$zip = new ZipArchive();
$openZip = $zip->open($zip_file, ZipArchive::CREATE | ZipArchive::OVERWRITE);

if ($openZip !== TRUE) {
    die("Gagal membuka ZIP file. Kode error: $openZip");
}


// Inisialisasi ZIP
$zip = new ZipArchive;
if ($zip->open($zip_file, ZipArchive::CREATE | ZipArchive::OVERWRITE)) {

    $sql = "SELECT a.*, b.diri, b.ayah, b.ibu 
            FROM berkas_file a 
            LEFT JOIN foto_file b ON a.nis = b.nis 
            WHERE a.nis = '$nis'";

    $result = $conn_psb->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $file_fields = ['akta', 'kk', 'ktp_ayah', 'ktp_ibu', 'skl', 'ijazah', 'kip', 'diri', 'ayah', 'ibu'];

            foreach ($file_fields as $field) {
                if (!empty($row[$field])) {
                    // Lokasi file di server
                    $file_path =  "https://psb.ppdwk.com/assets/berkas/" . $field . "/" . $row[$field]; // Sesuaikan dengan path server
                    $new_file_name = $field . '_' . basename($row[$field]);

                    if (file_exists($file_path)) {
                        $zip->addFile($file_path, $new_file_name);
                    }
                }
            }
        }
    }

    $zip->close();

    // Download ZIP
    // Setelah zip->close()
    if (file_exists($zip_file)) {
        ob_clean();
        flush();

        header('Content-Type: application/zip');
        header('Content-Disposition: attachment; filename="berkas_' . $nama_santri . '.zip"');
        header('Content-Length: ' . filesize($zip_file));
        readfile($zip_file);
        unlink($zip_file);
        exit;
    } else {
        die("ZIP file tidak ditemukan di: " . $zip_file);
    }
} else {
    die("Gagal membuat ZIP file.");
}

$conn_psb->close();
