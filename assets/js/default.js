$(window).on("load", function () {
    $(".wrap-spinner").delay(200).fadeOut(100);
})


$(document).ready(function () {

    $("#btn_toggle_sidebar").click(function () {
        UI_Slider_Toggle();
    });

    $("#paging").change(function () {
        $("#form_pagination").submit();
    });


    $(".imgInp").change(function () {
        readURL(this);
    });

    $(".modify_imgInp").change(function () {
        uploadModifyImage(this);
    });


    $(".delete-btn-table").click(function () {
        var product_code = $(this).attr("data-id");
        $("#input_delete_product_code").val(product_code);
        $("#delete_product_code").html(product_code);
    });

    $(".edit-btn-table").click(function () {

        var product_code = $(this).attr("data-product-code");
        var product_image = $(this).attr("data-product-image");
        var product_name = $(this).attr("data-product-name");
        var product_price = $(this).attr("data-product-price");

        $("#modify_product_code").val(product_code);
        $("#modify_product_image").val(product_image);
        $("#modify_product_name").val(product_name);
        $("#modify_product_price").val(product_price);
    });

});

function UI_Slider_Toggle() {
    if ($("#ui_sidebar").width() > 0) {
        $("#avatar_wrap").show();
        $("#ui_sidebar").animate({ width: 0 }, 500);
        $(".wrap-content-main").css("width", "100%");
    } else {
        $("#avatar_wrap").show();
        $("#ui_sidebar").animate({ width: 260 }, 500);
    }
}

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#profile_img').attr('src', e.target.result);
            $('#profile_img').addClass('d-block');
        }

        reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
}

function uploadModifyImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#modify_profile_img').attr('src', e.target.result);
            $('#modify_profile_img').addClass('d-block');
        }

        reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
}

function alertToast(type, title) {

    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "500",
        "timeOut": "1800",
        "extendedTimeOut": "2000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

    if (type == "error") {
        toastr.error(title);
    }
    if (type == "success") {
        toastr.success(title);
    }
    if (type == "warning") {
        toastr.warning(title);
    }
    if (type == "info") {
        toastr.info(title);
    }

}