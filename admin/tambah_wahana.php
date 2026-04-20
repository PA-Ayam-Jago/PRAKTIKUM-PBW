<?php
session_start();
if($_SESSION['status'] != "login") header("location:../auth/login.php");
include '../config/koneksi.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Wahana Baru</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { background-color: #F4F6F9; font-family: 'Poppins', sans-serif; }
        .card { border-radius: 15px; border: none; box-shadow: 0 4px 20px rgba(0,0,0,0.05); }
        .btn-simpan { background-color: #E01940; color: white; border: none; padding: 10px; border-radius: 8px; width: 100%; font-weight: 600; }
        .btn-simpan:hover { background-color: #C01435; color: white; }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card p-4">
                    <h4 class="fw-bold mb-4">Tambah Wahana Baru</h4>
                    <form action="aksi_tambah_wahana.php" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Nama Wahana</label>
                            <input type="text" name="nama_wahana" class="form-control" placeholder="Contoh: Thunder Coaster" required>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Kategori</label>
                                <select name="kategori" class="form-select" required>
                                    <option value="Thrill">Thrill</option>
                                    <option value="Water">Water</option>
                                    <option value="Family">Family</option>
                                    <option value="Kids">Kids</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Intensity</label>
                                <select name="intensity" class="form-select" required>
                                    <option value="Low">Low</option>
                                    <option value="Medium">Medium</option>
                                    <option value="High">High</option>
                                    <option value="Extreme">Extreme</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Kapasitas</label>
                                <input type="text" name="kapasitas" class="form-control" placeholder="Contoh: 24 orang" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Durasi</label>
                                <input type="text" name="durasi" class="form-control" placeholder="Contoh: 3 menit" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold">Foto Wahana</label>
                            <input type="file" name="foto" class="form-control" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label small fw-bold">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" rows="3" placeholder="Tuliskan deskripsi singkat..."></textarea>
                        </div>

                        <button type="submit" class="btn btn-simpan">Simpan Wahana</button>
                        <div class="text-center mt-3">
                            <a href="data_wahana.php" class="text-muted small text-decoration-none">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>