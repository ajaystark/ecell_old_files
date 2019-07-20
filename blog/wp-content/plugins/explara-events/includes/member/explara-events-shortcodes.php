<?php
namespace explara;

add_shortcode('explara-events', array('explara\ExplaraMemberShortcodes', 'events'));
add_shortcode('explara-event', array('explara\ExplaraMemberShortcodes', 'event'));
add_shortcode('explara-event-single', array('explara\ExplaraMemberShortcodes', 'singleEvent'));
add_shortcode('explara-events-list', array('explara\ExplaraMemberShortcodes', 'eventList'));

class ExplaraMemberShortcodes {

	public static function events($atts) {

		ob_start();

		extract(shortcode_atts(array(
			'limit' => get_option('explara_events_shown'),
			'template' => get_option('explara_events_templates'),
		), $atts));

		if (isset($_GET['event_id'])) {

			$event_id = $_GET['event_id'];
			self::getSingleEventTemplate($event_id);

		} else {
			self::getEventsTemplate($limit, $template);
		}

		$event_templates = ob_get_clean();

		return $event_templates;
	}

	public static function event($atts) {

		ob_start();

		extract(shortcode_atts(array(
			'event_id' => null,
			'template' => 'card',
		), $atts));

		if (empty($event_id)) {
			return '';
		}

		self::getSingleEventTemplate($event_id, 'event_id');

		$event_templates = ob_get_clean();
		return $event_templates;
	}

	public static function singleEvent($atts) {

		ob_start();

		extract(shortcode_atts(array(
			'event_id' => null,
			'template' => 'card',
		), $atts));

		if (empty($event_id)) {
			return '';
		}

		self::getSingleEventEmbedTemplate($event_id, $template);

		$event_templates = ob_get_clean();
		return $event_templates;
	}

	public static function eventList($atts) {

		ob_start();

		extract(shortcode_atts(array(
			'event_id' => null,
			'template' => get_option('explara_events_templates'),
		), $atts));

		if (empty($event_id)) {
			return '';
		}

		if (isset($_GET['event_id'])) {

			$event_id = $_GET['event_id'];
			self::getSingleEventTemplate($event_id);

		} else {
			self::getEventsTemplateForSelective($event_id, $template);
		}

		$event_templates = ob_get_clean();
		return $event_templates;
	}

	private static function getEventsTemplate($limit = 10, $template = 'card') {

		// All events from the database
		$events = ExpEventsDB::getEvents(get_option('explara_events_shown', 6));

		$SiginPageId = get_option('explara_member_account_page');
		$signin_url = get_permalink($SiginPageId) . '?page=signin';

		$is_selected = false;

		// The Event List Page Id & Details
		$PageId = get_option('explara_events_page');
		$events_page_url = get_permalink($PageId);

		$file = NULL;

		switch ($template) {

		case 'list':
			$file = 'events-list.php';
			break;

		case 'calendar':

			$calendar_events = ExpEventsDB::getCalendarEvents();

			$file = 'events-calendar.php';
			break;

		case 'card':
		default:
			$file = 'events-card.php';
			break;
		}

		require EXPL_PLUGIN_DIR . '/pages/member/events/' . $file;
	}

	private static function getSingleEventEmbedTemplate($event_id, $template = 'card') {

		$event = ExpEventsDB::getEvent($event_id, 'event_id');
		$event->tickets = ExplaraAdminApi::getEventTickets($event->event_id);

		// The Event List Page Id & Details
		$PageId = get_option('explara_events_page');
		$events_page_url = get_permalink($PageId);

		switch ($template) {

		case 'strip':
			$file = 'single-event-embed-strip.php';
			break;

		case 'card':
		default:
			$file = 'single-event-embed-card.php';
			break;
		}

		require EXPL_PLUGIN_DIR . '/pages/member/events/' . $file;
	}

	private static function getEventsTemplateForSelective($event_ids, $template = 'card') {

		$events = ExpEventsDB::getSelectedEvents($event_ids, get_option('explara_events_shown', 6));

		$is_selected = true;

		// The Event List Page Id & Details
		$PageId = get_option('explara_events_page');
		$events_page_url = get_permalink($PageId);

		$SiginPageId = get_option('explara_member_account_page');
		$signin_url = get_permalink($SiginPageId) . '?page=signin';

		$file = NULL;

		switch ($template) {

		case 'list':
			$file = 'events-list-embed.php';
			break;

		case 'card':
		default:
			$file = 'events-card-embed.php';
			break;
		}

		require EXPL_PLUGIN_DIR . '/pages/member/events/' . $file;
	}

	private static function getSingleEventTemplate($event_id, $column = 'event_display_id') {

		$SiginPageId = get_option('explara_member_account_page');
		$signin_url = get_permalink($SiginPageId) . '?page=signin';

		$event = ExpEventsDB::getEvent($event_id, $column);
		$event->tickets = ExplaraAdminApi::getEventTickets($event->event_id);

		if (!isset($_GET['page'])) {
			return require EXPL_PLUGIN_DIR . '/pages/member/events/single-event.php';
		} else {
			$page = $_GET['page'];
		}

		if (!empty($event->event_session_type)) {

			if ($event->event_session_type == 'ticketing' && $event->type == 'ticketing') {
				$page = 'categories';
			}

			if ($event->event_session_type == 'displayOnly' && $event->type == 'ticketing') {
				$page = 'categories	';
			}

			if (!isset($event->tickets->category)) {
				$page = 'checkout';
			}

			if (isset($event->tickets->category)) {
				$page = 'categories';
			}

			if ($event->event_session_type == 'multiDate') {
				$page = 'multidate';
			}

			if ($event->event_session_type == 'conference') {
				$page = 'conference';
			}
		}

		switch ($page) {

		case 'multidate':
			$file = 'event-multidate-checkout.php';
			break;

		case 'conference':
			$file = 'event-conference-checkout.php';
			break;

		case 'categories':
			$file = 'ticketing-categories-checkout.php';
			break;

		case 'checkout':
			$file = 'event-checkout.php';
			break;

		}
		return require EXPL_PLUGIN_DIR . '/pages/member/events/' . $file;
	}
}
?>