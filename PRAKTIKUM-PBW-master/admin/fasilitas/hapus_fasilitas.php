<?php
require "../../config/koneksi.php";

if (!isset($_GET['id'])) {
    echo "<script>alert('ID fasilitas tidak ditemukan!'); window.location='fasilitas.php';</script>";
    exit;
}

$id = (int) $_GET['id'];

$query = "DELETE FROM fasilitas WHERE id = $id";

if (mysqli_query($conn, $query)) {
    echo "<script>alert('Data fasilitas berhasil dihapus!'); window.location='fasilitas.php';</script>";
} else {
    echo "<script>alert('Gagal menghapus data fasilitas!'); window.location='fasilitas.php';</script>";
}