<?php
session_start();

if(!isset($_SESSION['user_id']) && !isset($_SESSION['password'])){
    header("Location: menu.php");
    exit();
}

require 'db.php';

function calculatePrice($size, $price) {
    if($size == 'Large'){
        return $price + 10;
    }
    else if($size == 'Extra Large'){
        return $price + 20;
    }
    else{
        return $price;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $flavor_id = $_POST['flavor_id'];
    $flavor_type = $_POST['flavor_type'];
    $flavor_name = $_POST['flavor_name'];
    $price = $_POST['price'];
    $size = $_POST['size'];
    $quantity = $_POST['quantity'];

    if (isset($_POST['addToCart'])) {
        // Calculate the final price based on size
        $finalPrice = calculatePrice($size, $price);

        $checkSql = "SELECT * FROM orders WHERE user_id = '$user_id' AND flavor_id = '$flavor_id'";
        $checkResult = $conn->query($checkSql);

        if($checkResult && $checkResult->num_rows > 0){
            $updateOrder = "UPDATE orders SET quantity = quantity + $quantity WHERE user_id = '$user_id' AND flavor_id = '$flavor_id'";
            $updateResult = $conn->query($updateOrder);
            header("Location: menu.php");
            exit();
        }
        else{
            $stmt = $conn->prepare("INSERT INTO orders (user_id, flavor_id, product_name, flavor, price, size, quantity) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param('isssdsi', $user_id, $flavor_id, $flavor_type, $flavor_name, $finalPrice, $size, $quantity);

            if ($stmt->execute()) {
                if ($conn->affected_rows > 0) {
                    header("Location: menu.php");
                    exit();
                } else {
                    echo "Error: Inserting into the database failed.";
                }
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
        }
        }
}
?>