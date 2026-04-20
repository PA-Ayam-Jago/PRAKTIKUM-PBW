<?php
require 'config/koneksi.php';

$id = $_GET['id'];

$sql = "SELECT * FROM ulasan WHERE id_ulasan = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$data = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Ulasan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background:#f5f5f5;">

<div class="container py-5">
    <div class="card p-4 shadow mx-auto" style="max-width:500px;">
        <h4>Edit Ulasan</h4>

        <form action="ubah_ulasan.php" method="POST">

            <input type="hidden" name="id_ulasan" value="<?= $data['id_ulasan']; ?>">

            <input type="text" name="nama_pengunjung"
                   class="form-control mb-3"
                   value="<?= $data['nama_pengunjung']; ?>">

            <select name="rating" class="form-control mb-3">
                <option value="1" <?= $data['rating']==1?'selected':''; ?>>1</option>
                <option value="2" <?= $data['rating']==2?'selected':''; ?>>2</option>
                <option value="3" <?= $data['rating']==3?'selected':''; ?>>3</option>
                <option value="4" <?= $data['rating']==4?'selected':''; ?>>4</option>
                <option value="5" <?= $data['rating']==5?'selected':''; ?>>5</option>
            </select>

            <textarea name="komentar" class="form-control mb-3"><?= $data['komentar']; ?></textarea>

            <button class="btn btn-primary">Update</button>
            <a href="review.php" class="btn btn-secondary">Kembali</a>

        </form>
    </div>
</div>

</body>
</html>