<div class="explara-container form-page-width " id="exp-member-account-container">
	<div class="explara-overlay">
	</div>
	<div class="row">
		<div class="col-sm-7 col-xs-12">
			<div class="explara-form-lt">
				<div class="content-form">
					<h2>
						Signup, join the Group and Explore!
					</h2>
				</div>
			</div>
		</div>
		<div class="col-sm-5 col-xs-12">
			<div class="explara-form-rt">
				<div class="explara-form-conatiner">
					<h2 class="text-center">
						Sign Up
					</h2>
					<form name="explara_group_signup" id="explara_group_signup" method="post" action="">
						<div class="form-group expl-form-group">
							<label>
								Name*
							</label>
							<input type="text" id="name" name="name" class="form-control" data-validations="required">
						</div>
						<div class="form-group expl-form-group">
							<label>
								Email*
							</label>
							<input type="text" id="email" name="email" class="form-control" data-validations="required">
						</div>
						<div class="form-group expl-form-group">
							<label>
								Phone*
							</label>
							<input type="tel" id="phone" name="phone" class="form-control" data-validations="required">
						</div>
						<div class="form-group expl-form-group">
							<label>
								Password*
							</label>
							<input type="password" id="password" name="password" class="form-control" data-validations="required">
						</div>
						<input type="hidden" name="action" value="explara_group_signup">
						<button type="submit" class="expl-membership-blue-btn explara_group_single_button">Sign up</button>
					</form>
					<div class="link">
						<a href="<?php echo $sign_in_link; ?>">Already a member? <span>Sign in here</span>.</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="explara-container form-page-width  exp_hide_class" id="explara_signup_confirm_email_holder">
	<div class="explara-overlay">
	</div>
	<div class="row">
		<div class="col-sm-7 col-xs-12">
			<div class="explara-form-lt">
				<div class="content-form">
					<h2>
					Email Verification
					</h2>
				</div>
			</div>
		</div>
		<div class="col-sm-5 col-xs-12">
			<div class="explara-form-rt">
				<div class="explara-form-conatiner">
					<h2 class="text-center">
					Enter the verification code sent to your email and hit verify.
					</h2>
					<div class="explara-form-conatiner">
						<form id="explara_group_signup_confirm_code" action="">
							<div class="form-group expl-form-group">
								<label>
									Verification Code*
								</label>
								<input type="text" id="expSignupCerificationCode" name="expSignupCerificationCode" class="form-control" data-validations="required">
							</div>
							<input type="hidden" name="action" id="explara_signup_code" value="explara_signup_code">
							<button type="submit" class="expl-membership-blue-btn explara_group_single_button">Verify</button>
							<div class="link">
								<a href="<?php echo $sign_in_link; ?>"> Click here to Signin</a>
							</div>
							<div class="link new-m">
								<button type="button" class="resend-link" onClick="ExplaraMembershipAccountForm.resendFPConfiramationCode()">Resend Confiramation Code</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>