<?php
namespace explara;

add_shortcode('explara-account', array('explara\ExplaraAccountShortcodes', 'account'));

class ExplaraAccountShortcodes {

	public static function account($atts) {

		$checkAuth = ExplaraMemberPost::checkAuth();

		if ($checkAuth == true) {

			$EventsPageId = get_option('explara_member_portal_page');
			$explara_events_page_url = get_permalink($EventsPageId);

			explara_redirect($explara_events_page_url);
			exit;
		}

		ob_start();

		extract(shortcode_atts(array(
			'page' => 'signin',
		), $atts));

		self::getAccountPage($page);

		$account_templates = ob_get_clean();

		return $account_templates;
	}

	private static function getAccountPage($page) {

		$file = NULL;

		if (isset($_GET['page']) && !empty($_GET['page'])) {
			$page = $_GET['page'];
		}

		// The Member Account Page Id & Details
		$PageId = get_option('explara_member_account_page');

		$member_account_page_url = get_permalink($PageId);

		switch ($page) {

		case 'signin':
			$file = 'signin.php';
			break;

		case 'signup':
			$file = 'signup.php';
			break;

		case 'forgot-password':
			$file = 'forgotpassword.php';
			break;
		default:
			$file = 'signin.php';
			break;
		}

		require_once EXPL_PLUGIN_DIR . '/pages/member/account/' . $file;
	}

}
?>