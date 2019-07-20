/* ----------------------------------
Description: Script for Home Agency
Name: demo1.js
---------------------------------- */

function demo_1() {
    (function($) {

        // menu on-scroll event
        $(window).scroll(function() {
            if ($("nav").offset().top > 50) {
                $("nav").addClass("scroll-nav");
            } else {
                $("nav").removeClass("scroll-nav");
            }
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

        // video popup
        $('.popup-video').magnificPopup({
            disableOn: 700,
            type: 'iframe',
            mainClass: 'mfp-fade my-video',
            preloader: false
        });

        // masonry grid
        var $grid = $('.portfolio-2 .grid').masonry({
            itemSelector: '.grid-item'
        });
        $grid.imagesLoaded().progress(function() {
            $grid.masonry('layout');
        });

        // modify some scrollreveal parameters
        sr.reveal('.foo', {
            duration: 700,
            delay: 300,
            distance: '50px',
            viewFactor: 0.5,
            easing: 'ease-in-out'
        });
        //modify on scroll reveal animation
        sr.reveal('.content-block-8 .foo', 100);

    })(jQuery);
}