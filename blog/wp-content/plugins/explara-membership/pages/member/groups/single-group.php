<?php $current_url = "//" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . '?page=checkout';?>
<?php $renew_group = "//" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . '?page=renew';?>
<div class="explara_group_single_card_style" id="explara-membership-group">
	<div class="explara_header">
		<div class="row">
			<div class="col-sm-6">
			</div>
			<div class="col-sm-6">
				<div class="exp_pull_right">
					<?php $checkAuth = \explara\ExplaraMembershipAccountPost::checkAuth();
?>
					<?php if ($checkAuth == true) {?>
					<a href="<?php echo $portal_link; ?>" class="btn btn-explara-blue">
						Portal
					</a>
					<a href="" class="btn btn-explara-blue" id="explara_account_signout">
						Sign Out
					</a>
					<?php } else {?>
					<a href="<?php echo $signin_url; ?>" class="btn btn-explara-blue" id="explara_account_signin">
						Sign In
					</a>
					<?php }?>
				</div>
			</div>
		</div>
	</div>
	<div class="exp-membership-banner" style="background-image: url('<?php echo $headerImage; ?>')">
		<div class="row">
			<div class="col-sm-12 col-xs-12">
				<h2 class="expbanner-event-title">
				<?php echo $group->name; ?>
				</h2>
				<?php if (isset($all_members_list)) {?>
				<p>
					<?php echo count($all_members_list); ?> members
				</p>
				<?php }?>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6 col-xs-12">
			</div>
			<div class="col-sm-6 col-xs-12">
				<div class="rt-side-banner-expl">
					<?php if (!$isMember) {?>
					<a href="<?php echo $current_url; ?>" class="expl-membership-blue-btn explara_group_single_button exp_group_padding_btn">
						Join
					</a>
					<p>
						Membership expired?
						<a href="<?php echo $renew_group; ?>" class="expl-membership-txt-btn">
							Renew
						</a>
						now
					</p>
					<?php } else {?>
					<p>
						Membership expired?
						<a href="<?php echo $groupMemberRenewLink; ?>" class="expl-membership-txt-btn">
							Renew
						</a>
						now
					</p
					>						<?php }?>
				</div>
			</div>
		</div>
		<div class="exp-membership-group-overlay">
		</div>
	</div>
	<div class="expl-membership-common">
		<div class="">

			<div class="row">
				<div class="col-md-12 col-xs-12">
					<ul class="nav nav-tabs expl-membership-group-tab">
					<?php if (isset($group->tabs) && count($group->tabs) > 0) {
	?>
						<?php foreach ($group->tabs as $keyname => $tab) {
		$activeclass = '';
		if (empty($tab->details) || $tab->details == null || $tab->details == '' || $tab->details == 'null') {
			continue;
		}
		if ($keyname == 'Events') {
			if (empty($tab->details->upcoming) && empty($tab->details->past)) {
				continue;
			}
		}
		if ($keyname == 'Home') {
			$activeclass = 'active';
		}
		?>
						<li class="exp_all_tabs <?php echo $activeclass; ?>">
							<a data-toggle="tab" href="#<?php echo $keyname; ?>" target="_self">
								<?php echo $keyname; ?>
							</a>
						</li>
						<?php }?>
						<?php }?>
						<?php if ($checkAuth && $isMember) {

	if (!isset($group->tabs)) {
		$activeclass = 'active';
	}

	?>
						<li class="exp_group_discussion_action <?php echo $activeclass; ?>">
							<a data-toggle="tab" href="#Discussions">
								Discussions
							</a>
						</li>
						<?php }?>
					</ul>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="tab-content">
					<?php if (isset($group->tabs) && count($group->tabs) > 0) {
	?>
						<?php foreach ($group->tabs as $keyname => $tab) {
		$inclass = '';
		$activeclass = '';
		if (empty($tab->details) || $tab->details == null || $tab->details == '' || $tab->details == 'null') {
			continue;
		}
		if ($keyname == 'Events') {
			if (empty($tab->details->upcoming) && empty($tab->details->past)) {
				continue;
			}
		}
		if ($keyname == 'Home') {
			$inclass = 'in';
			$activeclass = 'active';
		}
		$filename = strtolower($keyname) . '.php';
		?>
						<div id="<?php echo $keyname; ?>" class="tab-pane fade <?php echo $inclass; ?> <?php echo $activeclass; ?> expl-membership-spacing">
							<?php require_once 'single/' . $filename;?>
						</div>
						<?php }
}
if ($checkAuth && $isMember) {

	if (!isset($group->tabs)) {
		$inclass = 'in';
		$activeclass = 'active';
	}

	?>
						<div id="Discussions" class="tab-pane fade exp_group_discussion_action expl-membership-spacing <?php echo $inclass; ?> <?php echo $activeclass; ?>">
							<?php	require_once 'single/discussion.php';
}
?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php require_once 'single/modals.php';?>