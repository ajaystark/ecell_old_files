<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="form-group">
    	<input type="text" class="form-control"  name="s" id="s"/ required>
    	<label><?php esc_attr_e( "Search Here", 'bizwhoop' ); ?></label>
	</div>
	<button type="submit" class="btn"><?php _e('Search','bizwhoop'); ?></button>
</form>