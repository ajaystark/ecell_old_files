<?php
namespace explara;

add_action('wp_ajax_page_explara_member_cart', array('explara\ExplaraMembershipCheckout', 'cartCalculation'));
add_action('wp_ajax_nopriv_page_explara_member_cart', array('explara\ExplaraMembershipCheckout', 'cartCalculation'));

add_action('wp_ajax_page_explara_member_checkout', array('explara\ExplaraMembershipCheckout', 'generateOrder'));
add_action('wp_ajax_nopriv_page_explara_member_checkout', array('explara\ExplaraMembershipCheckout', 'generateOrder'));

add_action('wp_ajax_page_explara_member_attendee_form', array('explara\ExplaraMembershipCheckout', 'getAttendeeForm'));
add_action('wp_ajax_nopriv_page_explara_member_attendee_form', array('explara\ExplaraMembershipCheckout', 'getAttendeeForm'));

add_action('wp_ajax_page_explara_member_attendee_form_save', array('explara\ExplaraMembershipCheckout', 'saveAttendeeForm'));
add_action('wp_ajax_nopriv_page_explara_member_attendee_form_save', array('explara\ExplaraMembershipCheckout', 'saveAttendeeForm'));

add_action('wp_ajax_explara_attendee_update', array('explara\ExplaraMembershipCheckout', 'updateAttendee'));
add_action('wp_ajax_nopriv_explara_attendee_update', array('explara\ExplaraMembershipCheckout', 'updateAttendee'));

add_action('wp_ajax_explara_get_multidate_data', array('explara\ExplaraMembershipCheckout', 'getMultiDateDetails'));
add_action('wp_ajax_nopriv_explara_get_multidate_data', array('explara\ExplaraMembershipCheckout', 'getMultiDateDetails'));

add_action('wp_ajax_explara_page_membership_get_config', array('explara\ExplaraMembershipCheckout', 'getConfig'));
add_action('wp_ajax_nopriv_explara_page_membership_get_config', array('explara\ExplaraMembershipCheckout', 'getConfig'));

add_action('wp_ajax_page_explara_upload_form', array('explara\ExplaraMembershipCheckout', 'uploadFile'));
add_action('wp_ajax_nopriv_page_explara_upload_form', array('explara\ExplaraMembershipCheckout', 'uploadFile'));

add_action('wp_ajax_page_explara_member_save_account', array('explara\ExplaraMembershipCheckout', 'saveAccountForm'));
add_action('wp_ajax_nopriv_page_explara_member_save_account', array('explara\ExplaraMembershipCheckout', 'saveAccountForm'));

add_action('wp_ajax_explara_page_check_group_member_profile', array('explara\ExplaraMembershipCheckout', 'checkMemberProfile'));
add_action('wp_ajax_nopriv_explara_page_check_group_member_profile', array('explara\ExplaraMembershipCheckout', 'checkMemberProfile'));

add_action('wp_ajax_explara_page_member_search', array('explara\ExplaraMembershipCheckout', 'getAllMembers'));
add_action('wp_ajax_nopriv_explara_page_member_search', array('explara\ExplaraMembershipCheckout', 'getAllMembers'));

add_action('wp_ajax_explara_page_group_photos', array('explara\ExplaraMembershipCheckout', 'getGroupPhotos'));
add_action('wp_ajax_nopriv_explara_page_group_photos', array('explara\ExplaraMembershipCheckout', 'getGroupPhotos'));

add_action('wp_ajax_explara_page_get_profile_info', array('explara\ExplaraMembershipCheckout', 'getMemberProfileForModel'));
add_action('wp_ajax_nopriv_explara_page_get_profile_info', array('explara\ExplaraMembershipCheckout', 'getMemberProfileForModel'));

class ExplaraMembershipCheckout {

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
		$data['ApiUrl'] = EXPLARA_MEMBER_API_URL;
		$data['groupRecipietUrl'] = EXPLARA_MEMBER_API_URL . 'membership/confirmation/receipt/order/';

		wp_send_json(['status' => $status, 'data' => $data]);
	}

	public static function cartCalculation() {

		$status = true;
		$postData = json_encode($_POST);

		$data = ExplaraMemberAdminApi::cartCalculation($postData);

		wp_send_json(['status' => $status, 'data' => $data]);
	}

	public static function generateOrder() {

		$status = true;
		$postData = json_encode($_POST);

		$data = ExplaraMemberAdminApi::generateOrder($postData);

		if (isset($data->status) && $data->status == 'success') {

			if (isset($_POST['to_payment']) && $_POST['to_payment'] == 'yes') {

				$PageId = get_option('explara_membership_payment_page');
				$member_payment_page_url = get_permalink($PageId);

				$paymentLinkData['orderNo'] = sanitize_text_field($data->orderNo);

				$paymentLinkData['returnUrl'] = $member_payment_page_url . "?page=success&order=" . $paymentLinkData['orderNo'];
				$paymentLinkData['cancelUrl'] = $member_payment_page_url . "?page=cancel&order=" . $paymentLinkData['orderNo'];
				$paymentLinkData['pendingUrl'] = $member_payment_page_url . "?page=pending&order=" . $paymentLinkData['orderNo'];

				$data = ExplaraMemberAdminApi::getPaymentLink($paymentLinkData);

			}
		}

		wp_send_json(['status' => $status, 'data' => $data]);
	}

	public static function getAttendeeForm() {

		$status = true;
		$postData = ($_POST);

		$data = ExplaraMemberAdminApi::getAttendeeForm($postData);
		$data->form = self::getAttendeeFormHTML($data);

		if (!$data->form) {
			$PageId = get_option('explara_membership_payment_page');
			$member_payment_page_url = get_permalink($PageId);

			$paymentLinkData['orderNo'] = sanitize_text_field($_POST['orderNo']);

			$paymentLinkData['returnUrl'] = $member_payment_page_url . "?page=success&order=" . $paymentLinkData['orderNo'];
			$paymentLinkData['cancelUrl'] = $member_payment_page_url . "?page=cancel&order=" . $paymentLinkData['orderNo'];
			$paymentLinkData['pendingUrl'] = $member_payment_page_url . "?page=pending&order=" . $paymentLinkData['orderNo'];

			$data->paymentData = ExplaraMemberAdminApi::getPaymentLink($paymentLinkData);
		}

		wp_send_json(['status' => $status, 'data' => $data]);
	}

	public static function saveAttendeeForm() {

		$status = true;
		$postData = json_encode($_POST);

		$data = ExplaraMemberAdminApi::saveAttendeeForm($postData);

		$PageId = get_option('explara_membership_payment_page');
		$member_payment_page_url = get_permalink($PageId);

		$paymentLinkData['orderNo'] = sanitize_text_field($_POST['orderNo']);
		$paymentLinkData['returnUrl'] = $member_payment_page_url . "?page=success&order=" . $paymentLinkData['orderNo'];
		$paymentLinkData['cancelUrl'] = $member_payment_page_url . "?page=cancel&order=" . $paymentLinkData['orderNo'];
		$paymentLinkData['pendingUrl'] = $member_payment_page_url . "?page=pending&order=" . $paymentLinkData['orderNo'];

		$data->paymentData = ExplaraMemberAdminApi::getPaymentLink($paymentLinkData);

		wp_send_json(['status' => $status, 'data' => $data]);
	}

	public static function checkMemberProfile() {

		$isMember = false;

		$db_group = ExpGroupsDB::getGroup();

		$member_profile = ExplaraMemberAdminApi::getMemberProfile($db_group->group_id);
		if (!empty($member_profile->membership)) {
			$isMember = true;
		}

		wp_send_json(['data' => $isMember, 'result' => $member_profile->membership]);
	}

	public static function getGroupPhotos() {

		$status = true;
		$db_group = ExpGroupsDB::getGroup();

		$groupObj = ExplaraMemberAdminApi::getSingleGroup($db_group->group_id);
		$photos = self::getSingleGroupPhotos($groupObj->details->tabs);

		wp_send_json(['status' => $status, 'photos' => $photos]);
	}

	public static function getSingleGroupPhotos($tabs) {

		$photos = [];

		if (!empty($tabs->Photos)) {
			if (!empty($tabs->Photos->details) && $tabs->Photos->details != null) {

				foreach ($tabs->Photos->details as $category) {
					if (!empty($category->images)) {
						$photos = array_merge($photos, $category->images);
					}
				}

			}
		}

		if (count($photos) > 0) {
			$photos = self::processPhotos($photos);
		}

		return $photos;
	}

	public static function processPhotos($items) {

		$photos = [];

		foreach ($items as $item) {

			$width = 500;
			$height = 500;

			$imagesize = getimagesize($item);
			if ($imagesize) {
				$width = $imagesize[0];
				$height = $imagesize[1];
			}

			array_push($photos, [
				'src' => $item,
				'w' => $width,
				'h' => $height,
			]);
		}

		return $photos;
	}

	public static function getAllMembers() {

		$isMember = false;

		$db_group = ExpGroupsDB::getGroup();
		$html = '';

		if ($_POST['keyword'] == '') {
			$members = ExplaraMemberAdminApi::getSingleMembers($db_group->group_id);
		} else {
			$members = ExplaraMemberAdminApi::getSingleSearchMembers($db_group->group_id, $_POST['keyword']);
		}

		$html = self::prepareMemberHTML($members->membership);

		wp_send_json(['members' => $members->membership, 'html' => $html]);
	}

	public static function saveAccountForm() {

		$status = true;
		$postData = ($_POST);

		$data = ExplaraMemberAdminApi::saveAccountForm($postData);

		wp_send_json(['status' => $status, 'data' => $data]);
	}

	private static function prepareMemberHTML($members) {

		if (count($members) == 0) {
			return '';
		}

		$HTML = '';

		foreach ($members as $member) {
			$defaultPic = 'https://cdn.explara.com/default_profile_image.jpg';

			$HTML .= '<div class="col-sm-3 col-xs-12 exp_membership_member_block">';

			$HTML .= '<a class="expl-membership-member-card" data-member="' . $member->memberId . '">';

			if (!empty($member->profileImage)) {
				$defaultPic = $member->profileImage;
			}

			$HTML .= '<img src="' . $defaultPic . '" class="img-responsive">';

			$HTML .= '<h2>';
			$HTML .= $member->name;
			$HTML .= '</h2>';

			$HTML .= '<p>';
			$HTML .= $member->membership;
			$HTML .= '</p>';

			$HTML .= '</a>';

			$HTML .= '</div>';

		}

		return $HTML;

	}

	private static function getAttendeeFormHTML($data) {

		if (count($data->attendeeForm) == 0) {
			return false;
		}
		$HTML .= '<div class="row panel-group" id="accordion" role="tablist" aria-multiselectable="true">';

		$counter = 1;

		foreach ($data->attendeeForm as $formname => $fields) {

			$pandel_open_class = '';
			if ($counter == 1) {
				$pandel_open_class = 'in';
			}

			$HTML .= '<div class="col-sm-12 col-xs-12">';

			$HTML .= '<div class="panel panel-default exp_member_content_block">';
			$HTML .= '<div class="panel-heading" role="tab" id="headingOne">';
			$HTML .= '<h4 class="panel-title">';
			$HTML .= '<a role="button" data-toggle="collapse" data-parent="#accordion" href="#panel_' . $formname . '" aria-expanded="true" aria-controls="panel_' . $formname . '">';
			$HTML .= 'Member ' . $counter;
			$HTML .= '</a>';
			$HTML .= '</h4>';
			$HTML .= '</div>';

			$HTML .= '<div id="panel_' . $formname . '" class="panel-collapse collapse ' . $pandel_open_class . '" role="tabpanel" aria-labelledby="headingOne">';
			$HTML .= '<div class="panel-body">';
			$HTML .= '<div class="explara_attendee" id="' . $formname . '">';

			foreach ($fields as $key => $field) {

				$HTML .= '<div class="col-sm-4 col-xs-12">';

				$HTML .= '<div class="form-group expl-form-group">';

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

					$HTML .= '<div class="explara_attendee_inputs_radio radio-custom">';

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

					$HTML .= '<div class="explara_attendee_inputs_checkbox check-custom" data-label="' . $field->label . '"  data-id="' . $field->id . '">';

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

					$HTML .= '<input onchange="ExplaraMemberCheckout.handelFileUpload(this)" id="exp_file_' . mt_rand() . $field->id . '" data-label="' . $field->label . '" class="form-control  explara_member_attendee_inputs_file" name="exp_field' . mt_rand() . '" data-id="' . $field->id . '" type="file" ' . $required . ' placeholder="' . $placeholder . '">';
				} else if ($field->validation == 'Hostname' and $field->type == 'Text') {

					$HTML .= '<input data-label="' . $field->label . '" class="form-control  explara_attendee_inputs" name="exp_field' . mt_rand() . '" data-id="' . $field->id . '" type="url" ' . $required . ' placeholder="' . $placeholder . '">';
				} else {

					if ($field->label != 'Terms & Conditions') {

						$HTML .= '<input data-label="' . $field->label . '" class="form-control  explara_attendee_inputs" name="exp_field' . mt_rand() . '" data-id="' . $field->id . '" type="' . strtolower($field->type) . '" placeholder="' . $placeholder . '" ' . $required . ' >';
					}

				}

				if ($field->label == 'Terms & Conditions') {

					$HTML .= '<br>';
					$HTML .= '<div class="explara_terms check-custom">';
					$HTML .= '<label>';

					$HTML .= '<input required value="' . $field->label . '" checked data-label="' . $field->label . '" class="explara_attendee_inputs" name="exp_field' . mt_rand() . '" data-id="' . $field->id . '" type="checkbox" ' . $required . ' placeholder="' . $placeholder . '">';

					$HTML .= '<a target="_blank" href="' . key($field->options) . '"> Agree To ' . $field->label;
					$HTML .= '</a>';

					$HTML .= '</label>';
					$HTML .= '</div>';
				}

				$HTML .= '</div>';

				$HTML .= '</div>';

			}

			$HTML .= '</div>';
			$HTML .= '</div>';
			$HTML .= '</div>';
			$HTML .= '</div>';
			$HTML .= '</div>';

			$counter = $counter + 1;
		}

		$HTML .= '</div>';

		return $HTML;
	}

	public static function getMemberProfileForModel($member) {
		$db_group = ExpGroupsDB::getGroup();
		$html = '';

		$members = ExplaraMemberAdminApi::getMemberProfileInfo($db_group->group_id, $_POST['memberId']);

		$html = self::prepareMemberInfoHTML($members->membership);

		wp_send_json(['member' => $members->membership, 'html' => $html]);
	}

	private static function prepareMemberInfoHTML($membership) {
		$HTML = '';
		if (empty($membership->attendeeInfo)) {
			return $HTML;
		}

		$defaultPic = 'https://cdn.explara.com/default_profile_image.jpg';
		$member_info = (array) $membership->attendeeInfo;

		if (!empty($membership->profileImage)) {
			$defaultPic = $membership->profileImage;
		}

		$HTML .= '<div class="modal-header">';
		$HTML .= '<img src="' . $defaultPic . '" class="img-responsive">';
		$HTML .= '</div>';

		$HTML .= '<div class="modal-body">';
		$HTML .= '<div class="row">';

		foreach ($member_info as $key => $value) {

			if (empty($value) || $value == "" || count($value) == 0) {
				continue;
			}

			$HTML .= '<div class="col-sm-4 col-xs-12">';
			$HTML .= '<div class="expl-form-group">';

			$HTML .= '<label>';
			$HTML .= $key;
			$HTML .= '</label>';

			$HTML .= '<p>';
			if (is_array($value)) {

				if (count($value > 1)) {

					$multi_value = '';

					foreach ($value as $item) {
						$multi_value .= $item . ', ';
					}

					$multi_value = rtrim($multi_value, ', ');

					if (!empty($multi_value)) {
						$HTML .= $multi_value;
					}

				} else {

					$innvalue = isset($value[0]) ? $value[0] : '';

					if (!empty($innvalue)) {
						$HTML .= $innvalue;
					}

				}

			} else {

				if (!empty($value)) {
					$HTML .= $value;
				}
			}

			$HTML .= '</p>';

			$HTML .= '</div>';
			$HTML .= '</div>';
		}

		$HTML .= '</div>';
		$HTML .= '</div>';

		return $HTML;
	}
}
?>