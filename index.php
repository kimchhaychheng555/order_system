<?php
session_start();
require('config.php');

$username = $_SESSION["username"] ?? "";
$password = md5($_SESSION["password"] ?? "");


$query = "SELECT id, fullname, username, password, image FROM data_user WHERE username = '$username' AND password = '$password'";
$result = $dbConn->query($query);

if ($result->num_rows > 0) {
    header("Locatino: pages/sale.php");
} else {
    header("Location: pages/login.php");
}