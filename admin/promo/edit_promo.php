<?php
$pageTitle = "Edit Promo";
$activePage = "promo";

require "../../config/koneksi.php";
include "../partials/header.php";
include "../partials/sidebar.php";

if (!isset($_GET['id'])) {
    echo "<script>alert('ID promo tidak ditemukan!'); window.location='promo.php';</script>";
    exit;
}

$id = (int) $_GET['id'];
$query = "SELECT * FROM promo WHERE id = $id";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

if (!$data) {
    echo "<script>alert('Data promo tidak ditemukan!'); window.location='promo.php';</script>";
    exit;
}

if (isset($_POST['update'])) {
    $nama_promo      = mysqli_real_escape_string($conn, $_POST['nama_promo']);
    $badge           = mysqli_real_escape_string($conn, $_POST['badge']);
    $kode            = mysqli_real_escape_string($conn, $_POST['kode']);
    $berlaku_sampai  = mysqli_real_escape_string($conn, $_POST['berlaku_sampai']);
    $status          = mysqli_real_escape_string($conn, $_POST['status']);

    $update = "UPDATE promo
               SET nama_promo='$nama_promo',
                   badge='$badge',
                   kode='$kode',
                   berlaku_sampai='$berlaku_sampai',
                   status='$status'
               WHERE id=$id";

    if (mysqli_query($conn, $update)) {
        echo "<script>alert('Data promo berhasil diupdate!'); window.location='promo.php';</script>";
        exit;
    } else {
        echo "<script>alert('Gagal update data promo!');</script>";
    }
}
?>

<h1 class="page-title">Edit Promo</h1>
<p class="page-subtitle">Ubah data promo</p>

<div class="card">
    <form method="POST">
        <div class="form-group">
            <label>Nama Promo</label>
            <input type="text" name="nama_promo" value="<?= htmlspecialchars($data['nama_promo']); ?>" required>
        </div>

        <div class="form-group">
            <label>Badge</label>
            <input type="text" name="badge" value="<?= htmlspecialchars($data['badge']); ?>" required>
        </div>

        <div class="form-group">
            <label>Kode Promo</label>
            <input type="text" name="kode" value="<?= htmlspecialchars($data['kode']); ?>">
        </div>

        <div class="form-group">
            <label>Berlaku Sampai</label>
            <input type="date" name="berlaku_sampai" value="<?= htmlspecialchars($data['berlaku_sampai']); ?>" required>
        </div>

        <div class="form-group">
            <label>Status</label>
            <select name="status" required>
                <option value="Aktif" <?= $data['status'] == 'Aktif' ? 'selected' : ''; ?>>Aktif</option>
                <option value="Nonaktif" <?= $data['status'] == 'Nonaktif' ? 'selected' : ''; ?>>Nonaktif</option>
            </select>
        </div>

        <div class="btn-group">
            <button type="submit" name="update" class="btn btn-success">Update</button>
            <a href="promo.php" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

<?php include "../partials/footer.php"; ?>