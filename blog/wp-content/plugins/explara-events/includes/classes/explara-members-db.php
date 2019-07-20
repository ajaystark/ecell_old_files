<?php
namespace explara;

class ExpMembersDB {

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
}