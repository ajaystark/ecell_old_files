<?php
namespace explara;

add_action('wp_ajax_explara_event_signup', array('explara\ExplaraMemberPost', 'signup'));
add_action('wp_ajax_nopriv_explara_event_signup', array('explara\ExplaraMemberPost', 'signup'));

add_action('wp_ajax_explara_event_signin', array('explara\ExplaraMemberPost', 'signin'));
add_action('wp_ajax_nopriv_explara_event_signin', array('explara\ExplaraMemberPost', 'signin'));

add_action('wp_ajax_explara_event_signout', array('explara\ExplaraMemberPost', 'signout'));
add_action('wp_ajax_nopriv_explara_event_signout', array('explara\ExplaraMemberPost', 'signout'));

add_action('wp_ajax_explara_forgotpassword_request', array('explara\ExplaraMemberPost', 'forgotPasswordRequest'));
add_action('wp_ajax_nopriv_explara_forgotpassword_request', array('explara\ExplaraMemberPost', 'forgotPasswordRequest'));

add_action('wp_ajax_explara_forgotpassword_code', array('explara\ExplaraMemberPost', 'forgotPasswordSendCode'));
add_action('wp_ajax_nopriv_explara_forgotpassword_code', array('explara\ExplaraMemberPost', 'forgotPasswordSendCode'));

add_action('wp_ajax_explara_forgotpassword_code_resend', array('explara\ExplaraMemberPost', 'resendConfiramationCode'));
add_action('wp_ajax_nopriv_explara_forgotpassword_code_resend', array('explara\ExplaraMemberPost', 'resendConfiramationCode'));

add_action('wp_ajax_explara_forgotpassword_reset', array('explara\ExplaraMemberPost', 'resetPassword'));
add_action('wp_ajax_nopriv_explara_forgotpassword_reset', array('explara\ExplaraMemberPost', 'resetPassword'));

add_action('wp_ajax_explara_signup_code', array('explara\ExplaraMemberPost', 'verifyEmail'));
add_action('wp_ajax_nopriv_explara_signup_code', array('explara\ExplaraMemberPost', 'verifyEmail'));

class ExplaraMemberPost {

	public static function signup() {

		$status = true;

		$data = self::getSignupData();

		$response = ExplaraMemberApi::signUp($data);
		$msg = $response->message;

		if ($response->status == 'error') {
			$status = false;
		} else {

			// Save user details
			ExpMembersDB::saveSignupData($response);
		}

		wp_send_json(['msg' => $msg, 'status' => $status, 'data' => $response]);
	}

	public static function signin() {

		$status = true;

		$PageId = get_option('explara_member_portal_page');
		$dashboard_url = get_permalink($PageId);

		$data = self::getSigninData();
		$data['password'] =  md5($data['password']);

		$response = ExplaraMemberApi::signIn($data);
		$msg = $response->message;

		if ($response->status == 'error') {
			$status = false;
		} else {
			// Save user details
			ExpMembersDB::saveSigninData($response);

			// Set the cookie for access token
			$encodedToken = base64_encode($response->accessToken);

			setcookie("explara_accesss_token", $encodedToken, time() + (10 * 365 * 24 * 60 * 60), "/");

		}

		wp_send_json(['msg' => $msg, 'status' => $status, 'dashboard_url' => $dashboard_url]);
	}

	public static function signout() {

		$status = true;

		$cookie_access_token = isset($_COOKIE['explara_accesss_token']) ? $_COOKIE['explara_accesss_token'] : null;

		if (empty($cookie_access_token)) {
			$status = false;
		} else {

			$cookie_access_token = base64_decode($cookie_access_token);

			ExpMembersDB::signout($cookie_access_token);
			setcookie('explara_accesss_token', '', time() - 3600, "/");
		}

		$EventsPageId = get_option('explara_events_page');
		$explara_events_page_url = get_permalink($EventsPageId);

		wp_send_json(['msg' => 'success', 'status' => $status, 'events_url' => $explara_events_page_url]);
	}

	public static function forgotPasswordRequest() {

		$status = true;

		$data = $_POST;

		$response = ExplaraMemberApi::forgotPasswordRequest($data);
		$msg = $response->message;

		if ($response->status == 'error') {
			$status = false;
		}

		wp_send_json(['msg' => $msg, 'status' => $status, 'data' => $response]);
	}

	public static function forgotPasswordSendCode() {

		$status = true;

		$data = $_POST;

		$response = ExplaraMemberApi::forgotPasswordSendCode($data);
		$msg = $response->message;

		if ($response->status == 'error') {
			$status = false;
		}

		wp_send_json(['msg' => $msg, 'status' => $status, 'data' => $response]);
	}

	public static function resendConfiramationCode() {

		$status = true;

		$data = $_POST;

		$response = ExplaraMemberApi::resendConfiramationCode($data);
		$msg = $response->message;

		if ($response->status == 'error') {
			$status = false;
		}

		wp_send_json(['msg' => $msg, 'status' => $status, 'data' => $response]);
	}

	public static function resetPassword() {

		$status = true;

		$data = $_POST;

		$response = ExplaraMemberApi::resetPassword($data);
		$msg = $response->message;

		if ($response->status == 'error') {
			$status = false;
		}

		$PageId = get_option('explara_member_account_page');
		$signin_url = get_permalink($PageId) . '?page=signin';

		wp_send_json(['msg' => $msg, 'status' => $status, 'data' => $response, 'signin_url' => $signin_url]);
	}

	public static function verifyEmail() {

		$status = true;

		$data = $_POST;

		$response = ExplaraMemberApi::verifyEmail($data);
		$msg = $response->message;

		if ($response->status == 'error') {
			$status = false;
		}

		$PageId = get_option('explara_member_account_page');
		$signin_url = get_permalink($PageId) . '?page=signin';

		wp_send_json(['msg' => $msg, 'status' => $status, 'data' => $response, 'signin_url' => $signin_url]);
	}

	private static function getSignupData() {

		$Data = array();

		$Data['name'] = isset($_POST['name']) ? sanitize_text_field($_POST['name']) : NULL;
		$Data['email'] = isset($_POST['email']) ? sanitize_email($_POST['email']) : NULL;
		$Data['phone'] = isset($_POST['phone']) ? sanitize_text_field($_POST['phone']) : NULL;
		$Data['password'] = isset($_POST['password']) ? sanitize_text_field(md5($_POST['password'])) : NULL;

		return $Data;
	}

	private static function getSigninData() {

		$Data = array();

		$Data['email'] = isset($_POST['email']) ? sanitize_email($_POST['email']) : NULL;
		$Data['password'] = isset($_POST['password']) ? sanitize_text_field($_POST['password']) : NULL;

		return $Data;
	}

	public static function checkAuth() {

		$status = true;
		$cookie_access_token = isset($_COOKIE['explara_accesss_token']) ? $_COOKIE['explara_accesss_token'] : null;

		if (empty($cookie_access_token) || $cookie_access_token == null || $cookie_access_token == '') {
			$status = false;
		}

		return $status;
	}

}
?>