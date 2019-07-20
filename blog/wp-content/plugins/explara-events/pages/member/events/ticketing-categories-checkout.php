<?php
$sub_total = 0;
$total = 0;
$qty = 0;
$results = \explara\ExpEventsDB::getEvent($event->event_id, 'event_id');

?>
<div class="tickets explara_checkout_holder explara-grid-container" id="explara-reset">
	<?php require_once 'includes/checkout-top.php';?>
	<div class="row">
		<div class="col-sm-8 col-xs-12">
			<div class="explara_selected_date pull-right">

			</div>
		</div>
		<div class="col-sm-4 col-xs-12">

		</div>
	</div>
	<?php if (!empty($event->tickets)) {?>
	<div class="row">
		<div class="col-sm-8 col-xs-12">
			<div class="form-lt">
				<?php require_once 'includes/checkout-category-steps.php';?>
			</div>
		</div>
		<div class="col-sm-4 col-xs-12">
			<?php require_once 'includes/checkout-pricing.php';?>
		</div>
	</div>
	<?php } else {?>
	<div class="row">
		<div class="col-sm-12 col-xs-12">
		</div>
	</div>
	<?php }?>
</div>