
$(".viewReportModal").click(function () {
    var id = $(this).attr("data-id");
    $(".print_wrp tbody").html("");
    $.ajax({
        url: '../query.php',
        type: 'GET',
        data: "action=getReport&data-id=" + id + "",
        dataType: 'JSON',
        success: function (response) {
            $("#printReceiptNumber").html(response["sale_number"]);
            $("#printReceiptTotalQty").html(response["quantity"]);
            $("#printReceiptGrandTotal").html(response["grand_total"]);
            $("#printReceiptTotalQty").html(response["quantity"]);

            var _saleProducts = response["saleProducts"];
            for (var i = 0; i < _saleProducts.length; i++) {
                var sp = _saleProducts[i];
                $(".print_wrp tbody").append("<tr><td>" + sp["product_name"] + "</td><td>" + sp["product_price"] + "</td><td>" + sp["product_quantity"] + "</td><td>" + sp["product_amount"] + "</td></tr>");
            }
        }
    });
})