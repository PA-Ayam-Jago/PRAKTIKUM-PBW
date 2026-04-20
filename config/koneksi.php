<?php
$conn = mysqli_connect("localhost", "root", "", "stp_db");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>