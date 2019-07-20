<div class="expl-membership-sec-spacing">
	<div class="row">
		<div class="col-sm-6 col-xs-12 ">
			<h2 style="margin-top:0;margin-bottom:25px;">
				Details
			</h2>
			<div id="text" class="explara_group_single_description">
				<?php echo $group->textDescription; ?>
			</div>
			<!-- <a href="#" id="toggle">
				 Read more <i class="fa fa-chevron-down" aria-hidden="true"></i>
			</a> -->
		</div>
		<div class="col-sm-1 col-xs-12">
		</div>
		<div class="col-sm-5 col-xs-12">
				<?php if (count($all_members_list) > 0) {?>
				<div class="row">
					<div class="col-sm-9 col-xs-12">
						<h2 style="font-size:24px">
							Members
						</h2>
					</div>
					<div class="col-sm-3 col-xs-12">
					<?php if (!empty($all_members_list) && $all_members_list != null) {?>

					<?php if (count($all_members_list) > 4) {?>

						<a onclick="ExplaraMembershipGroup.handelOpenMemberTab('Members')" data-toggle="tab" href="#Members" class="view-all-btn" target="_self">
							View all(<?php echo count($all_members_list) ?>)
						</a>

							<?php }?>
						<?php }?>
					</div>
				</div>
				<?php }?>
				<div class="row" id="exp_membership_member_holder">
					<?php foreach ($all_members_list as $keymember => $member) {

	if ($keymember > 3) {
		continue;
	}

	?>
					<div class="col-sm-6 col-xs-12 exp_membership_member_block">
						<a class="expl-membership-member-card" data-member="<?php echo $member->memberId; ?>">
							<img src="<?php echo $member->profileUrl; ?>" class="img-responsive" onerror="this.src='https://cdn.explara.com/default_profile_image.jpg';">
							<h2>
								<?php echo $member->name; ?>
							</h2>
							<p>
								<?php echo $member->membership; ?>
							</p>
						</a>
					</div>
					<?php }?>
				</div>
			</div>
		</div>
	</div>
	<?php if (count($photos) > 0) {
	?>
	<div class="expl-membership-sec-spacing">
		<div class="row">
			<div class="col-sm-9 col-xs-12">
				<h2>
					Photos
				</h2>
			</div>
			<div class="col-sm-3 col-xs-12">
			<?php if (count($photos) > 4) {?>
				<a onclick="ExplaraMembershipGroup.handelOpenMemberTab('Photos')" data-toggle="tab" href="#Photos" class="view-all-btn" target="_self">
					View all <span>(<?php echo count($photos); ?>)</span>
				</a>
				<?php }?>
			</div>
		</div>
		<div class="row">
			<?php foreach ($photos as $keyval => $photo) {
		if ($keyval > 3) {
			continue;
		}

		?>
			<div class="col-sm-3 col-xs-12">
				<a href="#" class="expl-membership-event-photo" style="background-image: url('<?php echo $photo; ?>')">
				</a>
			</div>
			<?php }?>
		</div>
	</div>
	<?php }?>

	<?php if (count($group->tabs->Media->details) > 0) {
	?>
	<div class="expl-membership-sec-spacing">
		<div class="row">
			<div class="col-sm-9 col-xs-12">
				<h2>
					Media
				</h2>
			</div>
			<div class="col-sm-3 col-xs-12">
			<?php if (count($group->tabs->Media->details) > 2) {?>
				<a onclick="ExplaraMembershipGroup.handelOpenMemberTab('Media')" data-toggle="tab" href="#Media" class="view-all-btn" target="_self">
					View all <span>(<?php echo count($group->tabs->Media->details); ?>)</span>
				</a>
				<?php }?>
			</div>
		</div>
		<div class="row">
			<?php foreach ($group->tabs->Media->details as $keyval => $media) {

		if ($keyval > 1) {
			continue;
		}
		?>
			<div class="col-sm-6 col-xs-12">
				<div class="expl-membership-media">
					<div class="embed-responsive embed-responsive-16by9">
						<?php echo $media->object; ?>
						<div class="overlay-media">
						</div>
					</div>
				</div>
			</div>
			<?php }?>
		</div>
	</div>
	<?php }?>

	 <div class="expl-membership-sec-spacing">
	 <?php if (!empty($upcoming_events) && $upcoming_events != null && !empty($past_events) && $past_events != null) {?>
		<div class="row">
			<div class="col-sm-12 col-xs-12">
				<h2>
					Events
				</h2>
			</div>
		</div>
		<?php }?>
		<div class="">
			<?php if (!empty($upcoming_events) && $upcoming_events != null) {?>
			<div class="row">
				<div class="col-sm-9 col-xs-12">
					<p class="text-uppercase expl-membership-upcoming-event">
						UPCOMING EVENTS
					</p>
				</div>
			</div>
			<div class="row">
				<?php foreach ($upcoming_events as $event) {?>
				<div class="col-sm-4 col-xs-12">
					<a target="_blank" href="<?php echo $event->url; ?>" class="expl-membership-event-card">
						<header  style="background-image: url('<?php echo $event->listingImage; ?>')">
						</header>
						<article>
							<h6>
								<?php echo date("d M Y", strtotime($event->startDate->date)); ?> - <?php echo date("d M Y", strtotime($event->endDate->date)); ?>
							</h6>
							<h2>
								<?php echo $event->name; ?>
							</h2>
						</article>
					</a>
				</div>
				<?php }?>
			</div>
			<?php }?>
			<hr class="explara-membership-hr">
			<?php if (!empty($past_events) && $past_events != null) {?>
			<div class="row">
				<div class="col-sm-9 col-xs-12">
					<p class="text-uppercase expl-membership-upcoming-event">
						PAST EVENTS
					</p>
				</div>
			</div>
			<div class="row">
				<?php foreach ($past_events as $event) {?>
				<div class="col-sm-4 col-xs-12">
					<a target="_blank" href="<?php echo $event->url; ?>" class="expl-membership-event-card" >
						<header  style="background-image: url('<?php echo $event->listingImage; ?>')">
						</header>
						<article>
							<h6>
								<?php echo date("d M Y", strtotime($event->startDate->date)); ?> - <?php echo date("d M Y", strtotime($event->endDate->date)); ?>
							</h6>
							<h2>
								<?php echo $event->name; ?>
							</h2>
						</article>
					</a>
				</div>
				<?php }?>
			</div>
			<?php }?>
		</div>
	</div>
<script type="text/javascript">
	$(document).ready(function() {
  $("#toggle").click(function() {
    var elem = $("#toggle").text();
    if (elem == "Read More") {
      //Stuff to do when btn is in the read more state
      $("#toggle").text("Read Less");
      $("#text").slideDown();
    } else {
      //Stuff to do when btn is in the read less state
      $("#toggle").text("Read More");
      $("#text").slideUp();
    }
  });
});
</script>