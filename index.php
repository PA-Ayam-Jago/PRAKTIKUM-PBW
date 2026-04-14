<?php
$wahanaPopuler = [
    [
        'nama' => 'Bianglala',
        'deskripsi' => 'Nikmati momen magis saat senja merona di cakrawala. Dari ketinggian, pengunjung dapat menikmati panorama taman yang memukau.',
        'durasi' => '3 menit',
        'kapasitas' => '24 orang',
        'level' => 'Extreme',
        'gambar' => 'Wahana.jpg',
        'warna_level' => 'level-extreme'
    ],
    [
        'nama' => 'Duck Boat',
        'deskripsi' => 'Nikmati momen magis saat senja merona di cakrawala. Dari ketinggian, pengunjung dapat menikmati panorama taman yang memukau.',
        'durasi' => '8 menit',
        'kapasitas' => '16 orang',
        'level' => 'Medium',
        'gambar' => 'Wahana air.jpg',
        'warna_level' => 'level-medium'
    ],
    [
        'nama' => 'Monorail',
        'deskripsi' => 'Nikmati momen magis saat senja merona di cakrawala. Dari ketinggian, pengunjung dapat menikmati panorama taman yang memukau.',
        'durasi' => '8 menit',
        'kapasitas' => '20 orang',
        'level' => 'Extreme',
        'gambar' => 'hiburan keluarga.jpg',
        'warna_level' => 'level-extreme'
    ],
    [
        'nama' => 'Snow Rail',
        'deskripsi' => 'Nikmati momen magis saat senja merona di cakrawala. Dari ketinggian, pengunjung dapat menikmati panorama taman yang memukau.',
        'durasi' => '8 menit',
        'kapasitas' => '8 orang',
        'level' => 'Normal',
        'gambar' => 'Zona anak.jpg',
        'warna_level' => 'level-normal'
    ]
];

$promoList = [
    [
        'judul' => 'Promo Spesial Liburan Sekolah',
        'deskripsi' => 'Nikmati diskon 30% untuk semua jenis tiket selama periode liburan sekolah!',
        'label' => 'DISKON 30%',
        'gambar' => 'Promosi.jpg',
        'tanggal' => 'Berlaku hingga 31 Juli 2026',
        'kode' => 'HOLIDAY30'
    ],
    [
        'judul' => 'Promo Ulang Tahun',
        'deskripsi' => 'Gratis tiket masuk tepat di hari ulang tahunmu! Cukup tunjukkan identitas di pintu masuk.',
        'label' => 'GRATIS MASUK',
        'gambar' => 'Home (dashboard).jpg',
        'tanggal' => 'Berlaku hingga 31 Juli 2026',
        'kode' => '-'
    ],
    [
        'judul' => 'Promo Early Bird (Pesan Lebih Awal)',
        'deskripsi' => 'Pesan tiketmu 7 hari sebelum kedatangan dan dapatkan diskon 20%!',
        'label' => 'DISKON 20%',
        'gambar' => 'Promosi.jpg',
        'tanggal' => 'Berlaku hingga 31 Juli 2026',
        'kode' => 'EARLYBIRD20'
    ]
];

$testimoniList = [
    [
        'nama' => 'Dewi Lestari',
        'kategori' => 'Kunjungan Keluarga',
        'inisial' => 'D',
        'isi' => 'Hari keluarga yang luar biasa! Kami sekeluarga sangat menikmati waktu di Samarinda Theme Park! Anak-anak sangat senang naik Thunder Coaster dan kami sekeluarga suka sekali.'
    ],
    [
        'nama' => 'Budi Santoso',
        'kategori' => 'Kunjungan Bersama Teman',
        'inisial' => 'B',
        'isi' => 'Wahana bagus, pilihan makanan bisa dinikmati. Wahana-wahananya sangat fantastis, terutama Dragon Flight — pengalaman yang luar biasa! Satu-satunya kekurangannya adalah terbatasnya pilihan makanan untuk vegetarian.'
    ],
    [
        'nama' => 'Siti Rahmawati',
        'kategori' => 'Kunjungan Pasangan',
        'inisial' => 'S',
        'isi' => 'Sempurna bagi pencinta adrenalin. Kalau kamu suka adrenalin, di sinilah tempatnya! Thunder Coaster benar-benar gila dan Dragon Flight membuatku merasa seperti sedang terbang sungguhan.'
    ]
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Samarinda Theme Park</title>
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
                <a href="index.php" class="active">Home</a>
                <a href="wahana.php">Wahana</a>
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
            <div class="status-badge">● Now open: Bianglala</div>

            <h2>
                Where Adventure <br>
                <span>Awaits</span>
            </h2>

            <p>
                Nikmati wahana seru, atraksi menarik, dan momen tak terlupakan
                di taman hiburan terbaik di Samarinda.
            </p>

            <div class="hero-buttons">
                <a href="tiket.php" class="btn-primary">Book Ticket</a>
                <a href="wahana.php" class="btn-secondary">Eksplor Wahana →</a>
            </div>

            <div class="hero-stats">
                <div class="stat-item">
                    <h3>20+</h3>
                    <span>Attractions</span>
                </div>
                <div class="stat-item">
                    <h3>500K+</h3>
                    <span>Visitors Yearly</span>
                </div>
                <div class="stat-item">
                    <h3>4.8</h3>
                    <span>Rating</span>
                </div>
            </div>
        </div>
    </section>

    <section class="info-strip">
        <div class="container info-grid">
            <div class="info-box">
                <div class="info-icon">🕘</div>
                <div>
                    <h4>Jam Operasional</h4>
                    <p>Hari Kerja: 10:00 AM - 20:00 PM</p>
                    <p>Akhir Pekan: 09:00 AM - 22:00 PM</p>
                </div>
            </div>

            <div class="info-box">
                <div class="info-icon">📍</div>
                <div>
                    <h4>Lokasi</h4>
                    <p>Jl. DI Panjaitan, Lempake, Kec. Samarinda Utara,</p>
                    <p>Kota Samarinda, Kalimantan Timur</p>
                </div>
            </div>

            <div class="info-box">
                <div class="info-icon">📞</div>
                <div>
                    <h4>Kontak Kami</h4>
                    <p>0821-5606-4199</p>
                    <p>info@samarindathemepark.com</p>
                </div>
            </div>
        </div>
    </section>

    <section class="section-block">
        <div class="container">
            <div class="section-head">
                <div>
                    <span class="section-tag">Jelajahi</span>
                    <h2>Wahana Populer</h2>
                    <p>
                        Dari wahana ekstrem yang memacu adrenalin hingga petualangan
                        ramah keluarga, selalu ada sesuatu yang seru untuk semua orang.
                    </p>
                </div>

                <a href="wahana.php" class="section-button">Lihat Wahana →</a>
            </div>

            <div class="card-grid four-cols">
                <?php foreach ($wahanaPopuler as $wahana): ?>
                    <div class="card card-wahana">
                        <div class="card-image">
                            <img src="<?= htmlspecialchars($wahana['gambar']); ?>" alt="<?= htmlspecialchars($wahana['nama']); ?>">
                        </div>

                        <div class="card-body">
                            <h3><?= htmlspecialchars($wahana['nama']); ?></h3>
                            <p><?= htmlspecialchars($wahana['deskripsi']); ?></p>

                            <div class="card-meta">
                                <span>🕒 <?= htmlspecialchars($wahana['durasi']); ?></span>
                                <span>👥 <?= htmlspecialchars($wahana['kapasitas']); ?></span>
                            </div>

                            <div class="level-pill <?= htmlspecialchars($wahana['warna_level']); ?>">
                                ⚡ <?= htmlspecialchars($wahana['level']); ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="section-block">
        <div class="container">
            <div class="section-head">
                <div>
                    <span class="section-tag">Lebih Hemat</span>
                    <h2>Promosi Saat Ini</h2>
                    <p>
                        Manfaatkan penawaran spesial kami dan nikmati keseruan
                        lebih dengan harga lebih terjangkau.
                    </p>
                </div>

                <a href="promo.php" class="section-button">Semua Promosi →</a>
            </div>

            <div class="card-grid three-cols">
                <?php foreach ($promoList as $promo): ?>
                    <div class="card card-promo">
                        <div class="promo-thumb">
                            <img src="<?= htmlspecialchars($promo['gambar']); ?>" alt="<?= htmlspecialchars($promo['judul']); ?>">
                            <span class="promo-label"><?= htmlspecialchars($promo['label']); ?></span>
                        </div>

                        <div class="card-body">
                            <h3><?= htmlspecialchars($promo['judul']); ?></h3>
                            <p><?= htmlspecialchars($promo['deskripsi']); ?></p>

                            <div class="promo-footer">
                                <span>🗓 <?= htmlspecialchars($promo['tanggal']); ?></span>
                                <span>Kode Promo: <?= htmlspecialchars($promo['kode']); ?></span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="testimoni-section">
        <div class="container">
            <div class="testimoni-head">
                <span class="section-tag center">Testimoni</span>
                <h2>Apa Kata Pengunjung Kami</h2>
                <p>
                    Dengarkan pengalaman ribuan pengunjung bahagia yang telah merasakan
                    keajaiban di Samarinda Theme Park.
                </p>
            </div>

            <div class="card-grid three-cols">
                <?php foreach ($testimoniList as $testimoni): ?>
                    <div class="card testimonial-card">
                        <div class="stars">★★★★★</div>
                        <div class="quote-mark">”</div>

                        <h3><?= htmlspecialchars($testimoni['isi']); ?></h3>

                        <div class="testimonial-user">
                            <div class="avatar"><?= htmlspecialchars($testimoni['inisial']); ?></div>
                            <div>
                                <strong><?= htmlspecialchars($testimoni['nama']); ?></strong>
                                <span><?= htmlspecialchars($testimoni['kategori']); ?></span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="center-button-wrap">
                <a href="review.php" class="section-button">Semua Ulasan →</a>
            </div>
        </div>
    </section>

    <section class="cta-banner">
        <div class="container cta-content">
            <h2>Siap untuk Petualanganmu?</h2>
            <p>
                Pesan tiketmu sekarang dan rasakan keseruan di Samarinda Theme Park.
                Diskon khusus tersedia untuk pemesanan online!
            </p>

            <div class="cta-buttons">
                <a href="https://www.traveloka.com/" target="_blank" class="cta-btn light">🎫 Pesan via Traveloka</a>
                <a href="https://www.tiket.com/" target="_blank" class="cta-btn light">🎫 Pesan via Tiket.com</a>
            </div>

            <span class="cta-note">
                Atau hubungi kami di 0821-5606-4199 untuk pemesanan grup dan informasi lebih lanjut
            </span>
        </div>
    </section>

    <footer class="footer">
        <div class="container footer-top">
            <div class="footer-brand">
                <div class="brand">
                    <div class="logo-circle small">S</div>
                    <div class="brand-text footer-brand-text">
                        <h1>Samarinda</h1>
                        <p>Theme Park</p>
                    </div>
                </div>

                <p>
                    Rasakan petualangan seru dan ciptakan kenangan tak terlupakan
                    di destinasi taman hiburan di Samarinda.
                </p>
            </div>

            <div class="footer-links">
                <h4>Tautan Cepat</h4>
                <a href="wahana.php">Wahana</a>
                <a href="fasilitas.php">Fasilitas</a>
                <a href="tiket.php">Tiket & Harga</a>
                <a href="promo.php">Promosi</a>
                <a href="review.php">Ulasan</a>
            </div>

            <div class="footer-contact">
                <h4>Hubungi Kami</h4>
                <p>Jl. Wahid Hasyim II, Samarinda,</p>
                <p>Kalimantan Timur 75124, Indonesia</p>
                <p>+62 541 123 4567</p>
                <p>info@samarindathemepark.com</p>
            </div>

            <div class="footer-hours">
                <h4>Jam Operasional</h4>
                <p>Senin - Jumat</p>
                <p>10:00 - 20:00 WITA</p>
                <p>Akhir Pekan & Hari Libur</p>
                <p>09:00 - 22:00 WITA</p>
            </div>
        </div>

        <div class="container footer-bottom">
            <p>© 2026 Samarinda Theme Park. All rights reserved.</p>
            <div class="footer-policy">
                <a href="#">Privacy Policy</a>
                <a href="#">Terms of Service</a>
            </div>
        </div>
    </footer>

</body>
</html>