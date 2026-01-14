<?php
require_once __DIR__ . '/../config/db.php';

$settingQuery = "SELECT * FROM settings";
$res = mysqli_query($conn, $settingQuery);

$settings = [];

while ($row = mysqli_fetch_assoc($res)) {
    $settings[$row['setting_key']] = $row['setting_value'];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $settings['site_name']; ?> - <?php echo $settings['site_tagline']; ?></title>
    <link rel="icon" href="../assets/images/favicon.ico" type="image/x-icon">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <!-- Top Bar -->
    <div class="top-bar bg-dark text-white py-2">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <small>
                        <i class="fas fa-phone-alt me-2"></i><?php echo $settings['contact_phone'];?>
                        <span class="ms-3"><i class="fas fa-envelope me-2"></i><?php echo $settings['contact_email']; ?></span>
                    </small>
                </div>
                <div class="col-md-6 text-end">
                    <a href="<?php echo $settings['facebook_url']; ?>" class="text-white me-3"><i class="fab fa-facebook-f"></i></a>
                    <a href="<?php echo $settings['twitter_url']; ?>" class="text-white me-3"><i class="fab fa-twitter"></i></a>
                    <a href="<?php echo $settings['instagram_url']; ?>" class="text-white"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="index.php">
                <i class="fas fa-car me-2"></i><?php echo $settings['site_name']; ?>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">New Cars</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Used Cars</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="carsDropdown" data-bs-toggle="dropdown">
                            Cars
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Hatchback</a></li>
                            <li><a class="dropdown-item" href="#">Sedan</a></li>
                            <li><a class="dropdown-item" href="#">SUV</a></li>
                        </ul>
                    </li>
                    <li class="nav-item ms-2 mt-1">
                        <a class="btn btn-outline-primary" href="inquiry.php">Get Quote <i class="fas fa-arrow-right"></i> </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
