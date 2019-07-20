<?php
$order = \explara\ExplaraMemberAuthApi::getOrder($_GET['order']);
$order = $order->orderDetails;
$GroupPage = get_option('explara_membership_page');
$complete_link = get_permalink($GroupPage);

?>
<!-- Place this tag in your head or just before your close body tag. -->
<script src="https://apis.google.com/js/platform.js" async defer></script>

<div class="row">
	<div class="col-sm-12 col-xs-12">
		<div class="" id="expl-membership-payment-success">
			<div class="text-center">
				<i class="fa fa-check-circle check" aria-hidden="true"></i>
				<h2>
					Congratulations! Your payment is successful.
				</h2>
				<P>
					<a href="<?php echo $complete_link; ?>" style="text-decoration:none">
						You are now a member of the group : <span class="text-uppercase"><?php echo $order->Group->name; ?></span>
					</a>
				</P>
				<!-- <ul class="list-unstyled list-inline">
					<li>
						<a href="" class="btn-outline-checkin">
							<i class="fa fa-reply" aria-hidden="true"></i>Go back to group
						</a>
					</li>
					<li>
						<a href="" class="btn-outline-checkin">
							<i class="fa fa-envelope" aria-hidden="true"></i> Email this to
						</a>
					</li>
					<li>
						<a href="" class="btn-outline-checkin">
							<i class="fa fa-print" aria-hidden="true"></i>
							Print Receipt
						</a>
					</li>
				</ul> -->
			</div>
			<hr>
			<div class="row">
			<!-- 	<div class="col-sm-7 col-xs-12">

					<div class="form-group expl-form-group">
						<label>
							How would you rate your experience with Explara.com?
						</label>
						<textarea class="form-control" placeholder="Write your feedback" rows="4" cols="50"></textarea>
					</div>
					<button type="submit" class="expl-membership-blue-btn">Submit Feedback</button>
				</div>
				<div class="col-sm-1 col-xs-12">

				</div> -->
				<div class="col-sm-12 col-xs-12">
					<div class="text-center">
						<p>
							Groups are always better with friends. Share.
						</p>
						<ul class="list-unstyled list-inline share-group-of-mmbership">
							<li>
								<a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $complete_link; ?>&t=<?php echo $order->Group->name; ?>" class="fb">
									<i class="fa fa-facebook" aria-hidden="true"></i> Facebook
								</a>
							</li>
							<li>
								<a class="  twitter-share-button" target="_blank" data-url="<?php echo $complete_link; ?>" href="https://twitter.com/share" data-hashtags="explara" data-via="explara" data-text="<?php echo $order->Group->name; ?>">
									<i class="fa fa-twitter" aria-hidden="true"></i>
								</a>
							</li>
							<li>
							<!-- <a href="" class="gplus">
								<i class="fa fa-google-plus" aria-hidden="true"></i>
							</a> -->

							<div class="" data-action="share" data-height="20" data-href="<?php echo $complete_link; ?>"></div>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
</div>

<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>


