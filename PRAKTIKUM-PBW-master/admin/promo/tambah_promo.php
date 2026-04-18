<?php
$pageTitle = "Tambah Promo";
$activePage = "promo";

require "../../config/koneksi.php";
include "../partials/header.php";
include "../partials/sidebar.php";

if (isset($_POST['simpan'])) {
    $nama_promo      = mysqli_real_escape_string($conn, $_POST['nama_promo']);
    $badge           = mysqli_real_escape_string($conn, $_POST['badge']);
    $kode            = mysqli_real_escape_string($conn, $_POST['kode']);
    $berlaku_sampai  = mysqli_real_escape_string($conn, $_POST['berlaku_sampai']);
    $status          = mysqli_real_escape_string($conn, $_POST['status']);

    $query = "INSERT INTO promo (nama_promo, badge, kode, berlaku_sampai, status)
              VALUES ('$nama_promo', '$badge', '$kode', '$berlaku_sampai', '$status')";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Data promo berhasil ditambahkan!'); window.location='promo.php';</script>";
        exit;
    } else {
        echo "<script>alert('Gagal menambahkan data promo!');</script>";
    }
}
?>

<h1 class="page-title">Tambah Promo</h1>
<p class="page-subtitle">Tambah data promo baru</p>

<div class="card">
    <form method="POST">
        <div class="form-group">
            <label>Nama Promo</label>
            <input type="text" name="nama_promo" placeholder="Masukkan nama promo" required>
        </div>

        <div class="form-group">
            <label>Badge</label>
            <input type="text" name="badge" placeholder="Contoh: 30% OFF / FREE ENTRY" required>
        </div>

        <div class="form-group">
            <label>Kode Promo</label>
            <input type="text" name="kode" placeholder="Contoh: HOLIDAY30">
        </div>

        <div class="form-group">
            <label>Berlaku Sampai</label>
            <input type="date" name="berlaku_sampai" required>
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
            <a href="promo.php" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

<?php include "../partials/footer.php"; ?>