<?php
$data = \explara\ExpMembershipGet::getCustomization();
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.1/moment.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.6.2/fullcalendar.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>

<style type="text/css">
	.explara_group_single_button {
		background-color:<?php echo $data['button_data']['button_background_color'] ?>!important;
		color: <?php echo $data['button_data']['button_color'] ?>!important;
	}

	.explara_group_single_title {
		color:<?php echo $data['card_data']['card_title_color'] ?>!important;
	}

	.explara_group_single_description  {
		color:<?php echo $data['card_data']['card_description_color'] ?>!important;
	}

	.explara_group_single_description p {
		color:<?php echo $data['card_data']['card_description_color'] ?>!important;
	}

	.explara_group_single_card_style {
		font-family: <?php echo $data['font_data']['font_family'] ?>!important;
		font-style: <?php echo $data['font_data']['font_style'] ?>!important;
	}

</style>