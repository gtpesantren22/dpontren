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
                <li class="active">Export Data</li>
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
                                Data santri yang masih aktif di pesantren
                            </div>
                            <br>
                            <a href="excel1.php" target="_blank" class="btn btn-success btn-sm"><i class="fa fa-download"></i> Export to Excel (All Data)</a>
                            <h3>Cetak Kartu Perlembaga</h3>
                            <?php
                            $sdara = mysqli_query($conn, "SELECT t_formal FROM tb_santri WHERE aktif = 'Y' AND jkl = 'Laki-laki' GROUP BY t_formal ");
                            $sdari = mysqli_query($conn, "SELECT t_formal FROM tb_santri WHERE aktif = 'Y' AND jkl = 'Perempuan' GROUP BY t_formal ");
                            while ($row = mysqli_fetch_assoc($sdara)) { ?>
                                <a href="cetakKartu.php?jkl=Laki-laki&lembaga=<?= $row['t_formal'] ?>" class="btn btn-primary btn-sm" target="_blank"><?= $row['t_formal'] ?> Putra</a>
                            <?php }
                            echo "<br><br>";
                            while ($row = mysqli_fetch_assoc($sdari)) { ?>
                                <a href="cetakKartu.php?jkl=Perempuan&lembaga=<?= $row['t_formal'] ?>" class="btn btn-warning btn-sm" target="_blank"><?= $row['t_formal'] ?> Putri</a>
                            <?php } ?>
                        </div>
                    </div>

                    <!-- PAGE CONTENT ENDS -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
?>