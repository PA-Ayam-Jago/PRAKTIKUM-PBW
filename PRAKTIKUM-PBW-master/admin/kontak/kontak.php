<?php
session_start();
$pageTitle = "Kelola Kontak";
$activePage = "kontak";

require "../../config/koneksi.php";
include "../partials/header.php";
include "../partials/sidebar.php";

$query = "SELECT * FROM kontak ORDER BY id DESC LIMIT 1";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);
?>

<h1 class="page-title">Kelola Kontak</h1>
<p class="page-subtitle">Atur informasi kontak website</p>

<div class="card">
    <?php if ($data): ?>
        <div class="info-grid">
            <div>
                <div class="info-item">
                    <div class="label">Alamat</div>
                    <div class="value"><?= htmlspecialchars($data['alamat']); ?></div>
                </div>

                <div class="info-item">
                    <div class="label">No. Telepon</div>
                    <div class="value"><?= htmlspecialchars($data['telepon']); ?></div>
                </div>

                <div class="info-item">
                    <div class="label">Email</div>
                    <div class="value"><?= htmlspecialchars($data['email']); ?></div>
                </div>
            </div>

            <div>
                <div class="info-item">
                    <div class="label">Instagram</div>
                    <div class="value"><?= htmlspecialchars($data['instagram']); ?></div>
                </div>

                <div class="info-item">
                    <div class="label">Facebook</div>
                    <div class="value"><?= htmlspecialchars($data['facebook']); ?></div>
                </div>

                <div class="info-item">
                    <div class="label">Google Maps Link</div>
                    <div class="value" style="word-break: break-all;"><?= htmlspecialchars($data['google_maps']); ?></div>
                </div>
            </div>
        </div>

        <div style="margin-top: 24px;">
            <a href="edit_kontak.php?id=<?= $data['id']; ?>" class="btn btn-primary">Edit Kontak</a>
        </div>
    <?php else: ?>
        <p>Data kontak belum ada.</p>
        <div style="margin-top: 20px;">
            <a href="edit_kontak.php" class="btn btn-primary">Tambah Data Kontak</a>
        </div>
    <?php endif; ?>
</div>

<?php include "../partials/footer.php"; ?>