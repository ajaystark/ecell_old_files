<div class="explara_orders expl-membership-common">
	<div class="explara_orders">
		<div class="row">
			<div class="col-sm-6 col-xs-12">
				<a href="#" class="exp_selected_link explara_order_member_both_view list-icon exp_portal_link" data-source="group" data-group="explara_group_orders" data-event="explara_event_orders">
					Groups
				</a>
				<?php if ($is_exp_event_active) {?>
				<a href="#" class="explara_order_member_both_view exp_portal_link" data-source="event"  data-group="explara_group_orders" data-event="explara_event_orders">
					Events
				</a>
				<?php }?>
			</div>
			<div class="col-sm-6 col-xs-12">
				<div class="explara_auth_block exp_pull_right">
					<a href="" class="btn btn-explara-blue" id="explara_account_signout">
						SignOut
					</a>
				</div>
			</div>
		</div>
		<div class="explara_group_orders expl-membership-sec-spacing" >
			<div class="row">
				<?php foreach ($group_orders as $order) {
	?>
				<div class="col-sm-4 col-xs-12">
					<a target="_blank" href="<?php echo $order->renewLink; ?>" class="expl-membership-event-card">
						<header  style="background-image: url('<?php echo $order->Group->listingImage; ?>')">
						</header>
						<article>
							<h6>
							<?php echo date("d M Y", strtotime($order->createdOn->date)); ?>
							</h6>
							<h2>
							<?php if (!empty($order->Group)) {
		echo $order->Group->name;
	}?>
							</h2>
							<p>
								<?php echo $order->orderNo; ?>
							</p>
							<p>
								<i class="fa fa-user" aria-hidden="true"></i> 13 Members
							</p>
						</article>
					</a>
				</div>
				<?php }?>
			</div>
		</div>

		<?php if ($is_exp_event_active) {?>
		<div class="explara_event_orders" style="display:none">
			<div class="row">
				<?php foreach ($orders as $order) {?>
				<div class="col-sm-4">
					<div class="explara_grid-event-card" style="background-image:url(<?php echo $order->single_event->list_dump->listingImage; ?>">
						<div class="bg-overlay">
						</div>
						<ul>
							<li>
								<div class="explara_event-card_setting">
									<p>
										<span>
											<?php echo $order->details->orderDetails->orderStatus; ?>
											<?php if (empty($order->price)) {?>
											Free
											<?php } else {?>
											<?php echo $order->details->orderDetails->paidAmount; ?>
											<?php }?>
										</span>
									</p>
								</div>
								<div class="explara_event-card_content">
									<h2 class="explara_event-name">
									<a target="_blank" href="<?php echo $order->system_event_url; ?>">
										<?php echo $order->eventName; ?>
									</a>
									</h2>
									<h6>
									<?php echo $order->details->orderDetails->datePurchased; ?>
									</h6>
								</div>
								<div class="explara_order-detail-id">
									<p>
										<?php echo $order->orderNo; ?>
									</p>
								</div>
							</li>
						</ul>
					</div>
				</div>
				<?php }?>
			</div>
		</div>
		<?php }?>
	</div>