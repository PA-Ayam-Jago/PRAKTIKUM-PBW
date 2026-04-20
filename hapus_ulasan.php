<?php
require 'config/koneksi.php';

$id = $_POST['id_ulasan'];
$nama = $_POST['nama_pengunjung'];
$rating = $_POST['rating'];
$komentar = $_POST['komentar'];

$sql = "UPDATE ulasan 
        SET nama_pengunjung=?, rating=?, komentar=? 
        WHERE id_ulasan=?";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "sisi", $nama, $rating, $komentar, $id);
mysqli_stmt_execute($stmt);

header("Location: review.php");
exit;
?>