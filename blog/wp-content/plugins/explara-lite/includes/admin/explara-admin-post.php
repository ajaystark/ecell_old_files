<?php
namespace explara;

// Action hook for AJAX Request
add_action('wp_ajax_page_add_token', array('explara\ExpPost', 'saveToken'));
add_action('wp_ajax_page_add_domain', array('explara\ExpPost', 'saveDomain'));

add_action('wp_ajax_page_shortcode_events', array('explara\ExpPost', 'generateShortcodeEvents'));
add_action('wp_ajax_page_shortcode_group', array('explara\ExpPost', 'generateShortcodeGroup'));
add_action('wp_ajax_get_memberships_type', array('explara\ExpPost', 'getMembershipsType'));

class ExpPost {

	public static function getMembershipsType() {

		$groupId = $_POST['groupId'];

		$membershipTypes = ExplaraAdminApi::getAllMembershipTypes($groupId);

		wp_send_json(['msg' => "Success", 'types' => $membershipTypes, 'status' => true]);
	}

	public static function saveToken() {

		$msg = "Access token saved successfully.";

		$token = trim(sanitize_text_field($_POST['token_value']));

		if (empty($token)) {
			wp_send_json(['msg' => "Token cannot be empty", 'status' => false]);
		}

		addUpdateOption('explara_lite_access_token', $token);

		wp_send_json(['msg' => $msg, 'status' => true]);
	}

	public static function saveDomain() {

		$msg = "Successfully saved your Domain Details";
		$status = true;

		$domain = trim(sanitize_text_field($_POST['domain_value']));

		if (empty($domain)) {
			wp_send_json(['msg' => "Domain cannot be empty", 'status' => false]);
		}

		$option_name = 'explara_lite_subdomain';

		addUpdateOption($option_name, $domain);

		wp_send_json(['msg' => $msg, 'status' => $status]);
	}

	public static function generateShortcodeEvents() {

		$msg = "Shortcode Generated";
		$status = true;

		$shortcode = ShortcodeGenerator::eventShortcode();

		wp_send_json(['msg' => $msg, 'shortcode' => $shortcode, 'status' => $status]);
	}

	public static function generateShortcodeGroup() {

		$msg = "Shortcode Generated";
		$status = true;

		$shortcode = ShortcodeGenerator::groupShortcode();

		wp_send_json(['msg' => $msg, 'shortcode' => $shortcode, 'status' => $status]);
	}

}
