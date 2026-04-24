<?php
session_start();
include '../config/koneksi.php'; 

// Penanda halaman aktif
$activePage = "fasilitas";

// Logika Pencarian
$keyword = isset($_GET['keyword']) ? mysqli_real_escape_string($koneksi, $_GET['keyword']) : '';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Fasilitas - Samarinda Theme Park</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    
    <link rel="stylesheet" href="admin.css">

    <style>
        /* Tambahan sedikit agar layout utama (main-content) benar sesuai file CSS kamu */
        .main-content {
            margin-left: 258px; /* Sesuaikan dengan lebar .sidebar di admin.css */
            width: calc(100% - 258px);
            padding: 40px;
        }
        
        /* Gaya khusus untuk Search Bar agar mirip Figma */
        .search-container {
            margin-bottom: 25px;
            width: 100%;
        }
        .search-input {
            width: 100%;
            padding: 12px 20px;
            border-radius: 10px;
            border: 1px solid #ddd;
            background: #fff;
            outline: none;
        }
    </style>
</head>
<body>

<div class=\"admin-wrapper\">
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
        <div class="content">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 20px;">
                <div>
                    <h1 style="font-size: 28px; font-weight: 800; margin: 0;">Kelola Fasilitas</h1>
                    <p style="color: #888; font-size: 14px;">Manage attractions and rides</p>
                </div>
                <a href="tambah_fasilitas.php" class="btn-primary" style="background: #ff0f4b; color: white; padding: 10px 20px; border-radius: 8px; font-weight: 600; text-decoration: none;">+ Tambah Fasilitas</a>
            </div>

            <div class="search-container">
                <form action="" method="GET">
                    <input type="text" name="keyword" class="search-input" placeholder="Cari fasilitas..." value="<?= htmlspecialchars($keyword) ?>">
                </form>
            </div>

            <div class="table-box">
                <table style="width: 100%; border-collapse: collapse; background: white; border-radius: 12px; overflow: hidden;">
                    <thead style="background: #f8f9fa; border-bottom: 2px solid #eee;">
                        <tr>
                            <th style="padding: 15px; text-align: left; font-size: 12px; text-transform: uppercase;">No</th>
                            <th style="padding: 15px; text-align: left; font-size: 12px; text-transform: uppercase;">Nama Fasilitas</th>
                            <th style="padding: 15px; text-align: left; font-size: 12px; text-transform: uppercase;">Lokasi</th>
                            <th style="padding: 15px; text-align: center; font-size: 12px; text-transform: uppercase;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        $sql = "SELECT * FROM fasilitas";
                        if($keyword != '') {
                            $sql .= " WHERE nama_fasilitas LIKE '%$keyword%' OR lokasi LIKE '%$keyword%'";
                        }
                        $sql .= " ORDER BY id_fasilitas DESC";
                        
                        $query = mysqli_query($koneksi, $sql);
                        while($f = mysqli_fetch_array($query)){ 
                        ?>
                        <tr style="border-bottom: 1px solid #eee;">
                            <td style="padding: 15px;"><?= $no++; ?></td>
                            <td style="padding: 15px;"><strong><?= htmlspecialchars($f['nama_fasilitas']); ?></strong></td>
                            <td style="padding: 15px; color: #666;"><?= htmlspecialchars($f['lokasi']); ?></td>
                            <td style="padding: 15px; text-align: center;">
                                <a href="edit_fasilitas.php?id=<?= $f['id_fasilitas']; ?>" class="icon-btn icon-edit" style="margin-right: 5px;">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <a href="hapus_fasilitas.php?id=<?= $f['id_fasilitas']; ?>" class="icon-btn icon-delete" onclick="return confirm('Hapus data ini?')">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </td>
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