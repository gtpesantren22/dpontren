<?php

include 'fungsi.php';

$kd = $_GET['kd'];
$id = $_GET['id'];

if ($kd == 'fr') {
    $sql = mysqli_query($conn, "DELETE FROM kelas WHERE id_kelas = '$id' ");
    if ($sql) {
        echo "
            <script>
                alert('Data kelas sdah dihapus');
                window.location = 'kelas.php' ;
            </script>
        ";
    }
}

if ($kd == 'md') {
    $sql = mysqli_query($conn, "DELETE FROM madin WHERE id_madin = '$id' ");
    if ($sql) {
        echo "
            <script>
                alert('Data sdah dihapus');
                window.location = 'madin.php' ;
            </script>
        ";
    }
}

if ($kd == 'rmb') {
    $sql = mysqli_query($conn, "DELETE FROM rombel WHERE id_rombel = '$id' ");
    if ($sql) {
        echo "
            <script>
                alert('Data sdah dihapus');
                window.location = 'rombel.php' ;
            </script>
        ";
    }
}

if ($kd == 'jrs') {
    $sql = mysqli_query($conn, "DELETE FROM jurusan WHERE id_jurusan= '$id' ");
    if ($sql) {
        echo "
            <script>
                alert('Data sdah dihapus');
                window.location = 'jurusan.php' ;
            </script>
        ";
    }
}

if ($kd == 'lmb') {
    $sql = mysqli_query($conn, "DELETE FROM lembaga WHERE id_lembaga = '$id' ");
    if ($sql) {
        echo "
            <script>
                alert('Data sdah dihapus');
                window.location = 'formal.php' ;
            </script>
        ";
    }
}

if ($kd == 'kmp') {
    $sql = mysqli_query($conn, "DELETE FROM komplek WHERE id_komplek = '$id' ");
    if ($sql) {
        echo "
            <script>
                alert('Data sdah dihapus');
                window.location = 'komplek.php' ;
            </script>
        ";
    }
}

if ($kd == 'kmr') {
    $sql = mysqli_query($conn, "DELETE FROM kamar WHERE id_kamar = '$id' ");
    if ($sql) {
        echo "
            <script>
                alert('Data sdah dihapus');
                window.location = 'kamar.php' ;
            </script>
        ";
    }
}

if ($kd == 'sts') {
    $sql = mysqli_query($conn, "DELETE FROM status WHERE id_stts = '$id' ");
    if ($sql) {
        echo "
            <script>
                window.location = 'status.php' ;
            </script>
        ";
    }
}

if ($kd == 'lmrd') {
    $dt = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM lemari_data WHERE id_ldata = '$id' "));
    $kamar = $dt['kamar'];

    $sql = mysqli_query($conn, "DELETE FROM lemari_data WHERE kamar = '$kamar' ");
    if ($sql) {
        echo "
            <script>
                window.location = 'lemari.php' ;
            </script>
        ";
    }
}

if ($kd == 'lmrd_s') {
    $sql = mysqli_query($conn, "DELETE FROM lemari_data WHERE id_ldata = '$id' ");
    if ($sql) {
        echo "
            <script>
                window.location = 'lemari.php' ;
            </script>
        ";
    }
}

if ($kd == 'wli') {
    $sql = mysqli_query($conn, "DELETE FROM wali_asuh WHERE id_wali = '$id' ");
    if ($sql) {
        echo "
            <script>
                window.location = 'wali_asuh.php' ;
            </script>
        ";
    }
}
