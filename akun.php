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
                                            <th>Pass</th>
                                            <th>#</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $sql = mysqli_query($conn, "SELECT * FROM tb_santri WHERE aktif = 'Y' ");
                                        while ($r = mysqli_fetch_assoc($sql)) {
                                        ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= $r['nis'] ?></td>
                                                <td><?= $r['nama'] ?></td>
                                                <td><?= $r['desa'] . ' - ' . $r['kec'] . ' - ' . $r['kab'] ?></td>
                                                <td><?= $r['pass'] ?></td>
                                                <td>
                                                    <form action="" method="post">
                                                        <input type="hidden" name="nis" value="<?= $r['nis']; ?>">
                                                        <button class="btn btn-minier btn-success" name="kirim" type="submit">Kirim</button>
                                                    </form>
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

if (isset($_POST['kirim'])) {
    $nis = $_POST['nis'];

    $infoData = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tb_santri WHERE nis = '$nis' "));

    $permitted_chars = 'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $passNew = substr(str_shuffle($permitted_chars), 0, 10);

    $sql = mysqli_query($conn, "UPDATE tb_santri SET pass = '$passNew' WHERE nis = $nis ");
    if ($sql) {

        $psn = '
*INFORMASI AKUN eSANTRI* 

Detail Akun :

Nama : ' . $infoData['nama'] . '
Alamat : ' . $infoData['desa'] . ' - ' . $infoData['kec'] . ' - ' . $infoData['kab'] . '
Username : *' . $infoData['nis'] . '*
Password : *' . $passNew . '*

*_Akun ini bersifat rahasia. dimohon untuk menyimpan akun ini dengan baik_*
*_Akun sudah bisa digunakan di Aplikasi atau di https://esantri.ppdwk.com/_*
Terimakasih';

        $curl = curl_init();
        curl_setopt_array(
            $curl,
            array(
                CURLOPT_URL => 'http://191.101.3.115:3000/api/sendMessage',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => 'apiKey=f4064efa9d05f66f9be6151ec91ad846&phone=' . $infoData['hp'] . '&message=' . $psn,
                // CURLOPT_POSTFIELDS => 'apiKey=f4064efa9d05f66f9be6151ec91ad846&phone=085236924510&message=' . $psn,
            )
        );
        $response = curl_exec($curl);
        curl_close($curl);

        echo "
        <script>
        window.location = 'akun.php';
        </script>
        ";
    }
}
?>