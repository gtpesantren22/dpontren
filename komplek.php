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
                    <a href="#">Data Domisili</a>
                </li>
                <li class="active">Data Komplek</li>
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
                        Data Komplek
                    </small>
                </h1>
            </div><!-- /.page-header -->

            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->

                    <div class="row">
                        <div class="col-xs-12">

                            <div class="table-header">
                                Data komplek
                            </div>

                            <!-- div.table-responsive -->
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="table-responsive">
                                        <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama</th>
                                                    <th>Daerah</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php
                                                $no = 1;
                                                $sql = mysqli_query($conn, "SELECT * FROM komplek ");
                                                while ($r = mysqli_fetch_assoc($sql)) {
                                                ?>
                                                    <tr>
                                                        <td><?= $no++ ?></td>
                                                        <td><?= $r['nama'] ?></td>
                                                        <td><?= $r['daerah'] ?></td>
                                                        <td><a href="<?= 'hapus.php?kd=kmp&id=' . $r['id_komplek'] ?>" onclick="return confirm('Yakiin akan dihapus ?')"><button class="btn btn-danger btn-minier"><i class="fa fa-trash"></i> Dele</button></a></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="col-md-5">
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
                                                    <div class="form-group">
                                                        <label>Input Komplek Baru</label>
                                                        <input type="text" name="nama" class="form-control" placeholder="Masukan nama komplek" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Daerah</label>
                                                        <select name="daerah" id="" class="form-control" required>
                                                            <option value=""> -pilih- </option>
                                                            <option value="putra"> Putra</option>
                                                            <option value="putri"> Putri</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" name="save" class="btn btn-success btn-sm">Simpan Data</button>
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

if (isset($_POST['save'])) {
    $nama = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['nama']));
    $daerah = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['daerah']));

    $sql = mysqli_query($conn, "INSERT INTO komplek VALUES ('', '$nama', '$daerah') ");
    if ($sql) {
        echo "
            <script>
                window.location = 'komplek.php' ;
            </script>
        ";
    }
}
?>