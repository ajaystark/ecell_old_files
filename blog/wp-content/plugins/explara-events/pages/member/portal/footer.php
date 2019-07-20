<?php
$data = \explara\ExpGet::getCustomization();
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.1/moment.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.6.2/fullcalendar.min.js"></script>

<style type="text/css">
	.reg-btn, .explara-reg-btn {
		background-color:<?php echo $data['button_data']['button_background_color'] ?>!important;
		color: <?php echo $data['button_data']['button_color'] ?>!important;
	}

	.event-title, .explara-event-title {
		color:<?php echo $data['card_data']['card_title_color'] ?>!important;
	}

	.date, .explara-single-details, .explara-single-details p, .explara-single-details li  {
		color:<?php echo $data['card_data']['card_description_color'] ?>!important;
	}

	.exp-card {
		font-family: <?php echo $data['font_data']['font_family'] ?>!important;
		font-style: <?php echo $data['font_data']['font_style'] ?>!important;
	}

	.style-explara-font {
			font-family: <?php echo $data['font_data']['font_family'] ?>!important;
			font-style: <?php echo $data['font_data']['font_style'] ?>!important;
	}

</style>