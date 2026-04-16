<?php 
require '../koneksi.php';

$id = $_GET['id'];

$data = mysqli_query($koneksi, "SELECT foto FROM wahana WHERE id_wahana='$id'");
$d = mysqli_fetch_array($data);
$foto = $d['foto'];

if(file_exists("../uploads/".$foto)){
    unlink("../uploads/".$foto);
}

mysqli_query($koneksi, "DELETE FROM wahana WHERE id_wahana='$id'");

header("location:data_wahana.php?pesan=hapus");
?>