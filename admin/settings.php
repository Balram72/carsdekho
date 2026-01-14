<?php
include 'includes/header.php';

$success = '';

// Handle form submission
if($_SERVER['REQUEST_METHOD'] == 'POST') {

    $settings = [

        'site_name' => $_POST['site_name'],
        'site_tagline' => $_POST['site_tagline'],
        'contact_email' => $_POST['contact_email'],
        'contact_phone' => $_POST['contact_phone'],
        'address' => $_POST['address'],
        'facebook_url' => $_POST['facebook_url'],
        'twitter_url' => $_POST['twitter_url'],
        'instagram_url' => $_POST['instagram_url']
    ];

    foreach($settings as $key => $value) {
        $settingupdate =  "UPDATE settings SET setting_value = '$value' WHERE setting_key = '$key'";
        $res = mysqli_query($conn, $settingupdate);
    }

    $success = "Settings updated successfully!";
}

// Get current settings
$settingsData = [];
$settingQuery = "SELECT * FROM settings";
$res = mysqli_query($conn, $settingQuery);
while($row = mysqli_fetch_assoc($res)) {
    $settingsData[$row['setting_key']] = $row['setting_value'];
}
?>

        <div class="admin-main p-4">
            <div class="page-header mb-4">
                <h4 class="fw-bold mb-1">Site Settings</h4>
                <p class="text-muted mb-0">Manage your website settings</p>
            </div>

            <?php if($success): ?>
            <div class="alert alert-success alert-dismissible fade show">
                <?php echo $success; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php endif; ?>

            <form method="POST">
                <div class="row">
                    <!-- General Settings -->
                    <div class="col-md-6 mb-4">
                        <div class="card h-100">
                            <div class="card-header">
                                <h5 class="mb-0"><i class="fas fa-cog me-2"></i>General Settings</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="site_name" class="form-label">Site Name</label>
                                    <input type="text" class="form-control" id="site_name" name="site_name" value="<?php echo $settingsData['site_name'] ?? ''; ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="site_tagline" class="form-label">Site Tagline</label>
                                    <input type="text" class="form-control" id="site_tagline" name="site_tagline" value="<?php echo $settingsData['site_tagline'] ?? ''; ?>">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Information -->
                    <div class="col-md-6 mb-4">
                        <div class="card h-100">
                            <div class="card-header">
                                <h5 class="mb-0"><i class="fas fa-phone me-2"></i>Contact Information</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="contact_email" class="form-label">Contact Email</label>
                                    <input type="email" class="form-control" id="contact_email" name="contact_email" value="<?php echo $settingsData['contact_email'] ?? ''; ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="contact_phone" class="form-label">Contact Phone</label>
                                    <input type="text" class="form-control" id="contact_phone" name="contact_phone" value="<?php echo $settingsData['contact_phone'] ?? ''; ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <textarea class="form-control" id="address" name="address" rows="2"><?php echo $settingsData['address'] ?? ''; ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Social Media Links -->
                    <div class="col-12 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0"><i class="fas fa-share-alt me-2"></i>Social Media Links</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label for="facebook_url" class="form-label">
                                            <i class="fab fa-facebook me-1 text-primary"></i>Facebook URL
                                        </label>
                                        <input type="text" class="form-control" id="facebook_url" name="facebook_url" value="<?php echo $settingsData['facebook_url'] ?? ''; ?>">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="twitter_url" class="form-label">
                                            <i class="fab fa-twitter me-1 text-info"></i>Twitter URL
                                        </label>
                                        <input type="text" class="form-control" id="twitter_url" name="twitter_url" value="<?php echo $settingsData['twitter_url'] ?? ''; ?>">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="instagram_url" class="form-label">
                                            <i class="fab fa-instagram me-1 text-danger"></i>Instagram URL
                                        </label>
                                        <input type="text" class="form-control" id="instagram_url" name="instagram_url" value="<?php echo $settingsData['instagram_url'] ?? ''; ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i>Save Settings
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
