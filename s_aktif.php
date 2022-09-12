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
                                Data santri yang masih aktif di pesantren
                                <a href="excel1.php" target="_blank" class="btn btn-success btn-sm pull-right"><i class="fa fa-download"></i> Export to Excel</a>
                                <button class="btn btn-warning btn-sm pull-right" data-toggle="modal" data-target="#exampleModal"><i class=" fa fa-plus"></i> Tambah data baru</button>
                            </div>

                            <!-- div.table-responsive -->

                            <!-- div.dataTables_borderWrap -->
                            <div class="table-responsive">
                                <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>NIS</th>
                                            <th>Nama</th>
                                            <th>Alamat</th>
                                            <th>Kelas</th>
                                            <th>#</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $sql = mysqli_query($conn, "SELECT * FROM tb_santri WHERE aktif = 'Y' ");
                                        while ($r = mysqli_fetch_assoc($sql)) {
                                            $t = array('Bayar', 'Ust/Usdtz', 'Khaddam', 'Gratis', 'Berhenti');
                                        ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= $r['nis'] ?></td>
                                                <td><?= $r['nama'] ?></td>
                                                <td><?= $r['desa'] . ' - ' . $r['kec'] . ' - ' . $r['kab'] ?></td>
                                                <td><?= $r['k_formal'] . ' - ' . $r['t_formal'] ?></td>
                                                <td>
                                                    <?php if ($level_user === 'admin') { ?>
                                                        <div class="btn-group">
                                                            <button data-toggle="dropdown" class="btn btn-minier btn-primary dropdown-toggle">
                                                                Action
                                                                <i class="ace-icon fa fa-angle-down icon-on-right"></i>
                                                            </button>
                                                            <ul class="dropdown-menu dropdown-danger">
                                                                <li>
                                                                    <a href="<?= 'edit.php?nis=' . $r['nis'] ?>">Edit</a>
                                                                </li>
                                                                <li>
                                                                    <a href="<?= 'back.php?nis=' . $r['nis'] ?>">Keluar</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    <?php } ?>
                                                    <!-- <a href="<?= 'edit.php?nis=' . $r['nis'] ?>"><button class="btn btn-primary btn-minier"><i class="fa fa-edit"></i></button></a> -->
                                                    <!-- <a href="<?= 'back.php?nis=' . $r['nis'] ?>"><button class="btn btn-danger btn-minier"><i class="fa fa-times"></i></button></a> -->
                                                </td>
                                            </tr>
                                        <?php } ?>
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

if (isset($_POST['simpan'])) {
    $nis = $_POST['nis'];

    $cek = mysqli_query($conn, "SELECT * FROM tb_santri WHERE nis = '$nis' ");

    if (mysqli_num_rows($cek) > 0) {
        echo "
        <script>
            alert('Maaf. NIS sudah terpakai');
            window.location = 's_aktif.php';
        </script>
        ";
    } else {
        $sql = mysqli_query($conn, "INSERT INTO tb_santri (nis, aktif) VALUES ('$nis', 'Y') ");
        if ($sql) {
            echo "
        <script>
            alert('Data sudah masuk');
            window.location = 'edit.php?nis=" . $nis . "';
        </script>
        ";
        }
    }
}
?>