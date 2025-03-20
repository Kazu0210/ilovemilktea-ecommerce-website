<?php
session_start();

$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'ilovemilktea';

$conn = new mysqli($host, $username, $password, $dbname);

if($conn->connect_error){
    die("Connection Failed: ".$conn->connect_errno);
}

$ljaslkdkjaklsdjaklsdjalsjalkskadjaldajlajldj = "SELECT * FROM `flavors`";
$resultFlavors = $conn->query($ljaslkdkjaklsdjaklsdjalsjalkskadjaldajlajldj);

while ($ewan = mysqli_fetch_assoc($resultFlavors)) {
    $flavor = $ewan['flavor_name'];

    // echo $flavor." ";
    
    $_SESSION['flavor'] = $flavor;
}

?>