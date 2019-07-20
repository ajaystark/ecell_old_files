<?php
$tab = isset($_GET['tab']) ? $_GET['tab'] : 'customize';
?>

<section class="wrap page-single-event">
	<div class="exprow">
		<div class="expcol-60">
			<h1 class="wp-heading-inline">
				Settings
			</h1>
		</div>
		<div class="expcol-34">
			<ul class="text-right support-list">
				<li>
					<a href="<?php echo admin_url() . 'admin.php?page=explara-events'; ?>">
						<i class="fa fa-ticket" aria-hidden="true"></i>&nbsp;
						Events
					</a>
				</li>
				<li>
					<a href="https://help.explara.com/portal/home" target="_blank">
						<i class="fa fa-question-circle" aria-hidden="true"></i>&nbsp;
						Help
					</a>
				</li>
			</ul>
		</div>
	</div>
	<div class="expcontainer">
		<div class="exprow">
			<div class="expcol-90">
				<ul class="list-settings-pages">
					<li class="list-item  <?php echo ($tab == 'customize') ? 'active' : '' ?>">
						<a href="<?php echo admin_url() . 'admin.php?page=explara-events-settings'; ?>"">
							Customization
						</a>
					</li>

					<li class="list-item  <?php echo ($tab == 'pages') ? 'active' : '' ?>">
						<a href="<?php echo admin_url() . 'admin.php?page=explara-events-settings&tab=pages'; ?>"">
							Pages
						</a>
					</li>
					<li class="list-item  <?php echo ($tab == 'shortcodes') ? 'active' : '' ?>">
						<a href="<?php echo admin_url() . 'admin.php?page=explara-events-settings&tab=shortcodes'; ?>"">
							Shortcodes
						</a>
					</li>

					<li class="list-item <?php echo ($tab == 'token') ? 'active' : '' ?>" >
						<a href="<?php echo admin_url() . 'admin.php?page=explara-events-settings&tab=token'; ?>">
							Access Token
						</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</section>