/******* Jquery No Conflict Function *******/
window.$ = jQuery.noConflict();

var ExplaraMembershipGroup = {

    settings: {
        photos: [],
        active_event_type: 'upcoming',
        timer: null,
        timerRequest: null
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

    init: function() {
        var checkoutpage = ExplaraMembershipAccountForm.getUrlParam('page');
        this.bindUIActions();
        if (checkoutpage !== 'checkout') {
            this.handelmemberSearch();
            this.initSliderData();
        }

    },

    bindUIActions: function() {

        $(document).on('click', '.explara_order_member_both_view', function(e) {
            e.preventDefault();

            var typeGroup = $(this).attr('data-group');
            var typeEvent = $(this).attr('data-event');
            var typeSource = $(this).attr('data-source');

            $('.explara_order_member_both_view').removeClass('exp_selected_link')
            $(this).addClass('exp_selected_link');

            if (typeSource === 'group') {

                $('.' + typeGroup).show();
                $('.' + typeEvent).hide();
            } else {

                $('.' + typeGroup).hide();
                $('.' + typeEvent).show();
            }

        });

        $(document).on('click', '.expl-membership-member-card', function(e) {

            e.preventDefault();

            var member_id = $(this).data('member');
            ExplaraMembershipGroup.getMemberProfileInfo(member_id);

        });

        $(document).on('click', '.exp_group_event_tab_toggle', function(e) {

            e.preventDefault();
            $(this).parents('li').siblings('li').find('a').removeClass('exp_selected_link');
            $(this).addClass('exp_selected_link');

            var show = $(this).data('show');
            var hide = $(this).data('hide');
            var type = $(this).data('type');

            ExplaraMembershipGroup.settings.active_event_type = type;

            $('#' + hide).hide();
            $('#' + show).show();

        });

        $(document).on('click', '.exp_group_event_display_tab_toggle', function(e) {

            e.preventDefault();
            $(this).parents('li').siblings('li').find('a').removeClass('exp_selected_link_display');
            $(this).addClass('exp_selected_link_display');

            var type = $(this).data('type');

            if (ExplaraMembershipGroup.settings.active_event_type === 'past') {
                $('.exp_past_display').hide();

                if (type == 'grid') {
                    $('#exp_group_past_grid').show();
                }

                if (type == 'list') {
                    $('#exp_group_past_list').show();
                }

                if (type == 'calendar') {
                    $('#exp_group_past_calendar').show();
                    jQuery(document).find('#explara_group_event_past_calendar').fullCalendar('render');
                }
            } else {
                $('.exp_upcoming_display').hide();

                if (type == 'grid') {
                    $('#exp_group_upcoming_grid').show();
                }

                if (type == 'list') {
                    $('#exp_group_upcoming_list').show();
                }

                if (type == 'calendar') {
                    $('#exp_group_upcoming_calendar').show();
                    jQuery(document).find('#explara_group_event_upcoming_calendar').fullCalendar('render');
                }
            }

        });

        $(document).on('click', '.exp_group_photos_action', function(e) {

            e.preventDefault();

            if (ExplaraMembershipGroup.settings.photos.length == 0) {
                return;
            }

            var indexVal = parseInt($(this).data('index'));

            ExplaraMembershipGroup.initSlider(indexVal, ExplaraMembershipGroup.settings.photos);
        });

        // if ($('.exp_group_discussion_action').length > 0) {
        //     var requestData = {};
        //     requestData.action = 'explara_page_check_group_member_profile';

        //     $.ajax({
        //         url: EXPUserAjax.ajaxurl,
        //         type: 'post',
        //         data: requestData,
        //         success: function(response, status) {

        //             if (response.data) {
        //                 $('.exp_group_discussion_action').show();
        //             }

        //         },
        //         error: function(data) {}
        //     });
        // }

    },

    getMemberProfileInfo: function(member_id) {
        var requestData = {};
        requestData.memberId = member_id;
        requestData.action = 'explara_page_get_profile_info';

        $.ajax({
            url: EXPUserAjax.ajaxurl,
            type: 'post',
            data: requestData,
            success: function(response, status) {

                if (response.member) {
                    $('#expl-member-info').find('#expl-member-info-content').html(response.html);
                    $('#expl-member-info').modal('show');
                }

            },
            error: function(data) {}
        });
    },

    handelmemberSearch: function() {

        var message = $('#exp_membership_member_search').val();

        var requestData = {};
        requestData.action = 'explara_page_member_search';
        requestData.keyword = message;

        if (ExplaraMembershipGroup.settings.timerRequest) {
            ExplaraMembershipGroup.settings.timerRequest.abort();
        }

        clearTimeout(ExplaraMembershipGroup.settings.timer);

        ExplaraMembershipGroup.settings.timer = setTimeout(function() {

            ExplaraMembershipGroup.settings.timer = $.ajax({
                url: EXPUserAjax.ajaxurl,
                type: 'post',
                data: requestData,
                success: function(response, status) {

                    if (response.members) {
                        $('#exp_tab_member_count').html(response.members.length);
                        $('#exp_membership_member_holder_tab').html(response.html);
                    }

                },
                error: function(data) {}
            });

        }, 2000);
    },

    handelOpenMemberTab: function(type) {

        $.each($('.exp_all_tabs'), function(key, value) {

            var htefVal = $(this).find('a').attr('href');

            if (htefVal === '#' + type) {
                $(value).addClass('active');
                $(value).find('a').attr('aria-expanded', true);
            } else {
                $(value).removeClass('active');
                $(value).find('a').attr('aria-expanded', false);
            }

        });

    },

    initSlider: function(startIndex, photos) {

        var pswpElement = document.querySelectorAll('.pswp')[0];
        var items = [];

        var i = 0;
        for (i = 0; i < photos.length; i++) {
            items.push({
                src: photos[i].src,
                w: photos[i].w,
                h: photos[i].h
            });
        }

        var options = {
            index: startIndex
        };

        // Initializes and opens PhotoSwipe
        var gallery = new PhotoSwipe(pswpElement, PhotoSwipeUI_Default, items, options);
        gallery.init();

    },

    initSliderData: function() {
        var requestData = {};
        requestData.action = 'explara_page_group_photos';

        $.ajax({
            url: EXPUserAjax.ajaxurl,
            type: 'post',
            data: requestData,
            success: function(response, status) {

                if (response.photos) {
                    ExplaraMembershipGroup.settings.photos = response.photos;
                }

            },
            error: function(data) {}
        });

    }
};

$(function() {
    ExplaraMembershipGroup.init();
});