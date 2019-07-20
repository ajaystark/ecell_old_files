<?php

$wp_list_table = new explara\AdminEventsListtable();

$order = "asc";
$orderby = "event_title";

if (isset($_REQUEST['order'])) {
	$order = $_REQUEST['order'];
}

if (isset($_REQUEST['orderby'])) {
	$orderby = $_REQUEST['orderby'];
}

?>

<div class="wrap t201plugin">
	<div class="exprow">
		<div class="expcol-60">
			<h1 class="wp-heading-inline">
				Events
				<button id="exp_events_sync" type="button" class="page-title-action" onClick="ExplaraAdminForm.fetchSync()">
					Fetch &amp; Sync
				</button>
			</h1>

		</div>
		<div class="expcol-34">
			<ul class="text-right support-list">
				<li>
					<a href="<?php echo admin_url() . 'admin.php?page=explara-events-settings'; ?>">
						<i class="fa fa-cog" aria-hidden="true"></i>&nbsp;
						Settings
					</a>
				</li>
				<li>
					<a href="https://help.explara.com/portal/home" target="_blank">
						<i class="fa fa-question-circle" aria-hidden="true"></i>&nbsp;
						Help
					</a>
				</li>
			</ul>

			<div class="tablenav">
			<div class="alignleft">
				<?php //$wp_list_table->views();?>
			</div>
				<div class="alignright actions new-actions">
					<form method="get" class="search-form">
						<p class="search-box">
							<input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>" />
							<input type="hidden" name="orderby" value="<?php echo $orderby ?>" />
							<input type="hidden" name="order" value="<?php echo $order ?>" />

							<label class="screen-reader-text"><?php _e('Search Events', 'tc');?>:</label>
							<input type="text" value="<?php echo isset($_GET['s']) ? $_GET['s'] : '' ?>" name="s">
							<input type="submit" class="button" value="<?php _e('Search Events', 'tc');?>">
						</p>
					</form>
				</div>
			</div>
		</div>
	</div>

<form id="explara_events_list_filter" method="post">
	<?php
$wp_list_table->display();
?>

  </form>

</div>