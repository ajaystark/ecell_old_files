<?php
namespace explara;

add_action('wp_ajax_page_explara_cart', array('explara\ExplaraMemberCheckout', 'cartCalculation'));
add_action('wp_ajax_nopriv_page_explara_cart', array('explara\ExplaraMemberCheckout', 'cartCalculation'));

add_action('wp_ajax_page_explara_checkout', array('explara\ExplaraMemberCheckout', 'generateOrder'));
add_action('wp_ajax_nopriv_page_explara_checkout', array('explara\ExplaraMemberCheckout', 'generateOrder'));

add_action('wp_ajax_page_explara_attendee_form', array('explara\ExplaraMemberCheckout', 'getAttendeeForm'));
add_action('wp_ajax_nopriv_page_explara_attendee_form', array('explara\ExplaraMemberCheckout', 'getAttendeeForm'));

add_action('wp_ajax_page_explara_attendee_form_save', array('explara\ExplaraMemberCheckout', 'saveAttendeeForm'));
add_action('wp_ajax_nopriv_page_explara_attendee_form_save', array('explara\ExplaraMemberCheckout', 'saveAttendeeForm'));

add_action('wp_ajax_page_explara_rsvp_form', array('explara\ExplaraMemberCheckout', 'getRSVPForm'));
add_action('wp_ajax_nopriv_page_explara_rsvp_form', array('explara\ExplaraMemberCheckout', 'getRSVPForm'));

add_action('wp_ajax_page_explara_rsvp_form_save', array('explara\ExplaraMemberCheckout', 'saveRSVPForm'));
add_action('wp_ajax_nopriv_page_explara_rsvp_form_save', array('explara\ExplaraMemberCheckout', 'saveRSVPForm'));

add_action('wp_ajax_explara_attendee_update', array('explara\ExplaraMemberCheckout', 'updateAttendee'));
add_action('wp_ajax_nopriv_explara_attendee_update', array('explara\ExplaraMemberCheckout', 'updateAttendee'));

add_action('wp_ajax_explara_get_multidate_data', array('explara\ExplaraMemberCheckout', 'getMultiDateDetails'));
add_action('wp_ajax_nopriv_explara_get_multidate_data', array('explara\ExplaraMemberCheckout', 'getMultiDateDetails'));

add_action('wp_ajax_explara_page_get_config', array('explara\ExplaraMemberCheckout', 'getConfig'));
add_action('wp_ajax_nopriv_explara_page_get_config', array('explara\ExplaraMemberCheckout', 'getConfig'));

add_action('wp_ajax_page_explara_upload_form', array('explara\ExplaraMemberCheckout', 'uploadFile'));
add_action('wp_ajax_nopriv_page_explara_upload_form', array('explara\ExplaraMemberCheckout', 'uploadFile'));

class ExplaraMemberCheckout {

	public static function uploadFile() {

		if (!function_exists('wp_handle_upload')) {
			require_once ABSPATH . 'wp-admin/includes/file.php';
		}

		$uploadedfile = $_FILES;

		if (empty($_FILES['src'])) {
			wp_send_json(['status' => false, 'data' => $filename]);
		}

		$extension = end(explode(".", $_FILES['src']['name']));

		if ($extension == 'exe' || $extension == 'EXT' || $extension == 'Exe' || $extension == 'exE') {
			wp_send_json(['file' => false, 'status' => false, 'data' => 'You can not upload .exe file']);
		}

		$upload_overrides = array('test_form' => false);
		$uploaded_file = wp_handle_upload($_FILES['src'], $upload_overrides);

		if ($uploaded_file && !isset($uploaded_file['error'])) {
			wp_send_json(['status' => true, 'data' => $uploaded_file['url']]);
		} else {
			wp_send_json(['status' => false, 'data' => $filename]);
		}
	}

	public static function getConfig() {

		$status = true;

		$data['ApiUrl'] = EXPLARA_API_URL;
		$data['ticketRecipietUrl'] = EXPLARA_API_URL . 'em/ticket/confirmation/receipt/order/';

		wp_send_json(['status' => $status, 'data' => $data]);
	}

	public static function cartCalculation() {

		$status = true;
		$postData = json_encode($_POST);

		$data = ExplaraAdminApi::cartCalculation($postData);

		wp_send_json(['status' => $status, 'data' => $data]);
	}

	public static function generateOrder() {

		$status = true;
		$postData = json_encode($_POST);

		$data = ExplaraAdminApi::generateOrder($postData);

		if (isset($data->status) && $data->status == 'success') {

			if (isset($_POST['to_payment']) && $_POST['to_payment'] == 'yes') {

				$PageId = get_option('explara_member_payment_page');
				$member_payment_page_url = get_permalink($PageId);

				$paymentLinkData['orderNo'] = sanitize_text_field($data->orderNo);

				$paymentLinkData['returnUrl'] = $member_payment_page_url . "?page=success&order=" . $paymentLinkData['orderNo'];
				$paymentLinkData['cancelUrl'] = $member_payment_page_url . "?page=cancel&order=" . $paymentLinkData['orderNo'];
				$paymentLinkData['pendingUrl'] = $member_payment_page_url . "?page=pending&order=" . $paymentLinkData['orderNo'];

				$data = ExplaraAdminApi::getPaymentLink($paymentLinkData);

			}
		}

		wp_send_json(['status' => $status, 'data' => $data]);
	}

	public static function getAttendeeForm() {

		$status = true;
		$postData = ($_POST);

		$data = ExplaraAdminApi::getAttendeeForm($postData);
		$data->form = self::getAttendeeFormHTML($data);

		wp_send_json(['status' => $status, 'data' => $data]);
	}

	public static function saveAttendeeForm() {

		$status = true;
		$postData = json_encode($_POST);

		$data = ExplaraAdminApi::saveAttendeeForm($postData);

		if (isset($data->success) && $data->success == 'success') {

			$PageId = get_option('explara_member_payment_page');
			$member_payment_page_url = get_permalink($PageId);

			$paymentLinkData['orderNo'] = sanitize_text_field($_POST['orderNo']);

			$paymentLinkData['returnUrl'] = $member_payment_page_url . "?page=success&order=" . $paymentLinkData['orderNo'];
			$paymentLinkData['cancelUrl'] = $member_payment_page_url . "?page=cancel&order=" . $paymentLinkData['orderNo'];
			$paymentLinkData['pendingUrl'] = $member_payment_page_url . "?page=pending&order=" . $paymentLinkData['orderNo'];

			$data = ExplaraAdminApi::getPaymentLink($paymentLinkData);
		}

		wp_send_json(['status' => $status, 'data' => $data]);
	}

	public static function getRSVPForm() {

		$status = true;
		$postData = ($_POST);

		$data = ExplaraAdminApi::getRSVPForm($postData);
		$data->form = self::getRSVPFormHTML($data);

		wp_send_json(['status' => $status, 'data' => $data]);
	}

	public static function saveRSVPForm() {

		$status = true;
		$postData = json_encode($_POST);

		$data = ExplaraAdminApi::saveRSVPForm($postData);

		wp_send_json(['status' => $status, 'data' => $data]);
	}

	public static function updateAttendee() {

		$status = true;
		$postData = $_POST;

		$data = ExplaraAdminApi::updateAttendee($postData);

		$PageId = get_option('explara_member_portal_page');
		$dashboard_url = get_permalink($PageId);

		wp_send_json(['status' => $status, 'data' => $data, 'portal_page' => $dashboard_url]);
	}

	public static function getMultiDateDetails() {
		$status = true;
		$event_display_id = $_POST['event_display_id'];

		$postData['eventId'] = AdminEvents::getEventIdByDisplayId($event_display_id);

		$data = ExplaraAdminApi::getMultiDateDetails($postData);
		wp_send_json(['status' => $status, 'data' => $data]);
	}

	public static function getMultiDateDetailsFromUrl($eventId) {
		$status = true;
		$date = $_GET['date'];

		$postData['eventId'] = $eventId;

		$dates = \explara\ExplaraAdminApi::getMultiDateDetails($postData);

		$dateId = null;
		foreach ($dates->MultiDateSessionDetails as $key => $dateObject) {
			if ($key == $date) {
				$dateId = $dateObject[0]->id;
			}
		}

		$newPost['sessionDateId'] = $dateId;
		$detailDetails = ExplaraAdminApi::getMultiDateTickets($newPost);

		return [$dates->MultiDateSessionDetails, $detailDetails];
	}

	public static function getConferenceSession($eventId) {
		$status = true;

		$postData['eventId'] = $eventId;
		$data = \explara\ExplaraAdminApi::getConferenceSession($postData);

		return $data;
	}

	private static function getAttendeeFormHTML($data) {

		if (count($data->attendeeForm) == 0) {
			return false;
		}

		$HTML .= '<div class="row">';

		foreach ($data->attendeeForm as $formname => $fields) {

			$HTML .= '<div class="col-sm-6 col-xs-12 explara_attendee_form_hr">';
			$HTML .= '<div class="explara_attendee" id="' . $formname . '">';

			foreach ($fields as $field) {

				$HTML .= '<div class="form-group">';

				$required = 'required';
				$requiredMark = '*';

				if ($field->mandatory == false) {
					$required = '';
					$requiredMark = '';
				}

				$placeholder = $field->label;

				if (!empty($field->description)) {
					$placeholder = $field->description;
				}

				if ($field->type != 'Label') {
					$HTML .= '<label>' . $field->label . ' ' . $requiredMark . '</label>';
				}

				if ($field->validation == 'EmailAddress' and $field->type == 'Text') {

					$HTML .= '<input data-label="' . $field->label . '" class="form-control  explara_attendee_inputs" name="exp_field' . mt_rand() . '" data-id="' . $field->id . '" type="email" ' . $required . ' placeholder="' . $placeholder . '">';
				} else if ($field->validation == 'Digits' and $field->type == 'Text') {

					$HTML .= '<input data-label="' . $field->label . '" class="form-control  explara_attendee_inputs" name="exp_field' . mt_rand() . '" data-id="' . $field->id . '" type="number" ' . $required . ' placeholder="' . $placeholder . '">';
				} else if ($field->type == 'Textarea') {

					$HTML .= '<textarea rows="4" data-label="' . $field->label . '" class="form-control  explara_attendee_inputs" name="exp_field' . mt_rand() . '" data-id="' . $field->id . '" ' . $required . ' placeholder="' . $placeholder . '"></textarea>';
				} else if ($field->type == 'Radio') {

					$HTML .= '<br>';

					$interval = 0;

					$HTML .= '<div class="explara_attendee_inputs_radio">';

					foreach ($field->options as $radiokey => $option) {

						if ($interval == 0) {
							$selected = 'checked';
						} else {
							$selected = '';
						}

						$HTML .= '<label>';

						$HTML .= '<input ' . $selected . ' value="' . $option . '" data-label="' . $field->label . '" class=" explara_attendee_inputs_radio_field" name=" ' . $formname . 'exp_field' . $field->id . '" data-id="' . $field->id . '" type="radio">';

						$HTML .= '&nbsp;&nbsp';

						$HTML .= '<span>' . $option . '</span>';

						$HTML .= '</label>';
						$HTML .= '<br>';

						++$interval;

					}

					$HTML .= '</div>';

				} else if ($field->type == 'MultiCheckbox' && $field->label != 'Terms & Conditions') {

					$HTML .= '<br>';

					$HTML .= '<div class="explara_attendee_inputs_checkbox" data-label="' . $field->label . '"  data-id="' . $field->id . '">';

					foreach ($field->options as $radiokey => $option) {

						$HTML .= '<label>';

						$HTML .= '<input  data-label="' . $field->label . '" value="' . $option . '" class=" explara_attendee_inputs_checkbox_field" name=" ' . $formname . ' exp_field' . $field->id . '" data-id="' . $field->id . '" type="checkbox">';

						$HTML .= '&nbsp;&nbsp';

						$HTML .= '<span>' . $option . '</span>';

						$HTML .= '</label>';
						$HTML .= '<br>';

					}

					$HTML .= '</div>';

				} else if ($field->type == 'Select') {

					$HTML .= '<select class="form-control explara_attendee_inputs" data-label="' . $field->label . '" name="exp_field' . mt_rand() . '" data-id="' . $field->id . '" ' . $required . ' >';

					$HTML .= '<option value="">Select an option</option>';

					foreach ($field->options as $option) {
						$HTML .= '<option value="' . $option . '">' . $option . '</option>';
					}

					$HTML .= '</select>';
				} else if ($field->validation == 'Date' and $field->type == 'Text') {

					$HTML .= '<input data-label="' . $field->label . '" class="explara_date_picker form-control  explara_attendee_inputs" name="exp_field' . mt_rand() . '" data-id="' . $field->id . '" type="text" ' . $required . ' placeholder="' . $placeholder . '">';
				} else if ($field->type == 'Label') {

					$HTML .= '<p>' . $field->label . '</p>';
				} else if ($field->type == 'File') {

					$HTML .= '<input onchange="ExplaraCheckout.handelFileUpload(this)" id="exp_file_' . mt_rand() . $field->id . '" data-label="' . $field->label . '" class="form-control  explara_attendee_inputs_file" name="exp_field' . mt_rand() . '" data-id="' . $field->id . '" type="file" ' . $required . ' placeholder="' . $placeholder . '">';
				} else if ($field->validation == 'Hostname' and $field->type == 'Text') {

					$HTML .= '<input data-label="' . $field->label . '" class="form-control  explara_attendee_inputs" name="exp_field' . mt_rand() . '" data-id="' . $field->id . '" type="url" ' . $required . ' placeholder="' . $placeholder . '">';
				} else {

					if ($field->label != 'Terms & Conditions') {

						$HTML .= '<input data-label="' . $field->label . '" class="form-control  explara_attendee_inputs" name="exp_field' . mt_rand() . '" data-id="' . $field->id . '" type="' . strtolower($field->type) . '" placeholder="' . $placeholder . '" ' . $required . ' >';
					}

				}

				if ($field->label == 'Terms & Conditions') {

					$HTML .= '<br>';
					$HTML .= '<div class="explara_terms">';
					$HTML .= '<label>';

					$HTML .= '<input required value="' . $field->label . '" checked data-label="' . $field->label . '" class="explara_attendee_inputs" name="exp_field' . mt_rand() . '" data-id="' . $field->id . '" type="checkbox" ' . $required . ' placeholder="' . $placeholder . '">';

					$HTML .= '<a target="_blank" href="' . key($field->options) . '"> Agree To ' . $field->label;
					$HTML .= '</a>';

					$HTML .= '</label>';
					$HTML .= '</div>';
				}

				$HTML .= '</div>';

			}

			$HTML .= '</div>';
			$HTML .= '</div>';

		}

		$HTML .= '</div>';

		return $HTML;
	}

	private static function getRSVPFormHTML($data) {

		if (count($data->attendeeForm) == 0) {
			return false;
		}

		$HTML .= '<div class="row">';

		foreach ($data->attendeeForm as $formname => $fields) {

			$HTML .= '<div class="col-sm-12 col-xs-12">';
			$HTML .= '<div class="explara_rsvp" id="' . $formname . '">';

			foreach ($fields as $field) {

				$HTML .= '<div class="form-group">';

				$required = 'required';
				$requiredMark = '*';

				if ($field->mandatory == false) {
					$required = '';
					$requiredMark = '';
				}

				$placeholder = $field->label;

				if (!empty($field->description)) {
					$placeholder = $field->description;
				}

				if ($field->type != 'Label') {
					$HTML .= '<label>' . $field->label . ' ' . $requiredMark . '</label>';
				}

				if ($field->validation == 'EmailAddress' and $field->type == 'Text') {

					$HTML .= '<input data-label="' . $field->label . '" class="form-control  explara_attendee_inputs" name="exp_field' . mt_rand() . '" data-id="' . $field->id . '" type="email" ' . $required . ' placeholder="' . $placeholder . '">';
				} else if ($field->validation == 'Digits' and $field->type == 'Text') {

					$HTML .= '<input data-label="' . $field->label . '" class="form-control  explara_attendee_inputs" name="exp_field' . mt_rand() . '" data-id="' . $field->id . '" type="number" ' . $required . ' placeholder="' . $placeholder . '">';
				} else if ($field->type == 'Textarea') {

					$HTML .= '<textarea rows="4" data-label="' . $field->label . '" class="form-control  explara_attendee_inputs" name="exp_field' . mt_rand() . '" data-id="' . $field->id . '" ' . $required . ' placeholder="' . $placeholder . '"></textarea>';
				} else if ($field->type == 'Radio') {

					$HTML .= '<br>';

					$interval = 0;

					foreach ($field->options as $radiokey => $option) {

						if ($interval == 0) {
							$selected = 'checked';
						} else {
							$selected = '';
						}

						$HTML .= '<label>';

						$HTML .= '<input ' . $selected . ' data-label="' . $option . '" class=" explara_attendee_inputs" name="' . $formname . 'exp_field' . $field->id . '" data-id="' . $field->id . '" type="radio">';

						$HTML .= '&nbsp;&nbsp';

						$HTML .= '<span>' . $option . '</span>';

						$HTML .= '</label>';
						$HTML .= '<br>';

						++$interval;

					}
				} else if ($field->type == 'MultiCheckbox' && $field->label != 'Terms & Conditions') {

					$HTML .= '<br>';

					foreach ($field->options as $radiokey => $option) {

						$HTML .= '<label>';

						$HTML .= '<input  data-label="' . $option . '" class=" explara_attendee_inputs" name="' . $formname . 'exp_field' . $field->id . '" data-id="' . $field->id . '" type="checkbox">';

						$HTML .= '&nbsp;&nbsp';

						$HTML .= '<span>' . $option . '</span>';

						$HTML .= '</label>';
						$HTML .= '<br>';

					}
				} else if ($field->type == 'Select') {

					$HTML .= '<select class="form-control" data-label="' . $field->label . '" name="exp_field' . mt_rand() . '" data-id="' . $field->id . '" ' . $required . ' >';

					$HTML .= '<option value="">Select an option</option>';

					foreach ($field->options as $option) {
						$HTML .= '<option value="' . $option . '">' . $option . '</option>';
					}

					$HTML .= '</select>';
				} else if ($field->validation == 'Date' and $field->type == 'Text') {

					$HTML .= '<input data-label="' . $field->label . '" class="explara_date_picker form-control  explara_attendee_inputs" name="exp_field' . mt_rand() . '" data-id="' . $field->id . '" type="text" ' . $required . ' placeholder="' . $placeholder . '">';
				} else if ($field->type == 'Label') {

					$HTML .= '<p>' . $field->label . '</p>';
				} else if ($field->type == 'File') {

					$HTML .= '<input onchange="ExplaraCheckout.handelFileUpload(this)" data-label="' . $field->label . '" class="form-control  explara_attendee_inputs" name="exp_field' . mt_rand() . '" data-id="' . $field->id . '" type="file" ' . $required . ' placeholder="' . $placeholder . '">';
				} else if ($field->validation == 'Hostname' and $field->type == 'Text') {

					$HTML .= '<input data-label="' . $field->label . '" class="form-control  explara_attendee_inputs" name="exp_field' . mt_rand() . '" data-id="' . $field->id . '" type="url" ' . $required . ' placeholder="' . $placeholder . '">';
				} else {

					$HTML .= '<input data-label="' . $field->label . '" class="form-control  explara_attendee_inputs" name="exp_field' . mt_rand() . '" data-id="' . $field->id . '" type="' . strtolower($field->type) . '" placeholder="' . $placeholder . '" ' . $required . ' >';
				}

				if ($field->label == 'Terms & Conditions') {

					$HTML .= '<br>';
					$HTML .= '<div class="explara_terms">';
					$HTML .= '<label>';

					$HTML .= '<input checked data-label="' . $field->label . '" class="explara_attendee_inputs" name="exp_field' . mt_rand() . '" data-id="' . $field->id . '" type="checkbox" ' . $required . ' placeholder="' . $placeholder . '">';

					$HTML .= '<a href=""> Agree To ' . $field->label;
					$HTML .= '</a>';

					$HTML .= '</label>';
					$HTML .= '</div>';
				}

				$HTML .= '</div>';

			}

			$HTML .= '</div>';
			$HTML .= '</div>';

		}

		$HTML .= '</div>';

		return $HTML;
	}

}
?>