<div class="explara_card explara_list_event" id="list-event-card">
	<div class="cards">
		<div class="row explara_events_card_holder">
			<?php foreach ($events as $event) {
	?>
			<div class="col-sm-4 col-xs-12">
					<div class="exp-card">
						<a target="_blank" class="e-s-card" href="<?php echo $events_page_url . '?event_id=' . $event->event_display_id; ?>">
							<div class="e-img-holder expcard-bg" style="background-image: url('<?php echo $event->list_dump->listingImage; ?>')">

							</div>
							<div class="e-content">
								<div class="date">
									<div class="col-xs-3 expdateicon-col text-center nopadding">
										<?php if ($event->event_session_type == 'multiDate') {?>
									 <i class="fa fa-calendar expfa-cal" aria-hidden="true"></i>
									 <p>Multiple Date</p>
									 <?php } else {?>
										<?php $eventdate = date_create($event->start_fmt_date);?>
										<span class="expdate-day"><?php echo date_format($eventdate, "d"); ?></span>
										 <span class="expdate-month"> <?php echo date_format($eventdate, "M"); ?> </span>
										 <?php }?>
									</div>
									<div class="col-xs-9 expeventdesc-col">
										<h2 class="event-title">
											<?php echo $event->event_title; ?>
										</h2>
										<?php if (!empty($event->details_dump->events->Location)) {

		?>
											<p class="expcard-venue">
												<?php if (isset($event->details_dump->events->Location[0])) {?>
												<?php echo $event->details_dump->events->Location[0]->venueName; ?>, <?php echo $event->details_dump->events->Location[0]->address; ?><br>
												<?php echo $event->details_dump->events->Location[0]->city; ?>, <?php echo $event->details_dump->events->Location[0]->state; ?>, <?php echo $event->details_dump->events->Location[0]->country; ?><br>
												<?php echo $event->details_dump->events->Location[0]->zipcode; ?>
												<?php } else {?>
												Venue: N/A
												<?php }?>
											</p>
											<?php }?>
										</div>
									</div>
								</div>
								<div class="e-card-footer">
									<div class="row">
										<div class="col-sm-12 col-xs-12">
											<?php
if ($event->details_dump->events->type != 'rsvp') {
		?>
												<p>
													<?php if (isset($event->details_dump->events->price) && !empty($event->details_dump->events->price)) {?>
													<span>

													<?php if ($event->details_dump->events->currency == 'USD') {?>
	$
													<?php } else if ($event->details_dump->events->currency == 'INR') {?>
₹
													<?php } else {?>
₹
													<?php }?>


													 <?php echo $event->details_dump->events->price; ?></span> onwards
													<?php } else {
			?>
														<span class="content">
															Free
														</span>
															<?php }?>
														</p>
														<?php }?>
													</div>
												</div>
											</div>
										</a>
									</div>
								</div>
			<?php }?>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<div class="exp_text_center">
				<?php if ($is_selected == false) {?>
				<?php if (count($events) == get_option('explara_events_shown', 6)) {?>
				<?php if (count($events) > 0) {?>
				<button id="explara_event_loadmore" class="explara_load_more" onClick="ExplaraMemberEvent.loadMore('card');">
				<span>Load More</span>
				</button>
				<?php }?>
				<?php }?>
				<?php }?>
			</div>
		</div>
	</div>
</div>