<?php
$pageTitle = "Edit Wahana";
$activePage = "wahana";
include "../partials/header.php";
include "../partials/sidebar.php";

$id = isset($_GET['id']) ? $_GET['id'] : '';
?>

<h1 class="page-title">Edit Wahana</h1>
<p class="page-subtitle">Ubah data wahana</p>

<div class="card">
    <form action="" method="POST">
        <div class="form-group">
            <label for="nama_wahana">Nama Wahana</label>
            <input type="text" id="nama_wahana" name="nama_wahana" value="Thunder Coaster" required>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="kategori">Kategori</label>
                <select id="kategori" name="kategori" required>
                    <option value="Thrill" selected>Thrill</option>
                    <option value="Water">Water</option>
                    <option value="Family">Family</option>
                    <option value="Kids">Kids</option>
                </select>
            </div>

            <div class="form-group">
                <label for="intensity">Intensity</label>
                <select id="intensity" name="intensity" required>
                    <option value="Extreme" selected>Extreme</option>
                    <option value="High">High</option>
                    <option value="Medium">Medium</option>
                    <option value="Low">Low</option>
                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="kapasitas">Kapasitas</label>
                <input type="text" id="kapasitas" name="kapasitas" value="24" required>
            </div>

            <div class="form-group">
                <label for="durasi">Durasi</label>
                <input type="text" id="durasi" name="durasi" value="3 menit" required>
            </div>
        </div>

        <div class="form-group">
            <label for="lokasi">Lokasi / Deskripsi Singkat</label>
            <input type="text" id="lokasi" name="lokasi" value="Thrill Zone - Section A" required>
        </div>

        <div class="btn-group">
            <button type="submit" class="btn btn-success">Update</button>
            <a href="wahana.php" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

<?php include "../partials/footer.php"; ?>