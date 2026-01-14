<?php

include 'includes/header.php';

$id = isset($_GET['id']) ? $_GET['id'] : 0;

// Get current settings
$getinquirydata = "SELECT * FROM inquiries WHERE id = '$id'";
$result = mysqli_query($conn, $getinquirydata);
$inquiry = mysqli_fetch_assoc($result);

?>

    <section class="inquiry-section py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="inquiry-form-wrapper bg-white shadow rounded p-4 p-md-5">
                            <h5 class="mb-4">Customer Inquiries Details</h5>

                            <hr class="my-4">

                            <div class="mb-3">
                                <label for="name" class="form-label"> Customer Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" value="<?php echo $inquiry['name']; ?>" disabled>
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label">Customer Phone Number <span class="text-danger">*</span></label>
                                <input type="tel" class="form-control" id="phone" value="<?php echo $inquiry['phone']; ?>" disabled>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Customer Email Address <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="email" value="<?php echo $inquiry['email']; ?>" disabled>
                            </div>

                            
                            <div class="mb-4">
                                <label for="address" class="form-label">Customer Address <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="address" disabled><?php echo $inquiry['address']; ?></textarea>
                            </div>

                            <div class="mb-4">
                                <label for="selectcar" class="form-label">Customer Select Car <span class="text-danger">*</span></label>
                                 <?php $types = explode(', ', $inquiry['car_types']); ?>
                                <input type="text" class="form-control" id="selectcar" value="<?php echo ($inquiry['car_types']); ?>" disabled>
                                   
                            </div>

                            <div class="mb-4">
                                <label for="submitdate" class="form-label">Customer inquiry Submit Date <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="submitdate" value="<?php echo date('d M Y, h:i A', strtotime($inquiry['created_at']))?>"disabled>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
