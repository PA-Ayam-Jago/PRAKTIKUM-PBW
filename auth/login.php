<?php
session_start();

if (isset($_SESSION['admin'])) {
    header("Location: ../admin/dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Samarinda Theme Park</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="auth.css">
</head>
<body>

<div class="login-page">
    <div class="login-card">
        <div class="login-brand">
            <div class="logo-circle">S</div>
            <div class="brand-text">
                <h1>Samarinda</h1>
                <p>Theme Park</p>
            </div>
        </div>

        <div class="login-title">
            <h2>Login Admin</h2>
            <p>Masuk untuk mengelola data website.</p>
        </div>

        <?php if (isset($_GET['error'])) : ?>
            <div class="alert-error">
                Username atau password salah.
            </div>
        <?php endif; ?>

        <form action="proses_login.php" method="POST" class="login-form">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" placeholder="Masukkan username" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Masukkan password" required>
            </div>

            <button type="submit" class="login-btn">Login</button>
        </form>

        <div class="back-link">
            <a href="../index.php">← Kembali ke Website</a>
        </div>
    </div>
</div>

</body>
</html>