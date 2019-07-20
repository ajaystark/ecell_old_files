<?php
namespace explara;

add_action('wp_ajax_explara_events_list_ajax', array('explara\ExplaraMemberEvents', 'getEvents'));
add_action('wp_ajax_nopriv_explara_events_list_ajax', array('explara\ExplaraMemberEvents', 'getEvents'));

add_action('wp_ajax_explara_events_calendar', array('explara\ExplaraMemberEvents', 'getCalendarEvents'));
add_action('wp_ajax_nopriv_explara_events_calendar', array('explara\ExplaraMemberEvents', 'getCalendarEvents'));

class ExplaraMemberEvents {

	public static function getEvents() {

		$status = true;
		$events = [];

		$limit = get_option('explara_events_shown', 6);
		$start = isset($_POST['start_pointer']) ? $_POST['start_pointer'] : 0;

		$start = (int) $start;

		global $wpdb;
		$explara_events = $wpdb->prefix . 'explara_events';

		$query = "SELECT * FROM $explara_events WHERE is_shown = 1 AND status = 'published' LIMIT $start, $limit ";

		$events = $wpdb->get_results($query);

		foreach ($events as $key => $event) {
			$events[$key] = ExpEventsDB::procesEvent($event);
		}

		wp_send_json(['status' => $status, 'events' => $events, 'limit' => $limit]);
	}

	public static function getCalendarEvents() {

		$status = true;
		$events = [];

		global $wpdb;
		$explara_events = $wpdb->prefix . 'explara_events';

		$query = "SELECT * FROM $explara_events WHERE is_shown = 1 AND status = 'published'";

		$events = $wpdb->get_results($query);

		foreach ($events as $key => $event) {
			$events[$key] = ExpEventsDB::procesEvent($event);
		}

		$events = self::processEventsForListing($events);

		wp_send_json(['status' => $status, 'events' => $events]);
	}

	public function processEventsForListing($events) {
		foreach ($events as $event) {

			if ($event->details_dump->events->type != 'rsvp') {
				if (isset($event->details_dump->events->price) && !empty($event->details_dump->events->price)) {
					$event->details_dump->events->price;
				} elseif ($event->details_dump->events->price == '0') {
					$event->details_dump->events->price = 'Free';
				} else {
					$event->details_dump->events->price = 'Event Expired';
				}
			}

		}
	}
}