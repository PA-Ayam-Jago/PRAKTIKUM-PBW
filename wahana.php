<?php
date_default_timezone_set('Asia/Makassar');
require __DIR__ . '/config/koneksi.php';

$pageTitle = 'Wahana - Samarinda Theme Park';
$activePage = 'wahana';

$filter = isset($_GET['kategori']) ? trim($_GET['kategori']) : 'Semua Wahana';
$cari   = isset($_GET['cari']) ? trim($_GET['cari']) : '';

$kategoriList = array(
    'Semua Wahana',
    'Wahana Ekstrem',
    'Hiburan Keluarga',
    'Zona Anak',
    'Wahana Air'
);

$query = "SELECT * FROM wahana WHERE 1=1";

if (!empty($cari)) {
    $cariAman = mysqli_real_escape_string($conn, $cari);
    $query .= " AND nama_wahana LIKE '%$cariAman%'";
}

if ($filter == 'Wahana Ekstrem') {
    $query .= " AND intensity IN ('Extreme', 'High')";
} elseif ($filter == 'Hiburan Keluarga') {
    $query .= " AND kategori = 'Family'";
} elseif ($filter == 'Zona Anak') {
    $query .= " AND kategori = 'Kids'";
} elseif ($filter == 'Wahana Air') {
    $query .= " AND kategori = 'Water'";
}

$query .= " ORDER BY id ASC";

$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query error: " . mysqli_error($conn));
}

/*
|--------------------------------------------------------------------------
| Fungsi cari gambar otomatis dari folder assets/img/wahana
|--------------------------------------------------------------------------
*/
function cariGambarWahana($namaWahana, $gambarDb = '')
{
    $folderRel = 'assets/img/wahana/';
    $folderAbs = __DIR__ . '/assets/img/wahana/';
    $defaultImg = $folderRel . 'default.jpg';

    if (!is_dir($folderAbs)) {
        return $defaultImg;
    }

    $files = scandir($folderAbs);
    if (!$files) {
        return $defaultImg;
    }

    // 1. Coba langsung dari nama file di database
    if (!empty($gambarDb)) {
        $directPath = $folderAbs . $gambarDb;
        if (file_exists($directPath)) {
            return $folderRel . $gambarDb;
        }

        foreach ($files as $file) {
            if ($file === '.' || $file === '..') continue;
            if (strtolower($file) === strtolower($gambarDb)) {
                return $folderRel . $file;
            }
        }
    }

    // 2. Coba cocokkan dari nama wahana
    $namaClean = strtolower(trim($namaWahana));
    $namaClean = str_replace(array('-', '_'), ' ', $namaClean);
    $namaClean = preg_replace('/\s+/', ' ', $namaClean);

    foreach ($files as $file) {
        if ($file === '.' || $file === '..') continue;

        $nameOnly = pathinfo($file, PATHINFO_FILENAME);
        $nameOnly = strtolower(trim($nameOnly));
        $nameOnly = str_replace(array('-', '_'), ' ', $nameOnly);
        $nameOnly = preg_replace('/\s+/', ' ', $nameOnly);

        // sama persis
        if ($nameOnly === $namaClean) {
            return $folderRel . $file;
        }
    }

    // 3. Coba pencocokan sebagian
    foreach ($files as $file) {
        if ($file === '.' || $file === '..') continue;

        $nameOnly = pathinfo($file, PATHINFO_FILENAME);
        $nameOnly = strtolower(trim($nameOnly));
        $nameOnly = str_replace(array('-', '_'), ' ', $nameOnly);
        $nameOnly = preg_replace('/\s+/', ' ', $nameOnly);

        if (
            strpos($nameOnly, $namaClean) !== false ||
            strpos($namaClean, $nameOnly) !== false
        ) {
            return $folderRel . $file;
        }
    }

    return $defaultImg;
}

include 'partials/header.php';
?>

<section class="hero" style="background-image: url('assets/img/wahana/pemandangan.JPG');">
    <div class="hero-overlay">
        <div class="container hero-content">
            <span class="status-open">• Jelajahi Wahana</span>
            <h1>Wahana Seru untuk Semua</h1>
            <p>
                Jelajahi berbagai wahana seru di Samarinda Theme Park, mulai dari wahana
                keluarga hingga permainan yang memacu adrenalin.
            </p>
        </div>
    </div>
</section>

<section class="filter-section">
    <div class="container filter-wrap">
        <div class="filter-tabs">
            <?php foreach ($kategoriList as $kategori): ?>
                <?php
                    $active = ($filter === $kategori) ? 'active' : '';
                    $link = 'wahana.php?kategori=' . urlencode($kategori);
                    if (!empty($cari)) {
                        $link .= '&cari=' . urlencode($cari);
                    }
                ?>
                <a href="<?= $link; ?>" class="filter-tab <?= $active; ?>">
                    <?= htmlspecialchars($kategori); ?>
                </a>
            <?php endforeach; ?>
        </div>

        <form class="search-box" method="GET" action="wahana.php">
            <input type="hidden" name="kategori" value="<?= htmlspecialchars($filter); ?>">
            <span>🔍</span>
            <input type="text" name="cari" placeholder="Cari wahana..." value="<?= htmlspecialchars($cari); ?>">
            <button type="submit">Cari</button>
        </form>
    </div>
</section>

<section class="wahana-section">
    <div class="container">
        <div class="card-grid">
            <?php if (mysqli_num_rows($result) > 0): ?>
                <?php while ($wahana = mysqli_fetch_assoc($result)): ?>
                    <?php
                        $warna_level = 'level-normal';

                        if ($wahana['intensity'] == 'Extreme') {
                            $warna_level = 'level-extreme';
                        } elseif ($wahana['intensity'] == 'High') {
                            $warna_level = 'level-high';
                        } elseif ($wahana['intensity'] == 'Medium') {
                            $warna_level = 'level-medium';
                        } elseif ($wahana['intensity'] == 'Low' || $wahana['intensity'] == 'Normal') {
                            $warna_level = 'level-normal';
                        }

                        $gambar = cariGambarWahana(
                            $wahana['nama_wahana'],
                            isset($wahana['gambar']) ? $wahana['gambar'] : ''
                        );

                        $idWahana = $wahana['id'];
                    ?>
                    <div class="card">
                        <div class="card-image">
                            <img src="<?= htmlspecialchars($gambar); ?>" alt="<?= htmlspecialchars($wahana['nama_wahana']); ?>">
                        </div>

                        <div class="card-body">
                            <h3><?= htmlspecialchars($wahana['nama_wahana']); ?></h3>
                            <p><?= htmlspecialchars($wahana['deskripsi']); ?></p>

                            <div class="card-meta">
                                <span>🕒 <?= htmlspecialchars($wahana['durasi']); ?></span>
                                <span>👥 <?= htmlspecialchars($wahana['kapasitas']); ?> orang</span>
                            </div>

                            <div class="card-bottom">
                                <div class="level-pill <?= $warna_level; ?>">
                                    ⚡ <?= htmlspecialchars($wahana['intensity']); ?>
                                </div>

                                <a href="detail_wahana.php?id=<?= urlencode($idWahana); ?>" class="detail-link">
                                    Detail
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="empty-state">
                    <h3>Wahana tidak ditemukan</h3>
                    <p>Coba kata kunci lain atau pilih kategori yang berbeda.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php include 'partials/footer.php'; ?>