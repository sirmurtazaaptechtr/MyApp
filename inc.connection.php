<?php
ob_start();
session_start();

include('inc.functions.php');

$hostname = "localhost";
$username = "root";
$password = "";
$database = "my_db";

// create connection
$conn = mysqli_connect($hostname,$username,$password,$database);

// check connection
if(!$conn) {
    die();
}else {
    // echo "$database is connected successfully!";
}
?>