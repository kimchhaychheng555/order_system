<?php

use Ramsey\Uuid\Rfc4122\UuidV4;

session_start();
include('../config.php');
include('../functions.php');
include('../menu-sidebar.php');

$appFunction = new ApplicationFunction();
$result = $appFunction->checkCurrentLoginUser();

if (isset($_POST["submitOrder"])) {
    $saleId = UuidV4::uuid4();
    $totalPrice = 0;
    $totalQty = 0;

    $jsonobj = json_decode($_POST["saleOrder"]);

    $query = "INSERT INTO data_sale(id, total_price, total_quantity) VALUES('$saleId', $totalPrice, $totalQty)";
    $resp = $dbConn->query($query);
    if ($resp) {
        // Success
    } else {
        return;
    }
    foreach ($jsonobj as $item) {
        // Add Sale Product to Db 
        $spId = UuidV4::uuid4();
        $_price = doubleval($item->product_price);
        $_qty = doubleval($item->product_qty);

        //
        $totalPrice += $_price * $_qty;
        $totalQty += $_qty;

        $addSp = "INSERT INTO data_sale_product(id, price, quantity, sale_id) VALUE('$spId', $_price, $_qty, '$saleId')";
        $resp = $dbConn->query($addSp);
        if (!$resp) {
            break;
        }
    }
}

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

            <div class="sale-wrap" id="saleProductOrder">
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
                    <form action="" method="POST" id="formSubmitOrder">
                        <div class="sale-product-order" id="saleOrderItem">

                        </div>
                        <div class="sale-order-summary">
                            <div class="total-summary">
                                <div class="data-summary">
                                    <span class="label">Quantity</span>
                                    <span class="label" id="totalSaleOrderQuantity">0</span>
                                </div>
                                <div class="data-summary">
                                    <span class="label">Price</span>
                                    <span class="label" id="grandTotalSaleOrder">$0.00</span>
                                </div>
                                <div class="sale-order-action">
                                    <button name="submitOrder" class="btn btn-success" id="btnSubmitOrder"
                                        disabled>Submit
                                        Order</button>
                                    <input name="saleOrder" id="saleOrderList" hidden>
                                    <div style="width: 10px;"></div>
                                    <button id="btnPrintOrder" class="btn btn-info" disabled>Print</button>
                                </div>
                            </div>
                        </div>
                    </form>
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

<script src="../assets/js/jquery.number.min.js"></script>
<script src="../assets/js/sale.js"></script>

</html>