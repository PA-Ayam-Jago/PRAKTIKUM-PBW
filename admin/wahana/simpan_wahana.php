<?php
// Menggunakan $conn sesuai acuan wahana.php
require "../../config/koneksi.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data sesuai dengan 'name' di form
    $nama_wahana = mysqli_real_escape_string($conn, $_POST['nama_wahana']);
    $deskripsi   = mysqli_real_escape_string($conn, $_POST['deskripsi']);
    $kategori    = mysqli_real_escape_string($conn, $_POST['kategori']);
    $intensity   = mysqli_real_escape_string($conn, $_POST['intensity']);
    $durasi      = (int)$_POST['durasi'];
    $kapasitas   = (int)$_POST['kapasitas'];

    // Kelola Gambar
    $gambar_nama = time() . '_' . $_FILES['gambar']['name']; 
    $gambar_temp = $_FILES['gambar']['tmp_name'];
    
    // Path folder aset mengikuti struktur folder kamu
    $direktori = "../../assets/img/";

    // Lakukan INSERT ke database dulu
    // Nama kolom disesuaikan dengan query di wahana.php kamu (nama_wahana, id, dll)
    $sql = "INSERT INTO wahana (nama_wahana, deskripsi, kategori, intensity, durasi, kapasitas, gambar) 
            VALUES ('$nama_wahana', '$deskripsi', '$kategori', '$intensity', '$durasi', '$kapasitas', '$gambar_nama')";
    
    if (mysqli_query($conn, $sql)) {
        // Jika SQL berhasil, baru pindahkan filenya agar tidak banyak duplikasi sampah
        if (move_uploaded_file($gambar_temp, $direktori . $gambar_nama)) {
            echo "<script>alert('Wahana berhasil ditambahkan!'); window.location='wahana.php';</script>";
        } else {
            echo "<script>alert('Data masuk tapi gambar gagal upload. Cek folder assets/img'); window.location='wahana.php';</script>";
        }
    } else {
        // Tampilkan error jika SQL gagal agar bisa kita perbaiki
        echo "Error Database: " . mysqli_error($conn);
        echo "<br><br><a href='tambah_wahana.php'>Kembali ke Form</a>";
    }
}
?>