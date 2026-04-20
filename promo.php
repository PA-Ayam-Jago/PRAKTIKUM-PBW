<?php
date_default_timezone_set('Asia/Makassar');

$travelokaLink = "https://www.traveloka.com/en-id/activities/indonesia/product/samarinda-theme-park-6083097719891";
$waLink = "https://api.whatsapp.com/send/?phone=6282156064199&text&type=phone_number&app_absent=0&utm_source=ig";

$promoList = array(
    array(
        'judul' => 'Spesial Libur Sekolah',
        'badge' => 'DISKON 30%',
        'deskripsi' => 'Nikmati diskon 30% untuk semua tiket selama periode libur sekolah!',
        'kode' => 'HOLIDAY30',
        'berlaku' => 'Berlaku hingga 31 Juli 2026',
        'syarat' => array(
            'Hanya berlaku selama periode libur sekolah.',
            'Tidak dapat digabungkan dengan promo lainnya.',
            'Wajib melakukan pemesanan secara online.'
        ),
        'gambar' => 'Promosi.jpg',
        'link' => $travelokaLink
    ),
    array(
        'judul' => 'Pesta Ulang Tahun',
        'badge' => 'GRATIS MASUK',
        'deskripsi' => 'Gratis biaya masuk di hari ulang tahunmu! Cukup tunjukkan kartu identitasmu di pintu masuk.',
        'kode' => '',
        'berlaku' => 'Berlaku hingga 31 Juli 2026',
        'syarat' => array(
            'Wajib menunjukkan kartu identitas yang valid.',
            'Hanya berlaku untuk orang yang berulang tahun.',
            'Wajib didampingi minimal 1 pendamping.'
        ),
        'gambar' => 'Promosi.jpg',
        'link' => $waLink
    ),
    array(
        'judul' => 'Diskon Pesan Lebih Awal',
        'badge' => 'DISKON 20%',
        'deskripsi' => 'Pesan tiketmu 7 hari sebelumnya dan dapatkan potongan 20%!',
        'kode' => 'EARLYBIRD20',
        'berlaku' => 'Berlaku hingga 31 Desember 2026',
        'syarat' => array(
            'Pemesanan dilakukan minimal 7 hari sebelum tanggal kunjungan.',
            'Tiket tidak dapat digabungkan dengan promo lain.',
            'Tanggal kunjungan tidak dapat diubah.'
        ),
        'gambar' => 'Promosi.jpg',
        'link' => $travelokaLink
    ),
    array(
        'judul' => 'Diskon Grup/Rombongan',
        'badge' => 'DISKON HINGGA 40%',
        'deskripsi' => 'Grup berisi 10 orang atau lebih mendapatkan harga khusus! Sangat cocok untuk sekolah dan organisasi.',
        'kode' => '',
        'berlaku' => 'Berlaku hingga 31 Desember 2026',
        'syarat' => array(
            'Minimal 10 orang.',
            'Wajib melakukan pemesanan di awal (reservasi).',
            'Hubungi tim penjualan untuk penawaran khusus.'
        ),
        'gambar' => 'Promosi.jpg',
        'link' => $waLink
    )
);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Promosi - Samarinda Theme Park</title>
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
            <a href="promo.php" class="active">Promosi</a>
            <a href="review.php">Review</a>
        </div>

        <div class="nav-right">
            <span class="search-icon">&#128269;</span>
            <a href="tiket.php" class="book-btn">Book Now</a>
        </div>
    </div>
</nav>

<section class="promo-hero">
    <div class="container">
        <div class="hero-tag">🏷️ Penawaran Terbatas</div>
        <h2>Promosi & Penawaran Menarik</h2>
        <p>
            Manfaatkan penawaran spesial kami dan nikmati keseruan
            lebih dengan harga lebih hemat. Jangan sampai terlewatkan!
        </p>
    </div>
</section>

<section class="promo-section">
    <div class="container">
        <div class="promo-grid">
            <?php foreach ($promoList as $promo) : ?>
                <div class="promo-card">
                    <div class="promo-image-wrap">
                        <img src="<?php echo htmlspecialchars($promo['gambar']); ?>" alt="<?php echo htmlspecialchars($promo['judul']); ?>">
                        <div class="promo-badge"><?php echo htmlspecialchars($promo['badge']); ?></div>
                    </div>

                    <div class="promo-content">
                        <h3 class="promo-title"><?php echo htmlspecialchars($promo['judul']); ?></h3>
                        <p class="promo-desc"><?php echo htmlspecialchars($promo['deskripsi']); ?></p>

                        <?php if (!empty($promo['kode'])) : ?>
                            <div class="promo-code-box">
                                <div>
                                    <div class="promo-code-label">Gunakan kode promo:</div>
                                    <div class="promo-code"><?php echo htmlspecialchars($promo['kode']); ?></div>
                                </div>
                                <div class="copy-text">📋 Salin</div>
                            </div>
                        <?php endif; ?>

                        <p class="berlaku"><?php echo htmlspecialchars($promo['berlaku']); ?></p>
                        <div class="divider"></div>

                        <div class="syarat-title">Syarat & Ketentuan:</div>
                        <ul class="syarat-list">
                            <?php foreach ($promo['syarat'] as $syarat) : ?>
                                <li><?php echo htmlspecialchars($syarat); ?></li>
                            <?php endforeach; ?>
                        </ul>

                        <a href="<?php echo $promo['link']; ?>" target="_blank" class="pesan-btn">Pesan Sekarang ↗</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="promo-cta-section">
    <div class="container">
        <div class="promo-cta-icon">!</div>
        <h3>Jangan Lewatkan Penawaran Menarik</h3>
        <p>
            Ikuti kami di media sosial atau hubungi kami untuk menjadi yang pertama mengetahui
            promosi mendatang dan penawaran eksklusif!
        </p>

        <div class="promo-cta-buttons">
            <a href="tiket.php" class="btn-main">Lihat Harga Tiket</a>
            <a href="<?php echo $waLink; ?>" target="_blank" class="btn-outline">Kontak Kami</a>
        </div>
    </div>
</section>

<?php include 'partials/footer.php'; ?>