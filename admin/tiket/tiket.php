<?php
session_start();
include '../config/koneksi.php'; 

// Penanda halaman aktif
$activePage = "tiket";

// Logika Pencarian
$keyword = isset($_GET['keyword']) ? mysqli_real_escape_string($koneksi, $_GET['keyword']) : '';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Tiket - Samarinda Theme Park</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    
    <link rel="stylesheet" href="admin.css">

    <style>
        /* Memastikan layout terkunci sesuai admin.css */
        .main-content {
            margin-left: 258px;
            width: calc(100% - 258px);
            padding: 40px;
        }
        
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
        
        .badge-status {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
        }
        .status-tersedia { background: #e3fcef; color: #00a854; }
        .status-habis { background: #fff1f0; color: #f5222d; }
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
        <div class="content">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 20px;">
                <div>
                    <h1 style="font-size: 28px; font-weight: 800; margin: 0;">Kelola Tiket</h1>
                    <p style="color: #888; font-size: 14px;">Manage ticket categories and pricing</p>
                </div>
                <a href="tambah_tiket.php" class="btn-primary" style="background: #ff0f4b; color: white; padding: 10px 20px; border-radius: 8px; font-weight: 600; text-decoration: none;">+ Tambah Tiket</a>
            </div>

            <div class="search-container">
                <form action="" method="GET">
                    <input type="text" name="keyword" class="search-input" placeholder="Cari nama tiket atau status..." value="<?= htmlspecialchars($keyword) ?>">
                </form>
            </div>

            <div class="table-box">
                <table style="width: 100%; border-collapse: collapse; background: white; border-radius: 12px; overflow: hidden;">
                    <thead style="background: #f8f9fa; border-bottom: 2px solid #eee;">
                        <tr>
                            <th style="padding: 15px; text-align: left; font-size: 12px; text-transform: uppercase;">No</th>
                            <th style="padding: 15px; text-align: left; font-size: 12px; text-transform: uppercase;">Nama Tiket</th>
                            <th style="padding: 15px; text-align: left; font-size: 12px; text-transform: uppercase;">Harga</th>
                            <th style="padding: 15px; text-align: left; font-size: 12px; text-transform: uppercase;">Status</th>
                            <th style="padding: 15px; text-align: center; font-size: 12px; text-transform: uppercase;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        $sql = "SELECT * FROM tiket";
                        if($keyword != '') {
                            $sql .= " WHERE nama_tiket LIKE '%$keyword%' OR status LIKE '%$keyword%'";
                        }
                        $sql .= " ORDER BY id DESC";
                        
                        $query = mysqli_query($koneksi, $sql);
                        if(mysqli_num_rows($query) > 0) {
                            while($t = mysqli_fetch_array($query)){ 
                                $statusClass = (strtolower($t['status']) == 'aktif' || strtolower($t['status']) == 'tersedia') ? 'status-tersedia' : 'status-habis';
                        ?>
                        <tr style="border-bottom: 1px solid #eee;">
                            <td style="padding: 15px;"><?= $no++; ?></td>
                            <td style="padding: 15px;">
                                <strong><?= htmlspecialchars($t['nama_tiket']); ?></strong><br>
                                <small class="text-muted"><?= htmlspecialchars($t['deskripsi']); ?></small>
                            </td>
                            <td style="padding: 15px; font-weight: 600;">Rp <?= number_format($t['harga'], 0, ',', '.'); ?></td>
                            <td style="padding: 15px;">
                                <span class="badge-status <?= $statusClass; ?>"><?= htmlspecialchars($t['status']); ?></span>
                            </td>
                            <td style="padding: 15px; text-align: center;">
                                <a href="edit_tiket.php?id=<?= $t['id']; ?>" class="icon-btn icon-edit" style="margin-right: 5px;">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <a href="hapus_tiket.php?id=<?= $t['id']; ?>" class="icon-btn icon-delete" onclick="return confirm('Hapus tiket ini?')">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php 
                            } 
                        } else {
                            echo "<tr><td colspan='5' style='padding: 20px; text-align: center; color: #888;'>Data tiket tidak ditemukan.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</body>
</html>