<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get data from the POST request
    $userInput = $_POST['userInput'];

    // Process the data (you can perform any PHP operations here)
    
    // For example, let's just send back a response
    echo "You entered: $userInput";
} else {
    echo "Invalid request";
}
?>