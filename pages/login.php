<?php
session_start();
include('../config.php');
include('../functions.php');


$appFunction = new ApplicationFunction();
$appFunction->restoreDatabase();

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST["username"];
    $password = $_POST["password"];


    $query = "SELECT id, fullname, username, password, image FROM data_user WHERE username = '$username' AND password = '$password'";
    $result = $dbConn->query($query);

    if ($result->num_rows > 0) {
        $_SESSION["username"] = $username;
        $_SESSION["password"] = $password;
        header("Location: sale.php");
    } else {
        header("Location: login.php");
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Default CSS -->
    <link rel="stylesheet" href="../assets/css/default.css">
    <!--  -->
    <link rel="stylesheet" href="../assets/css/login.css">
</head>

<body>
    <div class="login-dark">
        <form method="POST">
            <div class="illustration"><i class="fal fa-lock"></i></div>
            <div class="form-group"><input class="form-control" type="text" name="username" placeholder="Username">
            </div>
            <div class="form-group"><input class="form-control" type="password" name="password" placeholder="Password">
            </div>
            <div class="form-group">
                <button class="btn btn-primary btn-block">Log In</button>
            </div>
            <a class="forgot" href="#">Power by</a>
        </form>
    </div>

</body>

</html>