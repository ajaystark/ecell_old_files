/******* Jquery No Conflict Function *******/
window.$ = jQuery.noConflict();

var ExplaraMembershipDiscussion = {

  settings: {
    main_url: null
  },

  init: function() {
    this.bindUIActions();
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

  bindUIActions: function() {

    var checkoutpage = ExplaraMembershipAccountForm.getUrlParam('page');

    if (checkoutpage !== 'checkout') {
      this.getAll();
    }

    $(document).on('click', '.exp_reply_main_action', function(e) {

      e.preventDefault();
      var hscls = $(this).hasClass('selected_action');
      var postId = $(this).data('id');

      if (hscls) {
        $('#exp_reply_block_' + postId).hide();
        $(this).removeClass('selected_action');
      } else {
        ExplaraMembershipDiscussion.getAllComments(postId);
        $(this).addClass('selected_action');
      }

    });

    $(document).on('click', '.exp_reply_main_comment_action', function(e) {

      e.preventDefault();
      var commentId = $(this).data('id');
      var profile = $(this).data('profile');

      var siblings = $(this).parents('.post_comment_section').siblings('.exp_reply_block');
      $(siblings).find('textarea').val(profile + ' ');

      $("html, body").animate({
        scrollTop: $(siblings).find('textarea').offset().top
      }, 500);

    });
  },

  getAllComments: function(postId) {
    ExplaraMembershipDiscussion.getPostReplied(postId, function(response) {

      if (response.comments) {
        var HTML = ExplaraMembershipDiscussion.prepareCommentsHTML(response.comments);
        $('#explara_membership_comments_' + postId).html(HTML);
      }

      $('#exp_reply_block_' + postId).show();
    });
  },

  getPostReplied: function(postId, callback) {
    var requestData = {};
    requestData.action = 'page_explara_discussion_post_comments';
    requestData.commentId = postId;

    $.ajax({
      url: EXPUserAjax.ajaxurl,
      type: 'post',
      data: requestData,
      success: function(response, status) {

        if (response.comments.status === 'success') {
          callback(response.comments);
        }

      },
      error: function(data) {
        //Failed
      }
    });
  },

  post: function() {

    var message = $('#explare_member_discuss_post').val();

    if ($.trim(message) === '') {
      return;
    }

    var requestData = {};
    requestData.action = 'page_explara_discussion_post';
    requestData.postText = message;

    $('#explare_member_discuss_post').val("");

    $.ajax({
      url: EXPUserAjax.ajaxurl,
      type: 'post',
      data: requestData,
      success: function(response, status) {

        if (response.result.status === 'success') {
          ExplaraMembershipDiscussion.getAll();
        }

      },
      error: function(data) {
        //Failed
      }
    });

  },

  postComment: function(comment_id) {

    var message = $('#exp_reply_' + comment_id).val();

    if ($.trim(message) === '') {
      return;
    }

    var requestData = {};
    requestData.action = 'page_explara_discussion_post_comment';
    requestData.postText = message;
    requestData.parentCommentId = comment_id;

    $('#exp_reply_' + comment_id).val("");

    $.ajax({
      url: EXPUserAjax.ajaxurl,
      type: 'post',
      data: requestData,
      success: function(response, status) {

        if (response.result.status === 'success') {
          ExplaraMembershipDiscussion.getAllComments(comment_id);
        }

      },
      error: function(data) {
        //Failed
      }
    });
  },

  getAll: function() {

    var requestData = {};
    requestData.action = 'page_explara_discussion_get';

    $.ajax({
      url: EXPUserAjax.ajaxurl,
      type: 'post',
      data: requestData,
      success: function(response, status) {
        ExplaraMembershipDiscussion.settings.main_url = response.main_url;

        if (response.posts) {

          if (response.posts.posts) {
            ExplaraMembershipDiscussion.processPostsAndBind(response.posts.posts);
          }
        }


      },
      error: function(data) {
        //Failed
      }
    });
  },

  prepareCommentsHTML: function(comments) {
    // Prepare HTML
    var HTML = '<hr>';

    $.each(comments, function(key, comment) {

      HTML += '<div class="">';

      // TOP STRIP STRAT
      HTML += '<div class="reviewer-review">';
      HTML += '<div class="reviewer-image">';
      HTML += '<img class="" src="' + comment.profileImage + '">';
      HTML += '</div>';
      HTML += '<div class="reviewer-comment">';
      HTML += '<h3>' + comment.name + '</h3>';
      HTML += '</div>';
      HTML += '</div>';
      // TOP STRIP END
      // Text STRIP STRAT
      HTML += '<div class="row">';
      HTML += '<div class="col-sm-10 col-sm-12">';
      HTML += '<p class="post_text">' + comment.text + '</p>';
      HTML += '</div>';
      HTML += '<div class="col-sm-2 col-sm-6">';

      HTML += '<p class="exp_dess_time">' + comment.createdOn + '</p>';
      HTML += '<span><span id="comment_reply_exp_' + comment.id + '" data-profile="' + comment.profileUrl + '" class="exp_reply_main_comment_action" data-id="' + comment.id + '"><i class="fa fa-reply" aria-hidden="true"></i>';
      if (parseInt(comment.repliesCount) > 0) {
        HTML += '(' + comment.repliesCount + ')';
      }
      HTML += ' </span></span>';
      HTML += '</div>';
      HTML += '</div>';
      // Text STRIP END
      // ACTION STRIP STRAT
      HTML += '<div class="row">';
      HTML += '<div class="col-sm-1 col-sm-6">';

      HTML += '</div>';
      HTML += '<div class="col-sm-111 col-sm-6 text-left">';
      if (comment.isOwner) {
        // Delete API is not there so commenting
        // HTML += '<span><span>Delete&nbsp; </span></span>';
      }

      HTML += '</div>';
      HTML += '</div>';
      // ACTION STRIP END

      HTML += '</div>';

      HTML += '<hr>';

    });

    return HTML;
  },

  processPostsAndBind: function(posts) {

    // Prepare HTML
    var HTML = '<hr>';

    $.each(posts, function(key, post) {

      HTML += '<div class="">';

      // TOP STRIP STRAT
      HTML += '<div class="row">';
      HTML += '<div class="col-sm-2 col-xs-12">';
      HTML += '<div class="main-reviewer-review">';
      HTML += '<div class="reviewer-image">';
      HTML += '<img class="" src="' + post.profileImage + '">';
      HTML += '</div>';
      HTML += '<div class="reviewer-comment">';
      HTML += '<h3>' + post.name + '</h3>';
      HTML += '</div>';
      HTML += '</div>';
      HTML += '</div>';
      HTML += '<div class="col-sm-10 col-xs-12">';
      HTML += '<div class="row">';
      HTML += '<div class="col-sm-10 col-xs-12">';
      HTML += '<p class="post_text">' + post.text + '</p>';
      HTML += '</div>';
      HTML += '<div class="col-sm-2 col-xs-12">';
      HTML += '<p class="exp_dess_time">' + post.createdOn + '</p>';
      HTML += '<span><span class="exp_reply_main_action" data-id="' + post.id + '"><i class="fa fa-reply" aria-hidden="true"></i>';
      if (parseInt(post.commentCount) > 0) {
        HTML += '(' + post.commentCount + ')';
      }
      HTML += ' </span></span>';
      HTML += '</div>';
      HTML += '</div>';
      HTML += '</div>';
      HTML += '</div>';
      // TOP STRIP END
      // Text STRIP STRAT

      // Text STRIP END
      // ACTION STRIP STRAT
      HTML += '<div class="row">';
      HTML += '<div class="col-sm-2 col-xs-12 ">';

      HTML += '</div>';
      HTML += '<div class="col-sm-10 col-xs-12 ">';
      if (post.isOwner) {
        // Delete API is not there so commenting
        // HTML += '<span><span>Delete&nbsp; </span></span>';
      }
      // Replies will come here

      HTML += '<div class="row post_comment_section">';
      HTML += '<div class="col-sm-12 col-xs-12">';
      HTML += '<div id="explara_membership_comments_' + post.id + '"></div>';
      HTML += '</div>';
      HTML += '</div>';

      HTML += '<div id="exp_reply_block_' + post.id + '" class="row exp_reply_block" style="display:none">';
      HTML += '<div class="col-sm-12 col-sm-12 text-left">';
      HTML += '<div class="form-group">';
      HTML += '<textarea class="form-control" id="exp_reply_' + post.id + '" rows="4" placeholder="Write few words about the group"></textarea>';
      HTML += '</div>';
      HTML += '<div class="form-group">';
      HTML += '<button onclick="ExplaraMembershipDiscussion.postComment(' + post.id + ')" class="expl-membership-blue-btn" type="button">Submit</button>';
      HTML += '</div>';

      HTML += '</div>';
      HTML += '</div>';
      // Replies will come here END


      HTML += '</div>';
      HTML += '</div>';
      // ACTION STRIP END

      HTML += '</div>';

      HTML += '<hr>';

    });

    $('#explara_membership_discussion').html(HTML);

  }
};

$(function() {
  ExplaraMembershipDiscussion.init();
});