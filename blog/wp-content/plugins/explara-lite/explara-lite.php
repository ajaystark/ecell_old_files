<?php
/*
Plugin Name: Explara Lite
Plugin URI: https://in.explara.com
Description: Easily integrate Explara Groups, Members & Events into your website using Shortcodes.
Author: Explara
Version: 0.1.2
Author URI: https://in.explara.com/
License: GPL v1

Explara Events Plugin
Copyright (C) 2018, Explara -

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.
See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
/**
 * @package Main
 */

if (version_compare(PHP_VERSION, '5.6', '<')) {
	if (is_admin() && (!defined('DOING_AJAX') || !DOING_AJAX)) {
		require_once ABSPATH . 'wp-admin/includes/plugin.php';
		deactivate_plugins(__FILE__);
		wp_die(sprintf(__('Explara Events requires PHP 5.6 or higher, as does WordPress 4.6 and higher. The plugin has now disabled itself.', 'Explara Events'), '<a href="http://wordpress.org/">', '</a>'));
	} else {
		return;
	}
}

if (!defined('EXPL_LITE_PATH')) {
	define('EXPL_LITE_PATH', plugin_dir_path(__FILE__));
}

if (!defined('EXPL_LITE_BASENAME')) {
	define('EXPL_LITE_BASENAME', plugin_basename(__FILE__));
}

if (!defined('EXPL_LITE_VERSION')) {
	define('EXPL_LITE_VERSION', '0.1.0');
}

if (!defined('EXPL_PLUGIN_DIR')) {
	define('EXPL_PLUGIN_DIR', dirname(__FILE__));
}

if (!defined('EXPL_PLUGIN_URL')) {
	define('EXPL_PLUGIN_URL', plugin_dir_url(__FILE__));
}

if (!defined('EXPLARA_API_URL')) {
	define('EXPLARA_API_URL', "https://in.explara.com/");
}

require_once EXPL_PLUGIN_DIR . '/includes/install/explara-install.php';
require_once EXPL_PLUGIN_DIR . '/includes/classes/helper-functions.php';
require_once EXPL_PLUGIN_DIR . '/includes/admin/explara-admin.php';
require_once EXPL_PLUGIN_DIR . '/includes/member/explara-member.php';

register_activation_hook(__FILE__, array('ExplaraLite_Install', 'activate'));
register_deactivation_hook(__FILE__, array('ExplaraLite_Install', 'deactivate'));
register_uninstall_hook(__FILE__, array('ExplaraLite_Install', 'delete'));

add_action('init', function () {

	if (is_admin()) {

		$AdminObj = explara\ExpAdmin::get_instance();
		$AdminObj->init();
	}

	$MemberObj = explara\ExpMember::get_instance();
	$MemberObj->init();

});
