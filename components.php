<?php
class ApplicationComponent
{

    static function ComProductDisplay($id, $productName, $productPrice, $productImage)
    {
        include('config.php');
        $price = '$ ' . number_format($productPrice, 2, '.', ',');
        echo "
                <div class='product product_item' data-id='$id' data-product-name='$productName' data-product-price='$productPrice', data-product-image='$productImage'>
                    <div class='product-image'>
                        <img src='$productImage'
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

        echo '
        <tr>
            <td style="width: 60px;" class="text-center">' . $no . '</td>
            <td class="product-image-td">
                <div class="product-image">
                    <img src="' . $productImage . '"
                        alt="">
                </div>
            </td>
            <td>' . $productCode . '</td>
            <td>' . $productName . '</td>
            <td>' . $price . '</td>
            <td></td>
        </tr>';
    }
}