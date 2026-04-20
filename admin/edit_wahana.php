<?php
session_start();
if($_SESSION['status'] != "login") {
    header("location:../auth/login.php");
    exit();
}
include '../config/koneksi.php';

// 1. Ambil ID dari URL dan pastikan tidak kosong
if(!isset($_GET['id']) || empty($_GET['id'])){
    header("location:data_wahana.php");
    exit();
}

$id = mysqli_real_escape_string($koneksi, $_GET['id']);

// 2. Ambil data wahana berdasarkan ID
$query = mysqli_query($koneksi, "SELECT * FROM wahana WHERE id_wahana='$id'");

// 3. Cek apakah data ditemukan
if(mysqli_num_rows($query) == 0){
    echo "<script>alert('Data tidak ditemukan!'); window.location='data_wahana.php';</script>";
    exit();
}

$w = mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Wahana - Samarinda Theme Park</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { background-color: #F4F6F9; font-family: 'Poppins', sans-serif; }
        .card { border-radius: 15px; border: none; box-shadow: 0 4px 20px rgba(0,0,0,0.05); margin-top: 50px; margin-bottom: 50px; }
        .btn-update { background-color: #E01940; color: white; border: none; padding: 12px; border-radius: 8px; width: 100%; font-weight: 600; }
        .btn-update:hover { background-color: #C01435; color: white; }
        .img-preview { width: 120px; height: 120px; object-fit: cover; border-radius: 10px; margin-bottom: 10px; border: 2px solid #ddd; }
        label { font-size: 13px; font-weight: 600; color: #555; margin-bottom: 8px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card p-5">
                    <h3 class="fw-bold mb-4">Edit Data Wahana</h3>
                    
                    <form action="aksi_edit_wahana.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id_wahana" value="<?php echo $w['id_wahana']; ?>">

                        <div class="mb-3">
                            <label>Nama Wahana</label>
                            <input type="text" name="nama_wahana" class="form-control" value="<?php echo $w['nama_wahana']; ?>" required>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label>Kategori</label>
                                <select name="kategori" class="form-select">
                                    <option value="Thrill" <?php if($w['kategori'] == 'Thrill') echo 'selected'; ?>>Thrill</option>
                                    <option value="Water" <?php if($w['kategori'] == 'Water') echo 'selected'; ?>>Water</option>
                                    <option value="Family" <?php if($w['kategori'] == 'Family') echo 'selected'; ?>>Family</option>
                                    <option value="Kids" <?php if($w['kategori'] == 'Kids') echo 'selected'; ?>>Kids</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label>Intensity</label>
                                <select name="intensity" class="form-select">
                                    <option value="Low" <?php if($w['intensity'] == 'Low') echo 'selected'; ?>>Low</option>
                                    <option value="Medium" <?php if($w['intensity'] == 'Medium') echo 'selected'; ?>>Medium</option>
                                    <option value="High" <?php if($w['intensity'] == 'High') echo 'selected'; ?>>High</option>
                                    <option value="Extreme" <?php if($w['intensity'] == 'Extreme') echo 'selected'; ?>>Extreme</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label>Kapasitas</label>
                                <input type="text" name="kapasitas" class="form-control" value="<?php echo $w['kapasitas']; ?>">
                            </div>
                            <div class="col-md-6">
                                <label>Durasi</label>
                                <input type="text" name="durasi" class="form-control" value="<?php echo $w['durasi']; ?>">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label>Foto Wahana</label><br>
                            <?php if(!empty($w['foto'])): ?>
                                <img src="../assets/img/wahana/<?php echo $w['foto']; ?>" class="img-preview">
                            <?php endif; ?>
                            <input type="file" name="foto" class="form-control">
                            <small class="text-muted italic">Pilih file baru jika ingin mengganti foto saat ini.</small>
                        </div>

                        <div class="mb-4">
                            <label>Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" rows="3"><?php echo $w['deskripsi']; ?></textarea>
                        </div>

                        <button type="submit" class="btn btn-update">Simpan Perubahan</button>
                        <div class="text-center mt-3">
                            <a href="data_wahana.php" class="text-decoration-none text-muted small">Kembali ke Daftar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>