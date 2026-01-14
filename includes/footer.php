 <?php 
    require_once __DIR__ . '/../config/db.php';

    $settingQuery = "SELECT * FROM settings";
    $res = mysqli_query($conn, $settingQuery);

    $settings = [];

    while ($row = mysqli_fetch_assoc($res)) {
        $settings[$row['setting_key']] = $row['setting_value'];
    }
 ?>
 <!-- Footer -->
    <footer class="bg-dark text-white pt-5 pb-3">
        <div class="container">
            <div class="row">
                <!-- About Section -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <h5 class="mb-3"><i class="fas fa-car me-2"></i><?php echo $settings['site_name']; ?></h5>
                    <p class="text-white" >Your one-stop destination for finding the perfect car. We offer a wide range of new and used cars at the best prices.</p>
                     <div class="social-links mt-3">
                        <a href="<?php echo $settings['facebook_url']; ?>" class="text-white me-3"><i class="fab fa-facebook-f"></i></a>
                        <a href="<?php echo $settings['twitter_url']; ?>" class="text-white me-3"><i class="fab fa-twitter"></i></a>
                        <a href="<?php echo $settings['instagram_url']; ?>" class="text-white me-3"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="col-lg-2 col-md-6 mb-4">
                    <h5 class="mb-3">Quick Links</h5>
                    <ul class="list-unstyled footer-links">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="#">New Cars</a></li>
                        <li><a href="#">Used Cars</a></li>
                        <li><a href="inquiry.php">Get Quote</a></li>
                    </ul>
                </div>

                <!-- Car Types -->
                <div class="col-lg-2 col-md-6 mb-4">
                    <h5 class="mb-3">Car Types</h5>
                    <ul class="list-unstyled footer-links">
                        <li><a href="#">Hatchback</a></li>
                        <li><a href="#">Sedan</a></li>
                        <li><a href="#">SUV</a></li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <h5 class="mb-3">Contact Us</h5>
                    <ul class="list-unstyled contact-info">
                        <li class="mb-2">
                            <i class="fas fa-map-marker-alt me-2 text-primary"></i>
                            <?php echo $settings['address'];?>
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-phone-alt me-2 text-primary"></i>
                            <?php echo $settings['contact_phone'];?>
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-envelope me-2 text-primary"></i>
                            <?php echo $settings['contact_email'];?>
                        </li>
                    </ul>
                </div>
            </div>

            <hr class="my-4 bg-secondary">

            <!-- Copyright -->
            <div class="row">
                <div class="col-md-6">
                    <p class="mb-0 text-muted">&copy; <?php echo date('Y'); ?> <?php echo $settings['site_name']; ?>. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="#" class="text-muted me-3">Privacy Policy</a>
                    <a href="#" class="text-muted">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS -->
    <script src="assets/js/script.js"></script>
</body>
</html>
