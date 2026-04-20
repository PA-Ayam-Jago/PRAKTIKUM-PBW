<?php
$pageTitle = "Edit Fasilitas";
$activePage = "fasilitas";

require "../../config/koneksi.php";
include "../partials/header.php";
include "../partials/sidebar.php";

if (!isset($_GET['id'])) {
    echo "<script>alert('ID fasilitas tidak ditemukan!'); window.location='fasilitas.php';</script>";
    exit;
}

$id = (int) $_GET['id'];
$query = "SELECT * FROM fasilitas WHERE id = $id";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

if (!$data) {
    echo "<script>alert('Data fasilitas tidak ditemukan!'); window.location='fasilitas.php';</script>";
    exit;
}

if (isset($_POST['update'])) {
    $nama_fasilitas  = mysqli_real_escape_string($conn, $_POST['nama_fasilitas']);
    $deskripsi       = mysqli_real_escape_string($conn, $_POST['deskripsi']);
    $lokasi          = mysqli_real_escape_string($conn, $_POST['lokasi']);
    $jam_operasional = mysqli_real_escape_string($conn, $_POST['jam_operasional']);

    $update = "UPDATE fasilitas 
               SET nama_fasilitas='$nama_fasilitas',
                   deskripsi='$deskripsi',
                   lokasi='$lokasi',
                   jam_operasional='$jam_operasional'
               WHERE id=$id";

    if (mysqli_query($conn, $update)) {
        echo "<script>alert('Data fasilitas berhasil diupdate!'); window.location='fasilitas.php';</script>";
        exit;
    } else {
        echo "<script>alert('Gagal update data fasilitas!');</script>";
    }
}
?>

<h1 class="page-title">Edit Fasilitas</h1>
<p class="page-subtitle">Ubah data fasilitas</p>

<div class="card">
    <form method="POST">
        <div class="form-group">
            <label>Nama Fasilitas</label>
            <input type="text" name="nama_fasilitas" value="<?= htmlspecialchars($data['nama_fasilitas']); ?>" required>
        </div>

        <div class="form-group">
            <label>Deskripsi</label>
            <textarea name="deskripsi" required><?= htmlspecialchars($data['deskripsi']); ?></textarea>
        </div>

        <div class="form-group">
            <label>Lokasi</label>
            <input type="text" name="lokasi" value="<?= htmlspecialchars($data['lokasi']); ?>" required>
        </div>

        <div class="form-group">
            <label>Jam Operasional</label>
            <input type="text" name="jam_operasional" value="<?= htmlspecialchars($data['jam_operasional']); ?>" required>
        </div>

        <div class="btn-group">
            <button type="submit" name="update" class="btn btn-success">Update</button>
            <a href="fasilitas.php" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

<?php include "../partials/footer.php"; ?>