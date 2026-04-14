<?php
date_default_timezone_set('Asia/Makassar');

$wahanaList = array(
    array(
        'id' => 1,
        'nama' => 'Bianglala',
        'kategori' => 'Semua Wahana',
        'durasi' => '3 menit',
        'kapasitas' => '24 orang',
        'level' => 'Extreme',
        'warna_level' => 'level-extreme',
        'gambar' => 'Wahana.jpg',
        'deskripsi' => 'Nikmati momen magis saat senja merona di cakrawala. Dari ketinggian, pengunjung dapat menikmati panorama taman yang memukau.'
    ),
    array(
        'id' => 2,
        'nama' => 'Duck Boat',
        'kategori' => 'Wahana Air',
        'durasi' => '8 menit',
        'kapasitas' => '16 orang',
        'level' => 'Medium',
        'warna_level' => 'level-medium',
        'gambar' => 'Wahana air.jpg',
        'deskripsi' => 'Nikmati petualangan air yang seru dan menyenangkan bersama keluarga di suasana taman yang penuh cahaya.'
    ),
    array(
        'id' => 3,
        'nama' => 'Monorail',
        'kategori' => 'Hiburan Keluarga',
        'durasi' => '8 menit',
        'kapasitas' => '20 orang',
        'level' => 'Extreme',
        'warna_level' => 'level-extreme',
        'gambar' => 'hiburan keluarga.jpg',
        'deskripsi' => 'Kereta santai yang mengajak pengunjung berkeliling menikmati sudut-sudut menarik Samarinda Theme Park.'
    ),
    array(
        'id' => 4,
        'nama' => 'Snow Rail',
        'kategori' => 'Zona Anak',
        'durasi' => '8 menit',
        'kapasitas' => '8 orang',
        'level' => 'Normal',
        'warna_level' => 'level-normal',
        'gambar' => 'Zona anak.jpg',
        'deskripsi' => 'Wahana ramah anak dengan suasana lucu dan aman, cocok untuk pengalaman bermain yang menyenangkan.'
    )
);

$filter = isset($_GET['kategori']) ? $_GET['kategori'] : 'Semua Wahana';
$cari = isset($_GET['cari']) ? trim($_GET['cari']) : '';

$hasil = array();

foreach ($wahanaList as $wahana) {
    $cocokKategori = false;

    if ($filter == 'Semua Wahana') {
        $cocokKategori = true;
    } elseif ($filter == 'Wahana Ekstrem' && $wahana['level'] == 'Extreme') {
        $cocokKategori = true;
    } elseif ($filter == $wahana['kategori']) {
        $cocokKategori = true;
    }

    $cocokCari = empty($cari) || stripos($wahana['nama'], $cari) !== false;

    if ($cocokKategori && $cocokCari) {
        $hasil[] = $wahana;
    }
}

$kategoriList = array('Semua Wahana', 'Wahana Ekstrem', 'Hiburan Keluarga', 'Zona Anak', 'Wahana Air');
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
            <a href="promo.php">Promosi</a>
            <a href="review.php">Review</a>
        </div>

        <div class="nav-right">
            <span class="search-icon">&#128269;</span>
            <a href="tiket.php" class="book-btn">Book Now</a>
        </div>
    </div>
</nav>

<section class="hero" style="background-image: url('Home (dashboard).jpg');">
    <div class="hero-overlay"></div>
    <div class="container hero-content">
        <h2>Wahana</h2>
        <p>
            Jelajahi berbagai wahana dan atraksi luar biasa kami. Mulai dari
            roller coaster yang mendebarkan hingga keseruan yang ramah keluarga!
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
                <a href="<?php echo $link; ?>" class="filter-tab <?php echo $active; ?>">
                    <?php echo htmlspecialchars($kategori); ?>
                </a>
            <?php endforeach; ?>
        </div>

        <form class="search-box" method="GET" action="wahana.php">
            <input type="hidden" name="kategori" value="<?php echo htmlspecialchars($filter); ?>">
            <span>🔍</span>
            <input type="text" name="cari" placeholder="Cari wahana..." value="<?php echo htmlspecialchars($cari); ?>">
        </form>
    </div>
</section>

<section class="wahana-section">
    <div class="container">
        <div class="card-grid">
            <?php if (count($hasil) > 0) : ?>
                <?php foreach ($hasil as $wahana) : ?>
                    <div class="card">
                        <div class="card-image">
                            <img src="<?php echo htmlspecialchars($wahana['gambar']); ?>" alt="<?php echo htmlspecialchars($wahana['nama']); ?>">
                        </div>

                        <div class="card-body">
                            <h3><?php echo htmlspecialchars($wahana['nama']); ?></h3>
                            <p><?php echo htmlspecialchars($wahana['deskripsi']); ?></p>

                            <div class="card-meta">
                                <span>🕒 <?php echo htmlspecialchars($wahana['durasi']); ?></span>
                                <span>👥 <?php echo htmlspecialchars($wahana['kapasitas']); ?></span>
                            </div>

                            <div class="card-bottom">
                                <div class="level-pill <?php echo htmlspecialchars($wahana['warna_level']); ?>">
                                    ⚡ <?php echo htmlspecialchars($wahana['level']); ?>
                                </div>

                                <a href="detail_wahana.php?id=<?php echo $wahana['id']; ?>" class="detail-link">
                                    Detail
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
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