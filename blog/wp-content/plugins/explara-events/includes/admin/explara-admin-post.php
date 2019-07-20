<?php
namespace explara;

// Action hook for AJAX Request
add_action('wp_ajax_page_add_token', array('explara\ExpPost', 'saveToken'));
add_action('wp_ajax_page_add_customization', array('explara\ExpPost', 'saveCustomization'));
add_action('wp_ajax_page_template_post', array('explara\ExpPost', 'saveTemplate'));
add_action('wp_ajax_page_events_shown', array('explara\ExpPost', 'saveEventShown'));

add_action('wp_ajax_page_toggle_event', array('explara\ExpPost', 'toggleEvent'));
add_action('wp_ajax_page_toggle_events_bulk', array('explara\ExpPost', 'toggleBulkEvents'));
add_action('wp_ajax_page_fetch_sync_events', array('explara\ExpPost', 'fetchAndSync'));
add_action('wp_ajax_page_single_event_fetch_sync', array('explara\ExpPost', 'singleEventFetchAndSync'));

add_action('wp_ajax_explara_setting_pages', array('explara\ExpPost', 'savePages'));

class ExpPost {

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

		$option_name = 'explara_events_customization';

		$new_value = self::GetCustomizationData();

		self::addUpdateOption($option_name, serialize($new_value));

		wp_send_json(['msg' => $msg, 'status' => $status]);
	}

	public static function savePages() {

		$msg = "Successfully saved";
		$status = true;

		$member_account = sanitize_text_field($_POST['member_account']);
		$member_portal = sanitize_text_field($_POST['member_portal']);
		$member_event = sanitize_text_field($_POST['member_event']);
		$member_payment = sanitize_text_field($_POST['member_payment']);

		self::addUpdateOption('explara_member_account_page', $member_account);
		self::addUpdateOption('explara_member_portal_page', $member_portal);
		self::addUpdateOption('explara_events_page', $member_event);
		self::addUpdateOption('explara_member_payment_page', $member_payment);

		wp_send_json(['msg' => $msg, 'status' => $status]);
	}

	public static function saveTemplate() {

		$msg = "Successfully saved";
		$status = true;
		$new_value = '';

		$option_name = 'explara_events_templates';

		if (isset($_POST['template_name']) && !empty($_POST['template_name'])) {
			$new_value = trim(sanitize_text_field($_POST['template_name']));
		}

		self::addUpdateOption($option_name, $new_value);

		wp_send_json(['msg' => $msg, 'status' => $status]);
	}

	public static function saveEventShown() {

		$msg = "Successfully saved";
		$status = true;
		$new_value = '';

		$option_name = 'explara_events_shown';

		if (isset($_POST['event_shown']) && !empty($_POST['event_shown'])) {
			$new_value = trim(sanitize_text_field($_POST['event_shown']));
		}

		self::addUpdateOption($option_name, $new_value);

		wp_send_json(['msg' => $msg, 'status' => $status]);
	}

	public static function toggleEvent() {

		$msg = "Successfully updated";
		$status = true;

		self::updateEventIsShown();

		wp_send_json(['msg' => $msg, 'status' => $status]);
	}

	public static function toggleBulkEvents() {

		$msg = "Successfully updated";
		$status = true;

		$event_ids = $_POST['event_ids'];
		$action_type = sanitize_text_field($_POST['action_type']);

		foreach ($event_ids as $event_id) {
			self::updateEventIsShownById($event_id, $action_type);
		}

		wp_send_json(['msg' => $msg, 'status' => $status]);
	}

	public function fetchAndSync() {

		ExplaraAdminApi::getAllEvents();

		wp_send_json(['msg' => 'success', 'status' => true]);
	}

	public function singleEventFetchAndSync() {

		$event_id = AdminEvents::getEventIdByDisplayId(sanitize_text_field($_POST['event_display_id']));

		if (empty($event_id)) {
			return false;
		}

		ExplaraAdminApi::getSingleEvent($event_id);

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

	private function updateEventIsShown() {
		global $wpdb;

		$table_prefix = $wpdb->prefix;
		$explara_events = $table_prefix . 'explara_events';
		$ID = sanitize_text_field($_POST['event_id']);

		$existing_event = $wpdb->get_row("SELECT id, is_shown FROM $explara_events WHERE id = $ID");

		if ($existing_event !== NULL) {

			$db_is_shown = (int) $existing_event->is_shown;
			$is_shown = $db_is_shown === 1 ? 0 : 1;

			$wpdb->update($explara_events, array('is_shown' => $is_shown), array('id' => $ID));
		}
	}

	private function updateEventIsShownById($ID, $action_type) {
		global $wpdb;

		$table_prefix = $wpdb->prefix;
		$explara_events = $table_prefix . 'explara_events';

		if ($action_type == 'show') {
			$is_shown = 1;
		} else {
			$is_shown = 0;
		}

		$wpdb->update($explara_events, array('is_shown' => $is_shown), array('id' => $ID));
	}
}