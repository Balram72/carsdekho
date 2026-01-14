<?php
include 'includes/header.php';

$error = '';

if($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = $_POST['name'];
    $brand = $_POST['brand'];
    $price = $_POST['price'];
    $carType = $_POST['car_type'];
    $fuelType = $_POST['fuel_type'];
    $isPopular = isset($_POST['is_popular']) ? 1 : 0;
    $isLatest = isset($_POST['is_latest']) ? 1 : 0;
    $status = isset($_POST['status']) ? 1 : 0;

    // Handle image upload
    if(isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/webp'];
        $fileType = $_FILES['image']['type'];

        if(in_array($fileType, $allowedTypes)) {
            $fileName = time() . '_' . $_FILES['image']['name'];
            $uploadPath = '../uploads/cars/' . $fileName;

            if(move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath)) {
                // Insert into database

                $addCar = "INSERT INTO cars (name, brand, price, image, car_type, fuel_type, is_popular, is_latest, status,created_at) 
                VALUES('$name', '$brand', '$price', '$fileName', '$carType','$fuelType','$isPopular','$isLatest','$status', now())";
                $result = mysqli_query($conn, $addCar);

                header("Location: cars.php?msg=added");
                exit();
                
            } else {
                $error = "Failed to upload image. Please try again.";
            }
        } else {
            $error = "Invalid file type. Please upload JPG, PNG, GIF or WebP.";
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
                        <li class="breadcrumb-item"><a href="cars.php">Cars</a></li>
                        <li class="breadcrumb-item active">Add Car</li>
                    </ol>
                </nav>
                <h4 class="fw-bold">Add New Car</h4>
            </div>

            <?php if($error): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>

            <div class="card">
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="name" class="form-label">Car Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="e.g. Swift, Suvi, i20" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="brand" class="form-label">Brand <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="brand" name="brand" placeholder="e.g. Maruti, Honda, Hyundai" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="price" class="form-label">Price <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="price" name="price" placeholder="e.g. 8.50 Lakh" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="car_type" class="form-label">Car Type <span class="text-danger">*</span></label>
                                        <select class="form-select" id="car_type" name="car_type" required>
                                            <option value="">Select Type</option>
                                            <option value="Hatchback">Hatchback</option>
                                            <option value="Sedan">Sedan</option>
                                            <option value="SUV">SUV</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="fuel_type" class="form-label">Fuel Type</label>
                                    <select class="form-select" id="fuel_type" name="fuel_type">
                                        <option value="">Select Type</option>
                                        <option value="Petrol">Petrol</option>
                                        <option value="Diesel">Diesel</option>
                                        <option value="Electric">Electric</option>
                                        <option value="Hybrid">Hybrid</option>
                                        <option value="CNG">CNG</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="image" class="form-label">Car Image <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
                                    <small class="text-muted">Recommended Image Type: JPG, PNG, GIF, WebP</small>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Display Options</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="is_popular" name="is_popular">
                                        <label class="form-check-label" for="is_popular">Show in "Most Searched Cars" section</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="is_latest" name="is_latest">
                                        <label class="form-check-label" for="is_latest">Show in "Latest Cars" section</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="status" name="status" checked>
                                        <label class="form-check-label" for="status">Active (visible on website)</label>
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-1"></i>Save Car
                                    </button>
                                    <a href="cars.php" class="btn btn-secondary">Cancel</a>
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
