<?php
namespace explara;

class ExpMemberShipAdmin {
	protected static $instance = null;

	public static function get_instance() {
		// create an object
		NULL === self::$instance and self::$instance = new self;

		return self::$instance;
	}

	public function init() {
		$this->fileInlcudes();

		$this->adminScriptStyles();

		$this->checkToken();

		add_action('admin_menu', array($this, 'menuItems'));
	}

	public function checkToken() {

		if (!get_option('explara_access_token', NULL)) {
			add_action('admin_notices', 'sample_member_admin_notice__success');
		}
	}

	public function fileInlcudes() {
		require_once EXPL_MEMBERSHIP_PLUGIN_DIR . '/includes/admin/explara-membership-admin-api.php';
		require_once EXPL_MEMBERSHIP_PLUGIN_DIR . '/includes/classes/explara-membership-settings.php';
		require_once EXPL_MEMBERSHIP_PLUGIN_DIR . '/includes/admin/explara-admin-post.php';
		require_once EXPL_MEMBERSHIP_PLUGIN_DIR . '/includes/admin/admin-groups.php';
		require_once EXPL_MEMBERSHIP_PLUGIN_DIR . '/includes/admin/admin-groups-listtable.php';
		require_once EXPL_MEMBERSHIP_PLUGIN_DIR . '/includes/classes/explara-groups-db.php';
	}

	public function menuItems() {

		add_action('admin_enqueue_scripts', array($this, 'adminScriptStyles'));

		add_menu_page('Explara Membership', 'Explara Membership', 'manage_options', 'explara-membership', array($this, 'pageMembership'), 'dashicons-admin-post');

		add_submenu_page('explara-membership', 'Membership', 'Membership', 'manage_options', 'explara-membership', array($this, 'pageMembership'));

		add_submenu_page('explara-membership', 'Settings', 'Settings', 'manage_options', 'explara-membership-settings', array($this, 'pageSettings'));
	}

	public function adminScriptStyles() {

		if (is_admin()) {
			wp_enqueue_media();
			wp_enqueue_script('exp-membership-ajax-request', EXPL_MEMBERSHIP_PLUGIN_URL . 'public/js/min/admin-min.js', array('jquery'), false, true);
			wp_localize_script('exp-membership-ajax-request', 'EXPAjax', array('ajaxurl' => plugins_url('admin-ajax.php')));

			wp_enqueue_style('exp-membership-css', EXPL_MEMBERSHIP_PLUGIN_URL . 'public/css/admin.css', array(), EXPL_MEMBERSHIP_VERSION, 'all');
		}
	}

	public function pageMembership() {
		$group_id = isset($_GET['group_id']) ? $_GET['group_id'] : NULL;

		if (!empty($group_id)) {
			require_once EXPL_MEMBERSHIP_PLUGIN_DIR . '/pages/admin/single-group.php';
		} else {
			require_once EXPL_MEMBERSHIP_PLUGIN_DIR . '/pages/admin/admin-groups.php';
		}
	}

	public function pageSettings() {

		$tab = isset($_GET['tab']) ? $_GET['tab'] : NULL;

		switch ($tab) {

		case 'pages':
			$file = 'pages.php';
			break;

		case 'shortcodes':
			$file = 'shortcodes.php';
			break;

		case 'token':
			$file = 'token.php';
			break;

		case 'customize':
		default:
			$file = 'customize.php';
			break;
		}

		require_once EXPL_MEMBERSHIP_PLUGIN_DIR . '/pages/admin/settings/' . $file;

	}
}
?>