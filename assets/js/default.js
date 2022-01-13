require('jquery-3.6.0.min.js');
require('bootstrap/bootstrap.min.js');
require('bootstrap/bootstrap.bundle.min.js');

$(window).on("load", function () {
    $(".wrap-spinner").delay(200).fadeOut(100);
})


$(document).ready(function () {
    $("#btn_toggle_sidebar").toggle(function () {
        $("#ui_sidebar").toggle();
    });
});