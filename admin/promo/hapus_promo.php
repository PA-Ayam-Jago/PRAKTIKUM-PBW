<?php
require "../../config/koneksi.php";

if (!isset($_GET['id'])) {
    echo "<script>alert('ID promo tidak ditemukan!'); window.location='promo.php';</script>";
    exit;
}

$id = (int) $_GET['id'];

$query = "DELETE FROM promo WHERE id = $id";

if (mysqli_query($conn, $query)) {
    echo "<script>alert('Data promo berhasil dihapus!'); window.location='promo.php';</script>";
} else {
    echo "<script>alert('Gagal menghapus data promo!'); window.location='promo.php';</script>";
}