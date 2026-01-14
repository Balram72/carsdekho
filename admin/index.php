<?php
include 'includes/header.php';

// Get counts for dashboard
$banners = "SELECT COUNT(*) FROM banners";
$bannerCountResult = mysqli_query($conn, $banners);

if ($bannerCountResult) {
    $bannerCount = mysqli_fetch_array($bannerCountResult)[0];
}

$car = "SELECT COUNT(*) FROM cars";
$carCountResult = mysqli_query($conn, $car);

if ($carCountResult) {
    $carCount = mysqli_fetch_array($carCountResult)[0];
}


$inquiry = "SELECT COUNT(*) FROM banners";
$inquiryCountResult = mysqli_query($conn, $inquiry);
if ($inquiryCountResult) {
    $inquiryCount = mysqli_fetch_array($inquiryCountResult)[0];
}

$recentInquiry = "SELECT * FROM inquiries ORDER BY created_at DESC LIMIT 5";
$recentInquiries = mysqli_query($conn, $recentInquiry);



?>

        <div class="admin-main p-4">
            <div class="page-header mb-4">
                <h4 class="fw-bold">Dashboard</h4>
                <p class="text-muted">Welcome to your admin panel</p>
            </div>

            <!-- Stats Cards -->
            <div class="row mb-4">
                <div class="col-md-4 mb-3">
                    <div class="stat-card bg-primary text-white">
                        <div class="stat-icon">
                            <i class="fas fa-images"></i>
                        </div>
                        <div class="stat-details">
                            <h3><?php echo $bannerCount; ?></h3>
                            <p>Total Banners</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="stat-card bg-success text-white">
                        <div class="stat-icon">
                            <i class="fas fa-car"></i>
                        </div>
                        <div class="stat-details">
                            <h3><?php echo $carCount; ?></h3>
                            <p>Total Cars</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="stat-card bg-info text-white">
                        <div class="stat-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="stat-details">
                            <h3><?php echo $inquiryCount; ?></h3>
                            <p>Total Inquiries</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Quick Actions</h5>
                        </div>
                        <div class="card-body">
                            <a href="add_banner.php" class="btn btn-outline-primary me-2">
                                <i class="fas fa-plus me-1"></i>Add Banner
                            </a>
                            <a href="add_car.php" class="btn btn-outline-success me-2">
                                <i class="fas fa-plus me-1"></i>Add Car
                            </a>
                            <a href="inquiries.php" class="btn btn-outline-info">
                                <i class="fas fa-eye me-1"></i>View Inquiries
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Inquiries -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Recent Inquiries</h5>
                            <a href="inquiries.php" class="btn btn-sm btn-outline-primary">View All</a>
                        </div>
                        <div class="card-body">
                            <?php if(!empty($recentInquiries)): ?>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                            <th>Car Types</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($recentInquiries as $inquiry): ?>
                                        <tr>
                                            <td><?php echo $inquiry['name']; ?></td>
                                            <td><?php echo $inquiry['phone']; ?></td>
                                            <td><?php echo $inquiry['email']; ?></td>
                                            <td><span class="badge bg-secondary"><?php echo $inquiry['car_types']; ?></span></td>
                                            <td><?php echo date('d M Y', strtotime($inquiry['created_at'])); ?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php else: ?>
                            <p class="text-muted mb-0">No inquiries yet.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
