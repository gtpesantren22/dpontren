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
                <li class="active">Tarik Data Santri Baru dari PSB</li>
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
                        Data Santri Yang ada di PSB (belum ditarik ke D'Pontren)
                    </small>
                </h1>
            </div><!-- /.page-header -->

            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->

                    <div class="row">
                        <div class="col-xs-12">

                            <div class="table-header">
                                <form action="f_tarik.php?snc=exc" method="post">
                                    Data santri yang masih belum ditarik ke D'Pontren
                                    <button type="submit" class="btn btn-sm pull-right btn-warning"><i class="fa fa-refresh"></i> Refresh Data</button>
                                </form>
                            </div>

                            <!-- div.table-responsive -->

                            <!-- div.dataTables_borderWrap -->
                            <div class="table-responsive">
                                <table id="dynamic-table" class="table table-striped table-bordered table-hover table-sm">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>NIS</th>
                                            <th>Nama</th>
                                            <th>Alamat</th>
                                            <th>Sekolah</th>
                                            <th>#</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $sql = mysqli_query($conn, "SELECT * FROM datas ");
                                        while ($r = mysqli_fetch_assoc($sql)) {
                                            $nis = $r['nis'];
                                            $cek = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tb_santri WHERE nis = '$nis' "));
                                        ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= $r['nis'] ?></td>
                                                <td><?= $r['nama'] ?></td>
                                                <td><?= $r['desa'] . ' - ' . $r['kec'] . ' - ' . $r['kab'] ?></td>
                                                <td><?= $tl[$r['lembaga']] ?></td>
                                                <td>
                                                    <?php if ($cek == 1) { ?>
                                                        <span class="label label-success"><i class="fa fa-check"></i> sudah</span>
                                                        <button type="button" class="btn btn-primary btn-minier" disabled>
                                                            <i class="fa fa-cloud-download"></i> Tarik Data
                                                        </button>
                                                    <?php } else { ?>
                                                        <span class="label label-danger"><i class="fa fa-times"></i> belum</span>
                                                        <button type="button" class="btn btn-primary btn-minier" data-toggle="modal" data-target="#exampleModal<?= $r['nis'] ?>">
                                                            <i class="fa fa-cloud-download"></i> Tarik Data
                                                        </button>
                                                    <?php } ?>
                                                </td>
                                            </tr>

                                            <div class="modal fade" id="exampleModal<?= $r['nis'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <form action="" method="post">
                                                            <input type="hidden" name="nis" value="<?= $r['nis'] ?>">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Modal title
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </h5>
                                                            </div>
                                                            <div class="modal-body">
                                                                Apakah yakin akan menarik data ini dari data PSB ?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button type="submit" name="tarik" class="btn btn-primary">Ya, Tarik sis !</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
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

<?php
include 'foot.php';
if (isset($_POST['tarik'])) {

    $nis = $_POST['nis'];
    $dtas = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM datas WHERE nis = '$nis' "));

    $nik = $dtas['nik'];
    $no_kk = $dtas['no_kk'];
    $nama = $dtas['nama'];
    $tempat = $dtas['tempat'];
    $tanggal = $dtas['tanggal'];
    $jkl = $dtas['jkl'];
    $t_formal = $tl[$dtas['lembaga']];
    $jln = $dtas['jln'];
    $rt = $dtas['rt'];
    $rw = $dtas['rw'];
    $desa = $dtas['desa'];
    $kec = $dtas['kec'];
    $kab = $dtas['kab'];
    $prov = $dtas['prov'];
    $bapak = $dtas['bapak'];
    $ibu = $dtas['ibu'];
    $hp = $dtas['hp'];
    $password = $dtas['password'];
    $stts = $dtas['stts'];
    $anak_ke = $dtas['anak_ke'];
    $jml_sdr = $dtas['jml_sdr'];
    $a_pkj = $dtas['a_pkj'];
    $i_pkj = $dtas['i_pkj'];
    $ket = $dtas['ket'];
    $t_kos = $dtas['t_kos'];
    $kamar = $dtas['kamar'];
    $komplek = $dtas['komplek'];

    $sql = mysqli_query($conn, "INSERT INTO tb_santri (nis, nik, no_kk, nama, tempat, tanggal, jkl, t_formal, jln, rt, rw, desa, kec, kab, prov, bapak, ibu, hp, pass, anak_ke, jml_sdr, pkj_a, pkj_i, ket, t_kos, kamar, komplek) VALUES ('$nis', '$nik', '$no_kk', '$nama', '$tempat', '$tanggal', '$jkl', '$t_formal', '$jln', '$rt', '$rw', '$desa', '$kec', '$kab', '$prov', '$bapak', '$ibu', '$hp', '$password', '$anak_ke', '$jml_sdr', '$a_pkj', '$i_pkj', '$ket', '$t_kos', '$kamar', '$komplek') ");

    if ($sql) {
        echo "
        <script>
            window.location = 'tarik.php';
        </script>
        ";
    }
}
?>