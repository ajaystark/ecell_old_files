<div class="explara_card explara_list_event" id="list-event-card">
	<div class="cards">
		<div class="explara_events_card_holder explara_events_shortcode_holder clearfix">
			<div class="">
				<div class="exp-card">
					<a target="_blank" class="e-s-card" href="<?php echo $events_page_url . '?event_id=' . $event->event_display_id; ?>">
						<div class="e-img-holder expcard-bg" style="background-image: url('<?php echo $event->list_dump->listingImage; ?>')">
							
						</div>
						<div class="e-content">
							<h2 class="event-title">
							<?php echo $event->event_title; ?>
							</h2>
							<div class="date">
								<span>
									<i class="fa fa-calendar" aria-hidden="true"></i>
								</span>
								<span>
									<?php echo $event->start_fmt_date; ?>  - <?php echo $event->end_fmt_date; ?>
								</span>
							</div>
						</div>
						<div class="e-card-footer">
							<div class="row">
								<div class="col-sm-12 col-xs-12">
									<div class="text-center">
										<button class="reg-btn reg-btn-card">
										<i class="fa fa-ticket"></i>
										Register
										</button>
									</div>
								</div>
							</div>
						</div>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>