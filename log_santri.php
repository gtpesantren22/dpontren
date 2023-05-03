<?php
include 'fungsi.php';

$time = time();
$res = mysqli_query($conn, "SELECT * FROM log_santri a JOIN tb_santri b ON a.nis=b.nis WHERE b.aktif = 'Y' ");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap5.min.css">
</head>

<body>
    <div class="container-fluid mt-2">
        <div class="card">
            <div class="card-header">
                Featured
            </div>
            <div class="card-body">
                <h5 class="card-title">Data Logs Santri</h5>
                <table class="table table-sm" id="example">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody id="user_grid">
                        <?php
                        $i = 1;
                        while ($row = mysqli_fetch_assoc($res)) {
                            $status = 'Offline';
                            $class = "btn-danger";
                            if ($row['last_login'] > $time) {
                                $status = 'Online';
                                $class = "btn-success";
                            }
                        ?>
                            <tr>
                                <th scope="row"><?= $i ?></th>
                                <td><?= $row['nama'] ?></td>
                                <td><?= $row['desa'] . ' - ' . $row['kec'] . ' - ' . $row['kab'] ?></td>
                                <td><button type="button" class="btn btn-sm <?= $class ?>"><?= $status ?></button></td>
                            </tr>
                        <?php
                            $i++;
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.3/js/dataTables.bootstrap5.min.js"></script>

<script>
    function updateUserStatus() {
        jQuery.ajax({
            url: 'ubah_user_status.php',
            success: function() {

            }
        });
    }

    function getUserStatus() {
        jQuery.ajax({
            url: 'ambil_user_status.php',
            success: function(result) {
                jQuery('#user_grid').html(result);
            }
        });
    }

    // setInterval(function() {
    //     updateUserStatus();
    // }, 3000);

    setInterval(function() {
        getUserStatus();
    }, 2000);

    $(document).ready(function() {
        $('#example').DataTable({
            lengthChange: false,
            paging: false,
        });
    });
</script>

</html>