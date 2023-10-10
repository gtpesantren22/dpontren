<?php
// api.php

// Buat koneksi
include 'fungsi.php';

// Set header agar izin CORS diberikan
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");

// Fungsi untuk membersihkan input
// function cleanInput($input)
// {
//     global $conn;
//     $input = trim($input);
//     $input = stripslashes($input);
//     $input = htmlspecialchars($input);
//     $input = $conn->real_escape_string($input);
//     return $input;
// }

// Cek token
$valid_tokens = array("2y10bMXpw6ajVkXVjP6nEjg4pus6rw5cZy0fBcukr614aS88CBsbna7YK", "2y10bMXpw6ajVkXwerw5456pus6rw5cZy0fBcukr614aS88CBsbna7YK"); // Ganti dengan token yang Anda tetapkan
$api_token = isset($_POST['api_token']) ? $_POST['api_token'] : "";
$api_token = str_replace("Bearer ", "", $api_token); // Hapus "Bearer " dari token


// var_dump($api_token);
// var_dump($valid_tokens);

if (!in_array($api_token, $valid_tokens)) {
    $response = array("status" => "error", "message" => "Akses ditolak. Token tidak valid.");
    http_response_code(403); // Kode respons HTTP (misalnya 403 Forbidden)
    echo json_encode($response);
    exit;
}

// Query select untuk mengambil data siswa
$query = "SELECT * FROM tb_santri WHERE  aktif = 'Y' ";
$result = $conn->query($query);

$students = array();

// Ambil data siswa dalam bentuk array asosiatif
while ($row = $result->fetch_assoc()) {
    $students[] = $row;
}

// Tutup koneksi
$conn->close();

// Membersihkan data sebelum dikirim
// foreach ($students as &$student) {
//     foreach ($student as &$value) {
//         $value = cleanInput($value);
//     }
// }

// Kirim data siswa sebagai respons
echo json_encode($students);
