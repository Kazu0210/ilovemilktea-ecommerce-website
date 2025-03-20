<?php
session_start();

$host = 'localhost';
$user = 'root';
$pw = '';
$db = 'ilovemilktea';

$conn = new mysqli($host, $user, $pw, $db);

if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_errno);
}

$sqlCategories = "SELECT DISTINCT flavor_type FROM flavors";
$resultCategories = $conn->query($sqlCategories);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="pagechecker.js"></script>
    <title>Document</title>
</head>
<body>
    <div class="categories">
        <h1>Categories</h1>

        <table>
            <?php
            while ($row = mysqli_fetch_assoc($resultCategories)) {
                $category = $row['flavor_type'];
                echo "<tr>";
                echo "<td><a href='?flavor=$category'>$category</a></td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>

    <div class="flavors">
        <?php
        
        if (isset($_GET['flavor'])) {
            $selectedFlavor = $_GET['flavor'];

            echo "<h2>You selected: $selectedFlavor</h2>";

            $sqlFlavors = "SELECT * FROM `flavors` WHERE flavor_type = '$selectedFlavor'";
            $resultFlavors = $conn->query($sqlFlavors);

            echo "<input type='hidden' name='flavor_type' value='$selectedFlavor'>";

            while ($row = mysqli_fetch_assoc($resultFlavors)) {
                $flavor_id = $row['flavor_id'];
                $flavor_type = $row['flavor_type'];
                $name = $row['flavor_name'];
                $price = $row['price'];
            ?>
                <form action="addToCart.php" method="post">
                    <table>
                        <tr>
                            <td>
                                <h3><?php echo $name ?> <?php echo $price?></h3>
                                <input type='hidden' name='flavor_id' value='<?php echo $flavor_id ?>'>
                                <input type='hidden' name='flavor_type' value='<?php echo $flavor_type ?>'>
                                <input type='hidden' name='flavor_name' value='<?php echo $name ?>'>
                                <input type="hidden" name="price" value='<?php echo $price ?>'>
                                <button type='submit' name='addToCart'>Add to Cart</button>
                                <button type="submit" name="buyNow">Buy Now</button>
                            </td>
                        </tr>
                    </table>
                </form>
            <?php
            }
        }
        ?>
    </div>

    <!-- <div class="bag">
        <h1>BAG</h1>
        <?php
        if(!isset($_SESSION['user_id']) && !isset($_SESSION['password'])){
            echo "You are not logged in.";
        }else{
            $user_id = $_SESSION['user_id'];
            $sqlOrders = "SELECT * FROM orders WHERE user_id = $user_id";
            
            $result = $conn->query($sqlOrders);
            
            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $order_id = $row['order_id'];
                    $flavor_id = $row['flavor_id'];
                    $product = $row['product_name'];
                    $flavor = $row['flavor'];
                    ?>
                    <form action="orderConfirmation.php" method="post">
                        <table>
                            <tr>
                                <input type="hidden" name="order_id" value="<?php echo $order_id ?>">
                                <td><p><?php echo $product ?></p></td>
                                <td><p><?php echo $flavor ?></p></td>
                                <td><button type="submit" name="delete">Delete</button></td>
                            </tr>
                        </table>
                    </form>
                    <?php
                }
            } else {
                echo "Error: " . $conn->error;
            }
        }

        ?>
    </div> -->
    <button type="submit" id="home">Go back to Home</button>

    <script>
        let homeButton = document.getElementById('home');
        homeButton.addEventListener('click', function(){
            window.location.href = "home.php";
        })
    </script>

    
</body>
</html>
