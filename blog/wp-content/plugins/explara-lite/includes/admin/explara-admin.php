<?php
namespace explara;

class ExpAdmin {

	protected static $instance = null;

	public static function get_instance() {
		// create an object
		NULL === self::$instance and self::$instance = new self();

		return self::$instance;
	}

	public function init() {

		$this->fileInlcudes();

		$this->adminScriptStyles();

		$this->checkToken();

		add_action('admin_menu', array($this, 'menuItems'));
	}

	public function checkToken() {

		if (!get_option('explara_lite_access_token', NULL)) {
			add_action('admin_notices', 'sample_admin_notice__success');
		}
	}

	public function fileInlcudes() {

		require_once EXPL_PLUGIN_DIR . '/includes/admin/explara-admin-api.php';
		require_once EXPL_PLUGIN_DIR . '/includes/admin/explara-admin-post.php';
		require_once EXPL_PLUGIN_DIR . '/includes/classes/shortcode-generator.php';
		require_once EXPL_PLUGIN_DIR . '/includes/classes/shortcode-store.php';

	}

	public function menuItems() {

		add_action('admin_enqueue_scripts', array($this, 'adminScriptStyles'));

		add_menu_page('Explara Lite', 'Explara Lite', 'manage_options', 'explara-lite', array($this, 'pagePlugins'), 'dashicons-tickets-alt');
	}

	public function adminScriptStyles() {

		if (is_admin()) {
			wp_enqueue_media();
			wp_enqueue_script('exp-ajax-request', EXPL_PLUGIN_URL . 'public/js/min/admin-min.js', array('jquery'), false, true);
			wp_localize_script('exp-ajax-request', 'EXPAjax', array('ajaxurl' => plugins_url('admin-ajax.php')));

			wp_enqueue_style('exp-css', EXPL_PLUGIN_URL . 'public/css/admin.css', array(), EXPL_LITE_VERSION, 'all');
		}
	}

	public function pagePlugins() {

		$tab = isset($_GET['tab']) ? $_GET['tab'] : NULL;

		switch ($tab) {

		case 'settings':
			$file = 'settings.php';
			break;

		case 'shortcodes-create':
			$file = 'shortcodes-create.php';
			break;

		case 'shortcodes':
		default:
			$file = 'shortcodes.php';
			break;
		}

		require_once EXPL_PLUGIN_DIR . '/pages/admin/' . $file;

	}
}
?>
