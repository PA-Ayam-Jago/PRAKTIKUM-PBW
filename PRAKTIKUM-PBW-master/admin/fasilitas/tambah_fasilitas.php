<?php
$pageTitle = "Tambah Fasilitas";
$activePage = "fasilitas";

require "../../config/koneksi.php";
include "../partials/header.php";
include "../partials/sidebar.php";

if (isset($_POST['simpan'])) {
    $nama_fasilitas  = mysqli_real_escape_string($conn, $_POST['nama_fasilitas']);
    $deskripsi       = mysqli_real_escape_string($conn, $_POST['deskripsi']);
    $lokasi          = mysqli_real_escape_string($conn, $_POST['lokasi']);
    $jam_operasional = mysqli_real_escape_string($conn, $_POST['jam_operasional']);

    $query = "INSERT INTO fasilitas (nama_fasilitas, deskripsi, lokasi, jam_operasional)
              VALUES ('$nama_fasilitas', '$deskripsi', '$lokasi', '$jam_operasional')";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Data fasilitas berhasil ditambahkan!'); window.location='fasilitas.php';</script>";
        exit;
    } else {
        echo "<script>alert('Gagal menambahkan data fasilitas!');</script>";
    }
}
?>

<h1 class="page-title">Tambah Fasilitas</h1>
<p class="page-subtitle">Tambah data fasilitas baru</p>

<div class="card">
    <form method="POST">
        <div class="form-group">
            <label>Nama Fasilitas</label>
            <input type="text" name="nama_fasilitas" placeholder="Masukkan nama fasilitas" required>
        </div>

        <div class="form-group">
            <label>Deskripsi</label>
            <textarea name="deskripsi" placeholder="Masukkan deskripsi fasilitas" required></textarea>
        </div>

        <div class="form-group">
            <label>Lokasi</label>
            <input type="text" name="lokasi" placeholder="Contoh: Area Barat / Dekat pintu masuk" required>
        </div>

        <div class="form-group">
            <label>Jam Operasional</label>
            <input type="text" name="jam_operasional" placeholder="Contoh: 08.00 - 17.00" required>
        </div>

        <div class="btn-group">
            <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
            <a href="fasilitas.php" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

<?php include "../partials/footer.php"; ?>