<div class="account-container explara-container form-page-width" id="explara_signup_holder">
	<div class="explara-overlay">
	</div>
	<div class="row">
		<div class="col-sm-7 col-xs-12">
			<div class="explara-form-lt">
				<div class="content-form">
					<h2>
						Sign Up
					</h2>
					<p>
						We welcome you to the goodness of “All in one platform” for events. <br> We hope you enjoy the experience !
					</p>
				</div>
			</div>
		</div>
		<div class="col-sm-5 col-xs-12">
			<div class="explara-form-rt">
				<div class="explara-form-conatiner">
					<form name="explara_event_signup" id="explara_event_signup" method="post" action="">
						<div class="form-group">
							<label>
								Name*
							</label>
							<input type="text" id="name" name="name" class="form-control" data-validations="required">
						</div>
						<div class="form-group">
							<label>
								Email*
							</label>
							<input type="text" id="email" name="email" class="form-control" data-validations="required">
						</div>
						<div class="form-group">
							<label>
								Phone*
							</label>
							<input type="tel" id="phone" name="phone" class="form-control" data-validations="required">
						</div>
						<div class="form-group">
							<label>
								Password*
							</label>
							<input type="password" id="password" name="password" class="form-control" data-validations="required">
						</div>
						<input type="hidden" name="action" value="explara_event_signup">
						<button type="submit" class="btn btn-explara-lgreen">Sign up</button>
					</form>
					<div class="link">
						<a href="<?php echo $member_account_page_url . '?page=signin'; ?>">Already a member? Sign in here.</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="account-container explara-container form-page-width exp_hide_class" id="explara_signup_confirm_email_holder">
	<div class="explara-overlay">
	</div>
	<div class="row">
		<div class="col-sm-7 col-xs-12">
			<div class="explara-form-lt">
				<div class="content-form">
					<h2>
						Email Verification
					</h2>
					<p>
						Enter the verification code sent to your email and hit verify.
					</p>
				</div>
			</div>
		</div>
		<div class="col-sm-5 col-xs-12">
			<div class="explara-form-rt">
				<div class="explara-form-conatiner">
					<form id="explara_event_signup_confirm_code" action="">
						<div class="form-group">
							<label>
								Verification Code*
							</label>
							<input type="text" id="expSignupCerificationCode" name="expSignupCerificationCode" class="form-control" data-validations="required">
						</div>
						<input type="hidden" name="action" id="explara_signup_code" value="explara_signup_code">
						<button type="submit" class="btn btn-explara-lgreen">Verify</button>
						<div class="link">
						<a href="<?php echo $member_account_page_url . '?page=signin'; ?>"> Click here to Signin</a>
						</div>
						<div class="link new-m">
							<button type="button" class="resend-link" onClick="ExplaraMemberForm.resendFPConfiramationCode()">Resend Confiramation Code</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>