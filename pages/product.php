<?php
session_start();
include('../config.php');
include('../functions.php');
include('../menu-sidebar.php');

$appFunction = new ApplicationFunction();
$appFunction->checkCurrentLoginUser();



// Add Product Form
if (isset($_POST["add_product"])) {
    $code = $_POST["add_product_code"];
    $name = $_POST["add_product_name"];
    $price = $_POST["add_product_price"];
    $image = "../images/no_image.png";

    // Image FIle
    $fileImage = $_FILES["add_product_image"] ?? "";

    if ($fileImage != "") {
        $uploaddir  = "../uploads/";
        $uploadfile = $uploaddir . ($fileImage['name']);
        if (move_uploaded_file($fileImage["tmp_name"], $uploadfile)) {
            $image = "$root/uploads/" . $fileImage['name'];
        }
    }

    $_selecQ = "SELECT * FROM data_product WHERE product_code = '$code'";
    $_selectResp = $dbConn->query($_selecQ);
    if ($_selectResp->num_rows == 0) {
        $query = "INSERT INTO data_product(product_code, product_name, product_price, product_image) VALUE ('$code','$name', $price,'$image')";
        $resp = $dbConn->query($query);
        if ($resp) {
            // Success
        }
    }
}


// Modify Product Form
if (isset($_POST["modify_product"])) {
    $code = $_POST["add_product_code"];
    $name = $_POST["add_product_name"];
    $price = $_POST["add_product_price"];
    $image = "../images/no_image.png";

    // Image FIle
    $fileImage = $_FILES["add_product_image"] ?? "";

    if ($fileImage != "") {
        $uploaddir  = "../uploads/";
        $uploadfile = $uploaddir . ($fileImage['name']);
        if (move_uploaded_file($fileImage["tmp_name"], $uploadfile)) {
            $image = "$root/uploads/" . $fileImage['name'];
        }
    }


    $query = "UPDATE data_product SET 
            product_name='$name', 
            product_price='$price', 
            product_image = '$image' 
            WHERE product_code = '$code'";
    $resp = $dbConn->query($query);
    if ($resp) {
        // Success
    }
}

// Delete Product
if (isset($_POST["delete_product"])) {
    $code = $_POST['delete_product_code'];

    $query = "UPDATE data_product SET
                is_deleted = 1 WHERE product_code = '$code'";
    $resp = $dbConn->query($query);
    if ($resp) {
        // Success
    }
}

// Delete Product
if (isset($_POST["restore_product"])) {
    $code = $_POST['restore_product_code'];

    $query = "UPDATE data_product SET
                is_deleted = 0 WHERE product_code = '$code'";
    $resp = $dbConn->query($query);
    if ($resp) {
        // Success
    }
}


// Pagination Structure ======================================================

// Pagination Vairable      
$paging =  doubleval($_GET["paging"] ?? 25);  // Page Selected
$pager = doubleval($_GET["pager"] ?? 1); // Current Page
$keyword = $_GET["keyword"] ?? "";


$_limit = ($paging);
$_offet = (($pager - 1) * $paging);
$query = "
    SELECT 
        product_code, 
        product_name, 
        product_price, 
        product_image 
    FROM data_product 
    WHERE is_deleted = 0
    AND product_name LIKE '%$keyword%'
    LIMIT $_limit OFFSET $_offet
    ";
$dataResult =  $dbConn->query($query);

$_queryCount = "SELECT COUNT(id) as count FROM data_product WHERE is_deleted = 0 AND product_name LIKE '%$keyword%'";
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
            $menu->Display("product");
            ?>
        </div>
        <div class="wrap-content-main">
            <div class="product-wrap">
                <div class="product-list-view">
                    <div class="card">
                        <form action="" method="GET" id="form_pagination">
                            <div class="header-panel pb-0">
                                <div>
                                    <input type="text" name="keyword" class="form-control"
                                        value="<?php echo $keyword; ?>" placeholder="Search...">
                                </div>
                                <div class="btn btn-table-action btn-success" data-mdb-toggle="modal"
                                    data-mdb-target="#exampleModal"><i class="fas fa-plus"></i></div>
                            </div>
                            <div class="card-body table-body overflow-auto">
                                <div class="table-data">
                                    <table class="table table-hover mb-0">
                                        <thead class="sticky-top">
                                            <tr>
                                                <th style="width: 60px;">#</th>
                                                <th></th>
                                                <th>Product Code</th>
                                                <th>Product Name</th>
                                                <th>Price</th>
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
                                                        $product_code = $row['product_code'];
                                                        $product_name = $row['product_name'];
                                                        $product_price = $row['product_price'];
                                                        $product_image = $row['product_image'];

                                                        $appCom->ComProductList($no, $product_image, $product_code, $product_name, $product_price);
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

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <form method="POST" enctype="multipart/form-data">
                            <div class="modal-header">
                                <h5 class="modal-title">Add Product</h5>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <div class="add-product-image">
                                        <div class="image">
                                            <img id="profile_img" src="<?php echo $root; ?>/images/no_image.png" alt="">
                                        </div>
                                        <label class="upload_img">
                                            <div class="icon-upload">
                                                <i class="fas fa-camera"></i>
                                            </div>
                                            <input name="add_product_image" class="d-none imgInp"
                                                accept=".gif,.jpg,.jpeg,.png">
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="product_code">Product Code</label>
                                    <input id="product_code" name="add_product_code" class="form-control" type="text"
                                        placeholder="Product Code" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="product_name">Product Name</label>
                                    <input id="product_name" name="add_product_name" class="form-control" type="text"
                                        placeholder="Product Name" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="product_price">Product Price</label>
                                    <input id="product_price" name="add_product_price" class="form-control" type="text"
                                        placeholder="Product Price" autocomplete="off">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-mdb-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success" name="add_product">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            <!-- Modal -->
            <div class="modal fade confirm_modal" id="deleted_product" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form method="POST" enctype="multipart/form-data">
                            <div class="modal-header">
                                <h5 class="modal-title">Delete Product #<span id="delete_product_code"></span></h5>
                            </div>
                            <div class="modal-body">
                                <div class="confirm-modal-delete-icon">
                                    <i class="fal fa-times-circle text-danger"></i>
                                </div>
                                <input type="text" id="input_delete_product_code" value="" name="delete_product_code"
                                    hidden>
                                <p class="text-center">Are you sure ?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-mdb-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-danger" name="delete_product">Delete</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Edit Modal -->
            <div class="modal fade edit_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <form method="POST" enctype="multipart/form-data">
                            <div class="modal-header">
                                <h5 class="modal-title">Modify Product</h5>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <div class="add-product-image">
                                        <div class="image">
                                            <img id="modify_profile_img" src="<?php echo $root; ?>/images/no_image.png"
                                                alt="">
                                        </div>
                                        <label class="upload_img">
                                            <div class="icon-upload">
                                                <i class="fas fa-camera"></i>
                                            </div>
                                            <input name="add_product_image" type="file" class="modify_imgInp d-none"
                                                accept=".gif,.jpg,.jpeg,.png">
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="modify_product_code">Product Code</label>
                                    <input id="modify_product_code" name="add_product_code" class="form-control"
                                        type="text" placeholder="Product Code" autocomplete="off" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="modify_product_name">Product Name</label>
                                    <input id="modify_product_name" name="add_product_name" class="form-control"
                                        type="text" placeholder="Product Name" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="modify_product_price">Product Price</label>
                                    <input id="modify_product_price" name="add_product_price" class="form-control"
                                        type="text" placeholder="Product Price" autocomplete="off">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-mdb-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success" name="modify_product">Save
                                    changes</button>
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
<script src="../assets/js/vue.js"></script>
<script src="../assets/js/jquery.toast.min.js"></script>




</html>