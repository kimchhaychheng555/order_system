<?php
class ApplicationComponent
{

    static function ComProductDisplay($id, $productName, $productPrice, $productImage)
    {
        $price = '$ ' . number_format($productPrice, 2, '.', ',');
        echo "
                <div onclick='onProductClick()' class='product' data-id='$id' data-product-name='$productName' data-product-price='$productPrice', data-product-image='$productImage'>
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
}