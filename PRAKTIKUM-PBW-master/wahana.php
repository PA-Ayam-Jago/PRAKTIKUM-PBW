<?php
require 'config/koneksi.php';
date_default_timezone_set('Asia/Makassar');

$filter = isset($_GET['kategori']) ? trim($_GET['kategori']) : 'Semua Wahana';
$cari   = isset($_GET['cari']) ? trim($_GET['cari']) : '';

// daftar kategori tab
$kategoriList = array(
    'Semua Wahana',
    'Wahana Ekstrem',
    'Hiburan Keluarga',
    'Zona Anak',
    'Wahana Air'
);

// query dasar
$query = "SELECT * FROM wahana WHERE 1=1";

// search
if (!empty($cari)) {
    $cariAman = mysqli_real_escape_string($conn, $cari);
    $query .= " AND nama_wahana LIKE '%$cariAman%'";
}

// filter kategori
if ($filter == 'Wahana Ekstrem') {
    $query .= " AND intensity IN ('Extreme', 'High')";
} elseif ($filter == 'Hiburan Keluarga') {
    $query .= " AND kategori = 'Family'";
} elseif ($filter == 'Zona Anak') {
    $query .= " AND kategori = 'Kids'";
} elseif ($filter == 'Wahana Air') {
    $query .= " AND kategori = 'Water'";
}

// urutkan
$query .= " ORDER BY id ASC";

$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query error: " . mysqli_error($conn));
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wahana - Samarinda Theme Park</title>
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
            <a href="wahana.php" class="active">Wahana</a>
            <a href="fasilitas.php">Fasilitas</a>
            <a href="tiket.php">Tiket</a>
            <a href="ulasan.php">Ulasan</a>
        </div>

        <div class="nav-right">
            <span class="search-icon">&#128269;</span>
            <a href="tiket.php" class="book-btn">Book Now</a>
        </div>
    </div>
</nav>

<section class="hero" style="background-image: url('assets/img/hero.jpg');">
    <div class="hero-overlay"></div>
    <div class="container hero-content">
        <h2>Wahana</h2>
        <p>
            Jelajahi berbagai wahana seru di Samarinda Theme Park, mulai dari wahana
            keluarga hingga permainan yang memacu adrenalin.
        </p>
    </div>
</section>

<section class="filter-section">
    <div class="container filter-wrap">
        <div class="filter-tabs">
            <?php foreach ($kategoriList as $kategori) : ?>
                <?php
                $active = ($filter == $kategori) ? 'active' : '';
                $link = 'wahana.php?kategori=' . urlencode($kategori);
                if (!empty($cari)) {
                    $link .= '&cari=' . urlencode($cari);
                }
                ?>
                <a href="<?= $link; ?>" class="filter-tab <?= $active; ?>">
                    <?= htmlspecialchars($kategori); ?>
                </a>
            <?php endforeach; ?>
        </div>

        <form class="search-box" method="GET" action="wahana.php">
            <input type="hidden" name="kategori" value="<?= htmlspecialchars($filter); ?>">
            <span>🔍</span>
            <input type="text" name="cari" placeholder="Cari wahana..." value="<?= htmlspecialchars($cari); ?>">
        </form>
    </div>
</section>

<section class="wahana-section">
    <div class="container">
        <div class="card-grid">
            <?php if (mysqli_num_rows($result) > 0) : ?>
                <?php while ($wahana = mysqli_fetch_assoc($result)) : ?>
                    <?php
                    $warna_level = 'level-normal';

                    if ($wahana['intensity'] == 'Extreme') {
                        $warna_level = 'level-extreme';
                    } elseif ($wahana['intensity'] == 'High') {
                        $warna_level = 'level-high';
                    } elseif ($wahana['intensity'] == 'Medium') {
                        $warna_level = 'level-medium';
                    } elseif ($wahana['intensity'] == 'Low' || $wahana['intensity'] == 'Normal') {
                        $warna_level = 'level-normal';
                    }

                    $gambar = !empty($wahana['gambar']) ? 'assets/img/' . $wahana['gambar'] : 'assets/img/default.jpg';
                    ?>
                    <div class="card">
                        <div class="card-image">
                            <img src="<?= htmlspecialchars($gambar); ?>" alt="<?= htmlspecialchars($wahana['nama_wahana']); ?>">
                        </div>

                        <div class="card-body">
                            <h3><?= htmlspecialchars($wahana['nama_wahana']); ?></h3>
                            <p><?= htmlspecialchars($wahana['deskripsi']); ?></p>

                            <div class="card-meta">
                                <span>🕒 <?= htmlspecialchars($wahana['durasi']); ?></span>
                                <span>👥 <?= htmlspecialchars($wahana['kapasitas']); ?> orang</span>
                            </div>

                            <div class="card-bottom">
                                <div class="level-pill <?= $warna_level; ?>">
                                    ⚡ <?= htmlspecialchars($wahana['intensity']); ?>
                                </div>

                                <a href="detail_wahana.php?id=<?= $wahana['id']; ?>" class="detail-link">
                                    Detail
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else : ?>
                <div class="empty-state">
                    <h3>Wahana tidak ditemukan</h3>
                    <p>Coba kata kunci lain atau pilih kategori yang berbeda.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

</body>
</html>