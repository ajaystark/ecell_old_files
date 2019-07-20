<?php
namespace explara;

class ExpMembershipMain {

	protected static $instance = null;

	public static function get_instance() {
		// create an object
		NULL === self::$instance and self::$instance = new self;

		return self::$instance;
	}

	public function init() {

		$this->fileInlcudes();

		$this->memberScriptStyles();

		add_action('wp_head', array($this, 'memberHeader'), 20);
		add_action('wp_footer', array($this, 'userInlineJS'), 21);
	}

	public function fileInlcudes() {
		require_once EXPL_MEMBERSHIP_PLUGIN_DIR . '/includes/classes/explara-groups-db.php';
		require_once EXPL_MEMBERSHIP_PLUGIN_DIR . '/includes/classes/explara-membership-settings.php';
		require_once EXPL_MEMBERSHIP_PLUGIN_DIR . '/includes/classes/explara-membership-db.php';
		require_once EXPL_MEMBERSHIP_PLUGIN_DIR . '/includes/member/explara-membership-api.php';

		require_once EXPL_MEMBERSHIP_PLUGIN_DIR . '/includes/admin/explara-membership-admin-api.php';

		require_once EXPL_MEMBERSHIP_PLUGIN_DIR . '/includes/member/explara-membership-groups-shortcodes.php';
		require_once EXPL_MEMBERSHIP_PLUGIN_DIR . '/includes/member/explara-membership-account-shortcodes.php';
		require_once EXPL_MEMBERSHIP_PLUGIN_DIR . '/includes/member/explara-membership-portal-shortcodes.php';
		require_once EXPL_MEMBERSHIP_PLUGIN_DIR . '/includes/member/explara-membership-payment-shortcodes.php';

		require_once EXPL_MEMBERSHIP_PLUGIN_DIR . '/includes/member/explara-membership-account.php';
		require_once EXPL_MEMBERSHIP_PLUGIN_DIR . '/includes/member/explara-membership-checkout.php';
		require_once EXPL_MEMBERSHIP_PLUGIN_DIR . '/includes/member/explara-membership-order.php';
		require_once EXPL_MEMBERSHIP_PLUGIN_DIR . '/includes/member/explara-membership-groups.php';
	}

	public function memberScriptStyles() {

		wp_enqueue_style('exp-membership-member-font', '//fonts.googleapis.com/css?family=Open+Sans:400,600,700', array(), EXPL_MEMBERSHIP_VERSION);

		wp_enqueue_style('exp-membership-css', EXPL_MEMBERSHIP_PLUGIN_URL . 'public/css/member.css', array(), EXPL_MEMBERSHIP_VERSION, 'all');

		wp_enqueue_script('exp-membership-ajax-request', EXPL_MEMBERSHIP_PLUGIN_URL . 'public/js/min/member-min.js', array('jquery'), false, true);

		wp_localize_script('exp-membership-ajax-request', 'EXPUserAjax', array('ajaxurl' => admin_url('admin-ajax.php')));
	}

	public function userInlineJS() {
		//require_once EXPL_MEMBERSHIP_PLUGIN_DIR . '/pages/member/events/user-footer.php';
	}

	public function memberHeader() {
		require_once EXPL_MEMBERSHIP_PLUGIN_DIR . '/pages/member/portal/footer.php';
	}

}
?>