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
                <li class="active">Data Santri Non Aktif</li>
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
                    Tables
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        Static &amp; Dynamic Tables
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
                                        $sql = mysqli_query($conn, "SELECT * FROM tb_santri WHERE aktif = 'T' ");
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
                                                        <a href="<?= 'edit.php?nis=' . $r['nis'] ?>"><button class="btn btn-primary btn-minier"><i class="fa fa-edit"></i></button></a>
                                                        <a href="<?= 'back.php?nis=' . $r['nis'] ?>"><button class="btn btn-danger btn-minier"><i class="fa fa-times"></i></button></a>
                                                    <?php } ?>
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

<?php
include 'foot.php';
?>