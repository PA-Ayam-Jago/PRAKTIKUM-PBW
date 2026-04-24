<?php
session_start();
include '../config/koneksi.php'; 

// Penanda halaman aktif
$activePage = "review"; // Sesuaikan dengan link di sidebar agar menyala

// Logika Pencarian
$keyword = isset($_GET['keyword']) ? mysqli_real_escape_string($koneksi, $_GET['keyword']) : '';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Ulasan - Samarinda Theme Park</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    
    <link rel="stylesheet" href="admin.css">

    <style>
        /* Memastikan layout utama konsisten dengan admin.css */
        .main-content {
            margin-left: 258px;
            width: calc(100% - 258px);
            padding: 40px;
        }

        .search-input {
            width: 100%;
            padding: 12px 20px;
            border-radius: 10px;
            border: 1px solid #ddd;
            background: #fff;
            outline: none;
            margin-bottom: 25px;
        }

        .rating-star {
            color: #ffc107;
            margin-right: 2px;
        }

        /* Gaya tabel agar mirip Figma */
        .table-box {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #f8f9fa;
            padding: 15px;
            text-align: left;
            font-size: 12px;
            text-transform: uppercase;
            color: #666;
            border-bottom: 2px solid #eee;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid #eee;
            vertical-align: middle;
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
            <li><a href="ulasan.php" class="<?= ($activePage == 'review') ? 'active' : ''; ?>">Review</a></li>
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
                    <h1 style="font-size: 28px; font-weight: 800; margin: 0;">Kelola Ulasan</h1>
                    <p style="color: #888; font-size: 14px;">Review dari pengunjung taman bermain</p>
                </div>
                <a href="tambah_ulasan.php" class="btn-primary" style="background: #ff0f4b; color: white; padding: 10px 20px; border-radius: 8px; font-weight: 600; text-decoration: none;">+ Tambah Ulasan</a>
            </div>

            <form action="" method="GET">
                <input type="text" name="keyword" class="search-input" placeholder="Cari nama pengunjung atau komentar..." value="<?= htmlspecialchars($keyword) ?>">
            </form>

            <div class="table-box">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Pengunjung</th>
                            <th>Rating</th>
                            <th>Komentar</th>
                            <th>Tipe</th>
                            <th>Tanggal</th>
                            <th style="text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        $sql = "SELECT * FROM ulasan";
                        if($keyword != '') {
                            $sql .= " WHERE nama_pengunjung LIKE '%$keyword%' OR komentar LIKE '%$keyword%'";
                        }
                        $sql .= " ORDER BY id DESC";
                        
                        $query = mysqli_query($koneksi, $sql);
                        while($row = mysqli_fetch_array($query)){ 
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><strong><?= htmlspecialchars($row['nama_pengunjung']); ?></strong></td>
                            <td>
                                <?php 
                                for($i=1; $i<=5; $i++){
                                    echo ($i <= $row['rating']) ? '<i class="fa-solid fa-star rating-star"></i>' : '<i class="fa-regular fa-star" style="color:#ddd"></i>';
                                }
                                ?>
                            </td>
                            <td><small style="color: #555;"><?= htmlspecialchars($row['komentar']); ?></small></td>
                            <td><span style="font-size: 11px; background: #eee; padding: 3px 8px; border-radius: 4px;"><?= htmlspecialchars($row['tipe_kunjungan']); ?></span></td>
                            <td style="font-size: 13px; color: #666;"><?= date('d M Y', strtotime($row['tanggal'])); ?></td>
                            <td style="text-align: center;">
                                <a href="edit_ulasan.php?id=<?= $row['id']; ?>" class="icon-btn icon-edit">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <a href="hapus_ulasan.php?id=<?= $row['id']; ?>" class="icon-btn icon-delete" onclick="return confirm('Hapus ulasan ini?')">
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