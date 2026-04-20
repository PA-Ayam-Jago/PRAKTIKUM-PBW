<?php 
include '../config/koneksi.php';
$id = $_GET['id'];
mysqli_query($koneksi, "DELETE FROM fasilitas WHERE id_fasilitas='$id'");
header("location:data_fasilitas.php?pesan=hapus");
?>