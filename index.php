<?php
require __DIR__ . '/config/koneksi.php';

// BERANDA
$qBeranda = mysqli_query($conn, "SELECT * FROM beranda ORDER BY id DESC LIMIT 1");
$beranda = mysqli_fetch_assoc($qBeranda);

// BERANDA
$qBeranda = mysqli_query($conn, "SELECT * FROM beranda ORDER BY id DESC LIMIT 1");
$beranda = mysqli_fetch_assoc($qBeranda);

// KONTAK
$qKontak = mysqli_query($conn, "SELECT * FROM kontak ORDER BY id DESC LIMIT 1");
$kontak = mysqli_fetch_assoc($qKontak);

// WAHANA POPULER
$qWahana = mysqli_query($conn, "
    SELECT * FROM wahana
    WHERE gambar IS NOT NULL
      AND gambar != ''
    ORDER BY id DESC
    LIMIT 4
");

// FASILITAS HOME
$qFasilitas = mysqli_query($conn, "
    SELECT * FROM fasilitas
    ORDER BY id ASC
    LIMIT 4
");

// BUNDLE TIKET
$qBundle = mysqli_query($conn, "
    SELECT * FROM promo
    WHERE status = 'Aktif'
      AND gambar IS NOT NULL
      AND gambar != ''
    ORDER BY id ASC
    LIMIT 3
");

// ULASAN
$qUlasan = mysqli_query($conn, "
    SELECT * FROM ulasan
    ORDER BY id DESC
    LIMIT 3
");

// TIKET RINGKAS
$qTiket = mysqli_query($conn, "
    SELECT * FROM tiket
    WHERE status = 'Aktif'
    ORDER BY harga ASC
    LIMIT 3
");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Samarinda Theme Park</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header class="navbar">
    <div class="container nav-wrap">
        <div class="logo-wrap">
            <div class="logo-circle">S</div>
            <div>
                <h2>Samarinda</h2>
                <p>Theme Park</p>
            </div>
        </div>

        <nav class="nav-menu">
            <a href="index.php" class="active">Home</a>
            <a href="wahana.php">Wahana</a>
            <a href="fasilitas.php">Fasilitas</a>
            <a href="tiket.php">Tiket</a>
            <a href="review.php">Review</a>
        </nav>

        <div class="nav-action">
            <a href="tiket.php" class="book-btn">Book Now</a>
        </div>
    </div>
</header>

<?php
$heroBg = !empty($beranda['hero_background']) ? $beranda['hero_background'] : 'hero.jpg';
?>

<section class="hero" style="background-image: url('assets/img/wahana/pemandangan.jpg');">
    <div class="hero-overlay">
        <div class="container hero-content">
            <div class="status-open">
                <span>• <?= !empty($beranda['status_now_open']) ? htmlspecialchars($beranda['status_now_open']) : 'Buka Sekarang'; ?></span>
            </div>

            <h1><?= !empty($beranda['hero_judul']) ? htmlspecialchars($beranda['hero_judul']) : 'Where Adventure Awaits'; ?></h1>
            <p>
                <?= !empty($beranda['hero_subtitle'])
                    ? htmlspecialchars($beranda['hero_subtitle'])
                    : 'Destinasi wisata bernuansa Jepang di Samarinda dengan wahana seru, tenant foodcourt, spot foto, dan dukungan bagi UMKM lokal.'; ?>
            </p>

            <div class="hero-buttons">
                <a href="tiket.php" class="btn-primary">Book Ticket</a>
                <a href="wahana.php" class="btn-secondary">Explore Wahana</a>
            </div>

            <div class="hero-stats">
                <div class="stat-box">
                    <h2><?= !empty($beranda['jumlah_atraksi']) ? htmlspecialchars($beranda['jumlah_atraksi']) : '12+'; ?></h2>
                    <span>Attractions</span>
                </div>
                <div class="stat-box">
                    <h2><?= !empty($beranda['pengunjung_per_tahun']) ? htmlspecialchars($beranda['pengunjung_per_tahun']) : '500K+'; ?></h2>
                    <span>Visitors Yearly</span>
                </div>
                <div class="stat-box">
                    <h2><?= !empty($beranda['rating']) ? htmlspecialchars($beranda['rating']) : '4.8'; ?></h2>
                    <span>Rating</span>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="info-bar">
    <div class="container info-bar-grid">
        <div class="info-bar-item">
            <h4>Jam Operasional</h4>
            <p>Setiap Hari: <?= !empty($beranda['jam_kerja']) ? htmlspecialchars($beranda['jam_kerja']) : '-'; ?></p>
        </div>

        <div class="info-bar-item">
            <h4>Lokasi</h4>
            <p><?= !empty($kontak['alamat']) ? htmlspecialchars($kontak['alamat']) : 'Alamat belum tersedia'; ?></p>
        </div>

        <div class="info-bar-item">
            <h4>Kontak Kami</h4>
            <p><?= !empty($kontak['telepon']) ? htmlspecialchars($kontak['telepon']) : '-'; ?></p>
            <p><?= !empty($kontak['email']) ? htmlspecialchars($kontak['email']) : '-'; ?></p>
        </div>
    </div>
</section>

<section class="section location-section">
    <div class="container">
        <div class="section-head">
            <div>
                <span class="section-tag">Lokasi</span>
                <h2>Kunjungi Samarinda Theme Park</h2>
                <p><?= !empty($kontak['alamat']) ? htmlspecialchars($kontak['alamat']) : '-'; ?></p>
            </div>
        </div>

        <div class="location-grid">
            <div class="location-map-card">
    <a href="https://www.google.com/maps/place/Samarinda+Theme+Park/@-0.453078,117.1914431,17.07z/data=!4m6!3m5!1s0x2df5d7915b176135:0xeae88b06a15d9a79!8m2!3d-0.4537853!4d117.1909065!16s%2Fg%2F11w8m65ssg?entry=ttu&g_ep=EgoyMDI2MDQxNS4wIKXMDSoASAFQAw%3D%3D" target="_blank">
        <img src="assets/img/wahana/lokasi.JPG" alt="Lokasi Samarinda Theme Park">
    </a>
</div>

            <div class="location-info-card">
                <h3>Alamat Lengkap</h3>
                <p><?= !empty($kontak['alamat']) ? htmlspecialchars($kontak['alamat']) : '-'; ?></p>

                <h3>Kontak</h3>
                <p>Telepon: <?= !empty($kontak['telepon']) ? htmlspecialchars($kontak['telepon']) : '-'; ?></p>
                <p>Email: <?= !empty($kontak['email']) ? htmlspecialchars($kontak['email']) : '-'; ?></p>
                <p>Instagram: <?= !empty($kontak['instagram']) ? htmlspecialchars($kontak['instagram']) : '-'; ?></p>

                <?php if (!empty($kontak['google_maps'])): ?>
                    <a href="<?= htmlspecialchars($kontak['google_maps']); ?>" target="_blank" class="outline-btn">
                        Buka di Google Maps
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-head">
            <div>
                <span class="section-tag">Jelajahi</span>
                <h2>Wahana Populer</h2>
                <p>Dari wahana seru keluarga hingga permainan yang memacu adrenalin, selalu ada pengalaman menarik untuk semua orang.</p>
            </div>
            <a href="wahana.php" class="outline-btn">Lihat Wahana</a>
        </div>

        <div class="card-grid">
            <?php if ($qWahana && mysqli_num_rows($qWahana) > 0): ?>
                <?php while ($wahana = mysqli_fetch_assoc($qWahana)): ?>
                    <?php
                    $gambarWahana = !empty($wahana['gambar']) ? $wahana['gambar'] : 'default.jpg';
                    $warnaLevel = 'level-normal';

                    if (isset($wahana['intensity'])) {
                        if ($wahana['intensity'] == 'Extreme') {
                            $warnaLevel = 'level-extreme';
                        } elseif ($wahana['intensity'] == 'Medium') {
                            $warnaLevel = 'level-medium';
                        } elseif ($wahana['intensity'] == 'High') {
                            $warnaLevel = 'level-high';
                        } elseif ($wahana['intensity'] == 'Low' || $wahana['intensity'] == 'Normal') {
                            $warnaLevel = 'level-low';
                        }
                    }
                    ?>
                    <div class="card">
                        <img src="assets/img/wahana/<?= htmlspecialchars($gambarWahana); ?>" 
                             alt="<?= !empty($wahana['nama_wahana']) ? htmlspecialchars($wahana['nama_wahana']) : 'Wahana'; ?>" 
                             class="card-img-top">

                        <div class="card-body">
                            <h3><?= !empty($wahana['nama_wahana']) ? htmlspecialchars($wahana['nama_wahana']) : '-'; ?></h3>
                            <p><?= !empty($wahana['deskripsi']) ? htmlspecialchars($wahana['deskripsi']) : '-'; ?></p>

                            <small>
                                <?= !empty($wahana['durasi']) ? htmlspecialchars($wahana['durasi']) : '0'; ?> menit •
                                <?= !empty($wahana['kapasitas']) ? htmlspecialchars($wahana['kapasitas']) : '0'; ?> orang
                            </small>

                            <?php if (!empty($wahana['intensity'])): ?>
                                <div class="badge-level <?= $warnaLevel; ?>">
                                    <?= htmlspecialchars($wahana['intensity']); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>Data wahana belum tersedia.</p>
            <?php endif; ?>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-head">
            <div>
                <span class="section-tag">Nyaman & Lengkap</span>
                <h2>Fasilitas Kami</h2>
                <p>Berbagai fasilitas pendukung tersedia untuk kenyamanan seluruh pengunjung.</p>
            </div>
            <a href="fasilitas.php" class="outline-btn">Lihat Fasilitas</a>
        </div>

        <div class="facility-grid">
            <?php if ($qFasilitas && mysqli_num_rows($qFasilitas) > 0): ?>
                <?php while ($fasilitas = mysqli_fetch_assoc($qFasilitas)): ?>
                    <div class="facility-card">
                        <h3><?= !empty($fasilitas['nama_fasilitas']) ? htmlspecialchars($fasilitas['nama_fasilitas']) : '-'; ?></h3>
                        <p><?= !empty($fasilitas['deskripsi']) ? htmlspecialchars($fasilitas['deskripsi']) : '-'; ?></p>
                        <span class="facility-meta"><?= !empty($fasilitas['lokasi']) ? htmlspecialchars($fasilitas['lokasi']) : '-'; ?></span>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>Data fasilitas belum tersedia.</p>
            <?php endif; ?>
        </div>
    </div>
</section>

<section class="section ticket-section">
    <div class="container">
        <div class="section-head">
            <div>
                <span class="section-tag">Harga Ringkas</span>
                <h2>Tiket Pilihan</h2>
                <p>Lihat beberapa pilihan tiket aktif yang tersedia saat ini.</p>
            </div>
            <a href="tiket.php" class="outline-btn">Lihat Semua Tiket</a>
        </div>

        <div class="ticket-home-grid">
            <?php if ($qTiket && mysqli_num_rows($qTiket) > 0): ?>
                <?php while ($tiket = mysqli_fetch_assoc($qTiket)): ?>
                    <div class="ticket-home-card">
                        <h3><?= !empty($tiket['nama_tiket']) ? htmlspecialchars($tiket['nama_tiket']) : '-'; ?></h3>
                        <p><?= !empty($tiket['deskripsi']) ? htmlspecialchars($tiket['deskripsi']) : '-'; ?></p>
                        <div class="ticket-price">
                            Rp <?= isset($tiket['harga']) ? number_format($tiket['harga'], 0, ',', '.') : '0'; ?>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>Data tiket belum tersedia.</p>
            <?php endif; ?>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-head">
            <div>
                <span class="section-tag">Lebih Hemat</span>
                <h2>Bundle Tiket Spesial</h2>
                <p>Pilih paket tiket hemat untuk menikmati lebih banyak wahana dengan harga yang lebih terjangkau.</p>
            </div>
            <a href="tiket.php" class="outline-btn">Lihat Semua Paket</a>
        </div>

        <div class="promo-grid">
            <?php if ($qBundle && mysqli_num_rows($qBundle) > 0): ?>
    <?php while ($bundle = mysqli_fetch_assoc($qBundle)): ?>
        
        <?php
        $gambarPromo = 'default-promo.jpg';

        if ($bundle['nama_promo'] == 'Promo Spesial Liburan Sekolah') {
            $gambarPromo = 'holiday-promo.jpg';
        } elseif ($bundle['nama_promo'] == 'Promo Ulang Tahun') {
            $gambarPromo = 'birthday-promo.jpg';
        } elseif ($bundle['nama_promo'] == 'Promo Early Bird (Pesan Lebih Awal)') {
            $gambarPromo = 'sakura-promo.jpg';
        }
        ?>

        <div class="promo-card">
            <div class="promo-thumb">
                <img src="assets/img/wahana/<?= htmlspecialchars($gambarPromo); ?>" alt="<?= htmlspecialchars($bundle['nama_promo']); ?>">

                <?php if (!empty($bundle['badge'])): ?>
                    <span class="promo-label"><?= htmlspecialchars($bundle['badge']); ?></span>
                <?php endif; ?>
            </div>

            <div class="promo-body">
                <h3><?= htmlspecialchars($bundle['nama_promo']); ?></h3>
                <p><?= htmlspecialchars($bundle['deskripsi']); ?></p>
                <div class="promo-meta">
                    <span>Berlaku hingga <?= htmlspecialchars($bundle['berlaku_sampai']); ?></span>
                    <span>Kode: <?= htmlspecialchars($bundle['kode']); ?></span>
                </div>
            </div>
        </div>

    <?php endwhile; ?>
<?php else: ?>
    <p>Data bundle tiket belum tersedia.</p>
<?php endif; ?>
</div>
    </div>
</section>

<section class="section testimonial-section">
    <div class="container">
        <div class="section-center">
            <span class="section-tag">Testimoni</span>
            <h2>Apa Kata Pengunjung Kami</h2>
            <p>Dengarkan pengalaman pengunjung yang telah merasakan keseruan di Samarinda Theme Park.</p>
        </div>

        <div class="testimonial-grid">
            <?php if ($qUlasan && mysqli_num_rows($qUlasan) > 0): ?>
                <?php while ($ulasan = mysqli_fetch_assoc($qUlasan)): ?>
                    <div class="testimonial-card">
                        <div class="stars">
                            <?= !empty($ulasan['rating']) ? str_repeat('⭐', (int)$ulasan['rating']) : '⭐'; ?>
                        </div>
                        <h3><?= !empty($ulasan['judul']) ? htmlspecialchars($ulasan['judul']) : 'Ulasan Pengunjung'; ?></h3>
                        <p><?= !empty($ulasan['komentar']) ? htmlspecialchars($ulasan['komentar']) : '-'; ?></p>
                        <div class="testimonial-user">
                            <strong><?= !empty($ulasan['nama_pengunjung']) ? htmlspecialchars($ulasan['nama_pengunjung']) : 'Anonim'; ?></strong>
                            <span><?= !empty($ulasan['tipe_kunjungan']) ? htmlspecialchars($ulasan['tipe_kunjungan']) : '-'; ?></span>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>Data ulasan belum tersedia.</p>
            <?php endif; ?>
        </div>
    </div>
</section>

<section class="cta-section">
    <div class="container cta-box">
        <h2>Siap untuk Petualanganmu?</h2>
        <p><?= !empty($beranda['cta_text']) ? htmlspecialchars($beranda['cta_text']) : 'Pesan tiketmu sekarang dan rasakan keseruan di Samarinda Theme Park.'; ?></p>

        <div class="cta-buttons">
            <a href="tiket.php" class="white-btn">Pesan Tiket Sekarang</a>
            <a href="wahana.php" class="white-btn">Lihat Wahana</a>
        </div>

        <p class="cta-contact">
            Atau hubungi kami di <?= !empty($kontak['telepon']) ? htmlspecialchars($kontak['telepon']) : '-'; ?> untuk pemesanan grup dan informasi lebih lanjut
        </p>
    </div>
</section>

<footer class="footer">
    <div class="container footer-grid">
        <div>
            <div class="logo-wrap footer-logo">
                <div class="logo-circle">S</div>
                <div>
                    <h3>Samarinda</h3>
                    <p>Theme Park</p>
                </div>
            </div>
            <p>Destinasi wisata bernuansa Jepang di Samarinda dengan wahana, spot foto, tenant foodcourt, merchandise, dan dukungan UMKM lokal.</p>
        </div>

        <div>
            <h4>Tautan Cepat</h4>
            <ul class="footer-links">
                <li><a href="wahana.php">Wahana</a></li>
                <li><a href="fasilitas.php">Fasilitas</a></li>
                <li><a href="tiket.php">Tiket & Harga</a></li>
                <li><a href="review.php">Ulasan</a></li>
            </ul>
        </div>

        <div>
            <h4>Hubungi Kami</h4>
            <p><?= !empty($kontak['alamat']) ? htmlspecialchars($kontak['alamat']) : '-'; ?></p>
            <p><?= !empty($kontak['telepon']) ? htmlspecialchars($kontak['telepon']) : '-'; ?></p>
            <p><?= !empty($kontak['email']) ? htmlspecialchars($kontak['email']) : '-'; ?></p>
        </div>

        <div>
            <h4>Jam Operasional</h4>
            <p>Setiap Hari<br><?= !empty($beranda['jam_kerja']) ? htmlspecialchars($beranda['jam_kerja']) : '-'; ?></p>
        </div>
    </div>

    <div class="container footer-bottom">
        <p>© 2026 Samarinda Theme Park. All rights reserved.</p>
    </div>
</footer>

<?php include 'partials/footer.php'; ?>