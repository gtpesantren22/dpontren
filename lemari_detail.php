<?php
include 'head.php';
$kamar = $_GET['kd'];
$lemari = $_GET['lmr'];

$dt = mysqli_query($conn, "SELECT * FROM lemari_data WHERE kamar = '$kamar' AND lemari = '$lemari' ");
$qr2 = mysqli_query($conn, "SELECT * FROM lemari_data WHERE jkl = 'putra' AND kamar = '$kamar' GROUP BY lemari ");
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

                    <div class="table-header">
                        <?php
                        while ($rr2 = mysqli_fetch_assoc($qr2)) {
                        ?>
                            <a class="btn btn-xs btn-warning" href="<?= 'lemari_detail.php?kd=' . $rr2['kamar'] . '&lmr=' . $rr2['lemari'] ?>">Lemari <?= $rr2['lemari'] ?></a>
                        <?php } ?>
                    </div>
                    <div class="table-responsive">
                        <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Komplek</th>
                                    <th>Kamar</th>
                                    <th>No Lemari</th>
                                    <th>No Loker</th>
                                    <th>Wali Asuh</th>
                                    <th>Nama Santri</th>
                                    <th>Ket</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                while ($rr = mysqli_fetch_assoc($dt)) {
                                    $ni = $rr['nis'];
                                    $cek = mysqli_query($conn, "SELECT * FROM tb_santri WHERE nis = '$ni' ");
                                    $r2  = mysqli_fetch_assoc($cek);
                                    $jmm  = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM lemari_data WHERE nis = '$ni' "));
                                    $clor = $jmm > 1 ? "style='background-color: red; color: white;'" : "";
                                ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $rr['komplek']; ?></td>
                                        <td><?= $rr['kamar']; ?></td>
                                        <td><?= $rr['lemari']; ?></td>
                                        <td><?= $rr['loker']; ?></td>
                                        <td><?= $rr['wali']; ?></td>
                                        <td <?= $clor; ?>><?= $r2['nama']; ?></td>
                                        <td><?= $rr['ket']; ?></td>
                                        <td>
                                            <div class="btn-group">
                                                <button data-toggle="dropdown" class="btn btn-minier btn-primary dropdown-toggle">
                                                    Action
                                                    <i class="ace-icon fa fa-angle-down icon-on-right"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-danger">
                                                    <li>
                                                        <a href="<?= 'lemari_edit.php?id=' . $rr['id_ldata'] ?>">Details</a>
                                                    </li>
                                                    <li>
                                                        <a href="<?= 'hapus.php?kd=lmrd_s&id=' . $rr['id_ldata'] ?>" onclick="return confirm('Yakiin akan dihapus ?')">Hapus</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>

                                    </tr>
                                <?php } ?>
                            </tbody>

                        </table>
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