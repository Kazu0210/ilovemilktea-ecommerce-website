<?php
session_start();

if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {
    header("Location: home.php");
    exit;
}
else{
    header("Location: login.php");
}


?>