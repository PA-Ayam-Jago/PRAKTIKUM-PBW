<?php
session_start();
require '../config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $query = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['admin'] = $row['username'];
        $_SESSION['nama'] = $row['nama_lengkap'];
        
        header("Location: ../admin/dashboard.php");
        exit;
    } else {
        header("Location: login.php?error=1");
        exit;
    }
}