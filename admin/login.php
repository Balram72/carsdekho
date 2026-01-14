<?php
require_once '../config/db.php';

$error = '';

// If already logged in, redirect to dashboard
if(isset($_SESSION['admin_id'])) {
    header("Location: index.php");
    exit();
}

// Handle login form submission
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if(empty($username) || empty($password)) {
        $error = "Please enter both username and password";
    } else {
        
        // Check credentials
        $sql = "SELECT * FROM admin WHERE username = '$username'";
        $result = mysqli_query($conn, $sql);
       if($row = mysqli_fetch_assoc($result)){
            $admin = $row['username'];
            $adminPassword = $row['password'];

            if ($admin == $username) {
                if ($password == $adminPassword) {
                    // Login successful
                    $_SESSION['admin_id'] = $row['id'];
                    $_SESSION['admin_username'] = $row['username'];

                    header("Location: index.php");
                    exit();
                } else {
                    $error = "Invalid username or password";
                }
            }
        } else {
            $error = "Invalid username or password";
        }

    }
}

include 'includes/header.php';
?>

<div class="login-wrapper">
    <div class="login-box">
        <div class="login-header text-center mb-4">
            <i class="fas fa-car fa-3x text-primary mb-3"></i>
            <h4 class="fw-bold">Admin Login</h4>
        </div>

        <?php if($error): ?>
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-circle me-2"></i><?php echo $error; ?>
        </div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Enter username" required>
                </div>
            </div>

            <div class="mb-4">
                <label for="password" class="form-label">Password</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
                </div>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="fas fa-sign-in-alt me-2"></i>Login
                </button>
            </div>
        </form>

        <div class="text-center mt-4">
            <a href="../index.php" class="text-muted">
                <i class="fas fa-arrow-left me-1"></i>Back to Website
            </a>
        </div>
    </div>
</div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
