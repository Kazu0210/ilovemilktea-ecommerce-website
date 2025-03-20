<?php
session_start();

$host = "localhost";
$user = "root";
$password = '';
$db_name = "ilovemilktea";

$con = new mysqli($host, $user, $password, $db_name);

// Check connection
if ($con->connect_error) {
    die("Failed to Connect With MySQL: " . $con->connect_error);
}

$user = [];

if (isset($_POST["edit"])) {
    $user_id = $_POST["user_id"];

    $query = "SELECT * FROM user WHERE user_id = '$user_id'";
    $result = mysqli_query($con, $query);
    $user = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/edit.css">
    <title>Edit Customer</title>
</head>
<body>
    <div class="user-detail">
        <div id="header-container">
            <h1 id="header">Edit Information</h1>
        </div>
        <div class="user-inpt">
            <form action="" method="post">
                <div id="container">
                    <input type="hidden" name="user_id" value='<?php echo $user['user_id'] ?? ""; ?>'>
                    <div class="left">
                        <label for="">Full name: <input type="text" name="name" id="name" value='<?php echo $user['name'] ?? ''; ?>' required></label>
                    </div>
                    <div class="right">
                        <label for="">Phone Number: <input type="text" name="phone" id="phone" value='<?php echo $user['phone'] ?? ''; ?>' required ></label>
                    </div>
                </div>

                <div id="container">
                    <div class="left">
                        <label for="">Gender: <input type="text" name="gender" id="gender" value="<?php echo $user['gender'] ??  ""; ?>" required></label>
                    </div>
                    <div class="right"><label for=""></label></div>
                </div>

                <div id="container">
                    <div class="left">
                        <label for="">Address: <input type="text" name="address" id="address" value="<?php echo $user['address'] ?? '';?>" required></label>
                    </div>
                    <div class="right">
                        <label for="">Email: <input type="text" name="email" id="email" value="<?php echo $user['email'] ?? ''; ?>" required></label>
                    </div>
                </div>

                <div id="container">
                    <div class="left">
                        <label for="">Username: <input type="text" name="username" id="username" value="<?php echo $user['username'] ?? ''; ?>" required></label>
                    </div>
                    <div class="right">
                        <label for="">Password: <input type="password" name="password" id="password" value="<?php echo $user['password'] ?? ''; ?>" required></label>
                    </div>
                </div>

                <div id="container">
                    <div class="left">
                    <button type="submit" id="button" name="update">Update</button>
                    </div>
                    <div class="right">
                    
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

<?php
if (isset($_POST['update'])) {
    $user_id = $_POST['user_id'];
    $name = $_POST['name'];
    $phone = $_POST["phone"];
    $gender = $_POST["gender"];
    $address = $_POST["address"];
    $email = $_POST["email"];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "UPDATE user SET name = '$name', address = '$address', phone = '$phone', gender = '$gender', email = '$email', username = '$username', password = '$password' WHERE user_id = '$user_id'";
    $result = mysqli_query($con, $query);

    if ($result) {
        echo "<script>alert('Information Successfully Updated'); window.location.href = 'account.php';</script>";
        exit();
    } else {
        echo "Error Updating User: " . mysqli_error($con);
    }
}

?>
