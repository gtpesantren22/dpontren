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
    $dt = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM lemari_data WHERE id_ldata = '$id' "));
    $kamar = $dt['kamar'];
    $lemari = $dt['lemari'];
    $link_back = 'lemari_detail.php?kd=' . $kamar . '&lmr=' . $lemari;

    $sql = mysqli_query($conn, "DELETE FROM lemari_data WHERE id_ldata = '$id' ");
    if ($sql) {
        echo "
            <script>
                window.location = '" . $link_back . "' ;
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

if ($kd == 'mts') {
    $dt = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM mutasi WHERE id_mutasi = '$id' "));
    $nis = $dt['nis'];

    $sql = mysqli_query($conn, "UPDATE tb_santri SET aktif = 'T', pass = '' WHERE nis = '$nis' ");

    $dts = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tb_santri WHERE nis = '$nis' "));
    $psn = '*INFORMASI MUTASI*

Atas nama :
    
Nama : ' . $dts['nama'] . '
Alamat : ' . $dts['desa'] . '-' . $dts['kec'] . '-' . $dts['kab'] . '
Sekolah : ' . $dts['k_formal'] . ' ' . $dts['t_formal'] . '

*_Data telah dikeluarkan dari DPontren. Dimohon kepada lembaga untuk membuat surat mutasi dan dikeluarkan dari Emis/Dapodik_*
Terimakasih';

    if ($sql) {

        $curl2 = curl_init();
        curl_setopt_array(
            $curl2,
            array(
                CURLOPT_URL => 'http://191.101.3.115:3000/api/sendMessageGroup',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => 'apiKey=f4064efa9d05f66f9be6151ec91ad846&id_group=120363028015516743@g.us&message=' . $psn,
            )
        );
        $response = curl_exec($curl2);
        curl_close($curl2);

        echo "
            <script>
                alert('Santri sudah dikeluarkan');
                window.location = 'mutasi.php' ;
            </script>
        ";
    }
}

if ($kd == 'mti') {
    $sql = mysqli_query($conn, "UPDATE tb_santri SET aktif = 'T' WHERE nis = '$id' ");

    if ($sql) {
        echo "
        <script>
            alert('Data sudah dipindah');
            window.location = 's_aktif.php';
        </script>
        ";
    } else {
        echo "
        <script>
            alert('Gagal dipindah');
            window.location = 's_no.php';
        </script>
    ";
    }
}
