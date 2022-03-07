var checkName = "", checkPrice = "";
$("#product_name").on('input', function () {
    checkName = $(this).val();
    checkValidate();
});
$("#product_price").on('input', function () {
    checkPrice = $(this).val();
    checkValidate();
});


function checkValidate() {

    if (checkName != "" && checkPrice != "") {
        $("#btnAddProduct").removeAttr("disabled");
        return;
    }
    $("#btnAddProduct").attr("disabled", "disabled");
}