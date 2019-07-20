/******* Jquery No Conflict Function *******/
window.$ = jQuery.noConflict();

var ExplaraMemberOrder = {

  settings: {
    explara_attendee_update: 'explara_attendee_update'
  },

  init: function() {
    this.bindUIActions();
  },

  bindUIActions: function() {
    $(document).on('click', '.explara_order_view', function(e) {
      e.preventDefault();

      var typeList = $(this).attr('data-list');
      var typeGrid = $(this).attr('data-grid');
      var typeSource = $(this).attr('data-source');

      if (typeSource === 'list') {

        $('.' + typeList).show();
        $('.' + typeGrid).hide();
      } else {

        $('.' + typeList).hide();
        $('.' + typeGrid).show();
      }

    });

    $(document).on('click', '.explara_order_ticket_cancel_action', function(e) {
      e.preventDefault();

      var orderNo = $(this).attr('data-orderNo');
      var ticketNumber = $(this).attr('data-ticketNumber');

      var orderData = {};
      orderData.action = 'page_explara_ticket_cancel';
      orderData.orderNo = orderNo;
      orderData.ticketNumber = ticketNumber;

      ExplaraMemberOrder.cancelTicket(orderData);

    });

    $(document).on('submit', '#' + ExplaraMemberOrder.settings.explara_attendee_update, function(e) {
      e.preventDefault();

      ExplaraMemberOrder.updateAttendeeForm($(this));

    });

  },

  updateAttendeeForm: function(formObject) {

    $.ajax({
      url: EXPUserAjax.ajaxurl,
      type: 'post',
      data: formObject.serialize(),
      success: function(data, status) {
        if (data.data.status === 'success') {

          setTimeout(function() {
            window.location = data.portal_page;
          }, 3000);

          formObject[0].reset();

          toastr.success(data.data.tickets);

        } else {
          toastr.warning(data.msg);
        }
      },
      error: function(data) {}
    });

  },

  cancelTicket: function(data) {
    $.ajax({
      url: EXPUserAjax.ajaxurl,
      type: 'post',
      data: data,
      success: function(response, status) {

        if (response.data.form !== false) {
          location.reload();
        }

      },
      error: function(data) {}
    });
  },
};

$(function() {
  ExplaraMemberOrder.init();
});