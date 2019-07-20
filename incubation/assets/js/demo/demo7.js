/* ----------------------------------
Description: Script for Home Media style
Name: demo7.js
---------------------------------- */

function demo_7() {
    (function($) {

        // menu on-scroll event
        $(window).scroll(function() {
            if ($("nav").offset().top > 50) {
                $("nav").addClass("scroll-nav");
            } else {
                $("nav").removeClass("scroll-nav");
            }
        });

        // masonry grid
        var $grid = $('.portfolio-2 .grid').masonry({
            itemSelector: '.grid-item'
        });
        $grid.imagesLoaded().progress(function() {
            $grid.masonry('layout');
        });

        // video popup
        $('.popup-video').magnificPopup({
            disableOn: 700,
            type: 'iframe',
            mainClass: 'mfp-fade my-media',
            preloader: false
        });

        // masonry layout
        $('.testimonial-4 .all-details-wrapper').masonry({
            itemSelector: '.col-xs-4'
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
        sr.reveal('.content-block-1 .foo', 120);
        sr.reveal('.testimonial-4 .foo', 120);
        sr.reveal('.contact-1 .foo', 120);

    })(jQuery);
}