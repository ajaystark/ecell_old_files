
<?php
$order = \explara\ExplaraMemberApi::getOrder($_GET['order']);

$event = \explara\ExpEventsDB::getEvent($order->orderDetails->eventId, 'event_id');

?>

<div class="container-fluid">
	<div class="explara-payment-container">
		<div class="row">
			<div class="col-sm-12 col-xs-12">
				<div class="explara-payment">
					<h2>
					Congratulations! Your booking was successful.
					</h2>

				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6 col-xs-12">
				<h4>
				Your ticket information
				</h4>
				<div class="explara-ticket-card">
					<h2>
						<?php echo $order->orderDetails->eventName; ?>
					</h2>
					<p>
						<?php echo $event->start_fmt_date; ?> <?php echo $event->start_fmt_time; ?> - <?php echo $event->end_fmt_date; ?> <?php echo $event->end_fmt_time; ?>
					</p>
					<div class="address">
						<?php if (isset($event->list_dump->address)) {?>
						<?php echo $event->list_dump->address; ?>
						<?php }?>
					</div>
				</div>
				<div class="" id="explara-social-share">
					<h3>
						Share this event on
					</h3>
					<ul class="list-unstyled list-inline">
						<li>
							<a class="twitter-share-button" target="_blank" data-url="<?php echo $event->complete_link; ?>" href="https://twitter.com/share" data-hashtags="explara" data-via="explara" data-text="<?php echo $order->orderDetails->eventName; ?>">
								<span>
									<i class="fa fa-twitter" aria-hidden="true"></i>
								</span>
								Twitter
							</a>

						</li>
						<li>
							<a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $event->complete_link; ?>&t=<?php echo $order->orderDetails->eventName; ?>" class="fb">
								<span>
									<i class="fa fa-facebook" aria-hidden="true"></i>
								</span>
								Facebook
							</a>
						</li>
						<li>

							<div class="g-plus" data-action="share" data-height="20" data-href="<?php echo $event->complete_link; ?>"></div>
						</li>
					</ul>
				</div>
				<div>
					<p class="explara-thankyou-msg">
						You can further look for more events from our events page.
					</p>
				</div>
			</div>
			<div class="col-sm-6 col-xs-12">
				<img src="<?php echo plugins_url('explara-events/public/img/explara-payment-successful.svg'); ?>" class="img-responsive" alt=" explara-404-msg">
			</div>
		</div>
	</div>

</div>


<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>

<!-- Place this tag in your head or just before your close body tag. -->
<script src="https://apis.google.com/js/platform.js" async defer></script>
