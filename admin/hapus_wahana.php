<?php 
include '../config/koneksi.php';
$id = $_GET['id'];

// Hapus data berdasarkan id_wahana
mysqli_query($koneksi, "DELETE FROM wahana WHERE id_wahana='$id'");

header("location:data_wahana.php?pesan=hapus");
?>