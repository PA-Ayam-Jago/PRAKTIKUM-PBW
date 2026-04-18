<?php
session_start();
require "../config/koneksi.php";

$username = isset($_POST['username']) ? mysqli_real_escape_string($conn, $_POST['username']) : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

$query = "SELECT * FROM admin_users WHERE username = '$username' LIMIT 1";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

if ($data) {
    if ($data['password'] == md5($password)) {
        $_SESSION['login'] = true;
        $_SESSION['id_admin'] = $data['id'];
        $_SESSION['username'] = $data['username'];
        $_SESSION['nama_lengkap'] = $data['nama_lengkap'];
        $_SESSION['role'] = $data['role'];

        header("Location: ../admin/dashboard.php");
        exit;
    } else {
        echo "<script>alert('Password salah!'); window.location='login.php';</script>";
    }
} else {
    echo "<script>alert('Username tidak ditemukan!'); window.location='login.php';</script>";
}