/******* Jquery No Conflict Function *******/
window.$ = jQuery.noConflict();

var ExplaraMemberEvent = {

  settings: {
    start_pointer: 0,
    limit: 6
  },

  loadCalendar: function() {

  },

  eventPaginationGet: function(type, limit) {

    ExplaraMemberEvent.settings.limit = parseInt(limit);

    //TODO we will remote this later
    return;

    var object = {};
    object.action = 'explara_events_list_ajax';
    object.start_pointer = ExplaraMemberEvent.settings.start_pointer;

    $('#explara_event_loadmore span').text("Loading...");

    $.ajax({
      url: EXPUserAjax.ajaxurl,
      type: 'post',
      data: object,
      success: function(data, status) {

        ExplaraMemberEvent.settings.limit = data.limit;

        if (data.events.length > 0) {
          $('#explara_event_loadmore span').text("Load More");
          ExplaraMemberEvent.appendHtml(data.events, type);
          $('#explara_event_loadmore').show();
        } else {
          $('#explara_event_loadmore').hide();
          $('#explara_event_message').show();
        }
      },
      error: function(data) {}
    });
  },
  loadMore: function(type) {

    var object = {};
    object.action = 'explara_events_list_ajax';
    object.start_pointer = parseInt(ExplaraMemberEvent.settings.start_pointer) + parseInt(ExplaraMemberEvent.settings.limit);

    ExplaraMemberEvent.settings.start_pointer = object.start_pointer;

    $('#explara_event_loadmore span').text("Loading...");

    $.ajax({
      url: EXPUserAjax.ajaxurl,
      type: 'post',
      data: object,
      success: function(data, status) {

        if (data.events.length > 0) {
          $('#explara_event_loadmore span').text("Load More");
          ExplaraMemberEvent.appendHtml(data.events, type);
        } else {
          $('#explara_event_loadmore').hide();
        }

        if (data.events.length < parseInt(data.limit)) {
          $('#explara_event_loadmore').hide();
        }

        ExplaraMemberEvent.settings.limit = data.limit;

      },
      error: function(data) {}
    });
  },

  appendHtml: function(events, type) {

    $.each(events, function(key, value) {

      var singleEventData = '';

      if (type === 'list') {
        singleEventData = ExplaraMemberEvent.getListHtml(value);
        console.log(singleEventData);
        $('.explara_events_list_holder').append(singleEventData);
      }

      if (type === 'card') {
        singleEventData = ExplaraMemberEvent.getCardHtml(value);
        $('.explara_events_card_holder').append(singleEventData);
      }

    });
  },

  getListHtml: function(value) {

    var singleEventData = '<tr>';

    singleEventData += '<td>';
    singleEventData += value.start_fmt_date + ' - ' + value.end_fmt_date;
    singleEventData += '</td>';

    singleEventData += '<td>';
    singleEventData += '<a target="_blank" href="' + value.complete_link + '">';
    singleEventData += value.event_title;
    singleEventData += '</a>';
    singleEventData += '</td>';

    singleEventData += '<td>';
    singleEventData += '<a class="explara-reg-btn" href="' + value.complete_link + '">';
    singleEventData += '<i class="fa fa-ticket"></i> &nbsp;Register';
    singleEventData += '</a>';
    singleEventData += '</td>';

    singleEventData += '</tr>';

    return singleEventData;
  },

  getCardHtml: function(value) {

    var singleEventData = '<div class="col-sm-4 col-xs-12">';
    singleEventData += '<div class="exp-card">';
    singleEventData += '<a target="_blank"target="_blank" class="e-s-card" href="' + value.complete_link + '">';

    singleEventData += '<div class="e-img-holder expcard-bg" style="background-image: url(' + value.list_dump.listingImage + ')">';

    singleEventData += '</div>';

    singleEventData += '<div class="e-content">';
    singleEventData += '<div class="date"> ';
    singleEventData += '<div class="col-xs-3 expdateicon-col text-center nopadding">';


    if (value.event_session_type === 'multiDate') {

      singleEventData += '<i class="fa fa-calendar expfa-cal" aria-hidden="true"></i><p>Multiple Date</p>';
    } else {

      singleEventData += '<span class="expdate-day">';
      singleEventData += value.start_day;
      singleEventData += '</span>';

      singleEventData += '<span class="expdate-month">&nbsp;';
      singleEventData += value.start_month;
      singleEventData += '</span>';

    }

    singleEventData += '</div> ';

    singleEventData += '<div class="col-xs-9 expeventdesc-col">';
    singleEventData += '<h2 class="event-title">';
    singleEventData += value.event_title;
    singleEventData += '</h2>';

    singleEventData += '<p class="expcard-venue"> ';
    if (typeof value.details_dump.events.Location[0] !== 'undefined') {

      singleEventData += value.details_dump.events.Location[0].venueName + ', ';
      singleEventData += value.details_dump.events.Location[0].address + '<br>';
      singleEventData += value.details_dump.events.Location[0].city + ',';
      singleEventData += value.details_dump.events.Location[0].state + ',';
      singleEventData += value.details_dump.events.Location[0].country + '<br>';
      singleEventData += value.details_dump.events.Location[0].zipcode;

    } else {
      singleEventData += 'Venue: N/A';
    }
    singleEventData += '</p>';

    singleEventData += '</div>';
    singleEventData += '</div>';
    singleEventData += '</div>';

    singleEventData += '<div class="e-card-footer">';
    singleEventData += '<div class="row">';
    singleEventData += '<div class="col-sm-12 col-xs-12">';
    singleEventData += '<p class="">';

    if (value.details_dump.events.price !== null &&
      value.details_dump.events.price !== '') {

      singleEventData += '<span>';

      if (value.details_dump.events.price !== '0') {
        if (value.details_dump.events.currency === 'INR') {
          singleEventData += '₹';
        } else if (value.details_dump.events.currency === 'USD') {
          singleEventData += '$';
        } else {
          singleEventData += '₹';
        }
      }

      singleEventData += '&nbsp;';

      if (value.details_dump.events.price === '0') {

        singleEventData += '<span class="content"> Free';
        singleEventData += '</span>';
      } else {
        singleEventData += value.details_dump.events.price;
      }

      singleEventData += '</span>';

    } else {

      singleEventData += '<span class="content"> Free';
      singleEventData += '</span>';

    }

    singleEventData += '</p>';
    singleEventData += '</div>';
    singleEventData += '</div>';
    singleEventData += '</div>';

    singleEventData += '</a>';
    singleEventData += '</div>';
    singleEventData += '</div>';

    return singleEventData;
  },
};