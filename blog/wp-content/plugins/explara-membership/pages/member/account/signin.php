<div class="explara-container form-page-width" id="exp-member-account-container-signin">
	<div class="explara-overlay">
	</div>
	<div class="row">
		<div class="col-sm-7 col-xs-12">
			<div class="explara-form-lt">
				<div class="content-form">
					<h2>
						Signin, join the Group and Explore!
					</h2>
				</div>
			</div>
		</div>
		<div class="col-sm-5 col-xs-12">
			<div class="explara-form-rt">
				<div class="explara-form-conatiner">
					<h2 class="text-center">
						Sign In
					</h2>
					<form id="explara_group_signin" class="contact_form" class="contact_form" action="">
						<div class="form-group expl-form-group">
							<label>
								Email*
							</label>
							<input type="text" id="email" name="email" class="form-control" data-validations="required">
						</div>
						<div class="form-group expl-form-group">
							<label>
								Password*
							</label>
							<input type="password" id="password" name="password" class="form-control" data-validations="required">
						</div>
						<div class="form-group expl-form-group">
							<input type="hidden" name="action" value="explara_group_signin">
							<button type="submit" class="expl-membership-blue-btn explara_group_single_button">Sign in</button>
						</div>
					</form>
					<div class="forgt-pass">
						<a href="<?php echo $sign_fp_link; ?>">Forgot Password?</a>
					</div>
					<div class="link">
						<a href="<?php echo $sign_up_link; ?>">Are You a new member? <span>Sign up.</span>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>