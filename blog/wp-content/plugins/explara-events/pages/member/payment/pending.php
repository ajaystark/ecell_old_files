<?php
$order = \explara\ExplaraMemberApi::getOrder($_GET['order']);
$event = \explara\ExpEventsDB::getEvent($order->orderDetails->eventId, 'event_id');

?>

<div class="">
	<div class="explara-payment-container">
		<div class="row">
			<div class="col-sm-12 col-xs-12">
				<div class="explara-payment">
					<h2 class="text-center">
					Your payment is in pending state
					</h2>
				</div>
			</div>
		</div>
	</div>

</div>