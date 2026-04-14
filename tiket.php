<?php
$tiketMasuk = array(
    array(
        'nama' => 'Tiket Masuk Senin - Kamis',
        'sub' => 'Berlaku untuk kunjungan hari kerja',
        'harga' => 'Rp 20.000 / orang',
        'fitur' => array(
            'Berlaku Senin sampai Kamis',
            'Tiket masuk area Samarinda Theme Park',
            'Belum termasuk tiket wahana',
            'Cocok untuk kunjungan hemat'
        )
    ),
    array(
        'nama' => 'Tiket Masuk Jum\'at - Minggu & Hari Besar',
        'sub' => 'Berlaku untuk weekend dan hari libur',
        'harga' => 'Rp 30.000 / orang',
        'fitur' => array(
            'Berlaku Jumat sampai Minggu',
            'Berlaku saat hari besar/libur',
            'Tiket masuk area Samarinda Theme Park',
            'Belum termasuk tiket wahana'
        )
    ),
    array(
        'nama' => 'Show World',
        'sub' => 'Wahana spesial bertema salju',
        'harga' => 'Rp 80.000 - Rp 100.000',
        'fitur' => array(
            'Senin - Kamis: Rp 80.000',
            'Jum\'at - Minggu & Hari Besar: Rp 100.000',
            'Sewa jaket & boot: Rp 20.000',
            'Pengalaman wahana indoor bertema salju'
        )
    ),
    array(
        'nama' => 'VIP Pass',
        'sub' => 'Free access all rides',
        'harga' => 'Rp 500.000 / orang',
        'fitur' => array(
            'Akses semua wahana',
            'Lebih praktis tanpa beli satuan',
            'Cocok untuk pengunjung yang ingin full bermain',
            'Pilihan terbaik untuk eksplor banyak wahana'
        )
    )
);

$travelokaLink = "https://www.traveloka.com/en-id/activities/indonesia/product/samarinda-theme-park-6083097719891";
$waLink = "https://api.whatsapp.com/send/?phone=6282156064199&text&type=phone_number&app_absent=0&utm_source=ig";

$partnerList = array(
    array(
        'nama' => 'Traveloka',
        'sub' => 'Pemesanan online melalui Traveloka',
        'logo' => '✈',
        'link' => $travelokaLink
    ),
    array(
        'nama' => 'WhatsApp',
        'sub' => 'Hubungi admin untuk pemesanan langsung',
        'logo' => '🟢',
        'link' => $waLink
    )
);

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
            <a href="promo.php">Promosi</a>
            <a href="review.php">Review</a>
        </div>

        <div class="nav-right">
            <span class="search-icon">&#128269;</span>
            <a href="tiket.php" class="book-btn">Book Now</a>
        </div>
    </div>
</nav>

<section class="hero hero-small" style="background-image: url('Tiket.jpg');">
    <div class="hero-overlay"></div>
    <div class="container hero-content">
        <h2>Tiket & Harga</h2>
        <p>Pilih tiket yang paling pas untuk petualanganmu. Pesan secara online atau melalui WhatsApp untuk mendapatkan informasi lebih lanjut.</p>
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
            <?php foreach ($tiketMasuk as $tiket) : ?>
                <div class="ticket-card">
                    <h3><?php echo htmlspecialchars($tiket['nama']); ?></h3>
                    <p class="ticket-sub"><?php echo htmlspecialchars($tiket['sub']); ?></p>

                    <div class="price"><?php echo htmlspecialchars($tiket['harga']); ?></div>

                    <ul class="ticket-list">
                        <?php foreach ($tiket['fitur'] as $fitur) : ?>
                            <li><span>●</span><span><?php echo htmlspecialchars($fitur); ?></span></li>
                        <?php endforeach; ?>
                    </ul>

                    <div class="ticket-actions">
                        <a href="<?php echo $travelokaLink; ?>" target="_blank" class="ticket-btn">Traveloka ↗</a>
                        <a href="<?php echo $waLink; ?>" target="_blank" class="ticket-btn">WhatsApp ↗</a>
                    </div>
                </div>
            <?php endforeach; ?>
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
                    <div class="ticket-highlight-icon"><?php echo $item['icon']; ?></div>
                    <h3><?php echo htmlspecialchars($item['judul']); ?></h3>
                    <p><?php echo htmlspecialchars($item['deskripsi']); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="partner-section">
    <div class="container">
        <h2>Tempat Pemesanan</h2>
        <p>Beli tiket Anda melalui mitra pemesanan resmi kami untuk pengalaman yang aman dan bebas kendala.</p>

        <div class="partner-grid">
            <?php foreach ($partnerList as $partner) : ?>
                <a href="<?php echo $partner['link']; ?>" target="_blank" class="partner-card">
                    <div class="partner-logo"><?php echo $partner['logo']; ?></div>
                    <h4><?php echo htmlspecialchars($partner['nama']); ?></h4>
                    <p><?php echo htmlspecialchars($partner['sub']); ?></p>
                </a>
            <?php endforeach; ?>
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
                    <a href="<?php echo $waLink; ?>" target="_blank" style="color:#fff; text-decoration:underline;">
                        Chat via WhatsApp ↗
                    </a>
                </p>
            </div>
        </div>
    </div>
</section>

</body>
</html>