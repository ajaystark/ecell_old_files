/******* Jquery No Conflict Function *******/
window.$ = jQuery.noConflict();

var ExplaraMemberCheckout = {

    settings: {
        cartObject: {
            discountCode: ""
        },
        isCheckoutCompleted: false,
        multiDates: [],
        multiDatesData: [],
        tempOrderObject: {},
        cartObject: {
            membership: [],
            selectedCurrQTY: 0
        },
        cartCheckoutObject: {
            membership: []
        },
        attendeeFormObj: {
            orderNo: null,
            attendees: {}
        },
        checkoutAccountForm: {
            name: null,
            emailId: null,
            mobileNo: null,
            orderNo: null,
        },
        totalAmout: 0,
        currency: null,
        explara_membership_attendee_list_holder: 'explara_membership_attendee_list_holder',
        explara_membership_attendee_forms: 'explara_membership_attendee_forms',
        open_step: 'plan',
        configObject: {},
        currentOrderNumber: null
    },

    init: function() {
        this.bindUIActions();
    },

    bindUIActions: function() {

        // get config and set
        ExplaraMemberCheckout.getDefaulktConfiguration();

        $(document).on('submit', '#' + ExplaraMemberCheckout.settings.explara_membership_attendee_forms, function(e) {
            e.preventDefault();
            ExplaraMemberCheckout.saveAttendeeForm($(this).find('.explara_attendee'));

        });

        $(document).on('click', '.exp_checkout_step_header', function(e) {

            e.preventDefault();

            if (ExplaraMemberCheckout.settings.isCheckoutCompleted) {
                toastr.error("You have already submitted this request");
                return;
            }

            $('#explara_checkout_plan_attendee_step').hide();
            $('#explara_checkout_plans_confirm_step').hide();
            $('#explara_checkout_plan_account_step').hide();
            $('#explara_checkout_plans_step').show();

            ExplaraMemberCheckout.inactiveAllSource();
            $('.exp_checkout_step_header').addClass('active');

            ExplaraMemberCheckout.settings.open_step = 'plan';

        });

        $(document).on('click', '.exp_checkout_step_header_account', function(e) {

            e.preventDefault();

            if (ExplaraMemberCheckout.settings.isCheckoutCompleted) {
                toastr.error("You have already submitted this request");
                return;
            }

            if (ExplaraMemberCheckout.settings.cartObject.membership.length === 0 || ExplaraMemberCheckout.settings.open_step === 'plan') {
                return;
            }

            $('#explara_checkout_plan_attendee_step').hide();
            $('#explara_checkout_plans_confirm_step').hide();
            $('#explara_checkout_plan_account_step').show();
            $('#explara_checkout_plans_step').hide();

            ExplaraMemberCheckout.inactiveAllSource();
            $('.exp_checkout_step_header_account').addClass('active');

            ExplaraMemberCheckout.settings.open_step = 'account';

        });

        $(document).on('click', '.exp_checkout_step_header_attendee', function(e) {

            e.preventDefault();

            if (ExplaraMemberCheckout.settings.isCheckoutCompleted) {
                toastr.error("You have already submitted this request");
                return;
            }

            if (ExplaraMemberCheckout.settings.cartObject.membership.length === 0 || ExplaraMemberCheckout.settings.open_step === 'plan') {
                return;
            }

            $('#explara_checkout_plan_attendee_step').show();
            $('#explara_checkout_plans_confirm_step').hide();
            $('#explara_checkout_plan_account_step').hide();
            $('#explara_checkout_plans_step').hide();

            ExplaraMemberCheckout.inactiveAllSource();
            $('.exp_checkout_step_header_attendee').addClass('active');

            ExplaraMemberCheckout.settings.open_step = 'attendee';

        });

        $(document).on('click', '.exp_checkout_step_header_confirm', function(e) {

            e.preventDefault();

            $('#explara_checkout_plan_attendee_step').hide();
            $('#explara_checkout_plans_confirm_step').hide();
            $('#explara_checkout_plan_account_step').hide();
            $('#explara_checkout_plans_step').hide();

            ExplaraMemberCheckout.inactiveAllSource();
            $('.exp_checkout_step_header_confirm').addClass('active');


            ExplaraMemberCheckout.settings.open_step = 'confirm';
        });

        $(document).on('submit', '#explara_submit_plan_account_details', function(e) {
            e.preventDefault();

            ExplaraMemberCheckout.saveCheckoutAccountForm($(this).attr('id'));

        });
    },

    incrVal: function(max, ID, group_id, plan_id, currency) {
        ExplaraMemberCheckout.settings.currency = currency;
        max = parseInt(max);
        var currentValue = $('#' + ID).val();

        currentValue = parseInt(currentValue);
        currentValue = (currentValue + 1);

        if (currentValue > max) {
            return;
        }

        $('.exp_member_quantity').val(0);
        $('#' + ID).val(currentValue);

        ExplaraMemberCheckout.handelQuantityChange(group_id, plan_id, currency);
    },

    decrValue: function(max, ID, group_id, plan_id, currency) {
        ExplaraMemberCheckout.settings.currency = currency;
        max = parseInt(max);
        var currentValue = $('#' + ID).val();

        currentValue = parseInt(currentValue);
        currentValue = (currentValue - 1);

        if (currentValue < 0) {
            return;
        }

        $('.exp_member_quantity').val(0);
        $('#' + ID).val(currentValue);

        ExplaraMemberCheckout.handelQuantityChange(group_id, plan_id, currency);
    },

    getDefaulktConfiguration: function() {

        var requestData = {};
        requestData.action = 'explara_page_membership_get_config';

        $.ajax({
            url: EXPUserAjax.ajaxurl,
            type: 'post',
            data: requestData,
            success: function(response, status) {
                ExplaraMemberCheckout.settings.configObject = response.data;
            },
            error: function(data) {}
        });

    },
    handelPlanChange: function(group_id, selector, currentObject, plan_id, currency) {
        ExplaraMemberCheckout.settings.currency = currency;
        if ($(currentObject).length > 0) {
            $(currentObject).attr('data-set', true);
        }

        if (typeof $('#explara_member_discount_code').val() !== 'undefined') {
            ExplaraMemberCheckout.settings.cartObject.discountCode = $('#explara_member_discount_code').val();
        }

        $.each($('.exp_member_quantity'), function(key, value) {
            $(this).val(0);
        });

        $('#plan_selected_' + plan_id).val(1);

        // Reset all except the selected one
        $('.explara_member_plan_input').removeAttr('checked');
        $.each($('.explara_plan_quantities'), function(key, value) {
            $(this).val(0);
        });

        // Set the ticket to actial qty
        // and make the curret row radio active
        var radiobtn = document.getElementById('plan_selected_id_value_' + plan_id);
        radiobtn.checked = true;

        ExplaraMemberCheckout.settings.cartObject.selectedCurrQTY = 1;

        ExplaraMemberCheckout.settings.cartObject.action = 'page_explara_member_cart';
        ExplaraMemberCheckout.settings.cartObject.groupId = group_id;

        if (typeof selector !== 'undefined' && selector !== '' && selector !== null) {
            ExplaraMemberCheckout.preResetSession(selector);
        }

        ExplaraMemberCheckout.settings.cartObject.membership = [];

        var objectData = {};
        objectData.quantity = ExplaraMemberCheckout.settings.cartObject.selectedCurrQTY;
        objectData.membershipId = plan_id;
        ExplaraMemberCheckout.settings.cartObject.membership.push(objectData);

        // Cart calculation
        ExplaraMemberCheckout.makeCartAPICall();
    },
    handelQuantityChange: function(group_id, plan_id, currency) {

        var selectedCurrQTY = $('#plan_selected_' + plan_id).val();
        ExplaraMemberCheckout.settings.cartObject.selectedCurrQTY = selectedCurrQTY;

        // Reset all except the selected one
        $('.explara_member_plan_input').removeAttr('checked');
        $.each($('.explara_plan_quantities'), function(key, value) {
            $(this).val(0);
        });

        // Set the ticket to actial qty
        // and make the curret row radio active
        var radiobtn = document.getElementById('plan_selected_id_value_' + plan_id);
        radiobtn.checked = true;

        $('#plan_selected_' + plan_id).val(selectedCurrQTY);

        ExplaraMemberCheckout.settings.currency = currency;

        ExplaraMemberCheckout.settings.cartObject.action = 'page_explara_member_cart';
        ExplaraMemberCheckout.settings.cartObject.groupId = group_id;

        if (typeof $('#explara_member_discount_code').val() !== 'undefined') {
            ExplaraMemberCheckout.settings.cartObject.discountCode = $('#explara_member_discount_code').val();
        }

        ExplaraMemberCheckout.settings.cartObject.membership = [];
        var objectData = {};
        objectData.quantity = ExplaraMemberCheckout.settings.cartObject.selectedCurrQTY;
        objectData.membershipId = plan_id;
        ExplaraMemberCheckout.settings.cartObject.membership.push(objectData);

        // Cart calculation
        ExplaraMemberCheckout.makeCartAPICall();
    },
    applyNormalDiscount: function(group_id) {

        var value = $('#explara_member_discount_code').val();

        if (value === '') {
            $('#explara_member_discount_code').css('border', '1px solid #ff0010');
            return;
        }

        if (typeof $('#explara_member_discount_code').val() !== 'undefined') {
            ExplaraMemberCheckout.settings.cartObject.discountCode = $('#explara_member_discount_code').val();
        }

        ExplaraMemberCheckout.makeCartAPICall();
    },
    makeCartAPICall: function() {
        $.ajax({
            url: EXPUserAjax.ajaxurl,
            type: 'post',
            data: ExplaraMemberCheckout.settings.cartObject,
            success: function(response, status) {
                ExplaraMemberCheckout.processCartCalculation(response);
            },
            error: function(data) {
                //Failed
            }
        });
    },
    processCartCalculation: function(response) {

        var cart = response.data.cart;


        if (typeof cart.discount !== 'undefined' && cart.discount !== null && cart.discount !== 0) {
            $('.explara_member_discount_price').show();
            $('#explara_member_discount_value').html(cart.discount);
        } else {
            $('.explara_member_discount_price').hide();
        }

        if (typeof cart.processingFee !== 'undefined' && cart.processingFee !== null && cart.processingFee !== 0) {
            $('.explara_member_procession_fee').show();
            $('#explara_memver_procession_fee_value').html(cart.processingFee);
        } else {
            $('.explara_member_procession_fee').hide();
        }

        $('#explara_member_subtotal_value').html(cart.price);
        $('#explara_member_total_amount').html(cart.grandTotal);

        if (parseInt(cart.total) === 0) {
            ExplaraMemberCheckout.settings.totalAmout = parseInt(cart.total);
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
                    taxHtml += '<li class="item-price clearfix"><span>' + value.name + '</span> <span class="pull-right">' + ExplaraMemberCheckout.settings.currency + ' ' + value.value + '</span></li>';
                }
            });

            $('#explara_member_taxs').show().html(taxHtml);
        }
    },
    processCheckout: function() {

        ExplaraMemberCheckout.settings.cartCheckoutObject = ExplaraMemberCheckout.settings.cartObject;

        if (ExplaraMemberCheckout.settings.cartObject.membership.length === 0) {
            toastr.error("Select plan in order to proceed");
            // Show message
            return;
        }

        ExplaraMemberCheckout.settings.cartCheckoutObject.action = 'page_explara_member_checkout';

        $.ajax({
            url: EXPUserAjax.ajaxurl,
            type: 'post',
            data: ExplaraMemberCheckout.settings.cartCheckoutObject,
            success: function(response, status) {

                if (typeof response.data.status !== 'undefined' && response.data.status === 'success') {

                    ExplaraMemberCheckout.settings.cartCheckoutObject.orderNo = response.data.orderNo;
                    ExplaraMemberCheckout.settings.currentOrderNumber = response.data.orderNo;

                    ExplaraMemberCheckout.settings.tempOrderObject = response;

                    ExplaraMemberCheckout.inactiveAllSource();
                    $('.exp_checkout_step_header_account').addClass('active');

                    $('#explara_checkout_plans_confirm_step').hide();
                    $('#explara_checkout_plans_step').hide();
                    $('#explara_checkout_plan_attendee_step').hide();
                    $('#explara_checkout_plan_account_step').show();

                } else {
                    toastr.error(response.data.message);
                    //Handel error messges
                }


            },
            error: function(data) {
                //Failed
            }
        });
    },
    inactiveAllSource: function() {
        $('.exp_action_sources').removeClass('active');
    },
    processCartAttendee: function(response) {

        if (typeof response.data.success !== 'undefined' && response.data.success === 'fail') {

            toastr.error(response.data.message);
            return;
            // Show message for error
        } else {
            ExplaraMemberCheckout.settings.open_step = 'attendee';

            ExplaraMemberCheckout.getAttendeeList(response.data.orderNo);
            ExplaraMemberCheckout.settings.attendeeFormObj.orderNo = response.data.orderNo;

        }
    },
    getAttendeeList: function(orderNo) {

        var attendeeFormData = {};

        attendeeFormData.action = 'page_explara_member_attendee_form';
        attendeeFormData.orderNo = orderNo;

        $.ajax({
            url: EXPUserAjax.ajaxurl,
            type: 'post',
            data: attendeeFormData,
            success: function(response, status) {

                if (response.data.form !== false) {

                    ExplaraMemberCheckout.inactiveAllSource();
                    $('.exp_checkout_step_header_attendee').addClass('active');

                    $('#explara_checkout_plans_confirm_step').hide();
                    $('#explara_checkout_plan_account_step').hide();
                    $('#explara_checkout_plans_step').hide();
                    $('#explara_checkout_plan_attendee_step').show();
                    $('#exp_member_attendee_step_source').show();

                    $('#explara_membership_attendee_list_holder').html(response.data.form);


                    //Date picker
                    flatpickr('.explara_date_picker', {
                        inline: false,
                        allowInput: false,
                    });

                } else {

                    if (typeof response.data.paymentData !== 'undefined' && response.data.paymentData) {
                        if (typeof response.data.payment !== 'undefined' && response.data.payment === 'notAllowed') {

                            $('#explara_membership_checkout_confirm_message').text(response.data.paymentData.message);
                            ExplaraMemberCheckout.settings.isCheckoutCompleted = true;

                            ExplaraMemberCheckout.inactiveAllSource();
                            $('.exp_checkout_step_header_confirm').addClass('active');

                            $('#explara_checkout_plan_account_step').hide();
                            $('#explara_checkout_plans_step').hide();
                            $('#explara_checkout_plan_attendee_step').hide();
                            $('#explara_checkout_plans_confirm_step').show();
                            $('#exp_member_final_step_source').show();

                        } else {

                            if (response.data.paymentData.paymentLink !== null && response.data.paymentData.paymentLink !== '') {
                                location.href = response.data.paymentData.paymentLink;
                            } else {
                                location.href = ExplaraMemberCheckout.settings.configObject.groupRecipietUrl + ExplaraMemberCheckout.settings.currentOrderNumber;
                            }
                        }
                    }
                }

            },
            error: function(data) {
                //Failed
            }
        });
    },
    saveAttendeeForm: function(attendeeFormInputs) {
        ExplaraMemberCheckout.settings.attendeeFormObj.action = 'page_explara_member_attendee_form_save';

        $.each(attendeeFormInputs, function(key, value) {

            var formID = $(this).attr('id');

            ExplaraMemberCheckout.settings.attendeeFormObj.attendees[formID] = [];


            // For normal type input
            $.each($('#' + formID + ' .explara_attendee_inputs'), function(key, value) {

                var innnerInputObject = {};
                innnerInputObject.id = $(this).attr('data-id');
                innnerInputObject.label = $(this).attr('data-label');
                innnerInputObject.value = $(this).val();

                ExplaraMemberCheckout.settings.attendeeFormObj.attendees[formID].push(innnerInputObject);

            });

            // For normal type radio
            $.each($('#' + formID + ' .explara_attendee_inputs_radio'), function(key, value) {

                $.each($(value).find('.explara_attendee_inputs_radio_field'), function(inkey, invalue) {

                    if ($(invalue).is(":checked")) {

                        var innnerInputObject = {};
                        innnerInputObject.id = $(invalue).attr('data-id');
                        innnerInputObject.label = $(invalue).attr('data-label');
                        innnerInputObject.value = $(invalue).val();

                        ExplaraMemberCheckout.settings.attendeeFormObj.attendees[formID].push(innnerInputObject);
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

                    ExplaraMemberCheckout.settings.attendeeFormObj.attendees[formID].push(innnerInputObject);
                }

            });

        });

        $.ajax({
            url: EXPUserAjax.ajaxurl,
            type: 'post',
            data: ExplaraMemberCheckout.settings.attendeeFormObj,
            success: function(response, status) {

                if (typeof response.data.status !== 'undefined' && response.data.status === 'success') {

                    toastr.success(response.data.message);

                    if (typeof response.data.payment !== 'undefined' && response.data.payment === 'notAllowed') {

                        $('#explara_membership_checkout_confirm_message').text(response.data.paymentData.message);
                        ExplaraMemberCheckout.settings.isCheckoutCompleted = true;

                        ExplaraMemberCheckout.inactiveAllSource();
                        $('.exp_checkout_step_header_confirm').addClass('active');

                        $('#explara_checkout_plan_account_step').hide();
                        $('#explara_checkout_plans_step').hide();
                        $('#explara_checkout_plan_attendee_step').hide();
                        $('#explara_checkout_plans_confirm_step').show();
                        $('#exp_member_final_step_source').show();

                    } else {

                        if (response.data.paymentData.paymentLink !== null && response.data.paymentData.paymentLink !== '') {
                            location.href = response.data.paymentData.paymentLink;
                        } else {
                            location.href = ExplaraMemberCheckout.settings.configObject.groupRecipietUrl + ExplaraMemberCheckout.settings.currentOrderNumber;
                        }
                    }

                } else {
                    toastr.error(response.data.message);
                    //Handel error messges
                }

            },
            error: function(data) {
                //Failed
            }
        });
    },
    handelFileUpload: function(object) {

        ExplaraMemberCheckout.settings.attendeeFormObj.action = 'page_explara_member_attendee_form_save';

        var MainHolder = $(object).parents('.explara_attendee');
        var formID = $(MainHolder).attr('id');

        if (typeof ExplaraMemberCheckout.settings.attendeeFormObj.attendees[formID] === 'undefined') {
            ExplaraMemberCheckout.settings.attendeeFormObj.attendees[formID] = [];
        }

        var file_name = "explara_";

        $.each($('#' + formID + ' .explara_attendee_inputs_file'), function(key, value) {

            var ID = $(value).attr('id');

            var first_image = document.getElementById(ID);
            first_image = first_image.files[0];

            ExplaraMemberCheckout.uploadFile(formID, value, first_image);

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
                    ExplaraMemberCheckout.settings.attendeeFormObj.attendees[formID].push(innnerInputObject);
                } else {

                    if (typeof response.file !== 'undefined' && response.file == false) {

                        $(value).replaceWith($(value).val('').clone(true));
                        toastr.error(response.data);

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
    preInitResetSession: function(selector) {
        $.each($('#' + selector), function(key, value) {
            $(value).find('input').attr('data-set', false);
        });
    },
    saveCheckoutAccountForm: function(form_name) {

        var formObj = $('#' + form_name);

        ExplaraMemberCheckout.settings.checkoutAccountForm.name = formObj.find('#account_name').val();
        ExplaraMemberCheckout.settings.checkoutAccountForm.emailId = formObj.find('#account_email').val();
        ExplaraMemberCheckout.settings.checkoutAccountForm.mobileNo = formObj.find('#account_phone').val();
        ExplaraMemberCheckout.settings.checkoutAccountForm.orderNo = ExplaraMemberCheckout.settings.currentOrderNumber;
        ExplaraMemberCheckout.settings.checkoutAccountForm.action = 'page_explara_member_save_account';

        if ($.trim(ExplaraMemberCheckout.settings.checkoutAccountForm.name) == '') {
            toastr.error("Please enter name");
            return;
        }

        if ($.trim(ExplaraMemberCheckout.settings.checkoutAccountForm.mobileNo) == '') {
            toastr.error("Please enter phone number");
            return;
        }

        if (!ExplaraMemberCheckout.checkPhone(ExplaraMemberCheckout.settings.checkoutAccountForm.mobileNo)) {
            toastr.error("Please enter valid phone number");
            return;
        }

        if (ExplaraMemberCheckout.settings.checkoutAccountForm.mobileNo.length < 10) {
            toastr.error("Phone number should not be less then 10 digit");
            return;
        }

        if (!ExplaraMemberCheckout.validateEmail(ExplaraMemberCheckout.settings.checkoutAccountForm.emailId)) {
            toastr.error("Please enter valid email address");
            return;
        }

        $.ajax({
            url: EXPUserAjax.ajaxurl,
            type: 'post',
            data: ExplaraMemberCheckout.settings.checkoutAccountForm,
            success: function(response, status) {

                if (typeof response.data.status !== 'undefined' && response.data.status === 'success') {
                    ExplaraMemberCheckout.processCartAttendee(ExplaraMemberCheckout.settings.tempOrderObject);
                } else {

                    toastr.error(response.data.message);
                }

            },
            error: function(data) {
                //Failed

            }
        });

    },

    checkPhone: function(number) {
        var reg = /^[0-9]{1,17}$/;
        var checking = reg.test(number);

        if (checking) {
            return true;
        } else {
            return false;
        }
    },
    validateEmail: function(email) {
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    }
};

$(window).on('load', function() {
    ExplaraMemberCheckout.init();
});