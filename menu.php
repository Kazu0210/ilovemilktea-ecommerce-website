<?php
session_start();
require 'db.php';
// if (!isset($_SESSION['user_id']) && !isset($_SESSION['username'])) {
//     echo "";
//     exit;
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/menu.css">
    <link rel="stylesheet" href="styles/navbar.css">
    <title>Document</title>
</head>
<body>
    <section id="cont1">
        <script src="script.js"></script>
    </section>

    <section id="cont2">
        <div id="products-cont">
            <div class="carousel" id="carousel">
                <?php
                $sqlCategories = "SELECT DISTINCT flavor_type FROM flavors";
                $resultCategories = $conn->query($sqlCategories);
                while ($row = mysqli_fetch_assoc($resultCategories)) {
                    $category = $row['flavor_type'];
                    $CapitalizedCategory = ucfirst($category);
                    echo '
                        <div class="productName-cont">
                            <a class="productLink" href="?flavor=' . urlencode($category) . '">'.$CapitalizedCategory.'</a>
                            <span></span>
                        </div>
                    ';
                }
                ?>
            </div>

            <div class="flavors-cont">
                <?php
                if (isset($_GET['flavor'])) {
                    $selectedFlavor = $_GET['flavor'];
                    $sqlFlavors = "SELECT * FROM flavors WHERE flavor_type = '$selectedFlavor'";
                    $resultFlavors = $conn->query($sqlFlavors);

                    echo "<input type='hidden' name='flavor_type' value='$selectedFlavor'>";

                    while ($row = mysqli_fetch_assoc($resultFlavors)) {
                        $flavor_id = $row['flavor_id'];
                        $flavor_type = $row['flavor_type'];
                        $name = $row['flavor_name'];
                        $CapitalizedName = ucfirst($name);
                        $price = $row['price'];
                        $size = $row['size'];
                    ?>
                        <div id="flavor">
                            <form action="addToCart.php" method="post">
                                <input type='hidden' name='flavor_id' value='<?php echo $flavor_id ?>'>
                                <input type='hidden' name='flavor_type' value='<?php echo $flavor_type ?>'>
                                <input type='hidden' name='flavor_name' value='<?php echo $CapitalizedName ?>'>
                                <input type="hidden" name="price" value='<?php echo $price ?>'>
                           
                                <h3 id="flavorName"><?php echo $CapitalizedName ?></h3>
                                <h3 id="price"><?php //echo $price; ?></h3>
                              
                                <div id="quantity-size-container">
                                    <div id="quantityContainer">
                                        <select name="quantity" id="quantity">
                                            <?php
                                            for($i=1; $i<=20; $i++){
                                                ?>
                                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <select name="size" id="size">
                                        <option value="<?php echo $size ?>">Regular</option>
                                        <option value="Large">Large</option>
                                        <option value="Extra Large">Extra Large</option>
                                    </select>
                                </div>
                          
                                <div id="button-container">
                                    <!-- <button type="submit" name="BuyNow">Buy Now</button> -->
                                    <h3 id="price"><?php echo $price; ?></h3>
                                    <button type="submit" name="addToCart">Add to cart</button>
                                </div>
                            </form>
                        </div>
                    <?php
                    }
                }
                ?>
            </div>
        </div>

        <div id="bag">
            <div id="items-container">
                <?php
                if(!isset($_SESSION['user_id']) && !isset($_SESSION['password'])){
                    ?>
                    <h1 id="alertText">You are not Logged in.</h1>
                        <script>
                            let item = document.getElementById('item');
                            item.style.backgroundColor = 'transparent';
                            item.style.border = 'none';
                            item.style.justifyContent = 'center';
                            let alertText = document.getElementById("alertText");
                                alertText.style.fontWeight = "bold";
                            alertText.style.textAlign = "center";
                            alertText.style.fontSize = '1.05rem';
                            alertText.style.color = '#715655';
                        </script>
                    <?php
                }else{
                    $user_id = $_SESSION['user_id'];
                    $sqlOrders = "SELECT * FROM orders WHERE user_id = $user_id";

                    $result = $conn->query($sqlOrders);

                    $totalAmount = 0; 
                    if($result){
                        while($row = mysqli_fetch_assoc($result)){
                            $order_id = $row['order_id'];
                            $flavor_id = $row['flavor_id'];
                            $product_name = $row['product_name'];
                            $flavor = $row['flavor'];
                            $quantity = $row['quantity'];
                            $price = $row['price']*$quantity;
                            $size = $row['size'];
                            $totalAmount += $price;
                            
                            ?>
                            <div id="Bagflavor">
                                <form action="orderConfirmation.php" method="post">
                                    <input type="hidden" name="order_id" value="<?php echo $order_id; ?>"> 
                                    <input type="hidden" name="product_name" value="<?php echo $product_name; ?>">
                                    <input type="hidden" name="flavor" value="<?php echo $flavor; ?>">
                                    <input type="hidden" name="quantity" value="<?php echo $quantity; ?>">
                                    <input type="hidden" name="size" value="<?php echo $size; ?>">

                                    <div id="product-info-container">
                                        <h3 id="flavorName"><?php echo $flavor; ?></h3>
                                        <p id="product_name"><?php echo $product_name; ?></p>
                                        <div id="size-quantity-container">
                                            <p id="size"><?php echo $size; ?></p>
                                            <p id="quantity">x<?php echo $quantity; ?></p>
                                        </div>
                                    </div>
                                    <div id="price-buttons-container">
                                        <div id="price-container">
                                            <p id="price"> <?php echo '&#8369; '.number_format($price, 2); ?> </p>
                                        </div>
                                        <div id="buttons-container">
                                            <button type="submit" name="edit" id="edit">Edit</button>
                                            <button type="submit" name="delete" id="delete">Delete</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <?php
                        }
                    }
                }

                ?>
            </div>
            <div id="checkout-container">
                <form action="orderConfirmation.php" method="post">
                    <div id="total-checkoutBttn">
                        <div id="total-container">
                            <h3 id="total">Total</h3>
                            <h3 id="amount">₱ <?php echo (!isset($_SESSION['user_id']) && !isset($_SESSION['username'])) ? "0.00" : number_format($totalAmount, 2); ?></h3>
                        </div>
                        <button type="submit" id="checkout-bttn" name="checkout">Proceed to Checkout</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</body>
</html>