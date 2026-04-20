<?php
session_start();
if($_SESSION['status'] != "login") header("location:../auth/login.php");
include '../config/koneksi.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Wahana - Samarinda Theme Park</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        /* GLOBAL FONT */
        * { font-family: 'Poppins', sans-serif; }
        
        body { background-color: #F4F6F9; margin: 0; }
        
        /* SIDEBAR LENGKAP SESUAI FIGMA */
        .sidebar { width: 250px; background-color: #E01940; color: white; min-height: 100vh; position: fixed; padding: 20px 0; z-index: 1000; }
        .sidebar-brand { padding: 0 25px 30px 25px; }
        .sidebar-brand h2 { margin: 0; font-weight: 700; font-size: 24px; }
        .sidebar-brand p { margin: 0; font-size: 13px; opacity: 0.9; }

        .menu-group { padding: 20px 25px 10px 25px; font-size: 11px; font-weight: 700; opacity: 0.8; text-transform: uppercase; letter-spacing: 1px; }
        
        .nav-link { 
            color: white !important; 
            padding: 12px 25px; 
            display: block; 
            text-decoration: none; 
            font-size: 14px; 
            opacity: 0.8; 
            border-left: 5px solid transparent;
            transition: 0.3s;
        }
        
        .nav-link:hover { background: rgba(255, 255, 255, 0.1); opacity: 1; }
        
        /* GARIS PUTIH AKTIF */
        .nav-link.active { 
            background: rgba(0,0,0,0.1); 
            opacity: 1; 
            font-weight: 600; 
            border-left: 5px solid white !important; 
        }

        /* CONTENT AREA */
        .main-content { margin-left: 250px; width: calc(100% - 250px); }
        .top-header { background: white; padding: 15px 40px; display: flex; justify-content: flex-end; align-items: center; border-bottom: 1px solid #eee; }
        .container-padding { padding: 40px; }
        
        .card { border-radius: 20px; border: none; box-shadow: 0 5px 15px rgba(0,0,0,0.05); background: white; }

        /* BADGE KATEGORI & INTENSITY (NON-KAPITAL) */
        .badge-custom {
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            text-transform: capitalize; /* Hanya huruf depan besar, sesuai Figma */
            display: inline-block;
        }
        .bg-thrill { background-color: #FFE5E9; color: #E01940; }
        .bg-family { background-color: #E5EAFF; color: #1940E0; }

        .table thead th { background-color: #F1F3F5; color: #495057; font-size: 12px; text-transform: uppercase; padding: 15px; border: none; }
        .table tbody td { padding: 15px; border-bottom: 1px solid #f8f9fa; font-size: 14px; }
    </style>
</head>
<body>

    <div class="sidebar">
        <div class="sidebar-brand">
            <h2>ADMIN</h2>
            <p>Samarinda Theme Park</p>
        </div>

        <div class="menu-group">Main</div>
        <a href="index.php" class="nav-link">Dashboard</a>

        <div class="menu-group">Konten Website</div>
        <a href="data_wahana.php" class="nav-link active">Wahana</a>
        <a href="data_fasilitas.php" class="nav-link">Fasilitas</a>
        <a href="data_tiket.php" class="nav-link">Tiket</a>
        <a href="data_promo.php" class="nav-link">Promo</a>
        <a href="data_review.php" class="nav-link">Review</a>
        <a href="data_beranda.php" class="nav-link">Beranda</a>
        <a href="data_kontak.php" class="nav-link">Kontak</a>

        <div class="menu-group">Pengaturan</div>
        <a href="data_admin.php" class="nav-link">Akun Admin</a>
        <a href="../auth/logout.php" class="nav-link">Log Out</a>
    </div>

    <div class="main-content">
        <div class="top-header">
            <span class="small text-muted">Admin User</span>
            <div class="bg-danger text-white rounded-circle ms-2 d-flex align-items-center justify-content-center" style="width: 35px; height: 35px; font-weight: bold;">A</div>
        </div>

        <div class="container-padding">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold m-0">Kelola Wahana</h2>
                    <p class="text-muted m-0 small">Manage attractions and rides</p>
                </div>
                <a href="tambah_wahana.php" class="btn btn-danger px-4 fw-bold" style="border-radius: 10px;">+ Tambah Wahana</a>
            </div>

            <div class="card p-4">
                <div class="table-responsive">
                    <table class="table align-middle">
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
                            $query = mysqli_query($koneksi, "SELECT * FROM wahana ORDER BY id_wahana DESC");
                            while($w = mysqli_fetch_array($query)){
                                // Tentukan warna berdasarkan kategori
                                $color_class = (strtolower($w['kategori']) == 'thrill') ? 'bg-thrill' : 'bg-family';
                            ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td>
                                    <strong><?php echo $w['nama_wahana']; ?></strong><br>
                                    <small class="text-muted">Main Zone</small>
                                </td>
                                <td>
                                    <span class="badge-custom <?php echo $color_class; ?>">
                                        <?php echo strtolower($w['kategori']); ?>
                                    </span>
                                </td>
                                <td>
                                    <span class="badge-custom <?php echo $color_class; ?>">
                                        <?php echo strtolower($w['intensity']); ?>
                                    </span>
                                </td>
                                <td><?php echo $w['kapasitas']; ?> orang</td>
                                <td><?php echo $w['durasi']; ?> menit</td>
                                <td class="text-center">
                                    <a href="edit_wahana.php?id=<?php echo $w['id_wahana']; ?>" class="text-dark me-2"><i class="fas fa-edit"></i></a>
                                    <a href="hapus_wahana.php?id=<?php echo $w['id_wahana']; ?>" class="text-dark" onclick="return confirm('Hapus data?')"><i class="fas fa-trash"></i></a>
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