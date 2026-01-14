<!-- Admin Sidebar -->
<div class="admin-sidebar">
    <div class="sidebar-header">
        <a href="index.php" class="sidebar-brand">
            <i class="fas fa-car me-2"></i>CarsDekho
        </a>
    </div>

    <nav class="sidebar-nav">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a href="index.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>">
                    <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a href="banners.php" class="nav-link <?php echo in_array(basename($_SERVER['PHP_SELF']), ['banners.php', 'add_banner.php', 'edit_banner.php']) ? 'active' : ''; ?>">
                    <i class="fas fa-images me-2"></i>Banners
                </a>
            </li>
            <li class="nav-item">
                <a href="cars.php" class="nav-link <?php echo in_array(basename($_SERVER['PHP_SELF']), ['cars.php', 'add_car.php', 'edit_car.php']) ? 'active' : ''; ?>">
                    <i class="fas fa-car me-2"></i>Cars
                </a>
            </li>
            <li class="nav-item">
                <a href="inquiries.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'inquiries.php' ? 'active' : ''; ?>">
                    <i class="fas fa-envelope me-2"></i>Inquiries
                </a>
            </li>
            <li class="nav-item">
                <a href="settings.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'settings.php' ? 'active' : ''; ?>">
                    <i class="fas fa-cog me-2"></i>Settings
                </a>
            </li>
        </ul>
    </nav>

    <div class="sidebar-footer">
        <a href="../index.php" target="_blank" class="btn btn-outline-light btn-sm w-100">
            <i class="fas fa-external-link-alt me-2"></i>View Website
        </a>
    </div>
</div>
