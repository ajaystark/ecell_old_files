/* ----------------------------------
Description: Script for Home Portfolio style
Name: demo11.js
---------------------------------- */

function demo_11() {
    (function($) {

        // masonry grid
        var $grid = $('.portfolio-2 .grid').masonry({
            itemSelector: '.grid-item'
        });
        $grid.imagesLoaded().progress(function() {
            $grid.masonry('layout');
        });

        $('a.page-scroll').on('click', function(event) {
            var $anchor = $(this);
            $('html, body').stop().animate({
                scrollTop: ($($anchor.attr('href')).offset().top - 35)
            }, 700, 'easeInOutSine');
            event.preventDefault();
        });

    })(jQuery);
}