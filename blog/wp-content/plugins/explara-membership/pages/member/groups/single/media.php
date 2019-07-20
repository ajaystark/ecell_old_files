<div class="row">
	<?php foreach ($tab->details as $media) {?>
	<div class="col-sm-6 col-xs-12">
		<div class="expl-membership-media">
			<div class="embed-responsive embed-responsive-16by9">
				<?php echo $media->object; ?>
				<div class="overlay-media">
				</div>
			</div>
		</div>
	</div>
	<?php }?>
</div>