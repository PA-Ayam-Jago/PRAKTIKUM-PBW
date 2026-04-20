<?php
session_start();

$pageTitle = "Kelola Wahana";
$activePage = "wahana";

require "../../config/koneksi.php";

include "../partials/header.php";
include "../partials/sidebar.php";

$keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';

// Query data wahana
if ($keyword != '') {
    $keyword_aman = mysqli_real_escape_string($conn, $keyword);
    $query = "SELECT * FROM wahana 
              WHERE nama_wahana LIKE '%$keyword_aman%'
                 OR kategori LIKE '%$keyword_aman%'
                 OR lokasi LIKE '%$keyword_aman%'
                 OR intensity LIKE '%$keyword_aman%'
              ORDER BY id DESC";
} else {
    $query = "SELECT * FROM wahana ORDER BY id DESC";
}

$result = mysqli_query($conn, $query);
?>

<h1 class="page-title">Kelola Wahana</h1>
<p class="page-subtitle">Manage attractions and rides</p>

<form method="GET" class="search-bar">
    <input 
        type="text" 
        name="keyword" 
        placeholder="Cari wahana..." 
        value="<?= htmlspecialchars($keyword); ?>"
    >

    <button type="submit" class="btn btn-secondary">Cari</button>

    <a href="tambah_wahana.php" class="btn btn-primary">+ Tambah Wahana</a>
</form>

<div class="card">
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Wahana</th>
                    <th>Kategori</th>
                    <th>Intensity</th>
                    <th>Kapasitas</th>
                    <th>Durasi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result && mysqli_num_rows($result) > 0): ?>
                    <?php $no = 1; ?>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>

                        <?php
                        // Badge kategori
                        if ($row['kategori'] == 'Thrill') {
                            $kategoriClass = 'badge-red';
                        } elseif ($row['kategori'] == 'Water') {
                            $kategoriClass = 'badge-cyan';
                        } elseif ($row['kategori'] == 'Family') {
                            $kategoriClass = 'badge-blue';
                        } elseif ($row['kategori'] == 'Kids') {
                            $kategoriClass = 'badge-green';
                        } else {
                            $kategoriClass = 'badge-secondary';
                        }

                        // Badge intensity
                        if ($row['intensity'] == 'Extreme') {
                            $intensityClass = 'badge-red';
                        } elseif ($row['intensity'] == 'High') {
                            $intensityClass = 'badge-pink';
                        } elseif ($row['intensity'] == 'Medium') {
                            $intensityClass = 'badge-yellow';
                        } elseif ($row['intensity'] == 'Low') {
                            $intensityClass = 'badge-green';
                        } else {
                            $intensityClass = 'badge-secondary';
                        }
                        ?>

                        <tr>
                            <td><?= $no++; ?></td>
                            <td>
                                <strong><?= htmlspecialchars($row['nama_wahana']); ?></strong><br>
                                <span class="text-muted"><?= htmlspecialchars($row['lokasi']); ?></span>
                            </td>
                            <td>
                                <span class="badge <?= $kategoriClass; ?>">
                                    <?= htmlspecialchars($row['kategori']); ?>
                                </span>
                            </td>
                            <td>
                                <span class="badge <?= $intensityClass; ?>">
                                    <?= htmlspecialchars($row['intensity']); ?>
                                </span>
                            </td>
                            <td><?= htmlspecialchars($row['kapasitas']); ?></td>
                            <td><?= htmlspecialchars($row['durasi']); ?></td>
                            <td class="actions">
                                <a href="edit_wahana.php?id=<?= $row['id']; ?>" class="icon-btn icon-edit" title="Edit">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <a href="hapus_wahana.php?id=<?= $row['id']; ?>" 
                                   class="icon-btn icon-delete" 
                                   title="Hapus"
                                   onclick="return confirm('Yakin ingin menghapus data ini?')">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </td>
                        </tr>

                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" style="text-align:center; padding:20px;">
                            Data wahana tidak ditemukan.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include "../partials/footer.php"; ?>