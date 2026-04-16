<?php
session_start();
if($_SESSION['status'] != "login") header("location:../auth/login.php");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Fasilitas - Samarinda Theme Park</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <style>
        body { background-color: #F4F6F9; padding-top: 50px; }
        .card { border-radius: 15px; border: none; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
        .btn-save { background-color: #E01940; color: white; width: 100%; border-radius: 8px; font-weight: 600; padding: 12px; border: none; }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card p-5">
                    <h3 class="fw-bold mb-4">Tambah Fasilitas</h3>
                    <form action="aksi_tambah_fasilitas.php" method="post">
                        <div class="mb-3">
                            <label class="form-label">Nama Fasilitas</label>
                            <input type="text" name="nama_fasilitas" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Lokasi</label>
                            <input type="text" name="lokasi" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jam Operasional</label>
                            <input type="text" name="jam_operasional" class="form-control" placeholder="Contoh: 08:00 - 17:00">
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn-save">Simpan Fasilitas</button>
                        <a href="data_fasilitas.php" class="d-block text-center mt-3 text-muted text-decoration-none">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>