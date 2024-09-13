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

// Create a new ZipArchive object
$zip = new ZipArchive();
$zipFileName = 'Data-Foto-santri.zip';

// Open the zip file for writing
if ($zip->open($zipFileName, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {

    // Fetch files from the database
    $sql = "SELECT foto FROM tb_santri WHERE aktif = 'Y' AND foto != '' "; // Customize this query to match your table
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Loop through the result and add files to the zip
        while ($row = $result->fetch_assoc()) {
            $filePath = __DIR__ . '/images/santri/';
            $fileName = $row['foto'];

            // Check if the file exists before adding it to the zip
            if (file_exists($filePath)) {
                $zip->addFile($filePath, $fileName); // Add file to the zip archive
            } else {
                echo "File does not exist: " . $filePath;
            }
        }
    } else {
        echo "No files found in the database.";
    }

    // Close the zip file
    $zip->close();

    // Set headers to force download of the zip file
    header('Content-Type: application/zip');
    header('Content-Disposition: attachment; filename="' . basename($zipFileName) . '"');
    header('Content-Length: ' . filesize($zipFileName));

    // Read the file and send it to the browser
    readfile($zipFileName);

    // Optionally, delete the zip file after download
    unlink($zipFileName);
} else {
    echo 'Failed to create zip file.';
}
