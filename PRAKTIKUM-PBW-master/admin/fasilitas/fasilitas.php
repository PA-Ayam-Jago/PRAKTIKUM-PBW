<?php
session_start();
$pageTitle = "Kelola Fasilitas";
$activePage = "fasilitas";

require "../../config/koneksi.php";
include "../partials/header.php";
include "../partials/sidebar.php";

$keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';

if ($keyword != '') {
    $keyword_aman = mysqli_real_escape_string($conn, $keyword);
    $query = "SELECT * FROM fasilitas
              WHERE nama_fasilitas LIKE '%$keyword_aman%'
                 OR deskripsi LIKE '%$keyword_aman%'
                 OR lokasi LIKE '%$keyword_aman%'
                 OR jam_operasional LIKE '%$keyword_aman%'
              ORDER BY id DESC";
} else {
    $query = "SELECT * FROM fasilitas ORDER BY id DESC";
}

$result = mysqli_query($conn, $query);
?>

<h1 class="page-title">Kelola Fasilitas</h1>
<p class="page-subtitle">Manage attractions and rides</p>

<form method="GET" class="search-bar">
    <input 
        type="text" 
        name="keyword" 
        placeholder="Cari fasilitas..." 
        value="<?= htmlspecialchars($keyword); ?>"
    >

    <button type="submit" class="btn btn-secondary">Cari</button>

    <a href="tambah_fasilitas.php" class="btn btn-primary">+ Tambah Fasilitas</a>
</form>

<div class="card">
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Fasilitas</th>
                    <th>Deskripsi</th>
                    <th>Lokasi</th>
                    <th>Jam Operasional</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result && mysqli_num_rows($result) > 0): ?>
                    <?php $no = 1; ?>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><strong><?= htmlspecialchars($row['nama_fasilitas']); ?></strong></td>
                            <td><?= htmlspecialchars($row['deskripsi']); ?></td>
                            <td><?= htmlspecialchars($row['lokasi']); ?></td>
                            <td><?= htmlspecialchars($row['jam_operasional']); ?></td>
                            <td class="actions">
                                <a href="edit_fasilitas.php?id=<?= $row['id']; ?>" class="icon-btn icon-edit" title="Edit">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <a href="hapus_fasilitas.php?id=<?= $row['id']; ?>" 
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
                            Data fasilitas tidak ditemukan.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include "../partials/footer.php"; ?>