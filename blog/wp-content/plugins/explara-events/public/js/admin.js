/******* Jquery No Conflict Function *******/
window.$ = jQuery.noConflict();

var ExplaraAdminForm = {

    settings: {
        formObj: null,
    },

    init: function() {
        this.bindUIActions();
    },

    bindUIActions: function() {

        $('body').on('change', '.exp_toggle_event', function() {

            var event_id = $(this).data('event');
            var is_shown = $(this).data('shown');

            ExplaraAdminForm.toggleEvent(event_id, is_shown);

        });

        $(document).on('submit', '#explara_events_list_filter', function(e) {

            e.preventDefault();
            var event_ids = [];

            var action_type = $(this).find('#bulk-action-selector-top').val();

            $.each($('.explara_bulk_action_value'), function(key, value) {

                if ($(value).is(":checked")) {
                    event_ids.push($(value).val());
                }

            });

            if (event_ids.length === 0) {
                return;
            }

            if (action_type === 'show' || action_type === 'hide') {
                ExplaraAdminForm.toggleBulkEvents(action_type, event_ids);
            }
        });
    },

    saveSettingPages: function(FormId) {

        var settingPageObject = {};

        settingPageObject.member_account = $('#explara_member_account').val();
        settingPageObject.member_portal = $('#explara_member_portal').val();
        settingPageObject.member_event = $('#explara_member_event').val();
        settingPageObject.member_payment = $('#explara_member_payment').val();

        settingPageObject.action = 'explara_setting_pages';

        $.ajax({
            url: ajaxurl,
            type: 'post',
            data: settingPageObject,
            success: function(data, status) {
                if (data.status == true) {
                    $(FormId).find('.exp_success_msg p').html(data.msg);
                    $(FormId).find('.exp_success_msg').fadeIn(1000).siblings('.exp-msg').hide();

                } else {
                    $(FormId).find('.exp_error_msg p').html(data.msg);
                    $(FormId).find('.exp_error_msg').fadeIn(1000).siblings('.exp-msg').hide();
                }
            },
            error: function(data) {
                $(FormId).find('.exp_error_msg p').html(data.msg);
                $(FormId).find('.exp_error_msg').fadeIn(1000).siblings('.exp-msg').hide();
            }
        });

    },

    post: function(FormId, reload) {
        ExplaraAdminForm.settings.formObj = $(FormId);

        if (Validator.check(ExplaraAdminForm.settings.formObj) == false) {
            return false;
        }

        $.ajax({
            url: ajaxurl,
            type: 'post',
            data: ExplaraAdminForm.settings.formObj.serialize(),
            success: function(data, status) {
                if (data.status == true) {
                    $(FormId).find('.exp_success_msg p').html(data.msg);
                    $(FormId).find('.exp_success_msg').fadeIn(1000).siblings('.exp-msg').hide();

                    if (typeof reload !== 'undefined' && reload === 'true') {
                        location.reload();
                    }

                } else {
                    $(FormId).find('.exp_error_msg p').html(data.msg);
                    $(FormId).find('.exp_error_msg').fadeIn(1000).siblings('.exp-msg').hide();
                }
            },
            error: function(data) {
                $(FormId).find('.exp_error_msg p').html(data.msg);
                $(FormId).find('.exp_error_msg').fadeIn(1000).siblings('.exp-msg').hide();
            }
        });
    },

    toggleEvent: function(event_id, is_shown) {

        var formData = {
            event_id: event_id,
            is_shown: is_shown,
            action: 'page_toggle_event'
        };

        $.ajax({
            url: ajaxurl,
            type: 'post',
            data: formData,
            success: function(data, status) {}
        });
    },

    toggleBulkEvents: function(action_type, event_ids) {

        var formData = {
            event_ids: event_ids,
            action_type: action_type,
            action: 'page_toggle_events_bulk'
        };

        $.ajax({
            url: ajaxurl,
            type: 'post',
            data: formData,
            success: function(data, status) {
                location.reload();
            }
        });
    },

    fetchSync: function() {

        $('#exp_events_sync').attr('disabled', 'true').css('pointer-events', 'none').html('Fetching...');

        var formData = {
            action: 'page_fetch_sync_events'
        };

        $.ajax({
            url: ajaxurl,
            type: 'post',
            data: formData,
            success: function(data, status) {
                location.reload();
            }
        });
    },
    singleEventFetchSync: function(event_display_id) {

        var formData = {
            action: 'page_single_event_fetch_sync',
            event_display_id: event_display_id
        };

        $('#exp_event_sync').attr('disabled', 'true').css('pointer-events', 'none').html('Fetching...');

        $.ajax({
            url: ajaxurl,
            type: 'post',
            data: formData,
            success: function(data, status) {
                location.reload();
            }
        });
    },

};

var Start = {

    settings: {
        frFieldsHolder: $('.exp-fields-set')
    },

    init: function() {
        this.bindUIActions();
    },

    bindUIActions: function() {
        $('#exp-add-field').on('click', function(e) {

            // Create a input field as required
            var input = '<div class="exp-inputs"><input type="text" class="fields" name="fields[name][]" placeholder="Enter Field"><span class="exp-remove-field dashicons dashicons dashicons-no"></span></div>';

            // Handle the input holder
            Start.settings.frFieldsHolder.append(input);

            e.preventDefault();

        });

        $(document).on('click', '.exp-remove-field', function(e) {

            $(this).parent().remove();
            e.preventDefault();

        });

    }
};

var Upload = {

    init: function(ButtonId, InputId) {
        var custom_uploader;


        $('#upload_mailtemplate').click(function(e) {

            e.preventDefault();

            //If the uploader object has already been created, reopen the dialog
            if (custom_uploader) {
                custom_uploader.open();
                return;
            }

            //Extend the wp.media object
            custom_uploader = wp.media.frames.file_frame = wp.media({
                title: 'Choose EMail Template HTML',
                button: {
                    text: 'Choose File'
                },
                multiple: false
            });

            //When a file is selected, grab the URL and set it as the text field's value
            custom_uploader.on('select', function() {
                attachment = custom_uploader.state().get('selection').first().toJSON();
                $('#mailtemplates').val(attachment.url);
            });

            //Open the uploader dialog
            custom_uploader.open();

        });
    }
};

var Validator = {

    init: function() {

    },

    check: function(FormObj) {
        return FormObj.validator('checkform', FormObj);
    },

    set: function(FormId) {
        $(FormId + ' input').validator({
            events: 'blur change'
        });
    },

};


$(function() {
    Start.init();
    Upload.init();
    ExplaraAdminForm.init();

    Validator.set('#exp_add_form');
    Validator.set('#exp_edit_form');
    Validator.set('#exp_customization_form');
});