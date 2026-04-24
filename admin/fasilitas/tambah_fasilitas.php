<?php
include '../config/koneksi.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Fasilitas - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #F8F9FA; padding: 50px; }
        .card-form { background: white; border-radius: 20px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.05); padding: 40px; max-width: 600px; margin: auto; }
        .form-label { font-weight: 600; font-size: 14px; color: #1A1A1A; }
        .form-control { border-radius: 10px; border: 1px solid #E1E1E1; padding: 12px; }
        .btn-save { background-color: #E01940; color: white; border: none; padding: 12px; border-radius: 10px; font-weight: 600; width: 100%; margin-top: 20px; }
        .btn-cancel { background: #F1F1F1; color: #666; width: 100%; border: none; padding: 12px; border-radius: 10px; margin-top: 10px; text-decoration: none; display: block; text-align: center; }
    </style>
</head>
<body>

<div class="card-form">
    <h3 class="fw-bold mb-1">Tambah Fasilitas</h3>
    <p class="text-muted small mb-4">Lengkapi data fasilitas baru di bawah ini</p>

    <form action="aksi_tambah_fasilitas.php" method="POST">
        <div class="mb-3">
            <label class="form-label">Nama Fasilitas</label>
            <input type="text" name="nama_fasilitas" class="form-control" placeholder="Contoh: Musholla" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Lokasi</label>
            <input type="text" name="lokasi" class="form-control" placeholder="Contoh: Dekat Pintu Masuk" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Jam Operasional</label>
            <input type="text" name="jam_operasional" class="form-control" placeholder="Contoh: 08:00 - 17:00" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="3" placeholder="Jelaskan fasilitas ini..."></textarea>
        </div>
        
        <button type="submit" class="btn-save">Simpan Fasilitas</button>
        <a href="data_fasilitas.php" class="btn-cancel">Batal</a>
    </form>
</div>

</body>
</html>