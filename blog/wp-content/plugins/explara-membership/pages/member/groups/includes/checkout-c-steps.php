<div class="explara_checkout_steps explara_checkout_holder">
	<div class="">
		<ul class="nav nav-tabs  flex-grid exp-membership-form-tab ">
			<li class="col">
				<a href="#" class="exp_action_sources btn active exp_checkout_step_header" data-open="explara_checkout_plans_step" data-close="explara_checkout_tickets_attendee_step" id="explara_tickets_tabs">
					<span>1</span>
					Membership Plans
				</a>
			</li>
			<li class="col">
				<a href="#" class="exp_action_sources btn exp_checkout_step_header_account" id="explara_attendeeaccount_tabs">
					<span>2</span>Account Details
				</a>
			</li>
			<li class="col" style="display:none;" id="exp_member_attendee_step_source">
				<a href="#" class="exp_action_sources btn exp_checkout_step_header_attendee" id="explara_attendee_tabs">
					<span>3</span>Member Details
				</a>
			</li>
			<li class="col" style="display:none;" id="exp_member_final_step_source">
				<a href="#" class="exp_action_sources btn exp_checkout_step_header_confirm" id="explara_member_confirmation_tab">
					<span>4</span>Confirmation
				</a>
			</li>
		</ul>
	</div>
	<div id="explara_checkout_plans_step">
		<form name="explara_checkout" id="explara_checkout" method="post">
			<h2 class="text-center exp-membership-form-title">
				Select your membership plan
			</h2>
			<div class="">
				<div class="exp_member_content_block">
					<div class="panel-body common-membership-form table-responsive">
						<table class="table">
							<thead class="input-table">
								<tr>
									<th  width="20%">
										Name
									</th>
									<th  width="25%">
										Description
									</th>
									<th  width="20%" style="text-align:right;">
										Price (in <?php echo $currency; ?>)
									</th>
									<th  width="35%" class="text-right">
										No. of Members
									</th>
								</tr>
							</thead>
							<tbody class="input-table radio-custom">
								<?php foreach ($group->plans->plans as $plan) {
									?>
									<tr >
										<td width="20%">
											<label class="">
												<input id="plan_selected_id_value_<?php echo $plan->id; ?>" name="plan<?php echo $group->id; ?>" onchange="ExplaraMemberCheckout.handelPlanChange('<?php echo $group->id; ?>', '', this, '<?php echo $plan->id; ?>', '<?php echo $currency; ?>')" type="radio" data-set="false" class="explara_member_plan_input" data-id="<?php echo $plan->id; ?>" data-planid="<?php echo $plan->id; ?>" data-mainid="<?php echo $group->id; ?>">
												<?php echo $plan->name; ?>
											</label>
										</td>
										<td width="25%">
											<?php echo $plan->description; ?>
										</td>
										<td width="20%" style="text-align:right;">
											<?php if ($plan->price != 0) {
												echo $plan->currency . ' ';
												echo $plan->price;
											} else {
												echo 'Free';
											}?>
										</td>
										<td width="35%" class="text-right">
											<span class="exp-member-incrementor">
												<span>
													<button type="button" onclick="ExplaraMemberCheckout.decrValue('<?php echo $plan->maxQuantity; ?>', 'plan_selected_<?php echo $plan->id; ?>', '<?php echo $group->id; ?>', '<?php echo $plan->id; ?>', '<?php echo $currency; ?>')"><i class="fa fa-minus" aria-hidden="true"></i>
													</button>
												</span>
												<span>
													<input id="plan_selected_<?php echo $plan->id; ?>" value="0" min="0" type="number" class="exp_member_quantity" name="quantity">
												</span>
												<span>
													<button onclick="ExplaraMemberCheckout.incrVal('<?php echo $plan->maxQuantity; ?>', 'plan_selected_<?php echo $plan->id; ?>', '<?php echo $group->id; ?>', '<?php echo $plan->id; ?>', '<?php echo $currency; ?>')" type="button"><i class="fa fa-plus" aria-hidden="true"></i></button>
												</span>
											</span>
										</td>
									</tr>
									<?php }?>
								</tbody>
							</table>
							<div class="exrow">
								<div class="excol-5">
									<div class="explara_conference_summary exp_event_discount">
										<div class="expl-membership-discount">
											<p>
												Have a promo code? Apply to get a discount.
											</p>
											<div class="form-group">
												<input placeholder="Discount code" type="text" class="form-control exp_input" name="explara_member_discount_code" id="explara_member_discount_code">
												<button class="search-btn" type="button" onclick="ExplaraMemberCheckout.applyNormalDiscount('<?php echo $group->id; ?>')">Apply</button>
											</div>
										</div>
									</div>
								</div>
								<div class="excol-1">
									
								</div>
								<div class="excol-6">
									<div class="form-rt">
										<div class="price-chart">
											<ul class="list-unstyled">
												<li class="item-price clearfix">
													<span>
														Sub Total
													</span>
													<span class="pull-right">
														<span>
															<?php echo $currency; ?>
														</span>
														<span id="explara_member_subtotal_value">
															<?php echo $sub_total; ?>
														</span>
													</span>
												</li>
												<li class="item-price clearfix" id="explara_discounts" style="display: none">
												</li>
												<li class="item-price clearfix" id="explara_member_taxs" style="display: none">
												</li>
												<li class="item-price clearfix explara_member_discount_price" style="display: none">
													<span>
														Promo code discount
													</span>
													<span  class="pull-right">
														<span>
															<?php echo $currency; ?>
														</span>
														<span id="explara_member_discount_value">
														</span>
													</span>
												</li>
												<li class="item-price clearfix explara_member_procession_fee" style="display: none">
													<span>
														Processing Fee
													</span>
													<span  class="pull-right">
														<span>
															<?php echo $currency; ?>
														</span>
														<span id="explara_memver_procession_fee_value">
															<?php echo $pricessing_fee; ?>
														</span>
													</span>
												</li>
												<li>
													<hr>
												</li>
												<li class="final-amount">
													<span>
														TOTAL AMOUNT PAYABLE
													</span>
													<span class="pull-right">
														<span>
															<?php echo $currency; ?>
														</span>
														<span id="explara_member_total_amount">
															<?php echo $total; ?>
														</span>
													</span>
												</li>
											</ul>
										</div>
									</div>
								</div>
							</div>
							<div class="exrow">
								<div class="excol-4">
										<!-- <button onClick="ExplaraMemberCheckout.processCheckout()" type="button" class="expl-membership-blue-outline">
										Back
									</button> -->
								</div>
								<div class="excol-8">
									<button onClick="ExplaraMemberCheckout.processCheckout()" type="button" class="expl-membership-blue-btn explara_group_single_button pull-right">
										Next
									</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
		<div id="explara_checkout_plan_account_step" class="" style="display:none;">
			<div class="">
				<h2 class="text-center exp-membership-form-title">
					Enter your details
				</h2>
				<div class="exp_member_content_block">
					<div class="panel-body common-form">
						<div class="exp_checkout_account_details">
							<form class="explara_submit_plan_account_details" id="explara_submit_plan_account_details" name="explara_submit_plan_account_details">
								<div class="exrow">
									<div class="excol-4">
										<div class="expl-form-group">
											<label>
												Name
											</label>
											<input type="text" placeholder="Name" name="account_name" id="account_name" class="form-control" required>
										</div>
									</div>
									<div class="excol-4">
										<div class="expl-form-group">
											<label>
												Email
											</label>
											<input type="email" placeholder="Email" name="account_email" id="account_email" class="form-control" required>
										</div>
									</div>
									<div class="excol-4">
										<div class="expl-form-group">
											<label>
												Phone number
											</label>
											<input type="text" placeholder="Phone Number" name="account_phone" id="account_phone" class="form-control" required>
										</div>
										<button type="submit" name="submit_explara_account"  id="submit_explara_account" class="expl-membership-blue-btn explara_group_single_button exp-mem-float-rt">
											Proceed
										</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="explara_checkout_plan_attendee_step" class="" style="display:none;">
			<form name="explara_membership_attendee_forms" id="explara_membership_attendee_forms" method="post">
				<h2 class="text-center exp-membership-form-title">
					Enter the details for each member
				</h2>
				<div class="exp_member_content_block">
					<div class="panel-body common-form">
						<div class="non-member" id="explara_membership_attendee_list_holder"></div>
						<div class="row">
							<div class="col-sm-6 col-xs-12">
								<button  type="submit" id="explara_submit_attendee_details" class="expl-membership-blue-btn explara_group_single_button">
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
			</form>
		</div>
		<div id="explara_checkout_plans_confirm_step" class="" style="display:none;">
			<form name="explara_member_confirmation_forms" id="explara_member_confirmation_forms" method="post">
				<div class=" common-form">
					<div class="exrow">
						<div class="excol-12">
							<div class="form-submission-msg">
								<i class="fa fa-check-circle" aria-hidden="true"></i>
								<h3 id="explara_membership_checkout_confirm_message">
								</h3>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>