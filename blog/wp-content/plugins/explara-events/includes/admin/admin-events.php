<?php
namespace explara;

class AdminEvents {

	public static function getAllEvents($orderby, $order) {

		global $wpdb;
		$explara_events = $wpdb->prefix . 'explara_events';

		$query = "SELECT * FROM $explara_events";

		if (isset($_GET['status'])) {
			$status = $_GET['status'];
			$query .= " WHERE status = '$status' ";
		}

		if (isset($_GET['s'])) {
			$keyword = $_GET['s'];
			$query .= " WHERE event_title LIKE '%$keyword%' ";
		}

		if (isset($_GET['orderby'])) {
			$query .= " ORDER BY $orderby $order";
		}

		$sql_results = $wpdb->get_results($query);

		return $sql_results;

	}

	public static function getListEvents() {

		global $wpdb;
		$explara_events = $wpdb->prefix . 'explara_events';

		$query = "SELECT id, event_id, event_title FROM $explara_events";
		$sql_results = $wpdb->get_results($query);

		return $sql_results;
	}

	public static function getListShownEvents() {

		global $wpdb;
		$explara_events = $wpdb->prefix . 'explara_events';

		$query = "SELECT id, event_id, event_title FROM $explara_events  WHERE is_shown = 1 AND status = 'published' ";
		$sql_results = $wpdb->get_results($query);

		return $sql_results;

	}

	public static function getSingleEvent() {

		global $wpdb;
		$explara_events = $wpdb->prefix . 'explara_events';

		$event_id = isset($_GET['event_id']) ? $_GET['event_id'] : NULL;

		if (empty($event_id)) {
			return NULL;
		}

		$query = "SELECT * FROM $explara_events WHERE event_display_id = '$event_id' ";
		$sql_results = $wpdb->get_row($query);

		if (!empty($sql_results)) {

			$sql_results = ExpEventsDB::procesEvent($sql_results);
		}

		return $sql_results;
	}

	public static function getEventIdByDisplayId($event_display_id) {

		global $wpdb;
		$explara_events = $wpdb->prefix . 'explara_events';

		if (empty($event_display_id)) {
			return NULL;
		}

		$query = "SELECT * FROM $explara_events WHERE event_display_id = '$event_display_id' ";
		$sql_results = $wpdb->get_row($query);

		if (!empty($sql_results)) {
			return $sql_results->event_id;
		}

		return NULL;
	}
}
?>