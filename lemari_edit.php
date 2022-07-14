<?php
include 'head.php';
$id = $_GET['id'];
$dt = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM lemari_data WHERE id_ldata = '$id' "));

$link_back = 'lemari_detail.php?kd=' . $dt['kamar'];
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
                    <div class="widget-box">
                        <div class="widget-header">
                            <h4 class="widget-title">Edit Data Lemari</h4>

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
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Komplek</label>
                                                <input type="text" class="form-control" value="<?= $dt['komplek']; ?>" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label>Pilih Kamar</label>
                                                <input type="text" class="form-control" value="<?= $dt['kamar']; ?>" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label>Kode Lemari</label>
                                                <input type="text" class="form-control" value="<?= $dt['lemari']; ?>" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label>No. Loker</label>

                                                <input type="text" class="form-control" value="<?= $dt['loker']; ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Pilih Wali Asuh</label>
                                                <select name="wali" id="" class="chosen-select form-control" required>
                                                    <option value=""> -pilih wali asuh- </option>
                                                    <?php
                                                    $sql = mysqli_query($conn, "SELECT * FROM wali_asuh");
                                                    while ($dr = mysqli_fetch_assoc($sql)) { ?>
                                                        <option <?= $dt['wali'] == $dr['nama'] ? 'selected' : ''; ?> value="<?= $dr['nama']; ?>"><?= $dr['nama']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Pilih Santri</label>
                                                <select name="nis" id="" class="chosen-select2 form-control" required>
                                                    <option value=""> -pilih santri- </option>
                                                    <?php
                                                    $sql = mysqli_query($conn, "SELECT * FROM tb_santri WHERE aktif = 'Y' ");
                                                    while ($dr = mysqli_fetch_assoc($sql)) { ?>
                                                        <option <?= $dt['nis'] == $dr['nis'] ? 'selected' : ''; ?> value="<?= $dr['nis']; ?>"><?= $dr['nama']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Kondisi lemari</label><br>
                                                <input type="radio" name="kondisi" value="bagus" <?= $dt['ket'] == 'bagus' ? 'checked' : ''; ?>> Bagus
                                                <input type="radio" name="kondisi" value="rusak" <?= $dt['ket'] == 'rusak' ? 'checked' : ''; ?>> Rusak
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" name="save" class="btn btn-success btn-sm">Simpan Data</button>
                                    </div>
                                </form>
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

if (isset($_POST['save'])) {

    $nis = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['nis']));
    $wali = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['wali']));
    $kondisi = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['kondisi']));

    $sql = mysqli_query($conn, "UPDATE lemari_data SET nis = '$nis', wali = '$wali', ket = '$kondisi' WHERE id_ldata = '$id' ");
    if ($sql) {
        echo "
            <script>
                window.location = '" . $link_back . "' ;
            </script>
        ";
    }
}
?>