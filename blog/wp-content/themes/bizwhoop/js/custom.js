(function($) {
  "use strict";
//------------------------------------------
    //slider
//------------------------------------------
jQuery(document).ready(function() {
  jQuery("#bizwhoop-slider").owlCarousel({
      navigation : true, // Show next and prev buttons
      slideSpeed : 200,
      pagination : true,
      paginationSpeed : 400,
      singleItem:true,
      video:true,
      autoPlay : true,
      transitionStyle : "fade",
      navigationText: [
      "<i class='fa fa-long-arrow-left'></i>",
      "<i class='fa fa-long-arrow-right'></i>"
      ]
});
/* =================================
===         FORM-CONTROL        ====
=================================== */
jQuery(".form-control")
  .focusout(function() {
    if ($(this).val()=="")
    $(this).removeClass("input-filled");
  })
  .focusin(function() {
    $(this).addClass("input-filled");
}) 
});
})(jQuery);