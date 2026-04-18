<?php
$pageTitle = "Dashboard Admin";
$activePage = "dashboard";
include "../partials/header.php";
include "../partials/sidebar.php";
?>

<h1 class="page-title">Dashboard</h1>
<p class="page-subtitle">Selamat datang di admin panel Samarinda Theme Park</p>

<div class="stats-grid">
    <div class="stat-card stat1">
        <h4>Total Wahana</h4>
        <div class="number">8</div>
    </div>
    <div class="stat-card stat2">
        <h4>Total Fasilitas</h4>
        <div class="number">10</div>
    </div>
    <div class="stat-card stat3">
        <h4>Total Tiket</h4>
        <div class="number">4</div>
    </div>
    <div class="stat-card stat4">
        <h4>Total Promo</h4>
        <div class="number">4</div>
    </div>
    <div class="stat-card stat5">
        <h4>Total Review</h4>
        <div class="number">5</div>
    </div>
</div>

<div class="grid-2">
    <div class="card">
        <h3 class="card-title">Wahana Terbaru</h3>
        <div class="simple-list">
            <div class="item">
                <div>
                    <strong>Thunder Coaster</strong><br>
                    <span class="text-muted">Thrill</span>
                </div>
                <span class="badge badge-red">Extreme</span>
            </div>
            <div class="item">
                <div>
                    <strong>Jungle Rapids</strong><br>
                    <span class="text-muted">Water</span>
                </div>
                <span class="badge badge-yellow">Medium</span>
            </div>
            <div class="item">
                <div>
                    <strong>Sky Wheel</strong><br>
                    <span class="text-muted">Family</span>
                </div>
                <span class="badge badge-green">Low</span>
            </div>
        </div>
    </div>

    <div class="card">
        <h3 class="card-title">Review Terbaru</h3>
        <div class="simple-list">
            <div class="item">
                <div>
                    <strong>Dewi Lestari</strong><br>
                    <span class="text-muted">Amazing family day out!</span>
                </div>
                <div class="rating">★★★★★</div>
            </div>
            <div class="item">
                <div>
                    <strong>Budi Santoso</strong><br>
                    <span class="text-muted">Great rides, could improve food option</span>
                </div>
                <div class="rating">★★★★☆</div>
            </div>
            <div class="item">
                <div>
                    <strong>Siti Rahmawati</strong><br>
                    <span class="text-muted">Perfect for thrill seekers</span>
                </div>
                <div class="rating">★★★★★</div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <h3 class="card-title">Promo Aktif</h3>
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Judul Promo</th>
                    <th>Kode Promo</th>
                    <th>Diskon</th>
                    <th>Berlaku Sampai</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>School Holiday Special</td>
                    <td>HOLIDAY30</td>
                    <td><span class="badge badge-pink">30% OFF</span></td>
                    <td>2026-07-31</td>
                </tr>
                <tr>
                    <td>Birthday Bash</td>
                    <td>-</td>
                    <td><span class="badge badge-pink">FREE ENTRY</span></td>
                    <td>2026-12-31</td>
                </tr>
                <tr>
                    <td>Early Bird Discount</td>
                    <td>EARLYBIRD20</td>
                    <td><span class="badge badge-pink">20% OFF</span></td>
                    <td>2026-12-31</td>
                </tr>
                <tr>
                    <td>Group Discount</td>
                    <td>-</td>
                    <td><span class="badge badge-pink">UP TO 40% OFF</span></td>
                    <td>2026-12-31</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<?php include "partials/footer.php"; ?>