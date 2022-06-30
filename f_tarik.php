<?php
include 'fungsi.php';

$qr = $_GET['snc'];

if ($qr ===  'exc') {
    mysqli_query($conn, "DROP VIEW IF EXISTS datas ");
    $sql = mysqli_query($conn, "CREATE VIEW datas AS SELECT a.*, b.t_kos, c.kamar, c.komplek FROM psb22.tb_santri a JOIN psb22.dekos b ON a.nis=b.nis JOIN psb22.lemari_data c ON a.nis=c.nis WHERE a.ket = 'baru' ");

    // $sql =  mysqli_query($conn, "CREATE VIEW datas AS SELECT a.*, b.t_kos, c.kamar, c.komplek FROM u9048253_psb22.tb_santri a JOIN u9048253_psb22.dekos b ON a.nis=b.nis JOIN u9048253_psb22.lemari_data c ON a.nis=c.nis WHERE a.ket = 'baru' ");

    if ($sql) {
        echo "
    <script>
        alert('Pembaruan berhasil');
        window.location = 'tarik.php';
    </script>
    ";
    } else {
        echo "
    <script>
        alert('Pembaruan Gagal');
        window.location = 'tarik.php';
    </script>
    ";
    }
}
