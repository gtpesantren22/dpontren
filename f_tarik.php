<?php
include 'fungsi.php';
mysqli_query($conn, "DROP VIEW IF EXISTS datas ");
mysqli_query($conn, "CREATE VIEW datas AS SELECT a.* FROM psb22.tb_santri a JOIN psb22.dekos b ON a.nis=b.nis WHERE a.ket = 'baru' ");
// mysqli_query($conn, "CREATE VIEW datas AS SELECT a.* FROM u9048253_psb22.tb_santri a JOIN u9048253_psb22.dekos b ON a.nis=b.nis WHERE a.ket = 'baru' ");
