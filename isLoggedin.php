<?php
session_start();

if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {
    $data = array(
        "user_id" => $_SESSION["user_id"],
        "username" => $_SESSION["username"]
    );
    echo json_encode($data);
} else {
    $data = array(
        "user_id" => '',
        "username" => ''
    );
    echo json_encode($data);
}
?>