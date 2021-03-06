<?php
include 'inc-menu-settings.php';
?>
<div class="wrap" id="customize-style-blk-membership-plugin">
	<div  class="bg-wht expwht-wrapper-membership">
		<form name="exp_membership_setting_pages_form" id="exp_membership_setting_pages_form" method="post">
			<div class="updated below-h2 exp-msg exp_success_msg">
				<p>Success</p>
			</div>
			<div class="error below-h2 exp-msg exp_error_msg">
				<p>Failed</p>
			</div>
			<h4 class="tabtt2">
				Pages
			</h4>
			<p>
				As you install the plugin, we have provided few default pages which are required for the plugin to work properly.
				<br>
				In case you wish to modify, you may do so here.
			</p>

			<div class="expform-group exprow">
				<label class="control-label expcol-30">User Authentication
					<span class="fa fa-info-circle" title="Users will be able to sign up, sign in and reset their password on this page"></span></label>
					<div class="expcol-30">
						<?php
wp_dropdown_pages(['class' => 'explara_membership_setting_pages', 'id' => 'explara_membership_account_page', 'selected' => get_option('explara_membership_account_page', 0)]);
?>
					</div>
				</div>
				<div class="expform-group exprow">
					<label class="control-label expcol-30">Member Dashboard
						<span class="fa fa-info-circle" title="This is a page where your users will see their order related information and can perform relevant actions"></span></label>
						<div class="expcol-30">
							<?php
wp_dropdown_pages(['class' => 'explara_membership_setting_pages ', 'id' => 'explara_membership_portal_page', 'selected' => get_option('explara_membership_portal_page', 0)]);
?>
						</div>
					</div>
					<div class="expform-group exprow">
						<label class="control-label expcol-30">All Groups
							<span class="fa fa-info-circle" title="Your users will see list of events in this page"></span></label>
							<div class="expcol-30">
								<?php
wp_dropdown_pages(['class' => 'explara_membership_setting_pages ', 'id' => 'explara_membership_page', 'selected' => get_option('explara_membership_page', 0)]);
?>
							</div>
						</div>

<!-- 	<div class="expform-group exprow">
						<label class="control-label expcol-30">Payment Response
							<span class="fa fa-info-circle" title="Your users will see list of events in this page"></span></label>
							<div class="expcol-30">
								<?php
wp_dropdown_pages(['class' => 'explara_membership_payment_page ', 'id' => 'explara_membership_payment_page', 'selected' => get_option('explara_membership_payment_page', 0)]);
?>
							</div>
						</div>
 -->

							<button type="button" onClick="ExplaraMembershipAdminForm.saveSettingPages('#exp_membership_setting_pages_form')"  class="button button-primary"> Save options </button>
						</form>
					</div>
				</div>