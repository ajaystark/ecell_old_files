<?php $renew_group = "//" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . '?page=checkout';

if (!empty($groupMemberRenewLink)) {
	$renew_group = $groupMemberRenewLink;
}

?>
<div class="" id="explara-membership-group">
	<div >
		<div class="row">
			<div class="col-sm-12 col-xs-12">
				<div class="rt-side-banner-expl text-center">
					<h4 id="explara_membership_checkout_confirm_message">
					You are not a member of <?php echo $group->name; ?> Chapter.<br>
					Please <a style="color: #337ab7" href="<?php echo $renew_group; ?>" >
						Join
					</a> the Chapter or <a style="color: #337ab7" href="<?php echo $renew_group; ?>" >
					Renew
				</a> the membership
				</h4>
				<br><br><br><br>
			</div>
		</div>
	</div>
</div>
</div>