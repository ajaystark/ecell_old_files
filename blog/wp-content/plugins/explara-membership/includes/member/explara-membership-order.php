<?php
namespace explara;

add_action('wp_ajax_page_explara_ticket_cancel', array('explara\ExplaraMembershipOrder', 'cancelTicket'));
add_action('wp_ajax_nopriv_page_explara_ticket_cancel', array('explara\ExplaraMembershipOrder', 'cancelTicket'));

class ExplaraMembershipOrder {

	public static function cancelTicket() {

		$status = true;
		$postData = $_POST;

		$data = ExplaraMemberAdminApi::cancelTicket($postData);

		wp_send_json(['status' => $status, 'data' => $data]);
	}

}
?>