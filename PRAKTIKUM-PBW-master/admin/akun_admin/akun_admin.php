<?php
session_start();
$pageTitle = "Akun Admin";
$activePage = "akun_admin";

require "../../config/koneksi.php";
include "../partials/header.php";
include "../partials/sidebar.php";

// Ambil admin pertama sebagai profil utama sementara
$queryProfil = "SELECT * FROM admin_users ORDER BY id ASC LIMIT 1";
$resultProfil = mysqli_query($conn, $queryProfil);
$profil = mysqli_fetch_assoc($resultProfil);

// Search admin
$keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';

if ($keyword != '') {
    $keyword_aman = mysqli_real_escape_string($conn, $keyword);
    $query = "SELECT * FROM admin_users
              WHERE username LIKE '%$keyword_aman%'
                 OR nama_lengkap LIKE '%$keyword_aman%'
                 OR role LIKE '%$keyword_aman%'
                 OR status LIKE '%$keyword_aman%'
              ORDER BY id DESC";
} else {
    $query = "SELECT * FROM admin_users ORDER BY id DESC";
}

$result = mysqli_query($conn, $query);
?>

<h1 class="page-title">Akun Admin</h1>
<p class="page-subtitle">Kelola akun admin website</p>

<div class="card">
    <div style="display:flex; justify-content:space-between; align-items:center; gap:16px; flex-wrap:wrap;">
        <div>
            <h3 class="card-title" style="margin-bottom:10px;">Informasi Admin</h3>
            <?php if ($profil): ?>
                <div class="info-grid">
                    <div>
                        <div class="info-item">
                            <div class="label">Username</div>
                            <div class="value"><?= htmlspecialchars($profil['username']); ?></div>
                        </div>
                        <div class="info-item">
                            <div class="label">Nama Lengkap</div>
                            <div class="value"><?= htmlspecialchars($profil['nama_lengkap']); ?></div>
                        </div>
                    </div>
                    <div>
                        <div class="info-item">
                            <div class="label">Role</div>
                            <div class="value"><?= htmlspecialchars($profil['role']); ?></div>
                        </div>
                        <div class="info-item">
                            <div class="label">Status</div>
                            <div class="value" style="color:green;"><?= htmlspecialchars($profil['status']); ?></div>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <p>Belum ada data admin.</p>
            <?php endif; ?>
        </div>

        <div>
            <a href="ubah_password.php<?= $profil ? '?id=' . $profil['id'] : ''; ?>" class="btn btn-primary">Ubah Password</a>
        </div>
    </div>
</div>

<form method="GET" class="search-bar">
    <input type="text" name="keyword" placeholder="Cari admin..." value="<?= htmlspecialchars($keyword); ?>">
    <button type="submit" class="btn btn-secondary">Cari</button>
    <a href="tambah_admin.php" class="btn btn-primary">+ Tambah Admin</a>
</form>

<div class="card">
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Nama Lengkap</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result && mysqli_num_rows($result) > 0): ?>
                    <?php $no = 1; ?>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <?php
                        if ($row['status'] == 'Active') {
                            $statusClass = 'badge-green';
                        } elseif ($row['status'] == 'Nonaktif') {
                            $statusClass = 'badge-pink';
                        } else {
                            $statusClass = 'badge-secondary';
                        }

                        if ($row['role'] == 'Super Admin') {
                            $roleClass = 'badge-purple';
                        } elseif ($row['role'] == 'Manager') {
                            $roleClass = 'badge-blue';
                        } else {
                            $roleClass = 'badge-secondary';
                        }
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= htmlspecialchars($row['username']); ?></td>
                            <td><?= htmlspecialchars($row['nama_lengkap']); ?></td>
                            <td><span class="badge <?= $roleClass; ?>"><?= htmlspecialchars($row['role']); ?></span></td>
                            <td><span class="badge <?= $statusClass; ?>"><?= htmlspecialchars($row['status']); ?></span></td>
                            <td class="actions">
                                <a href="edit_admin.php?id=<?= $row['id']; ?>" class="icon-btn icon-edit" title="Edit">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <a href="hapus_admin.php?id=<?= $row['id']; ?>" 
                                   class="icon-btn icon-delete" 
                                   title="Hapus"
                                   onclick="return confirm('Yakin ingin menghapus admin ini?')">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" style="text-align:center; padding:20px;">
                            Data admin tidak ditemukan.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include "../partials/footer.php"; ?>