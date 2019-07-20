<?php
include 'inc-menu-settings.php';
$events = explara\AdminEvents::getListShownEvents();
?>
<div class="wrap">
	<div id="account" class="tabcontent">
		<div class="bg-wht expwht-wrapper">
			<h4 class="tabtt2">
			Select shortcode type
			</h4>
			<div class="multiple-select multuple-select-shortcode">
				<div class="exprow">
					<div class="expcol-15 text-center">
						<label>
							<input class="explara_shortcode_action" type="radio" name="explara_shortcode_action" value="single">
							<div class="not-checked">
								<div class="bg-img single-view">
									<div class="overlay">
									</div>
									<div class="o-lay-content">
									</div>
								</div>
								<p class="on-hover">
									Single View
								</p>
							</div>
						</label>
					</div>
					<div class="expcol-15 text-center">
						<label>
							<input type="radio" class="explara_shortcode_action" name="explara_shortcode_action" value="multiple"> <div class="not-checked">
							<div class="bg-img">
								<div class="overlay">
								</div>
								<div class="o-lay-content">
								</div>
							</div>
							<p class="on-hover">
								Multiple View
							</p>
						</div>
					</label>
				</div>
			</div>
		</div>
		<br>
		<div class="expform-group exprow" id="explara_shortcode_event_single"  style="display:none">
			<label class="control-label expcol-10">Select Event</label>
			<div class="expcol-20">
				<select name="explara_shortcode_event" class="explara_shortcode_event_selected expform-control">
					<option value="">
						Select Event
					</option>
					<?php foreach ($events as $event) {?>
					<option value="<?php echo $event->event_id; ?>">
						<?php echo $event->event_title; ?>
					</option>
					<?php }?>
				</select>
			</div>
		</div>
		<div class="expform-group exprow" id="explara_shortcode_event_multiple"  style="display:none">
			<label class="control-label expcol-10">Select Events <span class="fa fa-info-circle" title="Select multiple events from dropdown to generate shortcode"></span></label>
			<div class="expcol-10">
				<select multiple name="explara_shortcode_events expform-control" class="explara_shortcode_event_selected">
					<option value="">
						Select Events
					</option>
					<?php foreach ($events as $event) {?>
					<option value="<?php echo $event->event_id; ?>">
						<?php echo $event->event_title; ?>
					</option>
					<?php }?>
				</select>
			</div>
		</div>
		<div class="expform-group exprow" id="explara_shortcode_event_design"  style="display:none">
			<label class="control-label expcol-10">Select Design</label>
			<div class="expcol-10 text-center nopadding">
				<label class="lb-design">
					<input type="radio" checked name="explara_shortcode_display_value" class="explara_shortcode_display_value" value="card"> <span class="d-blk">Card</span>
				</label>
			</div>
			<div class="expcol-10 text-center nopadding">
				<label class="lb-design">
					<input type="radio" name="explara_shortcode_display_value" class="explara_shortcode_display_value" value="strip">  <span class="d-blk">Strip</span>
				</label>
			</div>
		</div>
		<div class="pdt-20 explara_shortcode_event_action" style="display:none">
			<div class="exprow">
				<div class="expcol-60">
					<button id="explara_shortcode_event_action" type="button" class="button button-primary"> Generate Shortcode </button>
				</div>
			</div>
		</div>
		<div class="pdt-30 explara_shortcode_display" style="display:none">
			<div class="exprow">
				<div class="expcol-60">
					<div class="explara_generated_shortcode">
						<input style="width: 100%;" type="text" readonly class="disabled" name="shortcode" id="explara_generated_shortcode_input">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>