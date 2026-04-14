<?php
$fasilitasList = array(
    array(
        'icon' => '🚗',
        'nama' => 'Area Parkir',
        'deskripsi' => 'Parkir luas dengan 2.000+ slot untuk mobil dan motor. Parkir VIP tersedia di dekat pintu masuk.',
        'lokasi' => 'Pintu Masuk Utama',
        'jam' => '07:00 - 23:00'
    ),
    array(
        'icon' => '🍴',
        'nama' => 'Tempat Makan',
        'deskripsi' => 'Berbagai pilihan tempat makan termasuk masakan lokal, hidangan internasional, dan camilan.',
        'lokasi' => 'Plaza Utama (Central Plaza)',
        'jam' => '10:00 - 21:00'
    ),
    array(
        'icon' => '➕',
        'nama' => 'Layanan Medis',
        'deskripsi' => 'Dilayani oleh tenaga medis terlatih. Tersedia untuk penanganan cedera ringan dan keadaan darurat.',
        'lokasi' => 'Dekat Sky Wheel',
        'jam' => 'Sesuai Jam Operasional Taman'
    ),
    array(
        'icon' => '🚻',
        'nama' => 'Toilet',
        'deskripsi' => 'Toilet yang bersih dan mudah diakses di seluruh area taman.',
        'lokasi' => 'Di Seluruh Area Taman',
        'jam' => ''
    ),
    array(
        'icon' => '🎁',
        'nama' => 'Toko Souvenir',
        'deskripsi' => 'Bawa pulang kenanganmu! Tersedia suvenir, merchandise, dan barang eksklusif taman hiburan.',
        'lokasi' => 'Dekat Sky Wheel',
        'jam' => 'Sesuai Jam Operasional Taman'
    ),
    array(
        'icon' => '☾',
        'nama' => 'Musholla',
        'deskripsi' => 'Tersedia ruang ibadah yang tenang lengkap dengan fasilitas tempat wudhu.',
        'lokasi' => 'Dekat tempat makan',
        'jam' => ''
    )
);
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
            <a href="promo.php">Promosi</a>
            <a href="review.php">Review</a>
        </div>

        <div class="nav-right">
            <span class="search-icon">&#128269;</span>
            <a href="tiket.php" class="book-btn">Book Now</a>
        </div>
    </div>
</nav>

<section class="hero hero-small" style="background-image: url('fasilitas.jpg');">
    <div class="hero-overlay"></div>
    <div class="container hero-content">
        <h2>Fasilitas</h2>
        <p>Semua yang Anda butuhkan untuk kunjungan yang nyaman dan menyenangkan di taman kami.</p>
    </div>
</section>

<section class="fasilitas-section">
    <div class="container">
        <div class="fasilitas-grid">
            <?php foreach ($fasilitasList as $item) : ?>
                <div class="fasilitas-card">
                    <div class="fasilitas-icon"><?php echo $item['icon']; ?></div>
                    <h3><?php echo htmlspecialchars($item['nama']); ?></h3>
                    <p><?php echo htmlspecialchars($item['deskripsi']); ?></p>

                    <div class="fasilitas-meta">
                        <?php if (!empty($item['lokasi'])) : ?>
                            <span>📍 <?php echo htmlspecialchars($item['lokasi']); ?></span>
                        <?php endif; ?>

                        <?php if (!empty($item['jam'])) : ?>
                            <span>🕒 <?php echo htmlspecialchars($item['jam']); ?></span>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

</body>
</html>