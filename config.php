<?php

// $dbServerName = "45.115.183.164";
// $dbUsername = "root";
// $dbPassword = "chhaylow@2022";
// $dbDatabase = "order_system";

$dbServerName = "localhost";
$dbUsername = "root";
$dbPassword = "123456";
$dbDatabase = "order_system";

// App Setting
$root = "http://localhost:8080/application/order_system";
$appName = "POS System";


$dbConn =  mysqli_connect($dbServerName, $dbUsername, $dbPassword, $dbDatabase);

// Check connection
if (!$dbConn) {
    header("Location: error.php");
    die("Connection failed: " . mysqli_connect_error());
}