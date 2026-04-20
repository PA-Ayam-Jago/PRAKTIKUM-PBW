<?php
require "../../config/koneksi.php";

if (!isset($_GET['id'])) {
    echo "<script>alert('ID tiket tidak ditemukan!'); window.location='tiket.php';</script>";
    exit;
}

$id = (int) $_GET['id'];

$query = "DELETE FROM tiket WHERE id = $id";

if (mysqli_query($conn, $query)) {
    echo "<script>alert('Data tiket berhasil dihapus!'); window.location='tiket.php';</script>";
} else {
    echo "<script>alert('Gagal menghapus data tiket!'); window.location='tiket.php';</script>";
}