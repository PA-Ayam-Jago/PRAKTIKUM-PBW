<?php
require 'config/koneksi.php';
date_default_timezone_set('Asia/Makassar');

$cari = isset($_GET['cari']) ? trim($_GET['cari']) : '';
$ratingFilter = isset($_GET['rating']) ? trim($_GET['rating']) : 'Semua';

// query dasar
$query = "SELECT * FROM ulasan WHERE 1=1";

// search
if (!empty($cari)) {
    $cariAman = mysqli_real_escape_string($conn, $cari);
    $query .= " AND (
        nama_pengunjung LIKE '%$cariAman%'
        OR judul LIKE '%$cariAman%'
        OR komentar LIKE '%$cariAman%'
        OR tipe_kunjungan LIKE '%$cariAman%'
    )";
}

// filter rating
if ($ratingFilter !== 'Semua' && is_numeric($ratingFilter)) {
    $ratingAman = (int)$ratingFilter;
    $query .= " AND rating = $ratingAman";
}

$query .= " ORDER BY id DESC";

$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query error: " . mysqli_error($conn));
}

function renderStars($rating) {
    $stars = '';
    for ($i = 1; $i <= 5; $i++) {
        $stars .= ($i <= $rating) ? '⭐' : '☆';
    }
    return $stars;
}

function getInitial($nama) {
    return strtoupper(substr(trim($nama), 0, 1));
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ulasan - Samarinda Theme Park</title>
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
            <a href="fasilitas.php">Fasilitas</a>
            <a href="tiket.php">Tiket</a>
            <a href="ulasan.php" class="active">Ulasan</a>
        </div>

        <div class="nav-right">
            <span class="search-icon">&#128269;</span>
            <a href="tiket.php" class="book-btn">Book Now</a>
        </div>
    </div>
</nav>

<section class="hero hero-small" style="background-image: url('assets/img/review.jpg');">
    <div class="hero-overlay"></div>
    <div class="container hero-content">
        <h2>Ulasan Pengunjung</h2>
        <p>Lihat pengalaman dan cerita pengunjung yang telah menikmati keseruan Samarinda Theme Park.</p>
    </div>
</section>

<section class="filter-section">
    <div class="container filter-wrap">
        <div class="filter-tabs">
            <?php
            $ratingList = array('Semua', '5', '4', '3', '2', '1');
            foreach ($ratingList as $item):
                $active = ($ratingFilter == $item) ? 'active' : '';
                $link = 'ulasan.php?rating=' . urlencode($item);
                if (!empty($cari)) {
                    $link .= '&cari=' . urlencode($cari);
                }
            ?>
                <a href="<?= $link; ?>" class="filter-tab <?= $active; ?>">
                    <?= $item === 'Semua' ? 'Semua Rating' : $item . ' Bintang'; ?>
                </a>
            <?php endforeach; ?>
        </div>

        <form class="search-box" method="GET" action="ulasan.php">
            <input type="hidden" name="rating" value="<?= htmlspecialchars($ratingFilter); ?>">
            <span>🔍</span>
            <input type="text" name="cari" placeholder="Cari ulasan..." value="<?= htmlspecialchars($cari); ?>">
        </form>
    </div>
</section>

<section class="review-section">
    <div class="container">
        <div class="review-grid">
            <?php if (mysqli_num_rows($result) > 0) : ?>
                <?php while ($ulasan = mysqli_fetch_assoc($result)) : ?>
                    <div class="review-card">
                        <div class="review-card-top">
                            <div class="review-stars"><?= renderStars((int)$ulasan['rating']); ?></div>
                            <div class="quote-mark">❞</div>
                        </div>

                        <h3><?= htmlspecialchars($ulasan['judul']); ?></h3>
                        <p class="review-comment"><?= htmlspecialchars($ulasan['komentar']); ?></p>

                        <div class="review-meta-top">
                            <span>👤 <?= htmlspecialchars($ulasan['tipe_kunjungan']); ?></span>
                            <span>📅 <?= htmlspecialchars($ulasan['tanggal']); ?></span>
                        </div>

                        <div class="review-user">
                            <div class="review-avatar"><?= getInitial($ulasan['nama_pengunjung']); ?></div>
                            <div>
                                <strong><?= htmlspecialchars($ulasan['nama_pengunjung']); ?></strong>
                                <span>Pengunjung Samarinda Theme Park</span>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else : ?>
                <div class="empty-state">
                    <h3>Ulasan tidak ditemukan</h3>
                    <p>Coba kata kunci lain atau pilih filter rating yang berbeda.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

</body>
</html>