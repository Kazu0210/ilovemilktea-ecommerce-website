<?php
session_start();
require 'db.php';


// Retrieve the selected option from the AJAX request
$selectedOption = $_POST['selectedOption'];
$user_id = $_SESSION['user_id'];

$query = "UPDATE orders SET quantity = '$selectedOption' WHERE user_id = '$user_id'";
// Simulate a successful response
echo 'Database updated successfully';
?>