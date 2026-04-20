<?php
$pageTitle = "Tambah Admin";
$activePage = "akun_admin";

require "../../config/koneksi.php";
include "../partials/header.php";
include "../partials/sidebar.php";

if (isset($_POST['simpan'])) {
    $username     = mysqli_real_escape_string($conn, trim($_POST['username']));
    $nama_lengkap = mysqli_real_escape_string($conn, trim($_POST['nama_lengkap']));
    $password     = mysqli_real_escape_string($conn, $_POST['password']);
    $role         = mysqli_real_escape_string($conn, $_POST['role']);
    $status       = mysqli_real_escape_string($conn, $_POST['status']);

    $cek = mysqli_query($conn, "SELECT * FROM admin_users WHERE username = '$username'");
    if (mysqli_num_rows($cek) > 0) {
        echo "<script>alert('Username sudah digunakan!');</script>";
    } else {
        $passwordHash = md5($password);

        $query = "INSERT INTO admin_users (username, nama_lengkap, password, role, status)
                  VALUES ('$username', '$nama_lengkap', '$passwordHash', '$role', '$status')";

        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Admin berhasil ditambahkan!'); window.location='akun_admin.php';</script>";
            exit;
        } else {
            echo "<script>alert('Gagal menambahkan admin!');</script>";
        }
    }
}
?>

<h1 class="page-title">Tambah Admin</h1>
<p class="page-subtitle">Tambah akun admin baru</p>

<div class="card">
    <form method="POST">
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" required>
        </div>

        <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" name="nama_lengkap" required>
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" required>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Role</label>
                <select name="role" required>
                    <option value="">-- Pilih Role --</option>
                    <option value="Super Admin">Super Admin</option>
                    <option value="Manager">Manager</option>
                    <option value="Admin">Admin</option>
                </select>
            </div>

            <div class="form-group">
                <label>Status</label>
                <select name="status" required>
                    <option value="">-- Pilih Status --</option>
                    <option value="Active">Active</option>
                    <option value="Nonaktif">Nonaktif</option>
                </select>
            </div>
        </div>

        <div class="btn-group">
            <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
            <a href="akun_admin.php" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

<?php include "../partials/footer.php"; ?>