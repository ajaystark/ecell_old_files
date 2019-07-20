<?php
namespace explara;

class ExpMember {

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
		require_once EXPL_PLUGIN_DIR . '/includes/classes/explara-events-db.php';
		require_once EXPL_PLUGIN_DIR . '/includes/classes/explara-settings.php';
		require_once EXPL_PLUGIN_DIR . '/includes/classes/explara-members-db.php';
		require_once EXPL_PLUGIN_DIR . '/includes/member/explara-member-api.php';

		require_once EXPL_PLUGIN_DIR . '/includes/admin/explara-admin-api.php';

		require_once EXPL_PLUGIN_DIR . '/includes/member/explara-events-shortcodes.php';
		require_once EXPL_PLUGIN_DIR . '/includes/member/explara-account-shortcodes.php';
		require_once EXPL_PLUGIN_DIR . '/includes/member/explara-portal-shortcodes.php';
		require_once EXPL_PLUGIN_DIR . '/includes/member/explara-payment-shortcodes.php';

		require_once EXPL_PLUGIN_DIR . '/includes/member/explara-member-account.php';
		require_once EXPL_PLUGIN_DIR . '/includes/member/explara-member-checkout.php';
		require_once EXPL_PLUGIN_DIR . '/includes/member/explara-member-order.php';
		require_once EXPL_PLUGIN_DIR . '/includes/member/explara-member-events.php';
	}

	public function memberScriptStyles() {

		wp_enqueue_style('exp-member-font', '//fonts.googleapis.com/css?family=Open+Sans:400,600,700', array(), EXPL_EVENTS_VERSION);

		wp_enqueue_style('exp-css', EXPL_PLUGIN_URL . 'public/css/member.css', array(), EXPL_EVENTS_VERSION, 'all');

		wp_enqueue_script('exp-ajax-request', EXPL_PLUGIN_URL . 'public/js/min/member-min.js', array('jquery'), false, true);

		wp_localize_script('exp-ajax-request', 'EXPUserAjax', array('ajaxurl' => admin_url('admin-ajax.php')));
	}

	public function userInlineJS() {
		require_once EXPL_PLUGIN_DIR . '/pages/member/events/user-footer.php';
	}

	public function memberHeader() {
		require_once EXPL_PLUGIN_DIR . '/pages/member/portal/footer.php';
	}

}
?>