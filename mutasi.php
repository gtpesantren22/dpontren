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
                    <a href="#">Data Santri</a>
                </li>
                <li class="active">Data Mutasi Santri</li>
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
                        Data Mutasi Santri
                    </small>
                </h1>
            </div><!-- /.page-header -->

            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->

                    <div class="row">
                        <div class="col-xs-12">

                            <div class="table-header">
                                Data mutasi santri
                            </div>

                            <!-- div.table-responsive -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>NIS</th>
                                                    <th>Nama</th>
                                                    <th>Alasan</th>
                                                    <th>Tgl Mutasi</th>
                                                    <th>Status</th>
                                                    <th>#</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 1;
                                                $sql = mysqli_query($conn, "SELECT a.*, b.* FROM mutasi a JOIN tb_santri b ON a.nis=b.nis WHERE  aktif = 'Y' ORDER BY id_mutasi DESC ");
                                                while ($dt = mysqli_fetch_assoc($sql)) {
                                                    if ($dt['status'] == 0) {
                                                        $stas = "<span class='label label-danger'><i class='fa fa-times'></i> Verval Bendahara</span> | <span class='label label-danger'><i class='fa fa-times'></i> Kirim ke Pendataan</span>";
                                                    } elseif ($dt['status'] == 1) {
                                                        $stas = "<span class='label label-success'><i class='fa fa-check'></i> Verval Bendahara</span> | <span class='label label-danger'><i class='fa fa-times'></i> Kirim ke Pendataan</span>";
                                                    } elseif ($dt['status'] == 2) {
                                                        $stas = "<span class='label label-success'><i class='fa fa-check'></i> Verval Bendahara</span> | <span class='label label-success'><i class='fa fa-check'></i> Kirim ke Pendataan</span>";
                                                    }
                                                ?>
                                                    <tr>
                                                        <td><?= $no++; ?></td>
                                                        <td><?= $dt['nis']; ?></td>
                                                        <td><?= $dt['nama']; ?></td>
                                                        <td><?= $dt['alasan']; ?></td>
                                                        <td><?= $dt['tgl_mutasi']; ?></td>
                                                        <td><?= $stas; ?></td>
                                                        <td>
                                                            <?php if ($dt['status'] == 0) { ?>

                                                            <?php } elseif ($dt['status'] == 1) { ?>
                                                            <?php } elseif ($dt['status'] == 2) { ?>
                                                                <a class="btn btn-danger btn-minier" onclick="return confirm('Yakin akan dikeluarkan ?')" href="<?= 'hapus.php?kd=mts&id=' . $dt['id_mutasi']; ?>"><i class="fa fa-trash"></i> keluarkan</a>
                                                            <?php } ?>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
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