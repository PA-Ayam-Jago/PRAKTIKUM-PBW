<?php
include '../config/koneksi.php';

// Tangkap data dari form edit_wahana.php
$id        = $_POST['id_wahana'];
$nama      = mysqli_real_escape_string($koneksi, $_POST['nama_wahana']);
$kategori  = $_POST['kategori'];
$intensity = $_POST['intensity'];
$kapasitas = mysqli_real_escape_string($koneksi, $_POST['kapasitas']);
$durasi    = mysqli_real_escape_string($koneksi, $_POST['durasi']);
$deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);

$filename = $_FILES['foto']['name'];

if($filename != ""){
    // Jika ganti foto
    $rand = rand();
    $foto_baru = $rand.'_'.$filename;
    move_uploaded_file($_FILES['foto']['tmp_name'], '../assets/img/wahana/'.$foto_baru);
    
    // Update dengan foto baru
    $query = "UPDATE wahana SET 
            nama_wahana='$nama', 
            kategori='$kategori', 
            intensity='$intensity', 
            kapasitas='$kapasitas', 
            durasi='$durasi', 
            deskripsi='$deskripsi', 
            foto='$foto_baru' 
            WHERE id_wahana='$id'";
} else {
    // Update tanpa ganti foto
    $query = "UPDATE wahana SET 
            nama_wahana='$nama', 
            kategori='$kategori', 
            intensity='$intensity', 
            kapasitas='$kapasitas', 
            durasi='$durasi', 
            deskripsi='$deskripsi' 
            WHERE id_wahana='$id'";
}

if(mysqli_query($koneksi, $query)){
    header("location:data_wahana.php?pesan=update");
} else {
    die("Error Update: " . mysqli_error($koneksi));
}
?>