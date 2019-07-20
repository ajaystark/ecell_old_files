<?php
namespace explara;

class ExpMember {

	protected static $instance = null;

	public static function get_instance() {
		// create an object
		NULL === self::$instance and self::$instance = new self();

		return self::$instance;
	}

	public function init() {

		$this->fileInlcudes();

		$this->memberScriptStyles();
	}

	public function fileInlcudes() {

		require_once EXPL_PLUGIN_DIR . '/includes/member/explara-member-api.php';

		require_once EXPL_PLUGIN_DIR . '/includes/member/explara-shortcodes-events.php';
		require_once EXPL_PLUGIN_DIR . '/includes/member/explara-shortcodes-members.php';

	}

	public function memberScriptStyles() {

		wp_enqueue_style('exp-css', EXPL_PLUGIN_URL . 'public/css/member.css', array(), EXPL_LITE_VERSION, 'all');
	}
}
?>
