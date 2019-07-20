<div class="postbox ">
	<h3 class="hndle">
	<span>Generate Shortcode for Events</span>
	<span class="explara-box-link" style="float:right">
		<a href="<?php echo admin_url() . 'admin.php?page=explara-lite&tab=shortcodes'; ?>" class="explara-lite-gen-code-link" id="explara-lite-gen-code-link">
			Back
		</a>
	</span>
	</h3>
	<div class="inside">
		<p>Please select required settings to generate the shortcode for events.</p>
		<form name="exp_form_shortcode_events" id="exp_form_shortcode_events" method="post">
			<input type="hidden" name="action" value="page_shortcode_events">
			<table class="form-table">
				<tr>
					<th>
						<label>Event Type:</label>
					</th>
					<td>
						<label><input type="radio" name="events_type" value="upcoming" checked="checked">Upcoming Events</label>
						&nbsp;&nbsp;&nbsp;
						<label><input type="radio" name="events_type" value="past">Past Events</label>
						<br><br>
						<span class="description">Select the event type for which you want to generate the shortcode.</span>
					</td>
				</tr>
				<tr>
					<th>
						<label>Layout Type:</label>
					</th>
					<td>
						<label><input type="radio" name="events_layout_type" value="section" checked="checked">Section</label>
						&nbsp;&nbsp;&nbsp;
						<label><input type="radio" name="events_layout_type" value="page">Complete Page</label>
						<br><br>
						<span class="description">Select the layout for showing eventsin the page.</span>
					</td>
				</tr>
				<tr>
					<th>
						<label>Individual Event View:</label>
					</th>
					<td>
						<label><input type="radio" name="events_view_type" value="card" checked="checked">Card View</label>
						&nbsp;&nbsp;&nbsp;
						<label><input type="radio" name="events_view_type" value="list">List View</label>
						<br><br>
						<span class="description">Select the layout for showing events in the page.</span>
					</td>
				</tr>
				<tr>
					<th>
						<label>Number of Events:</label>
					</th>
					<td>
						<input type="number" name="events_count" value="" size="30">
						<br><br>
						<span class="description">Number of events to show as part of the shortcode. Leave empty to show all the events.</span>
					</td>
				</tr>

				<tr style="display: none;" id="exp_events_form_message_holder">
					<td colspan="2">
						<p id="exp_events_form_message"></p>
					</td>
				</tr>

				<tr class="explara-submit-button-row">
					<th>
						<p class="submit">
							<button type="button" onClick="ExplaraAdminForm.eventShortcode('#exp_form_shortcode_events', '#event_shortcode_placeholder')"  class="button button-primary"> Generate Shortcode </button>
						</p>
					</th>
					<td>
						<span id="event_shortcode_placeholder" class="shortcode-placeholder"></span>
					</td>
				</tr>
			</table>
		</form>
	</div>
</div>
