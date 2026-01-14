<?php
include 'includes/header.php';

// Handle delete action
if(isset($_GET['delete'])) {
    $id = $_GET['delete'];

    // Get banner delete data
    $getbannerdata = "SELECT * FROM banners WHERE id ='$id'";
    $res = mysqli_query($conn, $getbannerdata);
    $banner = mysqli_fetch_assoc($res);


    if($banner) {
        // Delete image file
        $imagePath = '../uploads/banners/' . $banner['image'];
        if(file_exists($imagePath)) {
            unlink($imagePath);
        }

        // Delete banners from database
        $deletebanner= "DELETE FROM banners WHERE id = '$id'";
        $result = mysqli_query($conn, $deletebanner);
        header("Location: banners.php?msg=deleted");
    }

    header("Location: banners.php?msg=deleted");
    exit();
}

// get all banners
$sql = "SELECT * FROM banners ORDER BY id DESC";
$banners = mysqli_query($conn, $sql);
$bannersCount = mysqli_num_rows($banners);
?>

        <div class="admin-main p-4">
            <div class="page-header mb-4 d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="fw-bold mb-1">Manage Banners</h4>
                    <p class="text-muted mb-0">Add, edit or delete homepage banners</p>
                </div>
                <a href="add_banner.php" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i>Add Banner
                </a>
            </div>

            <?php if(isset($_GET['msg'])): ?>
            <div class="alert alert-success alert-dismissible fade show">
                <?php
                    if($_GET['msg'] == 'added') echo "Banner added successfully!";
                    if($_GET['msg'] == 'updated') echo "Banner updated successfully!";
                    if($_GET['msg'] == 'deleted') echo "Banner deleted successfully!";
                ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php endif; ?>

            <div class="card">
                <div class="card-body">
                    <?php if($bannersCount > 0){ ?>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th width="80">Image</th>
                                    <th>Title</th>
                                    <th>Subtitle</th>
                                    <th>Status</th>
                                    <th width="150">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($banners as $banner): ?>
                                <tr>
                                    <td>
                                        <?php if(file_exists('../uploads/banners/' . $banner['image'])): ?>
                                            <img src="../uploads/banners/<?php echo $banner['image']; ?>" class="img-thumbnail" width="60">
                                        <?php else: ?>
                                            <img src="https://via.placeholder.com/60x40" class="img-thumbnail">
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo $banner['title']; ?></td>
                                    <td><?php echo $banner['subtitle']; ?></td>
                                    <td>
                                        <?php if($banner['status'] == 1): ?>
                                            <span class="badge bg-success">Active</span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary">Inactive</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="edit_banner.php?id=<?php echo $banner['id']; ?>" class="btn btn-sm btn-outline-primary" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="banners.php?delete=<?php echo $banner['id']; ?>" class="btn btn-sm btn-outline-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this banner?')">
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
                        <i class="fas fa-images fa-3x text-muted mb-3"></i>
                        <p class="text-muted">No banners found. Add your first banner!</p>
                        <a href="add_banner.php" class="btn btn-primary">Add Banner</a>
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
