<?php
include 'includes/header.php';

$error = '';

if($_SERVER['REQUEST_METHOD'] == 'POST') {

    $title = $_POST['title'];
    $subtitle = $_POST['subtitle'];
    $link = $_POST['link'] ;
    $status = $_POST['status'] ? 1 : 0;

    // Handle image upload
    if(isset($_FILES['image']) && $_FILES['image']['error'] == 0) {

        $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/webp'];
        $fileType = $_FILES['image']['type'];

        if(in_array($fileType, $allowedTypes)) {
            $fileName = time() . '_' . $_FILES['image']['name'];
            $uploadPath = '../uploads/banners/' . $fileName;

            if(move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath)) {
                // Insert into database
                    $addBanner = "INSERT INTO banners (title,subtitle,image,link,status,created_at) VALUES('$title','$subtitle','$fileName','$link','$status', now())";
                    $result = mysqli_query($conn,$addBanner);
                    header("Location: banners.php?msg=added");
                    exit();
            } else {
                $error = "Failed to upload image. Please try again.";
            }
        } else {
            $error = "Invalid file type. Please upload JPG, PNG or GIF";
        }
    } else {
        $error = "Please select an image to upload.";
    }
}
?>

        <div class="admin-main p-4">
            <div class="page-header mb-4">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-2">
                        <li class="breadcrumb-item"><a href="banners.php">Banners</a></li>
                        <li class="breadcrumb-item active">Add Banner</li>
                    </ol>
                </nav>
                <h4 class="fw-bold">Add New Banner</h4>
            </div>

            <?php if($error): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>

            <div class="card">
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Banner Title <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="title" name="title" required>
                                </div>

                                <div class="mb-3">
                                    <label for="subtitle" class="form-label">Subtitle</label>
                                    <input type="text" class="form-control" id="subtitle" name="subtitle">
                                </div>

                                <div class="mb-3">
                                    <label for="link" class="form-label">Link URL</label>
                                    <input type="text" class="form-control" id="link" name="link" placeholder="https://">
                                </div>

                                <div class="mb-3">
                                    <label for="image" class="form-label">Banner Image <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
                                    <small class="text-muted">Recommended Image Type: JPG, PNG, GIF, WebP</small>
                                </div>

                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="status" name="status" checked>
                                        <label class="form-check-label" for="status">Active</label>
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-1"></i>Save Banner
                                    </button>
                                    <a href="banners.php" class="btn btn-secondary">Cancel</a>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card bg-light">
                                    <div class="card-body">
                                        <h6 class="fw-bold mb-3">Image Preview</h6>
                                        <div id="imagePreview" class="text-center">
                                            <i class="fas fa-image fa-4x text-muted"></i>
                                            <p class="text-muted mt-2">No image selected</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Image preview
document.getElementById('image').addEventListener('change', function(e) {
    var preview = document.getElementById('imagePreview');
    var file = e.target.files[0];

    if(file) {
        var reader = new FileReader();
        reader.onload = function(e) {
            preview.innerHTML = '<img src="' + e.target.result + '" class="img-fluid rounded">';
        }
        reader.readAsDataURL(file);
    }
});
</script>
</body>
</html>
