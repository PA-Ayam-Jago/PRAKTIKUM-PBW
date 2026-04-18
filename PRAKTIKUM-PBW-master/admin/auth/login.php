<?php
session_start();

if (isset($_SESSION['login'])) {
    header("Location: dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Samarinda Theme Park</title>
    <link rel="stylesheet" href="../auth.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>

<div class="login-page">
    <div class="login-card">
        <div class="login-left">
            <div class="brand-badge">ADMIN PANEL</div>
            <h1>Samarinda<br>Theme Park</h1>
            <p>Kelola konten website wisata dengan lebih mudah, cepat, dan rapi.</p>

            <div class="login-info">
                <div class="info-item">
                    <i class="fa-solid fa-ticket"></i>
                    <span>Kelola tiket & promo</span>
                </div>
                <div class="info-item">
                    <i class="fa-solid fa-star"></i>
                    <span>Atur review pengunjung</span>
                </div>
                <div class="info-item">
                    <i class="fa-solid fa-image"></i>
                    <span>Edit konten beranda</span>
                </div>
            </div>
        </div>

        <div class="login-right">
            <div class="login-header">
                <h2>Login Admin</h2>
                <p>Masuk untuk mengelola data website.</p>
            </div>

            <form action="proses_login.php" method="POST" class="login-form">
                <div class="form-group">
                    <label>Username</label>
                    <div class="input-group">
                        <i class="fa-solid fa-user"></i>
                        <input type="text" name="username" placeholder="Masukkan username" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <div class="input-group">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" name="password" placeholder="Masukkan password" required>
                    </div>
                </div>

                <button type="submit" class="login-btn">Login</button>

                <a href="../../index.php" class="back-link">
                    <i class="fa-solid fa-arrow-left"></i> Kembali ke Website
                </a>
            </form>
        </div>
    </div>
</div>

</body>
</html>