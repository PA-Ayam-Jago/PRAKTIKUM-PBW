<?php
$pageTitle = "Edit Tiket";
$activePage = "tiket";

require "../../config/koneksi.php";
include "../partials/header.php";
include "../partials/sidebar.php";

if (!isset($_GET['id'])) {
    echo "<script>alert('ID tiket tidak ditemukan!'); window.location='tiket.php';</script>";
    exit;
}

$id = (int) $_GET['id'];
$query = "SELECT * FROM tiket WHERE id = $id";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

if (!$data) {
    echo "<script>alert('Data tiket tidak ditemukan!'); window.location='tiket.php';</script>";
    exit;
}

if (isset($_POST['update'])) {
    $nama_tiket = mysqli_real_escape_string($conn, $_POST['nama_tiket']);
    $deskripsi  = mysqli_real_escape_string($conn, $_POST['deskripsi']);
    $harga      = (int) $_POST['harga'];
    $status     = mysqli_real_escape_string($conn, $_POST['status']);

    $update = "UPDATE tiket 
               SET nama_tiket='$nama_tiket',
                   deskripsi='$deskripsi',
                   harga='$harga',
                   status='$status'
               WHERE id=$id";

    if (mysqli_query($conn, $update)) {
        echo "<script>alert('Data tiket berhasil diupdate!'); window.location='tiket.php';</script>";
        exit;
    } else {
        echo "<script>alert('Gagal update data tiket!');</script>";
    }
}
?>

<h1 class="page-title">Edit Tiket</h1>
<p class="page-subtitle">Ubah data tiket</p>

<div class="card">
    <form method="POST">
        <div class="form-group">
            <label>Nama Tiket</label>
            <input type="text" name="nama_tiket" value="<?= htmlspecialchars($data['nama_tiket']); ?>" required>
        </div>

        <div class="form-group">
            <label>Deskripsi</label>
            <textarea name="deskripsi" required><?= htmlspecialchars($data['deskripsi']); ?></textarea>
        </div>

        <div class="form-group">
            <label>Harga</label>
            <input type="number" name="harga" value="<?= htmlspecialchars($data['harga']); ?>" required>
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
            <a href="tiket.php" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

<?php include "../partials/footer.php"; ?>