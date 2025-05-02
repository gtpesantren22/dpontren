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
    mkdir($zip_folder, 0755, true);
}

// Path lengkap file ZIP
$zip_file = $zip_folder . "/berkas_" . $nama_santri . ".zip";

// Inisialisasi ZIP
$zip = new ZipArchive();
$open_result = $zip->open($zip_file, ZipArchive::CREATE | ZipArchive::OVERWRITE);
if ($open_result !== TRUE) {
    die("Gagal membuat ZIP file. Kode error: " . $open_result);
}

// Query ambil file dari DB
$sql = "SELECT a.*, b.diri, b.ayah, b.ibu 
        FROM berkas_file a 
        LEFT JOIN foto_file b ON a.nis = b.nis 
        WHERE a.nis = '$nis'";

$result = $conn_psb->query($sql);
$jumlah_file = 0;

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $file_fields = ['akta', 'kk', 'ktp_ayah', 'ktp_ibu', 'skl', 'ijazah', 'kip', 'diri', 'ayah', 'ibu'];

        foreach ($file_fields as $field) {
            if (!empty($row[$field])) {
                $filename = basename($row[$field]);
                $file_url = "https://psb.ppdwk.com/assets/berkas/$field/$filename";
                $new_file_name = $field . '_' . $filename;

                // Download file
                $file_content = @file_get_contents($file_url);

                if ($file_content === false) {
                    // Coba pakai cURL
                    $ch = curl_init($file_url);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                    $file_content = curl_exec($ch);
                    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                    curl_close($ch);

                    if ($http_code !== 200 || $file_content === false) {
                        echo "<p style='color:red'>Gagal mengunduh: $file_url (HTTP $http_code)</p>";
                        continue;
                    }
                }

                // Tambahkan ke ZIP
                $zip->addFromString($new_file_name, $file_content);
                $jumlah_file++;
            }
        }
    }
}

$zip->close();

// Validasi apakah file berhasil dibuat
if (file_exists($zip_file) && $jumlah_file > 0) {
    ob_clean();
    flush();

    header('Content-Type: application/zip');
    header('Content-Disposition: attachment; filename="berkas_' . $nama_santri . '.zip"');
    header('Content-Length: ' . filesize($zip_file));
    readfile($zip_file);
    unlink($zip_file);
    exit;
} else {
    die("ZIP file tidak ditemukan atau kosong di: $zip_file<br>Total file dimasukkan: $jumlah_file");
}

$conn_psb->close();
