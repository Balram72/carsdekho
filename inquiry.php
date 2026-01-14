<?php
require_once 'config/db.php';
include 'includes/header.php';

$success = '';
$error = '';

$settingQuery = "SELECT * FROM settings";
$res = mysqli_query($conn, $settingQuery);

$settings = [];

while ($row = mysqli_fetch_assoc($res)) {
    $settings[$row['setting_key']] = $row['setting_value'];
}

// Check for success message

if(isset($_GET['success'])) {
    $success = "Thank you for your inquiry! We will contact you soon.";
}

?>

    <!-- Page Header -->
    <section class="page-header py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h1 class="fw-bold">Get a Quote</h1>
                    <p class="text-muted">Fill out the form below and we'll help you find your perfect car</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Inquiry Form Section -->
    <section class="inquiry-section py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="inquiry-form-wrapper bg-white shadow rounded p-4 p-md-5">

                        <?php if($success): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i><?php echo $success; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                        <?php endif; ?>

                        <?php if($error): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i><?php echo $error; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                        <?php endif; ?>

                        <form action="submit_inquiry.php" method="POST" id="inquiryForm">
                            <!-- Car Type Selection -->
                            <div class="mb-4">
                                <label class="form-label fw-bold">Select Car Type(s) <span class="text-danger">*</span></label>
                                <p class="text-muted small">You can select multiple options</p>
                                <div class="row">
                                    <div class="col-md-4 mb-2">
                                        <div class="form-check car-type-check">
                                            <input class="form-check-input" type="checkbox" name="car_types[]" value="Hatchback" id="hatchback">
                                            <label class="form-check-label" for="hatchback">
                                                <i class="fas fa-car me-2"></i>Hatchback
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <div class="form-check car-type-check">
                                            <input class="form-check-input" type="checkbox" name="car_types[]" value="Sedan" id="sedan">
                                            <label class="form-check-label" for="sedan">
                                                <i class="fas fa-car-side me-2"></i>Sedan
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <div class="form-check car-type-check">
                                            <input class="form-check-input" type="checkbox" name="car_types[]" value="SUV" id="suv">
                                            <label class="form-check-label" for="suv">
                                                <i class="fas fa-truck-pickup me-2"></i>SUV
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr class="my-4">

                            <!-- Personal Information -->
                            <h5 class="mb-4">Personal Information</h5>

                            <!-- Name -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter your full name" required>
                            </div>

                            <!-- Phone Number -->
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone Number <span class="text-danger">*</span></label>
                                <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter your phone number" required>
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email address" required>
                            </div>

                            <!-- Address -->
                            <div class="mb-4">
                                <label for="address" class="form-label">Address <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="address" name="address" rows="3" placeholder="Enter your complete address" required></textarea>
                            </div>

                            <!-- Submit Button -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-paper-plane me-2"></i>Submit Inquiry
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Contact Info Sidebar -->
                <div class="col-lg-4 mt-4 mt-lg-0">
                    <div class="contact-sidebar">
                        <div class="contact-card bg-primary text-white rounded p-4 mb-4">
                            <h5 class="mb-3"><i class="fas fa-headset me-2"></i>Need Help?</h5>
                            <p class="mb-3">Our team is ready to assist you in finding your perfect car.</p>
                            <p class="mb-2"><i class="fas fa-phone me-2"></i><?php echo $settings['contact_phone']; ?></p>
                            <p class="mb-0"><i class="fas fa-envelope me-2"></i><?php echo  $settings['contact_email']; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php include 'includes/footer.php'; ?>
