<?php
session_start();
include '../config/koneksi.php'; 

// Penanda halaman aktif agar menu Dashboard menyala
$activePage = "dashboard";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Samarinda Theme Park</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    
    <link rel="stylesheet" href="admin.css">

    <style>
        /* Mengunci posisi agar tidak berantakan lagi */
        .main-content {
            margin-left: 258px; /* Sesuai lebar sidebar di admin.css */
            width: calc(100% - 258px);
            padding: 40px;
        }

        .dashboard-header {
            margin-bottom: 30px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 24px;
        }

        .stat-card {
            background: white;
            padding: 24px;
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .stat-icon {
            width: 56px;
            height: 56px;
            border-radius: 12px;
            background: rgba(255, 15, 75, 0.1);
            color: #ff0f4b;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }

        .stat-info h3 {
            font-size: 14px;
            color: #888;
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .stat-info .value {
            font-size: 28px;
            font-weight: 800;
            color: #1a1a1a;
            margin-top: 4px;
        }
    </style>
</head>
<body>

<div class="admin-wrapper">
    <div class="sidebar">
        <div class="brand">
            <h2>ADMIN</h2>
            <p>Samarinda Theme Park</p>
        </div>
        
        <div class="menu-title">Main</div>
        <ul>
            <li><a href="dashboard.php" class="<?= ($activePage == 'dashboard') ? 'active' : ''; ?>">Dashboard</a></li>
        </ul>

        <div class="menu-title">Konten Website</div>
        <ul>
            <li><a href="wahana.php" class="<?= ($activePage == 'wahana') ? 'active' : ''; ?>">Wahana</a></li>
            <li><a href="data_fasilitas.php" class="<?= ($activePage == 'fasilitas') ? 'active' : ''; ?>">Fasilitas</a></li>
            <li><a href="tiket.php" class="<?= ($activePage == 'tiket') ? 'active' : ''; ?>">Tiket</a></li>
            <li><a href="promo.php" class="<?= ($activePage == 'promo') ? 'active' : ''; ?>">Promo</a></li>
            <li><a href="review.php" class="<?= ($activePage == 'review') ? 'active' : ''; ?>">Review</a></li>
            <li><a href="beranda.php" class="<?= ($activePage == 'beranda') ? 'active' : ''; ?>">Beranda</a></li>
            <li><a href="kontak.php" class="<?= ($activePage == 'kontak') ? 'active' : ''; ?>">Kontak</a></li>
        </ul>
        
        <div class="menu-title">Pengaturan</div>
        <ul>
            <li><a href="akun_admin.php" class="<?= ($activePage == 'akun') ? 'active' : ''; ?>">Akun Admin</a></li>
            <li><a href="logout.php">Log Out</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="dashboard-header">
            <h1 style="font-size: 32px; font-weight: 800; color: #1a1a1a;">Dashboard Overview</h1>
            <p style="color: #666;">Pantau performa konten Samarinda Theme Park hari ini.</p>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon"><i class="fa-solid fa-building-circle-check"></i></div>
                <div class="stat-info">
                    <h3>Total Fasilitas</h3>
                    <div class="value">
                        <?php 
                        $res = mysqli_query($koneksi, "SELECT count(*) as total FROM fasilitas");
                        $data = mysqli_fetch_assoc($res);
                        echo $data['total'];
                        ?>
                    </div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon"><i class="fa-solid fa-ferris-wheel"></i></div>
                <div class="stat-info">
                    <h3>Total Wahana</h3>
                    <div class="value">
                        <?php 
                        $res_w = mysqli_query($koneksi, "SELECT count(*) as total FROM wahana");
                        $data_w = mysqli_fetch_assoc($res_w);
                        echo $data_w['total'] ?? 0;
                        ?>
                    </div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon"><i class="fa-solid fa-ticket"></i></div>
                <div class="stat-info">
                    <h3>Kategori Tiket</h3>
                    <div class="value">
                        <?php 
                        $res_t = mysqli_query($koneksi, "SELECT count(*) as total FROM tiket");
                        $data_t = mysqli_fetch_assoc($res_t);
                        echo $data_t['total'] ?? 0;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>