$(window).on("load", function () {
    /*----- Preloader -----*/
    $(".preloader").fadeOut("slow");
});

$(document).ready(function () {
    /*----- Navbar Shrink -----*/
    $(window).on("scroll", function () {
        if ($(this).scrollTop() > 70) {
            $(".navbar").addClass("navbar-shrink");
            $(".navbar-brand").removeClass("d-lg-none");
        } else {
            $(".navbar").removeClass("navbar-shrink");
            $(".navbar-brand").addClass("d-lg-none");
        }
    });

    /*----- Page Scroll -----*/
    $.scrollIt({
        topOffset: -50,
    });

    /*----- Navbar Collapse -----*/
    $(".nav-link").on("click", function () {
        $(".navbar-collapse").collapse("hide");
    });
});
