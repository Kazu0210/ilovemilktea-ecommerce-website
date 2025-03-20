<!-- <?php

session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

require 'db.php';

if (isset($_POST['signup'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $otps = $_POST['otp'];

    $_SESSION['otp'] = $otps;
    

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO user (name, email, username, password, status, otp) VALUES ('$name', '$email', '$username', '$hashedPassword', 'inactive', '$otps')";
    mysqli_query($con, $query);

    try {
        $mail = new PHPMailer(true);
    
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'kurifudokairu0210@gmail.com';
        $mail->Password = 'sxcluncoesrrhaae';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
    
        $mail->setFrom('kurifudokairu0210@gmail.com');
        $mail->addAddress($email);
        $mail->isHTML(true);
    
        $mail->Subject = "Your Account verification code is:";
        $mail->Body = "
                        <strong>$otps</strong>
                        Don't share this code with anyone; our employees will never ask for the code.";
    
        $mail->send();
    
        echo "<script>
        alert('Check your email for OTP.'); 
            </script>";
    } catch (Exception $e) {
        echo "Email could not be sent. Error: {$mail->ErrorInfo}";
    }



    if (!isset($_SESSION['otp'])) {
        echo "Wala";
        exit;
    } else {
        $_SESSION['otp'];
    }

}
?> -->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Enter OTP</h1>
    <form action="confirm.php" method="post">
        <input type="hidden" name="con_name" value="<?php echo $name; ?>"> 
        <input type="hidden" name="con_email" value="<?php echo $email; ?>"> 
        <input type="hidden" name="con_username" value="<?php echo $username; ?>">
        <input type="hidden" name="con_password" value="<?php echo $password; ?>">
        <input type="hidden" name="org_otp" value="<?php echo $otps; ?> ">
        <input type="text" name="confirm_otp" id="confirm_otp"> 
        <input type="submit" name="confirm" value="Confirm">

    </form>
</body>
</html>