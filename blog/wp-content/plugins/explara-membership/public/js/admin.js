/******* Jquery No Conflict Function *******/
window.$ = jQuery.noConflict();

var ExplaraMembershipAdminForm = {

  settings: {
    formObj: null,
  },

  init: function() {
    this.bindUIActions();
  },

  bindUIActions: function() {

    $('.exp_membership_toggle_group').on('click', function(e) {

      var group_id = $(this).data('group');
      var is_shown = $(this).data('shown');

      ExplaraMembershipAdminForm.toggleGroup(group_id, is_shown);
    });

    $(document).on('submit', '#explara_events_list_filter', function(e) {

      e.preventDefault();
      var event_ids = [];

      var action_type = $(this).find('#bulk-action-selector-top').val();

      $.each($('.explara_member_bulk_action_value'), function(key, value) {

        if ($(value).is(":checked")) {
          event_ids.push($(value).val());
        }

      });

      if (event_ids.length === 0) {
        return;
      }

      if (action_type === 'show' || action_type === 'hide') {
        ExplaraMembershipAdminForm.toggleBulkEvents(action_type, event_ids);
      }
    });
  },

  saveSettingPages: function(FormId) {

    var settingPageObject = {};

    settingPageObject.explara_membership_account_page = $('#explara_membership_account_page').val();
    settingPageObject.explara_membership_portal_page = $('#explara_membership_portal_page').val();
    settingPageObject.explara_membership_page = $('#explara_membership_page').val();
    settingPageObject.explara_membership_payment_page = $('#explara_membership_payment_page').val();

    settingPageObject.action = 'explara_membership_setting_pages';

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
    ExplaraMembershipAdminForm.settings.formObj = $(FormId);

    if (Validator.check(ExplaraMembershipAdminForm.settings.formObj) == false) {
      return false;
    }

    $.ajax({
      url: ajaxurl,
      type: 'post',
      data: ExplaraMembershipAdminForm.settings.formObj.serialize(),
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

  toggleGroup: function(group_id, is_shown) {

    var formData = {
      action: 'page_exp_membership_toggle_group',
      group_id: group_id,
      is_shown: is_shown,
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

    $('#exp_groups_sync').attr('disabled', 'true').css('pointer-events', 'none').html('Fetching...');

    var formData = {
      action: 'page_fetch_sync_groups'
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
  ExplaraMembershipAdminForm.init();

  Validator.set('#exp_membership_add_form');
  Validator.set('#exp_membership_edit_form');
  Validator.set('#exp_membership_customization_form');
});