<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: ../auth/login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="admin.css">
</head>
<body>

<div class="sidebar">
    <div class="logo">
        <div class="logo-circle">S</div>
        <h2>Admin STP</h2>
    </div>

    <ul class="menu">
        <li><a href="dashboard.php" class="active">Dashboard</a></li>
        <li><a href="wahana.php">Wahana</a></li>
        <li><a href="promo.php">Promo</a></li>
        <li><a href="ulasan.php">Ulasan</a></li>
    </ul>

    <div class="logout">
        <a href="../auth/logout.php">Logout</a>
    </div>
</div>

<div class="main">
    <div class="topbar">
        <h1>Dashboard</h1>
        <p>Halo, <?php echo $_SESSION['admin']; ?> 👋</p>
    </div>

    <div class="cards">
        <div class="card-admin">
            <h3>Wahana</h3>
            <p>Kelola data wahana</p>
            <a href="wahana.php">Kelola →</a>
        </div>

        <div class="card-admin">
            <h3>Promo</h3>
            <p>Kelola data promo</p>
            <a href="promo.php">Kelola →</a>
        </div>

        <div class="card-admin">
            <h3>Ulasan</h3>
            <p>Lihat dan hapus ulasan</p>
            <a href="ulasan.php">Kelola →</a>
        </div>
    </div>
</div>

</body>
</html>