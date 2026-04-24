<?php
require "../../config/koneksi.php";

if (!isset($_GET['id'])) {
    echo "<script>alert('ID ulasan tidak ditemukan!'); window.location='ulasan.php';</script>";
    exit;
}

$id = (int) $_GET['id'];

$query = "DELETE FROM ulasan WHERE id = $id";

if (mysqli_query($conn, $query)) {
    echo "<script>alert('Data ulasan berhasil dihapus!'); window.location='ulasan.php';</script>";
} else {
    echo "<script>alert('Gagal menghapus data ulasan!'); window.location='ulasan.php';</script>";
}