<?php
$pageTitle = "Ubah Password";
$activePage = "akun_admin";

require "../../config/koneksi.php";
include "../partials/header.php";
include "../partials/sidebar.php";

if (!isset($_GET['id'])) {
    echo "<script>alert('ID admin tidak ditemukan!'); window.location='akun_admin.php';</script>";
    exit;
}

$id = (int) $_GET['id'];
$query = "SELECT * FROM admin_users WHERE id = $id";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

if (!$data) {
    echo "<script>alert('Data admin tidak ditemukan!'); window.location='akun_admin.php';</script>";
    exit;
}

if (isset($_POST['ubah'])) {
    $password_baru = $_POST['password_baru'];
    $konfirmasi    = $_POST['konfirmasi_password'];

    if ($password_baru != $konfirmasi) {
        echo "<script>alert('Konfirmasi password tidak sama!');</script>";
    } elseif (strlen($password_baru) < 6) {
        echo "<script>alert('Password minimal 6 karakter!');</script>";
    } else {
        $passwordHash = md5($password_baru);
        $update = "UPDATE admin_users SET password = '$passwordHash' WHERE id = $id";

        if (mysqli_query($conn, $update)) {
            echo "<script>alert('Password berhasil diubah!'); window.location='akun_admin.php';</script>";
            exit;
        } else {
            echo "<script>alert('Gagal mengubah password!');</script>";
        }
    }
}
?>

<h1 class="page-title">Ubah Password</h1>
<p class="page-subtitle">Ubah password admin</p>

<div class="card">
    <form method="POST">
        <div class="form-group">
            <label>Username</label>
            <input type="text" value="<?= htmlspecialchars($data['username']); ?>" readonly>
        </div>

        <div class="form-group">
            <label>Password Baru</label>
            <input type="password" name="password_baru" required>
        </div>

        <div class="form-group">
            <label>Konfirmasi Password</label>
            <input type="password" name="konfirmasi_password" required>
        </div>

        <div class="btn-group">
            <button type="submit" name="ubah" class="btn btn-success">Simpan Password</button>
            <a href="akun_admin.php" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

<?php include "../partials/footer.php"; ?>