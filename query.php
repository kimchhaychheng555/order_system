<?php
include("config.php");
$returnValue = "";

if (isset($_GET["action"])) {
    if ($_GET["action"] == "getReport") {
        $id = $_GET["data-id"];

        // Get DAta From Sale 
        $_query = "SELECT * FROM data_sale WHERE id='$id'";
        $res = $dbConn->query($_query);

        // Check Sale Has Record
        if ($res->num_rows > 0) {

            // Get Data From Sale Product Where Sale ID
            $_spQuery = "SELECT 
            p.product_name,
            sp.product_price,
            sp.product_quantity,
            sp.product_amount
            FROM data_sale_product as sp
            INNER JOIN data_product as p
            ON sp.product_id = p.id
            WHERE sp.sale_id = '$id'";


            $_spRes = $dbConn->query($_spQuery);


            $_saleProducts = array();
            // Check Sale Product Has Record
            if ($_spRes->num_rows > 0) {
                while ($row = $_spRes->fetch_assoc()) {
                    array_push($_saleProducts, $row);
                }
            }

            // Add key value of sale Products
            $_jsonData = $res->fetch_assoc();
            $_jsonData["saleProducts"] = $_saleProducts;

            // Return Sale Object
            $returnValue = $_jsonData;
        } else {
            $type["type"] = "error";
            $returnValue = $type;
        }
    } else {
        $type["type"] = "error";
        $returnValue = $type;
    }
}


// Encoding array in JSON format
echo json_encode($returnValue);