<?php
session_start();
if($_SESSION['status'] != "login"){
    header("location:../auth/login.php?pesan=belum_login");
    exit();
}
include '../config/koneksi.php';

// Ambil data statistik
$total_wahana = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM wahana"));
$total_fasilitas = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM fasilitas"));
$total_tiket = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM tiket"));
$total_promo = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM promo"));
$total_review = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM review"));

// Data untuk tabel dashboard
$wahana_terbaru = mysqli_query($koneksi, "SELECT * FROM wahana ORDER BY id_wahana DESC LIMIT 3");
$review_terbaru = mysqli_query($koneksi, "SELECT * FROM review ORDER BY id_review DESC LIMIT 3");
$promo_aktif = mysqli_query($koneksi, "SELECT * FROM promo LIMIT 4");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Samarinda Theme Park</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        :root { 
            --stp-crimson: #E01940; 
            --stp-sidebar-hover: #C01435; /* Merah lebih gelap untuk hover */
            --stp-bg: #F4F6F9; 
        }
        body { background-color: var(--stp-bg); font-family: 'Poppins', sans-serif; margin: 0; }

        /* SIDEBAR */
        .sidebar { 
            width: 260px; height: 100vh; background-color: var(--stp-crimson) !important; 
            color: white; position: fixed; left: 0; top: 0; z-index: 1100;
        }
        .sidebar-header { padding: 30px 25px; }
        .nav-link { 
            color: rgba(255, 255, 255, 0.8) !important; padding: 12px 25px !important; 
            font-size: 14px; transition: all 0.2s; border-radius: 0;
        }
        .nav-link:hover { 
            background-color: var(--stp-sidebar-hover); /* Efek gelap saat hover */
            color: white !important; 
        }
        .nav-link.active { background: rgba(0, 0, 0, 0.1); color: white !important; font-weight: 600; }
        .sidebar-heading { font-size: 11px; letter-spacing: 1px; padding: 20px 25px 10px; opacity: 0.6; }

        /* TOP NAVBAR (Rectangle Putih) */
        .top-navbar {
            position: fixed; top: 0; right: 0; left: 260px; height: 70px;
            background: white; display: flex; align-items: center; justify-content: flex-end;
            padding: 0 40px; z-index: 1000; border-bottom: 1px solid #eee;
        }
        .admin-profile { display: flex; align-items: center; gap: 12px; }
        .admin-name { font-size: 13px; font-weight: 500; color: #333; }
        .admin-avatar { 
            width: 35px; height: 35px; background: var(--stp-crimson); 
            border-radius: 50%; display: flex; align-items: center; 
            justify-content: center; color: white; font-weight: bold; font-size: 14px;
        }

        /* MAIN CONTENT */
        .main-content { margin-left: 260px; padding: 100px 40px 40px; }

        /* STAT CARDS */
        .stat-card { 
            background: white; border-radius: 15px; padding: 20px; border: none;
            display: flex; align-items: center; justify-content: space-between; height: 100px;
        }
        .card-wahana { background: #FDECEC; }
        .card-fasilitas { background: #E7F6FD; }
        .card-tiket { background: #E9F7EF; }
        .card-promo { background: #F4ECFD; }
        .card-review { background: #FDF4EC; }
        .stat-label { font-size: 11px; color: #888; text-transform: uppercase; font-weight: 600; }
        .stat-value { font-size: 24px; font-weight: 700; color: #333; }

        /* BOXES */
        .dashboard-box { 
            background: white; border-radius: 15px; padding: 25px; 
            box-shadow: 0 2px 10px rgba(0,0,0,0.02); height: 100%;
        }
        .box-title { font-size: 16px; font-weight: 700; margin-bottom: 20px; }
        
        .list-item { border-bottom: 1px solid #f8f8f8; padding: 12px 0; display: flex; justify-content: space-between; align-items: center; }
        .list-item:last-child { border: none; }
        
        .badge-extreme { background: #FFE5E9; color: #E01940; font-size: 10px; padding: 4px 10px; border-radius: 20px; font-weight: 700; }
        .stars { color: #FFC107; font-size: 12px; }
        .promo-tag { background: #FFE5E9; color: #E01940; font-size: 10px; padding: 2px 8px; border-radius: 4px; font-weight: 700; }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="sidebar-header">
        <h4 class="fw-bold m-0">ADMIN</h4>
        <small class="opacity-75">Samarinda Theme Park</small>
    </div>
    <nav class="nav flex-column">
        <div class="sidebar-heading">MAIN</div>
        <a class="nav-link active" href="index.php">Dashboard</a>
        
        <div class="sidebar-heading">KONTEN WEBSITE</div>
        <a class="nav-link" href="data_wahana.php">Wahana</a>
        <a class="nav-link" href="data_fasilitas.php">Fasilitas</a>
        <a class="nav-link" href="data_tiket.php">Tiket</a>
        <a class="nav-link" href="data_promo.php">Promo</a>
        <a class="nav-link" href="data_review.php">Review</a>
        <a class="nav-link" href="beranda.php">Beranda</a>
        <a class="nav-link" href="kontak.php">Kontak</a>
        
        <div class="sidebar-heading">PENGATURAN</div>
        <a class="nav-link" href="akun.php">Akun Admin</a>
        <a class="nav-link" href="logout.php">Log Out</a>
    </nav>
</div>

<div class="top-navbar">
    <div class="admin-profile">
        <span class="admin-name">Admin User</span>
        <div class="admin-avatar">A</div>
    </div>
</div>

<div class="main-content">
    <div class="mb-5">
        <h2 class="fw-bold m-0">Dashboard</h2>
        <p class="text-muted small">Selamat datang di admin panel Samarinda Theme Park</p>
    </div>

    <div class="row g-3 mb-4">
        <div class="col">
            <div class="stat-card card-wahana">
                <div><div class="stat-label">Total Wahana</div><div class="stat-value"><?php echo $total_wahana; ?></div></div>
                <i class="fas fa-bolt text-danger"></i>
            </div>
        </div>
        <div class="col">
            <div class="stat-card card-fasilitas">
                <div><div class="stat-label">Total Fasilitas</div><div class="stat-value"><?php echo $total_fasilitas; ?></div></div>
                <i class="fas fa-building text-primary"></i>
            </div>
        </div>
        <div class="col">
            <div class="stat-card card-tiket">
                <div><div class="stat-label">Total Tiket</div><div class="stat-value"><?php echo $total_tiket; ?></div></div>
                <i class="fas fa-ticket-alt text-success"></i>
            </div>
        </div>
        <div class="col">
            <div class="stat-card card-promo">
                <div><div class="stat-label">Total Promo</div><div class="stat-value"><?php echo $total_promo; ?></div></div>
                <i class="fas fa-tag" style="color:#9c27b0"></i>
            </div>
        </div>
        <div class="col">
            <div class="stat-card card-review">
                <div><div class="stat-label">Total Review</div><div class="stat-value"><?php echo $total_review; ?></div></div>
                <i class="fas fa-star text-warning"></i>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-6">
            <div class="dashboard-box">
                <h6 class="box-title">Wahana Terbaru</h6>
                <?php while($w = mysqli_fetch_array($wahana_terbaru)) { ?>
                <div class="list-item">
                    <div>
                        <div class="fw-bold small"><?php echo $w['nama_wahana']; ?></div>
                        <div class="text-muted" style="font-size: 11px;">Thrill</div>
                    </div>
                    <span class="badge-extreme">EXTREME</span>
                </div>
                <?php } ?>
            </div>
        </div>

        <div class="col-md-6">
            <div class="dashboard-box">
                <h6 class="box-title">Review Terbaru</h6>
                <?php while($r = mysqli_fetch_array($review_terbaru)) { ?>
                <div class="list-item flex-column align-items-start">
                    <div class="d-flex justify-content-between w-100 mb-1">
                        <span class="fw-bold small"><?php echo $r['nama_pengunjung']; ?></span>
                        <div class="stars">★★★★★</div>
                    </div>
                    <p class="text-muted m-0" style="font-size: 11px; line-height: 1.4;">Amazing family day out!</p>
                </div>
                <?php } ?>
            </div>
        </div>

        <div class="col-md-12">
            <div class="dashboard-box">
                <h6 class="box-title">Promo Aktif</h6>
                <table class="table table-borderless align-middle mb-0">
                    <thead>
                        <tr class="text-muted small" style="border-bottom: 1px solid #eee;">
                            <th class="pb-3">Judul Promo</th>
                            <th class="pb-3">Kode Promo</th>
                            <th class="pb-3">Diskon</th>
                            <th class="pb-3">Berlaku Sampai</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($p = mysqli_fetch_array($promo_aktif)) { ?>
                        <tr class="small">
                            <td class="py-3"><?php echo $p['nama_promo']; ?></td>
                            <td class="py-3 text-muted"><?php echo $p['kode_promo']; ?></td>
                            <td class="py-3"><span class="promo-tag">30% OFF</span></td>
                            <td class="py-3 text-muted">2026-07-31</td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</body>
</html>