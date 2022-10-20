<?php

include 'head.php';
include 'fungsi.php';

$nis = $_GET['nis'];
$r = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tb_santri WHERE nis = '$nis' "));

$bln = array(
    "", "Januari", "Februari", "Maret", "April", "Mei",
    "Juni", "Juli", "Agustus", "September", "Oktober",
    "November", "Desember"
);

$st = explode("-", $r['stts']);

$tgl = $r['tanggal'] == '' ? '00-00-0000' : $r['tanggal'];
$tglB = $r['tanggal_a'] == '' ? '00-00-0000' : $r['tanggal_a'];
$tglI = $r['tanggal_i'] == '' ? '00-00-0000' : $r['tanggal_i'];
$tglW = $r['tanggal_w'] == '' ? '00-00-0000' : $r['tanggal_w'];

$split = explode('-', $tgl);
$tgl_a = $split[0];
$bln_a =  $split[1];
$thn_a = $split[2];

$split1 = explode('-', $tglB);
$tgl_b = $split1[0];
$bln_b =  $split1[1];
$thn_b = $split1[2];

$spliti = explode('-', $tglI);
$tgl_i = $spliti[0];
$bln_i = $spliti[1];
$thn_i = $spliti[2];

$splitw = explode('-', $tglW);
$tgl_w = $splitw[0];
$bln_w = $splitw[1];
$thn_w = $splitw[2];
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
                    <a href="#">Other Pages</a>
                </li>
                <li class="active">FAQ</li>
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
                    FAQ
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        frequently asked questions using tabs and accordions
                    </small>
                </h1>
            </div><!-- /.page-header -->

            <div class="row">
                <div class="col-xs-2">
                    <span class="profile-picture">
                        <?php
                        if ($r['foto'] != '') { ?>
                            <img id="avatar" class="editable img-responsive" alt="Alex's Avatar" src="images/santri/<?= $r['foto']; ?>" />
                        <?php } else { ?>
                            <img id="avatar" class="editable img-responsive" alt="Alex's Avatar" src="assets/images/avatars/profile-pic.jpg" />
                        <?php } ?>
                    </span>

                    <div class="space-4"></div>

                    <div class="alert alert-danger">
                        <center><?= $r['nama']; ?></center>
                    </div>
                    <div class="space-6"></div>

                    <div class="profile-contact-info">
                        <div class="profile-contact-links align-left">
                            <a href="#" class="btn btn-link">
                                NIS : <?= $r['nis']; ?>
                            </a>

                            <a href="#" class="btn btn-link">
                                NISN : <?= $r['nisn']; ?>
                            </a>
                        </div>

                        <div class="space-6"></div>

                        <div class="profile-social-links align-center">
                            <a href="#" class="tooltip-info" title="" data-original-title="Visit my Facebook">
                                <i class="middle ace-icon fa fa-facebook-square fa-2x blue"></i>
                            </a>

                            <a href="#" class="tooltip-info" title="" data-original-title="Visit my Twitter">
                                <i class="middle ace-icon fa fa-twitter-square fa-2x light-blue"></i>
                            </a>

                        </div>
                    </div>
                </div>
                <div class="col-xs-10">
                    <!-- PAGE CONTENT BEGINS -->
                    <div class="tabbable">
                        <ul class="nav nav-tabs padding-18 tab-size-bigger" id="myTab">
                            <li class="active">
                                <a data-toggle="tab" href="#faq-tab-1">
                                    <i class="blue ace-icon fa fa-user bigger-120"></i>
                                    Identitas Santri
                                </a>
                            </li>

                            <li>
                                <a data-toggle="tab" href="#faq-tab-2">
                                    <i class="green ace-icon fa fa-users bigger-120"></i>
                                    Mahrom santri
                                </a>
                            </li>

                            <li>
                                <a data-toggle="tab" href="#faq-tab-3">
                                    <i class="orange ace-icon fa fa-home bigger-120"></i>
                                    Domisili santri
                                </a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#faq-tab-4">
                                    <i class="red ace-icon fa fa-graduation-cap bigger-120"></i>
                                    Pendidikan Formal
                                </a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#faq-tab-5">
                                    <i class="purple ace-icon fa  fa-file-text bigger-120"></i>
                                    Pendidikan Madin
                                </a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#faq-tab-6">
                                    <i class="dark ace-icon fa fa-info bigger-120"></i>
                                    Lainnya
                                </a>
                            </li>

                        </ul>

                        <div class="tab-content no-border padding-24">
                            <div id="faq-tab-1" class="tab-pane fade in active">
                                <h4 class="blue">
                                    <i class="ace-icon fa fa-user bigger-110"></i>
                                    Data Identitas Santri
                                </h4>

                                <div class="space-8"></div>

                                <div class="row">
                                    <form action="" method="post">

                                        <div class="col-md-6">
                                            <!-- <div class="">
                                            <div class="form-group col-sm-6">
                                                <label>NIS *</label>
                                                <input type="text" name="nis" class="form-control" placeholder="Email" readonly value="<?= $nis; ?>">
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label>NISN</label>
                                                <input type="text" name="nisn" class="form-control" placeholder="Password" value="<?= $r['nisn']; ?>">
                                            </div>
                                        </div> -->
                                            <div class="">
                                                <div class="form-group col-sm-6">
                                                    <label>NIK *</label>
                                                    <input type="text" name="nik" maxlength="16" class="form-control" placeholder="NIK berdasarkan KK" required value="<?= $r['nik']; ?>">
                                                </div>
                                                <div class="form-group col-sm-6">
                                                    <label>No. KK *</label>
                                                    <input type="text" name="no_kk" maxlength="16" class="form-control" placeholder="Nomor KK" required value="<?= $r['no_kk']; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group col-sm-12">
                                                <label>Nama Lengkap *</label>
                                                <input type="text" name="nama" class="form-control" placeholder="" required value="<?= $r['nama']; ?>">
                                            </div>
                                            <div class="form-group col-sm-12">
                                                <label>Tempat Lahir *</label>
                                                <input type="text" name="tempat" class="form-control" placeholder="" required value="<?= $r['tempat']; ?>">
                                            </div>
                                            <div class="">
                                                <div class="form-group col-md-4">
                                                    <label>Tanggal Lahir *</label>
                                                    <select name="tgl" id="" class="form-control" required>
                                                        <option value=""> -Tanggal- </option>
                                                        <?php
                                                        for ($tanggal = 1; $tanggal <= 31; $tanggal++) {
                                                            $i = $tanggal;
                                                            if ($tgl_a == $i) {
                                                                echo "<option value=$i selected>$i</option>";
                                                            } else {
                                                                echo "<option value=$i>$i</option>";
                                                            }
                                                            echo "<option value=$i>$i</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label>Bulan Lahir</label>
                                                    <select name="bulan" id="" class="form-control" required>
                                                        <option value=""> -Bulan- </option>
                                                        <?php
                                                        for ($bulan = 1; $bulan <= 12; $bulan++) {
                                                            if ($bln_a == $bulan) {
                                                                echo "<option value=$bulan selected>$bln[$bulan]</option>";
                                                            } else {
                                                                echo "<option value=$bulan>$bln[$bulan]</option>";
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label>Tahun Lahir</label>
                                                    <select name="tahun" id="" class="form-control" required>
                                                        <option value=""> -Tahun- </option>
                                                        <?php
                                                        $now = date("Y");
                                                        for ($tahun = 1945; $tahun <= $now; $tahun++) {
                                                            if ($thn_a == $tahun) {
                                                                echo "<option value=$tahun selected>$tahun</option>";
                                                            } else {
                                                                echo "<option value=$tahun>$tahun</option>";
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="control-group col-sm-12 ">
                                                <label>Jenis Kelamin *</label>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" class="ace" name="jkl" value="Laki-laki" <?= $r['jkl'] == 'Laki-laki' ? 'checked' : ''; ?> required />
                                                        <span class="lbl"> Laki-laki</span>

                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" class="ace" name="jkl" value="Perempuan" <?= $r['jkl'] == 'Perempuan' ? 'checked' : ''; ?> required />
                                                        <span class="lbl"> Perempuan</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="">
                                                <div class="form-group col-sm-6">
                                                    <label>Anak ke *</label>
                                                    <input type="number" name="anak_ke" class="form-control" placeholder="" required value="<?= $r['anak_ke']; ?>">
                                                </div>
                                                <div class="form-group col-sm-6">
                                                    <label>Jumlah Saudara *</label>
                                                    <input type="number" name="jml_sdr" class="form-control" placeholder="" required value="<?= $r['jml_sdr']; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label>Jln/Dusun *</label>
                                                <textarea name="jln" rows="3" class="form-control h-150px" required><?= $r['jln']; ?></textarea>
                                            </div>
                                            <div class="">
                                                <div class="form-group col-md-4">
                                                    <label>RT *</label>
                                                    <input type="text" name="rt" class="form-control" placeholder="RT" value="<?= $r['rt']; ?>" required>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label>RW *</label>
                                                    <input type="text" name="rw" class="form-control" placeholder="RW" value="<?= $r['rw']; ?>" required>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label>Kode Pos</label>
                                                    <input type="text" name="kd_pos" class="form-control" placeholder="Kode Pos" value="<?= $r['kd_pos']; ?>">
                                                </div>
                                            </div>
                                            <div class="">
                                                <div class="form-group col-md-6">
                                                    <label>Provinsi *<b><i>(<?= $r['prov']; ?>)</i></b></label>
                                                    <select name="prop" id="provinsi" class="form-control ">
                                                        <option value="">Pilih Provinsi</option>
                                                        <?php
                                                        $sq = mysqli_query($conn, "SELECT * FROM provinsi");
                                                        while ($kl = mysqli_fetch_assoc($sq)) {
                                                        ?>
                                                            <option value="<?= $kl['id_prov'] ?>"><?= $kl['nama'] ?>
                                                            </option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Kabupaten/Kota *<b><i>(<?= $r['kab']; ?>)</i></b></label>
                                                    <select name="kota" id="kabupaten" class="form-control ">
                                                        <option value=""></option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Kecamatan *<b><i>(<?= $r['kec']; ?>)</i></b></label>
                                                    <select name="kec" id="kecamatan" class="form-control ">
                                                        <option value=""></option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Desa/Kelurahan *<b><i>(<?= $r['desa']; ?>)</i></b></label>
                                                    <select name="kel" id="kelurahan" class="form-control ">
                                                        <option value=""></option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <button class="btn btn-primary btn-block btn-sm" type="submit" name="tab1"><i class="fa fa-check"></i> Simpan perubahan pada Tab ini</button>
                                        </div>
                                    </form>

                                </div>
                            </div>

                            <div id="faq-tab-2" class="tab-pane fade">
                                <div class="row">
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="col-md-6">
                                            <h4 class="blue">
                                                <i class="green ace-icon fa fa-user bigger-110"></i>
                                                Data Bapak
                                            </h4>

                                            <div class="space-8"></div>
                                            <div class="form-group">
                                                <label>NIK</label>
                                                <input type="text" name="nik_a" class="form-control" placeholder="" value="<?= $r['nik_a']; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Nama Lengkap *</label>
                                                <input type="text" name="bapak" class="form-control" placeholder="" required value="<?= $r['bapak']; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Pendidikan</label>
                                                <select name="pend_a" id="" class="form-control">
                                                    <option value="">Pilih Pendidikan</option>
                                                    <?php
                                                    $sq = mysqli_query($conn, "SELECT * FROM pdd");
                                                    while ($kl = mysqli_fetch_assoc($sq)) {
                                                    ?>
                                                        <option <?= $r['pend_a'] == $kl['nama_pdd'] ? 'selected' : ''; ?> value="<?= $kl['nama_pdd'] ?>"><?= $kl['nama_pdd'] ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Foto Bapak</label><br>
                                                <img src="images/wali/<?= $r['foto_a']; ?>" height="100">
                                                <input type="file" name="foto_a" class="form-control" placeholder="">
                                            </div>
                                            <div class="form-group">
                                                <label>Tempat Lahir</label>
                                                <input type="text" name="tempat_a" class="form-control" placeholder="" value="<?= $r['tempat_a']; ?>">
                                            </div>
                                            <div class="">
                                                <div class="form-group col-md-4">
                                                    <label>Tanggal Lahir</label>
                                                    <select name="tgl_a" id="" class="form-control">
                                                        <option value=""> -Tanggal- </option>
                                                        <?php
                                                        for ($tanggal = 1; $tanggal <= 31; $tanggal++) {
                                                            $i = $tanggal;
                                                            if ($tgl_b == $i) {
                                                                echo "<option value=$i selected>$i</option>";
                                                            } else {
                                                                echo "<option value=$i>$i</option>";
                                                            }
                                                            echo "<option value=$i>$i</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label>Bulan Lahir</label>
                                                    <select name="bulan_a" id="" class="form-control">
                                                        <option value=""> -Bulan- </option>
                                                        <?php
                                                        for ($bulan = 1; $bulan <= 12; $bulan++) {
                                                            if ($bln_b == $bulan) {
                                                                echo "<option value=$bulan selected>$bln[$bulan]</option>";
                                                            } else {
                                                                echo "<option value=$bulan>$bln[$bulan]</option>";
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label>Tahun Lahir</label>
                                                    <select name="tahun_a" id="" class="form-control">
                                                        <option value=""> -Tahun- </option>
                                                        <?php
                                                        $now = date("Y");
                                                        for ($tahun = 1945; $tahun <= $now; $tahun++) {
                                                            if ($thn_b == $tahun) {
                                                                echo "<option value=$tahun selected>$tahun</option>";
                                                            } else {
                                                                echo "<option value=$tahun>$tahun</option>";
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Pekerjaan</label>
                                                <select name="pkj_a" id="" class="form-control">
                                                    <option value="">Pilih Pekerjaan</option>
                                                    <?php
                                                    $sq = mysqli_query($conn, "SELECT * FROM pkj");
                                                    while ($kl = mysqli_fetch_assoc($sq)) {
                                                    ?>
                                                        <option <?= $r['pkj_a'] == $kl['nama'] ? 'selected' : ''; ?> value="<?= $kl['nama'] ?>"><?= $kl['nama'] ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Status Bapak</label><br>
                                                <label class="radio-inline mr-3">
                                                    <input type="radio" name="status_a" value="hidup" <?= $r['status_a'] == 'hidup' ? 'checked' : ''; ?>> Masih Hidup
                                                </label>
                                                <label class="radio-inline mr-3">
                                                    <input type="radio" name="status_a" value="meninggal" <?= $r['status_a'] == 'meninggal' ? 'checked' : ''; ?>> Meninggal
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <h4 class="blue">
                                                <i class="green ace-icon fa fa-user bigger-110"></i>
                                                Data Ibu
                                            </h4>

                                            <div class="space-8"></div>
                                            <div class="form-group">
                                                <label>NIK</label>
                                                <input type="text" name="nik_i" class="form-control" placeholder="" value="<?= $r['nik_i']; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Nama Lengkap *</label>
                                                <input type="text" name="ibu" class="form-control" placeholder="" required value="<?= $r['ibu']; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Pendidikan</label>
                                                <select name="pend_i" id="" class="form-control">
                                                    <option value="">Pilih Pendidikan</option>
                                                    <?php
                                                    $sq = mysqli_query($conn, "SELECT * FROM pdd");
                                                    while ($kl = mysqli_fetch_assoc($sq)) {
                                                    ?>
                                                        <option <?= $r['pend_i'] == $kl['nama_pdd'] ? 'selected' : ''; ?> value="<?= $kl['nama_pdd'] ?>"><?= $kl['nama_pdd'] ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Foto</label><br>
                                                <img src="images/wali/<?= $r['foto_i']; ?>" height="100">
                                                <input type="file" name="foto_i" class="form-control" placeholder="">
                                            </div>
                                            <div class="form-group">
                                                <label>Tempat Lahir</label>
                                                <input type="text" name="tempat_i" class="form-control" placeholder="" value="<?= $r['tempat_i']; ?>">
                                            </div>
                                            <div class="">
                                                <div class="form-group col-md-4">
                                                    <label>Tanggal Lahir</label>
                                                    <select name="tgl_i" id="" class="form-control">
                                                        <option value=""> -Tanggal- </option>
                                                        <?php
                                                        for ($tanggal = 1; $tanggal <= 31; $tanggal++) {
                                                            $i = $tanggal;
                                                            if ($tgl_i == $i) {
                                                                echo "<option value=$i selected>$i</option>";
                                                            } else {
                                                                echo "<option value=$i>$i</option>";
                                                            }
                                                            echo "<option value=$i>$i</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label>Bulan Lahir</label>
                                                    <select name="bulan_i" id="" class="form-control">
                                                        <option value=""> -Bulan- </option>
                                                        <?php
                                                        for ($bulan = 1; $bulan <= 12; $bulan++) {
                                                            if ($bln_i == $bulan) {
                                                                echo "<option value=$bulan selected>$bln[$bulan]</option>";
                                                            } else {
                                                                echo "<option value=$bulan>$bln[$bulan]</option>";
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label>Tahun Lahir</label>
                                                    <select name="tahun_i" id="" class="form-control">
                                                        <option value=""> -Tahun- </option>
                                                        <?php
                                                        $now = date("Y");
                                                        for ($tahun = 1945; $tahun <= $now; $tahun++) {
                                                            if ($thn_b == $tahun) {
                                                                echo "<option value=$tahun selected>$tahun</option>";
                                                            } else {
                                                                echo "<option value=$tahun>$tahun</option>";
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Pekerjaan</label>
                                                <select name="pkj_i" id="" class="form-control">
                                                    <option value="">Pilih Pekerjaan</option>
                                                    <?php
                                                    $sq = mysqli_query($conn, "SELECT * FROM pkj");
                                                    while ($kl = mysqli_fetch_assoc($sq)) {
                                                    ?>
                                                        <option <?= $r['pkj_i'] == $kl['nama'] ? 'selected' : ''; ?> value="<?= $kl['nama'] ?>"><?= $kl['nama'] ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Status Ibu</label><br>
                                                <label class="radio-inline mr-3">
                                                    <input type="radio" name="status_i" value="hidup" <?= $r['status_i'] == 'hidup' ? 'checked' : ''; ?>> Masih Hidup</label>
                                                <label class="radio-inline mr-3">
                                                    <input type="radio" name="status_i" value="meninggal" <?= $r['status_i'] == 'meninggal' ? 'checked' : ''; ?>> Meninggal</label>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <button class="btn btn-success btn-block btn-sm" type="submit" name="tab2"><i class="fa fa-check"></i> Simpan perubahan pada Tab ini</button>
                                        </div>
                                    </form>
                                </div>

                            </div>

                            <div id="faq-tab-3" class="tab-pane fade">
                                <h4 class="blue">
                                    <i class="orange ace-icon fa fa-home bigger-110"></i>
                                    Domisili Santri
                                </h4>

                                <div class="space-8"></div>
                                <form class="" method="POST" action="">
                                    <div class="form-group ">
                                        <label>Komplek *</label>
                                        <select name="komplek" id="komplek" class="form-control" required>
                                            <option value="">Pilih komplek</option>
                                            <?php
                                            $jk = $r['jkl'];
                                            $sq = mysqli_query($conn, "SELECT komplek FROM kamar WHERE jkl = '$jk' GROUP BY komplek");
                                            while ($kl = mysqli_fetch_assoc($sq)) {
                                            ?>
                                                <option <?= $r['komplek'] === $kl['komplek'] ? 'selected' : ''; ?> value="<?= $kl['komplek'] ?>"><?= $kl['komplek'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group ">
                                        <label>Kamar *</label>
                                        <select name="kamar" id="komplek" class="form-control" required>
                                            <option value="">Pilih Kamar</option>
                                            <?php
                                            $jk = $r['jkl'];
                                            $sq = mysqli_query($conn, "SELECT * FROM kamar WHERE jkl = '$jk'");
                                            while ($kl = mysqli_fetch_assoc($sq)) {
                                            ?>
                                                <option <?= $r['kamar'] === $kl['nama'] ? 'selected' : ''; ?> value="<?= $kl['nama'] ?>"><?= $kl['nama'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group ">
                                        <label>Nama Wali asuh</label>
                                        <input type="text" name="nik_a" class="form-control" placeholder="" value="<?= $r['nik_a']; ?>">
                                    </div>
                                    <div class="space-8"></div>
                                    <button class="btn btn-warning btn-block btn-sm" type="submit" name="tab3"><i class="fa fa-check"></i> Simpan perubahan pada Tab ini</button>
                                </form>

                            </div>

                            <div id="faq-tab-4" class="tab-pane fade">
                                <h4 class="blue">
                                    <i class="red ace-icon fa fa-graduation-cap bigger-110"></i>
                                    Pendidikan Formal Santri
                                </h4>

                                <div class="space-8"></div>
                                <form class="" method="POST" action="">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>Formal *</label>
                                            <select name="t_formal" id="t_formal" class="form-control" required>
                                                <option value="">Pilih Lembaga</option>
                                                <?php
                                                $sq = mysqli_query($conn, "SELECT * FROM lembaga ");
                                                while ($kl = mysqli_fetch_assoc($sq)) {
                                                ?>
                                                    <option <?= $r['t_formal'] == $kl['nama'] ? 'selected' : ''; ?> value="<?= $kl['nama'] ?>"><?= $kl['nama'] ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Kelas *</label>
                                            <select name="k_formal" id="" class="form-control" required>
                                                <option value="">Pilih Kelas</option>
                                                <?php
                                                $sq = mysqli_query($conn, "SELECT * FROM kelas ");
                                                while ($kl = mysqli_fetch_assoc($sq)) {
                                                ?>
                                                    <option <?= $r['k_formal'] == $kl['nama'] ? 'selected' : ''; ?> value="<?= $kl['nama'] ?>"><?= $kl['nama'] ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Rombel *</label>
                                            <select name="r_formal" id="" class="form-control" required>
                                                <option value="">-pilih-</option>
                                                <?php
                                                $sq = mysqli_query($conn, "SELECT * FROM rombel ");
                                                while ($kl = mysqli_fetch_assoc($sq)) {
                                                ?>
                                                    <option <?= $r['r_formal'] == $kl['nama'] ? 'selected' : ''; ?> value="<?= $kl['nama'] ?>"><?= $kl['nama'] ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Jurusan *</label>
                                            <select name="jurusan" id="jurusan" class="form-control" required>
                                                <option value="">Pilih </option>
                                                <?php
                                                $sq = mysqli_query($conn, "SELECT * FROM jurusan");
                                                while ($kl = mysqli_fetch_assoc($sq)) {
                                                ?>
                                                    <option <?= $r['jurusan'] == $kl['nama'] ? 'selected' : ''; ?> value="<?= $kl['nama'] ?>"><?= $kl['nama'] ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <button class="btn btn-danger btn-block btn-sm" type="submit" name="tab4"><i class="fa fa-check"></i> Simpan perubahan pada Tab ini</button>
                                </form>

                            </div>

                            <div id="faq-tab-5" class="tab-pane fade">
                                <h4 class="blue">
                                    <i class="purple ace-icon fa fa-file-text bigger-110"></i>
                                    Pendidikan Madrasah Diniyah
                                </h4>

                                <div class="space-8"></div>
                                <form class="" method="POST" action="">
                                    <div class="form-row">
                                        <div class="form-group ">
                                            <label>Kelas Madin *</label>
                                            <select name="k_madin" id="provinsi" class="form-control" required>
                                                <option value="">Pilih kelas</option>
                                                <?php
                                                $sq = mysqli_query($conn, "SELECT * FROM madin");
                                                while ($kl = mysqli_fetch_assoc($sq)) {
                                                ?>
                                                    <option <?= $r['k_madin'] == $kl['nama'] ? 'selected' : ''; ?> value="<?= $kl['nama'] ?>"><?= $kl['nama'] ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group ">
                                            <label>Rombel *</label>
                                            <select name="r_madin" id="kabupaten" class="form-control" required>
                                                <option value="">Pilih rombel</option>
                                                <?php
                                                $sq = mysqli_query($conn, "SELECT * FROM rombel");
                                                while ($kl = mysqli_fetch_assoc($sq)) {
                                                ?>
                                                    <option <?= $r['r_madin'] == $kl['nama'] ? 'selected' : ''; ?> value="<?= $kl['nama'] ?>"><?= $kl['nama'] ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="space-8"></div>
                                    <button class="btn btn-purple btn-block btn-sm " type="submit" name="tab5"> <i class="fa fa-check"></i> Simpan perubahan pada Tab ini</button>
                                </form>

                            </div>

                            <div id="faq-tab-6" class="tab-pane fade">
                                <h4 class="blue">
                                    <i class="dark ace-icon fa fa-info bigger-110"></i>
                                    Informasi Lainnya
                                </h4>

                                <div class="space-8"></div>
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>No. HP *</label>
                                            <input type="text" name="hp" class="form-control" placeholder="" required value="<?= $r['hp']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="text" name="pass" class="form-control" placeholder="" value="<?= $r['pass']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Foto</label><br>
                                            <img src="images/santri/<?= $r['foto']; ?>" height="100">
                                            <input type="file" name="foto" class="form-control" placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label>Tempat Kos</label>
                                            <select name="t_kos" id="" class="form-control" required>
                                                <option value="">Pilih Tempat Kos</option>
                                                <?php
                                                $sq = mysqli_query($conn, "SELECT * FROM tempat");
                                                while ($kl = mysqli_fetch_assoc($sq)) {
                                                ?>
                                                    <option <?= $kl['kd_tmp'] == $r['t_kos'] ? 'selected' : ''; ?> value="<?= $kl['kd_tmp']; ?>"><?= $kl['nama']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Status *</label><br>
                                            <?php
                                            $qr = mysqli_query($conn, "SELECT * FROM status WHERE tahun = '2022/2023'  GROUP BY stts");
                                            foreach ($qr as $rs) : ?>
                                                <input type="radio" name="stts" id="" value="<?= $rs["stts"]; ?>" required <?php if ($rs["stts"] == $r["stts"]) {
                                                                                                                                echo "checked";
                                                                                                                            } ?>>
                                                <?php
                                                $st = $rs["stts"];
                                                $ps = explode("-", $st);
                                                if ($ps[0] == 1) {
                                                    echo "<span class='badge  badge-light'>Ust/Usdz</span>";
                                                    echo " ";
                                                }
                                                if ($ps[1] == 2) {
                                                    echo "<span class='badge  badge-primary'>Mhs/i</span>";
                                                    echo " ";
                                                }
                                                if ($ps[2] == 3) {
                                                    echo "<span class='badge  badge-success'>Sdr/i</span>";
                                                    echo " ";
                                                }
                                                if ($ps[3] == 4) {
                                                    echo "<span class='badge  badge-info'>Kls 6</span>";
                                                    echo " ";
                                                }
                                                if ($ps[4] == 5) {
                                                    echo "<span class='badge  badge-warning'>Baru</span>";
                                                    echo " ";
                                                }
                                                if ($ps[5] == 6) {
                                                    echo "<span class='badge  badge-danger'>Lama</span>";
                                                    echo " ";
                                                }
                                                if ($ps[6] == 7) {
                                                    echo "<span class='badge  badge-primary'>Peng. Wilyah</span>";
                                                    echo " ";
                                                }
                                                if ($ps[7] == 8) {
                                                    echo "<span class='badge  badge-dark'>Putra</span>";
                                                    echo " ";
                                                }
                                                if ($ps[8] == 9) {
                                                    echo "<span class='badge  badge-info'>Putri</span>";
                                                    echo " ";
                                                }
                                                if ($ps[9] == 10) {
                                                    echo "<span class='badge  badge-primary'>Yatim</span>";
                                                    echo " ";
                                                }
                                                if ($ps[10] == 11) {
                                                    echo "<span class='badge  badge-info'>Extra</span>";
                                                    echo " ";
                                                }
                                                ?>
                                                <!-- <?= $rs["stts"]; ?> -->
                                                <br>
                                            <?php endforeach; ?>
                                        </div>
                                        <div class="form-group">
                                            <label>Keterangan *</label>
                                            <select name="ket" id="" class="form-control" required>
                                                <?php
                                                $k = $r['ket'];
                                                $kt = ["-", "Ust/Usdtz", "Khaddam", "Gratis", "Berhenti"];
                                                ?>
                                                <option value="<?= $k; ?>"><?= $kt[$k]; ?></option>
                                                <option value="0">---------------</option>
                                                <option value="1"> Ust/Usdtz </option>
                                                <option value="2"> Khaddam </option>
                                                <option value="3"> Gratis </option>
                                                <option value="4"> Berhenti </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="space-8"></div>
                                    <button class="btn btn-inverse btn-block btn-sm " type="submit" name="tab6"> <i class="fa fa-check"></i> Simpan perubahan pada Tab ini</button>
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

if (isset($_POST['tab1'])) {
    // $nis = htmlspecialchars(mysqli_escape_string($conn, $_POST['nis']));
    // $nisn = htmlspecialchars(mysqli_escape_string($conn, $_POST['nisn']));
    $nik = htmlspecialchars(mysqli_escape_string($conn, $_POST['nik']));
    $no_kk = htmlspecialchars(mysqli_escape_string($conn, $_POST['no_kk']));
    $email = htmlspecialchars(mysqli_escape_string($conn, $_POST['email']));
    $nama = htmlspecialchars(strtoupper(mysqli_escape_string($conn, $_POST['nama'])));
    $tempat = htmlspecialchars(strtoupper(mysqli_escape_string($conn, $_POST['tempat'])));
    $tanggal = $_POST['tgl'] . '-' . $_POST['bulan'] . '-' . $_POST['tahun'];
    $jkl = $_POST['jkl'];
    $anak_ke = htmlspecialchars(mysqli_escape_string($conn, $_POST['anak_ke']));
    $jml_sdr = htmlspecialchars(mysqli_escape_string($conn, $_POST['jml_sdr']));
    $jln = htmlspecialchars(mysqli_escape_string($conn, $_POST['jln']));
    $rt = htmlspecialchars(mysqli_escape_string($conn, $_POST['rt']));
    $rw = htmlspecialchars(mysqli_escape_string($conn, $_POST['rw']));
    $kd_pos = htmlspecialchars(mysqli_escape_string($conn, $_POST['kd_pos']));

    $id_prov = $_POST['prop'];
    $id_kab = $_POST['kota'];
    $id_kec = $_POST['kec'];
    $id_kel = $_POST['kel'];
    $prv = mysqli_fetch_assoc(mysqli_query($conn, "SELECT nama FROM provinsi WHERE id_prov = '$id_prov' "));
    $kb = mysqli_fetch_assoc(mysqli_query($conn, "SELECT nama FROM kabupaten WHERE id_kab = '$id_kab' "));
    $kc = mysqli_fetch_assoc(mysqli_query($conn, "SELECT nama FROM kecamatan WHERE id_kec = '$id_kec' "));
    $kl = mysqli_fetch_assoc(mysqli_query($conn, "SELECT nama FROM kelurahan WHERE id_kel = '$id_kel' "));
    $prop =  mysqli_escape_string($conn, $prv['nama']);
    $kab =  mysqli_escape_string($conn, $kb['nama']);
    $kec = mysqli_escape_string($conn, $kc['nama']);
    $kel = mysqli_escape_string($conn, $kl['nama']);

    if ($id_prov == '' && $id_kab == '' && $id_kec == '' && $id_kel == '') {
        $sql = mysqli_query($conn, "UPDATE tb_santri SET nik = '$nik', no_kk = '$no_kk', nama = '$nama', tempat = '$tempat', tanggal = '$tanggal', jkl = '$jkl', jln = '$jln', rt = '$rt', rw = '$rw', kd_pos = '$kd_pos', anak_ke = '$anak_ke', jml_sdr = '$jml_sdr' WHERE nis = '$nis' ");
    } else {
        $sql = mysqli_query($conn, "UPDATE tb_santri SET nik = '$nik', no_kk = '$no_kk', email = '$email', nama = '$nama', tempat = '$tempat', tanggal = '$tanggal', jkl = '$jkl', jln = '$jln', rt = '$rt', rw = '$rw', kd_pos = '$kd_pos', prov = '$prop', kab = '$kab', kec = '$kec', desa = '$kel', anak_ke = '$anak_ke', jml_sdr = '$jml_sdr' WHERE nis = '$nis' ");
    }
    if ($sql) {
        echo "
        <script>
            window.location.href = 'edit.php?nis=" . $nis . "';
        </script>
    ";
    } else {
        echo
        "
        <script>
            alert('Data Gagal');
            window.location.href = 'edit.php?nis=" . $nis . "';
        </script>
    ";
    }
}

if (isset($_POST['tab2'])) {
    $nik_a = htmlspecialchars(mysqli_escape_string($conn, $_POST['nik_a']));
    $bapak = htmlspecialchars(strtoupper(mysqli_escape_string($conn, $_POST['bapak'])));
    $tempat_a = htmlspecialchars(strtoupper(mysqli_escape_string($conn, $_POST['tempat_a'])));
    $tanggal_a = $_POST['tgl_a'] . '-' . $_POST['bulan_a'] . '-' . $_POST['tahun_a'];
    $pkj_a = htmlspecialchars(mysqli_escape_string($conn, $_POST['pkj_a']));
    $pend_a = htmlspecialchars(mysqli_escape_string($conn, $_POST['pend_a']));
    $status_a = htmlspecialchars(mysqli_escape_string($conn, $_POST['status_a']));
    $foto_a = $_FILES['foto_a']['name'];

    if (empty($foto_a)) {
        $nm_foto_a = $r['foto_a'];
    } else {
        $tmp_a = $_FILES['foto_a']['tmp_name'];
        $ext_a = explode('.', $foto_a);
        $nm_foto_a = rand() . '.' . end($ext_a);
        move_uploaded_file($tmp_a, 'images/wali/' . $nm_foto_a);
    }

    $nik_i = htmlspecialchars(mysqli_escape_string($conn, $_POST['nik_i']));
    $ibu = htmlspecialchars(strtoupper(mysqli_escape_string($conn, $_POST['ibu'])));
    $tempat_i = htmlspecialchars(strtoupper(mysqli_escape_string($conn, $_POST['tempat_i'])));
    $tanggal_i = $_POST['tgl_i'] . '-' . $_POST['bulan_i'] . '-' . $_POST['tahun_i'];
    $pkj_i = htmlspecialchars(mysqli_escape_string($conn, $_POST['pkj_i']));
    $pend_i = htmlspecialchars(mysqli_escape_string($conn, $_POST['pend_i']));
    $status_i = htmlspecialchars(mysqli_escape_string($conn, $_POST['status_i']));
    $foto_i = $_FILES['foto_i']['name'];
    if (empty($foto_i)) {
        $nm_foto_i = $r['foto_i'];
    } else {
        $tmp_i = $_FILES['foto_i']['tmp_name'];
        $ext_i = explode('.', $foto_i);
        $nm_foto_i = rand() . '.' . end($ext_i);
        move_uploaded_file($tmp_i, 'images/wali/' . $nm_foto_i);
    }

    $sql = mysqli_query($conn, "UPDATE tb_santri SET bapak = '$bapak', nik_a = '$nik_a', tempat_a = '$tempat_a', tanggal_a = '$tanggal_a', pend_a = '$pend_a', pkj_a = '$pkj_a', status_a = '$status_a', foto_a = '$nm_foto_a', ibu = '$ibu', nik_i = '$nik_i', tempat_i = '$tempat_i', tanggal_i = '$tanggal_i', pend_i = '$pend_i', pkj_i = '$pkj_i', status_i = '$status_i', foto_i = '$nm_foto_i' WHERE nis = '$nis' ");

    if ($sql) {
        echo "
        <script>
            window.location.href = 'edit.php?nis=" . $nis . "';
        </script>
    ";
    } else {
        echo
        "
        <script>
            alert('Data Gagal');
            window.location.href = 'edit.php?nis=" . $nis . "';
        </script>
    ";
    }
}

if (isset($_POST['tab3'])) {
    $komplek = mysqli_escape_string($conn, $_POST['komplek']);
    $kamar = mysqli_escape_string($conn, $_POST['kamar']);

    $sql = mysqli_query($conn, "UPDATE tb_santri SET komplek = '$komplek', kamar = '$kamar' WHERE nis = '$nis' ");

    if ($sql) {
        echo "
        <script>
            window.location.href = 'edit.php?nis=" . $nis . "';
        </script>
    ";
    } else {
        echo
        "
        <script>
            alert('Data Gagal');
            window.location.href = 'edit.php?nis=" . $nis . "';
        </script>
    ";
    }
}

if (isset($_POST['tab4'])) {
    $k_formal = mysqli_escape_string($conn, $_POST['k_formal']);
    $t_formal = mysqli_escape_string($conn, $_POST['t_formal']);
    $r_formal = mysqli_escape_string($conn, $_POST['r_formal']);
    $jurusan = mysqli_escape_string($conn, $_POST['jurusan']);

    $sql = mysqli_query($conn, "UPDATE tb_santri SET k_formal = '$k_formal', t_formal = '$t_formal', r_formal = '$r_formal', jurusan = '$jurusan' WHERE nis = '$nis' ");

    if ($sql) {
        echo "
        <script>
            window.location.href = 'edit.php?nis=" . $nis . "';
        </script>
    ";
    } else {
        echo
        "
        <script>
            alert('Data Gagal');
            window.location.href = 'edit.php?nis=" . $nis . "';
        </script>
    ";
    }
}

if (isset($_POST['tab5'])) {

    $k_madin = mysqli_escape_string($conn, $_POST['k_madin']);
    $r_madin = mysqli_escape_string($conn, $_POST['r_madin']);

    $sql = mysqli_query($conn, "UPDATE tb_santri SET k_madin = '$k_madin', r_madin = '$r_madin' WHERE nis = '$nis' ");

    if ($sql) {
        echo "
        <script>
            window.location.href = 'edit.php?nis=" . $nis . "';
        </script>
    ";
    } else {
        echo
        "
        <script>
            alert('Data Gagal');
            window.location.href = 'edit.php?nis=" . $nis . "';
        </script>
    ";
    }
}

if (isset($_POST['tab6'])) {

    $hp = mysqli_escape_string($conn, $_POST['hp']);
    $pass = mysqli_escape_string($conn, $_POST['pass']);
    $t_kos = mysqli_escape_string($conn, $_POST['t_kos']);
    $ket = mysqli_escape_string($conn, $_POST['ket']);
    $stts = mysqli_escape_string($conn, $_POST['stts']);
    $pass = mysqli_escape_string($conn, $_POST['pass']);
    $foto = $_FILES['foto']['name'];

    if (empty($foto)) {
        $nm_foto = $r['foto'];
    } else {
        $tmp = $_FILES['foto']['tmp_name'];
        $ext = explode('.', $foto);
        $nm_foto = rand() . '.' . end($ext);
        move_uploaded_file($tmp, 'images/santri/' . $nm_foto);
    }

    $sql = mysqli_query($conn, "UPDATE tb_santri SET hp = '$hp', foto = '$nm_foto', t_kos = '$t_kos',  ket = '$ket', pass = '$pass' , stts = '$stts' WHERE nis = '$nis' ");

    if ($sql) {
        echo "
        <script>
            window.location.href = 'edit.php?nis=" . $nis . "';
        </script>
    ";
    } else {
        echo
        "
        <script>
            alert('Data Gagal');
            window.location.href = 'edit.php?nis=" . $nis . "';
        </script>
    ";
    }
}


// $nik_w = htmlspecialchars(mysqli_escape_string($conn, $_POST['nik_w']));
// $wali = htmlspecialchars(strtoupper(mysqli_escape_string($conn, $_POST['wali'])));
// $tempat_w = htmlspecialchars(strtoupper(mysqli_escape_string($conn, $_POST['tempat_w'])));
// $tanggal_w = $_POST['tgl_w'] . '-' . $_POST['bulan_w'] . '-' . $_POST['tahun_w'];
// $pkj_w = htmlspecialchars(mysqli_escape_string($conn, $_POST['pkj_w']));
// $pend_w = htmlspecialchars(mysqli_escape_string($conn, $_POST['pend_w']));


// if ($id_prov == '' && $id_kab == '' && $id_kec == '' && $id_kel == '') {
//     $sql = mysqli_query($conn, "UPDATE tb_santri SET nisn = '$nisn', nik = '$nik', no_kk = '$no_kk', email = '$email', nama = '$nama', tempat = '$tempat', tanggal = '$tanggal', jkl = '$jkl', jln = '$jln', rt = '$rt', rw = '$rw', kd_pos = '$kd_pos', k_formal = '$k_formal', t_formal = '$t_formal', r_formal = '$r_formal', jurusan = '$jurusan', k_madin = '$k_madin', r_madin = '$r_madin', komplek = '$komplek', kamar = '$kamar', anak_ke = '$anak_ke', jml_sdr = '$jml_sdr', bapak = '$bapak', nik_a = '$nik_a', tempat_a = '$tempat_a', tanggal_a = '$tanggal_a', pend_a = '$pend_a', pkj_a = '$pkj_a', status_a = '$status_a', foto_a = '$nm_foto_a', ibu = '$ibu', nik_i = '$nik_i', tempat_i = '$tempat_i', tanggal_i = '$tanggal_i', pend_i = '$pend_i', pkj_i = '$pkj_i', status_i = '$status_i', foto_i = '$nm_foto_i', wali = '$wali', nik_w = '$nik_w', tempat_w = '$tempat_w', tanggal_w = '$tanggal_w', pend_w = '$pend_w', pkj_w = '$pkj_w',  hp = '$hp', foto = '$nm_foto', t_kos = '$t_kos',  ket = '$ket', stts = '$stts' WHERE nis = '$nis' ");
// } else {
//     $sql = mysqli_query($conn, "UPDATE tb_santri SET nisn = '$nisn', nik = '$nik', no_kk = '$no_kk', email = '$email', nama = '$nama', tempat = '$tempat', tanggal = '$tanggal', jkl = '$jkl', jln = '$jln', rt = '$rt', rw = '$rw', kd_pos = '$kd_pos', prov = '$prop', kab = '$kab', kec = '$kec', desa = '$kel', k_formal = '$k_formal', t_formal = '$t_formal', r_formal = '$r_formal', jurusan = '$jurusan', k_madin = '$k_madin', r_madin = '$r_madin', komplek = '$komplek', kamar = '$kamar', anak_ke = '$anak_ke', jml_sdr = '$jml_sdr', bapak = '$bapak', nik_a = '$nik_a', tempat_a = '$tempat_a', tanggal_a = '$tanggal_a', pend_a = '$pend_a', pkj_a = '$pkj_a', status_a = '$status_a', foto_a = '$nm_foto_a', ibu = '$ibu', nik_i = '$nik_i', tempat_i = '$tempat_i', tanggal_i = '$tanggal_i', pend_i = '$pend_i', pkj_i = '$pkj_i', status_i = '$status_i', foto_i = '$nm_foto_i', wali = '$wali', nik_w = '$nik_w', tempat_w = '$tempat_w', tanggal_w = '$tanggal_w', pend_w = '$pend_w', pkj_w = '$pkj_w',  hp = '$hp', foto = '$nm_foto', t_kos = '$t_kos',  ket = '$ket', stts = '$stts' WHERE nis = '$nis' ");
// }


?>