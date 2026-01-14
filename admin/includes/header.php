<?php
require_once __DIR__ . '/../../config/db.php';

// Check if admin is logged in
if(!isset($_SESSION['admin_id']) && basename($_SERVER['PHP_SELF']) != 'login.php') {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - CarsDekho</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Admin CSS -->
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>

<div class="admin-wrapper">
    <?php if(isset($_SESSION['admin_id'])): ?>
    <?php include 'sidebar.php'; ?>
    <?php endif; ?>

    <div class="admin-content <?php echo isset($_SESSION['admin_id']) ? '' : 'full-width'; ?>">
        <?php if(isset($_SESSION['admin_id'])): ?>
        <!-- Top Navbar -->
        <nav class="admin-navbar">
            <div class="d-flex justify-content-between align-items-center w-100">
                <button class="btn btn-link sidebar-toggle d-lg-none">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="ms-auto d-flex align-items-center">
                    <span class="me-3">Welcome, <?php echo $_SESSION['admin_username']; ?></span>
                    <a href="logout.php" class="btn btn-outline-danger btn-sm">
                        <i class="fas fa-sign-out-alt me-1"></i>Logout
                    </a>
                </div>
            </div>
        </nav>
        <?php endif; ?>
