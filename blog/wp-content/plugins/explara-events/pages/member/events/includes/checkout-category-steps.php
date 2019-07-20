<div class="explara_checkout_steps" id="explara_checkout_form">
	<div id="explara_checkout_tickets_step">
		<form name="explara_checkout" id="explara_checkout" method="post">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h5 class="panel-title">
					<a href="#" class="form-header header-step exp_checkout_step_header" data-open="explara_checkout_tickets_step" data-close="explara_checkout_tickets_attendee_step" id="explara_tickets_tabs">
						<span>
							1.
						</span>
						Choose your ticket
					</a>
					</h5>
				</div>
				<div class="exp_show_element exp_content_block">
					<div class="panel-body common-form ">
						<div class="row">
							<div class="col-sm-3 col-xs-12 exp_category_checkout_side">
								<ul>
									<?php foreach ($event->tickets->category as $key => $value) {?>
									<li onClick="ExplaraCheckout.showCategoryCheckout( '<?php echo $value->id; ?>', '<?php echo $value->name; ?>')" id="cat_<?php echo $value->id; ?>" class="<?php echo $key == 0 ? 'exp_active_list' : '' ?>">
										<span class="exp_pointer explara_category_action" id="<?php echo $value->id; ?>">
											<?php echo $value->name; ?>
										</span>
									</li>
									<?php }?>
								</ul>
							</div>
							<div class="col-sm-9 col-xs-12">
								<div class="explara_category_events_tab_content">
									<?php foreach ($event->tickets->category as $key => $value) {
	?>
									<div  class="<?php echo $key == 0 ? 'exp_active' : 'exp_hide_class' ?> " id="explara_tickets_<?php echo $value->id; ?>">
										<?php foreach ($value->tickets as $ticket) {
		$dateCompanre = checkIfEndDateLessThenToday($ticket->endDate . " " . $ticket->endTime);
		if ($dateCompanre == true) {
			continue;
		}
		?>
										<div class="row">
											<div class="col-sm-6 col-xs-12">
												<div class="form-group">
													<h3>
													<?php echo $ticket->name; ?>
													</h3>
													<p>
														Ticket sale ends by <?php echo date("h:i A", strtotime($ticket->endTime)); ?>, <?php echo date("d M, Y", strtotime($ticket->endDate)); ?>
													</p>
												</div>
											</div>
											<div class="col-sm-6 col-xs-12">
												<div class="option pull-right form-group">
													<p>
														<?php echo $ticket->currency; ?> <?php echo $ticket->price; ?> X
														<select class="explara_ticket_quantities" id="<?php echo $ticket->id; ?>" name="quantity" onChange="ExplaraCheckout.handelQuantityChange('<?php echo $event->event_id; ?>', '<?php echo $ticket->id; ?>', '<?php echo $ticket->currency; ?>')">
															<?php for ($i = 0; $i <= $ticket->maxQuantity; $i++) {?>
															<option value="<?php echo $i; ?>">
																<?php echo $i; ?>
															</option>
															<?php }?>
														</select>
													</p>
												</div>
											</div>
										</div>
										<?php }?>
									</div>
									<?php }?>
								</div>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-sm-6 col-xs-12">
								<button onClick="ExplaraCheckout.processCheckout()" type="button" id="explara_submit_ticket_details" class="btn btn-explara-blue">
								Proceed
								</button>
							</div>
							<div class="col-sm-6 col-xs-12">
								<div class="explara_conference_summary exp_event_discount">
									<div class="exp_coupon_wrapper">
										<input placeholder="Discount code" type="text" class="form-control exp_input" name="explara_discount_code" id="explara_discount_code">
										<button class="btn btn_apply btn-explara-blue" type="button" onclick="ExplaraCheckout.applyNormalDiscount('<?php echo $event->event_id; ?>')">Apply</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
	<div id="explara_checkout_tickets_attendee_step" class="">
		<form name="explara_attendee_forms" id="explara_attendee_forms" method="post">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h5 class="panel-title">
					<a href="#" class="form-header header-step exp_checkout_step_header_attendee" id="explara_attendee_tabs">
						<span>
							2.
						</span>
						Attendee details
					</a>
					</h5>
				</div>
				<div class="exp_hide_element exp_content_block">
					<div class="panel-body common-form">
						<div class="non-member" id="explara_attendee_list_holder"></div>
						<div class="row">
							<div class="col-sm-6 col-xs-12">
								<button  type="submit" id="explara_submit_ticket_details" class="btn btn-explara-blue">
								Proceed
								</button>
							</div>
							<div class="col-sm-6 col-xs-12">
								<div class="text-right discount-val">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>