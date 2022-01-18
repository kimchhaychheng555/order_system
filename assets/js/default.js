$(window).on("load", function () {
    $(".wrap-spinner").delay(200).fadeOut(100);
})


$(document).ready(function () {
    $("#btn_toggle_sidebar").click(function () {
        UI_Slider_Toggle();
    });
});

function UI_Slider_Toggle() {
    if ($(window).width() < 992) {
        if ($("#ui_sidebar").width() > 0) {
            $("#avatar_wrap").show();
            $("#ui_sidebar").animate({ width: 0 }, 500);
        } else {
            $("#avatar_wrap").show();
            $("#ui_sidebar").animate({ width: 260 }, 500);
        }
    } else {
        if ($("#ui_sidebar").width() > 50) {
            $("#avatar_wrap").hide();
            $("#ui_sidebar").animate({ width: 50 }, 500);
            $(".wrap-content-main").width($(window).width() - 50);
        } else {
            $("#avatar_wrap").show();
            $("#ui_sidebar").animate({ width: 260 }, 500);
        }
    }
}
