<?php
$pageTitle = "Edit Kontak";
$activePage = "kontak";

require "../../config/koneksi.php";
include "../partials/header.php";
include "../partials/sidebar.php";

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

$data = [
    'alamat' => '',
    'telepon' => '',
    'email' => '',
    'instagram' => '',
    'facebook' => '',
    'google_maps' => ''
];

if ($id > 0) {
    $query = "SELECT * FROM kontak WHERE id = $id";
    $result = mysqli_query($conn, $query);
    $editData = mysqli_fetch_assoc($result);

    if ($editData) {
        $data = $editData;
    }
}

if (isset($_POST['simpan'])) {
    $alamat      = mysqli_real_escape_string($conn, $_POST['alamat']);
    $telepon     = mysqli_real_escape_string($conn, $_POST['telepon']);
    $email       = mysqli_real_escape_string($conn, $_POST['email']);
    $instagram   = mysqli_real_escape_string($conn, $_POST['instagram']);
    $facebook    = mysqli_real_escape_string($conn, $_POST['facebook']);
    $google_maps = mysqli_real_escape_string($conn, $_POST['google_maps']);

    if ($id > 0) {
        $update = "UPDATE kontak SET
                    alamat='$alamat',
                    telepon='$telepon',
                    email='$email',
                    instagram='$instagram',
                    facebook='$facebook',
                    google_maps='$google_maps'
                   WHERE id=$id";

        if (mysqli_query($conn, $update)) {
            echo "<script>alert('Data kontak berhasil diupdate!'); window.location='kontak.php';</script>";
            exit;
        } else {
            echo "<script>alert('Gagal update data kontak!');</script>";
        }
    } else {
        $insert = "INSERT INTO kontak (alamat, telepon, email, instagram, facebook, google_maps)
                   VALUES ('$alamat', '$telepon', '$email', '$instagram', '$facebook', '$google_maps')";

        if (mysqli_query($conn, $insert)) {
            echo "<script>alert('Data kontak berhasil ditambahkan!'); window.location='kontak.php';</script>";
            exit;
        } else {
            echo "<script>alert('Gagal menambahkan data kontak!');</script>";
        }
    }
}
?>

<h1 class="page-title">Edit Kontak</h1>
<p class="page-subtitle">Atur informasi kontak website</p>

<div class="card">
    <form method="POST">
        <div class="form-group">
            <label>Alamat</label>
            <textarea name="alamat" placeholder="Masukkan alamat lengkap" required><?= htmlspecialchars($data['alamat']); ?></textarea>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>No. Telepon</label>
                <input type="text" name="telepon" value="<?= htmlspecialchars($data['telepon']); ?>" placeholder="Contoh: 0812-3456-7890" required>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="text" name="email" value="<?= htmlspecialchars($data['email']); ?>" placeholder="Contoh: info@stp.com" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Instagram</label>
                <input type="text" name="instagram" value="<?= htmlspecialchars($data['instagram']); ?>" placeholder="Contoh: @samarindathemepark">
            </div>

            <div class="form-group">
                <label>Facebook</label>
                <input type="text" name="facebook" value="<?= htmlspecialchars($data['facebook']); ?>" placeholder="Contoh: Samarinda Theme Park">
            </div>
        </div>

        <div class="form-group">
            <label>Google Maps Link</label>
            <textarea name="google_maps" placeholder="Tempel link Google Maps di sini"><?= htmlspecialchars($data['google_maps']); ?></textarea>
        </div>

        <div class="btn-group">
            <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
            <a href="kontak.php" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

<?php include "../partials/footer.php"; ?>