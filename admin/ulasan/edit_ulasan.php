<?php
$pageTitle = "Edit Ulasan";
$activePage = "ulasan";

require "../../config/koneksi.php";
include "../partials/header.php";
include "../partials/sidebar.php";

if (!isset($_GET['id'])) {
    echo "<script>alert('ID ulasan tidak ditemukan!'); window.location='ulasan.php';</script>";
    exit;
}

$id = (int) $_GET['id'];
$query = "SELECT * FROM ulasan WHERE id = $id";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

if (!$data) {
    echo "<script>alert('Data ulasan tidak ditemukan!'); window.location='ulasan.php';</script>";
    exit;
}

if (isset($_POST['update'])) {
    $nama_pengunjung = mysqli_real_escape_string($conn, $_POST['nama_pengunjung']);
    $rating          = (int) $_POST['rating'];
    $judul           = mysqli_real_escape_string($conn, $_POST['judul']);
    $komentar        = mysqli_real_escape_string($conn, $_POST['komentar']);
    $tipe_kunjungan  = mysqli_real_escape_string($conn, $_POST['tipe_kunjungan']);
    $tanggal         = mysqli_real_escape_string($conn, $_POST['tanggal']);

    $update = "UPDATE ulasan
               SET nama_pengunjung='$nama_pengunjung',
                   rating='$rating',
                   judul='$judul',
                   komentar='$komentar',
                   tipe_kunjungan='$tipe_kunjungan',
                   tanggal='$tanggal'
               WHERE id=$id";

    if (mysqli_query($conn, $update)) {
        echo "<script>alert('Data ulasan berhasil diupdate!'); window.location='ulasan.php';</script>";
        exit;
    } else {
        echo "<script>alert('Gagal update data ulasan!');</script>";
    }
}
?>

<h1 class="page-title">Edit Ulasan</h1>
<p class="page-subtitle">Ubah data ulasan</p>

<div class="card">
    <form method="POST">
        <div class="form-group">
            <label>Nama Pengunjung</label>
            <input type="text" name="nama_pengunjung" value="<?= htmlspecialchars($data['nama_pengunjung']); ?>" required>
        </div>

        <div class="form-group">
            <label>Rating</label>
            <select name="rating" required>
                <option value="1" <?= $data['rating'] == '1' ? 'selected' : ''; ?>>1</option>
                <option value="2" <?= $data['rating'] == '2' ? 'selected' : ''; ?>>2</option>
                <option value="3" <?= $data['rating'] == '3' ? 'selected' : ''; ?>>3</option>
                <option value="4" <?= $data['rating'] == '4' ? 'selected' : ''; ?>>4</option>
                <option value="5" <?= $data['rating'] == '5' ? 'selected' : ''; ?>>5</option>
            </select>
        </div>

        <div class="form-group">
            <label>Judul</label>
            <input type="text" name="judul" value="<?= htmlspecialchars($data['judul']); ?>" required>
        </div>

        <div class="form-group">
            <label>Komentar</label>
            <textarea name="komentar" required><?= htmlspecialchars($data['komentar']); ?></textarea>
        </div>

        <div class="form-group">
            <label>Tipe Kunjungan</label>
            <input type="text" name="tipe_kunjungan" value="<?= htmlspecialchars($data['tipe_kunjungan']); ?>" required>
        </div>

        <div class="form-group">
            <label>Tanggal</label>
            <input type="date" name="tanggal" value="<?= htmlspecialchars($data['tanggal']); ?>" required>
        </div>

        <div class="btn-group">
            <button type="submit" name="update" class="btn btn-success">Update</button>
            <a href="ulasan.php" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

<?php include "../partials/footer.php"; ?>