<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db_name = 'ilovemilktea';

$conn = mysqli_connect($host, $user, $pass, $db_name);

if(mysqli_connect_errno()){
    die("Failed to Connect MySQL".mysqli_connect_errno());
}

?>