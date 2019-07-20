/******* Jquery No Conflict Function *******/
window.$ = jQuery.noConflict();

var ExplaraAdminForm = {

    changeGroup: function() {

        var groupId = document.getElementById("groupId").value;

        $("#groupIdName").val($("#groupId option:selected").text());

        // Get the Membership Type List based on the ID
        // Populate the Options for Membership Type

        $.ajax({
            url: ajaxurl,
            type: 'post',
            data: ({
                action: 'get_memberships_type',
                groupId: groupId
            }),
            success: function(data, status) {

                $("#membershipType").find('option').not(':first').remove();

                var dropdown = $("#membershipType");

                $.each(data.types, function() {
                    dropdown.append(new Option(this.name, this.id));
                });

            },
            error: function(data) {
                alert("Not able to fetch the membership type at this point of time.");
            }
        });

    },

    changeMembershipType: function() {

        $("#membershipTypeName").val($("#membershipType option:selected").text());

    },

    sendData: function(FormObject, callback) {

        $.ajax({
            url: ajaxurl,
            type: 'post',
            data: FormObject.serialize(),
            success: function(data, status) {

                callback(data, status);
            },
            error: function(data) {
                alert("Error processing the request. Please ensure you have the plugin updated.");
            }
        });

    },

    saveAdminFormData: function(FormId, reload) {

        var formObj = $(FormId);

        ExplaraAdminForm.sendData(formObj, function(data, status) {

            $('#token-form-message').html('Successfully saved the token');
        });
    },

    eventShortcode: function(FormId, placeholder, messageHolder) {

        var formObj = $(FormId);

        ExplaraAdminForm.sendData(formObj, function(data, status) {

            $('#exp_events_form_message_holder').show();

            $('#exp_events_form_message').html("Shortcode generated successfully.");

            $(placeholder).html(data.shortcode);
        });
    },

    groupShortcode: function(FormId, placeholder, messageHolder) {

        var formObj = $(FormId);

        if ($(FormId + ' select[name=groupId]').val() == '') {

            $('#exp_group_form_message_holder').show();

            $('#exp_group_form_message').html("Please select a group.");

            return false;
        }

        if ($(FormId + ' select[name=membershipType]').val() == '') {

            $('#exp_group_form_message_holder').show();

            $('#exp_group_form_message').html("Please select a Membership Type.");

            return false;
        }

        ExplaraAdminForm.sendData(formObj, function(data, status) {

            $('#exp_group_form_message_holder').show();

            $('#exp_group_form_message').html("Shortcode generated successfully.");

            $(placeholder).html(data.shortcode);
        });
    }

};
