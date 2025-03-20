<?php
$host = "localhost";
$user = "root";
$password = "";
$db_name = "ilovemilktea";

$conn = new mysqli($host, $user, $password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch products from the database
$sql = "SELECT * FROM user";
$result = $conn->query($sql);

// Check if any rows were returned

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/user.css">
    <title>User Dashboard</title>
</head>
<body>
    <div class="container">
        <div class="container-side">
            <ul>
                <li>
                    <a href="">
                        Back
                    </a>
                </li>
            </ul>
            <h1>DASHBOARD</h1>
            <div class="dropdown">
                <button class="dropbtn" onclick="toggleDropdown()">User Profile</button>
                <div class="dropdown-content">
                    <button class="tab" onclick="showTab('myAccountContent')">My Profile</button>
                    <button class="tab" onclick="showTab('ordersContent')">Orders</button>
                </div>
            </div>
            <div class="container-btn">
                <button class="btn">Log Out</button>
            </div>
        </div>
        <div class="container-box">
            <div class="tab-content" id="myAccountContent">
              <h2>My Profile</h2>
              <div class="content">
                <form action="" method="post">
                    <?php
                    // Assuming $result contains the data fetched from the database
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        ?>
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name" value="<?php echo $row['name']; ?>" required><br>
            
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" value="<?php echo $row['email']; ?>" required><br>
            
                        <label for="address">Address:</label>
                        <textarea name="address" id="address" cols="30" rows="5" required><?php echo $row['address']; ?></textarea><br>


                        <label for="pnumber">Phone Number:</label>
                        <input type="text" id="pnumber" name="pnumber" value="<?php echo $row['phone']; ?>" required><br>
            
                        <label for="gender">Gender</label>
                        <input type="text" id="gender" name="gender" value="<?php echo $row['gender']; ?> " required><br>
                   
                        <label for="date">Birthday:</label>
                        <input type="date" id="date" name="date" value="<?php echo $row['birthdate']; ?>" required><br>

                        <a href="edit.php?id=<?php echo $row['user_id']; ?>"><button type="button" id="btn1" name="updt">Edit</button></a>
                       
                        <?php
                    } else {
                        // If no data found, display empty inputs
                        ?>
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name" required><br>
            
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required><br>
            
                        <label for="address">Address:</label>
                        <textarea name="address" id="address" cols="30" rows="5" required></textarea><br>
            
                        <label for="pnumber">Phone Number:</label>
                        <input type="text" id="pnumber" name="pnumber" required><br>
            
                        <label for="gender" required>Gender</label>
                        <input type="text" id="gender" name="gender" required><br>
            
                        <label for="date">Birthday:</label>
                        <input type="date" id="date" name="date" required><br>
                        <?php
                    }
                    ?>
                    <!-- <input type="submit" name="submit" value="Submit"> -->
                </form>
            
              </div>
            </div>
            <div class="tab-content active" id="ordersContent">
                <div class="content-box">
                    <h2>Order List</h2>
                        <div class="content-table">
                            <?php
                                $host = "localhost";
                                $user = "root";
                                $password = "";
                                $db_name = "ilovemilktea";

                                $conn = new mysqli($host, $user, $password, $db_name);

                                // Check connection
                                if ($conn->connect_error) {
                                    die("Connection failed: " . $conn->connect_error);
                                }

                                // Fetch products from the database
                                $sql = "SELECT * FROM orders";
                                $result = $conn->query($sql);

                                // Check if any rows were returned

                                $conn->close();
                                ?>
                                <table>
                                    <tr>
                                        <th>#</th>
                                        <th>Milktea Flavor</th>
                                        <th>Size</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Action</th>
                                    </tr>
                                    <?php
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>" . $row["user_id"] . "</td>";
                                            echo "<td>" . $row["flavor"] . "</td>";
                                            echo "<td>" . $row["size"] . "</td>";
                                            echo "<td>" . $row["price"] . "</td>";
                                            echo "<td>
                                                <form action='delete.php' method='POST'>
                                                    <input type='hidden' name='id' value='" . $row["id"] . "'>
                                                    <input type='submit' name='delete' value='DELETE'>
                                                </form>
                                                </td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='4'>No products found</td></tr>";
                                    }
                                ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

    <script>
        function toggleDropdown() {
            var dropdown = document.querySelector('.dropdown');
            dropdown.classList.toggle('active');
        }

        function showTab(tabId) {
            // Hide all tab contents
            var tabContents = document.querySelectorAll('.tab-content');
            tabContents.forEach(function (content) {
                content.classList.remove('active');
            });

            // Deactivate all tabs
            var tabs = document.querySelectorAll('.tab');
            tabs.forEach(function (tab) {
                tab.classList.remove('active');
            });

            // Show the selected tab content
            var activeTabContent = document.getElementById(tabId);
            activeTabContent.classList.add('active');

            // Activate the selected tab
            var activeTab = document.querySelector('.tab[data-tab="' + tabId + '"]');
            activeTab.classList.add('active');
        }
    </script>
</body>
</html>