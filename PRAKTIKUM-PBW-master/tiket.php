<?php
require 'config/koneksi.php';
date_default_timezone_set('Asia/Makassar');

// LINK PEMESANAN
$travelokaLink = "https://www.traveloka.com/en-id/activities/indonesia/product/samarinda-theme-park-6083097719891";
$waLink = "https://api.whatsapp.com/send/?phone=6282156064199&text&type=phone_number&app_absent=0&utm_source=ig";

// TIKET MASUK + TIKET UTAMA
$qTiketUtama = mysqli_query($conn, "
    SELECT * FROM tiket
    WHERE status = 'Aktif'
      AND (
        nama_tiket LIKE '%Tiket Masuk%'
        OR nama_tiket LIKE '%Show World%'
        OR nama_tiket LIKE '%Sewa Jaket%'
        OR nama_tiket LIKE '%VIP Pass%'
      )
    ORDER BY harga ASC
");

// TIKET WAHANA
$qTiketWahana = mysqli_query($conn, "
    SELECT * FROM tiket
    WHERE status = 'Aktif'
      AND nama_tiket NOT LIKE '%Tiket Masuk%'
      AND nama_tiket NOT LIKE '%Show World%'
      AND nama_tiket NOT LIKE '%Sewa Jaket%'
      AND nama_tiket NOT LIKE '%VIP Pass%'
    ORDER BY harga ASC, nama_tiket ASC
");

// PROMO / BUNDLE
$qBundle = mysqli_query($conn, "
    SELECT * FROM promo
    WHERE status = 'Aktif'
    ORDER BY id ASC
");

// KEUNGGULAN
$keunggulanList = array(
    array(
        'icon' => '🎟️',
        'judul' => 'Booking Lebih Praktis',
        'deskripsi' => 'Pesan tiket lebih cepat tanpa harus antre lama di lokasi.'
    ),
    array(
        'icon' => '💬',
        'judul' => 'Bisa Tanya Admin Langsung',
        'deskripsi' => 'Kalau bingung soal harga, paket, atau reservasi grup, tinggal chat WhatsApp.'
    ),
    array(
        'icon' => '🎉',
        'judul' => 'Cocok untuk Liburan & Rombongan',
        'deskripsi' => 'Mudah dipakai untuk keluarga, teman, sekolah, maupun acara komunitas.'
    )
);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tiket - Samarinda Theme Park</title>
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
            <a href="tiket.php" class="active">Tiket</a>
            <a href="ulasan.php">Ulasan</a>
        </div>

        <div class="nav-right">
            <span class="search-icon">&#128269;</span>
            <a href="tiket.php" class="book-btn">Book Now</a>
        </div>
    </div>
</nav>

<section class="hero hero-small" style="background-image: url('assets/img/tiket-hero.jpg');">
    <div class="hero-overlay"></div>
    <div class="container hero-content">
        <h2>Tiket & Harga</h2>
        <p>Pilih tiket yang paling pas untuk petualanganmu. Tersedia tiket masuk, tiket wahana, tiket spesial, dan bundle promo.</p>
    </div>
</section>

<section class="ticket-section">
    <div class="container">
        <div class="section-head">
            <div>
                <span class="section-tag">Tiket Masuk</span>
                <h2>Pilihan Tiket Utama</h2>
                <p>Pilih jenis tiket sesuai hari kunjungan dan kebutuhan bermainmu di Samarinda Theme Park.</p>
            </div>
        </div>

        <div class="ticket-grid">
            <?php if ($qTiketUtama && mysqli_num_rows($qTiketUtama) > 0): ?>
                <?php while ($tiket = mysqli_fetch_assoc($qTiketUtama)): ?>
                    <div class="ticket-card">
                        <h3><?= htmlspecialchars($tiket['nama_tiket']); ?></h3>
                        <p class="ticket-sub"><?= htmlspecialchars($tiket['deskripsi']); ?></p>

                        <div class="price">
                            Rp <?= number_format($tiket['harga'], 0, ',', '.'); ?>
                        </div>

                        <div class="ticket-actions">
                            <a href="<?= $travelokaLink; ?>" target="_blank" class="ticket-btn">Traveloka ↗</a>
                            <a href="<?= $waLink; ?>" target="_blank" class="ticket-btn">WhatsApp ↗</a>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>Data tiket utama belum tersedia.</p>
            <?php endif; ?>
        </div>
    </div>
</section>

<section class="ticket-section">
    <div class="container">
        <div class="section-head">
            <div>
                <span class="section-tag">Tiket Wahana</span>
                <h2>Harga Wahana Satuan</h2>
                <p>Harga tiket masing-masing wahana sesuai informasi terbaru dari pengelola.</p>
            </div>
        </div>

        <div class="ticket-home-grid">
            <?php if ($qTiketWahana && mysqli_num_rows($qTiketWahana) > 0): ?>
                <?php while ($item = mysqli_fetch_assoc($qTiketWahana)): ?>
                    <div class="ticket-home-card">
                        <h3><?= htmlspecialchars($item['nama_tiket']); ?></h3>
                        <p><?= htmlspecialchars($item['deskripsi']); ?></p>
                        <div class="ticket-price">Rp <?= number_format($item['harga'], 0, ',', '.'); ?></div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>Data tiket wahana belum tersedia.</p>
            <?php endif; ?>
        </div>
    </div>
</section>

<section class="ticket-section">
    <div class="container">
        <div class="section-head">
            <div>
                <span class="section-tag">Bundle Promo</span>
                <h2>Paket Tiket Spesial</h2>
                <p>Bundle tiket lebih hemat untuk menikmati beberapa wahana sekaligus.</p>
            </div>
        </div>

        <div class="promo-grid">
            <?php if ($qBundle && mysqli_num_rows($qBundle) > 0): ?>
                <?php while ($promo = mysqli_fetch_assoc($qBundle)): ?>
                    <div class="promo-card">
                        <div class="promo-thumb">
                            <img src="assets/img/<?= !empty($promo['gambar']) ? htmlspecialchars($promo['gambar']) : 'default-promo.jpg'; ?>" alt="<?= htmlspecialchars($promo['nama_promo']); ?>">
                            <span class="promo-label"><?= htmlspecialchars($promo['badge']); ?></span>
                        </div>
                        <div class="promo-body">
                            <h3><?= htmlspecialchars($promo['nama_promo']); ?></h3>
                            <p><?= htmlspecialchars($promo['deskripsi']); ?></p>
                            <div class="promo-meta">
                                <span>Berlaku hingga <?= htmlspecialchars($promo['berlaku_sampai']); ?></span>
                                <span>Kode: <?= !empty($promo['kode']) ? htmlspecialchars($promo['kode']) : '-'; ?></span>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>Data bundle promo belum tersedia.</p>
            <?php endif; ?>
        </div>
    </div>
</section>

<section class="ticket-highlight-section">
    <div class="container">
        <div class="section-head">
            <div>
                <span class="section-tag">Kenapa Pesan Online?</span>
                <h2>Lebih Mudah & Lebih Fleksibel</h2>
                <p>Nikmati proses pemesanan yang lebih praktis untuk kunjungan pribadi, keluarga, maupun reservasi grup.</p>
            </div>
        </div>

        <div class="ticket-highlight-grid">
            <?php foreach ($keunggulanList as $item) : ?>
                <div class="ticket-highlight-card">
                    <div class="ticket-highlight-icon"><?= $item['icon']; ?></div>
                    <h3><?= htmlspecialchars($item['judul']); ?></h3>
                    <p><?= htmlspecialchars($item['deskripsi']); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="partner-section">
    <div class="container">
        <h2>Tempat Pemesanan</h2>
        <p>Beli tiket melalui mitra pemesanan resmi kami untuk pengalaman yang aman dan praktis.</p>

        <div class="partner-grid">
            <a href="<?= $travelokaLink; ?>" target="_blank" class="partner-card">
                <div class="partner-logo">✈</div>
                <h4>Traveloka</h4>
                <p>Pemesanan online melalui Traveloka</p>
            </a>

            <a href="<?= $waLink; ?>" target="_blank" class="partner-card">
                <div class="partner-logo">🟢</div>
                <h4>WhatsApp</h4>
                <p>Hubungi admin untuk pemesanan langsung</p>
            </a>
        </div>

        <div class="info-panels">
            <div class="info-box">
                <h3>❗ Informasi Tiket</h3>
                <ul>
                    <li>Tiket masuk dan tiket wahana dapat dibeli sesuai kebutuhan kunjungan.</li>
                    <li>Anak-anak disarankan tetap didampingi orang tua saat menikmati wahana.</li>
                    <li>Harga dapat berubah sewaktu-waktu mengikuti kebijakan pengelola.</li>
                    <li>Untuk rombongan atau reservasi khusus, silakan hubungi admin melalui WhatsApp.</li>
                    <li>Simpan bukti pemesanan saat membeli secara online.</li>
                </ul>
            </div>

            <div class="group-box">
                <h3>📞 Pemesanan Grup / Reservasi</h3>
                <p>Untuk reservasi grup, kerja sama event, atau pertanyaan harga terbaru, hubungi admin kami langsung.</p>
                <p>WhatsApp: 0821-5606-4199</p>
                <p style="margin-top: 12px;">
                    <a href="<?= $waLink; ?>" target="_blank" style="color:#fff; text-decoration:underline;">
                        Chat via WhatsApp ↗
                    </a>
                </p>
            </div>
        </div>
    </div>
</section>

</body>
</html>