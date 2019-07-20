<?php
namespace explara;

class ExplaraMemberAdminApi {

	public static function getAllGroups() {

		$groups = self::_callApi('api/publisher/list');

		ExpGroupsDB::deleteGroupList();
		ExpGroupsDB::saveGroupList($groups);

	}

	public static function getSingleGroup($group_id) {

		$api_params = array('groupId' => $group_id);

		$data = self::_callApi('api/publisher/group-details', $api_params);

		return $data;
	}

	public static function getSingleMembers($group_id) {

		$api_params = array('groupId' => $group_id);

		$data = self::_callApi('api/publisher/members', $api_params);

		return $data;
	}

	public static function getSingleSearchMembers($group_id, $keyword) {

		$api_params = array('groupId' => $group_id, 'keyword' => $keyword);

		$data = self::_callApi('api/publisher/members', $api_params);

		return $data;
	}

	public static function getMemberProfileInfo($group_id, $memberId) {

		$api_params = array('groupId' => $group_id, 'memberId' => $memberId);

		$data = self::_callApi('api/publisher/public-profile', $api_params);

		return $data;
	}

	public static function getMemberProfile($group_id) {

		$memberDetails = ExplaraMembershipAccountPost::getAccount();

		$api_params = array('groupId' => $group_id, 'memberId' => $memberDetails->account_id);

		$data = self::_callApi('api/publisher/public-profile', $api_params);

		return $data;
	}

	public static function getGroupMembershipPlanDetails($group_id) {

		$api_params = array('groupId' => $group_id);

		$data = self::_callApi('api/membership/plans', $api_params);

		return $data;
	}

	public static function cartCalculation($api_params) {

		$data = self::_callApi('api/membership/generate-cart', $api_params, 'application/x-www-form-urlencoded');

		return $data;
	}

	public static function generateOrder($api_params) {

		$data = self::_callApi('api/membership/generate-order', $api_params);

		return $data;
	}

	public static function saveAccountForm($api_params) {

		$data = self::_callApi('api/membership/save-buyer', $api_params);

		return $data;
	}

	public static function getAttendeeForm($api_params) {

		$data = self::_callApi('api/membership/membership-form', $api_params);

		return $data;
	}

	public static function saveAttendeeForm($api_params) {

		$data = self::_callApi('api/membership/save-membership-form', $api_params);

		return $data;
	}

	public static function getPaymentLink($api_params) {

		$data = self::_callApi('api/membership/get-payment-link', $api_params);

		return $data;
	}

	private static function _callApi($url, $api_body = array(), $content_type = NULL) {

		$api_data = NULL;

		// Fetch the access token for the current user // TODO
		$access_token = get_option('explara_access_token');

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
			'headers' => $headers,
			'body' => $api_body,
			'cookies' => array(),
		)
		);

		return json_decode(wp_remote_retrieve_body($api_response));
	}
}
?>