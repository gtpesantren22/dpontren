<?php
include 'head.php';
$dt = mysqli_query($conn, "SELECT * FROM kamar WHERE jkl = 'Laki-laki' ");
$dt1 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM kamar WHERE jkl = 'Laki-laki'"));
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
                <li class="active">Data Lemasi dan Loker</li>
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
                        Data Lemari
                    </small>
                </h1>
            </div><!-- /.page-header -->

            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->

                    <div class="row">
                        <div class="col-xs-12">

                            <!-- div.table-responsive -->
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="table-header">
                                        Data Lemari Wilayah Putra
                                    </div>
                                    <div class="table-responsive">
                                        <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Kamar</th>
                                                    <th>Komplek</th>
                                                    <th>Jml Lemari</th>
                                                    <th>Jml Loker</th>
                                                    <th>#</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 1;
                                                $qr = mysqli_query($conn, "SELECT *, COUNT(loker) AS jml_lok, COUNT(lemari) AS jml_lm FROM lemari_data WHERE jkl = 'putra' GROUP BY kamar ");
                                                while ($rr = mysqli_fetch_assoc($qr)) {
                                                    $kmr = $rr['kamar'];
                                                    $qr2 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM lemari_data WHERE jkl = 'putra' AND kamar = '$kmr' GROUP BY lemari "));
                                                ?>
                                                    <tr>
                                                        <td><?= $no++; ?></td>
                                                        <td><?= $rr['kamar']; ?></td>
                                                        <td><?= $rr['komplek']; ?></td>
                                                        <td><?= $qr2; ?></td>
                                                        <td><?= $rr['jml_lok']; ?></td>
                                                        <td>
                                                            <div class="btn-group">
                                                                <button data-toggle="dropdown" class="btn btn-minier btn-primary dropdown-toggle">
                                                                    Action
                                                                    <i class="ace-icon fa fa-angle-down icon-on-right"></i>
                                                                </button>
                                                                <ul class="dropdown-menu dropdown-danger">
                                                                    <li>
                                                                        <a href="<?= 'lemari_detail.php?kd=' . $rr['kamar'] ?>">Details</a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="<?= 'hapus.php?kd=lmrd&id=' . $rr['id_ldata'] ?>" onclick="return confirm('Yakiin akan dihapus ?')">Hapus</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </td>

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
                                                        <label>Pilih Komplek</label>
                                                        <select name="komplek" id="komplek" class="form-control" required>
                                                            <option value=""> -pilih komplek- </option>
                                                            <?php
                                                            $sql = mysqli_query($conn, "SELECT * FROM komplek");
                                                            while ($dr = mysqli_fetch_assoc($sql)) { ?>
                                                                <option value="<?= $dr['nama']; ?>"><?= $dr['nama']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Pilih Kamar</label>
                                                        <select name="kamar" id="kmr" class="form-control" required>
                                                            <option value=""> -pilih kamar- </option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Kode Lemari</label>
                                                        <input type="text" name="kode" class="form-control" placeholder="Masukan kode atau No. Lemari" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>No. Loker</label>

                                                        <div class="input-group">
                                                            <input type="number" class="input-sm form-control" name="start" placeholder="Dari Nomor" required>
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-exchange"></i>
                                                            </span>
                                                            <input type="number" class="input-sm form-control" name="end" placeholder="Sampai Nomor" required>
                                                        </div>
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
                            <hr>
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="table-header">
                                        Data Lemari Wilayah Putri
                                    </div>
                                    <div class="table-responsive">
                                        <table id="dynamic-table2" class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Kamar</th>
                                                    <th>Komplek</th>
                                                    <th>Jml Lemari</th>
                                                    <th>Jml Loker</th>
                                                    <th>#</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 1;
                                                $qr = mysqli_query($conn, "SELECT *, COUNT(loker) AS jml_lok, COUNT(lemari) AS jml_lm FROM lemari_data WHERE jkl = 'putri' GROUP BY kamar ");
                                                while ($rr = mysqli_fetch_assoc($qr)) {
                                                    $kmr = $rr['kamar'];
                                                    $qr2 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM lemari_data WHERE jkl = 'putri' AND kamar = '$kmr' GROUP BY lemari "));
                                                ?>
                                                    <tr>
                                                        <td><?= $no++; ?></td>
                                                        <td><?= $rr['kamar']; ?></td>
                                                        <td><?= $rr['komplek']; ?></td>
                                                        <td><?= $qr2; ?></td>
                                                        <td><?= $rr['jml_lok']; ?></td>
                                                        <td>
                                                            <div class="btn-group">
                                                                <button data-toggle="dropdown" class="btn btn-minier btn-primary dropdown-toggle">
                                                                    Action
                                                                    <i class="ace-icon fa fa-angle-down icon-on-right"></i>
                                                                </button>
                                                                <ul class="dropdown-menu dropdown-danger">
                                                                    <li>
                                                                        <a href="<?= 'lemari_detail.php?kd=' . $rr['kamar'] ?>">Details</a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="<?= 'hapus.php?kd=lmrd&id=' . $rr['id_ldata'] ?>" onclick="return confirm('Yakiin akan dihapus ?')">Hapus</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </td>

                                                    </tr>
                                                <?php } ?>
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>

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
    $komplek = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['komplek']));
    $kamar = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['kamar']));
    $kode = 'L-' . htmlspecialchars(mysqli_real_escape_string($conn, $_POST['kode']));
    $start = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['start']));
    $end = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['end']));

    $dtkmp = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM komplek WHERE nama = '$komplek' "));
    $jkl = $dtkmp['daerah'];

    for ($i = $start; $i <= $end; $i++) {
        $sql = mysqli_query($conn, "INSERT INTO lemari_data VALUES ('', '$komplek', '$kamar', '$kode', '$i', '', '', '$jkl', 'bagus') ");
    }
    if ($sql) {
        echo "
            <script>
                window.location = 'lemari.php' ;
            </script>
        ";
    }
}
?>