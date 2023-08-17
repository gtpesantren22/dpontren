<?php

$valid_tokens = array("2y10bMXpw6ajVkXVjP6nEjg4pus6rw5cZy0fBcukr614aS88CBsbna7YK", "2y10bMXpw6ajVkXwerw5456pus6rw5cZy0fBcukr614aS88CBsbna7YK"); // Ganti dengan token yang Anda tetapkan

// Mendapatkan token dari permintaan
$api_token = isset($_POST['api_token']) ? $_POST['api_token'] : "";

// Mengecek apakah token valid
if (!in_array($api_token, $valid_tokens)) {
    $response = array("status" => "error", "message" => "Akses ditolak. Token tidak valid.");
    http_response_code(403); // Kode respons HTTP (misalnya 403 Forbidden)
    echo json_encode($response);
    exit;
}

// Dapatkan data permintaan
$method = $_SERVER['REQUEST_METHOD'];

// Mengelompokkan data berdasarkan metode
switch ($method) {
    case 'GET':
        // Logika untuk permintaan GET
        break;
    case 'POST':
        // Logika untuk permintaan POST
        break;
        // Tambahkan logika untuk metode lainnya seperti PUT, DELETE, dll.
    default:
        $response = array("status" => "error", "message" => "Metode tidak dikenali.");
        http_response_code(405); // Kode respons HTTP (misalnya 405 Method Not Allowed)
        echo json_encode($response);
        break;
}
