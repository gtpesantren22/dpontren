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

                            <div class="table-header bg-danger">
                                Data santri Alumni (Non Aktif)
                            </div>

                            <div class="table-responsive">
                                <table id="table-siswa" class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>NIS</th>
                                            <th>Nama</th>
                                            <th>Alamat</th>
                                            <th>Kelas</th>
                                            <th>Madin</th>
                                            <th>#</th>
                                        </tr>
                                    </thead>

                                    <tbody>
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

<script src="assets/js/jquery-2.1.4.min.js"></script>
<script src="assets/js/jquery.dataTables.min.js"></script>
<script src="assets/js/jquery.dataTables.bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        $('#table-siswa').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "ambil_data.php?aktif=N", // Path ke file PHP Anda
                "type": "POST"
            },
            "columns": [{
                    "data": "no"
                },
                {
                    "data": "nis"
                },
                {
                    "data": "nama"
                },
                {
                    "data": null, // Karena Anda ingin menggabungkan beberapa field
                    "render": function(data, type, row) {
                        return row.desa + ', ' + row.kec + ', ' + row.kab;
                    }
                },
                {
                    "data": null, // Karena Anda ingin menggabungkan beberapa field
                    "render": function(data, type, row) {
                        return row.k_formal + ' - ' + row.t_formal;
                    }
                },
                {
                    "data": null, // Karena Anda ingin menggabungkan beberapa field
                    "render": function(data, type, row) {
                        return row.k_madin + ' - ' + row.r_madin;
                    }
                },
                {
                    "data": "aksi"
                } // Kolom aksi di sini
            ]
        });
    });
</script>