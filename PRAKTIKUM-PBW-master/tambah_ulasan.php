<?php
require 'config/koneksi.php';

$nama = $_POST['nama_pengunjung'];
$rating = $_POST['rating'];
$komentar = $_POST['komentar'];

$sql = "INSERT INTO ulasan (nama_pengunjung, rating, komentar) VALUES (?, ?, ?)";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "sis", $nama, $rating, $komentar);
mysqli_stmt_execute($stmt);

header("Location: review.php");
exit;
?>