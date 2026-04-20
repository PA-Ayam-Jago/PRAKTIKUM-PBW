<?php
require 'config/koneksi.php';
date_default_timezone_set('Asia/Makassar');

$cari = isset($_GET['cari']) ? trim($_GET['cari']) : '';

$query = "SELECT * FROM fasilitas WHERE 1=1";

if (!empty($cari)) {
    $cariAman = mysqli_real_escape_string($conn, $cari);
    $query .= " AND (
        nama_fasilitas LIKE '%$cariAman%' 
        OR deskripsi LIKE '%$cariAman%' 
        OR lokasi LIKE '%$cariAman%'
    )";
}

$query .= " ORDER BY id ASC";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query error: " . mysqli_error($conn));
}

function getFasilitasIcon($nama)
{
    $nama = strtolower($nama);

    if (strpos($nama, 'parkir') !== false) return '🚗';
    if (strpos($nama, 'toilet') !== false) return '🚻';
    if (strpos($nama, 'mushola') !== false) return '🕌';
    if (strpos($nama, 'makan') !== false) return '🍴';
    if (strpos($nama, 'restoran') !== false) return '🍽️';
    if (strpos($nama, 'foodcourt') !== false) return '🍜';
    if (strpos($nama, 'gazebo') !== false) return '🏕️';
    if (strpos($nama, 'istirahat') !== false) return '🪑';
    if (strpos($nama, 'merchandise') !== false) return '🛍️';
    if (strpos($nama, 'umkm') !== false) return '🏪';

    return '🏢';
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fasilitas - Samarinda Theme Park</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f6f6f6;
            font-family: Arial, sans-serif;
            color: #222;
        }

        .navbar-custom {
            background: #ffffff;
            padding: 18px 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.04);
        }

        .brand-wrap {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .brand-logo {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: #d86a6a;
            color: white;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
        }

        .brand-text {
            line-height: 1.1;
        }

        .brand-text h5 {
            margin: 0;
            font-weight: 700;
        }

        .brand-text small {
            color: #777;
        }

        .nav-link {
            color: #333 !important;
            font-size: 14px;
            margin: 0 8px;
        }

        .nav-link.active {
            background: #eadede;
            border-radius: 8px;
            padding: 8px 14px !important;
            font-weight: 600;
        }

        .book-btn {
            background: #eadede;
            border: 1px solid #d8c6c6;
            color: #333;
            border-radius: 10px;
            padding: 10px 18px;
            font-weight: 600;
            text-decoration: none;
        }

        .hero-section {
            padding: 50px 0 20px;
        }

        .hero-title {
            font-size: 42px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .hero-text {
            color: #666;
            max-width: 650px;
            font-size: 16px;
        }

        .search-box {
            background: white;
            border-radius: 14px;
            padding: 10px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.05);
            margin-top: 30px;
        }

        .search-box input {
            border: none;
            box-shadow: none !important;
        }

        .search-btn {
            background: #d86a6a;
            color: white;
            border: none;
            border-radius: 10px;
            padding: 10px 22px;
            font-weight: 600;
        }

        .section-title {
            font-size: 28px;
            font-weight: 700;
            margin: 40px 0 25px;
        }

        .facility-card {
            background: #fff;
            border: none;
            border-radius: 18px;
            padding: 24px;
            height: 100%;
            box-shadow: 0 8px 24px rgba(0,0,0,0.06);
            transition: 0.25s ease;
        }

        .facility-card:hover {
            transform: translateY(-4px);
        }

        .facility-icon {
            width: 60px;
            height: 60px;
            background: #f8e8e8;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            margin-bottom: 18px;
        }

        .facility-title {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .facility-desc {
            color: #666;
            font-size: 14px;
            min-height: 60px;
        }

        .facility-meta {
            margin-top: 18px;
            font-size: 14px;
            color: #444;
        }

        .facility-meta span {
            display: block;
            margin-bottom: 6px;
        }

        .empty-box {
            background: #fff;
            border-radius: 18px;
            padding: 40px;
            text-align: center;
            color: #666;
            box-shadow: 0 8px 24px rgba(0,0,0,0.05);
        }

        footer {
            margin-top: 60px;
            padding: 25px 0;
            text-align: center;
            color: #777;
            font-size: 14px;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
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
                    <li class="nav-item"><a class="nav-link active" href="fasilitas.php">Fasilitas</a></li>
                    <li class="nav-item"><a class="nav-link" href="tiket.php">Tiket</a></li>
                    <li class="nav-item"><a class="nav-link" href="review.php">Review</a></li>
                </ul>

                <a href="pemesanan.php" class="book-btn">Book Now</a>
            </div>
        </div>
    </nav>

    <!-- Hero -->
    <section class="hero-section">
        <div class="container">
            <h1 class="hero-title">Fasilitas</h1>
            <p class="hero-text">
                Nikmati berbagai fasilitas pendukung di Samarinda Theme Park untuk kenyamanan dan pengalaman liburan yang lebih menyenangkan.
            </p>

            <form method="GET" class="search-box">
                <div class="row g-2 align-items-center">
                    <div class="col-md-10">
                        <input 
                            type="text" 
                            name="cari" 
                            class="form-control form-control-lg" 
                            placeholder="Cari fasilitas, lokasi, atau deskripsi..."
                            value="<?php echo htmlspecialchars($cari); ?>"
                        >
                    </div>
                    <div class="col-md-2 d-grid">
                        <button type="submit" class="search-btn">Cari</button>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <!-- List fasilitas -->
    <section class="pb-5">
        <div class="container">
            <h2 class="section-title">Daftar Fasilitas</h2>

            <div class="row g-4">
                <?php if (mysqli_num_rows($result) > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <div class="col-md-6 col-lg-4">
                            <div class="facility-card">
                                <div class="facility-icon">
                                    <?php echo getFasilitasIcon($row['nama_fasilitas']); ?>
                                </div>

                                <div class="facility-title">
                                    <?php echo htmlspecialchars($row['nama_fasilitas']); ?>
                                </div>

                                <div class="facility-desc">
                                    <?php echo htmlspecialchars($row['deskripsi']); ?>
                                </div>

                                <div class="facility-meta">
                                    <span><strong>Lokasi:</strong> <?php echo htmlspecialchars($row['lokasi']); ?></span>

                                    <?php if (!empty($row['jam_operasional'])): ?>
                                        <span><strong>Jam Operasional:</strong> <?php echo htmlspecialchars($row['jam_operasional']); ?></span>
                                    <?php endif; ?>

                                    <?php if (!empty($row['kontak'])): ?>
                                        <span><strong>Kontak:</strong> <?php echo htmlspecialchars($row['kontak']); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <div class="col-12">
                        <div class="empty-box">
                            Data fasilitas belum ada atau hasil pencarian tidak ditemukan.
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <footer>
        &copy; <?php echo date('Y'); ?> Samarinda Theme Park. All Rights Reserved.
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>