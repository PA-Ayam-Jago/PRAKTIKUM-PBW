<?php
include '../config/koneksi.php'; // Pastikan koneksi benar
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Fasilitas - Samarinda Theme Park</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../uploads/admin.css"> 
</head>
<body>

    <link rel="stylesheet" href="../uploads/admin.css"> <div class="sidebar">
    <div class="sidebar-brand">
        <h2>ADMIN</h2>
        <p>Samarinda Theme Park</p>
    </div>
    <a href="dashboard.php" class="nav-link">Dashboard</a>
    <a href="data_fasilitas.php" class="nav-link active">Fasilitas</a>
    <a href="logout.php" class="nav-link">Log Out</a>
</div>

<div class="main">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold m-0">Kelola Fasilitas</h2>
            <p class="text-muted small">Manage attractions and rides</p>
        </div>
        <a href="tambah_fasilitas.php" class="btn btn-danger" style="background-color: #E01940; border-radius: 20px;">+ Tambah Fasilitas</a>
    </div>

    <div class="card-table">
        <table class="table m-0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Fasilitas</th>
                    <th>Lokasi</th>
                    <th width="120">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $no = 1;
                $query = mysqli_query($koneksi, "SELECT * FROM fasilitas");
                while($f = mysqli_fetch_array($query)){ ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><strong><?= $f['nama_fasilitas']; ?></strong></td>
                    <td><?= $f['lokasi']; ?></td>
                    <td>
                        <a href="edit_fasilitas.php?id=<?= $f['id_fasilitas']; ?>" class="action-icon">
                            <i class="fa-regular fa-pen-to-square"></i>
                        </a>
                        <a href="hapus.php?id=<?= $f['id_fasilitas']; ?>" class="action-icon">
                            <i class="fa-solid fa-trash"></i>
                        </a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>