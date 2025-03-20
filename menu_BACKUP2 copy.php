<?php
session_start();

require 'db.php';

$sqlCategories = "SELECT DISTINCT flavor_type FROM flavors";
$resultCategories = $conn->query($sqlCategories);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/navbar.css">
    <link rel="stylesheet" href="styles/menu.css">
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

                    // echo "<h2>You selected: $selectedFlavor</h2>";

                    $sqlFlavors = "SELECT * FROM `flavors` WHERE flavor_type = '$selectedFlavor'";
                    $resultFlavors = $conn->query($sqlFlavors);

                    echo "<input type='hidden' name='flavor_type' value='$selectedFlavor'>";

                    while ($row = mysqli_fetch_assoc($resultFlavors)) {
                        $flavor_id = $row['flavor_id'];
                        $flavor_type = $row['flavor_type'];
                        $name = $row['flavor_name'];
                        $CapitalizedName = ucfirst($name);
                        $price = $row['price'];
                    ?>
                        <div id="flavor">
                            <form action="addToCart.php" method="post">
                                <input type='hidden' name='flavor_id' value='<?php echo $flavor_id ?>'>
                                <input type='hidden' name='flavor_type' value='<?php echo $flavor_type ?>'>
                                <input type='hidden' name='flavor_name' value='<?php echo $CapitalizedName ?>'>
                                <input type="hidden" name="price" value='<?php echo $price ?>'>
                                <h3 id="flavorName"><?php echo $CapitalizedName ?></h3>
                                <h3 id="flavorPrice"><?php echo $price ?></h3>
                                <div id="button-container">
                                    <button type="submit" name="BuyNow">Buy Now</button>
                                    <button type="submit" name="addToCart">+</button>
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
            <div id="bagTitle-cont">
                <h3 id="bagTitle">My Bag</h3>
            </div>
            <form action="orderConfirmation.php" method="post">
                <div id="bag-container">
                    <!-- sample item -->
                    <!-- <div class="item">
                        <div class="productName-flavor-Container">
                            <h1 id="product-Name">Milktea</h1>
                            <h3 id="flavor">Wintermelon</h3>
                        </div>
                        <div id="option-price-Container">
                            <div id="price-container">
                                <h1 id="price">$69.99</h1>
                            </div>
                            <div id="buttons-Container">
                                <button type="submit" name="edit">Edit</button>
                                <button type="submit" name="delete">Delete</button>
                            </div>
                        </div>
                    </div> -->
                    
                    <?php
                    $totalAmount = 0; 
                    if(!isset($_SESSION['user_id']) && !isset($_SESSION['password'])){
                        // echo "You are not logged in.";
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

                        
                            
                        if ($result) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $order_id = $row['order_id'];
                                $flavor_id = $row['flavor_id'];

                                $product = $row['product_name'];
                                $capitalizedProduct = ucfirst($product);

                                $flavor = $row['flavor'];
                                $Capitalizedflavor = ucfirst($flavor);
                                $price = $row['price'];
                                $totalAmount += $price;
                                ?>
                                <div class="item" id="item">
                                    <div class="productName-flavor-Container">
                                        <input type="hidden" name="order_id" value="<?php echo $order_id ?>">
                                        <h1 id="product-Name"><?php echo $capitalizedProduct ?></h1>
                                        <div id="flavorAndAmount">
                                            <h3 id="flavor"><?php echo $Capitalizedflavor ?> <span id="quantity">x1</span></h3>
                                            
                                        </div>
                                    </div>
                                    <div id="option-price-Container">
                                        <div id="price-container">
                                            <h1 id="price"><?php echo '&#8369; '.$price ?></h1>
                                        </div>
                                        <div id="buttons-Container">
                                            <!-- <button type="submit" name="edit">Edit</button> -->
                                            <button type="submit" name="delete">Delete</button>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        } else {
                            echo "Error: " . $conn->error;
                        }
                    }
                    ?>
                    

                
                <div id="total-checkoutBttn">
                    <div id="total-container">
                        <h3 id="total">Total</h3>
                        <h3 id="amount">₱ <?php echo number_format($totalAmount, 2) ?></h3>
                    </div>
                    <button type="submit" id="checkout-bttn" name="checkout">Proceed to Checkout</button>
                </div>
            </form>
        </div>
    </section>


    <script>
        function createCustomElement(elementType, elementID, elementClass, text){
            let div = document.createElement(elementType)
            div.id = elementID;
            div.className = elementClass;

            return div;
        }

        fetch('getProductName.php')
        .then(response => response.json())
        .then(data => {
            let carousel = document.getElementById('carousel');

            data.forEach(item => {
                console.log(item.flavor_type);
                // carousel
                let carousel = document.getElementById('carousel');
            });

        }).catch(error => console.error('Error:', error));

        

        const carousel = document.querySelector('.carousel');
        const productContainers = document.querySelectorAll('.productName-cont');
        const nextButton = document.getElementById('nextButton');
        const prevButton = document.getElementById('prevButton');

        let currentIndex = 0;

        function showProduct(index) {
            const size = productContainers[0].clientWidth * 5; // Display 5 products at a time
            carousel.style.transform = `translateX(${-size * index}px)`;
        }

        function nextProduct() {
            currentIndex = Math.min(currentIndex + 1, productContainers.length - 5);
            showProduct(currentIndex);
        }

        function prevProduct() {
            currentIndex = Math.max(currentIndex - 1, 0);
            showProduct(currentIndex);
        }

        nextButton.addEventListener('click', nextProduct);
        prevButton.addEventListener('click', prevProduct);

        // set product names to upper case
        let productLinks = document.querySelectorAll('.productLink');

        productLinks.forEach(function(productLink) {
            productLink.textContent = productLink.textContent.charAt(0).toUpperCase() + productLink.textContent.slice(1);
        });



    </script>
</body>
</html>