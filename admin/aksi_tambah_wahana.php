<?php
include '../config/koneksi.php';

// Tangkap data dari form
$nama      = mysqli_real_escape_string($koneksi, $_POST['nama_wahana']);
$kategori  = $_POST['kategori'];
$intensity = $_POST['intensity'];
$kapasitas = mysqli_real_escape_string($koneksi, $_POST['kapasitas']);
$durasi    = mysqli_real_escape_string($koneksi, $_POST['durasi']);
$deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);

// Pengaturan Upload Foto
$rand = rand();
$filename = $_FILES['foto']['name'];
$tmp = $_FILES['foto']['tmp_name'];

if($filename != ""){
    $xx = $rand.'_'.$filename;
    move_uploaded_file($tmp, '../assets/img/wahana/'.$xx);
    $query = "INSERT INTO wahana (nama_wahana, kategori, intensity, kapasitas, durasi, deskripsi, foto) 
            VALUES ('$nama', '$kategori', '$intensity', '$kapasitas', '$durasi', '$deskripsi', '$xx')";
} else {
    $query = "INSERT INTO wahana (nama_wahana, kategori, intensity, kapasitas, durasi, deskripsi) 
        VALUES ('$nama', '$kategori', '$intensity', '$kapasitas', '$durasi', '$deskripsi')";
}

// Jalankan Query
if(mysqli_query($koneksi, $query)){
    header("location:data_wahana.php?pesan=berhasil");
} else {
    // Menampilkan error jika kolom di database tidak cocok
    die("Gagal Simpan Data: " . mysqli_error($koneksi));
}
?>