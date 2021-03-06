<div class="account-container explara-container form-page-width" id="explara_fp_request_holder">
	<div class="explara-overlay">
	</div>
	<div class="row">
		<div class="col-sm-7 col-xs-12">
			<div class="explara-form-lt">
				<div class="content-form">
					<h2>
						Forgot Password
					</h2>
					<p>
						Enter your email and submit. You will get an email to reset your password. <br>

					</p>
				</div>
			</div>
		</div>
		<div class="col-sm-5 col-xs-12">
			<div class="explara-form-rt">
				<div class="explara-form-conatiner">
					<form id="explara_event_forgotpassword" action="">
						<div class="form-group">
							<label>
								Email*
							</label>
							<input type="text" id="_exp_email" name="email" class="form-control" data-validations="required">
						</div>
						<input type="hidden" name="action" value="explara_forgotpassword_request">
						<button type="submit" class="btn btn-explara-lgreen">Submit</button>
					</form>
					<div class="link new-m">
						<a href="<?php echo $member_account_page_url . '?page=signin'; ?>">Already a member? Sign in here.</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="account-container explara-container form-page-width exp_hide_class" id="explara_fp_code_holder">
	<div class="explara-overlay">
	</div>
	<div class="row">
		<div class="col-sm-7 col-xs-12">
			<div class="explara-form-lt">
				<div class="content-form">
					<h2>
					Explara member
					</h2>
					<p>
						Enter the verification code sent to your mail and hit verify.
					</p>
				</div>
			</div>
		</div>
		<div class="col-sm-5 col-xs-12">
			<div class="explara-form-rt">
				<div class="explara-form-conatiner">
					<form id="explara_event_confirm_code" action="">
						<div class="form-group">
							<label>
								Verification Code*
							</label>
							<input type="text" id="expverificationCode" name="expverificationCode" class="form-control" data-validations="required">
						</div>
						<input type="hidden" name="action" id="explara_forgotpassword_code" value="explara_forgotpassword_code">
						<div class="link">
							<button type="submit" class="btn btn-explara-lgreen">Continue</button>
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
<div class="account-container explara-container form-page-width exp_hide_class" id="explara_fp_reset_holder">
	<div class="explara-overlay">
	</div>
	<div class="row">
		<div class="col-sm-7 col-xs-12">
			<div class="explara-form-lt">
				<div class="content-form">
					<h2>
					Explara member
					</h2>
					<p>
						You are now setting a new password for your account. Make sure you remember it.
					</p>
				</div>
			</div>
		</div>
		<div class="col-sm-5 col-xs-12">
			<div class="explara-form-rt">
				<div class="explara-form-conatiner">
					<form id="explara_event_reset_password" action="">
						<div class="form-group">
							<label>
								New Password*
							</label>
							<input type="password" id="expNewPassword" name="expNewPassword" class="form-control" data-validations="required">
						</div>
						<div class="form-group">
							<label>
								Confirm Password*
							</label>
							<input type="password" id="expConfirmPassword" name="expConfirmPassword" class="form-control" data-validations="required">
						</div>
						<input type="hidden" name="action" id="explara_forgotpassword_reset" value="explara_forgotpassword_reset">
						<button type="submit" class="btn btn-explara-lgreen">Submit</button>
					</form>

				</div>
			</div>
		</div>
	</div>
</div>
<div>
</div>