<?php
require "../../config/koneksi.php";
include "../partials/header.php";
include "../partials/sidebar.php";
?>

<div class="container py-4">
    <h1 class="page-title">Tambah Wahana</h1>
    <div class="dashboard-box">
        <form action="simpan_wahana.php" method="POST" enctype="multipart/form-data">
            
            <div class="mb-3">
                <label class="form-label">Nama Wahana</label>
                <input type="text" name="nama_wahana" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="3" required></textarea>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Kategori</label>
                    <select name="kategori" class="form-select">
                        <option>Wahana Ekstrem</option>
                        <option>Hiburan Keluarga</option>
                        <option>Zona Anak</option>
                        <option>Wahana Air</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Intensitas</label>
                    <select name="intensity" class="form-select">
                        <option>High</option>
                        <option>Medium</option>
                        <option>Low</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Durasi (Menit)</label>
                    <input type="number" name="durasi" class="form-control" value="5">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Kapasitas (Orang)</label>
                    <input type="number" name="kapasitas" class="form-control" value="20">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Gambar Wahana</label>
                <input type="file" name="gambar" class="form-control" accept="image/*" required>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Simpan Wahana</button>
                <a href="wahana.php" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>

<?php include "../partials/footer.php"; ?>