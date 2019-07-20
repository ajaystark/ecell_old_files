<?php
/* The template part for displaying a message that posts cannot be found. @package wiles */
?>
<div class="singlebox noresult">
  <div class="not-found-block center">
        <h3><?php _e('Oops..! No Results Found.', 'wiles'); ?></h3>
            <p><?php _e('Perhaps, Try searching with different keywords.', 'wiles'); ?></p>	                
                <?php get_search_form(); ?>
		  

  </div>
</div>