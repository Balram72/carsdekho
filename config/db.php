<?php
// Database Configuration
$host = 'localhost';
$dbname = 'carsdekho';
$username = 'root';
$password = '';
  
$conn = mysqli_connect("$host", "$username", "$password", "$dbname") or die('Connection failed');


// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

?>
