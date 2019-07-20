
<?php
$order = \explara\ExplaraMemberAuthApi::getOrder($_GET['order']);
$order = $order->orderDetails;
$GroupPage = get_option('explara_membership_page');
$complete_link = get_permalink($GroupPage);

?>

<div class="container">
	<div class="explara-payment-container">
		<div class="row">
			<div class="col-sm-12 col-xs-12">
				<div class="explara-payment">
					<h2 class="text-center">
					Your payment has been failed
					</h2>
				</div>
			</div>
		</div>
	</div>

</div>