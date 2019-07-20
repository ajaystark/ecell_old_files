<?php
$tab = isset($_GET['tab']) ? $_GET['tab'] : 'shortcodes';
?>

<section class="wrap page-single-event">
	<div class="exprow">
		<div class="expcol-60">
			<h1 class="wp-heading-inline">
				Explara Lite
			</h1>

			<ul class="text-right support-list" style="float: right;">
				<li>
					<a href="https://help.explara.com" target="_blank">
						<i class="fa fa-question-circle" aria-hidden="true"></i>&nbsp;
						Help
					</a>
				</li>
				<li>
					<a href="https://explara.com" target="_blank">
						<i class="fa fa-globe" aria-hidden="true"></i>&nbsp;
						Explara Website
					</a>
				</li>
			</ul>
		</div>
	</div>
	<div class="expcontainer">
		<div class="exprow">
			<div class="expcol-90">
				<ul class="list-settings-pages">

					<li class="list-item  <?php echo ($tab == 'shortcodes' || $tab == 'shortcodes-create') ? 'active' : '' ?>">
						<a href="<?php echo admin_url() . 'admin.php?page=explara-lite&tab=shortcodes'; ?>"">
							Shortcodes
						</a>
					</li>


					<li class="list-item <?php echo ($tab == 'settings') ? 'active' : '' ?>" >
						<a href="<?php echo admin_url() . 'admin.php?page=explara-lite&tab=settings'; ?>">
							Settings
						</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</section>
