<?php
include 'inc-menu-settings.php';

$reload = '';

if (empty(get_option('explara_lite_access_token'))) {
	$reload = 'true';
}

?>

<div class="wrap">
	<div id="account" class="tabcontent metabox-holder">

		<div class="postbox">

			<h3 class="hndle">
				<span>Access Token Configuration</span>
			</h3>

			<div class="inside">

				<div class="updated below-h2 exp-msg exp_success_msg">
					<p>Success</p>
				</div>

				<div class="error below-h2 exp-msg exp_error_msg">
					<p>Failed</p>
				</div>

				<p class="">
					Access token configuration is required for secure access of explara event APIs.
				</p>
				<p class="">
					Login to Explara portal (<a href="https://in.explara.com" target="_blank">https://in.explara.com</a>) and obtain access token under Profile &amp; Settings page.
				</p>
				<p class="">
					The access token obtained must be pasted below in the textbox and save.
				</p>

				<form name="exp_add_form_token" id="exp_add_form_token" method="post">

					<table class="form-table">
						<tr>
							<th>
								<label>Access token:</label>
							</th>
							<td>
								<input type="hidden" name="action" value="page_add_token">
								<input data-validations="required" type="text" class="expform-control expcol-40"  placeholder=" Enter access token" name="token_value" id="token_value" value="<?php echo get_option('explara_lite_access_token'); ?>" size="60">

								<br>
								<span class="description">Paste the token here & click on save.</span>
							</td>
						</tr>
					</table>

					<p id="token-form-message"></p>

					<button type="button" onClick="ExplaraAdminForm.saveAdminFormData('#exp_add_form_token', '<?php echo $reload; ?>')"  class="button button-primary"> Save Token </button>
				</form>
			</div>
	</div>
</div>

