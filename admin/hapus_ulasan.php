<?php
session_start();
if($_SESSION['status'] != "login"){
    header("location:../auth/login.php?pesan=belum_login");
    exit();
}
include '../config/koneksi.php';

// Ambil data wahana dari database
$query = mysqli_query($koneksi, "SELECT * FROM wahana ORDER BY id_wahana DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Wahana - Samarinda Theme Park</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        :root { 
            --stp-crimson: #FF0040; 
            --stp-bg: #F8F9FA; 
        }
        body { background-color: var(--stp-bg); font-family: 'Poppins', sans-serif; color: #333; }

        /* SIDEBAR (Konsisten dengan Dashboard) */
        .sidebar { 
            width: 260px; height: 100vh; background-color: var(--stp-crimson) !important; 
            color: white; position: fixed; left: 0; top: 0; z-index: 1100;
        }
        .sidebar-header { padding: 40px 25px 25px; }
        .nav-link { color: rgba(255, 255, 255, 0.75) !important; padding: 12px 25px !important; font-size: 13px; }
        .nav-link.active { background: rgba(0, 0, 0, 0.15); color: white !important; border-left: 4px solid white; }
        .sidebar-heading { font-size: 10px; padding: 25px 25px 8px; opacity: 0.6; text-transform: uppercase; font-weight: 700; }

        /* TOPBAR */
        .top-navbar {
            position: fixed; top: 0; right: 0; left: 260px; height: 65px;
            background: white; display: flex; align-items: center; justify-content: flex-end;
            padding: 0 40px; z-index: 1000; box-shadow: 0 2px 4px rgba(0,0,0,0.02);
        }

        /* MAIN CONTENT */
        .main-content { margin-left: 260px; padding: 100px 40px 40px; }
        
        .header-flex { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 30px; }
        .btn-tambah { background-color: var(--stp-crimson); color: white; border: none; border-radius: 8px; padding: 10px 20px; font-size: 13px; font-weight: 600; }
        .btn-tambah:hover { background-color: #E60039; color: white; }

        /* SEARCH & FILTER AREA */
        .filter-row { display: flex; gap: 15px; margin-bottom: 25px; }
        .search-container { position: relative; flex-grow: 1; }
        .search-container i { position: absolute; left: 15px; top: 12px; color: #aaa; }
        .search-input { padding-left: 40px; border-radius: 10px; border: 1px solid #ddd; height: 45px; font-size: 13px; }
        .filter-select { width: 180px; border-radius: 10px; border: 1px solid #ddd; height: 45px; font-size: 13px; }

        /* TABLE STYLING */
        .table-container { background: white; border-radius: 20px; padding: 0; border: 1px solid #EAEAEA; overflow: hidden; }
        .table thead th { background-color: #D3D3D3; color: #333; font-weight: 600; font-size: 13px; border: none; padding: 15px; }
        .table tbody td { padding: 15px; vertical-align: middle; font-size: 13px; border-bottom: 1px solid #F1F1F1; }
        
        /* BADGES (Sesuai Figma) */
        .badge-kat { font-size: 9px; padding: 4px 12px; border-radius: 20px; font-weight: 600; display: inline-block; }
        .kat-thrill { background: #FEEEEE; color: #FF4D4D; }
        .kat-water { background: #E6F7FF; color: #1890FF; }
        .kat-family { background: #F0F5FF; color: #2F54EB; }
        
        .badge-int { font-size: 9px; padding: 4px 12px; border-radius: 8px; font-weight: 600; }
        .int-extreme { background: #FEEEEE; color: #FF0040; }
        .int-medium { background: #FFF4E6; color: #FF922B; }
        .int-low { background: #F6FFED; color: #52C41A; }
    </style>
</head>
<body>

<aside class="sidebar">
    <div class="sidebar-header">
        <h4 class="m-0">ADMIN</h4>
        <small>Samarinda Theme Park</small>
    </div>
    <nav class="nav flex-column">
        <div class="sidebar-heading">Main</div>
        <a class="nav-link" href="index.php">Dashboard</a>
        <div class="sidebar-heading">Konten Website</div>
        <a class="nav-link active" href="wahana.php">Wahana</a>
        <a class="nav-link" href="fasilitas.php">Fasilitas</a>
        <a class="nav-link" href="tiket.php">Tiket</a>
        <a class="nav-link" href="promo.php">Promo</a>
        <a class="nav-link" href="review.php">Review</a>
        <div class="sidebar-heading">Pengaturan</div>
        <a class="nav-link" href="logout.php">Log Out</a>
    </nav>
</aside>

<header class="top-navbar">
    <div class="admin-profile">
        <span class="admin-name">Admin User</span>
        <div class="admin-avatar">A</div>
    </div>
</header>

<main class="main-content">
    <div class="header-flex">
        <div>
            <h2 class="fw-bold m-0" style="font-size: 24px;">Kelola Wahana</h2>
            <p class="text-muted" style="font-size: 13px;">Manage attractions and rides</p>
        </div>
        <button class="btn btn-tambah"><i class="fas fa-plus me-2"></i> Tambah Wahana</button>
    </div>

    <div class="filter-row">
        <div class="search-container">
            <i class="fas fa-search"></i>
            <input type="text" class="form-control search-input" placeholder="Cari wahana...">
        </div>
        <select class="form-select filter-select">
            <option selected>Semua Kategori</option>
            <option>Thrill</option>
            <option>Water</option>
            <option>Family</option>
        </select>
    </div>

    <div class="table-container">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Wahana</th>
                    <th>Kategori</th>
                    <th>Intensity</th>
                    <th>Kapasitas</th>
                    <th>Durasi</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $no = 1;
                while($d = mysqli_fetch_array($query)) { 
                    // Logika warna badge (bisa disesuaikan dengan isi database kamu)
                    $kat_class = (strtolower($d['kategori']) == 'thrill') ? 'kat-thrill' : 'kat-water';
                    $int_class = (strtolower($d['intensity']) == 'extreme') ? 'int-extreme' : 'int-medium';
                ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td>
                        <div class="fw-bold"><?= $d['nama_wahana']; ?></div>
                        <small class="text-muted"><?= $d['lokasi_zona']; ?></small>
                    </td>
                    <td><span class="badge-kat <?= $kat_class; ?>"><?= $d['kategori']; ?></span></td>
                    <td><span class="badge-int <?= $int_class; ?>"><?= $d['intensity']; ?></span></td>
                    <td><?= $d['kapasitas']; ?></td>
                    <td><?= $d['durasi']; ?> menit</td>
                    <td class="text-center">
                        <a href="edit_wahana.php?id=<?= $d['id_wahana']; ?>" class="text-primary me-2"><i class="fas fa-edit"></i></a>
                        <a href="hapus_wahana.php?id=<?= $d['id_wahana']; ?>" class="text-danger" onclick="return confirm('Yakin ingin menghapus?')"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</main>

</body>
</html>