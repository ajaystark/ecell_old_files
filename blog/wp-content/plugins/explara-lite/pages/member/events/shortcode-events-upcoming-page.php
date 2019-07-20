<?php
// var_dump($data['atts']['count']);
?>
<section class="explara-light-events-page-banner">
	<div class="overlay"></div>
	<div class="explara-light-events-page-heading">
		<h1>
		Upcoming events
		</h1>
	</div>
</section>
<section id="explara-light" class="explara-light-events-page-events-listing">
	<div class="explara-light-container">
		<h1 class="explara-light-events-section-heading">
		Upcoming events
		</h1>
		<?php if ($data['atts']['view'] == 'list') {
		?>
		<div class="">
			<?php $i = 0;
			foreach ($data['events'] as $event) {
			?>
			<a href="<?php echo $event['url'] ?>" target="_blank" class="explara-light-events-list-view explara-light-card-structure">
				<div class="explara-light-events-card">
					<img src="<?php echo $event['listingImage'] ?>" alt="" class="explara-light-events-list-image">
					<div class="explara-light-events-card-content">
						<div class="explara-light-events-card-heading">
							<div class="explara-light-events-card-date">
								<p>
									<?php echo $event['startDate']; ?>
								</p>
							</div>
							<h4>
							<?php echo $event['eventTitle']; ?>
							</h4>
						</div>
						<p>
							<?php
							//echo $event['shortDescription'];
							$content = $event['shortDescription'];
							$trimmed_content = wp_trim_words( $content, 25, NULL );
							echo $trimmed_content;
							?>
						</p>
					</div>
				</div>
			</a>
			<?php
			$i++;
			if (!empty($data['atts']['count']) && $data['atts']['count'] == $i) {
			break;
			}
			}?>
		</div>
		<?php }?>
		<?php if ($data['atts']['view'] == 'card') {
		?>
		<div class="exl-row">
			<?php
			$i = 0;
			foreach ($data['events'] as $event) {
			?>
			<div class="exl-col">
				<a href="<?php echo $event['url'] ?>" target="_blank" class="expl-card-view">
					<img src="<?php echo $event['listingImage'] ?>" alt="" class="explara-light-events-card-image">
					<div class="explara-light-single-event-card-date">
						<p>
							<?php echo $event['startDate']; ?>
						</p>
					</div>
					<div class="explara-light-card-view-contents">
						<h4>
						<?php
								$content = $event['eventTitle'];
								$trimmed_content = wp_trim_words( $content, 6, NULL );
								echo $trimmed_content;
						?>
						</h4>
						<p>
							<?php
								//echo $event['shortDescription'];
								$content = $event['shortDescription'];
								$trimmed_content = wp_trim_words( $content, 12, NULL );
								echo $trimmed_content;
							?>
						</p>
					</div>
				</a>
			</div>
			<?php
			$i++;
			if (!empty($data['atts']['count']) && $data['atts']['count'] == $i) {
			break;
			}
			}?>
		</div>
		<?php }?>
	</div>
</section>
<!-- <div class="explara-light-events-card-view">
	<?php
	foreach ($data['events'] as $event) {
	?>
	<a href="">
		<div class="explara-light-single-event-card-view">
			<img src="<?php echo $event['listingImage'] ?>" alt="" class="explara-light-events-card-image">
			<div class="explara-light-single-event-card-date">
				<p>
					<?php echo $event['startDate']; ?>
				</p>
			</div>
			<div class="explara-light-card-view-contents">
				<h4>
				<?php echo $event['eventTitle']; ?>
				</h4>
				<p>
					<?php echo $event['shortDescription']; ?>
				</p>
			</div>
		</div>
	</a>
	<?php }?>
</div> -->
