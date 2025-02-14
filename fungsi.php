<?php

$conn = mysqli_connect("localhost", "root", "", "db_santri");
$conn2 = mysqli_connect("localhost", "root", "", "psb24");
$conn_info = mysqli_connect("localhost", "root", "", "db_info");

// $conn = mysqli_connect("localhost", "u9048253_dwk", "PesantrenDWKIT2021", "u9048253_santri");
// $conn2 = mysqli_connect("localhost", "u9048253_dwk", "PesantrenDWKIT2021", "u9048253_psb24");
// $conn_info = mysqli_connect("localhost", "u9048253_dwk", "PesantrenDWKIT2021", "u9048253_info");

$t = array('Bayar', 'Ust/Usdtz', 'Khaddam', 'Gratis', 'Berhenti');
$tl = array('', 'MTs', 'SMP', 'MA', 'SMK');

$bulan = array('', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
// ok

function getID($nama)
{

    // $namaOk = mysqli_real_escape_string($this->conn, $nama);
    $namaOk = htmlspecialchars($nama);
    $url = "https://data.ppdwk.com/api/datatables?data=referensi-peserta-didik&page=1&per_page=10&q=$namaOk&sortby=nama&sortbydesc=ASC"; // Ganti dengan URL API
    $token = "170|zHj9KgqTrOebyIxm8dqw0qjPTH7JYnR8AdN61f467a6c42e0"; // Ganti dengan token yang sesuai

    // Inisialisasi cURL
    $ch = curl_init($url);

    // Set opsi cURL
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Authorization: Bearer $token",
        "Accept: application/json"
    ]);

    // Eksekusi cURL dan simpan respons
    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    // Cek jika terjadi error
    if (curl_errno($ch)) {
        echo "cURL Error: " . curl_error($ch);
    }

    // Tutup koneksi cURL
    curl_close($ch);

    // Decode JSON hasil respons
    $data = json_decode($response, true);

    // Tampilkan hasil
    return $data;
    // return $namaOk;
}
