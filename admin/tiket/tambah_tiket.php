<?php
$pageTitle = "Tambah Tiket";
$activePage = "tiket";

require "../../config/koneksi.php";
include "../partials/header.php";
include "../partials/sidebar.php";

if (isset($_POST['simpan'])) {
    $nama_tiket = mysqli_real_escape_string($conn, $_POST['nama_tiket']);
    $deskripsi  = mysqli_real_escape_string($conn, $_POST['deskripsi']);
    $harga      = (int) $_POST['harga'];
    $status     = mysqli_real_escape_string($conn, $_POST['status']);

    $query = "INSERT INTO tiket (nama_tiket, deskripsi, harga, status)
              VALUES ('$nama_tiket', '$deskripsi', '$harga', '$status')";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Data tiket berhasil ditambahkan!'); window.location='tiket.php';</script>";
        exit;
    } else {
        echo "<script>alert('Gagal menambahkan data tiket!');</script>";
    }
}
?>

<h1 class="page-title">Tambah Tiket</h1>
<p class="page-subtitle">Tambah data tiket baru</p>

<div class="card">
    <form method="POST">
        <div class="form-group">
            <label>Nama Tiket</label>
            <input type="text" name="nama_tiket" placeholder="Masukkan nama tiket" required>
        </div>

        <div class="form-group">
            <label>Deskripsi</label>
            <textarea name="deskripsi" placeholder="Masukkan deskripsi tiket" required></textarea>
        </div>

        <div class="form-group">
            <label>Harga</label>
            <input type="number" name="harga" placeholder="Contoh: 75000" required>
        </div>

        <div class="form-group">
            <label>Status</label>
            <select name="status" required>
                <option value="">-- Pilih Status --</option>
                <option value="Aktif">Aktif</option>
                <option value="Nonaktif">Nonaktif</option>
            </select>
        </div>

        <div class="btn-group">
            <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
            <a href="tiket.php" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

<?php include "../partials/footer.php"; ?>