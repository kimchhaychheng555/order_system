<?php

$dbServerName = "localhost";
$dbUsername = "root";
$dbPassword = "123456";
$dbDatabase = "order_system";

$dbConn =  mysqli_connect($dbServerName, $dbUsername, $dbPassword, $dbDatabase);

// Check connection
if (!$dbConn) {
    header("Location: error.php");
    die("Connection failed: " . mysqli_connect_error());
}