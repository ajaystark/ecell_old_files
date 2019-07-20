<?php
namespace explara;

class ExplaraMemberAuthApi {

	public static function signUp($data) {

		$signUpData = self::_callPublicAuthApi('a/api/oauth/signup', $data);

		// If Sign Up us success, we return the data to

		return $signUpData;
	}

	public static function signIn($data) {

		$signInData = self::_callPublicAuthApi('a/api/oauth/login', $data);

		// If Sign Up us success, we return the data to

		return $signInData;

	}

	public static function verifyEmail($data) {
		$result = self::_callPublicAuthApi('a/api/oauth/verify-email-verification-code', $data);

		return $result;
	}

	public static function forgotPasswordRequest($data) {
		$result = self::_callPublicAuthApi('a/api/oauth/forgot-password', $data);

		return $result;
	}

	public static function forgotPasswordSendCode($data) {
		$result = self::_callPublicAuthApi('a/api/oauth/verify-email-verification-code', $data);

		return $result;
	}

	public static function resendConfiramationCode($data) {
		$result = self::_callPublicAuthApi('a/api/oauth/resent-email-verification-code ', $data);

		return $result;
	}

	public static function resetPassword($data) {
		$result = self::_callPublicAuthApi('a/api/oauth/reset-password-by-access-token', $data);

		return $result;
	}

	public static function profileDetails() {

	}

	public static function myRegistrations() {
		$result = self::_callGetApi('api/v3/my-registration');

		return $result;
	}

	public static function getOrder($orderNo) {

		$api_params = array('orderNo' => $orderNo);
		$result = self::_callApi('api/membership/order-details', $api_params);

		return $result;
	}

	public static function getEventOrders($orderNo) {

		$api_params = array('orderNo' => $orderNo);
		$result = self::_callEventApi('api/v3/order-details', $api_params);

		return $result;
	}

	public static function getAllDiscussion($params) {

		$result = self::_callApi('api/discussion/posts', $params);

		return $result;
	}

	public static function getAllComments($params) {

		$result = self::_callApi('api/discussion/comments', $params);

		return $result;
	}

	public static function postDiscussion($params) {

		$result = self::_callApi('api/discussion/save', $params);

		return $result;
	}

	public static function getMyMembership($cookie_access_token, $group_id) {

		$api_params = array('groupId' => $group_id);
		$result = self::_callApi('api/publisher/my-membership', $api_params);

		return $result;
	}

	public static function getMyAllMembership() {

		$result = self::_callApi('api/publisher/my-membership');

		return $result;
	}

	private static function _callApi($url, $api_body = array(), $content_type = NULL) {

		$api_data = NULL;

		// Fetch the access token for the current user // TODO
		$encoaded_access_token = isset($_COOKIE['explara_accesss_token']) ? $_COOKIE['explara_accesss_token'] : null;
		$access_token = base64_decode($encoaded_access_token);

		$api_url = EXPLARA_MEMBER_API_URL . $url;

		$headers["Authorization"] = "Bearer " . $access_token;

		if ($content_type != NULL) {
			$headers["Content-Type"] = $content_type;
		}

		$api_response = wp_remote_post($api_url, array(
			'method' => 'POST',
			'timeout' => 45,
			'redirection' => 5,
			'httpversion' => '1.0',
			'blocking' => true,
			'body' => $api_body,
			'headers' => $headers,
			'cookies' => array(),
		)
		);

		// TODO error handeling
		// get the API URL
		// get the Access Token
		// Prepare the API
		// Call the API
		// Return the result

		//var_dump(json_decode(wp_remote_retrieve_body($api_response)));

		return json_decode(wp_remote_retrieve_body($api_response));
	}

	private static function _callEventApi($url, $api_body = array(), $content_type = NULL) {

		$api_data = NULL;

		// Fetch the access token for the current user // TODO
		$encoaded_access_token = isset($_COOKIE['explara_accesss_token']) ? $_COOKIE['explara_accesss_token'] : null;
		$access_token = base64_decode($encoaded_access_token);

		$api_url = EXPLARA_MEMBER_MAIN_API_URL . $url;

		$headers["Authorization"] = "Bearer " . $access_token;

		if ($content_type != NULL) {
			$headers["Content-Type"] = $content_type;
		}

		$api_response = wp_remote_post($api_url, array(
			'method' => 'POST',
			'timeout' => 45,
			'redirection' => 5,
			'httpversion' => '1.0',
			'blocking' => true,
			'body' => $api_body,
			'headers' => $headers,
			'cookies' => array(),
		)
		);
		return json_decode(wp_remote_retrieve_body($api_response));
	}

	private static function _callGetApi($url) {

		$api_data = NULL;

		$encoaded_access_token = $_COOKIE['explara_accesss_token'];
		$access_token = base64_decode($encoaded_access_token);

		$api_url = EXPLARA_MEMBER_MAIN_API_URL . $url;

		$headers["Authorization"] = "Bearer " . $access_token;

		$api_response = wp_remote_get($api_url, array(
			'timeout' => 45,
			'headers' => $headers,
		)
		);

		return json_decode(wp_remote_retrieve_body($api_response));
	}

	private static function _callPublicApi($url, $api_body = array()) {

		$api_data = NULL;

		$api_url = EXPLARA_MEMBER_API_URL . $url;

		$api_response = wp_remote_post($api_url, array(
			'method' => 'POST',
			'timeout' => 45,
			'redirection' => 5,
			'httpversion' => '1.0',
			'blocking' => true,
			'body' => $api_body,
			'cookies' => array(),
		)
		);

		return json_decode(wp_remote_retrieve_body($api_response));
	}

	private static function _callPublicAuthApi($url, $api_body = array()) {

		$api_data = NULL;

		$api_url = EXPLARA_MEMBER_MAIN_API_URL . $url;

		$api_response = wp_remote_post($api_url, array(
			'method' => 'POST',
			'timeout' => 45,
			'redirection' => 5,
			'httpversion' => '1.0',
			'blocking' => true,
			'body' => $api_body,
			'cookies' => array(),
		)
		);

		return json_decode(wp_remote_retrieve_body($api_response));
	}
}
?>