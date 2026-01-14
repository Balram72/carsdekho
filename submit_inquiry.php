<?php
require_once 'config/db.php';

// Check if form is submitted
if($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Get form data
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];

    // Get car types (array of checkboxes)
    $carTypes = isset($_POST['car_types']) ? $_POST['car_types'] : [];

    // Validate required fields
    if(empty($name) || empty($phone) || empty($email) || empty($address)) {
        header("Location: inquiry.php?error=Please fill in all required fields");
        exit();
    }

    // Validate at least one car type is selected
    if(empty($carTypes)) {
        header("Location: inquiry.php?error=Please select at least one car type");
        exit();
    }

    // Validate email format
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: inquiry.php?error=Please enter a valid email address");
        exit();
    }

    // Convert car types array to comma-separated string
    $carTypesStr = implode(', ', $carTypes);

    // Insert into database

        $sql = "INSERT INTO inquiries (name, phone, email, address, car_types,created_at) VALUES ('$name','$phone','$email','$address','$carTypesStr',now())";
        $res = mysqli_query($conn, $sql);
        
        if($res){
            
            // Redirect with success message
            header("Location: inquiry.php?success=1");
            exit();

        } else{

            header("Location: inquiry.php?error=Something went wrong. Please try again.");
            exit();

        }
        

} else {

    header("Location: inquiry.php");
    exit();
}
?>
