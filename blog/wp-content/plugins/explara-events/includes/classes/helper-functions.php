<?php

function sample_admin_notice__success() {
	?>
    <div class="notice notice-error">
        <p>
        	<b>Explara Events Access Token not found.</b>
        	Please update the token for the plugin to work.
        	<a href="<?php echo admin_url('admin.php?page=explara-events-settings&tab=token'); ?>" class="pull-right">Update</a>
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