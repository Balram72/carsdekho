<?php
include 'includes/header.php';

$error = '';

// Get banner ID
$id = isset($_GET['id']) ? $_GET['id'] : 0;

// Get banner data
    $getbannerdata = "SELECT * FROM banners WHERE id ='$id'";
    $result = mysqli_query($conn, $getbannerdata);
    $banner = mysqli_fetch_assoc($result);
   
if(!$banner) {
    header("Location: banners.php");
    exit();
}

// Handle form submission
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $title = $_POST['title'];
    $subtitle = $_POST['subtitle'];
    $link = $_POST['link'];
    $status = $_POST['status'] ? 1 : 0;
    $uid = $_POST['id'];

    $fileName = $banner['image']; // Keep existing image by default

    // Handle new image upload
    if(isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $allowedTypes = ['image/jpeg', 'image/png','image/jpg', 'image/gif', 'image/webp'];
        $fileType = $_FILES['image']['type'];

        if(in_array($fileType, $allowedTypes)) {
            // Delete old image
            $oldImage = '../uploads/banners/' . $banner['image'];
            if(file_exists($oldImage)) {
                unlink($oldImage);
            }

            // Upload new image
            $fileName = time() . '_' . $_FILES['image']['name'];
            $uploadPath = '../uploads/banners/' . $fileName;
            move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath);
        } else {
            $error = "Invalid file type. Please upload JPG, PNG, GIF or WebP.";
        }
    }

    if(!$error) {

        // Update database

            $updateBanner = "UPDATE banners SET title = '$title', subtitle = '$subtitle', image = '$fileName', link = '$link', status = '$status' WHERE id = '$id'";
            $res = mysqli_query($conn, $updateBanner);

            header("Location: banners.php?msg=updated");
            exit();
    }
}
?>

        <div class="admin-main p-4">
            <div class="page-header mb-4">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-2">
                        <li class="breadcrumb-item"><a href="banners.php">Banners</a></li>
                        <li class="breadcrumb-item active">Edit Banner</li>
                    </ol>
                </nav>
                <h4 class="fw-bold">Edit Banner</h4>
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
                                    <input type="text" class="form-control" id="title" name="title" value="<?php echo $banner['title']; ?>" required>
                                    <input type="hidden" name="uid" value="<?php echo $banner['id']; ?>">
                                </div>

                                <div class="mb-3">
                                    <label for="subtitle" class="form-label">Subtitle</label>
                                    <input type="text" class="form-control" id="subtitle" name="subtitle" value="<?php echo $banner['subtitle']; ?>">
                                </div>

                                <div class="mb-3">
                                    <label for="link" class="form-label">Link URL</label>
                                    <input type="text" class="form-control" id="link" name="link" value="<?php echo $banner['link']; ?>">
                                </div>

                                <div class="mb-3">
                                    <label for="image" class="form-label">Banner Image</label>
                                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
                                    <small class="text-muted">Leave empty to keep current image</small>
                                </div>

                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="status" name="status" <?php echo $banner['status'] ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="status">Active</label>
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-1"></i>Update Banner
                                    </button>
                                    <a href="banners.php" class="btn btn-secondary">Cancel</a>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card bg-light">
                                    <div class="card-body">
                                        <h6 class="fw-bold mb-3">Current Image</h6>
                                        <div id="imagePreview">
                                            <?php if(file_exists('../uploads/banners/' . $banner['image'])): ?>
                                                <img src="../uploads/banners/<?php echo $banner['image']; ?>" class="img-fluid rounded">
                                            <?php else: ?>
                                                <img src="https://via.placeholder.com/400x200" class="img-fluid rounded">
                                            <?php endif; ?>
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
