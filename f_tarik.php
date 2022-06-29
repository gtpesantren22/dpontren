<?php
include 'fungsi.php';
mysqli_query($conn, "DROP VIEW IF EXISTS datas ");

mysqli_query($conn, "CREATE VIEW datas AS SELECT a.*, b.t_kos, c.kamar, c.komplek FROM psb22.tb_santri a JOIN psb22.dekos b ON a.nis=b.nis JOIN psb22.lemari_data c ON a.nis=c.nis WHERE a.ket = 'baru' ");

// mysqli_query($conn, "CREATE VIEW datas AS SELECT a.*, b.t_kos, c.kamar, c.komplek FROM psb22.tb_santri a JOIN psb22.dekos b ON a.nis=b.nis JOIN psb22.lemari_data c ON a.nis=c.nis WHERE a.ket = 'baru' ");
