<?php
function pr ($data) {
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}

function prx ($data) {
    echo "<pre>";
    print_r($data);
    echo "</pre>";
    die();
}

function safe_input($data) {
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $database = "my_db";

    // create connection
    $conn = mysqli_connect($hostname,$username,$password,$database);
 
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data = mysqli_real_escape_string($conn, $data);
    return $data;
}