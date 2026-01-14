<?php
include 'includes/header.php';

// Handle delete action
if(isset($_GET['delete'])) {
    $id = $_GET['delete'];

    // Get car delete Data
    $getcar = "SELECT * FROM cars WHERE id ='$id'";
    $res = mysqli_query($conn, $getcar);
    $car = mysqli_fetch_assoc($res);

    if($car) {
        // Delete image file
        $imagePath = '../uploads/cars/' . $car['image'];
        if(file_exists($imagePath)) {
            unlink($imagePath);
        }

        // Delete car from database
        $deletecar= "DELETE FROM cars WHERE id = '$id'";
        $result = mysqli_query($conn, $deletecar);
        header("Location: cars.php?msg=deleted");
    }

    header("Location: cars.php?msg=deleted");
    exit();
}

// Get all cars
$sql = "SELECT * FROM cars ORDER BY id DESC";
$cars = mysqli_query($conn, $sql);
$carsCount = mysqli_num_rows($cars);
?>

        <div class="admin-main p-4">
            <div class="page-header mb-4 d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="fw-bold mb-1">Manage Cars</h4>
                    <p class="text-muted mb-0">Add, edit or delete car listings</p>
                </div>
                <a href="add_car.php" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i>Add Car
                </a>
            </div>

            <?php if(isset($_GET['msg'])): ?>
            <div class="alert alert-success alert-dismissible fade show">
                <?php
                    if($_GET['msg'] == 'added') echo "Car added successfully!";
                    if($_GET['msg'] == 'updated') echo "Car updated successfully!";
                    if($_GET['msg'] == 'deleted') echo "Car deleted successfully!";
                ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php endif; ?>

            <div class="card">
                <div class="card-body">
                    <?php if($carsCount > 0){?>
                        <div class="table-responsive">
                            <table class="table table-hover align-middle text-center">
                                <thead>
                                    <tr>
                                        <th width="80">Image</th>
                                        <th>Name</th>
                                        <th>Brand</th>
                                        <th>Price</th>
                                        <th>Type</th>
                                        <th>Tags</th>
                                        <th>Status</th>
                                        <th width="150">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($cars as $car): ?>
                                    <tr>
                                        <td>
                                            <?php if(file_exists('../uploads/cars/' . $car['image'])): ?>
                                                <img src="../uploads/cars/<?php echo $car['image']; ?>" class="img-thumbnail" width="60">
                                            <?php else: ?>
                                                <img src="https://via.placeholder.com/60x40" class="img-thumbnail">
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo $car['name']; ?></td>
                                        <td><?php echo $car['brand']; ?></td>
                                        <td><?php echo $car['price']; ?></td>
                                        <td><span class="badge bg-info"><?php echo $car['car_type']; ?></span></td>
                                        <td>
                                            <?php if($car['is_popular']): ?>
                                                <span class="badge bg-warning">Popular</span>
                                            <?php endif; ?>
                                            <?php if($car['is_latest']): ?>
                                                <span class="badge bg-primary">Latest</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if($car['status'] == 1): ?>
                                                <span class="badge bg-success">Active</span>
                                            <?php else: ?>
                                                <span class="badge bg-secondary">Inactive</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a href="edit_car.php?id=<?php echo $car['id']; ?>" class="btn btn-sm btn-outline-primary" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="cars.php?delete=<?php echo $car['id']; ?>" class="btn btn-sm btn-outline-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this car?')">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php }else{ ?>
                        <div class="text-center py-5">
                            <i class="fas fa-car fa-3x text-muted mb-3"></i>
                            <p class="text-muted">No cars found. Add your first car!</p>
                            <a href="add_car.php" class="btn btn-primary">Add Car</a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
