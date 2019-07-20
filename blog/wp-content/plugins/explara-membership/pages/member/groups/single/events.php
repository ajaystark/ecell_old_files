<div class="exp-group-event-header">
	<div class="row">
		<div class="col-sm-6 col-xs-12">
			<ul class="list-unstyled list-inline exp-group-event-timing">
				<?php if (!empty($upcoming_events) && $upcoming_events != null && !empty($past_events) && $past_events != null) {?>
				<li>
					<a data-type="upcoming" data-show="exp_group_upcoming_events" data-hide="exp_group_past_events" href="#" class="exp_group_event_tab_toggle exp_selected_link">
						Upcoming events
					</a>
				</li>
				<li>
					|
				</li>
				<li>
					<a data-type="past" data-show="exp_group_past_events" data-hide="exp_group_upcoming_events" href="#"  class="exp_group_event_tab_toggle">
						Past Events
					</a>
				</li>
				<?php } else {?>
				<?php if (!empty($upcoming_events) && $upcoming_events != null) {?>
				<li>
					<a data-type="upcoming" data-show="exp_group_upcoming_events" data-hide="exp_group_past_events" href="#" class="exp_group_event_tab_toggle exp_selected_link">
						Upcoming events
					</a>
				</li>
				<?php }?>
				<?php if (!empty($past_events) && $past_events != null) {?>
				<li>
					<a data-type="past" data-show="exp_group_past_events" data-hide="exp_group_upcoming_events" href="#"  class="exp_group_event_tab_toggle">
						Past Events
					</a>
				</li>
				<?php }?>
				<?php }?>
			</ul>
		</div>
		<div class="col-sm-6 col-xs-12">
			<ul class="list-unstyled list-inline expl-group-event-view-select exp_pull_right">
				<li>
					<a href="#" data-type='grid' class="exp_group_event_display_tab_toggle">
						<i class="fa fa-th" aria-hidden="true"></i>
					</a>
				</li>
				<li>
					<a href="#" data-type='list' class="exp_group_event_display_tab_toggle">
						<i class="fa fa-list-ul" aria-hidden="true"></i>
					</a>
				</li>
				<li>
					<a href="#" data-type='calendar' class="exp_group_event_display_tab_toggle exp_init_calendar">
						<i class="fa fa-calendar" aria-hidden="true"></i>
					</a>
				</li>
			</ul>
		</div>
	</div>
</div>
<div class="expl-membership-sec-spacing">
	<div  id="exp_group_upcoming_events">
		<?php if (!empty($upcoming_events) && $upcoming_events != null) {?>
		<div class="row">
			<div class="col-sm-12 col-xs-12">
				<p class="text-uppercase expl-membership-upcoming-event">
					UPCOMING EVENTS
				</p>
			</div>
		</div>
		<div class="row exp_upcoming_display" id="exp_group_upcoming_list" style="display: none">
		<div class="col-sm-12 col-xs-12">
				<div class="explara_orders_list">
					<div class="row">
						<div class="col-sm-12">
							<div  class="table-responsive explara_table_membership">
								<table>
									<thead>
										<tr>
											<th>Name</th>
											<th>Start date</th>
											<th>End date</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($upcoming_events as $event) {?>
										<tr>
											<td>
												<a target="_blank" href="<?php echo $event->url; ?>">
													<?php echo $event->name; ?>
												</a>
											</td>
											<td><?php echo date("d M Y", strtotime($event->startDate->date)); ?></td>
											<td><?php echo date("d M Y", strtotime($event->endDate->date)); ?></td>
										</tr>
									</tbody>
									<?php }?>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row exp_upcoming_display" id="exp_group_upcoming_grid">
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
		<div class="row exp_upcoming_display" id="exp_group_upcoming_calendar"  style="display: none">
			<div class="col-sm-12 col-xs-12">
			<div id="explara_group_event_upcoming_calendar"></div>
			</div>
		</div>
		<?php } else {
}?>
	</div>
	<div id="exp_group_past_events" style="<?php echo $event_style; ?>">
		<?php if (!empty($past_events) && $past_events != null) {?>
		<div class="row">
			<div class="col-sm-12 col-xs-12">
				<p class="text-uppercase expl-membership-upcoming-event">
					PAST EVENTS
				</p>
			</div>
		</div>
		<div class="row exp_past_display" id="exp_group_past_grid">
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
		<div class="row exp_past_display" id="exp_group_past_list" style="display: none">
			<div class="explara_orders_list">
				<div class="row">
					<div class="col-sm-12">
						<div  class="table-responsive explara_table_membership">
							<table>
								<thead>
									<tr>
										<th>Name</th>
										<th>Start date</th>
										<th>End date</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($past_events as $event) {?>
									<tr>
										<td>
											<a target="_blank" href="<?php echo $event->url; ?>">
												<?php echo $event->name; ?>
											</a>
										</td>
										<td><?php echo date("d M Y", strtotime($event->startDate->date)); ?></td>
										<td><?php echo date("d M Y", strtotime($event->endDate->date)); ?></td>
									</tr>
								</tbody>
								<?php }?>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row exp_past_display" id="exp_group_past_calendar" style="display: none">
			<div id="explara_group_event_past_calendar"></div>
		</div>
		<?php } else {
}?>
	</div>
</div>
<script type="text/javascript">
	var upcoming_calendar_events = '<?php echo json_encode($upcoming_calendar_events); ?>';
	upcoming_calendar_events = JSON.parse(upcoming_calendar_events);
	jQuery(document).find('#explara_group_event_upcoming_calendar').fullCalendar({
		header: {
			left: 'prev,next',
			center: 'title',
			right: 'month,list'
		},
		events:upcoming_calendar_events,
		dayClick: function(date, allDay, jsEvent, view) {
			console.log(date);
		},
	});

</script>
<script type="text/javascript">
	var past_calendar_events = '<?php echo json_encode($past_calendar_events); ?>';
	past_calendar_events = JSON.parse(past_calendar_events);
	jQuery(document).find('#explara_group_event_past_calendar').fullCalendar({
		header: {
			left: 'prev,next',
			center: 'title',
			right: 'month,list'
		},
		events:past_calendar_events,
		dayClick: function(date, allDay, jsEvent, view) {
			console.log(date);
		},
	});




</script>