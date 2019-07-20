<?php
namespace explara;

add_action('wp_ajax_page_explara_discussion_get', array('explara\ExplaraMembershipGroups', 'getAll'));
add_action('wp_ajax_nopriv_page_explara_discussion_get', array('explara\ExplaraMembershipGroups', 'getAll'));

add_action('wp_ajax_page_explara_discussion_post_comments', array('explara\ExplaraMembershipGroups', 'getAllComments'));
add_action('wp_ajax_nopriv_page_explara_discussion_post_comments', array('explara\ExplaraMembershipGroups', 'getAllComments'));

add_action('wp_ajax_page_explara_discussion_post', array('explara\ExplaraMembershipGroups', 'post'));
add_action('wp_ajax_nopriv_page_explara_discussion_post', array('explara\ExplaraMembershipGroups', 'post'));

add_action('wp_ajax_page_explara_discussion_post_comment', array('explara\ExplaraMembershipGroups', 'postComment'));
add_action('wp_ajax_nopriv_page_explara_discussion_post_comment', array('explara\ExplaraMembershipGroups', 'postComment'));

class ExplaraMembershipGroups {

	public static function post() {

		$status = true;
		$posts = [];

		$db_group = ExpGroupsDB::getGroup();
		$accessToken = ExplaraMembershipAccountPost::getAccessToken();
		$params = ['groupId' => $db_group->group_id,
			'accessToken' => $accessToken,
			'postText' => $_POST['postText'],
		];

		$params = json_encode($params);
		$post = ExplaraMemberAuthApi::postDiscussion($params);

		wp_send_json(['status' => $status, 'result' => $post]);
	}

	public static function postComment() {

		$status = true;
		$posts = [];

		$db_group = ExpGroupsDB::getGroup();
		$accessToken = ExplaraMembershipAccountPost::getAccessToken();
		$params = ['groupId' => $db_group->group_id,
			'accessToken' => $accessToken,
			'postText' => $_POST['postText'],
			'parentCommentId' => $_POST['parentCommentId'],
		];

		$params = json_encode($params);
		$post = ExplaraMemberAuthApi::postDiscussion($params);

		wp_send_json(['status' => $status, 'result' => $post]);
	}

	public static function getAll() {

		$status = true;
		$posts = [];

		$db_group = ExpGroupsDB::getGroup();
		$accessToken = ExplaraMembershipAccountPost::getAccessToken();
		$params = ['groupId' => $db_group->group_id, 'accessToken' => $accessToken];

		$params = json_encode($params);
		$posts = ExplaraMemberAuthApi::getAllDiscussion($params);

		wp_send_json(['status' => $status, 'posts' => $posts, 'main_url' => EXPLARA_MEMBER_MAIN_API_URL]);
	}

	public static function getAllComments() {

		$status = true;
		$posts = [];

		$db_group = ExpGroupsDB::getGroup();
		$accessToken = ExplaraMembershipAccountPost::getAccessToken();
		$params = ['groupId' => $db_group->group_id, 'accessToken' => $accessToken, 'commentId' => $_POST['commentId']];

		$params = json_encode($params);
		$comments = ExplaraMemberAuthApi::getAllComments($params);

		wp_send_json(['status' => $status, 'comments' => $comments, 'main_url' => EXPLARA_MEMBER_MAIN_API_URL]);
	}
}