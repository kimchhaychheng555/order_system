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



function successAlert() {
    $.toast({
        text: "Don't forget to star the repository if you like it.", // Text that is to be shown in the toast
        heading: 'Note', // Optional heading to be shown on the toast
        showHideTransition: 'fade', // fade, slide or plain
        allowToastClose: false, // Boolean value true or false
        hideAfter: 3000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
        stack: false, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
        position: 'top-center', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
        bgColor: '#00b74a',  // Background color of the toast
        textColor: '#ffffff',  // Text color of the toast
        textAlign: 'left',  // Text alignment i.e. left, right or center
        loader: true,  // Whether to show loader or not. True by default
        loaderBg: '#02722f',  // Background color of the toast loader
    });
}