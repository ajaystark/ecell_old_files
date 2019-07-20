/* ----------------------------------
Description: Script for Home Minimal style
Name: demo8.js
---------------------------------- */
function demo_8() {
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

        // zoom gallery							
        $('.grid').magnificPopup({
            delegate: 'a',
            type: 'image',
            closeOnContentClick: false,
            closeBtnInside: false,
            mainClass: 'mfp-with-zoom mfp-img-mobile',
            image: {
                verticalFit: true
            },
            gallery: {
                enabled: true
            },
            zoom: {
                enabled: true,
                duration: 300,
                opener: function(element) {
                    return element.find('img');
                }
            }
        });

    })(jQuery);
}