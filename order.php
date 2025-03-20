<?php
session_start();

if (!isset($_SESSION['user_id']) && !isset($_SESSION['username'])) {
    header("Location: home.php");
    exit;
}

require 'db.php';

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

$conn->close();
?>
