<?php
include 'inc-menu-settings.php';

$type = isset($_GET['type']) ? $_GET['type'] : 'shortcodes';

?>
<div class="wrap redlof">
	<div id="account" class="tabcontent metabox-holder">

<?php

if ($type == 'events') {

	include_once "shortcodes-events.php";

} else {

	include_once "shortcodes-members.php";
}

?>

	</div>
</div>