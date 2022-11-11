<?php
include 'head.php';
?>

<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="#">Home</a>
                </li>

                <li>
                    <a href="#">Data Absesni</a>
                </li>
                <li class="active">Data Absesnsi Santri</li>
            </ul><!-- /.breadcrumb -->

            <div class="nav-search" id="nav-search">
                <form class="form-search">
                    <span class="input-icon">
                        <input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input"
                            autocomplete="off" />
                        <i class="ace-icon fa fa-search nav-search-icon"></i>
                    </span>
                </form>
            </div><!-- /.nav-search -->
        </div>

        <div class="page-content">

            <div class="page-header">
                <h1>
                    Data Absensi
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        Data Absensi Santri
                    </small>
                </h1>
            </div><!-- /.page-header -->

            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->

                    <div class="row">
                        <div class="col-xs-12">

                            <div class="table-header">
                                Data Absensi Santri Formal
                            </div>

                            <!-- div.table-responsive -->

                            <!-- div.dataTables_borderWrap -->
                            <div class="table-responsive">
                                <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tapel</th>
                                            <th>Absen</th>
                                            <th>Lembaga</th>
                                            <!-- <th>#</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $sql = mysqli_query($conn_info, "SELECT * FROM absen GROUP BY ta, bulan, minggu ");
                                        while ($r = mysqli_fetch_assoc($sql)) {
                                            $mg = $r['minggu'];
                                            $bl = $r['bulan'];
                                            $ta = $r['ta'];
                                            $sqlr = mysqli_query($conn_info, "SELECT * FROM absen WHERE minggu = $mg AND bulan = $bl AND ta = '$ta' GROUP BY lembaga ");
                                        ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $ta ?></td>
                                            <td><?= 'Minggu ke-' . $mg . ', bulan ' . $bulan[$bl] ?>
                                            </td>
                                            <td>
                                                <?php
                                                    while ($lm = mysqli_fetch_assoc($sqlr)) {
                                                        echo "<span class='badge badge-info'>" . $lm['lembaga'] . "</span>";
                                                    }
                                                    ?>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- PAGE CONTENT ENDS -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data santri
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Masukan NIS</label>
                        <input type="number" name="nis" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="simpan" class="btn btn-primary">Simpan Data Baru</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
include 'foot.php';

if (isset($_POST['simpan'])) {
    $nis = $_POST['nis'];

    $cek = mysqli_query($conn, "SELECT * FROM tb_santri WHERE nis = '$nis' ");

    if (mysqli_num_rows($cek) > 0) {
        echo "
        <script>
            alert('Maaf. NIS sudah terpakai');
            window.location = 's_aktif.php';
        </script>
        ";
    } else {
        $sql = mysqli_query($conn, "INSERT INTO tb_santri (nis, aktif) VALUES ('$nis', 'Y') ");
        if ($sql) {
            echo "
        <script>
            alert('Data sudah masuk');
            window.location = 'edit.php?nis=" . $nis . "';
        </script>
        ";
        }
    }
}
?>