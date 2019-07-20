<?php
namespace explara;

class ExpAdmin {
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
			add_action('admin_notices', 'sample_admin_notice__success');
		}
	}

	public function fileInlcudes() {
		require_once EXPL_PLUGIN_DIR . '/includes/admin/explara-admin-api.php';
		require_once EXPL_PLUGIN_DIR . '/includes/classes/explara-settings.php';
		require_once EXPL_PLUGIN_DIR . '/includes/admin/explara-admin-post.php';
		require_once EXPL_PLUGIN_DIR . '/includes/admin/admin-events.php';
		require_once EXPL_PLUGIN_DIR . '/includes/admin/admin-events-listtable.php';
		require_once EXPL_PLUGIN_DIR . '/includes/classes/explara-events-db.php';
	}

	public function menuItems() {

		add_action('admin_enqueue_scripts', array($this, 'adminScriptStyles'));

		add_menu_page('Explara Events', 'Explara Events', 'manage_options', 'explara-events', array($this, 'pageEvents'), 'dashicons-admin-post');

		add_submenu_page('explara-events', 'Events', 'Events', 'manage_options', 'explara-events', array($this, 'pageEvents'));

		add_submenu_page('explara-events', 'Settings', 'Settings', 'manage_options', 'explara-events-settings', array($this, 'pageSettings'));
	}

	public function adminScriptStyles() {

		if (is_admin()) {
			wp_enqueue_media();
			wp_enqueue_script('exp-ajax-request', EXPL_PLUGIN_URL . 'public/js/min/admin-min.js', array('jquery'), false, true);
			wp_localize_script('exp-ajax-request', 'EXPAjax', array('ajaxurl' => plugins_url('admin-ajax.php')));

			wp_enqueue_style('exp-css', EXPL_PLUGIN_URL . 'public/css/admin.css', array(), EXPL_EVENTS_VERSION, 'all');
		}
	}

	public function pageEvents() {
		$event_id = isset($_GET['event_id']) ? $_GET['event_id'] : NULL;

		if (!empty($event_id)) {
			require_once EXPL_PLUGIN_DIR . '/pages/admin/admin-single-event.php';
		} else {
			require_once EXPL_PLUGIN_DIR . '/pages/admin/admin-events.php';
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

		require_once EXPL_PLUGIN_DIR . '/pages/admin/settings/' . $file;

	}
}
?>