<?php
$sub_total = 0;
$total = 0;
$qty = 0;
$results = \explara\ExplaraMemberCheckout::getMultiDateDetailsFromUrl($event->event_id);
unset($event->tickets);
$event->tickets = $results[1]->tickets;
?>
<div class="tickets explara_checkout_holder explara-grid-container" id="explara-reset">
	<?php require_once 'includes/checkout-top.php';?>
	<div class="row">
		<div class="col-sm-8 col-xs-12">
			<div class="explara_selected_date pull-right">
				<span>
					Selected Date
				</span>
				<select name="explara_selected_date" id="explara_selected_date" onchange="ExplaraCheckout.handelDateChange()">
					<?php foreach ($results[0] as $key => $dateObject) {?>
					<option <?php echo ($key == $_GET['date'] ? 'selected' : ''); ?> value="<?php echo $key; ?>">
						<?php echo $key; ?>
					</option>
					<?php }?>
				</select>
			</div>
		</div>
		<div class="col-sm-4 col-xs-12">

		</div>
	</div>
	<?php if (!empty($event->tickets)) {?>
	<div class="row">
		<div class="col-sm-8 col-xs-12">
			<div class="form-lt">
				<?php require_once 'includes/checkout-session-steps.php';?>
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