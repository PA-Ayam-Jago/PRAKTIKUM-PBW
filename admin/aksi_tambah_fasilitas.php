<?php
include '../config/koneksi.php';

$nama   = $_POST['nama_fasilitas'];
$lokasi = $_POST['lokasi'];
$jam    = $_POST['jam_operasional'];
$desk   = $_POST['deskripsi'];

$query = "INSERT INTO fasilitas (nama_fasilitas, lokasi, jam_operasional, deskripsi) 
        VALUES ('$nama', '$lokasi', '$jam', '$desk')";

if(mysqli_query($koneksi, $query)){
    header("location:data_fasilitas.php?pesan=berhasil");
} else {
    echo "Error: " . mysqli_error($koneksi);
}
?>