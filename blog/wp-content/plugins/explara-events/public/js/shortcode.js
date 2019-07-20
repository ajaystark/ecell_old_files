/******* Jquery No Conflict Function *******/
window.$ = jQuery.noConflict();

var ExplaraShortcode = {

    settings: {
        shortcode_type: null,
        event_ids: [],
        shortcode: null,
        shortcode_single_design: null
    },

    init: function() {
        this.bindUIActions();
    },

    bindUIActions: function() {

        $(document).on('change', '.explara_shortcode_action', function(e) {

            ExplaraShortcode.settings.shortcode_type = $(this).val();
            ExplaraShortcode.settings.event_ids = [];

            if (ExplaraShortcode.settings.shortcode_type === 'single') {
                $('#explara_shortcode_event_multiple').hide();
                $('#explara_shortcode_event_single').show();
            }

            if (ExplaraShortcode.settings.shortcode_type === 'multiple') {
                $('#explara_shortcode_event_single').hide();
                $('#explara_shortcode_event_multiple').show();
            }

            $('#explara_shortcode_event_design').hide();
            $('.explara_shortcode_event_action').hide();
            $('.explara_shortcode_display').hide();

        });

        $(document).on('change', '.explara_shortcode_event_selected', function(e) {

            var value = $(this).val();

            if (value === '' || value === null) {
                $('.explara_shortcode_event_action').hide();
                $('.explara_shortcode_display').hide();
                return;
            }

            if (ExplaraShortcode.settings.shortcode_type === 'single') {
                ExplaraShortcode.settings.event_ids[0] = value;
                $('#explara_shortcode_event_design').show();
            }

            if (ExplaraShortcode.settings.shortcode_type === 'multiple') {
                ExplaraShortcode.settings.event_ids = value;
                $('#explara_shortcode_event_design').show();
            }

            if (ExplaraShortcode.settings.event_ids.length !== 0) {
                $('.explara_shortcode_event_action').show();
                $('.explara_shortcode_display').hide();
            }

            $(document).on('change', '.explara_shortcode_display_value', function(e) {
                $('.explara_shortcode_display').hide();
            });
        });

        $(document).on('click', '#explara_shortcode_event_action', function(e) {

            var events_ids = '';
            var shortcode_template = '';

            $.each(ExplaraShortcode.settings.event_ids, function(key, value) {

                if (value !== '') {

                    if (ExplaraShortcode.settings.event_ids.length - 1 === key) {
                        events_ids += value;
                    } else {
                        events_ids += value + ',';
                    }
                }

            });

            var shortcode_single_design = $('input[name="explara_shortcode_display_value"]:checked').val();
            if (ExplaraShortcode.settings.shortcode_type === 'single') {
                shortcode_template = '[explara-event-single template="' + shortcode_single_design + '" event_id="' + events_ids + '"]';
            }

            if (ExplaraShortcode.settings.shortcode_type === 'multiple') {

                if (shortcode_single_design === 'strip') {
                    shortcode_single_design = 'list';
                }

                shortcode_template = '[explara-events-list template="' + shortcode_single_design + '" event_id="' + events_ids + '"]';
            }

            ExplaraShortcode.settings.shortcode = shortcode_template;
            $('.explara_shortcode_display').show().find('#explara_generated_shortcode_input').val(ExplaraShortcode.settings.shortcode);
        });
    },

};



$(function() {
    ExplaraShortcode.init();
});