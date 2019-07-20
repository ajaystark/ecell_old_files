<div class="row">
	<div class="col-sm-12 col-xs-12">
		<div class="form-lt" id="explara-reset">
			<div class=" ">
				<div class="explara_selected_attendee_count">
					<div class="exp_multi_heading">
						<h5 class="panel-title">
						<a href="#" class="form-header header-step exp_checkout_step_header" data-open="explara_checkout_tickets_step" data-close="explara_checkout_tickets_attendee_step" id="explara_tickets_tabs">
							CHOOSE YOUR SESSIONS
						</a>
						</h5>
						<div class="multi_form_header">
							<div class="row">
								<div class="col-sm-6 col-xs-12">
									<p>
										Select Number of Attendee
									</p>
								</div>
								<div class="col-sm-6 col-xs-12">
									<div class="pull-right select_attendee">
										<select name="explara_selected_attendee_count" id="explara_selected_attendee_count" onchange="ExplaraCheckout.handelConferenceCheckoutSession('<?php echo $event->event_id; ?>', '', this)">
											<option value="01">01</option>
											<option value="02">02</option>
											<option value="03">03</option>
											<option value="04">04</option>
											<option value="05">05</option>
											<option value="06">06</option>
											<option value="07">07</option>
											<option value="08">08</option>
											<option value="09">09</option>
											<option value="10">10</option>
											<option value="11">11</option>
											<option value="12">12</option>
											<option value="13">13</option>
											<option value="14">14</option>
											<option value="15">15</option>
											<option value="16">16</option>
											<option value="17">17</option>
											<option value="18">18</option>
											<option value="19">19</option>
											<option value="20">20</option>
											<option value="21">21</option>
											<option value="22">22</option>
											<option value="23">23</option>
											<option value="24">24</option>
											<option value="25">25</option>
										</select>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php if (!empty($results->session)) {
	?>
				<?php foreach ($results->session as $sessionObject) {
		?>
				<div class="explara_conference_checkout_card exp_form common-form" id="explara_session_block<?php echo $sessionObject->id; ?>">
					<div class="header-form-multi">
						<div class="row">
							<div class="col-sm-6 col-xs-12">
								<h2>
								<?php echo $sessionObject->date; ?>
								</h2>
							</div>
							<div class="col-sm-6 col-xs-12">
								<button type="button" class="btn pull-right" onclick="ExplaraCheckout.resetConferenceSession('explara_session_block<?php echo $sessionObject->id; ?>', '<?php echo $event->event_id; ?>')">Reset
								</button>
							</div>
						</div>
					</div>
					<?php foreach ($sessionObject->session as $datekey => $innsession) {
			?>
					<div class="exp-multi-content_list">
						<div class="row">
							<div class="col-sm-4 col-xs-12">
								<?php echo $datekey; ?>
							</div>
							<div class="col-sm-4 col-xs-12">
								<?php foreach ($innsession as $key => $lastsession) {
				?>
								<div class="multi_session rounded-radio">
									<label>
										<?php
$namevalue = str_replace(' ', '', $lastsession->id . $lastsession->startTime);

				?>

										<input name="session_<?php echo $namevalue; ?>" onchange="ExplaraCheckout.handelConferenceCheckoutSession('<?php echo $event->event_id; ?>', '', this)" type="radio" data-set="false" class="explara_conference_sesssion_input" name="session_<?php echo $lastsession->id; ?>" data-id="<?php echo $lastsession->id; ?>" data-ticketid="<?php echo $lastsession->ticketTypeId; ?>" data-mainid="<?php echo $sessionObject->id; ?>">
										<?php echo $lastsession->name; ?>
										<div class="exp-multi-content_list_hidden" style="display:none">
											<div class="row">
												<div class="col-sm-4 col-xs-12">
													<?php echo $datekey; ?>
												</div>
												<div class="col-sm-4 col-xs-12">
													<div class="multi_session rounded-radio">
														<label>
															<?php echo $lastsession->name; ?>
														</label>
														<p class="">
															<?php echo $lastsession->startTime; ?> - <?php echo $lastsession->endTime; ?>
														</p>
													</div>
												</div>
												<div class="col-sm-4 col-xs-12">
													<p class="pull-right price_multi">
														<span class="explara_summary_count_showcase">1</span> X <?php echo $lastsession->currency; ?> &nbsp; <?php echo $lastsession->price; ?>
													</p>
												</div>
											</div>
										</div>
									</label>
									<p class="">
										<?php echo $lastsession->startTime; ?> - <?php echo $lastsession->endTime; ?>
									</p>
								</div>
								<?php }?>
							</div>
							<div class="col-sm-4 col-xs-12">
								<p class="pull-right price_multi">
									<?php echo $lastsession->currency; ?> &nbsp; <?php echo $lastsession->price; ?>
								</p>
							</div>
						</div>
					</div>
					<?php }?>
				</div>
				<?php }?>
				<?php } else {?>
				<h3>
				All sessions are expired.
				</h3>
				<?php }?>
				<?php if (!empty($results->session)) {?>
				<div class="explara_selected_attendee_count">
					<div class="exp_multi_heading">
						<h5 class="panel-title">
						<a href="#" class="form-header header-step exp_checkout_step_header" data-open="explara_checkout_tickets_step" data-close="explara_checkout_tickets_attendee_step" id="explara_tickets_tabs">
							SUMMARY
						</a>
						</h5>
						<div class="multi_form_header explara_conference_checkout_card exp_form common-form">
							<div class="row">
								<div class="col-sm-12 col-xs-12">
									<div class="explara_conference_summary_block">
										<p>
											No Session is selected
										</p>
									</div>
									<div class="row">
										<div class="col-sm-6 col-xs-12">
											<div class="explara_conference_summary exp_event_discount">
												<label>
													Discount code
												</label>
												<div class="exp_coupon_wrapper">
													<input type="text" class="form-control exp_input" name="explara_discount_code" id="explara_discount_code">
													<button class="btn btn_apply btn-explara-blue" type="button" onclick="ExplaraCheckout.applyDiscount('<?php echo $event->event_id; ?>')">Apply</button>
												</div>
											</div>
										</div>
										<div class="col-sm-6 col-xs-12">
											<div class="form-rt">
												<div class="price-chart">
													<ul class="list-unstyled">
														<li class="item-price clearfix">
															<span>
																Sub Total
															</span>
															<span class="pull-right">
																<span>
																	<?php echo $event->details_dump->events->currency; ?>
																</span>
																<span id="explara_subtotal_value">
																	<?php echo $sub_total; ?>
																</span>
															</span>
														</li>
														<li class="item-price clearfix" id="explara_discounts" style="display: none">
														</li>
														<li class="item-price clearfix" id="explara_taxs" style="display: none">
														</li>
														<li class="item-price clearfix explara_discount_price" style="display: none">
															<span>
																Discount
															</span>
															<span  class="pull-right">
																<span>
																	<?php echo $event->details_dump->events->currency; ?>
																</span>
																<span id="explara_discount_value">
																</span>
															</span>
														</li>
														<li class="item-price clearfix explara_procession_fee" style="display: none">
															<span>
																Processing Fee
															</span>
															<span  class="pull-right">
																<span>
																	<?php echo $event->details_dump->events->currency; ?>
																</span>
																<span id="explara_procession_fee_value">
																	<?php echo $pricessing_fee; ?>
																</span>
															</span>
														</li>
														<li>
															<hr>
														</li>
														<li class="final-amount">
															<span>
																Total
															</span>
															<span class="pull-right">
																<span>
																	<?php echo $event->details_dump->events->currency; ?>
																</span>
																<span id="explara_total_amount">
																	<?php echo $total; ?>
																</span>
															</span>
														</li>
													</ul>
												</div>
												<?php if (!empty($results->session)) {?>
												<div class="exp_payment_checkout pull-right">
													<button id="explara_conference_action" style="" type="button" class="btn btn-explara-blue" onclick="ExplaraCheckout.generateConferenceOrder('<?php echo $event->event_id; ?>')">
													Proceed
													</button>
												</div>
												<?php }?>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div id="explara_checkout_tickets_attendee_step" class="">
					<form name="explara_attendee_forms" id="explara_attendee_forms" method="post">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h5 class="panel-title">
								<a href="#" class="form-header header-step exp_checkout_step_header_attendee" id="explara_attendee_tabs">
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
				<?php }?>
			</div>
		</div>
	</div>
</div>