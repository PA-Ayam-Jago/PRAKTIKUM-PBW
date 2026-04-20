<?php
require 'config/koneksi.php';
date_default_timezone_set('Asia/Makassar');

$cari = isset($_GET['cari']) ? trim($_GET['cari']) : '';

// query dasar
$query = "SELECT * FROM fasilitas WHERE 1=1";

// search
if (!empty($cari)) {
    $cariAman = mysqli_real_escape_string($conn, $cari);
    $query .= " AND (
        nama_fasilitas LIKE '%$cariAman%' 
        OR deskripsi LIKE '%$cariAman%' 
        OR lokasi LIKE '%$cariAman%'
    )";
}

$query .= " ORDER BY id ASC";

$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query error: " . mysqli_error($conn));
}

// icon otomatis berdasarkan nama fasilitas
function getFasilitasIcon($nama) {
    $nama = strtolower($nama);

    if (strpos($nama, 'parkir') !== false) return '🚗';
    if (strpos($nama, 'store') !== false) return '🎁';
    if (strpos($nama, 'sitting') !== false) return '🪑';
    if (strpos($nama, 'musholla') !== false) return '🕌';
    if (strpos($nama, 'restaurant') !== false) return '🍽️';
    if (strpos($nama, 'foodcourt') !== false) return '🍴';
    if (strpos($nama, 'toilet') !== false) return '🚻';
    if (strpos($nama, 'gazebo') !== false) return '🏡';

    return '📍';
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fasilitas - Samarinda Theme Park</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<nav class="navbar">
    <div class="container navbar-inner">
        <div class="brand">
            <div class="logo-circle">S</div>
            <div class="brand-text">
                <h1>Samarinda</h1>
                <p>Theme Park</p>
            </div>
        </div>

        <div class="nav-links">
            <a href="index.php">Home</a>
            <a href="wahana.php">Wahana</a>
            <a href="fasilitas.php" class="active">Fasilitas</a>
            <a href="tiket.php">Tiket</a>
            <a href="review.php">Review</a>
        </div>

        <div class="nav-right">
            <span class="search-icon">&#128269;</span>
            <a href="tiket.php" class="book-btn">Book Now</a>
        </div>
    </div>
</nav>

<section class="hero hero-small" style="background-image: url('assets/img/fasilitas.jpg');">
    <div class="hero-overlay"></div>
    <div class="container hero-content">
        <h2>Fasilitas</h2>
        <p>Semua yang Anda butuhkan untuk kunjungan yang nyaman dan menyenangkan di Samarinda Theme Park.</p>
    </div>
</section>

<section class="filter-section">
    <div class="container filter-wrap">
        <div class="filter-tabs">
            <span class="filter-tab active">Semua Fasilitas</span>
        </div>

        <form class="search-box" method="GET" action="fasilitas.php">
            <span>🔍</span>
            <input type="text" name="cari" placeholder="Cari fasilitas..." value="<?= htmlspecialchars($cari); ?>">
        </form>
    </div>
</section>

<section class="fasilitas-section">
    <div class="container">
        <div class="fasilitas-grid">
            <?php if (mysqli_num_rows($result) > 0) : ?>
                <?php while ($item = mysqli_fetch_assoc($result)) : ?>
                    <div class="fasilitas-card">
                        <div class="fasilitas-icon"><?= getFasilitasIcon($item['nama_fasilitas']); ?></div>

                        <h3><?= htmlspecialchars($item['nama_fasilitas']); ?></h3>
                        <p><?= htmlspecialchars($item['deskripsi']); ?></p>

                        <div class="fasilitas-meta">
                            <?php if (!empty($item['lokasi'])) : ?>
                                <span>📍 <?= htmlspecialchars($item['lokasi']); ?></span>
                            <?php endif; ?>

                            <?php if (!empty($item['jam_operasional'])) : ?>
                                <span>🕒 <?= htmlspecialchars($item['jam_operasional']); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else : ?>
                <div class="empty-state">
                    <h3>Fasilitas tidak ditemukan</h3>
                    <p>Coba kata kunci lain untuk mencari fasilitas yang tersedia.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

</body>
</html>