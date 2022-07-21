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
                    <a href="#">Data Edication</a>
                </li>
                <li class="active">Data Rombel Kelas</li>
            </ul><!-- /.breadcrumb -->

            <div class="nav-search" id="nav-search">
                <form class="form-search">
                    <span class="input-icon">
                        <input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
                        <i class="ace-icon fa fa-search nav-search-icon"></i>
                    </span>
                </form>
            </div><!-- /.nav-search -->
        </div>

        <div class="page-content">

            <div class="page-header">
                <h1>
                    Tables
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        Data Rombel kelas
                    </small>
                </h1>
            </div><!-- /.page-header -->

            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->

                    <div class="row">
                        <div class="col-xs-12">

                            <div class="table-header">
                                Data rombel kelas dipesantren
                            </div>

                            <!-- div.table-responsive -->
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="table-responsive">
                                        <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Sinkronisasi ke</th>
                                                    <th>Data sinkron</th>
                                                    <th>Terakhir sinkron</th>
                                                    <th>Jml sinkron</th>
                                                    <th>#</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php
                                                $no = 1;
                                                $sql = mysqli_query($conn, "SELECT * FROM snkr_daftar");
                                                while ($r = mysqli_fetch_assoc($sql)) {
                                                    $dbs = $r['namadb'];
                                                    $tbl = $r['namatbl'];
                                                    $akhir = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM snkr WHERE tujuan = '$dbs' AND data = '$tbl' ORDER BY id_snkr DESC LIMIT 1"));
                                                    $jml = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM snkr WHERE tujuan = '$dbs' AND data = '$tbl' "));
                                                    $sncc = 'snc.php?tj=' . $dbs . '&data=' . $tbl;
                                                ?>
                                                    <tr>
                                                        <td><?= $no++ ?></td>
                                                        <td>Aplikasi <?= $r['namadb'] ?></td>
                                                        <td>Data <?= $r['namatbl'] ?></td>
                                                        <td><?= $akhir['akhir'] ?></td>
                                                        <td><?= $jml ?> kali</td>
                                                        <td>
                                                            <a href="<?= $sncc; ?>" class="btn btn-minier btn-danger" onclick="return confirm('Yakin akan disinkron ulang ?')"><i class="fa fa-refresh"></i> Sinkron ulang</a>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="widget-box">
                                        <div class="widget-header">
                                            <h4 class="widget-title">Input Data Data Baru</h4>

                                            <div class="widget-toolbar">
                                                <a href="#" data-action="collapse">
                                                    <i class="ace-icon fa fa-chevron-up"></i>
                                                </a>

                                                <a href="#" data-action="close">
                                                    <i class="ace-icon fa fa-times"></i>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="widget-body">
                                            <div class="widget-main">
                                                <form action="" method="post">
                                                    <!-- <div class="form-group">
                                                        <label for="">Aplikasi Tujuan</label>
                                                        <select name="tujuan" id="" class="form-control" required>
                                                            <option value="">- pilih aplikasi tujuan -</option>
                                                            <option value="bendahara">Aplikasi Bendahara</option>
                                                            <option value="dekos">Aplikasi Dekosan</option>
                                                            <option value="sentral">Aplikasi Simkupaduka</option>
                                                            <option value="psb22">Aplikasi PSB</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Data yang di sinkron</label>
                                                        <select name="data" id="" class="form-control" required>
                                                            <option value="">- pilih data -</option>
                                                            <option value="tb_santri">Data Santri</option>
                                                            <option value="status">Data Status</option>
                                                        </select>
                                                    </div> -->
                                                    <div class="form-group">
                                                        <label for="">Nama Database</label>
                                                        <input type="text" name="namadb" class="form-control" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Nama Table</label>
                                                        <input type="text" name="namatbl" class="form-control" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <button class="btn btn-success btn-sm" type="submit" name="simpan"><i class="fa fa-check"></i> Simpan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- div.dataTables_borderWrap -->

                        </div>
                    </div>

                    <!-- PAGE CONTENT ENDS -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->

<?php
include 'foot.php';

if (isset($_POST['simpan'])) {
    $namadb = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['namadb']));
    $namatbl = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['namatbl']));

    $sql = mysqli_query($conn, "INSERT INTO snkr_daftar VALUES ('', '$namadb', '$namatbl') ");
    if ($sql) {
        echo "
            <script>
                window.location = 'snkr.php' ;
            </script>
        ";
    }
}
?>