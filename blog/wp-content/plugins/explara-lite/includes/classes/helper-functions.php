<?php

function sample_admin_notice__success() {
	?>
    <div class="notice notice-error">
        <p>
        	<b>Explara Access Token not found.</b>
        	Please update the token for the plugin to work.
        	<a href="<?php echo admin_url('admin.php?page=explara-lite&tab=token'); ?>" class="pull-right">Update</a>
        </p>

    </div>
    <?php
}

function explara_redirect($url) {

	if (headers_sent()) {
		die('<script type="text/javascript">window.location.href="' . $url . '";</script>');
	} else {
		header('Location: ' . $url);
		die();
	}
}

function checkIfEndDateLessThenToday($endDate) {
	date_default_timezone_set('Asia/Kolkata');

	$endDate = new DateTime($endDate);
	$Now = new DateTime('now');

	if ($endDate < $Now) {
		return true;
	}

	return false;
}

function includeShortcodeFile($filename, $data) {

	ob_start();

	require EXPL_PLUGIN_DIR . "/pages/member/" . $filename;

	$template_html = ob_get_clean();

	return $template_html;
}

function addUpdateOption($option_name, $new_value) {

	if (get_option($option_name) !== false) {

		// The option already exists, so we just update it.
		update_option($option_name, $new_value);

	} else {

		// The option hasn't been added yet. We'll add it with $autoload set to 'no'.
		$deprecated = null;
		$autoload = 'no';
		add_option($option_name, $new_value, $deprecated, $autoload);
	}

	return true;
}