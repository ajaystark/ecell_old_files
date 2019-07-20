/******* Jquery No Conflict Function *******/
window.$ = jQuery.noConflict();

var ExplaraMemberForm = {

  settings: {
    signupFormID: 'explara_event_signup',
    signupFormConfirmEmail: 'explara_event_signup_confirm_code',
    signUpHolder: 'explara_signup_holder',
    signUpEmailConfirmHolder: 'explara_signup_confirm_email_holder',
    signinFormID: 'explara_event_signin',
    fpRequest: 'explara_event_forgotpassword',
    fpCode: 'explara_event_confirm_code',
    fpReset: 'explara_event_reset_password',

    fpRequestHolder: 'explara_fp_request_holder',
    fpCodeHolder: 'explara_fp_code_holder',
    fpResetHolder: 'explara_fp_reset_holder',
    explara_account_signout: 'explara_account_signout',
    fpSubmitCodeObject: {}
  },

  init: function() {
    this.bindUIActions();
  },

  bindUIActions: function() {

    $(document).on('click', '#' + ExplaraMemberForm.settings.explara_account_signout, function(e) {

      e.preventDefault();
      ExplaraMemberForm.signout($(this));

    });

    $(document).on('submit', '#' + ExplaraMemberForm.settings.signupFormID, function(e) {

      e.preventDefault();
      ExplaraMemberForm.signup($(this));

    });

    $(document).on('submit', '#' + ExplaraMemberForm.settings.signupFormConfirmEmail, function(e) {

      e.preventDefault();
      ExplaraMemberForm.confirmEmailAddress($(this));

    });

    $(document).on('submit', '#' + ExplaraMemberForm.settings.signinFormID, function(e) {

      e.preventDefault();
      ExplaraMemberForm.signin($(this));

    });

    $(document).on('submit', '#' + ExplaraMemberForm.settings.fpRequest, function(e) {

      e.preventDefault();
      ExplaraMemberForm.requestForgotPassword($(this));

    });

    $(document).on('submit', '#' + ExplaraMemberForm.settings.fpCode, function(e) {

      e.preventDefault();
      ExplaraMemberForm.submitCodeForgotPassword($(this));

    });

    $(document).on('submit', '#' + ExplaraMemberForm.settings.fpReset, function(e) {

      e.preventDefault();
      ExplaraMemberForm.resetPassword($(this));

    });

    $(document).on('submit', '#' + ExplaraMemberForm.settings.eventRSVPSource, function(e) {

      e.preventDefault();
      ExplaraMemberForm.getRSVPFORM($(this));

    });

  },

  signup: function(formObject) {

    if (Validator.check(formObject) == false) {
      return false;
    }

    $.ajax({
      url: EXPUserAjax.ajaxurl,
      type: 'post',
      data: formObject.serialize(),
      success: function(data, status) {
        if (data.status == true) {

          ExplaraMemberForm.settings.fpSubmitCodeObject.accessToken = data.data.accessToken;

          $('#' + ExplaraMemberForm.settings.signUpHolder).hide();
          $('#' + ExplaraMemberForm.settings.signUpEmailConfirmHolder).show();

          toastr.success(data.data.message);

          formObject[0].reset();
        } else {
          toastr.warning(data.msg);
        }
      },
      error: function(data) {}
    });
  },

  signout: function(object) {

    var signoutData = {};
    signoutData.action = 'explara_event_signout';

    $.ajax({
      url: EXPUserAjax.ajaxurl,
      type: 'post',
      data: signoutData,
      success: function(data, status) {
        if (data.status == true) {
          window.location = data.events_url;
        } else {
          console.log(data);
        }
      },
      error: function(data) {}
    });
  },

  confirmEmailAddress: function(formObject) {

    if (Validator.check(formObject) == false) {
      return false;
    }

    ExplaraMemberForm.settings.fpSubmitCodeObject.verificationCode = formObject.find('#expSignupCerificationCode').val();
    ExplaraMemberForm.settings.fpSubmitCodeObject.action = formObject.find('#explara_signup_code').val();

    $.ajax({
      url: EXPUserAjax.ajaxurl,
      type: 'post',
      data: ExplaraMemberForm.settings.fpSubmitCodeObject,
      success: function(data, status) {
        if (data.status == true) {

          $('#' + ExplaraMemberForm.settings.signupFormID).show();
          $('#' + ExplaraMemberForm.settings.signupFormConfirmEmail).hide();

          formObject[0].reset();

          window.location = data.signin_url;

        } else {
          toastr.warning(data.msg);
        }
      },
      error: function(data) {}
    });
  },

  signin: function(formObject) {
    $.ajax({
      url: EXPUserAjax.ajaxurl,
      type: 'post',
      data: formObject.serialize(),
      success: function(data, status) {
        if (data.status == true) {

          formObject[0].reset();
          window.location = data.dashboard_url;

        } else {
          toastr.warning(data.msg);
        }
      },
      error: function(data) {
        //Failed
      }
    });
  },

  requestForgotPassword: function(formObject) {
    $.ajax({
      url: EXPUserAjax.ajaxurl,
      type: 'post',
      data: formObject.serialize(),
      success: function(data, status) {
        if (data.status == true) {

          ExplaraMemberForm.settings.fpSubmitCodeObject.accessToken = data.data.accessToken;

          $('#' + ExplaraMemberForm.settings.fpRequestHolder).hide();
          $('#' + ExplaraMemberForm.settings.fpResetHolder).hide();
          $('#' + ExplaraMemberForm.settings.fpCodeHolder).show();

          formObject[0].reset();

          toastr.success(data.data.message);

        } else {

          toastr.warning(data.msg);
        }
      },
      error: function(data) {}
    });
  },

  resendFPConfiramationCode: function() {

    var resetConfiramationCodeObject = {};
    resetConfiramationCodeObject.action = 'explara_forgotpassword_code_resend';
    resetConfiramationCodeObject.accessToken = ExplaraMemberForm.settings.fpSubmitCodeObject.accessToken;

    $.ajax({
      url: EXPUserAjax.ajaxurl,
      type: 'post',
      data: resetConfiramationCodeObject,
      success: function(data, status) {
        if (data.status == true) {
          ExplaraMemberForm.settings.fpSubmitCodeObject.accessToken = data.data.accessToken;

          toastr.success(data.data.message);
        } else {
          toastr.warning(data.msg);
        }
      },
      error: function(data) {}
    });
  },

  submitCodeForgotPassword: function(formObject) {

    ExplaraMemberForm.settings.fpSubmitCodeObject.verificationCode = formObject.find('#expverificationCode').val();
    ExplaraMemberForm.settings.fpSubmitCodeObject.action = formObject.find('#explara_forgotpassword_code').val();

    $.ajax({
      url: EXPUserAjax.ajaxurl,
      type: 'post',
      data: ExplaraMemberForm.settings.fpSubmitCodeObject,
      success: function(data, status) {
        if (data.status == true) {

          ExplaraMemberForm.settings.fpSubmitCodeObject.accessToken = data.data.accessToken;

          $('#' + ExplaraMemberForm.settings.fpRequestHolder).hide();
          $('#' + ExplaraMemberForm.settings.fpCodeHolder).hide();
          $('#' + ExplaraMemberForm.settings.fpResetHolder).show();

          formObject[0].reset();

          toastr.success(data.data.message);

        } else {
          toastr.warning(data.msg);
        }
      },
      error: function(data) {}
    });
  },

  resetPassword: function(formObject) {

    ExplaraMemberForm.settings.fpSubmitCodeObject.newPassword = formObject.find('#expNewPassword').val();
    ExplaraMemberForm.settings.fpSubmitCodeObject.confirmPassword = formObject.find('#expConfirmPassword').val();
    ExplaraMemberForm.settings.fpSubmitCodeObject.action = formObject.find('#explara_forgotpassword_reset').val();

    $.ajax({
      url: EXPUserAjax.ajaxurl,
      type: 'post',
      data: ExplaraMemberForm.settings.fpSubmitCodeObject,
      success: function(data, status) {
        if (data.status == true) {

          window.location = data.signin_url;
          formObject[0].reset();

          toastr.success(data.data.message);

        } else {
          toastr.warning(data.msg);
        }
      },
      error: function(data) {}
    });
  },

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
  ExplaraMemberForm.init();

  Validator.set('#explara_event_signin');
  Validator.set('#explara_event_signup');
});