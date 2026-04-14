<?php
require 'config/koneksi.php';
date_default_timezone_set('Asia/Makassar');

$ratingFilter = isset($_GET['rating']) ? (int)$_GET['rating'] : 0;

$where = "";
if ($ratingFilter >= 1 && $ratingFilter <= 5) {
    $where = "WHERE rating = $ratingFilter";
}

$query = "SELECT * FROM ulasan $where ORDER BY id_ulasan DESC";
$result = mysqli_query($conn, $query);

/* Statistik */
$statsQuery = "SELECT rating, COUNT(*) as jumlah FROM ulasan GROUP BY rating ORDER BY rating DESC";
$statsResult = mysqli_query($conn, $statsQuery);

$ratingCounts = array(
    5 => 0,
    4 => 0,
    3 => 0,
    2 => 0,
    1 => 0
);

$totalUlasan = 0;
$totalSkor = 0;

while ($row = mysqli_fetch_assoc($statsResult)) {
    $rating = (int)$row['rating'];
    $jumlah = (int)$row['jumlah'];
    $ratingCounts[$rating] = $jumlah;
    $totalUlasan += $jumlah;
    $totalSkor += ($rating * $jumlah);
}

$rataRata = $totalUlasan > 0 ? round($totalSkor / $totalUlasan, 1) : 0;

function tampilBintang($rating) {
    $html = '';
    for ($i = 1; $i <= 5; $i++) {
        $html .= $i <= $rating ? '★' : '☆';
    }
    return $html;
}

function formatTanggalIndo($tanggal) {
    $bulan = array(
        1 => 'Januari',
        2 => 'Februari',
        3 => 'Maret',
        4 => 'April',
        5 => 'Mei',
        6 => 'Juni',
        7 => 'Juli',
        8 => 'Agustus',
        9 => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Desember'
    );

    $ts = strtotime($tanggal);
    if (!$ts) return $tanggal;

    $hari = date('j', $ts);
    $bln = (int)date('n', $ts);
    $thn = date('Y', $ts);

    return $hari . ' ' . $bulan[$bln] . ', ' . $thn;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review - Samarinda Theme Park</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        .review-hero {
            background: #f25757;
            color: #fff;
            padding: 54px 0 56px;
        }

        .review-badge {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 18px;
            color: #fff;
            font-size: 15px;
        }

        .review-badge-pill {
            background: #fff;
            color: #666;
            padding: 7px 14px;
            border-radius: 999px;
            font-size: 14px;
            font-weight: 600;
        }

        .review-hero h2 {
            font-size: 56px;
            font-weight: 800;
            margin-bottom: 14px;
            text-shadow: 0 4px 10px rgba(0,0,0,0.12);
        }

        .review-hero p {
            max-width: 720px;
            font-size: 22px;
            line-height: 1.6;
            font-weight: 500;
        }

        .review-summary-section {
            background: #f5f5f5;
            padding: 34px 0;
            border-bottom: 1px solid #ddd;
            box-shadow: 0 2px 6px rgba(0,0,0,0.06);
        }

        .review-summary-wrap {
            display: grid;
            grid-template-columns: 1.1fr 1.6fr 1fr;
            gap: 30px;
            align-items: center;
        }

        .score-box {
            text-align: center;
        }

        .score-box h3 {
            font-size: 76px;
            line-height: 1;
            margin-bottom: 12px;
            font-weight: 800;
        }

        .big-stars {
            color: #f3d400;
            font-size: 34px;
            letter-spacing: 6px;
            margin-bottom: 10px;
        }

        .score-box p {
            color: #777;
            font-size: 22px;
            font-weight: 600;
        }

        .rating-bars {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .rating-row {
            display: grid;
            grid-template-columns: 32px 26px 1fr 30px;
            gap: 12px;
            align-items: center;
            font-size: 18px;
            font-weight: 700;
        }

        .rating-star {
            color: #f3d400;
            font-size: 24px;
        }

        .bar-track {
            width: 100%;
            height: 14px;
            background: #ece6e6;
            border-radius: 999px;
            overflow: hidden;
        }

        .bar-fill {
            height: 100%;
            background: #f3d400;
            border-radius: 999px;
        }

        .write-box {
            display: flex;
            justify-content: flex-end;
        }

        .write-btn {
            background: #ff6161;
            color: #fff;
            padding: 18px 34px;
            border-radius: 14px;
            border: none;
            font-size: 20px;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(0,0,0,0.08);
        }

        .write-btn:hover {
            background: #f14e4e;
        }

        .review-form-section {
            padding: 26px 0 10px;
            display: none;
        }

        .review-form-section.show {
            display: block;
        }

        .review-form-card {
            max-width: 760px;
            margin: 0 auto;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 22px;
            box-shadow: 0 4px 14px rgba(0,0,0,0.08);
            padding: 28px;
        }

        .review-form-card h3 {
            font-size: 28px;
            margin-bottom: 18px;
        }

        .review-form-grid {
            display: grid;
            gap: 14px;
        }

        .review-form-grid input,
        .review-form-grid select,
        .review-form-grid textarea {
            width: 100%;
            border: 1px solid #ccc;
            border-radius: 12px;
            padding: 14px 16px;
            font-size: 16px;
            font-family: inherit;
            outline: none;
            background: #fff;
        }

        .review-form-grid textarea {
            min-height: 140px;
            resize: vertical;
        }

        .review-submit {
            background: #ff6161;
            color: #fff;
            border: none;
            border-radius: 12px;
            padding: 14px 22px;
            font-size: 17px;
            font-weight: 700;
            cursor: pointer;
        }

        .review-submit:hover {
            background: #f14e4e;
        }

        .review-filter-section {
            padding: 24px 0;
            background: #f8f8f8;
            border-top: 1px solid #ddd;
            border-bottom: 1px solid #ddd;
            box-shadow: 0 2px 6px rgba(0,0,0,0.06);
        }

        .review-filter-wrap {
            display: flex;
            align-items: center;
            gap: 14px;
            flex-wrap: wrap;
        }

        .filter-label {
            font-size: 18px;
            color: #777;
            margin-right: 10px;
        }

        .filter-btn {
            display: inline-block;
            padding: 12px 22px;
            border: 1px solid #999;
            border-radius: 14px;
            font-size: 16px;
            font-weight: 500;
            background: #fff;
        }

        .filter-btn.active {
            background: #d9b8b8;
            border-color: #b78989;
        }

        .review-list-section {
            padding: 40px 0 90px;
        }

        .review-list {
            max-width: 900px;
            margin: 0 auto;
        }

        .review-card {
            background: #fff;
            border: 1px solid #d1d1d1;
            border-radius: 24px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.08);
            padding: 26px 28px;
            margin-bottom: 26px;
        }

        .review-card-top {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            align-items: flex-start;
            margin-bottom: 20px;
        }

        .review-user {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .review-avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: #ffd6d6;
            color: #ff5c5c;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 24px;
            flex-shrink: 0;
        }

        .review-user strong {
            display: block;
            font-size: 20px;
            margin-bottom: 4px;
        }

        .review-user span {
            color: #888;
            font-size: 16px;
        }

        .review-stars {
            color: #f3d400;
            font-size: 24px;
            letter-spacing: 3px;
            white-space: nowrap;
        }

        .review-text {
            color: #333;
            font-size: 17px;
            line-height: 1.9;
            margin-bottom: 16px;
        }

        .review-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            flex-wrap: wrap;
        }

        .review-action-btn {
            padding: 8px 14px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            border: 1px solid #ccc;
            background: #fff;
        }

        .review-action-btn.delete {
            background: #ffe6e6;
            border-color: #efb8b8;
            color: #c33;
        }

        .empty-review {
            text-align: center;
            font-size: 20px;
            color: #444;
            padding: 70px 20px;
        }

        @media (max-width: 1000px) {
            .review-summary-wrap {
                grid-template-columns: 1fr;
                text-align: center;
            }

            .write-box {
                justify-content: center;
            }

            .review-hero h2 {
                font-size: 40px;
            }

            .review-hero p {
                font-size: 18px;
            }
        }

        @media (max-width: 700px) {
            .review-card-top {
                flex-direction: column;
                align-items: flex-start;
            }

            .filter-btn {
                padding: 10px 16px;
                font-size: 14px;
            }

            .score-box h3 {
                font-size: 56px;
            }

            .big-stars {
                font-size: 24px;
                letter-spacing: 4px;
            }

            .review-hero h2 {
                font-size: 32px;
            }
        }
    </style>
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
            <a href="promo.php">Promosi</a>
            <a href="review.php" class="active">Review</a>
        </div>

        <div class="nav-right">
            <span class="search-icon">&#128269;</span>
            <a href="tiket.php" class="book-btn">Book Now</a>
        </div>
    </div>
</nav>

<section class="review-hero">
    <div class="container">
        <div class="review-badge">
            <span>🏷️</span>
            <span class="review-badge-pill">Penawaran Terbatas</span>
        </div>
        <h2>Ulasan Pengunjung</h2>
        <p>Lihat apa yang dikatakan para tamu kami tentang pengalaman mereka di Samarinda Theme Park.</p>
    </div>
</section>

<section class="review-summary-section">
    <div class="container review-summary-wrap">
        <div class="score-box">
            <h3><?php echo $rataRata; ?></h3>
            <div class="big-stars">★★★★★</div>
            <p><?php echo $totalUlasan; ?> Ulasan</p>
        </div>

        <div class="rating-bars">
            <?php for ($i = 5; $i >= 1; $i--) : 
                $percent = $totalUlasan > 0 ? ($ratingCounts[$i] / $totalUlasan) * 100 : 0;
            ?>
                <div class="rating-row">
                    <span><?php echo $i; ?></span>
                    <span class="rating-star">★</span>
                    <div class="bar-track">
                        <div class="bar-fill" style="width: <?php echo $percent; ?>%;"></div>
                    </div>
                    <span><?php echo $ratingCounts[$i]; ?></span>
                </div>
            <?php endfor; ?>
        </div>

        <div class="write-box">
            <button class="write-btn" onclick="toggleReviewForm()">Tulis Ulasan</button>
        </div>
    </div>
</section>

<section id="reviewFormSection" class="review-form-section">
    <div class="container">
        <div class="review-form-card">
            <h3>Tulis Ulasan Anda</h3>
            <form action="tambah_ulasan.php" method="POST" class="review-form-grid">
                <input type="text" name="nama_pengunjung" placeholder="Nama Anda" required>

                <select name="rating" required>
                    <option value="">Pilih Rating</option>
                    <option value="5">Bintang 5</option>
                    <option value="4">Bintang 4</option>
                    <option value="3">Bintang 3</option>
                    <option value="2">Bintang 2</option>
                    <option value="1">Bintang 1</option>
                </select>

                <textarea name="komentar" placeholder="Tulis pengalaman Anda..." required></textarea>

                <button type="submit" class="review-submit">Kirim Ulasan</button>
            </form>
        </div>
    </div>
</section>

<section class="review-filter-section">
    <div class="container review-filter-wrap">
        <span class="filter-label">⚲ Filter:</span>
        <a href="review.php" class="filter-btn <?php echo $ratingFilter == 0 ? 'active' : ''; ?>">Semua Ulasan</a>
        <a href="review.php?rating=5" class="filter-btn <?php echo $ratingFilter == 5 ? 'active' : ''; ?>">Bintang 5</a>
        <a href="review.php?rating=4" class="filter-btn <?php echo $ratingFilter == 4 ? 'active' : ''; ?>">Bintang 4</a>
        <a href="review.php?rating=3" class="filter-btn <?php echo $ratingFilter == 3 ? 'active' : ''; ?>">Bintang 3</a>
        <a href="review.php?rating=2" class="filter-btn <?php echo $ratingFilter == 2 ? 'active' : ''; ?>">Bintang 2</a>
        <a href="review.php?rating=1" class="filter-btn <?php echo $ratingFilter == 1 ? 'active' : ''; ?>">Bintang 1</a>
    </div>
</section>

<section class="review-list-section">
    <div class="container">
        <div class="review-list">
            <?php if (mysqli_num_rows($result) > 0) : ?>
                <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                    <div class="review-card">
                        <div class="review-card-top">
                            <div class="review-user">
                                <div class="review-avatar">
                                    <?php echo strtoupper(substr($row['nama_pengunjung'], 0, 1)); ?>
                                </div>
                                <div>
                                    <strong><?php echo htmlspecialchars($row['nama_pengunjung']); ?></strong>
                                    <span><?php echo formatTanggalIndo($row['tanggal']); ?></span>
                                </div>
                            </div>

                            <div class="review-stars">
                                <?php echo tampilBintang((int)$row['rating']); ?>
                            </div>
                        </div>

                        <div class="review-text">
                            <?php echo nl2br(htmlspecialchars($row['komentar'])); ?>
                        </div>

                        <div class="review-actions">
                            <a href="edit_ulasan.php?id=<?php echo $row['id_ulasan']; ?>" class="review-action-btn">Edit</a>
                            <a href="hapus_ulasan.php?id=<?php echo $row['id_ulasan']; ?>" class="review-action-btn delete" onclick="return confirm('Hapus ulasan ini?')">Hapus</a>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else : ?>
                <div class="empty-review">
                    Tidak ada ulasan yang sesuai dengan filter Anda.
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<script>
    function toggleReviewForm() {
        const formSection = document.getElementById('reviewFormSection');
        formSection.classList.toggle('show');
        if (formSection.classList.contains('show')) {
            formSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    }
</script>

</body>
</html>