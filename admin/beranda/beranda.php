<?php
session_start();
$pageTitle = "Kelola Beranda";
$activePage = "beranda";

require "../../config/koneksi.php";
include "../partials/header.php";
include "../partials/sidebar.php";

$query = "SELECT * FROM beranda ORDER BY id DESC LIMIT 1";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);
?>

<h1 class="page-title">Kelola Beranda</h1>
<p class="page-subtitle">Atur konten halaman beranda website</p>

<div class="card">
    <?php if ($data): ?>
        <div class="info-grid">
            <div>
                <div class="info-item">
                    <div class="label">Hero Judul</div>
                    <div class="value"><?= htmlspecialchars($data['hero_judul']); ?></div>
                </div>

                <div class="info-item">
                    <div class="label">Hero Subtitle</div>
                    <div class="value"><?= htmlspecialchars($data['hero_subtitle']); ?></div>
                </div>

                <div class="info-item">
                    <div class="label">Hero Background</div>
                    <div class="value"><?= htmlspecialchars($data['hero_background']); ?></div>
                </div>

                <div class="info-item">
                    <div class="label">Status Now Open</div>
                    <div class="value"><?= htmlspecialchars($data['status_now_open']); ?></div>
                </div>
            </div>

            <div>
                <div class="info-item">
                    <div class="label">Jumlah Atraksi</div>
                    <div class="value"><?= htmlspecialchars($data['jumlah_atraksi']); ?></div>
                </div>

                <div class="info-item">
                    <div class="label">Pengunjung per Tahun</div>
                    <div class="value"><?= htmlspecialchars($data['pengunjung_per_tahun']); ?></div>
                </div>

                <div class="info-item">
                    <div class="label">Rating</div>
                    <div class="value"><?= htmlspecialchars($data['rating']); ?></div>
                </div>
            </div>
        </div>

        <hr style="margin: 24px 0; border: 1px solid #eee;">

        <div class="info-grid">
            <div>
                <div class="info-item">
                    <div class="label">Jam Operasional Hari Kerja</div>
                    <div class="value"><?= htmlspecialchars($data['jam_kerja']); ?></div>
                </div>

                <div class="info-item">
                    <div class="label">Jam Operasional Akhir Pekan</div>
                    <div class="value"><?= htmlspecialchars($data['jam_akhir_pekan']); ?></div>
                </div>

                <div class="info-item">
                    <div class="label">Jam Operasional Hari Libur</div>
                    <div class="value"><?= htmlspecialchars($data['jam_hari_libur']); ?></div>
                </div>
            </div>

            <div>
                <div class="info-item">
                    <div class="label">CTA Text</div>
                    <div class="value"><?= htmlspecialchars($data['cta_text']); ?></div>
                </div>

                <div class="info-item">
                    <div class="label">CTA Button Text</div>
                    <div class="value"><?= htmlspecialchars($data['cta_button']); ?></div>
                </div>
            </div>
        </div>

        <div style="margin-top: 24px;">
            <a href="edit_beranda.php?id=<?= $data['id']; ?>" class="btn btn-primary">Edit Beranda</a>
        </div>
    <?php else: ?>
        <p>Data beranda belum ada.</p>
        <div style="margin-top: 20px;">
            <a href="edit_beranda.php" class="btn btn-primary">Tambah Data Beranda</a>
        </div>
    <?php endif; ?>
</div>

<?php include "../partials/footer.php"; ?>