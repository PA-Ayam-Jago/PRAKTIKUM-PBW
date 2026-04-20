<?php
session_start();
if($_SESSION['status'] != "login"){
    header("location:../auth/login.php?pesan=belum_login");
    exit();
}
include '../config/koneksi.php';
// Query mengambil data dari tabel promo
$query = mysqli_query($koneksi, "SELECT * FROM promo");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Promo - Samarinda Theme Park</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root { --stp-crimson: #E01940; --stp-bg: #F4F6F9; }
        body { background-color: var(--stp-bg); font-family: 'Poppins', sans-serif; margin: 0; }

        /* SIDEBAR (Konsisten dengan menu lainnya) */
        .sidebar { 
            width: 250px; height: 100vh; background-color: var(--stp-crimson) !important; 
            color: white; position: fixed; left: 0; top: 0; padding-top: 30px; z-index: 1000;
        }
        .brand { padding: 0 30px; margin-bottom: 40px; }
        .brand-title { font-size: 24px; font-weight: 700; line-height: 1; margin: 0; }
        .brand-sub { font-size: 13px; font-weight: 300; opacity: 0.9; }
        .sidebar-heading { font-size: 11px; font-weight: 600; margin: 25px 0 10px 30px; opacity: 0.6; letter-spacing: 1.2px; text-transform: uppercase; }
        .nav-link { color: rgba(255, 255, 255, 0.8) !important; padding: 12px 30px !important; font-size: 14px; text-decoration: none; display: block; }
        .nav-link.active { background: rgba(0, 0, 0, 0.1); color: white !important; font-weight: 600; }

        /* MAIN CONTENT */
        .main-content { margin-left: 250px; padding: 40px; }

        /* SEARCH BAR */
        .search-container { position: relative; margin-bottom: 25px; }
        .search-bar { 
            width: 100%; border-radius: 10px; padding: 10px 15px 10px 40px; 
            border: 1px solid #ccc; background-color: white; font-size: 14px;
        }

        /* BUTTON TAMBAH (Revisi: Sudut disamakan dengan wahana) */
        .btn-tambah { 
            background-color: var(--stp-crimson); color: white !important; padding: 10px 20px; 
            border-radius: 8px; font-size: 14px; font-weight: 500; border: none;
            transition: background-color 0.3s ease;
        }
        .btn-tambah:hover { 
            background-color: #b31433; color: white !important; text-decoration: none;
        }

        /* TABLE CUSTOM (Grey header sesuai Figma) */
        .table-container { 
            background: white; border-radius: 15px; overflow: hidden; 
            border: 1px solid #ddd; box-shadow: 0 4px 10px rgba(0,0,0,0.02);
        }
        .table { margin-bottom: 0; }
        .table thead th { 
            background-color: #D3D3D3 !important; 
            color: #333; font-size: 13px; font-weight: 600; padding: 20px; border: none;
        }
        .table tbody td { padding: 20px; font-size: 14px; vertical-align: middle; border-bottom: 1px solid #eee; }
        
        /* Badge Promo */
        .badge-promo { background-color: #FFE5E5; color: #E01940; padding: 5px 12px; border-radius: 5px; font-weight: 600; font-size: 12px; }
        .status-active { background-color: #E7F9EE; color: #27AE60; padding: 5px 12px; border-radius: 5px; font-weight: 600; font-size: 12px; }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="brand">
        <div class="brand-title">ADMIN</div>
        <div class="brand-sub">Samarinda Theme Park</div>
    </div>
    
    <div class="sidebar-heading">MAIN</div>
    <nav class="nav flex-column">
        <a class="nav-link" href="index.php">Dashboard</a>
    </nav>

    <div class="sidebar-heading">KONTEN WEBSITE</div>
    <nav class="nav flex-column">
        <a class="nav-link" href="data_wahana.php">Wahana</a>
        <a class="nav-link" href="data_fasilitas.php">Fasilitas</a>
        <a class="nav-link" href="data_tiket.php">Tiket</a>
        <a class="nav-link active" href="data_promo.php">Promo</a>
        <a class="nav-link" href="data_review.php">Review</a>
        <a class="nav-link" href="data_beranda.php">Beranda</a>
        <a class="nav-link" href="data_kontak.php">Kontak</a>
    </nav>

    <div class="sidebar-heading">PENGATURAN</div>
    <nav class="nav flex-column">
        <a class="nav-link" href="akun_admin.php">Akun Admin</a>
        <a class="nav-link text-warning fw-bold" href="logout.php">Log Out</a>
    </nav>
</div>

<div class="main-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-0">Kelola Promo</h2>
            <p class="text-muted small">Manage attractions and rides</p>
        </div>
        <a href="tambah_promo.php" class="btn btn-tambah text-decoration-none">+ Tambah Promo</a>
    </div>

    <div class="search-container">
        <input type="text" class="search-bar" placeholder="Cari promo...">
    </div>

    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th width="60">No</th>
                    <th>Nama Promo</th>
                    <th>Badge</th>
                    <th>Kode</th>
                    <th>Berlaku Sampai</th>
                    <th>Status</th>
                    <th width="100">Edit</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $no = 1;
                while($p = mysqli_fetch_array($query)){
                ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td class="fw-bold"><?php echo $p['nama_promo']; ?></td>
                    <td><span class="badge-promo"><?php echo $p['persen_diskon']; ?>% off</span></td>
                    <td class="text-muted"><?php echo $p['kode_promo']; ?></td>
                    <td><?php echo date('d M Y', strtotime($p['tanggal_akhir'])); ?></td>
                    <td><span class="status-active"><?php echo $p['status']; ?></span></td>
                    <td>
                        <a href="edit_promo.php?id=<?php echo $p['id_promo']; ?>" class="text-dark"><i class="fas fa-edit"></i> Edit</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>