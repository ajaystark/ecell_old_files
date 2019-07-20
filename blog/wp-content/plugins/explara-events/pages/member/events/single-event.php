<?php $current_url = "//" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . '&page=checkout';?>
<?php
$dateCompanre = checkIfEndDateLessThenToday($event->details_dump->events->endDate . " " . $event->details_dump->events->endTime);
?>
<div class="explara-event-bg explara-event-single style-explara-font" id="explara-reset">
	<div class="explara-single-event-container container-fluid">
		<div class="explara-event-banner-wrap">
			<div class="row">
				<div class="col-sm-8 col-xs-12">
					<div class="explara-event-banner" style="background-image: url('<?php echo $event->list_dump->listingImage; ?>')">
						<div class="overlay"></div>
						<h2 class="expbanner-event-title">
						<?php echo $event->event_title; ?>
						</h2>
					</div>
				</div>
				<div class="col-sm-4 col-xs-12">
					<div class="event-details-rt">
						<ul  class="list-unstyled">
							<li class="description-list">
								<span class="icon">
									<i class="fa fa-calendar expfa-black" aria-hidden="true"></i>
								</span>
								<span class="content"><?php echo $event->start_fmt_date; ?> - <?php echo $event->end_fmt_date; ?>
								</span>
							</li>
							<li class="description-list">
								<span class="icon">
									<i class="fa fa-clock-o expfa-black" aria-hidden="true"></i>
								</span>
								<span class="content">
									<?php echo $event->start_fmt_time; ?> - <?php echo $event->end_fmt_time; ?>
								</span>
							</li>
							<li >
								<ul class="list-unstyled explara_single_venue">
									<li>
										<?php
if (!empty($event->details_dump->events->Location)) {
	foreach ($event->details_dump->events->Location as $venuekey => $Location) {
		require 'includes/single-event-venue.php';
	}
}
?>
									</li>
								</ul>
							</li>
							<?php
if ($event->details_dump->events->type != 'rsvp') {
	?>
							<li class="description-list">
								<?php if (isset($event->details_dump->events->price) && !empty($event->details_dump->events->price)) {?>
								<span class="icon">
									<i class="fa fa-ticket expfa-black" aria-hidden="true"></i>
								</span>
								<span class="content"><?php echo $event->details_dump->events->currency; ?> <?php echo $event->details_dump->events->price; ?></span> onwards
								<?php } else {
		?>
								<?php if ($event->details_dump->events->price == '0') {?>
								<span class="icon">
									<i class="fa fa-ticket expfa-black" aria-hidden="true"></i>
								</span>
								<span class="content">
									Free
								</span>
								<?php } else {
			if ($dateCompanre == true) {?>
								<p class="explara_common_msg">
									This event has ended. Please contact organizer for more details.
								</p>
								<!-- 	<button type="button" class="explara_ticket_disabled_btn explara_ticket_disabled_btn_default">
								SOLD OUT
								</button> -->
								<?php } else {?>
								<p>Ticket is Sold Out. Please contact organizer for more help</p>
								<?php }?>
								<?php }?>
								<?php }?>
							</li>
							<?php }?>
							<form id="buy-ticket-form" class="buy-ticket-form" method="post" action="">
								<?php if ($event->details_dump->events->type == 'ticketing') {?>
								<?php if (isset($event->details_dump->events->price) && !empty($event->details_dump->events->price)) {?>
								<?php if ($event->is_expired == true) {?>
								<p class="explara_common_msg">
									This event has ended. Please contact organizer for more details.
								</p>
								<?php } else {?>
								<?php if ($event->event_session_type == 'multiDate') {?>
								<div class="explara_session_date">
									<div class="explara_session_date_block" style="display:none">
										<input type="text" name="explara_event_session_date" id="explara_event_session_date" value="" placeholder="Select date">
										<span class="fa fa-calendar">
										</span>
										<br><br>
										<?php if ($dateCompanre == false) {?>
										<a onClick="ExplaraCheckout.redirectbyDate('<?php echo $current_url; ?>')" class="btn btn-explara-blue">
											Buy Tickets
										</a>
										<?php }?>
									</div>
									<p style="display:none" class="multidate_session_msg explara_common_msg">
										Session is not available. Please contact organizer for more details
									</p>
								</div>
								<?php } else {?>
								<?php if ($dateCompanre == false) {?>
								<a href="<?php echo $current_url; ?>" class="btn btn-explara-blue">
									Buy Tickets
								</a>
								<?php }?>
								<?php }?>
								<?php }?>
								<?php } else {?>
								<?php if ($event->details_dump->events->price == '0') {?>
								<?php if ($event->is_expired == true) {?>
								<p class="explara_common_msg">
									This event has ended. Please contact organizer for more details.
								</p>
								<?php } else {?>
								<?php if ($event->event_session_type == 'multiDate') {?>
								<div class="explara_session_date">
									<div class="explara_session_date_block">
										<input type="text" name="explara_event_session_date" id="explara_event_session_date" value="" placeholder="Select date">
										<span class="fa fa-calendar">
										</span>
										<br><br>
										<?php if ($dateCompanre == false) {?>
										<a onClick="ExplaraCheckout.redirectbyDate('<?php echo $current_url; ?>')" class="btn btn-explara-blue">
											Buy Tickets
										</a>
										<?php }?>
									</div>
									<p style="display:none" class="multidate_session_msg explara_common_msg" >
										Session is not available. Please contact organizer for more details
									</p>
								</div>
								<?php } else {?>
								<?php if ($dateCompanre == false) {?>
								<a href="<?php echo $current_url; ?>" class="btn btn-explara-blue">
									Buy Tickets
								</a>
								<?php }?>
								<?php }?>
								<?php }?>
								<?php }?>
								<?php }?>
								<?php }?>
								<?php if ($event->details_dump->events->type == 'rsvp') {?>
								<?php if ($dateCompanre == false) {?>
								<a href="#" class="btn btn-explara-blue" id="explara_rsvp_form_source"  data-event="<?php echo $event->event_id ?>">
									RSVP
								</a>
								<?php } else {?>
								<p class="explara_common_msg">
									This event has ended. Please contact organizer for more details.
								</p>
								<?php }?>
								<?php }?>
								<?php if ($event->details_dump->events->type == 'conference') {?>


								<?php if (isset($event->tickets->tickets) && !empty($event->tickets->tickets)) {?>
								<?php if ($event->event_session_type == 'multiDate') {?>
								<div class="explara_session_date">
									<div class="explara_session_date_block">
										<input type="text" name="explara_event_session_date" id="explara_event_session_date" value="" placeholder="Select date">
										<span class="fa fa-calendar">
										</span>
										<br><br>
										<?php if ($dateCompanre == false) {?>
										<a onClick="ExplaraCheckout.redirectbyDate('<?php echo $current_url; ?>')" class="btn btn-explara-blue">
											Register
										</a>
										<?php }?>
									</div>
									<p style="display:none" class="multidate_session_msg explara_common_msg">
										Session is not available. Please contact organizer for more details
									</p>
								</div>
								<?php } else {?>
								<?php if ($dateCompanre == false) {?>
								<a href="<?php echo $current_url; ?>" class="btn btn-explara-blue">
									Register
								</a>
								<?php }?>
								<?php }?>
								<?php } else {?>
								<?php if (isset($event->tickets->category) && !empty($event->tickets->category)) {?>
								<?php if ($dateCompanre == false) {?>
								<a href="<?php echo $current_url; ?>" class="btn btn-explara-blue">
									Register
								</a>
								<?php }?>
								<?php }?>
								<?php }?>
								<?php }?>
							</form>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid explara-single-event-container">
		<div class="row">
			<div class="col-sm-8 col-xs-12">
				<div class="explara-tab-wrapper explara-wht-blk">
					<div class="explara-tab">
						<?php foreach ($event->details_dump->tabs as $key => $tab) {
	$opentab = '';
	if ($key == 0) {
		$opentab = 'defaultOpen';
	}
	?>
						<button class="tablinks" onclick="ExplaraCommon.openExplaraTab(event, 'exp_<?php echo $tab->name; ?>')" id="<?php echo $opentab; ?>"><?php echo $tab->name; ?> </button>
						<?php }?>
					</div>
					<?php foreach ($event->details_dump->tabs as $tab) {?>
					<div id="exp_<?php echo $tab->name; ?>" class="explaratabcontent">
						<p>
							<?php echo $tab->details; ?>
						</p>
					</div>
					<?php }?>
					<div class="details explara-single-details">
						<h3>
						Details
						</h3>
						<?php echo $event->details_dump->events->textDescription; ?>
					</div>
				</div>
			</div>
			<div class="col-sm-4 col-xs-12">
				<div class="explaraevent-organiser-blk explara-wht-blk">
					<h2 class="organiser-detail">
					Organizer : <span> <?php echo $event->details_dump->events->contactInfo; ?></span>
					</h2>
					<p class="orgnaiser-location">
						<?php echo $event->details_dump->events->contactDetails; ?>, <?php echo $event->details_dump->events->email; ?>
					</p>
					<!-- 			<ul class="list-unstyled list-inline">
						<li class="social-item">
							<a href="">
											<i class="fa fa-facebook" aria-hidden="true"></i>
							</a>
						</li>
						<li class="social-item">
							<a href="">
											<i class="fa fa-twitter" aria-hidden="true"></i>
							</a>
						</li>
						<li class="social-item">
							<a href="">
											<i class="fa fa-google-plus" aria-hidden="true"></i>
							</a>
						</li>
						<li class="social-item">
							<a href="">
											<i class="fa fa-feed" aria-hidden="true"></i>
							</a>
						</li>
						<li class="social-item">
							<a href="">
											<i class="fa fa-envelope" aria-hidden="true"></i>
							</a>
						</li>
						<li class="">
							<a href="" class="btn btn-explara-blue btn-rounded">
											Contact Organizer
							</a>
						</li>
					</ul> -->
				</div>
				<?php if (isset($event->details_dump->events->images) && !empty($event->details_dump->events->images) && $event->details_dump->events->images != null) {
	?>
				<div class="explara-wht-blk explaraevent-photo-slider">
					<div class="eventpage-card image-card">
						<h3 class="expheading-slider">Photos</h3>
						<div class="image-carousel">
							<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
								<!-- Indicators -->
								<ol class="carousel-indicators">
									<?php foreach ($event->details_dump->events->images as $imgkey => $image) {?>
									<li data-target="#carousel-example-generic" data-slide-to="<?php echo $imgkey; ?>" class=""></li>
									<?php }?>
								</ol>
								<!-- Wrapper for slides -->
								<div class="carousel-inner" role="listbox">

									 <?php foreach ($event->details_dump->events->images as $imgkey => $image) {

		if ($imgkey == 0) {
			$active = 'active';
		} else {
			$active = '';
		}

		?>

									 <div class="item <?php echo $active ?> ">
										<img class="img-responsive center-block" src="<?php echo $image; ?>">
									</div>

									 <?php }?>
								</div>
								<!-- Controls -->
								<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
									<span aria-hidden="true">
										<i class="fa fa-chevron-left" aria-hidden="true"></i>
									</span>
								</a>
								<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
									<span aria-hidden="true">
										<i class="fa fa-chevron-right" aria-hidden="true"></i>
									</span>
								</a>
							</div>
						</div>
					</div>
				</div>
				<?php }?>
				<?php if (0) {?>
				<div class="explara-wht-blk explaraeventqa-block">
					<p class="">
						Questions & Answers
					</p>
					<form class="" id="event-qa">
						<div class="form-group clearfix">
							<div class="col-sm-9 no-padding">
								<input type="text" name="question" placeholder="Write your questions here" class="form-control input-ask">
							</div>
							<div class="col-sm-3 no-padding">
								<button type="submit" class="btn-explara-lgreen"> Ask </button>
							</div>
						</div>
					</form>
					<div class="dashed-line"></div>
					<h3 class="explaraqa-heading">
					Frequently asked questions asked are:
					</h3>
					<ul class="list-unstyled qalist">
						<li>
							- What time does gate open?
						</li>
						<li>
							- How to reach the venue?
						</li>
						<li>
							- Are there any discounts?
						</li>
					</ul>
					<div class="dashed-line"></div>
					<div class="explaraquestion-container">
						<div class="question-hint">
							<p>Q :</p>
						</div>
						<div class="question-detail">
							<div class="question-name">
								<h4>How to get to venue?</h4>
							</div>
							<div class="question-info row">
								<div class="col-sm-6">
									<p>By <span><a href="">Pritpal Sing</a></span> on 24 July, 2017</p>
								</div>
								<div class="col-sm-5 text-right">
									<i class="fa fa-comment" aria-hidden="true"></i>
									<p>Write answers</p>
								</div>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="explaraanswer-container">
						<div class="answer-hint">
							<p>A :</p>
						</div>
						<div class="answer-detail">
							<div class="answer-wrapper">
								<div class="answer">
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque rutrum sit amet ante id ullamcorper. Nunc in eros nec leo rutrum cursus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque rutrum sit amet ante id ullamcorper. Nunc in eros nec leo rutrum cursus. </p>
								</div>
								<div class="answer-info">
									<p>By <span><a href="">Pritpal</a></span> on 24 July, 2017</p>
								</div>
							</div>
							<div class="answer-wrapper">
								<div class="answer">
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque rutrum sit amet ante id ullamcorper. Nunc in eros nec leo rutrum cursus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque rutrum sit amet ante id ullamcorper. Nunc in eros nec leo rutrum cursus. </p>
								</div>
								<div class="answer-info">
									<p>By <span><a href="">Pritpal</a></span> on 24 July, 2017</p>
								</div>
							</div>
							<div class="answer-wrapper">
								<div class="answer">
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque rutrum sit amet ante id ullamcorper. Nunc in eros nec leo rutrum cursus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque rutrum sit amet ante id ullamcorper. Nunc in eros nec leo rutrum cursus. </p>
								</div>
								<div class="answer-info">
									<p>By <span><a href="">Pritpal</a></span> on 24 July, 2017</p>
								</div>
							</div>
							<div class="answer-collapse">
								<p><span class="icon"><i class="fa fa-angle-double-up" aria-hidden="true"></i></span> Collapse all the answers</p>
							</div>
						</div>
					</div>
				</div>
				<?php }?>
			</div>
		</div>
	</div>
</div>
<div id="explara_rsvp_form_holder" class="explara-dynamic-slide-container tickets" >
	<a class="exp_pull_right exp_close" href="#" id="explara_rsvp_form_close">
		Close
	</a>
	<h3 class="explara_rsvp_success">
	</h3>
	<h3 class="explara_rsvp_error">
	</h3>
	<form name="explara_rsvp_data_forms" class="exp-form" id="explara_rsvp_data_forms" method="post">
		<div class="explara_rsvp_form" id="explara_rsvp_form">
		</div>
		<div class="row">
			<div class="col-sm-12 text-center">
				<button type="submit" id="explara_submit_rsvp_details" class="btn btn-explara-lgreen">
				RSVP
				</button>
			</div>
		</div>
	</form>
</div>