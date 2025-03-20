<?php
// Connect to database
session_start();

if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {
    header("Location: home.php");
    exit;
}
require 'db.php';

// Generate random 7 digit number for OTP
$generateOTP = rand(1000000, 9999999);

if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $password = $_POST['password'];
    $otp = $_POST['otp'];

    $stmt = $conn->prepare("INSERT INTO user(name, username, phone, address, email, password, otp) VALUES (?,?,?,?,?,?,?)");
    $stmt->bind_param('ssssssi', $name, $username, $phone, $address, $email, $password, $otp);

    if ($stmt->execute()) {
        // Check if at least one row was affected
        if ($conn->affected_rows > 0) {
            echo "<script> alert('Registration Successful!'); </script>";
            header("Location: home.php");
            $stmt->close();
        } else {
            echo "No rows were affected. Data may not have been inserted.";
        }
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Angkor&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/stylesignin.css">
    <script src="pagechecker.js"></script>
    <title>Registration Form</title>
</head>
<body>
    <div class="cont1">
        <form action="" method="post">
            <h1>Create Account</h1>
            <input type="hidden" name="otp" value="<?php echo $generateOTP; ?>">
            <div class="container">
                <fieldset>
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" placeholder="Name">
                </fieldset>
                <fieldset>
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" placeholder="Username">
                </fieldset>
            </div>
            <fieldset>
                <label for="phone">Phone Number</label>
                <input type="text" name="phone" id="phone" placeholder="Phone">
            </fieldset>
            <fieldset>
                <label for="address">Address</label>
                <input type="text" name="address" id="address" placeholder="Address">
            </fieldset>
            <fieldset>
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="example@email.com">
            </fieldset>
            <fieldset>
                <label for="password">Password</label>
                <div class="cont">
                    <input type="checkbox" name="checkbox" id="checkbox">
                    <input type="password" name="password" id="password" required placeholder="Password">
                </div>
            </fieldset>
            <button type="submit" name="register">Resgister</button>
            <fieldset>
                <p>Alread have an account? <a href="login.php">Login</a></p>
            </fieldset>
        </form>
    </div>
    <script>
        let checkbox = document.getElementById('checkbox');
        let password = document.getElementById('password');

        checkbox.addEventListener("change", function(){
            if (password.type === "password") {
                password.type = "text";
            } else {
                password.type = "password";
            }
        });
    </script>
</body>
</html>