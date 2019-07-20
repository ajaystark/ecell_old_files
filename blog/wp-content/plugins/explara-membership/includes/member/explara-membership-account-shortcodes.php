<?php
namespace explara;

add_shortcode('explara-membership-account', array('explara\ExplaraMembershipAccountShortcodes', 'account'));

class ExplaraMembershipAccountShortcodes {

	public static function account($atts) {

		$checkAuth = ExplaraMembershipAccountPost::checkAuth();

		if ($checkAuth == true) {

			$EventsPageId = get_option('explara_member_portal_page');
			$explara_events_page_url = get_permalink($EventsPageId);

			explara_member_redirect($explara_events_page_url);
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
		$PageId = get_option('explara_membership_account_page');
		$member_account_page_url = get_permalink($PageId);

		$sign_in_link = $member_account_page_url . '?page=signin';
		$sign_up_link = $member_account_page_url . '?page=signup';
		$sign_fp_link = $member_account_page_url . '?page=forgot-password';

		if (isset($_GET['from']) && !empty($_GET['from'])) {

			$sign_in_link = $sign_in_link . '&from=' . $_GET['from'];
			$sign_up_link = $sign_up_link . '&from=' . $_GET['from'];
			$sign_fp_link = $sign_fp_link . '&from=' . $_GET['from'];
		}

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

		require_once EXPL_MEMBERSHIP_PLUGIN_DIR . '/pages/member/account/' . $file;
	}

}
?>