<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package bizwhoop
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
} ?>
<aside id="secondary" class="widget-area" role="complementary">
	<div id="sidebar-right" class="bizwhoop-sidebar">
		<?php dynamic_sidebar( 'sidebar' ); ?>
	</div>
</aside><!-- #secondary -->
