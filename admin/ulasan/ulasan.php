<?php
session_start();

$pageTitle = "Kelola Ulasan";
$activePage = "ulasan";

require "../../config/koneksi.php";

include "../partials/header.php";
include "../partials/sidebar.php";

$keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';

if ($keyword != '') {
    $keyword_aman = mysqli_real_escape_string($conn, $keyword);
    $query = "SELECT * FROM ulasan
              WHERE nama_pengunjung LIKE '%$keyword_aman%'
                 OR judul LIKE '%$keyword_aman%'
                 OR komentar LIKE '%$keyword_aman%'
                 OR tipe_kunjungan LIKE '%$keyword_aman%'
                 OR tanggal LIKE '%$keyword_aman%'
              ORDER BY id DESC";
} else {
    $query = "SELECT * FROM ulasan ORDER BY id DESC";
}

$result = mysqli_query($conn, $query);
?>

<h1 class="page-title">Kelola Ulasan</h1>
<p class="page-subtitle">Manage visitor reviews</p>

<form method="GET" class="search-bar">
    <input 
        type="text" 
        name="keyword" 
        placeholder="Cari ulasan..." 
        value="<?= htmlspecialchars($keyword); ?>"
    >

    <button type="submit" class="btn btn-secondary">Cari</button>

    <a href="tambah_ulasan.php" class="btn btn-primary">+ Tambah Ulasan</a>
</form>

<div class="card">
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pengunjung</th>
                    <th>Rating</th>
                    <th>Judul</th>
                    <th>Komentar</th>
                    <th>Tipe Kunjungan</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result && mysqli_num_rows($result) > 0): ?>
                    <?php $no = 1; ?>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><strong><?= htmlspecialchars($row['nama_pengunjung']); ?></strong></td>
                            <td><?= htmlspecialchars($row['rating']); ?> ⭐</td>
                            <td><?= htmlspecialchars($row['judul']); ?></td>
                            <td><?= htmlspecialchars($row['komentar']); ?></td>
                            <td><?= htmlspecialchars($row['tipe_kunjungan']); ?></td>
                            <td><?= htmlspecialchars($row['tanggal']); ?></td>
                            <td class="actions">
                                <a href="edit_ulasan.php?id=<?= $row['id']; ?>" class="icon-btn icon-edit" title="Edit">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <a href="hapus_ulasan.php?id=<?= $row['id']; ?>" 
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
                        <td colspan="8" style="text-align:center; padding:20px;">
                            Data ulasan tidak ditemukan.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include "../partials/footer.php"; ?>