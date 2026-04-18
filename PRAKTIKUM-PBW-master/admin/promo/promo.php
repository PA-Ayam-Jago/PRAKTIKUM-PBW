<?php
session_start();

$pageTitle = "Kelola Promo";
$activePage = "promo";

require "../../config/koneksi.php";

include "../partials/header.php";
include "../partials/sidebar.php";

$keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';

if ($keyword != '') {
    $keyword_aman = mysqli_real_escape_string($conn, $keyword);
    $query = "SELECT * FROM promo
              WHERE nama_promo LIKE '%$keyword_aman%'
                 OR badge LIKE '%$keyword_aman%'
                 OR kode LIKE '%$keyword_aman%'
                 OR berlaku_sampai LIKE '%$keyword_aman%'
                 OR status LIKE '%$keyword_aman%'
              ORDER BY id DESC";
} else {
    $query = "SELECT * FROM promo ORDER BY id DESC";
}

$result = mysqli_query($conn, $query);
?>

<h1 class="page-title">Kelola Promo</h1>
<p class="page-subtitle">Manage attractions and rides</p>

<form method="GET" class="search-bar">
    <input 
        type="text" 
        name="keyword" 
        placeholder="Cari promo..." 
        value="<?= htmlspecialchars($keyword); ?>"
    >

    <button type="submit" class="btn btn-secondary">Cari</button>

    <a href="tambah_promo.php" class="btn btn-primary">+ Tambah Promo</a>
</form>

<div class="card">
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Promo</th>
                    <th>Badge</th>
                    <th>Kode</th>
                    <th>Berlaku Sampai</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result && mysqli_num_rows($result) > 0): ?>
                    <?php $no = 1; ?>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <?php
                        if ($row['status'] == 'Aktif') {
                            $statusClass = 'badge-green';
                        } elseif ($row['status'] == 'Nonaktif') {
                            $statusClass = 'badge-pink';
                        } else {
                            $statusClass = 'badge-secondary';
                        }
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><strong><?= htmlspecialchars($row['nama_promo']); ?></strong></td>
                            <td><span class="badge badge-pink"><?= htmlspecialchars($row['badge']); ?></span></td>
                            <td><?= htmlspecialchars($row['kode']); ?></td>
                            <td><?= htmlspecialchars($row['berlaku_sampai']); ?></td>
                            <td>
                                <span class="badge <?= $statusClass; ?>">
                                    <?= htmlspecialchars($row['status']); ?>
                                </span>
                            </td>
                            <td class="actions">
                                <a href="edit_promo.php?id=<?= $row['id']; ?>" class="icon-btn icon-edit" title="Edit">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <a href="hapus_promo.php?id=<?= $row['id']; ?>" 
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
                            Data promo tidak ditemukan.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include "../partials/footer.php"; ?>