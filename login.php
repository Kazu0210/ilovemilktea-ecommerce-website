<?php
session_start();

if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {
    header("Location: home.php");
    exit;
}

$host = "localhost";
$user = "root";
$pass = "";
$db_name = "ilovemilktea";

$con = mysqli_connect($host, $user, $pass, $db_name);

if (mysqli_connect_errno()) {
    die("Failed to Connect With MsSQL" . mysqli_connect_errno());
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $con->prepare("SELECT user_id, username, password FROM user WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // $user_id = $row['user_id'];
        // $username = $row['username'];
        // $hashedPassword = $row['password'];


        if($username == $row['username'] && $password == $row['password']){
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['username'] = $row['username'];
            
            echo "alert('Logged in Successfully!');";
            header("Location: home.php");
            exit();
        }
        // if ($status == "active") {
        //     echo "Active";
        //     if (password_verify($password, $hashedPassword)) {
        //         $_SESSION['user_id'] = $user_id;
        //         $_SESSION['username'] = $username;
        //         header("Location: index.php");
        //         exit;
        //     } else {
        //         echo "Incorrect password.";
        //     }
        // } else {
        //     $_SESSION['user_id'] = $user_id;
        //     echo "<script>
        // alert('Inactive Account'); 
        // </script>";
        //     echo " <a href='activate.php' id='activate'>Activate Account</a>";
        // }
       
    } else {
        ?>
        <script>
            alert('No matching user found.');
        </script>
        <?php
    }
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
    <title>Login Form</title>
    <script src="script.js"></script>
    <link rel="stylesheet" href="styles/stylelogin.css">
</head>
<body>
    <div class="cont1">
        <form method="post">
            <h1>Login</h1>
            <fieldset>
                <label for="username">Username</label>
                <input type="text" name="username" id="username" required placeholder="Username">
            </fieldset>
            <fieldset>
                <label for="password">Password</label>
                <div class="cont">
                    <input type="checkbox" name="checkbox" id="checkbox">
                    <input type="password" name="password" id="password" required placeholder="Password">
                </div>
            </fieldset>
            <fieldset>
                <p>Don't have an account? <a href="signup.php">Click here.</a></p>
            </fieldset>
    
            <button type="submit" name="login">Login</button>
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