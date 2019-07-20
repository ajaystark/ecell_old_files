<?php
$group = explara\AdminGroups::getSingleGroup();
?>
<section class="wrap page-single-event" id="explara-membership-group-details">
	<div class="grid-container">
		<div class="exrow">
			<div class="excol-8">
				<h2>
					Group
				</h2>
			</div>
			<div class="excol-4">
				<ul class="text-right support-list" id="support-list">
					<li>
						<a href="<?php echo admin_url() . 'admin.php?page=explara-membership-settings'; ?>">
							<i class="fa fa-cog" aria-hidden="true"></i>&nbsp;
							Support
						</a>
					</li>
					<li>
						<a href="https://help.explara.com/portal/home" target="_blank">
							<i class="fa fa-question-circle" aria-hidden="true"></i>&nbsp;
							Help
						</a>
					</li>
				</ul>
			</div>
		</div>
		<div class="exp-membership-group-topic">
			<div class="exrow">
				<div class="excol-6">
					<h6 class="topic">
						<a href="<?php echo admin_url() . 'admin.php?page=explara-membership'; ?>">Groups</a> /  <?php echo $group->group_title; ?>
					</h6>
				</div>
				<div class="excol-6">
					<ul class="text-right">
						<li>
							<label>
								Copy the shortcode
							</label>
							<input value="[explara-membership]" class="disabled" readonly="true" type="text" name="" class="ex-form-control">

						</li>
						<li>
							<a href="<?php echo admin_url() . 'admin.php?page=explara-membership'; ?>">
								<i class="fa fa-chevron-left" aria-hidden="true"></i>&nbsp;
								Back
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="bg-wht expwht-wrapper-membership">
			<div class="grid-container">
				<div class="exrow">
					<div class="excol-12">
						<h4 class="">
							Category - <?php echo $group->group_category; ?>
						</h4>
						<h2 class="title">
							<?php echo $group->group_title; ?>
						</h2>
						<img src="<?php echo $group->listing_image; ?>" class="expres-img">
					</div>
				</div>
				<div class="exrow">
					<div class="excol-6">
						<div class="organize-detail">
							<ul class="">
								<?php if (isset($group->contact_details)) {?>
								<li>
									<span class="icon"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
									<?php echo $group->contact_details; ?>
								</li>
								<?php }?>
							</ul>
						</div>
					</div>
					<div class="excol-6">
					</div>
				</div>
				<div class="ex-layout-card ex-event-details">
					<div class="exrow">
						<div class="excol-12">
							<div class="">
								<h2>
									DETAILS
								</h2>
								<p>
									<?php echo $group->group_desc; ?>
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>