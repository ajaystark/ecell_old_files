<div class="" id="explara-top-strip">
	<div class="row">
		<div class="col-sm-12">
			<div class="e-view-card">
				<div class="row">
					<div class="col-sm-3 col-xs-12">
						<div class="explara-event-img" style="background-image: url('<?php echo $event->list_dump->listingImage; ?>')">
						</div>
					</div>
					<div class="col-sm-9 col-xs-12">
						<a href="<?php echo $event->complete_link; ?>">
							<h2>
							<?php echo $event->event_title; ?>
							</h2>
						</a>
						<div class="date">
							<h5>
							<?php echo $event->start_fmt_date; ?> - <?php echo $event->end_fmt_date; ?>
							</h5>
						</div>
						<div class="time">
							<h6>
							<?php echo $event->start_fmt_time; ?> - <?php echo $event->end_fmt_time; ?>
							</h6>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>