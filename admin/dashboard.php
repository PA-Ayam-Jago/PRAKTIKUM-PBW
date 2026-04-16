<?php
session_start();
if($_SESSION['status'] != "login"){
    header("location:../auth/login.php?pesan=belum_login");
    exit();
}
include '../config/koneksi.php';

// Query untuk Statistik Card
$q_wahana = mysqli_query($koneksi, "SELECT * FROM wahana");
$q_fasilitas = mysqli_query($koneksi, "SELECT * FROM fasilitas");
$q_tiket = mysqli_query($koneksi, "SELECT * FROM tiket");
$q_promo = mysqli_query($koneksi, "SELECT * FROM promo");

// Query untuk Tabel di bawah (Limit 5 data terbaru)
$wahana_terbaru = mysqli_query($koneksi, "SELECT * FROM wahana ORDER BY id_wahana DESC LIMIT 5");
$review_terbaru = mysqli_query($koneksi, "SELECT * FROM ulasan ORDER BY id_ulasan DESC LIMIT 5");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Samarinda Theme Park</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root { --stp-crimson: #E01940; --stp-bg: #F4F6F9; }
        body { background-color: var(--stp-bg); font-family: 'Poppins', sans-serif; }
        
        .main-content { margin-left: 250px; padding: 40px; }
        
        /* Gaya Card Statistik */
        .stat-card { 
            background: white; border-radius: 20px; padding: 25px; 
            border: none; box-shadow: 0 4px 15px rgba(0,0,0,0.02);
            display: flex; align-items: center; justify-content: space-between;
        }

        /* Gaya Tabel Dashboard (Figma Style) */
        .dashboard-table-card {
            background: white; border-radius: 20px; padding: 30px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.02); height: 100%;
        }
        .table-title { font-size: 18px; font-weight: 700; margin-bottom: 20px; }
        .badge-category { 
            background: #FFE5E9; color: var(--stp-crimson); 
            font-size: 10px; padding: 4px 10px; border-radius: 20px; font-weight: 600;
        }
    </style>
</head>
<body>

<div class="main-content">
    <div class="mb-4">
        <h2 class="fw-bold">Dashboard</h2>
        <p class="text-muted small">Selamat datang di admin panel Samarinda Theme Park</p>
    </div>

    <div class="row mb-4">
        <div class="col-md-3">
            <div class="stat-card">
                <div><small class="text-muted d-block">TOTAL WAHANA</small><h3 class="fw-bold m-0"><?php echo mysqli_num_rows($q_wahana); ?></h3></div>
                <img src="../assets/img/icon-wahana.png" width="40">
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card" style="background: #E3F2FD;">
                <div><small class="text-primary d-block">TOTAL FASILITAS</small><h3 class="fw-bold m-0"><?php echo mysqli_num_rows($q_fasilitas); ?></h3></div>
                <img src="../assets/img/icon-fasilitas.png" width="40">
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card" style="background: #F1F8E9;">
                <div><small class="text-success d-block">TOTAL TIKET</small><h3 class="fw-bold m-0"><?php echo mysqli_num_rows($q_tiket); ?></h3></div>
                <img src="../assets/img/icon-tiket.png" width="40">
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card" style="background: #F3E5F5;">
                <div><small class="text-purple d-block">TOTAL PROMO</small><h3 class="fw-bold m-0"><?php echo mysqli_num_rows($q_promo); ?></h3></div>
                <img src="../assets/img/icon-promo.png" width="40">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-7">
            <div class="dashboard-table-card">
                <h5 class="table-title">Wahana Terbaru</h5>
                <table class="table table-borderless align-middle">
                    <tbody>
                        <?php while($w = mysqli_fetch_array($wahana_terbaru)) { ?>
                        <tr>
                            <td>
                                <div class="fw-bold"><?php echo $w['nama_wahana']; ?></div>
                            </td>
                            <td class="text-end"><span class="badge-category">EXTREME</span></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-md-5">
            <div class="dashboard-table-card">
                <h5 class="table-title">Review Terbaru</h5>
                <?php while($r = mysqli_fetch_array($review_terbaru)) { ?>
                <div class="mb-3 pb-3 border-bottom">
                    <div class="d-flex justify-content-between">
                        <h6 class="fw-bold m-0"><?php echo $r['nama_pengunjung']; ?></h6>
                        <small class="text-warning">★★★★★</small>
                    </div>
                    <p class="text-muted small m-0 mt-1"><?php echo substr($r['ulasan'], 0, 50); ?>...</p>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

</body>
</html>