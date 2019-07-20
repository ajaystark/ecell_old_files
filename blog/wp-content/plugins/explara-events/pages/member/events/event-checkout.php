<?php
$sub_total = 0;
$total = 0;
$qty = 0;

?>
<div class="tickets explara_checkout_holder" id="explara-reset">
<?php require_once 'includes/checkout-top.php';?>
<?php if (!empty($event->tickets->tickets)) {?>
	<div class="row">
		<div class="col-sm-8 col-xs-12">
			<div class="form-lt">

				<?php require_once 'includes/checkout-steps.php';?>

			</div>
		</div>
		<div class="col-sm-4 col-xs-12">
			<?php require_once 'includes/checkout-pricing.php';?>
		</div>
	</div>
<?php } else {
	?>

	<div class="row">
		<div class="col-sm-12 col-xs-12">
			<h4>
				This feature is in under development
			</h4>
		</div>
	</div>

<?php }?>

</div>