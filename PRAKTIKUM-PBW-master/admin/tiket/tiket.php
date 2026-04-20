<?php
session_start();

$pageTitle = "Kelola Tiket";
$activePage = "tiket";

require "../../config/koneksi.php";

include "../partials/header.php";
include "../partials/sidebar.php";

$keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';

if ($keyword != '') {
    $keyword_aman = mysqli_real_escape_string($conn, $keyword);
    $query = "SELECT * FROM tiket
              WHERE nama_tiket LIKE '%$keyword_aman%'
                 OR deskripsi LIKE '%$keyword_aman%'
                 OR harga LIKE '%$keyword_aman%'
                 OR status LIKE '%$keyword_aman%'
              ORDER BY id DESC";
} else {
    $query = "SELECT * FROM tiket ORDER BY id DESC";
}

$result = mysqli_query($conn, $query);
?>

<h1 class="page-title">Kelola Tiket</h1>
<p class="page-subtitle">Manage attractions and rides</p>

<form method="GET" class="search-bar">
    <input 
        type="text" 
        name="keyword" 
        placeholder="Cari tiket..." 
        value="<?= htmlspecialchars($keyword); ?>"
    >

    <button type="submit" class="btn btn-secondary">Cari</button>

    <a href="tambah_tiket.php" class="btn btn-primary">+ Tambah Tiket</a>
</form>

<div class="card">
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Tiket</th>
                    <th>Deskripsi</th>
                    <th>Harga</th>
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
                            <td><strong><?= htmlspecialchars($row['nama_tiket']); ?></strong></td>
                            <td><?= htmlspecialchars($row['deskripsi']); ?></td>
                            <td>Rp <?= number_format($row['harga'], 0, ',', '.'); ?></td>
                            <td>
                                <span class="badge <?= $statusClass; ?>">
                                    <?= htmlspecialchars($row['status']); ?>
                                </span>
                            </td>
                            <td class="actions">
                                <a href="edit_tiket.php?id=<?= $row['id']; ?>" class="icon-btn icon-edit" title="Edit">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <a href="hapus_tiket.php?id=<?= $row['id']; ?>" 
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
                        <td colspan="6" style="text-align:center; padding:20px;">
                            Data tiket tidak ditemukan.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include "../partials/footer.php"; ?>