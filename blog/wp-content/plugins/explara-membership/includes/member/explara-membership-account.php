<?php
namespace explara;

add_action('wp_ajax_explara_group_signup', array('explara\ExplaraMembershipAccountPost', 'signup'));
add_action('wp_ajax_nopriv_explara_group_signup', array('explara\ExplaraMembershipAccountPost', 'signup'));

add_action('wp_ajax_explara_group_signin', array('explara\ExplaraMembershipAccountPost', 'signin'));
add_action('wp_ajax_nopriv_explara_group_signin', array('explara\ExplaraMembershipAccountPost', 'signin'));

add_action('wp_ajax_explara_event_signout', array('explara\ExplaraMembershipAccountPost', 'signout'));
add_action('wp_ajax_nopriv_explara_event_signout', array('explara\ExplaraMembershipAccountPost', 'signout'));

add_action('wp_ajax_explara_membership_forgotpassword_request', array('explara\ExplaraMembershipAccountPost', 'forgotPasswordRequest'));
add_action('wp_ajax_nopriv_explara_membership_forgotpassword_request', array('explara\ExplaraMembershipAccountPost', 'forgotPasswordRequest'));

add_action('wp_ajax_explara_membership_forgotpassword_code', array('explara\ExplaraMembershipAccountPost', 'forgotPasswordSendCode'));
add_action('wp_ajax_nopriv_explara_membership_forgotpassword_code', array('explara\ExplaraMembershipAccountPost', 'forgotPasswordSendCode'));

add_action('wp_ajax_explara_membership_forgotpassword_code_resend', array('explara\ExplaraMembershipAccountPost', 'resendConfiramationCode'));
add_action('wp_ajax_nopriv_explara_membership_forgotpassword_code_resend', array('explara\ExplaraMembershipAccountPost', 'resendConfiramationCode'));

add_action('wp_ajax_explara_group_forgotpassword_reset', array('explara\ExplaraMembershipAccountPost', 'resetPassword'));
add_action('wp_ajax_nopriv_explara_group_forgotpassword_reset', array('explara\ExplaraMembershipAccountPost', 'resetPassword'));

add_action('wp_ajax_explara_signup_code', array('explara\ExplaraMembershipAccountPost', 'verifyEmail'));
add_action('wp_ajax_nopriv_explara_signup_code', array('explara\ExplaraMembershipAccountPost', 'verifyEmail'));

class ExplaraMembershipAccountPost {

	static $members_table = 'explara_members';

	public static function signup() {

		$status = true;

		$data = self::getSignupData();

		$response = ExplaraMemberAuthApi::signUp($data);
		$msg = $response->message;

		if ($response->status == 'error') {
			$status = false;
		} else {

			// Save user details
			ExpMembershipDBClass::saveSignupData($response);
		}

		wp_send_json(['msg' => $msg, 'status' => $status, 'data' => $response]);
	}

	public static function signin() {

		$status = true;
		$PageId = get_option('explara_membership_portal_page');
		$dashboard_url = get_permalink($PageId);

		$data = self::getSigninData();
		$data['password'] = md5($data['password']);

		$response = ExplaraMemberAuthApi::signIn($data);
		$msg = $response->message;

		if ($response->status == 'error') {
			$status = false;
		} else {
			// Save user details
			ExpMembershipDBClass::handelSignData($response);

			// Set the cookie for access token
			$encodedToken = base64_encode($response->accessToken);

			setcookie("explara_accesss_token", $encodedToken, time() + (10 * 365 * 24 * 60 * 60), "/");

		}

		wp_send_json(['msg' => $msg, 'status' => $status, 'dashboard_url' => $dashboard_url, 'response' => $response]);
	}

	public static function signout() {

		$status = true;

		$cookie_access_token = isset($_COOKIE['explara_accesss_token']) ? $_COOKIE['explara_accesss_token'] : null;

		if (empty($cookie_access_token)) {
			$status = false;
		} else {

			$cookie_access_token = base64_decode($cookie_access_token);

			ExpMembershipDBClass::signout($cookie_access_token);
			setcookie('explara_accesss_token', '', time() - 3600, "/");
		}

		$GroupPageId = get_option('explara_membership_page');
		$explara_group_page_url = get_permalink($GroupPageId);

		wp_send_json(['msg' => 'success', 'status' => $status, 'redirect_url' => $explara_group_page_url]);
	}

	public static function forgotPasswordRequest() {

		$status = true;

		$data = $_POST;

		$response = ExplaraMemberAuthApi::forgotPasswordRequest($data);
		$msg = $response->message;

		if ($response->status == 'error') {
			$status = false;
		}

		wp_send_json(['msg' => $msg, 'status' => $status, 'data' => $response]);
	}

	public static function forgotPasswordSendCode() {

		$status = true;

		$data = $_POST;

		$response = ExplaraMemberAuthApi::forgotPasswordSendCode($data);
		$msg = $response->message;

		if ($response->status == 'error') {
			$status = false;
		}

		wp_send_json(['msg' => $msg, 'status' => $status, 'data' => $response]);
	}

	public static function resendConfiramationCode() {

		$status = true;

		$data = $_POST;

		$response = ExplaraMemberAuthApi::resendConfiramationCode($data);
		$msg = $response->message;

		if ($response->status == 'error') {
			$status = false;
		}

		wp_send_json(['msg' => $msg, 'status' => $status, 'data' => $response]);
	}

	public static function resetPassword() {

		$status = true;

		$data = $_POST;
		$data['newPassword'] = md5($data['newPassword']);
		$data['confirmPassword'] = md5($data['confirmPassword']);

		$response = ExplaraMemberAuthApi::resetPassword($data);
		$msg = $response->message;

		if ($response->status == 'error') {
			$status = false;
		}

		$PageId = get_option('explara_membership_account_page');
		$signin_url = get_permalink($PageId) . '?page=signin';

		wp_send_json(['msg' => $msg, 'status' => $status, 'data' => $response, 'signin_url' => $signin_url]);
	}

	public static function verifyEmail() {

		$status = true;

		$data = $_POST;

		$response = ExplaraMemberAuthApi::verifyEmail($data);
		$msg = $response->message;

		if ($response->status == 'error') {
			$status = false;

		} else {
			// Save user details
			ExpMembershipDBClass::saveSigninData($response);
		}

		$PageId = get_option('explara_membership_account_page');
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

	public static function getAccount() {
		global $wpdb;
		$explara_members = $wpdb->prefix . self::$members_table;

		$status = true;
		$cookie_access_token = self::getAccessToken();

		$query = "SELECT * FROM $explara_members WHERE accessToken = '" . $cookie_access_token . "'";

		$sql_results = $wpdb->get_row($query);

		if (empty($sql_results)) {
			return null;
		}

		return $sql_results;
	}

	public static function getMyMembership($group_id) {

		$status = true;
		$cookie_access_token = self::getAccessToken();

		return ExplaraMemberAuthApi::getMyMembership($cookie_access_token, $group_id);
	}

	public static function getMyAllMembership() {
		return ExplaraMemberAuthApi::getMyAllMembership();
	}

	public static function getAccountDetails($response) {

		global $wpdb;
		$explara_members = $wpdb->prefix . self::$members_table;

		$cookie_access_token = isset($_COOKIE['explara_accesss_token']) ? $_COOKIE['explara_accesss_token'] : null;

		if (empty($cookie_access_token) || $cookie_access_token == null || $cookie_access_token == '') {
			return null;
		}

		$accessToken = base64_decode($cookie_access_token);

		$query = "SELECT * FROM $explara_members WHERE accessToken = " . $accessToken;

		$sql_results = $wpdb->get_row($query);

		if (empty($sql_results)) {
			return null;
		}

		return $sql_results;
	}

	public static function getAccessToken() {
		$cookie_access_token = isset($_COOKIE['explara_accesss_token']) ? $_COOKIE['explara_accesss_token'] : null;

		if (empty($cookie_access_token) || $cookie_access_token == null || $cookie_access_token == '') {
			return null;
		}

		return base64_decode($cookie_access_token);
	}

}
?>