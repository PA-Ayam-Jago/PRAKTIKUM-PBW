<?php
session_start();
if($_SESSION['status'] != "login"){
    header("location:../auth/login.php?pesan=belum_login");
    exit();
}
include '../config/koneksi.php';

// Logika filter sederhana
$filter = isset($_GET['filter']) ? $_GET['filter'] : 'semua';
if($filter == 'ditampilkan'){
    $query = mysqli_query($koneksi, "SELECT * FROM review WHERE status='Active'");
} elseif($filter == 'disembunyikan'){
    $query = mysqli_query($koneksi, "SELECT * FROM review WHERE status='Hidden'");
} else {
    $query = mysqli_query($koneksi, "SELECT * FROM review");
}

$total_review = mysqli_num_rows($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Review - Samarinda Theme Park</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        :root { --stp-crimson: #E01940; --stp-bg: #F4F6F9; }
        body { background-color: var(--stp-bg); font-family: 'Poppins', sans-serif; margin: 0; }

        /* SIDEBAR (Konsisten) */
        .sidebar { 
            width: 250px; height: 100vh; background-color: var(--stp-crimson) !important; 
            color: white; position: fixed; left: 0; top: 0; padding-top: 30px; z-index: 1000;
        }
        .nav-link { color: rgba(255, 255, 255, 0.8) !important; padding: 12px 30px !important; font-size: 14px; }
        .nav-link.active { background: rgba(0, 0, 0, 0.1); color: white !important; font-weight: 600; }

        /* MAIN CONTENT */
        .main-content { margin-left: 250px; padding: 40px; }

        /* FILTER BUTTONS (Sesuai Figma Review) */
        .btn-filter { 
            border-radius: 20px; padding: 5px 20px; font-size: 13px; font-weight: 500; 
            border: 1px solid #ccc; background: white; color: #333; margin-right: 10px;
            text-decoration: none; display: inline-block;
        }
        .btn-filter.active { background-color: var(--stp-crimson); color: white; border-color: var(--stp-crimson); }

        /* TABLE STYLE */
        .table-container { 
            background: white; border-radius: 15px; overflow: hidden; 
            border: 1px solid #ddd; margin-top: 20px;
        }
        .table thead th { background-color: #D3D3D3 !important; padding: 20px; font-size: 13px; border: none; }
        .table tbody td { padding: 20px; font-size: 13px; vertical-align: middle; border-bottom: 1px solid #eee; }
        
        .rating-star { color: #FFC107; font-size: 12px; }
        .status-badge { background-color: #E7F9EE; color: #27AE60; padding: 5px 12px; border-radius: 20px; font-weight: 600; font-size: 11px; }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="brand-title px-4 fw-bold fs-4">ADMIN</div>
    <div class="brand-sub px-4 mb-4 small fw-light">Samarinda Theme Park</div>
    <div class="sidebar-heading px-4 small opacity-50 mb-2">KONTEN WEBSITE</div>
    <nav class="nav flex-column">
        <a class="nav-link" href="data_wahana.php">Wahana</a>
        <a class="nav-link" href="data_fasilitas.php">Fasilitas</a>
        <a class="nav-link" href="data_tiket.php">Tiket</a>
        <a class="nav-link" href="data_promo.php">Promo</a>
        <a class="nav-link active" href="data_review.php">Review</a>
        <a class="nav-link" href="data_beranda.php">Beranda</a>
        <a class="nav-link" href="data_kontak.php">Kontak</a>
    </nav>
</div>

<div class="main-content">
    <h2 class="fw-bold mb-0">Kelola Review</h2>
    <p class="text-muted small">Manage attractions and rides</p>

    <div class="mt-4">
        <a href="?filter=semua" class="btn-filter <?php echo ($filter == 'semua') ? 'active' : ''; ?>">Semua (<?php echo $total_review; ?>)</a>
        <a href="?filter=ditampilkan" class="btn-filter <?php echo ($filter == 'ditampilkan') ? 'active' : ''; ?>">Ditampilkan</a>
        <a href="?filter=disembunyikan" class="btn-filter <?php echo ($filter == 'disembunyikan') ? 'active' : ''; ?>">Disembunyikan</a>
    </div>

    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th width="50">No</th>
                    <th>Nama Pengunjung</th>
                    <th>Rating</th>
                    <th>Judul</th>
                    <th>Komentar</th>
                    <th>Tipe Kunjungan</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $no = 1;
                while($r = mysqli_fetch_array($query)){
                ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td class="fw-bold"><?php echo $r['nama_pengunjung']; ?></td>
                    <td>
                        <?php for($i=1; $i<=5; $i++): ?>
                            <i class="fa<?php echo ($i <= $r['rating']) ? 's' : 'r'; ?> fa-star rating-star"></i>
                        <?php endfor; ?>
                        <span class="ms-1 small text-danger"><?php echo $r['rating']; ?></span>
                    </td>
                    <td><?php echo $r['judul_review']; ?></td>
                    <td class="text-muted small"><?php echo $r['komentar']; ?></td>
                    <td><span class="status-badge"><?php echo $r['status']; ?></span></td>
                    <td class="small text-muted"><?php echo $r['tanggal']; ?></td>
                    <td>
                        <a href="update_status_review.php?id=<?php echo $r['id_review']; ?>&status=<?php echo ($r['status']=='Active')?'Hidden':'Active'; ?>" class="text-dark small">
                            <i class="fas fa-eye-slash"></i>
                        </a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>