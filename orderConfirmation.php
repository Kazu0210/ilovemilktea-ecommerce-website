<?php
session_start();

require 'db.php';

if(isset($_POST['delete'])){
    $order_id = $_POST['order_id'];
    $sql = "DELETE FROM orders WHERE order_id = $order_id";
    $result = mysqli_query($conn, $sql);
    header("Location: menu.php");
}
else if(isset($_POST['edit'])){
    $order_id = $_POST['order_id'];
    $product_name = $_POST['product_name'];
    $flavor = $_POST['flavor'];
    $quantity = $_POST['quantity'];
    $size = $_POST['size'];
    ?>
    <link rel="stylesheet" href="styles/editQuantity.css">
    <form action="" method="post">
        <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">
        <h1 id="header">Edit Quantity of <span><?php echo $flavor, " " ,$product_name; ?></span></h1>
        <div id="options-container">
            <select name="quantity" id="quantity">
                <option value="<?php echo $quantity; ?>"> <?php echo $quantity; ?> </option>
                <?php for($i=1; $i<=20; $i++){
                    ?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                    <?php
                }?>
            </select>
            <button type="submit" name="saveQuantity">Save</button>
        </div>
    </form>
    <?php
}
else if(isset($_POST['checkout'])){
    header("Location: checkout.php");
}
else if(isset($_POST['save'])){
    $new_address = $_POST['newAddress'];
    $userid = $_SESSION['user_id'];
    $sql = "UPDATE user SET address = '$new_address' WHERE user_id = '$userid'";
    $result = mysqli_query($conn, $sql);
    header("Location: checkout.php");
}
else if(isset($_POST['saveQuantity'])){
    $order_id = $_POST['order_id'];
    $quantity = $_POST['quantity'];

    $sql = "UPDATE orders SET quantity = '$quantity' WHERE order_id = '$order_id'";
    $result = mysqli_query($conn, $sql);
    header('Location: menu.php');
}
else if(isset($_POST['place-order'])){
    $userid = $_SESSION['user_id'];
    $selectAll = "SELECT * FROM orders WHERE user_id = $userid";
    $result = $conn->query($selectAll);

    if($result){
        while($row = mysqli_fetch_assoc($result)){
            $order_id = $row['order_id'];
            $userid = $row['user_id'];
            $flavor_id = $row['flavor_id'];
            $product_name = $row['product_name'];
            $flavor = $row['flavor'];
            $price = $row['price'];
            $size = $row['size'];
            $quantity = $row['quantity'];

            $insertSql = "INSERT INTO checkout (user_id, flavor_id, product_name, flavor, price, size, quantity) VALUES ('$userid', '$flavor_id', '$product_name', '$flavor', '$price', '$size', '$quantity')";

            if($conn->query($insertSql) !== TRUE){
                echo "Error inserting data: ".$conn->error;
            }
        }
    }
    $result->free();
    
    $deleteOrderQuery = "DELETE FROM orders WHERE user_id = $userid";
    $conn->query($deleteOrderQuery);
    header("Location: menu.php");
}
else if(isset($_POST['changeAddress'])){
    header("Location: account.php");
}
else{
    echo "Error selecting data: " . $conn->error;
}
?>