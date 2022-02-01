<?php
session_start();
include('../config.php');
include('../functions.php');
include('../menu-sidebar.php');

$appFunction = new ApplicationFunction();
$result = $appFunction->checkCurrentLoginUser();

?>


<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order - <?php echo $appName; ?></title>
    <link rel="stylesheet" href="../assets/css/default.css">
    <link rel="stylesheet" href="../assets/css/sale.css">
</head>

<body>
    <div class="wrap-main-header justify-content-between">
        <div class="left-side d-flex align-items-center">
            <span id="btn_toggle_sidebar" class="cursor-pointer"><i class="far fa-bars"></i></span>
            <h6 class="app-bar-name">Order</h6>
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
            $menu = new MenuSidebar();
            $menu->Display("sale");
            ?>
        </div>
        <div class="wrap-content-main">

            <!-- Your Code Here -->

            <div class="sale-wrap">

                <div class="product-scroll-controller">

                    <?php

                    $query = "SELECT id, product_name, product_price, product_image, is_deleted FROM data_product";
                    $result =  $dbConn->query($query);
                    if ($result) {
                        if ($result->num_rows > 0) {
                            echo '<div class="product-wrap">';
                            include('../components.php');
                            $appCom = new ApplicationComponent();

                            while ($row = $result->fetch_assoc()) {
                                $id = $row['id'];
                                $product_name = $row['product_name'];
                                $product_price = $row['product_price'];
                                $product_image = $row['product_image'];

                                $appCom->ComProductDisplay($id, $product_name, $product_price, $product_image);
                            }
                            echo '</div>';
                        }
                    } else {
                        echo '
                        <div class="empty-data w-100 h-100">
                            <div class="empty-container">
                                <i class="fas fa-folder-open" style="font-size: 40px;"></i>
                                <span>Empty Data</span>
                            </div>
                        </div>';
                    }
                    ?>


                </div>
                <div class="sale-order-wrap">
                    <div class="sale-product-order" id="saleProductOrder">
                        {{ message }}
                        <div class="sale-order-item">
                            <div class="sale-order-product-name">
                                <h6>Coffee</h6>
                                <p>price: $20.00</p>
                            </div>
                            <div class="sale-order-compute-qty">
                                <i class="fal fa-plus-circle"></i>
                                <div class="sale-order-price">
                                    <h6>5</h6>
                                </div>
                                <i class="fal fa-minus-circle"></i>
                            </div>
                            <div class="sale-order-product-total-price">
                                <h6>$ 100.00</h6>
                            </div>
                        </div>
                    </div>
                    <div class="sale-order-summary">
                        <div class="total-summary">
                            <div class="data-summary">
                                <span class="label">Quantity</span>
                                <span class="label">5</span>
                            </div>
                            <div class="data-summary">
                                <span class="label">Price</span>
                                <span class="label">$100.00</span>
                            </div>
                            <div class="sale-order-action">
                                <button class="btn btn-success">Submit Order</button>
                                <div style="width: 10px;"></div>
                                <button class="btn btn-info">Print</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- End Code Here -->

        </div>

    </div>
</body>


<script src="../assets/js/jquery-3.6.0.min.js"></script>

<script src="../assets/js/bootstrap/bootstrap.min.js"></script>
<script src="../assets/js/bootstrap/bootstrap.bundle.min.js"></script>
<script src="../assets/js/mdb/mdb.min.js"></script>
<script src="../assets/js/default.js"></script>
<script src="../assets/js/vue.js"></script>
<script src="../assets/js/jquery.toast.min.js"></script>
<script src="../assets/js/sale.js"></script>

</html>