<div class="explara_header">
		<div class="row">
			<div class="col-sm-6 col-xs-12">
			</div>
			<div class="col-sm-6 col-xs-12">
				<div class="exp_pull_right">
					<?php $checkAuth = \explara\ExplaraMemberPost::checkAuth();

?>

	<?php if ($checkAuth == true) {?>

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
<div class="explara_card explara_list_event explara-grid-container style-explara-font">
	<div class="row">
		<div class="col-sm-12">

			<div id="explara_table" class="table-responsive">
					<table>
						<thead>
							<tr>
								<th>Date of Event</th>
								<th>Event Name</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody class="explara_events_list_holder">
						<?php foreach ($events as $event) {?>
							<tr>
								<td>
									<?php echo $event->start_fmt_date; ?>  - <?php echo $event->end_fmt_date; ?>
								</td>

								<td>
									<a target="_blank" href="<?php echo $events_page_url . '?event_id=' . $event->event_display_id; ?>">
									<?php echo $event->event_title; ?>
									</a>
								</td>

								<td>
									<a target="_blank" class="explara-reg-btn" href="<?php echo $events_page_url . '?event_id=' . $event->event_display_id; ?>">
										<i class="fa fa-ticket"></i> &nbsp;Register
									</a>
								</td>
							</tr>
							<?php }?>
						</tbody>

					</table>
				</div>
		</div>
	</div>
	<div class="exrow">
		<div class="excol-12">
			<div class="exp_text_center">
				<?php if ($is_selected == false) {?>
				<?php if (count($events) == get_option('explara_events_shown', 6)) {?>
				<?php if (count($events) > 0) {?>
				<button  id="explara_event_loadmore" class="explara_load_more" onClick="ExplaraMemberEvent.loadMore('list');">
				<span>Load More</span>
				</button>
				<?php }?>
				<?php }?>
				<?php }?>
			</div>

		</div>
	</div>
</div>
<script type="text/javascript">
	window.explaraEvents = true;
	window.explaraEventType = 'list';
</script>