<div class="account-container explara-container form-page-width">
	<div class="explara-overlay">
	</div>
	<div class="row">
		<div class="col-sm-7 col-xs-12">
			<div class="explara-form-lt">
				<div class="content-form">
					<h2>
						Sign In
					</h2>
					<p>
						You are signing in to the goodness of “All in one platform” for events management!!. <br>
						Welcome and we hope you enjoy the experience.  
					</p>
				</div>
			</div>
		</div>
		<div class="col-sm-5 col-xs-12">
			<div class="explara-form-rt">
				<div class="explara-form-conatiner">
					<form id="explara_event_signin" class="contact_form" class="contact_form" action="">
						<div class="form-group">
							<label>
								Email*
							</label>
							<input type="text" id="email" name="email" class="form-control" data-validations="required">
						</div>
						<div class="form-group">
							<label>
								Password*
							</label>
							<input type="password" id="password" name="password" class="form-control" data-validations="required">
						</div>
						<input type="hidden" name="action" value="explara_event_signin">
						<button type="submit" class="btn btn-explara-lgreen">Sign in</button>
					</form>
					<div class="forgt-pass">
						<a href="<?php echo $member_account_page_url . '?page=forgot-password'; ?>">Forgot Password?</a>
					</div>
					<div class="link">
						<a href="<?php echo $member_account_page_url . '?page=signup'; ?>">New member? Sign up here.
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>