<?php
include 'inc-menu-settings.php';

$reload = '';

if (empty(get_option('explara_access_token'))) {
	$reload = 'true';
}

?>
<div class="wrap" id="customize-style-blk-membership-plugin">
	<div id="account" class="tabcontent">

		<form name="exp_membership_add_form" id="exp_membership_add_form" method="post">
			<div class="bg-wht expwht-wrapper-membership">
				<h4 class="tabtt2">
				Access Token Configuration
				</h4>
				<div class="updated below-h2 exp-msg exp_success_msg">
					<p>Success</p>
				</div>
				<div class="error below-h2 exp-msg exp_error_msg">
					<p>Failed</p>
				</div>
				<p class="">
					Access token configuration is required for secure access of explara membership APIs.
				</p>
				<p class="">
					Login to explara portal (<a href="https://in.explara.com" target="_blank">
						https://in.explara.com
					</a>) and obtain access token under Profile &amp; Settings page.
				</p>
				<p class="">
					The access token obtained must be pasted below in the textbox and save.
				</p>

				<div class="ex-token-form">
					<div class="expform-group exprow">
						<label class="control-label expcol-10">Access token</label>
						<div class="expcol-90">
							<input data-validations="required" type="text" class="expform-control expcol-40"  placeholder=" Enter access token" name="token_value" id="token_value" value="<?php echo get_option('explara_access_token'); ?>">
						</div>
						<input type="hidden" name="action" value="page_membership_add_token">
					</div>
				</div>
				<button type="button" onClick="ExplaraMembershipAdminForm.post('#exp_membership_add_form', '<?php echo $reload; ?>')"  class="button button-primary"> Save token </button>
			</form>
		</div>
	</div>
</div>