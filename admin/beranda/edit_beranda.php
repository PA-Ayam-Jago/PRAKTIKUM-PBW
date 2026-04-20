<?php
$pageTitle = "Edit Beranda";
$activePage = "beranda";

require "../../config/koneksi.php";
include "../partials/header.php";
include "../partials/sidebar.php";

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

$data = [
    'hero_judul' => '',
    'hero_subtitle' => '',
    'hero_background' => '',
    'status_now_open' => '',
    'jumlah_atraksi' => '',
    'pengunjung_per_tahun' => '',
    'rating' => '',
    'jam_kerja' => '',
    'jam_akhir_pekan' => '',
    'jam_hari_libur' => '',
    'cta_text' => '',
    'cta_button' => ''
];

if ($id > 0) {
    $query = "SELECT * FROM beranda WHERE id = $id";
    $result = mysqli_query($conn, $query);
    $editData = mysqli_fetch_assoc($result);

    if ($editData) {
        $data = $editData;
    }
}

if (isset($_POST['simpan'])) {
    $hero_judul = mysqli_real_escape_string($conn, $_POST['hero_judul']);
    $hero_subtitle = mysqli_real_escape_string($conn, $_POST['hero_subtitle']);
    $hero_background = mysqli_real_escape_string($conn, $_POST['hero_background']);
    $status_now_open = mysqli_real_escape_string($conn, $_POST['status_now_open']);
    $jumlah_atraksi = mysqli_real_escape_string($conn, $_POST['jumlah_atraksi']);
    $pengunjung_per_tahun = mysqli_real_escape_string($conn, $_POST['pengunjung_per_tahun']);
    $rating = mysqli_real_escape_string($conn, $_POST['rating']);
    $jam_kerja = mysqli_real_escape_string($conn, $_POST['jam_kerja']);
    $jam_akhir_pekan = mysqli_real_escape_string($conn, $_POST['jam_akhir_pekan']);
    $jam_hari_libur = mysqli_real_escape_string($conn, $_POST['jam_hari_libur']);
    $cta_text = mysqli_real_escape_string($conn, $_POST['cta_text']);
    $cta_button = mysqli_real_escape_string($conn, $_POST['cta_button']);

    if ($id > 0) {
        $update = "UPDATE beranda SET
                    hero_judul='$hero_judul',
                    hero_subtitle='$hero_subtitle',
                    hero_background='$hero_background',
                    status_now_open='$status_now_open',
                    jumlah_atraksi='$jumlah_atraksi',
                    pengunjung_per_tahun='$pengunjung_per_tahun',
                    rating='$rating',
                    jam_kerja='$jam_kerja',
                    jam_akhir_pekan='$jam_akhir_pekan',
                    jam_hari_libur='$jam_hari_libur',
                    cta_text='$cta_text',
                    cta_button='$cta_button'
                   WHERE id=$id";

        if (mysqli_query($conn, $update)) {
            echo "<script>alert('Data beranda berhasil diupdate!'); window.location='beranda.php';</script>";
            exit;
        } else {
            echo "<script>alert('Gagal update data beranda!');</script>";
        }
    } else {
        $insert = "INSERT INTO beranda (
                    hero_judul, hero_subtitle, hero_background, status_now_open,
                    jumlah_atraksi, pengunjung_per_tahun, rating,
                    jam_kerja, jam_akhir_pekan, jam_hari_libur,
                    cta_text, cta_button
                   ) VALUES (
                    '$hero_judul', '$hero_subtitle', '$hero_background', '$status_now_open',
                    '$jumlah_atraksi', '$pengunjung_per_tahun', '$rating',
                    '$jam_kerja', '$jam_akhir_pekan', '$jam_hari_libur',
                    '$cta_text', '$cta_button'
                   )";

        if (mysqli_query($conn, $insert)) {
            echo "<script>alert('Data beranda berhasil ditambahkan!'); window.location='beranda.php';</script>";
            exit;
        } else {
            echo "<script>alert('Gagal menambahkan data beranda!');</script>";
        }
    }
}
?>

<h1 class="page-title">Edit Beranda</h1>
<p class="page-subtitle">Atur isi halaman beranda website</p>

<div class="card">
    <form method="POST">
        <div class="form-group">
            <label>Hero Judul</label>
            <input type="text" name="hero_judul" value="<?= htmlspecialchars($data['hero_judul']); ?>" required>
        </div>

        <div class="form-group">
            <label>Hero Subtitle</label>
            <input type="text" name="hero_subtitle" value="<?= htmlspecialchars($data['hero_subtitle']); ?>" required>
        </div>

        <div class="form-group">
            <label>Hero Background</label>
            <input type="text" name="hero_background" value="<?= htmlspecialchars($data['hero_background']); ?>" placeholder="nama-file.jpg atau path gambar">
        </div>

        <div class="form-group">
            <label>Status Now Open</label>
            <input type="text" name="status_now_open" value="<?= htmlspecialchars($data['status_now_open']); ?>" placeholder="Contoh: Buka Sekarang">
        </div>

        <div class="form-row-3">
            <div class="form-group">
                <label>Jumlah Atraksi</label>
                <input type="text" name="jumlah_atraksi" value="<?= htmlspecialchars($data['jumlah_atraksi']); ?>">
            </div>

            <div class="form-group">
                <label>Pengunjung per Tahun</label>
                <input type="text" name="pengunjung_per_tahun" value="<?= htmlspecialchars($data['pengunjung_per_tahun']); ?>">
            </div>

            <div class="form-group">
                <label>Rating</label>
                <input type="text" name="rating" value="<?= htmlspecialchars($data['rating']); ?>" placeholder="Contoh: 4.8">
            </div>
        </div>

        <div class="form-group">
            <label>Jam Operasional Hari Kerja</label>
            <input type="text" name="jam_kerja" value="<?= htmlspecialchars($data['jam_kerja']); ?>" placeholder="Contoh: 10.00 AM - 08.00 PM">
        </div>

        <div class="form-group">
            <label>Jam Operasional Akhir Pekan</label>
            <input type="text" name="jam_akhir_pekan" value="<?= htmlspecialchars($data['jam_akhir_pekan']); ?>" placeholder="Contoh: 09.00 AM - 10.00 PM">
        </div>

        <div class="form-group">
            <label>Jam Operasional Hari Libur</label>
            <input type="text" name="jam_hari_libur" value="<?= htmlspecialchars($data['jam_hari_libur']); ?>" placeholder="Contoh: 09.00 AM - 10.00 PM">
        </div>

        <div class="form-group">
            <label>CTA Text</label>
            <input type="text" name="cta_text" value="<?= htmlspecialchars($data['cta_text']); ?>" placeholder="Contoh: Book Your Tickets Now">
        </div>

        <div class="form-group">
            <label>CTA Button Text</label>
            <input type="text" name="cta_button" value="<?= htmlspecialchars($data['cta_button']); ?>" placeholder="Contoh: Get Started">
        </div>

        <div class="btn-group">
            <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
            <a href="beranda.php" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

<?php include "../partials/footer.php"; ?>