<?php

function sample_member_admin_notice__success() {
	?>
    <div class="notice notice-error clearfix">
        <p>
        	<b>Explara Membership Access Token not found.</b>
        	<br>
        	Please update the token for the plugin to work.
        	<a href="<?php echo admin_url('admin.php?page=explara-membership-settings&tab=token'); ?>" class="pull-right">Update</a>
        </p>

    </div>
    <?php
}

function explara_member_redirect($url) {

	if (headers_sent()) {
		die('<script type="text/javascript">window.location.href="' . $url . '";</script>');
	} else {
		header('Location: ' . $url);
		die();
	}
}

function memberCheckIfEndDateLessThenToday($endDate) {
	date_default_timezone_set('Asia/Kolkata');

	$endDate = new DateTime($endDate);
	$Now = new DateTime('now');

	if ($endDate < $Now) {
		return true;
	}

	return false;
}