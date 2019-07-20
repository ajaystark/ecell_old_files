<?php
namespace explara;

class ExplaraAdminApi {

	public static function getAllEvents() {

		$events = self::_callApi('api/e/get-all-events');

		ExpEventsDB::deleteEventList();
		ExpEventsDB::saveEventList($events);

		foreach ($events->events as $event) {

			self::getSingleEvent($event->id);
		}

	}

	public static function getSingleEvent($event_id) {

		$api_params = array('eventId' => $event_id);

		$data = self::_callApi('api/resource/event-detail', $api_params);

		ExpEventsDB::saveSingleEvent($data);

		return true;
	}

	public static function getEventTickets($event_id) {

		$api_params = array('eventId' => $event_id);

		$data = self::_callApi('api/v3/ticket-details', $api_params);

		return $data;
	}

	public static function cartCalculation($api_params) {

		$data = self::_callApi('api/v3/cart-calculation', $api_params, 'application/x-www-form-urlencoded');

		return $data;
	}

	public static function generateOrder($api_params) {

		$data = self::_callApi('api/v3/generate-order', $api_params);

		return $data;
	}

	public static function getAttendeeForm($api_params) {

		$data = self::_callApi('api/v3/attendee-form', $api_params);

		return $data;
	}

	public static function getRSVPForm($api_params) {

		$data = self::_callApi('api/v3/rsvp-form', $api_params);

		return $data;
	}

	public static function saveRSVPForm($api_params) {

		$data = self::_callApi('api/v3/rsvp', $api_params);

		return $data;
	}

	public static function updateAttendee($api_params) {

		$data = self::_callApi('api/v3/substitute-registration', $api_params);

		return $data;
	}

	public static function getMultiDateDetails($api_params) {

		$data = self::_callApi('api/v3/multisession-dates', $api_params);

		return $data;
	}

	public static function getMultiDateTickets($api_params) {

		$data = self::_callApi('api/v3/multisession-tickets', $api_params);

		return $data;
	}

	public static function getConferenceSession($api_params) {

		$data = self::_callApi('api/v3/conference-dates', $api_params);

		return $data;
	}

	public static function cancelTicket($api_params) {

		$data = self::_callApi('api/v3/cancel-registration', $api_params);

		return $data;
	}

	public static function saveAttendeeForm($api_params) {

		$data = self::_callApi('api/v3/save-attendee', $api_params);

		return $data;
	}

	public static function getPaymentLink($api_params) {

		$data = self::_callApi('api/v3/get-payment-link', $api_params);

		return $data;
	}

	private static function _callApi($url, $api_body = array(), $content_type = NULL) {

		$api_data = NULL;

		// Fetch the access token for the current user // TODO
		$access_token = get_option('explara_access_token');

		$api_url = EXPLARA_API_URL . $url;

		$headers["Authorization"] = "Bearer " . $access_token;

		if ($content_type != NULL) {
			$headers["Content-Type"] = $content_type;
		}

		$api_response = wp_remote_post($api_url, array(
			'method' => 'POST',
			'timeout' => 45,
			'redirection' => 5,
			'httpversion' => '1.0',
			'blocking' => true,
			'headers' => $headers,
			'body' => $api_body,
			'cookies' => array(),
		)
		);

		return json_decode(wp_remote_retrieve_body($api_response));
	}
}
?>