<?php
require 'config/koneksi.php';
date_default_timezone_set('Asia/Makassar');

// LINK PEMESANAN
$travelokaLink = "https://www.traveloka.com/";
$waLink = "https://api.whatsapp.com/send/?phone=6282156064199&text&type=phone_number&app_absent=0";

// TIKET MASUK + TIKET UTAMA
$tiketUtama = mysqli_query($conn, "
    SELECT * FROM tiket 
    WHERE status = 'Aktif'
    ORDER BY harga ASC, id ASC
");

// PROMO / BUNDLE
$promo = mysqli_query($conn, "
    SELECT * FROM promo
    WHERE status = 'Aktif'
    ORDER BY id ASC
");

// KEUNGGULAN
$keunggulanList = [
    [
        'icon' => '🎫',
        'judul' => 'Booking Lebih Praktis',
        'deskripsi' => 'Pesan tiket lebih cepat tanpa harus antre lama di lokasi.'
    ],
    [
        'icon' => '💬',
        'judul' => 'Bisa Tanya Admin Langsung',
        'deskripsi' => 'Kalau bingung soal harga, paket, atau reservasi grup, tinggal chat WhatsApp.'
    ],
    [
        'icon' => '✨',
        'judul' => 'Cocok untuk Liburan & Rombongan',
        'deskripsi' => 'Mudah dipakai untuk keluarga, teman, sekolah, maupun acara komunitas.'
    ]
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket - Samarinda Theme Park</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body{
            background:#f7f7f7;
            font-family:Arial, sans-serif;
            color:#222;
        }

        .navbar-custom{
            background:#fff;
            padding:18px 0;
            box-shadow:0 2px 12px rgba(0,0,0,0.04);
        }

        .brand-wrap{
            display:flex;
            align-items:center;
            gap:10px;
            text-decoration:none;
        }

        .brand-logo{
            width:42px;
            height:42px;
            border-radius:50%;
            background:#d97070;
            color:#fff;
            display:flex;
            align-items:center;
            justify-content:center;
            font-weight:700;
            font-size:22px;
        }

        .brand-text h5{
            margin:0;
            font-size:16px;
            font-weight:700;
            color:#222;
        }

        .brand-text small{
            color:#777;
            display:block;
            margin-top:-2px;
        }

        .nav-link{
            color:#333 !important;
            font-size:14px;
            margin:0 8px;
            padding:8px 10px !important;
            border-radius:8px;
        }

        .nav-link.active{
            background:#efe2e2;
            font-weight:600;
        }

        .book-btn{
            background:#efe2e2;
            border:1px solid #dccaca;
            color:#333;
            border-radius:10px;
            padding:10px 18px;
            text-decoration:none;
            font-weight:600;
        }

        .hero-section{
            padding:56px 0 20px;
        }

        .hero-title{
            font-size:42px;
            font-weight:700;
            margin-bottom:10px;
        }

        .hero-text{
            color:#666;
            max-width:700px;
            line-height:1.7;
        }

        .action-wrap{
            display:flex;
            gap:12px;
            flex-wrap:wrap;
            margin-top:24px;
        }

        .btn-main{
            background:#d97070;
            color:#fff;
            border:none;
            border-radius:12px;
            padding:12px 20px;
            text-decoration:none;
            font-weight:600;
            display:inline-block;
        }

        .btn-soft{
            background:#fff;
            color:#333;
            border:1px solid #e1dede;
            border-radius:12px;
            padding:12px 20px;
            text-decoration:none;
            font-weight:600;
            display:inline-block;
        }

        .section-title{
            font-size:28px;
            font-weight:700;
            margin-bottom:22px;
        }

        .section-space{
            padding:28px 0;
        }

        .ticket-card{
            background:#fff;
            border:none;
            border-radius:20px;
            padding:24px;
            box-shadow:0 10px 25px rgba(0,0,0,0.05);
            height:100%;
            transition:0.25s ease;
        }

        .ticket-card:hover{
            transform:translateY(-4px);
        }

        .ticket-badge{
            display:inline-block;
            background:#f8e9e9;
            color:#b45757;
            font-size:12px;
            font-weight:700;
            padding:7px 12px;
            border-radius:999px;
            margin-bottom:14px;
        }

        .ticket-name{
            font-size:22px;
            font-weight:700;
            margin-bottom:8px;
        }

        .ticket-desc{
            color:#666;
            font-size:14px;
            min-height:48px;
            margin-bottom:18px;
        }

        .ticket-price{
            font-size:30px;
            font-weight:800;
            margin-bottom:16px;
        }

        .ticket-meta{
            color:#555;
            font-size:14px;
            margin-bottom:18px;
        }

        .ticket-meta div{
            margin-bottom:6px;
        }

        .promo-card{
            background:linear-gradient(135deg, #f4dede, #ffffff);
            border:none;
            border-radius:20px;
            padding:24px;
            box-shadow:0 10px 25px rgba(0,0,0,0.05);
            height:100%;
        }

        .promo-title{
            font-size:22px;
            font-weight:700;
            margin-bottom:10px;
        }

        .promo-desc{
            color:#555;
            font-size:14px;
            margin-bottom:14px;
        }

        .promo-price{
            font-size:28px;
            font-weight:800;
            color:#b45757;
            margin-bottom:16px;
        }

        .benefit-card{
            background:#fff;
            border-radius:18px;
            padding:24px;
            box-shadow:0 10px 25px rgba(0,0,0,0.05);
            height:100%;
            text-align:center;
        }

        .benefit-icon{
            font-size:34px;
            margin-bottom:12px;
        }

        .benefit-title{
            font-size:18px;
            font-weight:700;
            margin-bottom:8px;
        }

        .benefit-text{
            color:#666;
            font-size:14px;
        }

        .empty-box{
            background:#fff;
            border-radius:18px;
            padding:36px;
            text-align:center;
            color:#666;
            box-shadow:0 10px 25px rgba(0,0,0,0.05);
        }

        footer{
            padding:28px 0;
            text-align:center;
            color:#777;
            font-size:14px;
            margin-top:30px;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-custom">
    <div class="container">
        <a class="navbar-brand brand-wrap" href="index.php">
            <div class="brand-logo">S</div>
            <div class="brand-text">
                <h5>Samarinda</h5>
                <small>Theme Park</small>
            </div>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSTP">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSTP">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="wahana.php">Wahana</a></li>
                <li class="nav-item"><a class="nav-link" href="fasilitas.php">Fasilitas</a></li>
                <li class="nav-item"><a class="nav-link active" href="tiket.php">Tiket</a></li>
                <li class="nav-item"><a class="nav-link" href="review.php">Ulasan</a></li>
            </ul>

            <a href="tiket.php" class="book-btn">Book Now</a>
        </div>
    </div>
</nav>

<section class="hero-section">
    <div class="container">
        <h1 class="hero-title">Tiket & Promo</h1>
        <p class="hero-text">
            Pilih tiket masuk, tiket wahana, atau paket promo yang paling cocok untuk kunjunganmu ke Samarinda Theme Park.
            Lebih praktis untuk liburan keluarga, teman, maupun rombongan.
        </p>

        <div class="action-wrap">
            <a href="<?php echo $travelokaLink; ?>" target="_blank" class="btn-main">Pesan Sekarang</a>
            <a href="<?php echo $waLink; ?>" target="_blank" class="btn-soft">Chat WhatsApp</a>
        </div>
    </div>
</section>

<section class="section-space">
    <div class="container">
        <h2 class="section-title">Daftar Tiket</h2>
        <div class="row g-4">
            <?php if ($tiketUtama && mysqli_num_rows($tiketUtama) > 0): ?>
                <?php while($row = mysqli_fetch_assoc($tiketUtama)): ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="ticket-card">
                            <span class="ticket-badge">Tiket Aktif</span>

                            <div class="ticket-name">
                                <?php echo htmlspecialchars($row['nama_tiket']); ?>
                            </div>

                            <div class="ticket-desc">
                                <?php echo !empty($row['deskripsi']) ? htmlspecialchars($row['deskripsi']) : 'Tiket tersedia untuk pembelian.'; ?>
                            </div>

                            <div class="ticket-price">
                                Rp <?php echo number_format($row['harga'], 0, ',', '.'); ?>
                            </div>

                            <div class="ticket-meta">
                                <?php if (!empty($row['kategori'])): ?>
                                    <div><strong>Kategori:</strong> <?php echo htmlspecialchars($row['kategori']); ?></div>
                                <?php endif; ?>

                                <?php if (!empty($row['status'])): ?>
                                    <div><strong>Status:</strong> <?php echo htmlspecialchars($row['status']); ?></div>
                                <?php endif; ?>
                            </div>

                            <a href="<?php echo $travelokaLink; ?>" target="_blank" class="btn-main w-100 text-center">Booking Ticket</a>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="empty-box">
                        Data tiket belum tersedia.
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<section class="section-space">
    <div class="container">
        <h2 class="section-title">Promo & Bundle</h2>
        <div class="row g-4">
            <?php if ($promo && mysqli_num_rows($promo) > 0): ?>
                <?php while($p = mysqli_fetch_assoc($promo)): ?>
                    <div class="col-md-6">
                        <div class="promo-card">
                            <div class="promo-title">
                                <?php echo htmlspecialchars($p['judul']); ?>
                            </div>

                            <div class="promo-desc">
                                <?php echo !empty($p['deskripsi']) ? htmlspecialchars($p['deskripsi']) : 'Promo spesial tersedia untuk pengunjung.'; ?>
                            </div>

                            <?php if (!empty($p['harga_promo'])): ?>
                                <div class="promo-price">
                                    Rp <?php echo number_format($p['harga_promo'], 0, ',', '.'); ?>
                                </div>
                            <?php elseif (!empty($p['harga'])): ?>
                                <div class="promo-price">
                                    Rp <?php echo number_format($p['harga'], 0, ',', '.'); ?>
                                </div>
                            <?php endif; ?>

                            <a href="<?php echo $waLink; ?>" target="_blank" class="btn-soft">Tanya Promo</a>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="empty-box">
                        Belum ada promo aktif saat ini.
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<section class="section-space">
    <div class="container">
        <h2 class="section-title">Kenapa Pesan Tiket di Sini?</h2>
        <div class="row g-4">
            <?php foreach ($keunggulanList as $item): ?>
                <div class="col-md-4">
                    <div class="benefit-card">
                        <div class="benefit-icon"><?php echo $item['icon']; ?></div>
                        <div class="benefit-title"><?php echo htmlspecialchars($item['judul']); ?></div>
                        <div class="benefit-text"><?php echo htmlspecialchars($item['deskripsi']); ?></div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<footer>
    &copy; <?php echo date('Y'); ?> Samarinda Theme Park. All Rights Reserved.
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>