<?php
session_start();

require 'db.php';

$sqlCategories = "SELECT DISTINCT flavor_type FROM flavors";
$resultCategories = $conn->query($sqlCategories);

$data = array();
if($resultCategories->num_rows > 0){
    while($row = $resultCategories->fetch_assoc()){
        $data[] = $row;
    }
}

echo json_encode($data);

$conn->close();
?>