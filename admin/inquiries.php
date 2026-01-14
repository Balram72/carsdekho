<?php
include 'includes/header.php';

// Handle delete action
if(isset($_GET['delete'])) {
    $id = $_GET['delete'];
    
    $deleteinquiries = "DELETE FROM inquiries WHERE id='$id'";
    $res = mysqli_query($conn, $deleteinquiries);

    header("Location: inquiries.php?msg=deleted");
    exit();
}

// Get all inquiries
$sql = "SELECT * FROM inquiries ORDER BY id DESC";
$inquiries = mysqli_query($conn, $sql);
$inquiriesCount = mysqli_num_rows($inquiries);

?>

        <div class="admin-main p-4">
            <div class="page-header mb-4">
                <h4 class="fw-bold mb-1">Customer Inquiries</h4>
                <p class="text-muted mb-0">View all customer inquiries from the website</p>
            </div>

            <?php if(isset($_GET['msg']) && $_GET['msg'] == 'deleted'): ?>
            <div class="alert alert-success alert-dismissible fade show">
                Inquiry deleted successfully!
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php endif; ?>

            <div class="card">
                <div class="card-body">
                    <?php if($inquiriesCount > 0){ ?>
                        <div class="table-responsive">
                            <table class="table table-hover align-middle text-center">
                                <thead>
                                    <tr >
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Email</th>                                        
                                        <th>Car Types</th>
                                        <th>Date</th>
                                        <th width="100">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $count = 1; ?>
                                    <?php foreach($inquiries as $inquiry): ?>
                                    <tr>
                                        <td><?php echo $count++; ?></td>
                                        <td><strong><?php echo $inquiry['name']; ?></strong></td>
                                        <td>
                                            <a href="tel:<?php echo $inquiry['phone']; ?>" class="text-decoration-none">
                                                <?php echo $inquiry['phone']; ?>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="tel:<?php echo $inquiry['email']; ?>" class="text-decoration-none">
                                                <?php echo $inquiry['email']; ?>
                                            </a>
                                        </td>  
                                    
                                        <td>
                                            <?php
                                            $types = explode(', ', $inquiry['car_types']);
                                            foreach($types as $type) {
                                                echo '<span class="badge bg-info me-1">' . $type . '</span>';
                                            }
                                            ?>
                                        </td>
                                        <td><?php echo date('d M Y, h:i A', strtotime($inquiry['created_at'])); ?></td>
                                        <td>
                                            <a href="inquiries.php?delete=<?php echo $inquiry['id']; ?>" class="btn btn-sm btn-outline-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this inquiry?')">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                            <a href="viewinquiries.php?id=<?php echo $inquiry['id']; ?>" class="btn btn-sm btn-outline-info" title="view" data-bs-target="#myModal">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php }else{ ?>
                        <div class="text-center py-5">
                            <i class="fas fa-envelope-open fa-3x text-muted mb-3"></i>
                            <p class="text-muted">No inquiries yet. Customer inquiries will appear here.</p>
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
