<?php

$groups = explara\ExplaraAdminApi::getAllGroups();

?>

<div class="postbox">
	<h3 class="hndle">
	<span>Generate Shortcode for Group Members</span>
	<span class="explara-box-link" style="float:right">
		<a href="<?php echo admin_url() . 'admin.php?page=explara-lite&tab=shortcodes'; ?>" class="explara-lite-gen-code-link" id="explara-lite-gen-code-link">
			Back
		</a>
	</span>
	</h3>
	<div class="inside">
		<p>Please select required settings to generate the shortcode for group members.</p>
		<form name="exp_form_shortcode_group" id="exp_form_shortcode_group" method="post">
			<input type="hidden" name="action" value="page_shortcode_group">

			<input type="hidden" name="groupIdName" id="groupIdName">
			<input type="hidden" name="membershipTypeName" id="membershipTypeName">


			<table class="form-table">
				<tr>
					<th>
						<label>Group:</label>
					</th>
					<td>
						<select name="groupId" id="groupId" style="width: 300px" data-validations="required" onchange="ExplaraAdminForm.changeGroup()">
							<option value="">Select a group</option>
							<?php foreach ($groups as $group) {?>
							<option value="<?php echo $group['id']; ?>"> <?php echo $group['name']; ?> </option>
							<?php }?>
						</select>
						<br><br>
						<span class="description">Select the group for which you want to generate the shortcode.</span>
					</td>
				</tr>
				<tr>
					<th>
						<label>Listing Type</label>
					</th>
					<td>
						<label><input type="radio" name="member_listing_type" value="members" checked="checked">Members Listing</label>
						&nbsp;&nbsp;&nbsp;
						<label><input type="radio" name="member_listing_type" value="login">Login / Join Listing</label>
						<br><br>
						<span class="description">Select the type of listing for the shortcode.</span>
					</td>
				</tr>

				<tr>
					<th>
						<label>Membership Type:</label>
					</th>
					<td>
						<select name="membershipType" id="membershipType" style="width: 300px" data-validations="required" onchange="ExplaraAdminForm.changeMembershipType()">
							<option value="">Select Membership Type</option>
						</select>
						<br><br>
						<span class="description">Select the membership type.</span>
					</td>
				</tr>

				<tr>
					<th>
						<label>Layout Type:</label>
					</th>
					<td>
						<label><input type="radio" name="member_layout_type" value="section" checked="checked">Section</label>
						&nbsp;&nbsp;&nbsp;
						<label><input type="radio" name="member_layout_type" value="page">Complete Page</label>
						<br><br>
						<span class="description">Select the layout for showing members in the page.</span>
					</td>
				</tr>
				<tr>
					<th>
						<label>Number of Members:</label>
					</th>
					<td>
						<input type="number" name="members_count" value="" size="30">
						<br><br>
						<span class="description">Number of members to show as part of the shortcode. Leave empty to show all the members.</span>
					</td>
				</tr>
				<tr style="display: none;" id="exp_group_form_message_holder">
					<td colspan="2">
						<p id="exp_group_form_message"></p>
					</td>
				</tr>
				<tr class="explara-submit-button-row">
					<th>
						<p class="submit">
							<button type="button" onClick="ExplaraAdminForm.groupShortcode('#exp_form_shortcode_group', '#group_shortcode_placeholder')"  class="button button-primary"> Generate Shortcode </button>
						</p>
					</th>
					<td>
						<span id="group_shortcode_placeholder" class="shortcode-placeholder"></span>
					</td>
				</tr>
			</table>
		</form>
	</div>
</div>
