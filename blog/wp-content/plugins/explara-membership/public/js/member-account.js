/******* Jquery No Conflict Function *******/
window.$ = jQuery.noConflict();

var ExplaraMembershipAccountForm = {

    settings: {
        signupFormID: 'explara_group_signup',
        signupFormConfirmEmail: 'explara_group_signup_confirm_code',
        signUpHolder: 'exp-member-account-container',
        signUpEmailConfirmHolder: 'explara_signup_confirm_email_holder',
        signinFormID: 'explara_group_signin',
        fpRequest: 'explara_group_forgotpassword',
        fpCode: 'explara_group_confirm_code',
        fpReset: 'explara_group_reset_password',

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

        $(document).on('click', '#' + ExplaraMembershipAccountForm.settings.explara_account_signout, function(e) {

            e.preventDefault();
            ExplaraMembershipAccountForm.signout($(this));

        });

        $(document).on('submit', '#' + ExplaraMembershipAccountForm.settings.signupFormID, function(e) {

            e.preventDefault();
            ExplaraMembershipAccountForm.signup($(this));

        });

        $(document).on('submit', '#' + ExplaraMembershipAccountForm.settings.signupFormConfirmEmail, function(e) {

            e.preventDefault();
            ExplaraMembershipAccountForm.confirmEmailAddress($(this));

        });

        $(document).on('submit', '#' + ExplaraMembershipAccountForm.settings.signinFormID, function(e) {

            e.preventDefault();
            ExplaraMembershipAccountForm.signin($(this));

        });

        $(document).on('submit', '#' + ExplaraMembershipAccountForm.settings.fpRequest, function(e) {

            e.preventDefault();
            ExplaraMembershipAccountForm.requestForgotPassword($(this));

        });

        $(document).on('submit', '#' + ExplaraMembershipAccountForm.settings.fpCode, function(e) {

            e.preventDefault();
            ExplaraMembershipAccountForm.submitCodeForgotPassword($(this));

        });

        $(document).on('submit', '#' + ExplaraMembershipAccountForm.settings.fpReset, function(e) {

            e.preventDefault();
            ExplaraMembershipAccountForm.resetPassword($(this));

        });

        $(document).on('submit', '#' + ExplaraMembershipAccountForm.settings.eventRSVPSource, function(e) {

            e.preventDefault();
            ExplaraMembershipAccountForm.getRSVPFORM($(this));

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

                    ExplaraMembershipAccountForm.settings.fpSubmitCodeObject.accessToken = data.data.accessToken;

                    $('#' + ExplaraMembershipAccountForm.settings.signUpHolder).hide();
                    $('#' + ExplaraMembershipAccountForm.settings.signUpEmailConfirmHolder).show();

                    toastr.success(data.data.message);

                    formObject[0].reset();
                } else {
                    toastr.error(data.msg);
                }
            },
            error: function(data) {}
        });
    },

    getUrlParam: function(parameterName) {
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

    signout: function(object) {

        var signoutData = {};
        signoutData.action = 'explara_event_signout';

        $.ajax({
            url: EXPUserAjax.ajaxurl,
            type: 'post',
            data: signoutData,
            success: function(data, status) {
                if (data.status == true) {
                    window.location = data.redirect_url;
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

        ExplaraMembershipAccountForm.settings.fpSubmitCodeObject.verificationCode = formObject.find('#expSignupCerificationCode').val();
        ExplaraMembershipAccountForm.settings.fpSubmitCodeObject.action = formObject.find('#explara_signup_code').val();

        $.ajax({
            url: EXPUserAjax.ajaxurl,
            type: 'post',
            data: ExplaraMembershipAccountForm.settings.fpSubmitCodeObject,
            success: function(data, status) {
                if (data.status == true) {

                    $('#' + ExplaraMembershipAccountForm.settings.signupFormID).show();
                    $('#' + ExplaraMembershipAccountForm.settings.signupFormConfirmEmail).hide();

                    formObject[0].reset();

                    var fromUrl = ExplaraMembershipAccountForm.getUrlParam('from');
                    var pageName = ExplaraMembershipAccountForm.getUrlParam('page');

                    if (pageName === null) {
                        window.location = data.signin_url;
                    } else {

                        if (fromUrl === null) {
                            window.location = data.signin_url;
                        } else {
                            window.location = data.signin_url + '&from=' + fromUrl;
                        }
                    }

                } else {
                    toastr.error(data.msg);
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

                    var fromUrl = ExplaraMembershipAccountForm.getUrlParam('from');

                    if (fromUrl === null) {
                        window.location = data.dashboard_url;
                    } else {
                        window.location = fromUrl;
                    }

                } else {
                    toastr.error(data.msg);
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

                    ExplaraMembershipAccountForm.settings.fpSubmitCodeObject.accessToken = data.data.accessToken;

                    $('#' + ExplaraMembershipAccountForm.settings.fpRequestHolder).hide();
                    $('#' + ExplaraMembershipAccountForm.settings.fpResetHolder).hide();
                    $('#' + ExplaraMembershipAccountForm.settings.fpCodeHolder).show();

                    formObject[0].reset();

                    toastr.success(data.data.message);

                } else {

                    toastr.error(data.msg);
                }
            },
            error: function(data) {}
        });
    },

    resendFPConfiramationCode: function() {

        var resetConfiramationCodeObject = {};
        resetConfiramationCodeObject.action = 'explara_membership_forgotpassword_code_resend';
        resetConfiramationCodeObject.accessToken = ExplaraMembershipAccountForm.settings.fpSubmitCodeObject.accessToken;

        $.ajax({
            url: EXPUserAjax.ajaxurl,
            type: 'post',
            data: resetConfiramationCodeObject,
            success: function(data, status) {
                if (data.status == true) {
                    ExplaraMembershipAccountForm.settings.fpSubmitCodeObject.accessToken = data.data.accessToken;

                    toastr.success(data.data.message);
                } else {
                    toastr.error(data.msg);
                }
            },
            error: function(data) {}
        });
    },

    submitCodeForgotPassword: function(formObject) {

        ExplaraMembershipAccountForm.settings.fpSubmitCodeObject.verificationCode = formObject.find('#expverificationCode').val();
        ExplaraMembershipAccountForm.settings.fpSubmitCodeObject.action = formObject.find('#explara_membership_forgotpassword_code').val();

        $.ajax({
            url: EXPUserAjax.ajaxurl,
            type: 'post',
            data: ExplaraMembershipAccountForm.settings.fpSubmitCodeObject,
            success: function(data, status) {
                if (data.status == true) {

                    ExplaraMembershipAccountForm.settings.fpSubmitCodeObject.accessToken = data.data.accessToken;

                    $('#' + ExplaraMembershipAccountForm.settings.fpRequestHolder).hide();
                    $('#' + ExplaraMembershipAccountForm.settings.fpCodeHolder).hide();
                    $('#' + ExplaraMembershipAccountForm.settings.fpResetHolder).show();

                    formObject[0].reset();

                    toastr.success(data.data.message);

                } else {
                    toastr.error(data.msg);
                }
            },
            error: function(data) {}
        });
    },

    resetPassword: function(formObject) {

        ExplaraMembershipAccountForm.settings.fpSubmitCodeObject.newPassword = formObject.find('#expNewPassword').val();
        ExplaraMembershipAccountForm.settings.fpSubmitCodeObject.confirmPassword = formObject.find('#expConfirmPassword').val();
        ExplaraMembershipAccountForm.settings.fpSubmitCodeObject.action = formObject.find('#explara_group_forgotpassword_reset').val();

        $.ajax({
            url: EXPUserAjax.ajaxurl,
            type: 'post',
            data: ExplaraMembershipAccountForm.settings.fpSubmitCodeObject,
            success: function(data, status) {
                if (data.status == true) {

                    window.location = data.signin_url;
                    formObject[0].reset();

                    toastr.success(data.data.message);

                } else {
                    toastr.error(data.msg);
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
    ExplaraMembershipAccountForm.init();

    Validator.set('#explara_group_signin');
    Validator.set('#explara_group_signup');
});