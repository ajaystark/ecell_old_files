<?php
include 'inc-menu-settings.php';

$eventsShortcodes = explara\ShortcodeStore::getAll('events');

$groupsShortcodes = explara\ShortcodeStore::getAll('groups');

?>
<div class="wrap redlof">
	<div id="account" class="tabcontent metabox-holder">


	<div class="postbox explara-lite-box">
		<h3 class="hndle" id="explara-lite-header-bar">
		<span>Events - Shortcodes</span>
		<span class="explara-box-link" style="float:right">
			<a href="<?php echo admin_url() . 'admin.php?page=explara-lite&tab=shortcodes-create&type=events'; ?>" id="explara-lite-gen-code-link">
				Generate Shortcode
			</a>
		</span>
		</h3>
		<div class="inside">

			<?php if ($eventsShortcodes == false) {
	echo "No shortcodes generated yet.";
}?>

			<table class="">
				<?php foreach ($eventsShortcodes as $shortcode) {?>
				<tr>
					<th style="padding-right: 50px">
						<label><?php echo $shortcode['config'] ?></label>
					</th>
					<td>
						<?php echo $shortcode['shortcode'] ?>
					</td>
				</tr>
			<?php }?>
			</table>
		</div>
	</div>

	<div class="postbox explara-lite-box">
		<h3 class="hndle" id="explara-lite-header-bar">
		<span>Groups - Shortcodes</span>
		<span class="explara-box-link" style="float:right">
			<a href="<?php echo admin_url() . 'admin.php?page=explara-lite&tab=shortcodes-create&type=groups'; ?>" class="explara-lite-gen-code-link" id="explara-lite-gen-code-link">
				Generate Shortcode
			</a>
		</span>
		</h3>
		<div class="inside">
			<?php if ($groupsShortcodes == false) {
	echo "No shortcodes generated yet.";
}?>
			<table class="">
				<?php foreach ($groupsShortcodes as $shortcode) {?>
				<tr>
					<th style="padding-right: 50px">
						<label><?php echo $shortcode['config'] ?></label>
					</th>
					<td>
						<?php echo $shortcode['shortcode'] ?>
					</td>
				</tr>
			<?php }?>
			</table>

		</div>
	</div>


	</div>
</div>
