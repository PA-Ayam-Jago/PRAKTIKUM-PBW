<?php 
session_start();
$koneksi = mysqli_connect("localhost", "root", "", "database_stp");

if (!$koneksi) {
    die("Koneksi ke database_stp GAGAL: " . mysqli_connect_error());
}

$username = $_POST['username'];
$password = $_POST['password'];

if (!$koneksi) {
    die("Gagal konek ke database: " . mysqli_connect_error());
}

$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
$login = mysqli_query($koneksi, $query);

if (!$login) {
    die("Error pada Query: " . mysqli_error($koneksi));
}

$cek = mysqli_num_rows($login);

if($cek > 0){
    $data = mysqli_fetch_assoc($login);
    $_SESSION['username'] = $data['username'];
    $_SESSION['nama'] = $data['nama_lengkap'];
    $_SESSION['status'] = "login";
    
    header("location: ../admin/index.php");
} else {
    echo "Login Gagal! Username atau Password tidak cocok.<br>";
    echo "Username yg diketik: " . $username . "<br>";
    echo "Coba cek tabel 'users' di phpMyAdmin, pastikan isinya sama.";
    exit;
}
?>