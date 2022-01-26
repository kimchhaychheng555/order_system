<?php
class ApplicationComponent
{

    static function ComProductDisplay($id, $productName, $productPrice, $productImage)
    {
        include('config.php');

        $image = $productImage ?? "$root/images/no_image.png";
        $price = '$ ' . number_format($productPrice, 2, '.', ',');
        echo "
                <div class='product product_item' data-id='$id' data-product-name='$productName' data-product-price='$productPrice', data-product-image='$productImage'>
                    <div class='product-image'>
                        <img src='$image'
                            alt=''>
                        <div class='product-price'>
                            <h6>$price</h6>
                        </div>
                    </div>
                    <div class='product-name'>
                        <h6>$productName</h6>
                    </div>
                </div>
        ";
    }

    static function ComProductList($no, $productImage, $productCode, $productName,  $productPrice)
    {
        include('config.php');
        $price = '$ ' . number_format($productPrice, 2, '.', ',');
        $image = $productImage ?? "$root/images/no_image.png";
        $data_value = "data-id='$productCode'";

        $data_edit = "data-product-code='$productCode' data-product-image='$productImage' data-product-price='$productPrice' data-product-name='$productName'";

        echo '
        <tr>
            <td style="width: 60px;" class="text-center">' . $no . '</td>
            <td class="product-image-td">
                <div class="product-image">
                    <img src="' . $image . '"
                        alt="">
                </div>
            </td>
            <td>' . $productCode . '</td>
            <td>' . $productName . '</td>
            <td>' . $price . '</td>
            <td class="text-right">
                <button type="button" class="btn btn-table-action btn-warning edit-btn-table"data-mdb-toggle="modal" data-mdb-target=".edit_modal" ' . $data_edit . '><i class="fas fa-pen"></i></button>
                <button type="button" class="btn btn-table-action btn-danger delete-btn-table" data-mdb-toggle="modal" data-mdb-target=".confirm_modal" ' . $data_value . '><i class="fas fa-trash-alt"></i></button>
            </td>
            
        </tr>';
    }
}