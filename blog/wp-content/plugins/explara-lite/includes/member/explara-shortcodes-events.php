<?php
namespace explara;

// Upcoming Events
add_shortcode('explara-events', array('explara\ExplaraShortcodesEvents', 'events'));

class ExplaraShortcodesEvents {

	public static function events($atts) {

		// Get The Attributes
		extract(shortcode_atts(array(
			'type' => 'upcoming',
			'layout' => 'section',
			'view' => 'card',
			'count' => 10,
			'class' => '',
		), $atts));

		$data['atts'] = $atts;

		$layoutType = $atts['layout'];
		$eventsType = $atts['type'];

		if ($layoutType == 'section' && $eventsType == 'upcoming') {

			$file = 'upcoming.php';
			$api_data = ExplaraMemberApi::getEvents('current');

		} elseif ($layoutType == 'section' && $eventsType == 'past') {

			$file = 'past.php';
			$api_data = ExplaraMemberApi::getEvents('past');

		} elseif ($layoutType == 'page' && $eventsType == 'upcoming') {

			$file = 'upcoming-page.php';
			$api_data = ExplaraMemberApi::getEvents('current');

		} elseif ($layoutType == 'page' && $eventsType == 'past') {

			$file = 'past-page.php';
			$api_data = ExplaraMemberApi::getEvents('past');
		}

		$data['events'] = json_decode(json_encode($api_data->events), true);

		return includeShortcodeFile('events/shortcode-events-' . $file, $data);
	}
}
