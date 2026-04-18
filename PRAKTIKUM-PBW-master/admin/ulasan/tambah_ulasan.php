<?php
$pageTitle = "Tambah Ulasan";
$activePage = "ulasan";

require "../../config/koneksi.php";
include "../partials/header.php";
include "../partials/sidebar.php";

if (isset($_POST['simpan'])) {
    $nama_pengunjung = mysqli_real_escape_string($conn, $_POST['nama_pengunjung']);
    $rating          = (int) $_POST['rating'];
    $judul           = mysqli_real_escape_string($conn, $_POST['judul']);
    $komentar        = mysqli_real_escape_string($conn, $_POST['komentar']);
    $tipe_kunjungan  = mysqli_real_escape_string($conn, $_POST['tipe_kunjungan']);
    $tanggal         = mysqli_real_escape_string($conn, $_POST['tanggal']);

    $query = "INSERT INTO ulasan (nama_pengunjung, rating, judul, komentar, tipe_kunjungan, tanggal)
              VALUES ('$nama_pengunjung', '$rating', '$judul', '$komentar', '$tipe_kunjungan', '$tanggal')";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Data ulasan berhasil ditambahkan!'); window.location='ulasan.php';</script>";
        exit;
    } else {
        echo "<script>alert('Gagal menambahkan data ulasan!');</script>";
    }
}
?>

<h1 class="page-title">Tambah Ulasan</h1>
<p class="page-subtitle">Tambah data ulasan baru</p>

<div class="card">
    <form method="POST">
        <div class="form-group">
            <label>Nama Pengunjung</label>
            <input type="text" name="nama_pengunjung" placeholder="Masukkan nama pengunjung" required>
        </div>

        <div class="form-group">
            <label>Rating</label>
            <select name="rating" required>
                <option value="">-- Pilih Rating --</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
        </div>

        <div class="form-group">
            <label>Judul</label>
            <input type="text" name="judul" placeholder="Masukkan judul ulasan" required>
        </div>

        <div class="form-group">
            <label>Komentar</label>
            <textarea name="komentar" placeholder="Masukkan komentar" required></textarea>
        </div>

        <div class="form-group">
            <label>Tipe Kunjungan</label>
            <input type="text" name="tipe_kunjungan" placeholder="Contoh: Keluarga / Teman / Solo" required>
        </div>

        <div class="form-group">
            <label>Tanggal</label>
            <input type="date" name="tanggal" required>
        </div>

        <div class="btn-group">
            <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
            <a href="ulasan.php" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

<?php include "../partials/footer.php"; ?>