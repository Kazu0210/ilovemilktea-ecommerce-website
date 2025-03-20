<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if(isset($_POST['inquire'])){
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    try {
        $mail = new PHPMailer(true);
    
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'kurifudokairu0210@gmail.com';
        $mail->Password = 'sxcluncoesrrhaae';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
    
        $mail->setFrom('kurifudokairu0210@gmail.com', $name);
        $mail->addAddress($email);
        $mail->isHTML(true);
    
        $mail->Subject = "Franchise Inquiry";
        $mail->Body = "
        <strong>Name:</strong> $name<br>
        <strong>Phone:</strong> $phone<br>
        <strong>Email:</strong> $email<br>
        <strong>Message:</strong> $message
        ";
    
        $mail->send();
    
        header("Location: franchise.php");
    } catch (Exception $e) {
        echo "Email could not be sent. Error: {$mail->ErrorInfo}";
    }
}
if(isset($_POST['feedback'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    try {
        $mail = new PHPMailer(true);
    
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'kurifudokairu0210@gmail.com';
        $mail->Password = 'sxcluncoesrrhaae';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
    
        $mail->setFrom('kurifudokairu0210@gmail.com', $name);
        $mail->addAddress($email);
        $mail->isHTML(true);
    
        $mail->Subject = "User Feedback";
        $mail->Body = "
        <strong>Name:</strong> $name<br>
        <strong>Email:</strong> $email<br>
        <strong>Message:</strong> $message
        ";
    
        $mail->send();
        header("Location: home.php");
        exit();
    } catch (Exception $e) {
        echo "Email could not be sent. Error: {$mail->ErrorInfo}";
    }
}
?>