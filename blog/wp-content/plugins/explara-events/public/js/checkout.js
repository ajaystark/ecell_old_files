/******* Jquery No Conflict Function *******/
window.$ = jQuery.noConflict();

var ExplaraCheckout = {

    settings: {
        conferenceSessionData: {
            discountCode: ""
        },
        eventId: null,
        eventDisplayId: null,
        multiDates: [],
        multiDatesData: [],
        cartObject: {
            tickets: []
        },
        cartCheckoutObject: {
            tickets: []
        },
        attendeeFormObj: {
            orderNo: null,
            attendees: {}
        },
        rsvpFormObj: {
            eventId: null,
            attendees: {}
        },
        totalAmout: 0,
        currency: null,
        explara_attendee_list_holder: 'explara_attendee_list_holder',
        explara_attendee_forms: 'explara_attendee_forms',
        open_step: 'ticket',
        eventRSVPSource: 'explara_rsvp_form_source',
        explara_rsvp_form_holder: 'explara_rsvp_form_holder',
        explara_rsvp_data_forms: 'explara_rsvp_data_forms',
        explara_recipit_page_link: "em/ticket/confirmation/receipt/order/",
        configObject: {}
    },

    init: function() {
        this.bindUIActions();
    },

    bindUIActions: function() {

        // get config and set
        ExplaraCheckout.getDefaulktConfiguration();

        ExplaraCheckout.settings.eventDisplayId = ExplaraCheckout.getGetParamValue('event_id');
        var page = ExplaraCheckout.getGetParamValue('page');

        if (ExplaraCheckout.settings.eventDisplayId !== null && page === null) {
            ExplaraCheckout.checkforMultidateTicket();
        }

        $(document).on('submit', '#' + ExplaraCheckout.settings.explara_attendee_forms, function(e) {
            e.preventDefault();

            ExplaraCheckout.saveAttendeeForm($(this).find('.explara_attendee'));

        });

        $(document).on('click', '.exp_checkout_step_header', function(e) {

            e.preventDefault();
            $('#explara_checkout_tickets_attendee_step').find('.exp_content_block').hide();
            $('#explara_checkout_tickets_step').find('.exp_content_block').show();

            ExplaraCheckout.settings.open_step = 'ticket';

        });

        $(document).on('click', '.exp_checkout_step_header_attendee', function(e) {

            e.preventDefault();

            if (ExplaraCheckout.settings.cartObject.tickets.length === 0 || ExplaraCheckout.settings.open_step === 'ticket') {
                return;
            }

            $('#explara_checkout_tickets_step').find('.exp_content_block').hide();
            $('#explara_checkout_tickets_attendee_step').find('.exp_content_block').show();

        });

        $(document).on('click', '#explara_rsvp_form_source', function(e) {

            e.preventDefault();

            ExplaraCheckout.getRSVPForm($(this).attr('data-event'));

        });

        $(document).on('click', '#explara_rsvp_form_close', function(e) {

            e.preventDefault();

            var sideslider = $('#' + ExplaraCheckout.settings.explara_rsvp_form_holder);
            sideslider.removeClass("is-visible");

        });

        $(document).on('submit', '#' + ExplaraCheckout.settings.explara_rsvp_data_forms, function(e) {
            e.preventDefault();

            ExplaraCheckout.saveRsvpForm($(this).find('.explara_rsvp'));

        });

        $(document).on('click', '.exp_checkout_step_header', function(e) {

            e.preventDefault();
            $('#explara_checkout_tickets_attendee_step').find('.exp_content_block').hide();
            $('#explara_checkout_tickets_step').find('.exp_content_block').show();

            ExplaraCheckout.settings.open_step = 'ticket';

        });
    },

    getDefaulktConfiguration: function() {

        var requestData = {};
        requestData.action = 'explara_page_get_config';

        $.ajax({
            url: EXPUserAjax.ajaxurl,
            type: 'post',
            data: requestData,
            success: function(response, status) {
                ExplaraCheckout.settings.configObject = response.data;
            },
            error: function(data) {}
        });

    },

    showCategoryCheckout: function(ID, name) {

        $('#cat_' + ID).siblings('li').removeClass('exp_active_list');
        $('#cat_' + ID).addClass('exp_active_list');

        $('#explara_tickets_' + ID).siblings('div').hide();
        $('#explara_tickets_' + ID).show();

    },

    handelDateChange: function() {
        var date = $('#explara_selected_date').val();
        window.location = location.origin + location.pathname + "?event_id=" + ExplaraCheckout.settings.eventDisplayId + "&page=multidate&date=" + date;
    },

    checkforMultidateTicket: function() {

        var requestDateData = {};
        requestDateData.event_display_id = ExplaraCheckout.settings.eventDisplayId;
        requestDateData.action = 'explara_get_multidate_data';

        $.ajax({
            url: EXPUserAjax.ajaxurl,
            type: 'post',
            data: requestDateData,
            success: function(response, status) {

                if (response.data === null) {
                    return;
                }

                if (typeof response.data.status !== 'undefined' && response.data.status === 'success') {

                    ExplaraCheckout.settings.multiDatesData = response.data.MultiDateSessionDetails;

                    $.each(ExplaraCheckout.settings.multiDatesData, function(key, value) {
                        ExplaraCheckout.settings.multiDates.push(key);
                    });

                    $('.explara_session_date .explara_session_date_block').show();
                    $('.explara_session_date .multidate_session_msg').hide();

                    //Date picker
                    flatpickr('#explara_event_session_date', {
                        inline: false,
                        allowInput: false,
                        enable: ExplaraCheckout.settings.multiDates,
                        onChange: function(dt) {

                            var selectedDate = moment(new Date(dt)).format("YYYY-MM-DD");
                            // window.location = location.href + "&page=multidate&date=" + selectedDate;
                        },

                    });

                } else {
                    $('.explara_session_date .explara_session_date_block').hide();
                    $('.explara_session_date .multidate_session_msg').show();

                    //toastr.warning(response.data.message);
                    //Handel error messges
                }
            },
            error: function(data) {
                //Failed
            }
        });
    },

    redirectbyDate: function(url) {

        var date = $('#explara_event_session_date').val();
        var selectedDate = "";

        if (date !== "") {
            selectedDate = moment(new Date(date)).format("YYYY-MM-DD");
        } else {

            date = new Date(ExplaraCheckout.settings.multiDates[0]);

            if (typeof ExplaraCheckout.settings.multiDates[0] === 'undefined') {
                selectedDate = moment(new Date()).format("YYYY-MM-DD");
            } else {
                selectedDate = moment(new Date(date)).format("YYYY-MM-DD");
            }
        }

        window.location = location.href + "&page=multidate&date=" + selectedDate;
    },

    handelQuantityChange: function(event_id, ticket_id, currency) {

        ExplaraCheckout.settings.currency = currency;

        ExplaraCheckout.settings.cartObject.action = 'page_explara_cart';
        ExplaraCheckout.settings.cartObject.eventId = event_id;

        ExplaraCheckout.settings.cartObject.tickets = [];

        if (typeof $('#explara_discount_code').val() !== 'undefined') {
            ExplaraCheckout.settings.cartObject.discountCode = $('#explara_discount_code').val();
        }

        $.each($('.explara_ticket_quantities'), function(key, value) {

            var ticketObject = {
                ticketId: parseInt($(this).attr('id')),
                quantity: parseInt($(this).val()),
            };

            if (ticketObject.quantity !== 0) {
                ExplaraCheckout.settings.cartObject.tickets.push(ticketObject);
            }

        });

        $.ajax({
            url: EXPUserAjax.ajaxurl,
            type: 'post',
            data: ExplaraCheckout.settings.cartObject,
            success: function(response, status) {
                ExplaraCheckout.processCartCalculation(response);
            },
            error: function(data) {
                //Failed
            }
        });

    },
    processCartCalculation: function(response) {

        var cards = response.data.carts;

        if (typeof cards.discount !== 'undefined' && cards.discount !== null && cards.discount !== 0) {
            $('.explara_discount_price').show();
            $('#explara_discount_value').html(cards.discount);
        } else {
            $('.explara_discount_price').hide();
        }

        if (typeof cards.servieFeeTotal !== 'undefined' && cards.servieFeeTotal !== null && cards.servieFeeTotal !== 0) {
            $('.explara_procession_fee').show();
            $('#explara_procession_fee_value').html(cards.servieFeeTotal);
        } else {
            $('.explara_procession_fee').hide();
        }

        $('#explara_subtotal_value').html(cards.actualCost);
        $('#explara_total_amount').html(cards.total);

        if (parseInt(cards.total) === 0) {
            ExplaraCheckout.settings.totalAmout = parseInt(cards.total);
        }

        var taxBreakup = response.data.taxBreakup;
        if (typeof taxBreakup !== 'undefined' && taxBreakup !== '' && taxBreakup !== null) {

            var taxBreakup = $.map(taxBreakup, function(value, index) {
                return {
                    name: index,
                    value: value
                };
            });

            var taxHtml = '';

            $.each(taxBreakup, function(key, value) {
                if (parseInt(value.value) !== 0) {
                    taxHtml += '<li class="item-price clearfix"><span>' + value.name + '</span> <span class="pull-right">' + ExplaraCheckout.settings.currency + ' ' + value.value + '</span></li>';
                }
            });

            $('#explara_taxs').show().html(taxHtml);
        }
    },
    processSessionCartCalculation: function(response) {

        var cards = response.data.carts;

        if (typeof cards.discount !== 'undefined' && cards.discount !== null && cards.discount !== 0) {
            $('.explara_discount_price').show();
            $('#explara_discount_value').html(cards.discount);
        } else {
            $('.explara_discount_price').hide();
        }

        if (typeof cards.servieFeeTotal !== 'undefined' && cards.servieFeeTotal !== null && cards.servieFeeTotal !== 0) {
            $('.explara_procession_fee').show();
            $('#explara_procession_fee_value').html(cards.servieFeeTotal);
        } else {
            $('.explara_procession_fee').hide();
        }

        $('#explara_subtotal_value').html(cards.actualCost);
        $('#explara_total_amount').html(cards.total);

        if (parseInt(cards.total) === 0) {
            ExplaraCheckout.settings.totalAmout = parseInt(cards.total);
        }

        var taxBreakup = response.data.taxBreakup;
        if (typeof taxBreakup !== 'undefined' && taxBreakup !== '' && taxBreakup !== null) {

            var taxBreakup = $.map(taxBreakup, function(value, index) {
                return {
                    name: index,
                    value: value
                };
            });

            var taxHtml = '';

            $.each(taxBreakup, function(key, value) {
                if (parseInt(value.value) !== 0) {
                    taxHtml += '<li class="item-price clearfix"><span>' + value.name + '</span> <span class="pull-right">' + ExplaraCheckout.settings.currency + ' ' + value.value + '</span></li>';
                }
            });

            $('#explara_taxs').show().html(taxHtml);
        }
    },
    processCheckout: function() {

        ExplaraCheckout.settings.cartCheckoutObject = ExplaraCheckout.settings.cartObject;

        if (ExplaraCheckout.settings.cartObject.tickets.length === 0) {
            toastr.warning("Select ticket in order to proceed");
            // Show message
            return;
        }

        ExplaraCheckout.settings.cartCheckoutObject.action = 'page_explara_checkout';
        ExplaraCheckout.settings.cartCheckoutObject.multiSessionId = "";
        ExplaraCheckout.settings.cartCheckoutObject.categoryId = "";

        $.ajax({
            url: EXPUserAjax.ajaxurl,
            type: 'post',
            data: ExplaraCheckout.settings.cartCheckoutObject,
            success: function(response, status) {


                if (typeof response.data.status !== 'undefined' && response.data.status === 'success') {

                    ExplaraCheckout.processCartAttendee(response);

                } else {
                    toastr.warning(response.data.message);
                    //Handel error messges
                }


            },
            error: function(data) {
                //Failed
            }
        });
    },
    applyNormalDiscount: function(event_id) {

        var value = $('#explara_discount_code').val();

        if (value === '') {
            $('#explara_discount_code').css('border', '1px solid #ff0010');
            return;
        }

        ExplaraCheckout.handelQuantityChange(event_id);

    },
    processCartAttendee: function(response) {

        if (typeof response.data.success !== 'undefined' && response.data.success === 'fail') {

            toastr.warning(response.data.message);
            return;
            // Show message for error
        } else {
            ExplaraCheckout.settings.open_step = 'attendee';

            ExplaraCheckout.getAttendeeList(response.data.orderNo);
            ExplaraCheckout.settings.attendeeFormObj.orderNo = response.data.orderNo;

        }
    },
    getAttendeeList: function(orderNo) {

        var attendeeFormData = {};

        attendeeFormData.action = 'page_explara_attendee_form';
        attendeeFormData.orderNo = orderNo;

        $.ajax({
            url: EXPUserAjax.ajaxurl,
            type: 'post',
            data: attendeeFormData,
            success: function(response, status) {

                if (response.data.form !== false) {

                    $('#explara_checkout_tickets_step').find('.exp_content_block').hide();
                    $('#explara_checkout_tickets_attendee_step').find('.exp_content_block').show();

                    $('#explara_attendee_list_holder').html(response.data.form);

                    //Date picker
                    flatpickr('.explara_date_picker', {
                        inline: false,
                        allowInput: false,
                    });

                } else {

                    toastr.warning(response.data.message);
                }

            },
            error: function(data) {
                //Failed
            }
        });
    },
    saveAttendeeForm: function(attendeeFormInputs) {
        ExplaraCheckout.settings.attendeeFormObj.action = 'page_explara_attendee_form_save';

        $.each(attendeeFormInputs, function(key, value) {

            var formID = $(this).attr('id');

            if (typeof ExplaraCheckout.settings.attendeeFormObj.attendees[formID] === 'undefined') {
                ExplaraCheckout.settings.attendeeFormObj.attendees[formID] = [];
            }

            // For normal type input
            $.each($('#' + formID + ' .explara_attendee_inputs'), function(key, value) {

                var innnerInputObject = {};
                innnerInputObject.id = $(this).attr('data-id');
                innnerInputObject.label = $(this).attr('data-label');
                innnerInputObject.value = $(this).val();
                //innnerInputObject.type = 'text';

                ExplaraCheckout.settings.attendeeFormObj.attendees[formID].push(innnerInputObject);

            });

            // For normal type radio
            $.each($('#' + formID + ' .explara_attendee_inputs_radio'), function(key, value) {

                $.each($(value).find('.explara_attendee_inputs_radio_field'), function(inkey, invalue) {

                    if ($(invalue).is(":checked")) {

                        var innnerInputObject = {};
                        innnerInputObject.id = $(invalue).attr('data-id');
                        innnerInputObject.label = $(invalue).attr('data-label');
                        innnerInputObject.value = $(invalue).val();
                        //innnerInputObject.type = 'radio';

                        ExplaraCheckout.settings.attendeeFormObj.attendees[formID].push(innnerInputObject);
                    }

                });
            });

            // For normal type checkbox
            $.each($('#' + formID + ' .explara_attendee_inputs_checkbox'), function(key, value) {

                var options = [];

                $.each($(value).find('.explara_attendee_inputs_checkbox_field:checked'), function(inkey, invalue) {
                    options.push($(invalue).val());
                });

                if (options.length > 0) {

                    var innnerInputObject = {};
                    innnerInputObject.id = $(value).attr('data-id');
                    innnerInputObject.label = $(value).attr('data-label');
                    innnerInputObject.value = options;

                    ExplaraCheckout.settings.attendeeFormObj.attendees[formID].push(innnerInputObject);
                }

            });

        });

        $.ajax({
            url: EXPUserAjax.ajaxurl,
            type: 'post',
            data: ExplaraCheckout.settings.attendeeFormObj,
            success: function(response, status) {

                if (typeof response.data.status !== 'undefined' && response.data.status === 'success') {

                    if (typeof response.data.paymentLink === 'undefined' ||
                        response.data.paymentLink === null ||
                        response.data.paymentLink === '') {

                        location.href = ExplaraCheckout.settings.configObject.ticketRecipietUrl + ExplaraCheckout.settings.attendeeFormObj.orderNo;

                    } else {
                        location.href = response.data.paymentLink;
                    }


                } else {
                    toastr.warning(response.data.message);
                    //Handel error messges
                }

            },
            error: function(data) {
                //Failed
            }
        });
    },
    handelFileUpload: function(object) {

        ExplaraCheckout.settings.attendeeFormObj.action = 'page_explara_attendee_form_save';

        var MainHolder = $(object).parents('.explara_attendee');
        var formID = $(MainHolder).attr('id');

        if (typeof ExplaraCheckout.settings.attendeeFormObj.attendees[formID] === 'undefined') {
            ExplaraCheckout.settings.attendeeFormObj.attendees[formID] = [];
        }

        var file_name = "explara_";

        $.each($('#' + formID + ' .explara_attendee_inputs_file'), function(key, value) {

            var ID = $(value).attr('id');

            var first_image = document.getElementById(ID);
            first_image = first_image.files[0];

            ExplaraCheckout.uploadFile(formID, value, first_image);

        });
    },
    uploadFile: function(formID, value, src) {

        var formData = new FormData();
        formData.append("src", src);
        formData.append("action", "page_explara_upload_form");

        $.ajax({
            url: EXPUserAjax.ajaxurl,
            type: 'POST',
            data: formData,
            cache: false,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function(response, status) {

                if (response.status == true) {

                    var innnerInputObject = {};
                    innnerInputObject.id = $(value).attr('data-id');
                    innnerInputObject.label = $(value).attr('data-label');
                    innnerInputObject.value = response.data;
                    ExplaraCheckout.settings.attendeeFormObj.attendees[formID].push(innnerInputObject);
                } else {

                    if (typeof response.file !== 'undefined' && response.file == false) {

                        $(value).replaceWith($(value).val('').clone(true));
                        toastr.warning(response.data);

                        return;
                    }

                }

            },
            error: function(data) {
                //Failed
            }
        });
    },
    getGetParamValue: function(parameterName) {
        var result = null,
            tmp = [];
        location.search
            .substr(1)
            .split("&")
            .forEach(function(item) {
                tmp = item.split("=");
                if (tmp[0] === parameterName) result = decodeURIComponent(tmp[1]);
            });
        return result;
    },

    getRSVPForm: function(eventId) {
        var sideslider = $('#' + ExplaraCheckout.settings.explara_rsvp_form_holder);

        var rsvpFormData = {};

        rsvpFormData.action = 'page_explara_rsvp_form';
        rsvpFormData.eventId = eventId;

        $.ajax({
            url: EXPUserAjax.ajaxurl,
            type: 'post',
            data: rsvpFormData,
            success: function(response, status) {

                if (response.data.form !== false) {
                    $('#' + ExplaraCheckout.settings.explara_rsvp_form_holder).find('#explara_rsvp_form').html(response.data.form);
                    sideslider.addClass("is-visible");

                    ExplaraCheckout.settings.rsvpFormObj.eventId = eventId;
                } else {
                    toastr.warning(response.data.message);
                }

            },
            error: function(data) {
                //Failed
            }
        });
    },
    saveRsvpForm: function(rsvpFormInputs) {
        ExplaraCheckout.settings.rsvpFormObj.action = 'page_explara_rsvp_form_save';

        $.each(rsvpFormInputs, function(key, value) {

            var formID = $(this).attr('id');
            ExplaraCheckout.settings.rsvpFormObj.attendees[formID] = [];

            $.each($('#' + formID + ' .explara_attendee_inputs'), function(key, value) {

                var innnerInputObject = {};
                innnerInputObject.id = $(this).attr('data-id');
                innnerInputObject.label = $(this).attr('data-label');
                innnerInputObject.value = $(this).val();

                ExplaraCheckout.settings.rsvpFormObj.attendees[formID].push(innnerInputObject);

            });

            // For normal type radio
            $.each($('#' + formID + ' .explara_attendee_inputs_radio'), function(key, value) {

                $.each($(value).find('.explara_attendee_inputs_radio_field'), function(inkey, invalue) {

                    if ($(invalue).is(":checked")) {

                        var innnerInputObject = {};
                        innnerInputObject.id = $(invalue).attr('data-id');
                        innnerInputObject.label = $(invalue).attr('data-label');
                        innnerInputObject.value = $(invalue).val();

                        ExplaraCheckout.settings.rsvpFormObj.attendees[formID].push(innnerInputObject);
                    }

                });
            });

            // For normal type checkbox
            $.each($('#' + formID + ' .explara_attendee_inputs_checkbox'), function(key, value) {

                var options = [];

                $.each($(value).find('.explara_attendee_inputs_checkbox_field:checked'), function(inkey, invalue) {
                    options.push($(invalue).val());
                });

                if (options.length > 0) {

                    var innnerInputObject = {};
                    innnerInputObject.id = $(value).attr('data-id');
                    innnerInputObject.label = $(value).attr('data-label');
                    innnerInputObject.value = options;

                    ExplaraCheckout.settings.rsvpFormObj.attendees[formID].push(innnerInputObject);
                }

            });


        });

        $('#explara_submit_rsvp_details').attr('disabled', 'true');

        $.ajax({
            url: EXPUserAjax.ajaxurl,
            type: 'post',
            data: ExplaraCheckout.settings.rsvpFormObj,
            success: function(response, status) {

                $('#explara_submit_rsvp_details').removeAttr('disabled');

                $('#' + ExplaraCheckout.settings.explara_rsvp_form_holder).find('h2').hide();

                if (typeof response.data.status !== 'undefined' && response.data.status === 'success') {

                    ExplaraCheckout.clearRSVPForm(rsvpFormInputs);
                    toastr.success(response.data.message);

                } else {

                    toastr.warning(response.data.message);
                }

            },
            error: function(data) {
                //Failed
                $('#explara_submit_rsvp_details').removeAttr('disabled');
            }
        });
    },
    clearRSVPForm: function(rsvpFormInputs) {
        $.each($('.explara_attendee_inputs'), function(key, value) {
            $(this).val('');
        });
    },
    handelConferenceCheckoutSession: function(event_id, selector, currentObject) {

        if ($(currentObject).length > 0) {
            $(currentObject).attr('data-set', true);
        }

        var attendeeCount = $('#explara_selected_attendee_count').val();
        ExplaraCheckout.settings.conferenceSessionData.session = [];
        ExplaraCheckout.settings.conferenceSessionData.quantity = parseInt(attendeeCount);

        if (typeof $('#explara_discount_code').val() !== 'undefined') {
            ExplaraCheckout.settings.conferenceSessionData.discountCode = $('#explara_discount_code').val();
        }

        ExplaraCheckout.settings.conferenceSessionData.action = 'page_explara_cart';
        ExplaraCheckout.settings.conferenceSessionData.eventId = event_id;

        if (typeof selector !== 'undefined' && selector !== '' && selector !== null) {
            ExplaraCheckout.preResetSession(selector);
        }

        $.each($('.explara_conference_checkout_card .explara_conference_sesssion_input'), function(key, value) {

            var attrib = $(this).attr('data-set');
            attrib = attrib.toString();


            if (attrib === 'true') {

                var objectData = {};

                objectData.id = parseInt($(this).attr('data-mainid'));
                objectData.sessionTimeId = parseInt($(this).attr('data-id'));
                objectData.ticketId = parseInt($(this).attr('data-ticketid'));

                ExplaraCheckout.settings.conferenceSessionData.session.push(objectData);
            }
        });

        if (ExplaraCheckout.settings.conferenceSessionData.session.length > 0) {

            $('#explara_conference_action').show();

            $.ajax({
                url: EXPUserAjax.ajaxurl,
                type: 'post',
                data: ExplaraCheckout.settings.conferenceSessionData,
                success: function(response, status) {



                    ExplaraCheckout.processSessionCartCalculation(response);

                    var HTML = '';

                    $.each($('.explara_conference_checkout_card .explara_conference_sesssion_input'), function(key, value) {

                        if ($(this).is(":checked")) {
                            HTML += $(this).siblings('.exp-multi-content_list_hidden').html();
                        }
                    });

                    $('.explara_conference_summary_block').html(HTML);
                    $('.explara_summary_count_showcase').html(ExplaraCheckout.settings.conferenceSessionData.quantity);

                    $('#explara_checkout_tickets_attendee_step').find('.exp_content_block').hide();
                    $('#explara_checkout_tickets_step').find('.exp_content_block').show();

                    ExplaraCheckout.settings.open_step = 'ticket';


                },
                error: function(data) {
                    //Failed
                }
            });
        } else {
            $('#explara_conference_action').hide();
        }

    },

    preInitResetSession: function(selector) {
        $.each($('#' + selector), function(key, value) {
            $(value).find('input').attr('data-set', false);
        });
    },

    preResetSession: function(selector) {

        $.each($('#' + selector), function(key, value) {
            $(value).find('input').prop('checked', false);
            $(value).find('input').attr('data-set', false);
        });

        $('#explara_taxs').hide();
        $('.explara_discount_price').hide();
        $('.explara_procession_fee').hide();

        $('#explara_total_amount').html('0');
        $('#explara_subtotal_value').html('0');

        $('.explara_conference_summary_block').html("<p>No Session is selected</p>");
    },

    resetConferenceSession: function(selector, event_id) {

        $('#explara_taxs').hide();
        $('.explara_discount_price').hide();
        $('.explara_procession_fee').hide();
        $('#explara_taxs').hide();

        $('#explara_total_amount').html('0');
        $('#explara_subtotal_value').html('0');

        ExplaraCheckout.handelConferenceCheckoutSession(event_id, selector);
    },

    applyDiscount: function(event_id) {

        var value = $('#explara_discount_code').val();

        if (value === '') {
            $('#explara_discount_code').css('border', '1px solid #ff0010');
            return;
        }

        ExplaraCheckout.settings.conferenceSessionData.discountCode = value;
        ExplaraCheckout.handelConferenceCheckoutSession(event_id, '');

    },
    generateConferenceOrder: function(event_id) {

        ExplaraCheckout.settings.conferenceSessionData.eventId = event_id;
        ExplaraCheckout.settings.conferenceSessionData.action = 'page_explara_checkout';

        $.ajax({
            url: EXPUserAjax.ajaxurl,
            type: 'post',
            data: ExplaraCheckout.settings.conferenceSessionData,
            success: function(response, status) {

                if (typeof response.data.status !== 'undefined' && response.data.status === 'success') {

                    ExplaraCheckout.processCartAttendee(response);


                } else {
                    toastr.warning(response.data.message);
                    //Handel error messges
                }

            },
            error: function(data) {
                //Failed
            }
        });

    },
};

$(function() {
    ExplaraCheckout.init();
});