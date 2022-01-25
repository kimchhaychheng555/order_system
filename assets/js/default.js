$(window).on("load", function () {
    $(".wrap-spinner").delay(200).fadeOut(100);
})


$(document).ready(function () {
    $("#btn_toggle_sidebar").click(function () {
        UI_Slider_Toggle();
    });


    $("#imgInp").change(function () {
        readURL(this);
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

