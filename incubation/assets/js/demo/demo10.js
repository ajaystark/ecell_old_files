/* ----------------------------------
Description: Script for Home Personal style
Name: demo10.js
---------------------------------- */

function demo_10() {
    (function($) {

        // masonry grid
        var $grid = $('.portfolio-2 .grid').masonry({
            itemSelector: '.grid-item'
        });
        $grid.imagesLoaded().progress(function() {
            $grid.masonry('layout');
        });

    })(jQuery);
}