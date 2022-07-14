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
                <li class="active">Data Wali Asuh</li>
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
                    Data
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        Data Wali Asuh
                    </small>
                </h1>
            </div><!-- /.page-header -->

            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->

                    <div class="row">
                        <div class="col-xs-12">

                            <div class="table-header">
                                Data Wali Asuh Santri
                            </div>

                            <!-- div.table-responsive -->
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="table-responsive">
                                        <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php
                                                $no = 1;
                                                $sql = mysqli_query($conn, "SELECT * FROM wali_asuh ORDER BY jkl ASC ");
                                                while ($r = mysqli_fetch_assoc($sql)) {
                                                ?>
                                                    <tr>
                                                        <td><?= $no++ ?></td>
                                                        <td><?= $r['nama'] ?></td>
                                                        <!-- <td><?= $r['tahun'] ?></td> -->
                                                        <td><a href="<?= 'hapus.php?kd=wli&id=' . $r['id_wali'] ?>" onclick="return confirm('Yakiin akan dihapus ?')"><button class="btn btn-danger btn-minier"><i class="fa fa-trash"></i> Dele</button></a></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="col-md-7">
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
                                                <div class="table-responsive">
                                                    <table id="dynamic-table2" class="table table-striped table-bordered table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th></th>
                                                                <th>Nama</th>
                                                                <th>Kelas</th>
                                                                <th>Aksi</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                            <?php
                                                            $no = 1;
                                                            $sql = mysqli_query($conn, "SELECT * FROM tb_santri WHERE aktif = 'Y' AND NOT EXISTS (SELECT * FROM wali_asuh WHERE tb_santri.nis=wali_asuh.nis) ");
                                                            while ($r = mysqli_fetch_assoc($sql)) {
                                                            ?>
                                                                <tr>
                                                                    <td><?= $no++ ?></td>
                                                                    <td><?= $r['nama'] ?></td>
                                                                    <td><?= $r['k_formal'] . ' - ' . $r['t_formal'] ?></td>
                                                                    <td>
                                                                        <form action="" method="post">
                                                                            <input type="hidden" name="nis" value="<?= $r['nis']; ?>">
                                                                            <button type="submit" name="sele" class="btn btn-primary btn-minier"><i class="fa fa-check"></i> Pilih</button>
                                                                        </form>
                                                                    </td>
                                                                </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
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

if (isset($_POST['sele'])) {
    $nis = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['nis']));

    $dt = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tb_santri WHERE nis = '$nis' "));
    $nama = htmlspecialchars(mysqli_real_escape_string($conn, $dt['nama']));
    $jkl = htmlspecialchars(mysqli_real_escape_string($conn, $dt['jkl']));

    $sql = mysqli_query($conn, "INSERT INTO wali_asuh VALUES ('', '$nis', '$nama', '$jkl') ");
    if ($sql) {
        echo "
            <script>
                window.location = 'wali_asuh.php' ;
            </script>
        ";
    }
}
?>