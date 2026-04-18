<?php
$pageTitle = "Edit Admin";
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

if (isset($_POST['update'])) {
    $username     = mysqli_real_escape_string($conn, trim($_POST['username']));
    $nama_lengkap = mysqli_real_escape_string($conn, trim($_POST['nama_lengkap']));
    $role         = mysqli_real_escape_string($conn, $_POST['role']);
    $status       = mysqli_real_escape_string($conn, $_POST['status']);

    $cek = mysqli_query($conn, "SELECT * FROM admin_users WHERE username = '$username' AND id != $id");
    if (mysqli_num_rows($cek) > 0) {
        echo "<script>alert('Username sudah digunakan admin lain!');</script>";
    } else {
        $update = "UPDATE admin_users
                   SET username='$username',
                       nama_lengkap='$nama_lengkap',
                       role='$role',
                       status='$status'
                   WHERE id=$id";

        if (mysqli_query($conn, $update)) {
            echo "<script>alert('Data admin berhasil diupdate!'); window.location='akun_admin.php';</script>";
            exit;
        } else {
            echo "<script>alert('Gagal update admin!');</script>";
        }
    }
}
?>

<h1 class="page-title">Edit Admin</h1>
<p class="page-subtitle">Ubah data admin</p>

<div class="card">
    <form method="POST">
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" value="<?= htmlspecialchars($data['username']); ?>" required>
        </div>

        <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" name="nama_lengkap" value="<?= htmlspecialchars($data['nama_lengkap']); ?>" required>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Role</label>
                <select name="role" required>
                    <option value="Super Admin" <?= $data['role'] == 'Super Admin' ? 'selected' : ''; ?>>Super Admin</option>
                    <option value="Manager" <?= $data['role'] == 'Manager' ? 'selected' : ''; ?>>Manager</option>
                    <option value="Admin" <?= $data['role'] == 'Admin' ? 'selected' : ''; ?>>Admin</option>
                </select>
            </div>

            <div class="form-group">
                <label>Status</label>
                <select name="status" required>
                    <option value="Active" <?= $data['status'] == 'Active' ? 'selected' : ''; ?>>Active</option>
                    <option value="Nonaktif" <?= $data['status'] == 'Nonaktif' ? 'selected' : ''; ?>>Nonaktif</option>
                </select>
            </div>
        </div>

        <div class="btn-group">
            <button type="submit" name="update" class="btn btn-success">Update</button>
            <a href="akun_admin.php" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

<?php include "../partials/footer.php"; ?>