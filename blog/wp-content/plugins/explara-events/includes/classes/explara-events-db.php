<?php
namespace explara;

class ExpEventsDB {

	static $events_table = 'explara_events';

	public static function saveEventList($list) {

		global $wpdb;

		$explara_events = $wpdb->prefix . self::$events_table;

		foreach ($list->events as $event) {

			$existing_event = $wpdb->get_row("SELECT id FROM $explara_events WHERE event_id = '$event->id' ");

			if ($existing_event !== NULL) {

				$Data['event_title'] = $event->eventTitle;
				$Data['event_display_id'] = $event->eventId;
				$Data['list_dump'] = json_encode($event);
				$Data['event_type'] = $event->eventType;
				$Data['event_created_at'] = $event->createdOn;
				$Data['type'] = $event->type;
				$Data['status'] = $event->status;

				$wpdb->update($explara_events, $Data, array('event_id' => $event->id), array('%s', '%s', '%s', '%s', '%s', '%s', '%s'));

				continue;
			}

			$Data['event_id'] = $event->id;
			$Data['event_title'] = $event->eventTitle;
			$Data['event_display_id'] = $event->eventId;
			$Data['event_type'] = $event->eventType;
			$Data['type'] = $event->type;
			$Data['list_dump'] = json_encode($event);
			$Data['event_created_at'] = $event->createdOn;
			$Data['is_shown'] = true;
			$Data['status'] = $event->status;

			$wpdb->insert($explara_events, $Data, array('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s'));
		}
	}

	public static function deleteEventList() {
		global $wpdb;
		$explara_events = $wpdb->prefix . self::$events_table;

		$wpdb->query("TRUNCATE TABLE $explara_events");
	}

	public static function saveSingleEvent($event) {

		global $wpdb;
		$explara_events = $wpdb->prefix . self::$events_table;

		$wpdb->update($explara_events,
			array('details_dump' => json_encode($event)),
			array('event_id' => $event->events->id), "%s", "%s"
		);

		return true;
	}

	public static function saveEventTickets($event_id, $tickets) {

		global $wpdb;
		$explara_events = $wpdb->prefix . self::$events_table;

		$Data['tickets'] = json_encode($tickets);

		$wpdb->update($explara_events, $Data, array('event_id' => $event_id), array('%s'));
	}

	public static function getEvents($limit = false) {

		global $wpdb;
		$explara_events = $wpdb->prefix . 'explara_events';

		$query = "SELECT * FROM $explara_events WHERE is_shown = 1 AND status = 'published' ";

		if ($limit != null) {
			$query .= "LIMIT $limit";
		}

		$sql_results = $wpdb->get_results($query);

		foreach ($sql_results as $key => $event) {
			$sql_results[$key] = self::procesEvent($event);
		}

		return $sql_results;
	}

	public static function getSelectedEvents($event_ids, $limit = false) {

		global $wpdb;
		$explara_events = $wpdb->prefix . 'explara_events';

		$query = "SELECT * FROM $explara_events WHERE event_id IN (" . $event_ids . ") AND is_shown = 1 AND status = 'published' ";

		if ($limit != null) {
			$query .= "LIMIT $limit";
		}

		$sql_results = $wpdb->get_results($query);

		foreach ($sql_results as $key => $event) {
			$sql_results[$key] = self::procesEvent($event);
		}

		return $sql_results;
	}

	public static function getCalendarEvents() {

		$status = true;
		$events = [];
		$calendar_events = [];

		global $wpdb;
		$explara_events = $wpdb->prefix . 'explara_events';

		$query = "SELECT * FROM $explara_events WHERE is_shown = 1 AND status = 'published'";

		$events = $wpdb->get_results($query);

		$PageId = get_option('explara_events_page');
		$events_page_url = get_permalink($PageId);

		foreach ($events as $key => $event) {

			$event->list_dump = json_decode($event->list_dump);

			$innArr['event_id'] = $event->event_id;
			$innArr['url'] = $events_page_url . '?event_id=' . $event->event_display_id;
			$innArr['title'] = $event->event_title;
			$innArr['start'] = $event->list_dump->startDate . ' ' . $event->list_dump->startTime;
			$innArr['end'] = $event->list_dump->endDate . ' ' . $event->list_dump->endTime;

			array_push($calendar_events, $innArr);
		}

		return $calendar_events;
	}

	public static function getEvent($event_display_id, $column = 'event_display_id') {

		global $wpdb;
		$explara_events = $wpdb->prefix . 'explara_events';

		if (empty($event_display_id)) {
			return NULL;
		}

		$query = "SELECT * FROM $explara_events WHERE $column = '$event_display_id' ";

		$sql_results = $wpdb->get_row($query);

		if (!empty($sql_results)) {
			$sql_results = self::procesEvent($sql_results);
		}

		return $sql_results;
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

	public static function procesEvent($event) {

		$PageId = get_option('explara_events_page');
		$events_page_url = get_permalink($PageId);

		$event->list_dump = json_decode($event->list_dump);

		$event->start_fmt_date = date("d M Y", strtotime($event->list_dump->startDate));
		$event->end_fmt_date = date("d M Y", strtotime($event->list_dump->endDate));

		$event->start_fmt_time = date("h:i a", strtotime($event->list_dump->startTime));
		$event->end_fmt_time = date("h:i a", strtotime($event->list_dump->endTime));

		$eventdate = date_create($event->start_fmt_date);
		$event->start_day = date_format($eventdate, "d");
		$event->start_month = date_format($eventdate, "M");

		$event->details_dump = json_decode($event->details_dump);
		$event->tickets = json_decode($event->tickets);

		$event->event_session_type = $event->details_dump->events->eventSessionType;

		$event->complete_link = $events_page_url . '?event_id=' . $event->event_display_id;

		$event->is_expired = checkIfEndDateLessThenToday($event->list_dump->endDate . " " . $event->list_dump->endTime);

		return $event;
	}
}
