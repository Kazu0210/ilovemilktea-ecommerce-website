<?php
session_start();

$host = 'localhost';
$user = 'root';
$pass = '';
$db_name = 'ilovemilktea';

$conn = mysqli_connect($host, $user, $pass, $db_name);

if(mysqli_connect_errno()){
    die("Failed to Connect MYSQL".mysqli_connect_errno());
}

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT user_id,name,username,phone,gender,address,email,password,birthdate FROM user WHERE user_id = '$user_id'";
    $result = mysqli_query($conn, $sql);

    // Check if the query was successful
    if ($result) {
        // Fetch the first row from the result set
        $row = mysqli_fetch_assoc($result);

        // Check if $row is not null before accessing its values
        if (!$row) {
            echo "User not found!";
        }
    } else {
        echo "Error executing the query: " . mysqli_error($con);
    }
} 

// mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/navbar.css"> <!-- navbar style -->
    <link rel="stylesheet" href="styles/account.css">
    <title>User Details</title>
</head>
<body>
    <section class="container" id="cont1">
      <script src="script.js"></script>
    </section>
    <div class="content-container">
        <div class="tab">
            <button class="tablinks" onclick="openCity(event, 'Info')" id="defaultOpen">Information</button>
            <button class="tablinks" onclick="openCity(event, 'Orders')">Orders</button>
            <!-- <button class="tablinks" onclick="openCity(event, 'Tokyo')">Tokyo</button> -->
        </div>
        <div id="Info" class="tabcontent">
        <h3>Information</h3>
        <div class="information-content">
            <?php if (!empty($row)): ?>
            <form action="edit.php" method="post">
                <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>">
                <label for="name">Full Name: <input type="text" id="name" name="name" value="<?php echo $row['name']; ?>" readonly>
                </label>

                <label for="phone">Phone Number
                    <input type="text" id="phone" name="phone" value="<?php echo $row['phone']; ?>" readonly>
                </label>

                <label for="gender">Gender
                    <input type="text" id="gender" name="gender" value="<?php echo $row['gender']; ?>" readonly>
                </label>

                <label for="address">Address
                    <input type="text" id="address" name="address" value="<?php echo $row['address']; ?>" readonly>
                </label>

                <label for="email">Email
                    <input type="text" id="email" name="email" value="<?php echo $row['email']; ?>" readonly>
                </label>

                <label for="username">Username
                    <input type="text" id="username" name="username" value="<?php echo $row['username']; ?>" readonly>
                </label>

                <label for="password">Password
                    <input type="password" id="password" name="password" value="<?php echo $row['password']; ?>" readonly>
                </label>

                <label for="birthdate">Birthdate
                    <input type="date" id="birthdate" name="birthdate" value="<?php echo $row['birthdate']; ?>" readonly>
                </label>

                <!-- <a href="edit.php"><button type="submit" id="button" name="edit">Edit</button></a> -->
                <button id="button" name="edit">Edit</button>
                <script>
                    let editButton = document.getElementById('button')
                    editButton.addEventListener('click', function(){
                        window.location.href = "edit.php";
                    });
                </script>
            </form>
            <?php else: ?>
                <p>User information not available.</p>
            <?php endif; ?>
        </div>

        </div>

        <div id="Orders" class="tabcontent">
            <h3>Orders</h3>
            <?php if (isset($_SESSION['user_id'])) : ?>
                <?php
                $user_id = $_SESSION['user_id'];
                $sql = "SELECT product_name, flavor, price, size, quantity, status, delivery_option FROM checkout WHERE user_id = '$user_id' AND (status = 'Pending' OR status = 'Confirmed')";
                $result = mysqli_query($conn, $sql);
                ?>
                <table>
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Flavor</th>
                            <th>Price</th>
                            <th>Size</th>
                            <th>Quantity</th>
                            <th>Status</th>
                            <th>Delivery Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                            <tr>
                                <td><?php echo $row['product_name']; ?></td>
                                <td><?php echo $row['flavor']; ?></td>
                                <td><?php echo $row['price']; ?></td>
                                <td><?php echo $row['size']; ?></td>
                                <td><?php echo $row['quantity']; ?></td>
                                <td><?php echo $row['status']; ?></td>
                                <td><?php echo $row['delivery_option']; ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else : ?>
                <h1>Please log in to view orders &nbsp;<div class="cloud"><img src="styles/img/cloud.png" alt=""></div> <a href="login.php"> Login </a></h1>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
<script>
function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>