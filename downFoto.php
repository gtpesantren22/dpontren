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
                <li class="active">Data Santri Aktif</li>
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
                    Data Santri
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        Data Santri Aktif
                    </small>
                </h1>
            </div><!-- /.page-header -->

            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->

                    <div class="row">
                        <div class="col-xs-12">

                            <div class="table-header">
                                Download Foto Santri
                                <a href="s_aktif.php" class="btn btn-warning btn-sm pull-right"><i class="fa fa-arrow-left"></i> kembali</a>
                            </div>

                            <!-- div.table-responsive -->

                            <!-- div.dataTables_borderWrap -->
                            <div class="table-responsive">
                                <table id="table-siswa" class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Lembaga</th>
                                            <th>Putra</th>
                                            <th>Putri</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $sql = mysqli_query($conn, "SELECT t_formal FROM tb_santri WHERE aktif = 'Y' GROUP BY t_formal");
                                        while ($row = mysqli_fetch_object($sql)):
                                        ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= $row->t_formal ?></td>
                                                <td>
                                                    <form action="exportFoto.php" method="post">
                                                        <input type="hidden" name="lembaga" value="<?= $row->t_formal ?>">
                                                        <input type="hidden" name="jkl" value="Laki-laki">
                                                        <button class="btn btn-xs btn-success">download</button>
                                                    </form>
                                                </td>
                                                <td>
                                                    <form action="exportFoto.php" method="post">
                                                        <input type="hidden" name="lembaga" value="<?= $row->t_formal ?>">
                                                        <input type="hidden" name="jkl" value="Perempuan">
                                                        <button class="btn btn-xs btn-primary">download</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endwhile ?>
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

<?php
include 'foot.php';
?>