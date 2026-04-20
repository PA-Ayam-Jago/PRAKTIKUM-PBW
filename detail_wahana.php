<?php
$wahanaList = [
    1 => [
        'nama' => 'Bianglala',
        'kategori' => 'Wahana Ekstrem',
        'durasi' => '3 menit',
        'kapasitas' => '24 orang',
        'tinggi_minimum' => '120 cm',
        'jam_operasional' => '10:00 - 20:00 WITA',
        'level' => 'Extreme',
        'gambar' => 'Wahana.jpg',
        'deskripsi' => 'Bianglala adalah salah satu wahana favorit yang menawarkan pengalaman melihat pemandangan Samarinda Theme Park dari ketinggian. Saat malam hari, wahana ini memberikan suasana yang sangat indah dengan lampu taman yang berkilauan.',
        'fasilitas' => [
            'Area antrian tertata rapi',
            'Petugas keamanan di lokasi',
            'Spot foto menarik dari atas',
            'Cocok untuk remaja dan dewasa'
        ]
    ],
    2 => [
        'nama' => 'Duck Boat',
        'kategori' => 'Wahana Air',
        'durasi' => '8 menit',
        'kapasitas' => '16 orang',
        'tinggi_minimum' => '100 cm',
        'jam_operasional' => '10:00 - 20:00 WITA',
        'level' => 'Medium',
        'gambar' => 'Wahana air.jpg',
        'deskripsi' => 'Duck Boat menghadirkan pengalaman bermain air yang santai namun tetap seru. Cocok untuk keluarga yang ingin menikmati wahana dengan nuansa ceria dan cahaya warna-warni yang menyenangkan.',
        'fasilitas' => [
            'Pengaman duduk',
            'Pendamping petugas',
            'Area tunggu nyaman',
            'Cocok untuk keluarga'
        ]
    ],
    3 => [
        'nama' => 'Monorail',
        'kategori' => 'Hiburan Keluarga',
        'durasi' => '8 menit',
        'kapasitas' => '20 orang',
        'tinggi_minimum' => '100 cm',
        'jam_operasional' => '10:00 - 20:00 WITA',
        'level' => 'Extreme',
        'gambar' => 'hiburan keluarga.jpg',
        'deskripsi' => 'Monorail mengajak pengunjung menikmati perjalanan santai berkeliling area taman. Wahana ini cocok untuk semua umur yang ingin menikmati suasana taman dengan nyaman.',
        'fasilitas' => [
            'Tempat duduk nyaman',
            'Pemandangan area taman',
            'Wahana keluarga',
            'Aman untuk anak dengan pendamping'
        ]
    ],
    4 => [
        'nama' => 'Snow Rail',
        'kategori' => 'Zona Anak',
        'durasi' => '8 menit',
        'kapasitas' => '8 orang',
        'tinggi_minimum' => '90 cm',
        'jam_operasional' => '10:00 - 20:00 WITA',
        'level' => 'Normal',
        'gambar' => 'Zona anak.jpg',
        'deskripsi' => 'Snow Rail adalah wahana lucu dan aman untuk anak-anak dengan tema salju yang unik. Sangat cocok untuk keluarga yang membawa buah hati menikmati permainan ringan.',
        'fasilitas' => [
            'Aman untuk anak',
            'Tema salju menarik',
            'Petugas pendamping',
            'Spot foto keluarga'
        ]
    ]
];

$id = isset($_GET['id']) ? (int) $_GET['id'] : 1;
$wahana = isset($wahanaList[$id]) ? $wahanaList[$id] : $wahanaList[1];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Wahana - <?= htmlspecialchars($wahana['nama']); ?></title>
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
            <a href="review.php">Review</a>
        </div>

        <div class="nav-right">
            <span class="search-icon">&#128269;</span>
            <a href="tiket.php" class="book-btn">Book Now</a>
        </div>
    </div>
</nav>

<section class="detail-section">
    <div class="container">
        <div class="breadcrumb">
            <a href="index.php">Home</a>
            <span>/</span>
            <a href="wahana.php">Wahana</a>
            <span>/</span>
            <span><?= htmlspecialchars($wahana['nama']); ?></span>
        </div>

        <div class="detail-grid">
            <div class="detail-image">
                <img src="<?= htmlspecialchars($wahana['gambar']); ?>" alt="<?= htmlspecialchars($wahana['nama']); ?>">
            </div>

            <div class="detail-content">
                <span class="category-pill"><?= htmlspecialchars($wahana['kategori']); ?></span>
                <h1><?= htmlspecialchars($wahana['nama']); ?></h1>
                <p class="description"><?= htmlspecialchars($wahana['deskripsi']); ?></p>

                <div class="info-list">
                    <div class="info-item">
                        <strong>Durasi</strong>
                        <span><?= htmlspecialchars($wahana['durasi']); ?></span>
                    </div>
                    <div class="info-item">
                        <strong>Kapasitas</strong>
                        <span><?= htmlspecialchars($wahana['kapasitas']); ?></span>
                    </div>
                    <div class="info-item">
                        <strong>Tinggi Minimum</strong>
                        <span><?= htmlspecialchars($wahana['tinggi_minimum']); ?></span>
                    </div>
                    <div class="info-item">
                        <strong>Jam Operasional</strong>
                        <span><?= htmlspecialchars($wahana['jam_operasional']); ?></span>
                    </div>
                    <div class="info-item">
                        <strong>Tingkat Sensasi</strong>
                        <span><?= htmlspecialchars($wahana['level']); ?></span>
                    </div>
                </div>

                <div class="detail-buttons">
                    <a href="tiket.php" class="btn-primary">Pesan Tiket</a>
                    <a href="wahana.php" class="btn-secondary">Kembali ke Wahana</a>
                </div>
            </div>
        </div>

        <div class="facility-box">
            <h2>Fasilitas Wahana</h2>
            <ul>
                <?php foreach ($wahana['fasilitas'] as $item): ?>
                    <li><?= htmlspecialchars($item); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</section>

</body>
</html>