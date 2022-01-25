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
                <div class="product-header">
                    <button class="btn btn-success" data-mdb-toggle="modal" data-mdb-target="#exampleModal">Add
                        Product</button>
                </div>
                <div class="product-list-view">
                    <div class="card">
                        <div class="card-body overflow-auto">
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
                                        <tr>
                                            <td style="width: 60px;" class="text-center">1</td>
                                            <td class="product-image-td">
                                                <div class="product-image">
                                                    <img src="https://ecomdev.kesspay.io/storage/product/2248/pebaQjmmjyJSDHPkZKD2cCvk1kYWXGlPcswBmWb7.jpeg"
                                                        alt="">
                                                </div>
                                            </td>
                                            <td>Jacob</td>
                                            <td>Thornton</td>
                                            <td>Thornton</td>
                                            <td></td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                            <nav class="footer-nav">
                                <ul class="pagination">
                                    <li class="page-item disabled">
                                        <span class="page-link">Previous</span>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item active" aria-current="page">
                                        <span class="page-link">
                                            2
                                            <span class="visually-hidden">(current)</span>
                                        </span>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">Next</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Product</h5>
                        </div>
                        <div class="modal-body">
                            <form action="" name="add_product">
                                <div class="form-group">
                                    <div class="add-product-image">
                                        <div class="image">
                                            <img src="<?php echo $root; ?>/images/no_image.png" alt="">
                                        </div>
                                        <div class="upload_img">
                                            <i class="fas fa-camera"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="product_name">Product Name</label>
                                    <input id="product_name" class="form-control" type="text"
                                        placeholder="Product Name">
                                </div>
                                <div class="form-group">
                                    <label for="product_name">Product Price</label>
                                    <input id="product_name" class="form-control" type="text"
                                        placeholder="Product Price">
                                </div>
                                <div class="form-group">
                                    <label for="product_name">Product Name</label>
                                    <input id="product_name" class="form-control" type="text"
                                        placeholder="Product Name">
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-mdb-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-success">Save changes</button>
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

</html>