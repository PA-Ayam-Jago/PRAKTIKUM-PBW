<?php
if (!isset($pageTitle)) $pageTitle = 'Samarinda Theme Park';
if (!isset($activePage)) $activePage = '';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<nav class="navbar navbar-expand-lg stp-navbar bg-white sticky-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-3" href="index.php">
            <div class="brand-logo">S</div>
            <div>
                <div class="brand-title">Samarinda</div>
                <div class="brand-subtitle">Theme Park</div>
            </div>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navSTP">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navSTP">
            <ul class="navbar-nav mx-auto gap-lg-3">
                <li class="nav-item">
                    <a class="nav-link <?= $activePage === 'home' ? 'active' : '' ?>" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $activePage === 'wahana' ? 'active' : '' ?>" href="wahana.php">Wahana</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $activePage === 'fasilitas' ? 'active' : '' ?>" href="fasilitas.php">Fasilitas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $activePage === 'tiket' ? 'active' : '' ?>" href="tiket.php">Tiket</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $activePage === 'review' ? 'active' : '' ?>" href="review.php">Review</a>
                </li>
            </ul>

            <div class="d-flex align-items-center gap-3">
                <i class="bi bi-search fs-4"></i>
                <a href="tiket.php" class="btn btn-book">Book Now</a>
            </div>
        </div>
    </div>
</nav>