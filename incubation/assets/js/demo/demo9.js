/* ----------------------------------
Description: Script for Home Parallax style
Name: demo9.js
---------------------------------- */

function demo_9() {
    (function($) {

        // menu on-scroll event
        $(window).scroll(function() {
            if ($("nav").offset().top > 50) {
                $("nav").addClass("scroll-nav");
            } else {
                $("nav").removeClass("scroll-nav");
            }
        });

        // video popup
        $('.popup-video').magnificPopup({
            disableOn: 700,
            type: 'iframe',
            mainClass: 'mfp-fade my-media',
            preloader: false
        });

        // parallax initialization
        if (!Modernizr.touch) {
            $(function() {
                $.stellar({
                    horizontalScrolling: false,
                    verticalOffset: 40
                });
            });
        };

        // modify some scrollreveal parameters
        sr.reveal('.foo', {
            duration: 700,
            delay: 300,
            distance: '50px',
            viewFactor: 0.5,
            easing: 'ease-in-out'
        });
        //modify on scroll reveal animation
        sr.reveal('.content-block-17 .foo', 100);
        sr.reveal('.content-block-7 .foo', 100);
        sr.reveal('.contact-1 .foo', 100);

    })(jQuery);
}