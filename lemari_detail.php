<?php
include 'head.php';
$kamar = $_GET['kd'];
$lemari = $_GET['lmr'];
$link_back = 'lemari_detail.php?kd=' . $kamar . '&lmr=' . $lemari;

$dt = mysqli_query($conn, "SELECT * FROM lemari_data WHERE kamar = '$kamar' AND lemari = '$lemari' ");
$lemaridata = mysqli_fetch_assoc($dt);
$jkl = $lemaridata['jkl'];

$qr2 = mysqli_query($conn, "SELECT * FROM lemari_data WHERE jkl = '$jkl' AND kamar = '$kamar' GROUP BY lemari ");
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
                        <?php while ($rr2 = mysqli_fetch_assoc($qr2)) { ?>
                            <a class="btn btn-xs btn-warning" href="<?= 'lemari_detail.php?kd=' . $rr2['kamar'] . '&lmr=' . $rr2['lemari'] ?>">Lemari <?= $rr2['lemari'] ?></a>
                        <?php } ?>
                        <button class="btn btn-xs btn-danger pull-right" data-toggle="modal" data-target="#tesModal">Tambah Loker Baru</button>
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
                                    $jmm  = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM lemari_data WHERE nis = '$ni' "));
                                    $clor = $jmm > 1 ? "style='background-color: red; color: white;'" : "";
                                    $jkl = $rr['jkl'] === 'putra' ? 'Laki-laki' : 'Perempuan';
                                    $sntr = mysqli_query($conn, "SELECT * FROM tb_santri WHERE aktif = 'Y' AND jkl = '$jkl' ");
                                    // AND NOT EXISTS (SELECT * FROM lemari_data WHERE tb_santri.nis=lemari_data.nis) ");
                                    $sndata = mysqli_fetch_assoc(mysqli_query($conn, "SELECT nama FROM tb_santri WHERE nis = '$ni' "));
                                    $ash = mysqli_query($conn, "SELECT * FROM wali_asuh WHERE jkl = '$jkl' ");

                                ?>
                                    <tr>
                                        <form action="" method="post">
                                            <td><?= $no++; ?></td>
                                            <td><?= $rr['komplek']; ?></td>
                                            <td><?= $rr['kamar']; ?></td>
                                            <td><?= $rr['lemari']; ?></td>
                                            <td><?= $rr['loker']; ?></td>
                                            <td>
                                                <input type="hidden" name="id" value="<?= $rr['id_ldata'] ?>">
                                                <select name="wali" class="chosen-select2 form-control input-sm" id="">
                                                    <!-- <option value=""><?= $rr['wali'] != '' ? $rr['wali'] : '-plih wali asuh-' ?></option> -->
                                                    <option value=""> -pilih wali asuh- </option>
                                                    <?php while ($wash = mysqli_fetch_assoc($ash)) { ?>
                                                        <option <?= $rr['wali'] == $wash['nama'] ? 'selected' : '' ?> value="<?= $wash['nama'] ?>"><?= $wash['nama'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </td>
                                            <td <?= $clor; ?>>
                                                <select name="nis" class="chosen-select2 form-control input-sm" id="">
                                                    <!-- <option value=""><?= $rr['nis'] != '' ? $sndata['nama'] : '-plih santri-' ?></option> -->
                                                    <option value=""> -pilih santri- </option>
                                                    <?php while ($snn = mysqli_fetch_assoc($sntr)) { ?>
                                                        <option <?= $rr['nis'] == $snn['nis'] ? 'selected' : '' ?> value="<?= $snn['nis'] ?>"><?= $snn['nama'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </td>
                                            <td>
                                                <select name="ket" class="form-control input-sm" id="">
                                                    <option value=""> -pilih- </option>
                                                    <option <?= $rr['ket'] === 'bagus' ? 'selected' : ''; ?> value="bagus">Bagus</option>
                                                    <option <?= $rr['ket'] === 'rusak' ? 'selected' : ''; ?> value="rusak">Rusak</option>
                                                </select>
                                            </td>
                                            <td>
                                                <button class="btn btn-minier btn-success" type="submit" name="save">
                                                    Simpan
                                                    <i class="ace-icon fa fa-check icon-on-right"></i>
                                                </button>
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
                                        </form>
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

<div class="modal fade" id="tesModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- header-->
            <div class="modal-header">
                <button class="close" data-dismiss="modal"><span>&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Tambah Loker Baru</h4>
            </div>
            <!--body-->
            <div class="modal-body">
                <form action="" method="post">
                    <div class="form-group">
                        <!-- <label>Komplek</label> -->
                        <input type="text" name="komplek" class="form-control" placeholder="Masukan nama komplek" value="<?= $lemaridata['komplek'] ?>" readonly>
                    </div>
                    <div class="form-group">
                        <!-- <label>Komplek</label> -->
                        <input type="text" name="kamar" class="form-control" placeholder="Masukan nama komplek" value="<?= $lemaridata['kamar'] ?>" readonly>
                    </div>
                    <div class="form-group">
                        <input type="text" name="lemari" class="form-control" placeholder="Masukan nama komplek" value="<?= $lemaridata['lemari'] ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Input No. Loker</label>
                        <input type="text" name="loker" class="form-control" placeholder="Masukan nomor loker" required>
                    </div>

                    <div class="form-group">
                        <button type="submit" name="addLoker" class="btn btn-success btn-sm">Simpan Data</button>
                    </div>
                </form>
            </div>
            <!--footer-->
            <div class="modal-footer">
                <button class="btn btn-danger" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<?php
include 'foot.php';

if (isset($_POST['save'])) {
    $id = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['id']));
    $wali = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['wali']));
    $nis = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['nis']));
    $ket = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['ket']));

    // $cek = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM lemari_data  WHERE nis = '$nis'  "));
    // if ($cek > 0) {
    //     echo "
    //         <script>
    //             alert('Maaf santri sudah ada kamarnya');
    //              window.location = '" . $link_back . "' ;
    //         </script>
    //     ";
    // } else {

    // }

    $sql = mysqli_query($conn, "UPDATE lemari_data SET wali = '$wali', nis = '$nis',ket = '$ket' WHERE id_ldata = $id  ");
    if ($sql) {
        echo "
        <script>
        window.location = '" . $link_back . "' ;
            </script>
        ";
    }
}

if (isset($_POST['addLoker'])) {
    $komplek = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['komplek']));
    $kamar = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['kamar']));
    $lemari = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['lemari']));
    $loker = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['loker']));

    $sql = mysqli_query($conn, "INSERT INTO lemari_data VALUES ('', '$komplek', '$kamar', '$lemari', '$loker', '', '', '$jkl', 'bagus') ");
    if ($sql) {
        echo "
        <script>
        window.location = '" . $link_back . "' ;
            </script>
        ";
    }
}
?>