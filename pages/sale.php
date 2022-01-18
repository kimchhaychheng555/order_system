<?php
session_start();
include('../config.php');
include('../functions.php');

$appFunction = new ApplicationFunction();
$result = $appFunction->checkCurrentLoginUser();

?>


<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/default.css">
    <link rel="stylesheet" href="../assets/css/sale.css">
</head>

<body>
    <div class="wrap-main-header justify-content-between">
        <div class="left-side d-flex align-items-center">
            <span id="btn_toggle_sidebar" class="cursor-pointer"><i class="far fa-bars"></i></span>
            <h6 class="app-bar-name">Dashboard</h6>
        </div>
        <div class="right-side">

        </div>
    </div>
    <div class="wrap-main ">

        <div class="sidebar" id="ui_sidebar">
            <div class="avatar_wrap" id="avatar_wrap">
                <div class="avatar_logo">
                    <img
                        src="<?php echo empty($_SESSION['image']) ? '../images/no_image.png' :  $_SESSION['image']; ?>">
                </div>
                <h6 class="mt-2"><?php echo $_SESSION['fullname'] ?></h6>
            </div>
            <?php
            include("../menu-sidebar.php");
            ?>
        </div>
        <div class="wrap-content-main">

            <!-- Your Code Here -->

            <div class="sale-wrap">

                <div class="product-scroll-controller">
                    <div class="product-wrap">

                        <?php
                        for ($i = 0; $i < 20; $i++) {
                            echo '
                        <div class="product">
                            <div class="product-image">
                                <img src="https://media-cldnry.s-nbcnews.com/image/upload/t_nbcnews-fp-1200-630,f_auto,q_auto:best/newscms/2019_33/2203981/171026-better-coffee-boost-se-329p.jpg"
                                    alt="">
                                <div class="product-price">
                                    <h6>$120.00</h6>
                                </div>
                            </div>
                            <div class="product-name">
                                <h6>Coffee</h6>
                            </div>
                        </div>
                        ';
                        }
                        ?>

                    </div>
                </div>
                <div class="sale-order-wrap">

                </div>
            </div>

            <!-- End Code Here -->

        </div>

    </div>
</body>


<script src="../assets/js/jquery-3.6.0.min.js"></script>
<script src="../assets/js/bootstrap/bootstrap.min.js"></script>
<script src="../assets/js/bootstrap/bootstrap.bundle.min.js"></script>
<script src="../assets/js/default.js"></script>

</html>