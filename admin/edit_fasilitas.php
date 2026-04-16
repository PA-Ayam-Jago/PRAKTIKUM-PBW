<?php 
include '../config/koneksi.php';

$id     = $_POST['id'];
$nama   = $_POST['nama'];
$lokasi = $_POST['lokasi'];

// Update ke database
mysqli_query($koneksi, "UPDATE fasilitas SET nama_fasilitas='$nama', lokasi='$lokasi' WHERE id_fasilitas='$id'");

// Kembalikan ke halaman data_fasilitas
header("location:data_fasilitas.php?pesan=update");
?>