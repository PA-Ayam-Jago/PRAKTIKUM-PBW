<?php
require 'config/koneksi.php';
date_default_timezone_set('Asia/Makassar');

$success = "";
$error = "";

// PROSES SIMPAN ULASAN
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama_pengunjung'] ?? '');
    $rating = (int)($_POST['rating'] ?? 0);
    $judul = trim($_POST['judul'] ?? '');
    $komentar = trim($_POST['komentar'] ?? '');
    $tipe_kunjungan = trim($_POST['tipe_kunjungan'] ?? '');
    $tanggal = date('Y-m-d');

    if ($nama === '' || $rating < 1 || $rating > 5 || $judul === '' || $komentar === '' || $tipe_kunjungan === '') {
        $error = "Semua field wajib diisi dengan benar.";
    } else {
        $nama = mysqli_real_escape_string($conn, $nama);
        $judul = mysqli_real_escape_string($conn, $judul);
        $komentar = mysqli_real_escape_string($conn, $komentar);
        $tipe_kunjungan = mysqli_real_escape_string($conn, $tipe_kunjungan);

        $insert = "INSERT INTO ulasan (nama_pengunjung, rating, judul, komentar, tipe_kunjungan, tanggal)
                   VALUES ('$nama', '$rating', '$judul', '$komentar', '$tipe_kunjungan', '$tanggal')";

        if (mysqli_query($conn, $insert)) {
            header("Location: ulasan.php?success=1");
            exit;
        } else {
            $error = "Gagal menyimpan ulasan: " . mysqli_error($conn);
        }
    }
}

// AMBIL DATA ULASAN
$query = "SELECT * FROM ulasan ORDER BY id DESC";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query error: " . mysqli_error($conn));
}

if (isset($_GET['success'])) {
    $success = "Ulasan berhasil dikirim.";
}

function renderStars($rating)
{
    $rating = (int)$rating;
    $output = '';
    for ($i = 1; $i <= 5; $i++) {
        $output .= $i <= $rating ? '★' : '☆';
    }
    return $output;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ulasan - Samarinda Theme Park</title>
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

        .section-space{
            padding:28px 0;
        }

        .section-title{
            font-size:28px;
            font-weight:700;
            margin-bottom:22px;
        }

        .review-form-card,
        .review-card{
            background:#fff;
            border:none;
            border-radius:20px;
            padding:24px;
            box-shadow:0 10px 25px rgba(0,0,0,0.05);
            height:100%;
        }

        .form-label{
            font-weight:600;
            margin-bottom:8px;
        }

        .form-control,
        .form-select{
            border-radius:12px;
            padding:12px 14px;
            border:1px solid #ddd;
        }

        .btn-main{
            background:#d97070;
            color:#fff;
            border:none;
            border-radius:12px;
            padding:12px 20px;
            font-weight:600;
        }

        .review-header{
            display:flex;
            justify-content:space-between;
            align-items:flex-start;
            gap:12px;
            flex-wrap:wrap;
            margin-bottom:10px;
        }

        .review-name{
            font-size:18px;
            font-weight:700;
            margin-bottom:4px;
        }

        .review-visit{
            font-size:13px;
            color:#777;
        }

        .review-stars{
            color:#d97070;
            font-size:20px;
            margin-bottom:10px;
        }

        .review-title{
            font-size:18px;
            font-weight:700;
            margin-bottom:8px;
        }

        .review-text{
            color:#555;
            line-height:1.7;
            font-size:14px;
        }

        .review-date{
            font-size:13px;
            color:#888;
            white-space:nowrap;
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
                <li class="nav-item"><a class="nav-link" href="tiket.php">Tiket</a></li>
                <li class="nav-item"><a class="nav-link active" href="ulasan.php">Ulasan</a></li>
            </ul>

            <a href="tiket.php" class="book-btn">Book Now</a>
        </div>
    </div>
</nav>

<section class="hero-section">
    <div class="container">
        <h1 class="hero-title">Ulasan Pengunjung</h1>
        <p class="hero-text">
            Baca pengalaman pengunjung lain dan bagikan ceritamu setelah berkunjung ke Samarinda Theme Park.
        </p>
    </div>
</section>

<section class="section-space">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-5">
                <div class="review-form-card">
                    <h2 class="section-title">Tulis Ulasan</h2>

                    <?php if ($success): ?>
                        <div class="alert alert-success"><?php echo $success; ?></div>
                    <?php endif; ?>

                    <?php if ($error): ?>
                        <div class="alert alert-danger"><?php echo $error; ?></div>
                    <?php endif; ?>

                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label">Nama Pengunjung</label>
                            <input type="text" name="nama_pengunjung" class="form-control" placeholder="Masukkan nama kamu" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Judul Ulasan</label>
                            <input type="text" name="judul" class="form-control" placeholder="Contoh: Tempatnya seru banget" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Rating</label>
                            <select name="rating" class="form-select" required>
                                <option value="">Pilih rating</option>
                                <option value="5">5 - Sangat puas</option>
                                <option value="4">4 - Puas</option>
                                <option value="3">3 - Cukup</option>
                                <option value="2">2 - Kurang</option>
                                <option value="1">1 - Tidak puas</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tipe Kunjungan</label>
                            <select name="tipe_kunjungan" class="form-select" required>
                                <option value="">Pilih tipe kunjungan</option>
                                <option value="Keluarga">Keluarga</option>
                                <option value="Teman">Teman</option>
                                <option value="Pasangan">Pasangan</option>
                                <option value="Rombongan">Rombongan</option>
                                <option value="Solo Trip">Solo Trip</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Komentar</label>
                            <textarea name="komentar" rows="5" class="form-control" placeholder="Tulis pengalaman kamu..." required></textarea>
                        </div>

                        <button type="submit" class="btn-main w-100">Kirim Ulasan</button>
                    </form>
                </div>
            </div>

            <div class="col-lg-7">
                <h2 class="section-title">Ulasan Terbaru</h2>

                <div class="row g-4">
                    <?php if (mysqli_num_rows($result) > 0): ?>
                        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                            <div class="col-12">
                                <div class="review-card">
                                    <div class="review-header">
                                        <div>
                                            <div class="review-name">
                                                <?php echo htmlspecialchars($row['nama_pengunjung']); ?>
                                            </div>
                                            <div class="review-visit">
                                                Tipe kunjungan: <?php echo htmlspecialchars($row['tipe_kunjungan']); ?>
                                            </div>
                                        </div>

                                        <div class="review-date">
                                            <?php echo htmlspecialchars($row['tanggal']); ?>
                                        </div>
                                    </div>

                                    <div class="review-stars">
                                        <?php echo renderStars($row['rating']); ?>
                                    </div>

                                    <div class="review-title">
                                        <?php echo htmlspecialchars($row['judul']); ?>
                                    </div>

                                    <div class="review-text">
                                        <?php echo nl2br(htmlspecialchars($row['komentar'])); ?>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <div class="col-12">
                            <div class="empty-box">
                                Belum ada ulasan pengunjung.
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<footer>
    &copy; <?php echo date('Y'); ?> Samarinda Theme Park. All Rights Reserved.
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>