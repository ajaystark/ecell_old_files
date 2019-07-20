<?php

class ExplaraEvents_Install {

	public static function activate() {

		//Function to Setup DB Tables
		self::setupTables();

		// Create necessary pages for the plugin
		self::createPages();

		add_option('explara_events_version', EXPL_EVENTS_VERSION);
	}

	public static function deactivate() {
		return true;
	}

	public static function delete() {

		// Delete tables
		self::deleteTables();

		self::deleteOptionEntries();
	}

	private static function setupTables() {
		global $wpdb;

		require_once ABSPATH . 'wp-admin/includes/upgrade.php';

		$charset_collate = $wpdb->get_charset_collate();

		// Events Table
		$table_name = $wpdb->prefix . 'explara_events';

		$sql = "CREATE TABLE $table_name (
                    id mediumint(9) NOT NULL AUTO_INCREMENT,
                    event_id varchar(255) NOT NULL,
                    event_title varchar(255) NOT NULL,
                    event_display_id varchar(255) DEFAULT NULL,
                    event_type varchar(255) DEFAULT NULL,
                    type varchar(255) DEFAULT NULL,
                    list_dump mediumtext DEFAULT NULL,
                    details_dump mediumtext DEFAULT NULL,
                    tickets mediumtext DEFAULT NULL,
                    last_sync timestamp NULL DEFAULT CURRENT_TIMESTAMP,
                    event_created_at timestamp NULL DEFAULT CURRENT_TIMESTAMP,
                    is_shown tinyint(1) DEFAULT NULL,
                    status varchar(50) NOT NULL,
                    PRIMARY KEY  (id)
                ) $charset_collate;";

		dbDelta($sql);

		// Members Table
		$table_name = $wpdb->prefix . 'explara_members';

		$sql = "CREATE TABLE $table_name (
                    id mediumint(9) NOT NULL AUTO_INCREMENT,
                    account_id mediumint(9) NOT NULL,
                    name varchar(255) DEFAULT NULL,
                    email varchar(255) DEFAULT NULL,
                    accessToken varchar(255) DEFAULT NULL,
                    verifyToken varchar(255) DEFAULT NULL,
                    profile_dump mediumtext DEFAULT NULL,
                    created_at timestamp NULL DEFAULT CURRENT_TIMESTAMP,
                    PRIMARY KEY  (id)
                ) $charset_collate;";

		dbDelta($sql);
	}

	private static function deleteTables() {
		global $wpdb;

		// Events Table
		$table_name = $wpdb->prefix . 'explara_events';

		$sql = "DROP TABLE $table_name;";

		$wpdb->query($sql);

		// Members Table
		$table_name = $wpdb->prefix . 'explara_members';

		$sql = "DROP TABLE $table_name;";

		$wpdb->query($sql);
	}

	private static function createPages() {

		if (empty(get_option('explara_events_page'))) {

			$args = array('post_title' => 'Events',
				'post_type' => 'page',
				'post_name' => 'events',
				'post_content' => '[explara-events]',
				'post_status' => 'publish',
				'comment_status' => 'closed',
				'ping_status' => 'closed',
				'post_author' => 1,
				'menu_order' => 0);

			$PageId = wp_insert_post($args);

			if ($PageId) {
				update_option('explara_events_page', $PageId);
			}
		}

		if (empty(get_option('explara_member_account_page'))) {

			$args = array('post_title' => 'Member Sign In',
				'post_type' => 'page',
				'post_name' => 'member-portal-account',
				'post_content' => '[explara-account]',
				'post_status' => 'publish',
				'comment_status' => 'closed',
				'ping_status' => 'closed',
				'post_author' => 1,
				'menu_order' => 0);

			$PageId = wp_insert_post($args);

			if ($PageId) {
				update_option('explara_member_account_page', $PageId);
			}
		}

		if (empty(get_option('explara_member_portal_page'))) {

			$args = array('post_title' => 'Member Portal',
				'post_type' => 'page',
				'post_name' => 'member-portal',
				'post_content' => '[explara-portal]',
				'post_status' => 'publish',
				'comment_status' => 'closed',
				'ping_status' => 'closed',
				'post_author' => 1,
				'menu_order' => 0);

			$PageId = wp_insert_post($args);

			if ($PageId) {
				update_option('explara_member_portal_page', $PageId);
			}
		}

		if (empty(get_option('explara_member_payment_page'))) {

			$args = array('post_title' => 'Payment Response',
				'post_type' => 'page',
				'post_name' => 'payment-response',
				'post_content' => '[explara-payment]',
				'post_status' => 'publish',
				'comment_status' => 'closed',
				'ping_status' => 'closed',
				'post_author' => 1,
				'menu_order' => 0);

			$PageId = wp_insert_post($args);

			if ($PageId) {
				update_option('explara_member_payment_page', $PageId);
			}
		}
	}

	private function deleteOptionEntries() {

		delete_option('explara_access_token');
		delete_option('explara_events_version');
		delete_option('explara_events_page');
		delete_option('explara_member_account_page');
		delete_option('explara_member_portal_page');
		delete_option('explara_member_payment_page');
		delete_option('explara_events_customization');
		delete_option('explara_events_templates');
		delete_option('explara_events_shown');

	}
}

?>