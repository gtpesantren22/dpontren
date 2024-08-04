<?php
session_start();
include 'fungsi.php';

if (!isset($_SESSION['04bb9374-8e84-48c8-b858-cfaa2087b56f'])) {
    echo "
    <script>
    alert('Silahkan login dulu');
    window.location = 'login.php';
    </script>
    ";
}

$nama_user = $_SESSION['nama'];
$level_user = $_SESSION['level'];

$aktif = $_GET['aktif'];

if ($aktif == 'Y') {
    $query = "SELECT * FROM tb_santri WHERE aktif = 'Y' ";
    $query_count = "SELECT COUNT(nis) as total FROM tb_santri WHERE aktif = 'Y'";
} else {
    $query = "SELECT * FROM tb_santri WHERE aktif = 'T' ";
    $query_count = "SELECT COUNT(nis) as total FROM tb_santri WHERE aktif = 'T'";
}

// Menangkap request dari DataTables
$draw = $_POST['draw'];
$start = $_POST['start'];
$length = $_POST['length'];
$search_value = $_POST['search']['value'];

// Menyusun query SQL


// Jika ada pencarian
if (!empty($search_value)) {
    $query .= " AND nama LIKE '%" . $search_value . "%' OR nis LIKE '%" . $search_value . "%' OR desa LIKE '%" . $search_value . "%' OR kec LIKE '%" . $search_value . "%' OR kab LIKE '%" . $search_value . "%' OR t_formal LIKE '%" . $search_value . "%' ";
    $query_count .= " AND nama LIKE '%" . $search_value . "%' OR nis LIKE '%" . $search_value . "%' OR desa LIKE '%" . $search_value . "%' OR kec LIKE '%" . $search_value . "%' OR kab LIKE '%" . $search_value . "%' OR t_formal LIKE '%" . $search_value . "%' ";
}

$query .= " LIMIT " . $start . ", " . $length;

$result = $conn->query($query);
$total_filtered = $conn->query($query_count)->fetch_assoc()['total'];
$total_records = $conn->query($query_count)->fetch_assoc()['total'];

// Membuat data output
$data = [];
$no = $start + 1;
while ($row = $result->fetch_assoc()) {
    // $cekBayar = $conn->query("SELECT COUNT(*) as count FROM tb_santri WHERE nis = '" . $row['nis'] . "' AND bulan = '" . $row['bulan'] . "' AND tahun = '" . $row['tahun'] . "'")->fetch_assoc()['count'];
    // $status = $cekBayar > 0 ? 'Lunas' : 'Belum';

    if ($level_user === 'admin' && $aktif == 'Y') {
        $aksi = '
        <div class="btn-group">
            <button data-toggle="dropdown" class="btn btn-minier btn-primary dropdown-toggle">
                Action
                <i class="ace-icon fa fa-angle-down icon-on-right"></i>
            </button>
            <ul class="dropdown-menu dropdown-danger">
                <li>
                    <a href="edit.php?nis=' . $row['nis'] . '">Edit</a>
                </li>
                <li>
                    <a href="hapus.php?kd=mti&id=' . $row['nis'] . '">Keluar</a>
                </li>
            </ul>
        </div>';
    } else if ($level_user === 'admin' && $aktif != 'Y') {
        $aksi = '
        <a href="edit.php?nis=' . $row['nis'] . '">
            <button class="btn btn-primary btn-minier"><i class="fa fa-edit"></i></button>
        </a>
        <a href="back.php?nis=' . $row['nis'] . '">
            <button class="btn btn-danger btn-minier"><i class="fa fa-times"></i></button>
        </a>';
    } else {
        $aksi = 'No Actions Available';
    }

    $data[] = [
        'no' => $no++,
        'nis' => $row['nis'],
        'nama' => $row['nama'],
        'desa' => $row['desa'],
        'kec' => $row['kec'],
        'kab' => $row['kab'],
        'k_formal' => $row['k_formal'],
        't_formal' => $row['t_formal'],
        'k_madin' => $row['k_madin'],
        'r_madin' => $row['r_madin'],
        'aksi' => $aksi
    ];
}

// Mengirimkan data dalam format JSON
$response = [
    "draw" => intval($draw),
    "recordsTotal" => intval($total_records),
    "recordsFiltered" => intval($total_filtered),
    "data" => $data
];

echo json_encode($response);
