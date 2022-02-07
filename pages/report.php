<?php
session_start();
include('../config.php');
include('../functions.php');
include('../menu-sidebar.php');

$appFunction = new ApplicationFunction();
$appFunction->checkCurrentLoginUser();


// Pagination Structure ======================================================

// Pagination Vairable      
$paging =  doubleval($_GET["paging"] ?? 25);  // Page Selected
$pager = doubleval($_GET["pager"] ?? 1); // Current Page
$keyword = $_GET["keyword"] ?? "";


$_limit = ($paging);
$_offet = (($pager - 1) * $paging);
$query = "
    SELECT 
        id, 
        sale_number,
        total_price, 
        total_quantity
    FROM data_sale 
    WHERE is_deleted = 0
    LIMIT $_limit OFFSET $_offet
    ";
$dataResult =  $dbConn->query($query);

$_queryCount = "SELECT COUNT(id) as count FROM data_sale WHERE is_deleted = 0";
$_countPage = $dbConn->query($_queryCount);
$_fetchCount = ($_countPage->fetch_assoc()['count']);
$_countable = ($_fetchCount) == 0 ? 1 : ($_fetchCount);
$numberOfPage = ceil($_countable / $paging);
// End Pagination Structure ======================================================

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products - <?php echo $appName; ?></title>
    <link rel="stylesheet" href="../assets/css/default.css">
    <link rel="stylesheet" href="../assets/css/product.css">
</head>

<body>
    <div class="wrap-main-header justify-content-between">
        <div class="left-side d-flex align-items-center">
            <span id="btn_toggle_sidebar" class="cursor-pointer"><i class="far fa-bars"></i></span>
            <h6 class="app-bar-name">Products</h6>
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
            $menu->Display("report");
            ?>
        </div>
        <div class="wrap-content-main">
            <div class="product-wrap">
                <div class="product-list-view">
                    <div class="card">
                        <form action="" method="GET" id="form_pagination">
                            <div class="card-body table-body overflow-auto">
                                <div class="table-data">
                                    <table class="table table-hover mb-0">
                                        <thead class="sticky-top">
                                            <tr>
                                                <th style="width: 60px;">#</th>
                                                <th>Sale Number</th>
                                                <th>Amount</th>
                                                <th>Quantity</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            $i = 1;
                                            if ($dataResult) {
                                                if ($dataResult->num_rows > 0) {
                                                    include('../components.php');
                                                    $appCom = new ApplicationComponent();

                                                    while ($row = $dataResult->fetch_assoc()) {
                                                        $no = ($i + $_offet);
                                                        $sale_number = $row['sale_number'];
                                                        $total_qty = $row['total_quantity'];
                                                        $total_price = $row['total_price'];

                                                        $appCom->ComReportList($no, $sale_number, $total_qty, $total_price);
                                                        $i++;
                                                    }
                                                } else {
                                                    echo '
                                                    <tr>
                                                        <td colspan="6" class="text-center p-3">No Data</td>
                                                    </tr>';
                                                }
                                            } else {
                                                echo '
                                                <tr>
                                                    <td colspan="6" class="text-center p-3">No Data</td>
                                                </tr>';
                                            }
                                            ?>

                                        </tbody>
                                    </table>
                                </div>
                                <nav class="footer-nav d-flex justify-content-between align-items-center">
                                    <ul class="pagination">

                                        <li class="page-item <?php echo $pager == 1 ? "disabled" : ""; ?>">
                                            <button name="pager" class="page-link" value="1">First</button>
                                        </li>

                                        <li class="page-item <?php echo $pager == 1 ? "disabled" : ""; ?>">
                                            <button name="pager" class="page-link"
                                                value="<?php echo $pager - 1; ?>">Prev</button>
                                        </li>

                                        <?php
                                        // Loop Pager
                                        for ($i = 1; $i <= $numberOfPage; $i++) {
                                            $active = $i == $pager ? "active" : "";
                                            echo '
                                                <li class="page-item ' . $active . '">
                                                    <button name="pager" class="page-link" value="' . $i . '">' . $i . '</button>
                                                </li>
                                                ';
                                        }
                                        ?>


                                        <li class="page-item <?php echo $pager == $numberOfPage ? "disabled" : ""; ?>">
                                            <button name="pager" class="page-link"
                                                value="<?php echo $pager + 1; ?>">Next</button>
                                        </li>
                                        <li class="page-item <?php echo $pager == $numberOfPage ? "disabled" : ""; ?>">
                                            <button name="pager" class="page-link"
                                                value="<?php echo $numberOfPage; ?>">Last</button>
                                        </li>
                                    </ul>
                                    <div class="select-form">
                                        <select class="form-control" name="paging" id="paging">
                                            <option value="10" <?php echo $paging == 10 ? "selected" : ""; ?>>10
                                            </option>
                                            <option value="25" <?php echo $paging == 25 ? "selected" : ""; ?>>25
                                            </option>
                                            <option value="50" <?php echo $paging == 50 ? "selected" : ""; ?>>50
                                            </option>
                                            <option value="100" <?php echo $paging == 100 ? "selected" : ""; ?>>100
                                            </option>
                                        </select>
                                    </div>
                                </nav>
                            </div>
                        </form>
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


<script src="../assets/js/jquery.number.min.js"></script>




</html>