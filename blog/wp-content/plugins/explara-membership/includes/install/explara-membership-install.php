<?php

class ExplaraMembership_Install {

	public static function activate() {

		//Function to Setup DB Tables
		self::setupTables();

		// Create necessary pages for the plugin
		self::createPages();

		add_option('explara_membership_version', EXPL_MEMBERSHIP_VERSION);
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

		// Groups Table
		$table_name = $wpdb->prefix . 'explara_groups';

		$sql = "CREATE TABLE $table_name (
                    id mediumint(9) NOT NULL AUTO_INCREMENT,
                    group_id varchar(255) NOT NULL,
                    group_title varchar(255) NOT NULL,
                    group_category varchar(255) DEFAULT NULL,
                    group_segment varchar(255) DEFAULT NULL,
                    contact_details varchar(255) DEFAULT NULL,
                    short_desc mediumtext DEFAULT NULL,
                    group_desc mediumtext DEFAULT NULL,
                    header_image varchar(255) DEFAULT NULL,
                    listing_image varchar(255) DEFAULT NULL,
                    url varchar(1000) DEFAULT NULL,
                    members mediumtext DEFAULT NULL,
                    list_dump mediumtext DEFAULT NULL,
                    group_details mediumtext DEFAULT NULL,
                    logo varchar(255) DEFAULT NULL,
                    visibility varchar(100) DEFAULT NULL,
                    access_type varchar(100) DEFAULT NULL,
                    last_sync timestamp NULL DEFAULT CURRENT_TIMESTAMP,
                    group_created_at timestamp NULL DEFAULT CURRENT_TIMESTAMP,
                    is_shown tinyint(1) DEFAULT 0,
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

		// Groups Table
		$table_name = $wpdb->prefix . 'explara_groups';

		$sql = "DROP TABLE $table_name;";

		$wpdb->query($sql);

		// Members Table
		$table_name = $wpdb->prefix . 'explara_members';

		$sql = "DROP TABLE $table_name;";

		$wpdb->query($sql);
	}

	private static function createPages() {

		if (empty(get_option('explara_membership_page'))) {

			$args = array('post_title' => 'Groups',
				'post_type' => 'page',
				'post_name' => 'membership',
				'post_content' => '[explara-membership]',
				'post_status' => 'publish',
				'comment_status' => 'closed',
				'ping_status' => 'closed',
				'post_author' => 1,
				'menu_order' => 0);

			$PageId = wp_insert_post($args);

			if ($PageId) {
				update_option('explara_membership_page', $PageId);
			}
		}

		if (empty(get_option('explara_membership_account_page'))) {

			$args = array('post_title' => 'Membership Sign In',
				'post_type' => 'page',
				'post_name' => 'membership-portal-account',
				'post_content' => '[explara-membership-account]',
				'post_status' => 'publish',
				'comment_status' => 'closed',
				'ping_status' => 'closed',
				'post_author' => 1,
				'menu_order' => 0);

			$PageId = wp_insert_post($args);

			if ($PageId) {
				update_option('explara_membership_account_page', $PageId);
			}
		}

		if (empty(get_option('explara_membership_portal_page'))) {

			$args = array('post_title' => 'Membership Portal',
				'post_type' => 'page',
				'post_name' => 'membership-portal',
				'post_content' => '[explara-membership-portal]',
				'post_status' => 'publish',
				'comment_status' => 'closed',
				'ping_status' => 'closed',
				'post_author' => 1,
				'menu_order' => 0);

			$PageId = wp_insert_post($args);

			if ($PageId) {
				update_option('explara_membership_portal_page', $PageId);
			}
		}

		if (empty(get_option('explara_membership_payment_page'))) {

			$args = array('post_title' => 'Membership Payment Response',
				'post_type' => 'page',
				'post_name' => 'membership-payment-response',
				'post_content' => '[explara-membership-payment]',
				'post_status' => 'publish',
				'comment_status' => 'closed',
				'ping_status' => 'closed',
				'post_author' => 1,
				'menu_order' => 0);

			$PageId = wp_insert_post($args);

			if ($PageId) {
				update_option('explara_membership_payment_page', $PageId);
			}
		}
	}

	private function deleteOptionEntries() {

		delete_option('explara_access_token');
		delete_option('explara_membership_version');
		delete_option('explara_membership_page');
		delete_option('explara_membership_account_page');
		delete_option('explara_membership_portal_page');
		delete_option('explara_membership_payment_page');
		delete_option('explara_membership_customization');
		delete_option('explara_membership_templates');
		delete_option('explara_membership_shown');

	}
}

?>