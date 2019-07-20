<div class="expl-membership-sec-spacing">
<?php
$sponsers = array_values((array) $tab->details);
if (isset($sponsers[0])) {
	$sponsers = $sponsers[0];
	?>
	<div class="row">
		<?php foreach ($sponsers as $sponser) {
		?>
		<div class="col-sm-3 col-xs-12">
			<a href="<?php echo $sponser->url; ?>" class="expl-membership-sponser-card" target="_blank">
				<header>
				<img src="<?php echo $sponser->image; ?>" class="img-responsive center-block" alt="name">
				</header>
				<!-- <article>
					<h2>
					<?php echo $sponser->name; ?>
					</h2>
				</article> -->
			</a>
		</div>
		<?php }?>
	</div>
</div>

<?php
}

?>