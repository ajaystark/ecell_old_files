<?php
namespace explara;

// Action hook for AJAX Request
add_action('wp_ajax_page_membership_add_token', array('explara\ExpGroupPost', 'saveToken'));
add_action('wp_ajax_page_exp_member_add_customization', array('explara\ExpGroupPost', 'saveCustomization'));

add_action('wp_ajax_page_exp_membership_toggle_group', array('explara\ExpGroupPost', 'setToDefault'));
add_action('wp_ajax_page_fetch_sync_groups', array('explara\ExpGroupPost', 'fetchAndSync'));
add_action('wp_ajax_page_single_group_fetch_sync', array('explara\ExpGroupPost', 'singleGroupFetchAndSync'));
add_action('wp_ajax_explara_membership_setting_pages', array('explara\ExpGroupPost', 'savePages'));

class ExpGroupPost {

	public static function saveToken() {

		$msg = "Access token saved successfully.";

		$token = trim(sanitize_text_field($_POST['token_value']));

		if (empty($token)) {
			wp_send_json(['msg' => "Token cannot be empty", 'status' => false]);
		}

		update_option('explara_access_token', $token);

		wp_send_json(['msg' => $msg, 'status' => true]);
	}

	public static function saveCustomization() {

		$msg = "Successfully saved your customization";
		$status = true;

		$option_name = 'explara_membership_customization';

		$new_value = self::GetCustomizationData();

		self::addUpdateOption($option_name, serialize($new_value));

		wp_send_json(['msg' => $msg, 'status' => $status]);
	}

	public static function savePages() {

		$msg = "Successfully saved";
		$status = true;

		$explara_membership_account_page = sanitize_text_field($_POST['explara_membership_account_page']);
		$explara_membership_portal_page = sanitize_text_field($_POST['explara_membership_portal_page']);
		$explara_membership_page = sanitize_text_field($_POST['explara_membership_page']);
		$explara_membership_payment_page = sanitize_text_field($_POST['explara_membership_payment_page']);

		self::addUpdateOption('explara_membership_account_page', $explara_membership_account_page);
		self::addUpdateOption('explara_membership_portal_page', $explara_membership_portal_page);
		self::addUpdateOption('explara_membership_page', $explara_membership_page);
		self::addUpdateOption('explara_membership_payment_page', $explara_membership_payment_page);

		wp_send_json(['msg' => $msg, 'status' => $status]);
	}

	public function setToDefault() {
		global $wpdb;

		$table_prefix = $wpdb->prefix;
		$explara_groups = $table_prefix . 'explara_groups';
		$ID = sanitize_text_field($_POST['group_id']);

		$existing_event = $wpdb->get_row("SELECT id, is_shown FROM $explara_groups WHERE id = $ID");

		if ($existing_event !== NULL) {

			// reset all
			$wpdb->query("UPDATE $explara_groups SET is_shown = 0 WHERE 1");

			$is_shown = 1;
			$wpdb->update($explara_groups, array('is_shown' => $is_shown), array('id' => $ID));
		}
	}

	public function fetchAndSync() {
		ExplaraMemberAdminApi::getAllGroups();

		wp_send_json(['msg' => 'success', 'status' => true]);
	}

	public function singleGroupFetchAndSync() {

		$group_id = AdminGroups::getEventIdByDisplayId(sanitize_text_field($_POST['event_display_id']));

		if (empty($group_id)) {
			return false;
		}

		ExplaraMemberAdminApi::getSingleEvent($group_id);

		wp_send_json(['msg' => 'success', 'status' => true]);
	}

	private function addUpdateOption($option_name, $new_value) {

		if (get_option($option_name) !== false) {

			// The option already exists, so we just update it.
			update_option($option_name, $new_value);

		} else {

			// The option hasn't been added yet. We'll add it with $autoload set to 'no'.
			$deprecated = null;
			$autoload = 'no';
			add_option($option_name, $new_value, $deprecated, $autoload);
		}

		return true;
	}

	private function GetCustomizationData() {

		$new_value = [
			'card_data' => [],
			'font_data' => [],
			'button_data' => [],
		];

		$new_value['card_data']['card_title_color'] = isset($_POST['card_title_color']) ? sanitize_text_field($_POST['card_title_color']) : NULL;

		$new_value['card_data']['card_description_color'] = isset($_POST['card_description_color']) ? sanitize_text_field($_POST['card_description_color']) : NULL;

		$new_value['font_data']['font_family'] = isset($_POST['font_family']) ? sanitize_text_field($_POST['font_family']) : NULL;

		$new_value['font_data']['font_style'] = isset($_POST['font_style']) ? sanitize_text_field($_POST['font_style']) : NULL;

		$new_value['button_data']['button_background_color'] = isset($_POST['button_background_color']) ? sanitize_text_field($_POST['button_background_color']) : NULL;

		$new_value['button_data']['button_color'] = isset($_POST['button_color']) ? sanitize_text_field($_POST['button_color']) : NULL;

		return $new_value;
	}
}