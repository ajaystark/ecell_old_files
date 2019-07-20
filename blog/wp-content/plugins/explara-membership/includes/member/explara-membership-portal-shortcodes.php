<?php
namespace explara;

add_shortcode('explara-membership-portal', array('explara\ExplaraMembershipPortalhortcodes', 'portal'));

class ExplaraMembershipPortalhortcodes {

	public static function portal($atts) {

		ob_start();

		extract(shortcode_atts(array(
			'page' => 'orders',
		), $atts));

		self::getPortalPage($page);

		$portal_templates = ob_get_clean();

		return $portal_templates;
	}

	private static function getPortalPage($page) {

		$file = NULL;

		if (isset($_GET['page']) && !empty($_GET['page'])) {
			$page = $_GET['page'];
		}

		// The Member Account Page Id & Details
		$PageId = get_option('explara_member_portal_page');
		$explara_member_portal_url = get_permalink($PageId);

		// check auth here
		$checkAuth = ExplaraMembershipAccountPost::checkAuth();

		if ($checkAuth == false) {

			$EventsPageId = get_option('explara_events_page');
			$explara_events_page_url = get_permalink($EventsPageId);

			explara_member_redirect($explara_events_page_url);
			exit;
		}

		include_once ABSPATH . 'wp-admin/includes/plugin.php';
		$is_exp_event_active = is_plugin_active('explara-events/explara-events.php');
		$file = 'orders.php';

		$group_orders = ExplaraMembershipAccountPost::getMyAllMembership();
		$group_orders = $group_orders->membership;

		if ($is_exp_event_active) {

			$orders = ExplaraMemberAuthApi::myRegistrations();
			$orders = self::processOrders($orders);
		}

		require_once EXPL_MEMBERSHIP_PLUGIN_DIR . '/pages/member/portal/' . $file;
	}

	private static function processOrders($orders) {

		$PageId = get_option('explara_member_portal_page');
		$explara_member_portal_url = get_permalink($PageId);

		$EventsPageId = get_option('explara_events_page');
		$explara_events_page_url = get_permalink($EventsPageId);

		$all_orders = [];

		foreach ($orders->tickets as $key => $order) {

			$order->details = ExplaraMemberAuthApi::getEventOrders($order->orderNo);

			$order->single_event = ExpGroupsDB::getEvent($order->details->orderDetails->eventId, 'event_id');

			$order->details->orderDetails->datePurchased = date("d M Y", strtotime($order->details->orderDetails->datePurchased));

			$order->substitute_url = $explara_member_portal_url . '?page=substitute&order=' . $order->orderNo . '&ticket=' . $order->ticketNumber;

			$event_display_id = ExpGroupsDB::getEventDisplayIdByEventId($order->details->orderDetails->eventId);

			$order->system_event_url = $explara_events_page_url . '?event_id=' . $event_display_id;

			array_push($all_orders, $order);

		}

		return $all_orders;
	}
}
?>