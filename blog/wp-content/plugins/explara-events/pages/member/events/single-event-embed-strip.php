<div class="explara_card explara_list_event explara_events_shortcode_holder style-explara-font">
	<div class="row">
		<div class="col-sm-12">
			<div class="strip-card">
				<div class="row">
					<div class="col-sm-6 col-xs-12">
						<div class="explara-event-img" style="background-image: url('<?php echo $event->list_dump->listingImage; ?>')">
						</div>
					</div>
					<div class="col-sm-3 col-xs-12">
						<div class="explara-strip-content">
							<a target="_blank" href="<?php echo $events_page_url . '?event_id=' . $event->event_display_id; ?>">
								<?php echo $event->event_title; ?>
							</a>
							<div class="date">
								<span>
									<i class="fa fa-calendar" aria-hidden="true"></i>
								</span>
								<span>
									<?php echo $event->start_fmt_date; ?>  - <?php echo $event->end_fmt_date; ?>
								</span>
							</div>
						</div>
					</div>
					<div class="col-sm-3 col-xs-12">
						<div class="explara-strip-content">
							<a target="_blank" class="explara-reg-btn" href="<?php echo $events_page_url . '?event_id=' . $event->event_display_id; ?>">
								<i class="fa fa-ticket"></i> &nbsp;Register
							</a>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>