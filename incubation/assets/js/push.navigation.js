// Overlay/Push Navigation Script
jQuery(document).ready(function ($) {
    navigation_menu();
});
/* Animated Navigation Menu */
function navigation_menu() {
    (function ($) {

        var isLateralNavAnimating = false;
        $('.nav-button').on('click', function (event) {
            event.preventDefault();
            if (!isLateralNavAnimating) {
                if ($(this).parents('.csstransitions').length > 0) isLateralNavAnimating = true;
                $('html').toggleClass('scroll-hide');
                $('.goto-top').toggleClass('goto-hide');
                $('body').toggleClass('navigation-is-open');
                $('.nav-wrapper').one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function () {
                    isLateralNavAnimating = false;
                });
            }
        });

    })(jQuery);
}
