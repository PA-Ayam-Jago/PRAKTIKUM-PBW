<?php
require "../../config/koneksi.php";

if (!isset($_GET['id'])) {
    echo "<script>alert('ID admin tidak ditemukan!'); window.location='akun_admin.php';</script>";
    exit;
}

$id = (int) $_GET['id'];

$query = "DELETE FROM admin_users WHERE id = $id";

if (mysqli_query($conn, $query)) {
    echo "<script>alert('Data admin berhasil dihapus!'); window.location='akun_admin.php';</script>";
} else {
    echo "<script>alert('Gagal menghapus admin!'); window.location='akun_admin.php';</script>";
}