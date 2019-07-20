<?php
namespace explara;

class ExpGroupsDB {

	static $groups_table = 'explara_groups';

	public static function saveGroupList($list) {

		global $wpdb;

		$explara_groups = $wpdb->prefix . self::$groups_table;

		foreach ($list->groups as $group) {

			$existing_group = $wpdb->get_row("SELECT id FROM $explara_groups WHERE group_id = '$group->id' ");

			if ($existing_group !== NULL) {

				$Data['group_title'] = $group->name;
				$Data['group_category'] = $group->category;
				$Data['group_segment'] = $group->category;
				$Data['short_desc'] = $group->shortDescription;
				$Data['group_desc'] = $group->textDescription;
				$Data['contact_details'] = $group->contactDetails;
				$Data['header_image'] = $group->headerImage;
				$Data['listing_image'] = $group->listingImage;
				$Data['logo'] = $group->logo;
				$Data['url'] = $group->url;
				$Data['visibility'] = $group->visibility;
				$Data['access_type'] = $group->accessType;
				$Data['status'] = $group->status;
				$Data['list_dump'] = json_encode($group);
				$Data['members'] = json_encode($group->members);

				$wpdb->update($explara_groups, $Data, array('group_id' => $group->id), array('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s'));

				continue;
			}

			$Data['group_id'] = $group->id;
			$Data['group_title'] = $group->name;
			$Data['group_category'] = $group->category;
			$Data['group_segment'] = $group->category;
			$Data['short_desc'] = $group->shortDescription;
			$Data['group_desc'] = $group->textDescription;
			$Data['contact_details'] = $group->contactDetails;
			$Data['header_image'] = $group->headerImage;
			$Data['listing_image'] = $group->listingImage;
			$Data['logo'] = $group->logo;
			$Data['url'] = $group->url;
			$Data['visibility'] = $group->visibility;
			$Data['access_type'] = $group->accessType;
			$Data['is_shown'] = 0;
			$Data['status'] = $group->status;
			$Data['list_dump'] = json_encode($group);
			$Data['members'] = json_encode($group->members);

			$wpdb->insert($explara_groups, $Data);
		}
	}

	public static function deleteGroupList() {
		global $wpdb;
		$explara_groups = $wpdb->prefix . self::$groups_table;

		$wpdb->query("TRUNCATE TABLE $explara_groups");
	}

	public static function saveSingleEvent($group) {

		global $wpdb;
		$explara_groups = $wpdb->prefix . self::$groups_table;

		$wpdb->update($explara_groups,
			array('details_dump' => json_encode($group)),
			array('group_id' => $group->groups->id), "%s", "%s"
		);

		return true;
	}

	public static function getGroup() {

		global $wpdb;
		$explara_groups = $wpdb->prefix . 'explara_groups';

		$query = "SELECT * FROM $explara_groups WHERE is_shown = 1 ";

		$sql_results = $wpdb->get_row($query);

		if (!empty($sql_results)) {
			$sql_results = self::procesGroup($sql_results);
		}

		return $sql_results;
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

		$event->is_expired = memberCheckIfEndDateLessThenToday($event->list_dump->endDate . " " . $event->list_dump->endTime);

		return $event;
	}

	public static function procesGroup($group) {

		$GroupPage = get_option('explara_membership_page');
		$GroupPage = get_permalink($GroupPage);

		$group->complete_link = $GroupPage;

		// TODO: process is required
		return $group;
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
}
