<?php
$sub_total = 0;
$total = 0;
$qty = 0;
$currency = '$';

if ($group->baseCurrency == 'INR') {
	$currency = '₹';
}

?>
<div class="tickets explara-group-single explara_checkout_holder explara_group_single_card_style" id="explara-reset">
<?php require_once 'includes/checkout-top.php';?>

	<div class="row">
		<div class="col-sm-12 col-xs-12">
			<div class="form-lt">

				<?php require_once 'includes/checkout-c-steps.php';?>

			</div>
		</div>
	</div>

</div>