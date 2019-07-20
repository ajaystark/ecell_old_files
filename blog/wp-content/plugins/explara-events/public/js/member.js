/******* Jquery No Conflict Function *******/
window.$ = jQuery.noConflict();

var ExplaraCommon = {
  settings: {
    passwordFormObj: jQuery('#explara_signinform'),
  },
  passwordData: {},
  init: function() {
    // Get the element with id="defaultOpen" and click on it
    //  document.getElementById("defaultOpen").click();

    toastr.options.extendedTimeOut = 0; //1000;
    toastr.options.timeOut = 1000;
    toastr.options.fadeOut = 250;
    toastr.options.fadeIn = 250;

  },

  openExplaraTab: function(evt, tabName) {
    // Declare all variables
    var i, explaratabcontent, tablinks;

    // Get all elements with class="explaratabcontent" and hide them
    explaratabcontent = document.getElementsByClassName("explaratabcontent");
    for (i = 0; i < explaratabcontent.length; i++) {
      explaratabcontent[i].style.display = "none";
    }

    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    // Show the current tab, and add an "active" class to the button that opened the tab
    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.className += " active";
  }
};

jQuery(window).load(function() {
  ExplaraCommon.init();
});