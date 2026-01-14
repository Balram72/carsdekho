<?php
include 'includes/header.php';

$error = '';

// Get car ID
$id = isset($_GET['id']) ? $_GET['id'] : 0;

// Get car data

    $getcardata = "SELECT * FROM cars WHERE id ='$id'";
    $result = mysqli_query($conn, $getcardata);
    $car = mysqli_fetch_assoc($result);

if(!$car) {
    header("Location: cars.php");
    exit();
}

// Handle form submission
if($_SERVER['REQUEST_METHOD'] == 'POST') {

    $uid = $_POST['uid'];
    $name = $_POST['name'];
    $brand = $_POST['brand'];
    $price = $_POST['price'];
    $carType = $_POST['car_type'];
    $fuelType = $_POST['fuel_type'];
    $isPopular = isset($_POST['is_popular']) ? 1 : 0;
    $isLatest = isset($_POST['is_latest']) ? 1 : 0;
    $status = isset($_POST['status']) ? 1 : 0;

    $fileName = $car['image']; // Keep existing image by default

    // Handle new image upload
    if(isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $allowedTypes = ['image/jpeg', 'image/png','image/jpg','image/gif', 'image/webp'];
        $fileType = $_FILES['image']['type'];

        if(in_array($fileType, $allowedTypes)) {
            // Delete old image
            $oldImage = '../uploads/cars/' . $car['image'];
            if(file_exists($oldImage)) {
                unlink($oldImage);
            }

            // Upload new image
            $fileName = time() . '_' . $_FILES['image']['name'];
            $uploadPath = '../uploads/cars/' . $fileName;
            move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath);
        } else {
            $error = "Invalid file type. Please upload JPG, PNG, GIF or WebP.";
        }
    }

    if(!$error) {

        // Update database
        $updateCar ="UPDATE cars SET name = '$name', brand ='$brand', price = '$price', image = '$fileName', car_type = '$carType', 
        fuel_type = '$fuelType', is_popular = '$isPopular', is_latest = '$isLatest', status = '$status' WHERE id = '$uid'";
        $res =  mysqli_query($conn,$updateCar);

        header("Location: cars.php?msg=updated");
        exit();

    }
}
?>

        <div class="admin-main p-4">
            <div class="page-header mb-4">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-2">
                        <li class="breadcrumb-item"><a href="cars.php">Cars</a></li>
                        <li class="breadcrumb-item active">Edit Car</li>
                    </ol>
                </nav>
                <h4 class="fw-bold">Edit Car</h4>
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
                                        <input  type="hidden" name="uid" value="<?php echo $car['id']; ?>">
                                        <label for="name" class="form-label">Car Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="name" name="name" value="<?php echo $car['name']; ?>" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="brand" class="form-label">Brand <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="brand" name="brand" value="<?php echo $car['brand']; ?>" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="price" class="form-label">Price <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="price" name="price" value="<?php echo $car['price']; ?>" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="car_type" class="form-label">Car Type <span class="text-danger">*</span></label>
                                        <select class="form-select" id="car_type" name="car_type" required>
                                            <option value="Hatchback" <?php echo $car['car_type'] == 'Hatchback' ? 'selected' : ''; ?>>Hatchback</option>
                                            <option value="Sedan" <?php echo $car['car_type'] == 'Sedan' ? 'selected' : ''; ?>>Sedan</option>
                                            <option value="SUV" <?php echo $car['car_type'] == 'SUV' ? 'selected' : ''; ?>>SUV</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="fuel_type" class="form-label">Fuel Type</label>
                                    <select class="form-select" id="fuel_type" name="fuel_type">
                                        <option value="Petrol" <?php echo $car['fuel_type'] == 'Petrol' ? 'selected' : ''; ?>>Petrol</option>
                                        <option value="Diesel" <?php echo $car['fuel_type'] == 'Diesel' ? 'selected' : ''; ?>>Diesel</option>
                                        <option value="Electric" <?php echo $car['fuel_type'] == 'Electric' ? 'selected' : ''; ?>>Electric</option>
                                        <option value="Hybrid" <?php echo $car['fuel_type'] == 'Hybrid' ? 'selected' : ''; ?>>Hybrid</option>
                                        <option value="CNG" <?php echo $car['fuel_type'] == 'CNG' ? 'selected' : ''; ?>>CNG</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="image" class="form-label">Car Image</label>
                                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
                                    <small class="text-muted">Leave empty to keep current image</small>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Display Options</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="is_popular" name="is_popular" <?php echo $car['is_popular'] ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="is_popular">Show in "Most Searched Cars" section</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="is_latest" name="is_latest" <?php echo $car['is_latest'] ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="is_latest">Show in "Latest Cars" section</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="status" name="status" <?php echo $car['status'] ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="status">Active (visible on website)</label>
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-1"></i>Update Car
                                    </button>
                                    <a href="cars.php" class="btn btn-secondary">Cancel</a>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card bg-light">
                                    <div class="card-body">
                                        <h6 class="fw-bold mb-3">Current Image</h6>
                                        <div id="imagePreview">
                                            <?php if(file_exists('../uploads/cars/' . $car['image'])): ?>
                                                <img src="../uploads/cars/<?php echo $car['image']; ?>" class="img-fluid rounded">
                                            <?php else: ?>
                                                <img src="https://via.placeholder.com/400x300" class="img-fluid rounded">
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
