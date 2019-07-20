<?php
namespace explara;

class ExplaraAdminApi {

	public static function getAllMembershipTypes($groupId) {

		$data = ['groupId' => $groupId];

		$api_data = self::_callApi('cm/api/membership/plans', $data);

		return json_decode(json_encode($api_data->plans), true);
	}

	public static function getAllGroups() {

		$api_data = self::_callApi('cm/api/publisher/list');

		return json_decode(json_encode($api_data->groups), true);
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
