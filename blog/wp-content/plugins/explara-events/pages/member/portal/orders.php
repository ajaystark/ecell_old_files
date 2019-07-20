<?php $edit_current_url = "//" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];?>
<div class="explara_orders">
	<div class="row">
		<div class="col-sm-6 col-xs-12">
			<a href="#" class="explara_order_view list-icon" data-source="list" data-list="explara_orders_list" data-grid="explara_orders_grid">
				<i class="fa fa-bars" aria-hidden="true"></i>
			</a>
			<a href="#" class="explara_order_view" data-source="grid" data-list="explara_orders_list" data-grid="explara_orders_grid">
				<i class="fa fa-th-large" aria-hidden="true"></i>
			</a>
		</div>
		<div class="col-sm-6 col-xs-12">
			<div class="explara_auth_block exp_pull_right">
				<a href="" class="btn btn-explara-blue" id="explara_account_signout">
					SignOut
				</a>
			</div>
		</div>
	</div>
	<div class="explara_orders_list">
		<div class="row">
			<div class="col-sm-12">
				<div id="explara_table" class="table-responsive">
					<table>
						<thead>
							<tr>
								<th>Date of Purchase</th>
								<th>Event Name</th>
								<th>Ticket Number</th>
								<th>Order Status</th>
								<th>Amount</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($orders as $order) {?>
							<tr>
								<td><?php echo $order->details->orderDetails->datePurchased; ?></td>
								<td><a target="_blank" href="<?php echo $order->system_event_url; ?>">
									<?php echo $order->eventName; ?>
								</a></td>
								<td><?php echo $order->ticketNumber; ?></td>
								<td><?php echo $order->details->orderDetails->orderStatus; ?></td>
								<td><?php if (empty($order->price)) {?>
									Free
									<?php } else {?>
									<?php echo $order->details->orderDetails->paidAmount; ?>
								<?php }?></td>
								<td>
									<?php if ($order->allowCancel != 'no') {?>
									<a href="" class="explara_order_ticket_cancel explara_order_ticket_cancel_action" data-orderNo="<?php echo $order->orderNo; ?>" data-ticketNumber="<?php echo $order->ticketNumber; ?>">
										Cancel
									</a>
									<?php }?>
									<?php if ($order->allowTransfer != 'no') {?>
									<a target="_blank" class="explara_order_ticket_cancel" href="<?php echo $order->substitute_url; ?>">
										Edit
									</a>
									<?php }?>
								</td>
							</tr>
						</tbody>
						<?php }?>
					</table>
				</div>

			</div>
		</div>
	</div>
	<div class="explara_orders_grid" style="display:none">
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
									<!-- <span class="explara_print-btn">
										<a target="_blank" href="<?php echo EXPLARA_API_URL . 'em/ticket/confirmation/receipt/order/' . $order->orderNo; ?>">
											Print
										</a>
									</span> -->
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
</div>