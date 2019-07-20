<?php
namespace explara;

class ExpMembershipDBClass {

	static $members_table = 'explara_members';

	public static function saveSignupData($response) {

		global $wpdb;

		$explara_members = $wpdb->prefix . self::$members_table;

		// Prepare the Data from the Form Data & Config
		$Data['name'] = $response->firstName;
		$Data['email'] = $response->emailId;
		$Data['account_id'] = $response->accountId;
		$Data['verifyToken'] = $response->accessToken;
		$Data['created_at'] = date('Y-m-d H:i:s');

		return $wpdb->insert($explara_members, $Data, array('%s', '%s', '%s', '%s', '%s'));
	}

	public static function signout($cookie_access_token) {

		global $wpdb;

		$explara_members = $wpdb->prefix . self::$members_table;

		$updateData = [
			'accessToken' => NULL,
		];

		return $wpdb->update($explara_members, $updateData, array('accessToken' => $cookie_access_token));
	}

	public static function saveSigninData($response) {

		global $wpdb;

		$explara_members = $wpdb->prefix . self::$members_table;

		$updateData = [
			'accessToken' => $response->accessToken,
			'profile_dump' => json_encode($response),
		];

		return $wpdb->update($explara_members, $updateData, array('account_id' => $response->account->accountId));
	}

	public static function getEventDisplayIdByEventId($event_id) {

		global $wpdb;
		$explara_events = $wpdb->prefix . 'explara_events';

		if (empty($event_id)) {
			return NULL;
		}

		$query = "SELECT * FROM $explara_events WHERE event_id = '$event_id' ";
		$sql_results = $wpdb->get_row($query);

		if (!empty($sql_results)) {
			return $sql_results->event_display_id;
		}

		return NULL;
	}

	public static function handelSignData($response) {

		global $wpdb;
		$explara_members = $wpdb->prefix . self::$members_table;

		$query = "SELECT * FROM $explara_members WHERE account_id = " . $response->account->accountId;

		$sql_results = $wpdb->get_row($query);

		if (empty($sql_results) && !empty($response)) {
			$Data['name'] = $response->account->firstName;
			$Data['email'] = $response->account->emailId;
			$Data['account_id'] = $response->account->accountId;
			$Data['verifyToken'] = $response->account->accessToken;
			$Data['accessToken'] = $response->account->accessToken;
			$Data['created_at'] = date('Y-m-d H:i:s');

			$wpdb->insert($explara_members, $Data);
		} else {

			$updateData = [
				'accessToken' => $response->accessToken,
				'profile_dump' => json_encode($response),
			];

			$wpdb->update($explara_members, $updateData, array('account_id' => $response->account->accountId));
		}

		return true;
	}
}