var saleOrderList = [];
var listSaleOrderItem = [];

$(document).ready(function () {
    $(".product_item").click(function () {
        var id = $(this).attr('data-id');
        var productName = $(this).attr('data-product-name');
        var productPrice = $(this).attr('data-product-price');
        var productImage = $(this).attr('data-product-image');

        // If this product already add
        var indexObj = saleOrderList.findIndex(o => o.id === id);

        if (indexObj < 0) {
            var obj = {
                id: id,
                product_name: productName,
                product_price: parseFloat(productPrice),
                product_image: productImage,
                product_qty: 1
            };
            saleOrderList.push(obj);
        } else {
            saleOrderList[indexObj].product_qty++;
        }
        refreshSaleOrder();
        activeProudctOrder();
    });


    $("#btnSubmitOrder").click(function () {
        submitOrder();
    });

    $("#btnPrintOrder").click(function () {
        onPrintClicked();
    });

});

function onMinusSaleOrder(id) {
    var indexObj = saleOrderList.findIndex(o => o.id == id);

    if (saleOrderList[indexObj].product_qty > 1) {
        saleOrderList[indexObj].product_qty--;
    } else {
        saleOrderList.splice(indexObj, 1);
        removeActiveProductOrder(id);
    }
    refreshSaleOrder();
}

function totalSOQty() {
    var totalSaleOrderQuantity = 0;
    var grandTotalSaleOrder = 0;
    for (var so of saleOrderList) {
        totalSaleOrderQuantity += so.product_qty;
        grandTotalSaleOrder += (so.product_qty * so.product_price);
    }

    $("#totalSaleOrderQuantity").text(totalSaleOrderQuantity);
    $("#grandTotalSaleOrder").text("$" + $.number(grandTotalSaleOrder, 2));
}


function refreshSaleOrder() {
    $("#saleOrderItem").html("");

    for (var so of saleOrderList) {
        var saleOrder = saleOrderItem(so.id, so.product_name, so.product_price, so.product_qty);
        $("#saleOrderItem").append(saleOrder);
    }

    if (saleOrderList.length > 0) {
        $("#btnSubmitOrder, #btnPrintOrder").removeAttr("disabled");
    } else {
        $("#btnSubmitOrder, #btnPrintOrder").attr("disabled", "");
    }

    totalSOQty();
}

function activeProudctOrder() {
    var _productLength = $(".product-wrap .product_item").length;
    for (var i = 0; i < _productLength; i++) {
        var _this = $(".product-wrap .product_item").eq(i);

        for (var so of saleOrderList) {
            if (so.id == _this.attr("data-id")) {
                _this.addClass("active");
            }
        }
    }
    totalSOQty();
}

function removeActiveProductOrder(id) {
    var _productLength = $(".product-wrap .product_item").length;
    for (var i = 0; i < _productLength; i++) {
        var _this = $(".product-wrap .product_item").eq(i);
        if (id == _this.attr("data-id")) {
            _this.removeClass("active");
        }
    }
    totalSOQty();
}

function saleOrderItem(id, name, price, qty) {
    var item =
        '<div class="sale-order-item" data-name="' + name + '" data-price="' + price + '" data-qty="' + qty + '">' +
        '<div class="d-flex">' +
        '<div class="sale-order-product-name">' +
        '<h6>' + name + '</h6>' +
        '<p>price: $' + $.number(price, 2) + '</p>' +
        '</div>' +
        '<div class="sale-order-compute-qty">' +
        '<div class="sale-order-price">' +
        '<h6>x' + qty + '</h6>' +
        '</div></div></div>' +
        '<div class="sale-order-product-total-price d-flex">' +
        '<h6>$' + $.number((price * qty), 2) + '</h6>' +
        '<div class="ml-1">' +
        '<button type="button" onclick="onMinusSaleOrder(' + id + ')" class="btn btn-table-action btn-danger minus_sale_order"><i class="fas fa-trash-alt"></i></button>' +
        '</div>' +
        '</div>' +
        '</div>';

    return item;
}

function submitOrder() {
    if (saleOrderList.length == 0) {
        alertToast("warning", "order is empty!");
        return;
    }

    var _value = JSON.stringify(saleOrderList);

    $("#saleOrderList").val(_value);

    $("#formSubmitOrder").submit();
}

function onPrintClicked() {
    // print();
    $('#saleOrderItem').children().each(function () {
        var _name = $(this).attr("data-name");
        var _price = $(this).attr("data-price");
        var _qty = $(this).attr("data-qty");

        var saleOrderItem = { name: _name, price: parseFloat(_price), qty: parseFloat(_qty) };

        listSaleOrderItem.push(saleOrderItem);
    });



    var _grandTotal = 0;
    for (var i = 0; i < listSaleOrderItem.length; i++) {
        _grandTotal += (listSaleOrderItem[i].qty * listSaleOrderItem[i].price);
        var element_print = "<tr><td>" + listSaleOrderItem[i].name + "</td><td>" + listSaleOrderItem[i].qty + "</td><td>" + listSaleOrderItem[i].price + "</td><td>" + (listSaleOrderItem[i].qty * listSaleOrderItem[i].price) + "</td></tr>";
        $("#table_body").append(element_print);
    }

    $("#tfootGrandTotal").text(_grandTotal);
    // listSaleOrderItem.each(function () {
    //     var element_print = "<h2>Hello Testing</h2>";
    //     $("#table_body").append(element_print);
    // });
    print();
}