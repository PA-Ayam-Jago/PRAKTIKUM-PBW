<div class="sidebar">
    <div class="brand">
        <h2>ADMIN</h2>
        <p>Samarinda Theme Park</p>
    </div>

    <div class="menu-title">Main</div>
    <ul>
        <li>
            <a href="/PRAKTIKUM-PBW-MASTER/admin/auth/dashboard.php" class="<?= $activePage == 'dashboard' ? 'active' : ''; ?>">
                Dashboard
            </a>
        </li>
    </ul>

    <div class="menu-title">Konten Website</div>
    <ul>
        <li>
            <a href="/PRAKTIKUM-PBW-MASTER/admin/wahana/wahana.php" class="<?= $activePage == 'wahana' ? 'active' : ''; ?>">
                Wahana
            </a>
        </li>

        <li>
            <a href="/PRAKTIKUM-PBW-MASTER/admin/fasilitas/fasilitas.php" class="<?= $activePage == 'fasilitas' ? 'active' : ''; ?>">
                Fasilitas
            </a>
        </li>

        <li>
            <a href="/PRAKTIKUM-PBW-MASTER/admin/tiket/tiket.php" class="<?= $activePage == 'tiket' ? 'active' : ''; ?>">
                Tiket
            </a>
        </li>

        <li>
            <a href="/PRAKTIKUM-PBW-MASTER/admin/promo/promo.php" class="<?= $activePage == 'promo' ? 'active' : ''; ?>">
                Promo
            </a>
        </li>

        <li>
            <a href="/PRAKTIKUM-PBW-MASTER/admin/ulasan/ulasan.php" class="<?= $activePage == 'review' ? 'active' : ''; ?>">
                Review
            </a>
        </li>

        <li>
            <a href="/PRAKTIKUM-PBW-MASTER/admin/beranda/beranda.php" class="<?= $activePage == 'beranda' ? 'active' : ''; ?>">
                Beranda
            </a>
        </li>

        <li>
            <a href="/PRAKTIKUM-PBW-MASTER/admin/kontak/kontak.php" class="<?= $activePage == 'kontak' ? 'active' : ''; ?>">
                Kontak
            </a>
        </li>
    </ul>

    <div class="menu-title">Pengaturan</div>
    <ul>
        <li>
            <a href="/PRAKTIKUM-PBW-MASTER/admin/akun_admin/akun_admin.php" class="<?= $activePage == 'akun_admin' ? 'active' : ''; ?>">
                Akun Admin
            </a>
        </li>

        <li>
            <a href="/PRAKTIKUM-PBW-MASTER/admin/auth/logout.php" class="<?= $activePage == 'logout' ? 'active' : ''; ?>">
                Log Out
            </a>
        </li>
    </ul>
</div>

<div class="main-content">
    <div class="topbar">
        <div class="topbar-user">
            <span><?= isset($_SESSION['nama_lengkap']) ? htmlspecialchars($_SESSION['nama_lengkap']) : 'Admin User'; ?></span>
            <div class="avatar">A</div>
        </div>
    </div>

    <div class="content">