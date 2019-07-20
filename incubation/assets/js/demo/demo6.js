/* ----------------------------------
Description: Script for Home Landing Page style
Name: demo6.js
---------------------------------- */

function demo_6() {
    (function($) {

        // match height
        $('.price-2 .table-wrapper .features').matchHeight();

        // modify some scrollreveal parameters
        sr.reveal('.foo', {
            duration: 700,
            delay: 300,
            distance: '50px',
            viewFactor: 0.5,
            easing: 'ease-in-out'
        });
        //modify on scroll reveal animation
        sr.reveal('.content-block-3 .foo', 100);
        sr.reveal('.content-block-12 .foo', 100);
        sr.reveal('.price-1 .foo', 100);

    })(jQuery);
}