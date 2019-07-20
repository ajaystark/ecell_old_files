<?php

$eventObject = explara\AdminEvents::getSingleEvent();

?>

<section class="wrap page-single-event">
	<div class="exprow">
		<div class="expcol-60">
			<h1 class="wp-heading-inline">
				Event
			</h1>
		</div>
		<div class="expcol-34">
			<ul class="text-right support-list">
				<li>
				<a href="<?php echo admin_url() . 'admin.php?page=explara-events'; ?>">
						<i class="fa fa-ticket" aria-hidden="true"></i>&nbsp;
						Events
					</a>
				</li>
				<li>
					<a href="<?php echo admin_url() . 'admin.php?page=explara-events-settings'; ?>">
						<i class="fa fa-cog" aria-hidden="true"></i>&nbsp;
						Settings
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
	<div class="bg-wht expwht-wrapper">
		<div class="expcontainer">
			<div class="exprow">
				<div class="expcol-60">
					<h4 class="subtitle">
						Category - <?php echo $eventObject->list_dump->category; ?>
					</h4>
					<h2 class="title">
						<?php echo $eventObject->event_title; ?>
					</h2>
					<img src="<?php echo $eventObject->list_dump->listingImage; ?>" class="expres-img">

					<div class="eventmajors pdv-30">
						<div class="exprow">
							<div class="expcol-45">
								<div class="eventmajors-card">
									<ul class="">
										<li>
											<span class="icon">Date</span>
											<p class="major-details">
												OCT 28, 2017 - NOV 26, 2017
												08:00 AM - 11:00 AM
											</p>
											<div class="clear"></div>
										</li>
										<li>
											<span class="icon">Address</span>
											<p class="major-details">
												<?php echo $eventObject->list_dump->address; ?>
											</p>
											<div class="clear"></div>
										</li>
										<li>
											<span class="icon">Total</span>
											<p class="major-details">
												₹ 25000
											</p>
											<div class="clear"></div>
										</li>
									</ul>
								</div>
							</div>
							<div class="expcol-45">
								<div class="eventmajors-card">
									<ul class="">
										<li>
											<span>cal</span>
											<p>
												OCT 28, 2017 - NOV 26, 2017
												08:00 AM - 11:00 AM
											</p>
										</li>
										<li>
											<span class="icon"></span>
											<p>
												Mobignosis, 41, Sri Krishna Mansion 3rd Floor, S End D Cross Rd, ,3rd Phase, J P Nagar, Bangalore, Karnataka, India
											</p>
										</li>
										<li>
											<span class="icon"></span>
											<p>
												₹ 25000
											</p>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="expcol-34">
					<a href="" class="button button-primary">
						Generate Shortcode
					</a>

					<button id="exp_event_sync" type="button" class="page-title-action" onClick="ExplaraAdminForm.singleEventFetchSync('<?php echo $_GET['event_id']; ?>')">
						Fetch &amp; Sync
					</button>
				</div>
			</div>
		</div>
	</div>
</section>