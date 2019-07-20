<div class="explara_checkout_steps explara_checkout_holder">
	<div id="explara_checkout_plans_step">
		<form name="explara_checkout" id="explara_checkout" method="post">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h5 class="panel-title">
					<a href="#" class="form-header header-step exp_checkout_step_header" data-open="explara_checkout_plans_step" data-close="explara_checkout_tickets_attendee_step" id="explara_tickets_tabs">
						<span>
							1.
						</span>
						Please Choose Membership Type
					</a>
					</h5>
				</div>
				<div class="exp_show_element exp_member_content_block">
					<div class="panel-body common-form">
						<?php foreach ($group->plans->plans as $plan) {
	?>
						<div class="row">
							<div class="col-sm-6 col-xs-12">
								<div class="form-group">
									<h3>
									<label>
										<input id="plan_selected_id_value_<?php echo $plan->id; ?>" name="plan<?php echo $group->id; ?>" onchange="ExplaraMemberCheckout.handelPlanChange('<?php echo $group->group_id; ?>', '', this, '<?php echo $plan->id; ?>')" type="radio" data-set="false" class="explara_member_plan_input" data-id="<?php echo $plan->id; ?>" data-planid="<?php echo $plan->id; ?>" data-mainid="<?php echo $group->group_id; ?>">
										<?php echo $plan->name; ?>
									</label>
									</h3>
									<p>
										<?php echo $plan->description; ?>
									</p>
								</div>
							</div>
							<div class="col-sm-6 col-xs-12">
								<div class="option pull-right form-group">
									<p>
										<?php if ($plan->price == 0) {?>
										Free
										<?php } else {?>
										<?php echo $plan->currency; ?> <?php echo $plan->price; ?>
										<?php }?>
										X
										<select class="explara_plan_quantities" id="plan_selected_<?php echo $plan->id; ?>" name="quantity" onChange="ExplaraMemberCheckout.handelQuantityChange('<?php echo $group->group_id; ?>', '<?php echo $plan->id; ?>', '<?php echo $plan->currency; ?>')">
											<?php for ($i = 0; $i <= $plan->maxQuantity; $i++) {?>
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
						<div class="row">
							<div class="col-sm-6 col-xs-12">
								<button onClick="ExplaraMemberCheckout.processCheckout()" type="button" class="btn btn-explara-blue">
								Proceed
								</button>
							</div>
							<div class="col-sm-6 col-xs-12">
								<div class="explara_conference_summary exp_event_discount">
									<div class="exp_coupon_wrapper">
										<input placeholder="Discount code" type="text" class="form-control exp_input" name="explara_member_discount_code" id="explara_member_discount_code">
										<button class="btn btn_apply btn-explara-blue" type="button" onclick="ExplaraMemberCheckout.applyNormalDiscount('<?php echo $group->group_id; ?>')">Apply</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
	<div id="explara_checkout_plan_account_step" class="">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h5 class="panel-title">
				<a href="#" class="form-header header-step exp_checkout_step_header_account" id="explara_attendee_tabs">
					<span>
						2.
					</span>
					Account details
				</a>
				</h5>
			</div>
			<div class="exp_hide_element exp_member_content_block">
				<div class="panel-body common-form">
					<div class="exp_checkout_account_details">
						<form class="explara_submit_plan_account_details" id="explara_submit_plan_account_details" name="explara_submit_plan_account_details">
							<div>
								<label>
									Name
								</label>
								<input type="text" placeholder="Name" name="account_name" id="account_name" class="form-control" required>
							</div>
							<br>
							<div>
								<label>
									Email
								</label>
								<input type="email" placeholder="Email" name="account_email" id="account_email" class="form-control" required>
							</div>
							<br>
							<div>
								<label>
									Phone number
								</label>
								<input type="text" placeholder="Phone Number" name="account_phone" id="account_phone" class="form-control" required>
							</div>

							<div class="row">
								<div class="col-sm-6 col-xs-12">
									<button type="submit" name="submit_explara_account"  id="submit_explara_account" class="btn btn-explara-blue">
									Proceed
									</button>
								</div>
								<div class="col-sm-6 col-xs-12">
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="explara_checkout_plan_attendee_step" class="">
		<form name="explara_membership_attendee_forms" id="explara_membership_attendee_forms" method="post">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h5 class="panel-title">
					<a href="#" class="form-header header-step exp_checkout_step_header_attendee" id="explara_attendee_tabs">
						<span>
							3.
						</span>
						Attendee details
					</a>
					</h5>
				</div>
				<div class="exp_hide_element exp_member_content_block">
					<div class="panel-body common-form">
						<div class="non-member" id="explara_membership_attendee_list_holder"></div>
						<div class="row">
							<div class="col-sm-6 col-xs-12">
								<button  type="submit" id="explara_submit_attendee_details" class="btn btn-explara-blue">
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
	<div id="explara_checkout_plans_confirm_step" class="" style="display:none;">
		<form name="explara_member_confirmation_forms" id="explara_member_confirmation_forms" method="post">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h5 class="panel-title">
					<a href="#" class="form-header header-step exp_checkout_step_header_confirm" id="explara_member_confirmation_tab">
						<span>
							4.
						</span>
						Confirmation
					</a>
					</h5>
				</div>
				<div class="exp_hide_element exp_member_content_block">
					<div class="panel-body common-form">
						<div class="row">
							<div class="col-sm-12 col-xs-12">
								<h3 id="explara_membership_checkout_confirm_message">
								</h3>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>