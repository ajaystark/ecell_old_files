<?php
namespace explara;

class ExplaraMemberApi {

	public static function getMemberList($groupId, $planId) {

		$data = ['groupId' => $groupId, 'planId' => $planId];

		$members = self::_callApi('cm/api/publisher/members', $data);

		return ($members);
	}

	public static function getMemberListPage($groupId) {

		$data = ['groupId' => $groupId, 'planId' => $planId];

		$members = self::_callApi('cm/api/publisher/members', $data);

		return ($members);
	}

	public static function getEvents($type) {

		$data = ['type' => $type];

		$events = self::_callApi('api/e/get-all-events', $data);

		return $events;
	}

	public static function getGroupDetails($groupId) {

		$data = ['groupId' => $groupId];

		$group = self::_callApi('cm/api/publisher/group-details', $data);

		return $group;

	}

	private static function _callApi($url, $api_body = array(), $content_type = NULL) {

		$api_data = NULL;

		// Fetch the access token for the current user // TODO
		$access_token = get_option('explara_lite_access_token');

		$api_url = EXPLARA_API_URL . $url;

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
