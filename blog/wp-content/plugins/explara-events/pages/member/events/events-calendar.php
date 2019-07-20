<div class="explara_header explara-grid-container">
		<div class="exrow">
			<div class="excol-6">
			</div>
			<div class="excol-6">
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
<div class="explara_card style-explara-font">
	<div class="cards">
		<div id="explara_event_calendar"></div>
	</div>
</div>


<script type="text/javascript">
var calendar_events = '<?php echo json_encode($calendar_events); ?>';
calendar_events = JSON.parse(calendar_events);

jQuery(document).find('#explara_event_calendar').fullCalendar({
  	header: {
    	left: 'prev,next',
    	center: 'title',
    	right: 'month,list'
  	},
  	events:calendar_events,
  	dayClick: function(date, allDay, jsEvent, view) {
       console.log(date);
 	},
});

</script>