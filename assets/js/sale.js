$(document).ready(function () {



});

function onProductClick(e) {
    var id = $(this).attr('data-id');
    var productName = $(this).attr('data-product-name');
    var productPrice = $(this).attr('data-product-price');
    var productImage = $(this).attr('data-product-image');

    console.log(id);
    console.log(productName);
    console.log(productPrice);
    console.log(productImage);
};