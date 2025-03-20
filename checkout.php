<?php
session_start();

if(!isset($_SESSION['user_id']) && !isset($_SESSION['username'])){
    header('Location: menu.php');
    exit();
}
require 'db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/checkout.css">
    <title>Document</title>
</head>
<body>
    <div id="navbar">
        <div id="logo-container">
            <img src="styles/img/ilovemilktea logo.png" alt="ilovemilktea logo" id="logo">
        </div>
        <div id="line-container">
            <div id="vertical-line"></div>
        </div>
        <div id="header-container">
            <h1 id="header">Checkout</h1>
        </div>
    </div>
    <?php
    $user_id = $_SESSION['user_id'];
    $username = $_SESSION['username'];

    $sqlUser = "SELECT * FROM user WHERE user_id = $user_id";
    $UserResult = $conn->query($sqlUser);

    if($UserResult){
        while($row = mysqli_fetch_assoc($UserResult)){
            $name = $row['name'];
            $address = $row['address'];
            $phone = $row['phone'];

            ?>
            <form action="orderConfirmation.php" method="post" id="addressForm">
                <div id="deliveryAdd-container">
                    <div id="addHeader-container">
                        <h1 id="addHeader">Delivery Address</h1>
                    </div>
                    <div id="user-info-container">
                        <div id="col1">
                            <p id="username"><?php echo $name; ?></p>
                            <p id="phone"><?php echo $phone; ?></p>
                        </div>
                        <div id="col2">
                            <p id="address"><?php echo $address; ?></p>
                        </div>
                        <div id="col3">
                            <button type="submit" id="change-address-bttn" name="changeAddress">Change</button>
                        </div>
                      
                    </div>
                    <script>
                        let addressForm = document.getElementById('addressForm');
                        let changeAddressForm = document.getElementById('changeAddressForm');
                        
                        let changeAddButton = document.getElementById('change-address-bttn');
                        changeAddButton.addEventListener('click', function(){
                            window.location.href = 'account.php';
                        })
                    </script>
                </div>
            </form>
            <!-- <form action="orderConfirmation.php" method="post" id="changeAddressForm">
                <h1 id="changeAddressHeader">My Address</h1>
                <input type="text" name="newAddress" id="newAddress" value="<?php //echo $address; ?>">
                <button type="submit" name="save">Save</button>
            </form> -->
       
            <?php
        }
    }
    ?>
    <section>
        <div id="ordered-products-container">
            <div id="orderedHeader-container">
                <h1 id="order-header">Ordered Products</h1>
            </div>
            <div id="products-container">
                <?php
                $user_id = $_SESSION['user_id'];
                $username = $_SESSION['username'];
                $totalAmount = 0;


                $sqlOrder = "SELECT * FROM orders WHERE user_id = $user_id";
                $orderResult = $conn->query($sqlOrder);
                if($orderResult){
                    while($row = mysqli_fetch_assoc($orderResult)){
                        $order_id = $row['order_id'];
                        $flavor_id = $row['flavor_id'];
                        $product_name = $row['product_name'];
                        $flavor = $row['flavor'];
                        $quantity = $row['quantity'];
                        $price = $row['price']*$quantity;
                        $size = $row['size'];
                        $totalAmount += $price;
                        ?>
                        <form action="" id="product">
                            <div id="product-info">
                                <h1 id="product-flavor"><?php echo $flavor; ?></h1>
                                <p id="product-name"><?php echo $product_name; ?></p>
                                <p id="size"><?php echo $size; ?> <span id="quantity"><?php echo " x".$quantity; ?></span></p>
                            </div>
                            <div id="product-price">
                                <h1 id="price"><?php echo "₱ ".number_format($price, 2); ?></h1>
                            </div>
                        </form>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
        <form action="orderConfirmation.php" id="payment-method" method="post">
            <div id="payment-header-container">
                <h1 id="payment-header">Payment Method</h1>
                <div id="delivery-option-container">
                    <p id="delivery-option">Cash on delivery</p>
                </div>
            </div>
            <div id="row1" class="row">
                <p id="subtotal">Merchandise subtotal: <span><?php echo "₱".number_format($totalAmount, 2); ?></span></p>
            </div>
            <div id="row2" class="row">
                <p id="shipping-total">Shipping total: <span><?php $fee = 30; echo "₱".number_format($fee, 2); ?></span></p>
            </div>
            <div id="row3" class="row">
                <p id="total-payment">Total payment: <span><?php $total = $totalAmount+$fee; echo "₱".number_format($total, 2) ?></span></p>
            </div>
            <div id="button-container">
                <button type="submit" id="place-order-button" name="place-order">Place order</button>
            </div>
        </form>
    </section>
</body>
</html>