<?php
namespace explara;

add_shortcode('explara-payment', array('explara\ExplaraPaymentShortcodes', 'payment'));

class ExplaraPaymentShortcodes {

	public static function payment($atts) {

		ob_start();

		extract(shortcode_atts(array(
			'page' => 'success',
		), $atts));

		self::getPaymentPage($page);

		$payment_templates = ob_get_clean();

		return $payment_templates;
	}

	private static function getPaymentPage($page) {

		$file = NULL;

		if (isset($_GET['page']) && !empty($_GET['page'])) {
			$page = $_GET['page'];
		}

		// The Member Payment Page Id & Details
		$PageId = get_option('explara_member_payment_page');

		$member_account_page_url = get_permalink($PageId);

		switch ($page) {

		case 'success':
			$file = 'success.php';
			break;

		case 'failed':
			$file = 'failed.php';
			break;

		case 'pending':
			$file = 'pending.php';
			break;

		case 'cancel':
			$file = 'cancel.php';
			break;
		default:
			$file = 'failed.php';
			break;
		}

		require_once EXPL_PLUGIN_DIR . '/pages/member/payment/' . $file;
	}

}
?>