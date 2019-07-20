<script type="text/javascript">
	jQuery(window).on('load', function() {

		if(typeof window.explaraEvents !== 'undefined' && window.explaraEvents === true) {

			if(window.explaraEventType === 'list') {
				ExplaraMemberEvent.eventPaginationGet('list', '<?php echo get_option('explara_events_shown', 6); ?>');
			}

			if(window.explaraEventType === 'card') {
				ExplaraMemberEvent.eventPaginationGet('card', <?php echo get_option('explara_events_shown', 6); ?>);
			}
		}

	});
</script>