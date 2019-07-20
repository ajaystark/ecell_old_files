<?php
$event = explara\AdminEvents::getSingleEvent();
?>
<section class="wrap page-single-event">
	<div class="grid-container">
		<div class="exrow">
			<div class="excol-6">
				<h2>
				Events
				</h2>
			</div>
			<div class="excol-6">
				<ul class="text-right support-list">
					<li>
						<a href="<?php echo admin_url() . 'admin.php?page=explara-events-settings'; ?>">
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
		<div class="topic-strip">
			<div class="exrow">
				<div class="excol-6">
					<h6 class="topic">
						<a href="<?php echo admin_url() . 'admin.php?page=explara-events'; ?>">Events</a> /  <?php echo $event->event_title; ?>
					</h6>
				</div>
				<div class="excol-6">
					<ul class="text-right">
						<li>
							<a href="<?php echo admin_url() . 'admin.php?page=explara-events'; ?>">
								<i class="fa fa-chevron-left" aria-hidden="true"></i>&nbsp;
								Back
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="bg-wht expwht-wrapper">
		<div class="grid-container">
			<div class="exrow">
				<div class="excol-8">
					<h4 class="subtitle">
					Category - <?php echo $event->list_dump->category; ?>
					</h4>
					<h2 class="title">
					<?php echo $event->event_title; ?>
					</h2>
					<img src="<?php echo $event->list_dump->listingImage; ?>" class="expres-img">
					<div class="ex-layout-card">
						<div class="exrow">
							<div class="excol-6">
								<div class="organize-detail">
									<ul class="">
										<li>
											<span class="icon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
											<?php echo $event->start_fmt_date; ?> -<?php echo $event->end_fmt_date; ?> <br>
											<?php echo $event->start_fmt_time; ?> - <?php echo $event->end_fmt_time; ?>
										</li>
										<?php if (isset($event->list_dump->address)) {?>
											<li>
											<span class="icon"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
											<?php echo $event->list_dump->address; ?>
										</li>
										<?php }?>

										<li>
											<span class="icon"><i class="fa fa-money" aria-hidden="true"></i></span>

											<?php if (isset($event->details_dump->events->price) && !empty($event->details_dump->events->price)) {?>

												<?php if ($event->details_dump->events->currency == 'INR') {?>
												₹

											<?php } else {?>
												<?php echo $event->details_dump->events->currency; ?>
											<?php }?>


												  <?php echo $event->details_dump->events->price; ?>
												<?php } else {?>
												Free
												<?php }?>
										</li>
									</ul>
								</div>
							</div>
							<div class="excol-6">
								<div class="organize-detail">
									<ul class="">
										<?php if (count($event->details_dump->events->eventTopics) != 0) {
	?>
										<li class="no-pd-lt">
											<span>TOPICS</span>
											<strong>

												<?php foreach ($event->details_dump->events->eventTopics as $key => $topic) {
		echo $topic->topicName;
		if ($key != count($event->details_dump->events->eventTopics) - 1) {
			echo ', ';
		}

	}?>

											</strong>
										</li>
										<?php }?>
										<li class="no-pd-lt">
											<span class="icon">ORGANISOR</span>
											<p>
												<?php echo $event->details_dump->events->contactInfo; ?> <?php echo $event->details_dump->events->contactDetails; ?>
											</p>
										</li>
										<li class="no-margin">
											<p>
												<span>
													<span>
														<i class="fa fa-envelope-o" aria-hidden="true"></i>
													</span>
													<a href="mailto: <?php echo $event->details_dump->events->email; ?>">
														 <?php echo $event->details_dump->events->email; ?>
													</a>
												</span>
											</p>
										</li>
									</ul>
								</div>
							</div>
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
										<?php echo $event->details_dump->events->textDescription; ?>
									</p>
									<!-- <h3>
									Participants Will Learn:
									</h3>
									<ul class="">
										<li>
											Introduction To “Mobile Application”
										</li>
										<li>
											Introduction To “Designing For IOS Platform”
										</li>
										<li>
											Introduction To “Designing For Android Platform & Windows”
										</li>
										<li>
											Mobile App Design Architecture
										</li>
										<li>
											Comprehend The Challenges And Techniques Around Mobile Usability Testing, Including Hands-On Experience Testing A Mobile Application Or Website​​​​​​​
										</li>
									</ul> -->
									<div class="venue">
										<h3>
										Venue
										</h3>
										<p>
											<?php if (isset($event->details_dump->events->Location[0])) {?>
									<?php echo $event->details_dump->events->Location[0]->venueName; ?>, <?php echo $event->details_dump->events->Location[0]->address; ?><br>
									<?php echo $event->details_dump->events->Location[0]->city; ?>, <?php echo $event->details_dump->events->Location[0]->state; ?>, <?php echo $event->details_dump->events->Location[0]->country; ?><br>
									<?php echo $event->details_dump->events->Location[0]->zipcode; ?>
								</span><br>
								<span class="map">
									<a target="_blank" href="https://www.google.com/maps/?q=<?php echo $event->details_dump->events->Location[0]->latitude; ?>,<?php echo $event->details_dump->events->Location[0]->longitude; ?>">View map →</a>
								</span>
								<?php
}
?>
										</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="excol-4">
					<div class="action-bar">
						<a id="exp_event_sync"  class="page-action" onClick="ExplaraAdminForm.singleEventFetchSync('<?php echo $_GET['event_id']; ?>')">
							Fetch &amp; Sync
						</a>
					</div>
					<div class="ex-layout-card">
						<?php $checked = '';
$is_shown = (int) $event->is_shown;
if ($is_shown === 1) {
	$checked = 'checked';
}?>

						<h4>
						Show this event
						<input id="event_<?php echo $event->id; ?>" class="exp_toggle_event tgl tgl-light" data-event="<?php echo $event->id; ?>" data-shown="<?php echo $event->is_shown; ?>" type="checkbox" name="exp_toggle_event"  <?php echo $checked; ?>> <label class="tgl-btn" for="event_<?php echo $event->id; ?>">
						</h4>

						<div class="">
							<label>
								Copy the shortcode
							</label>
							<input class="disabled" readonly="true" type="text" name="" class="ex-form-control" value='[explara-event  event_id="<?php echo $event->event_id; ?>"]'>
						</div>
					</div>
					<div class="ex-action-sidebar">
						<h2>
						Event actions
						</h2>
						<div class="ex-layout-card related-details">
							<div class="exp-notice-sidebar">
								<a href="<?php echo EXPLARA_API_URL . 'em/event/manage/edit/eid/' . $event->event_id; ?>" target="_blank">
								<span>
									<i class="fa fa-calendar" aria-hidden="true"></i>
								</span>
								<h2>
								Update Details
								</h2>
								<p>
									Clicking here, you may update your event details at explara portal
								</p>
								<i class="fa fa-chevron-right arrow-icon" aria-hidden="true"></i>
								</a>
							</div>
							<div class="exp-notice-sidebar">
								<a href="<?php echo EXPLARA_API_URL . 'em/ticket/form/form/eid/' . $event->event_id; ?>" target="_blank">
								<span>
									<i class="fa fa-users" aria-hidden="true"></i>
								</span>
								<h2>
								Attendee List
								</h2>
								<p>
									Clicking here will enable you to see the  attendee lists for your event in explara portal
								</p>
								<i class="fa fa-chevron-right arrow-icon" aria-hidden="true"></i>
								</a>
							</div>
							<div class="exp-notice-sidebar">
								<a href="<?php echo EXPLARA_API_URL . 'em/report/report/overview/eid/' . $event->event_id; ?>" target="_blank">
								<span>
									<i class="fa fa-money" aria-hidden="true"></i>
								</span>
								<h2>
								Sales Overview
								</h2>
								<p>
									Clicking here will lead you to a sales overview of this event in explara portal
								</p>
								<i class="fa fa-chevron-right arrow-icon" aria-hidden="true"></i>
								</a>
							</div>
							<div class="exp-notice-sidebar">
								<a href="<?php echo EXPLARA_API_URL . 'em/event/design/header-n-logo/eid/' . $event->event_id; ?>" target="_blank">
								<span>
									<i class="fa fa-desktop" aria-hidden="true"></i>
								</span>
								<h2>
								Appearance
								</h2>
								<p>
									Clicking here will lead you to appearance section for this event in explara portal.
								</p>
								<i class="fa fa-chevron-right arrow-icon" aria-hidden="true"></i>
								</a>
							</div>
							<div class="exp-notice-sidebar">
								<a href="<?php echo EXPLARA_API_URL . 'em/event/email-builder/system-defined/eid/' . $event->event_id; ?>" target="_blank">
								<span>
									<i class="fa fa-envelope" aria-hidden="true"></i>
								</span>
								<h2>
								Email Template
								</h2>
								<p>
									Clicking here you will be able to set email template for user that will be triggered on registration.
								</p>
								<i class="fa fa-chevron-right arrow-icon" aria-hidden="true"></i>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>