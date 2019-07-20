<?php
$sub_total = 0;
$total = 0;
$qty = 0;
$results = \explara\ExplaraMemberCheckout::getConferenceSession($event->event_id);
?>
<div class="tickets explara_checkout_holder explara-grid-container">
	<?php require_once 'includes/checkout-top.php';?>
	<?php require_once 'includes/event-conference-checkout-session.php';?>
</div>