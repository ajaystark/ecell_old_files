<?php ?>		
<p class="post-meta vsmall">
	<span class="post-meta-date"><?php _e( 'Updated on ' , 'wiles' ); ?><?php echo the_time(get_option( 'date_format' )) ?></span>
	<span class="post-meta-author"><?php _e( 'By ' , 'wiles' ); ?><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) )?>" title="<?php sprintf( esc_attr__( 'View all posts by %s', 'wiles' ), get_the_author() ) ?>"><?php echo get_the_author() ?> </a></span>
	<?php if ( post_password_required() != true ): ?>
	    <span class="post-meta-comments"><?php comments_popup_link( __( 'Leave a comment', 'wiles' ), __( '1 Comment', 'wiles' ), __( '% Comments', 'wiles' ) ); ?></span>
    <?php endif; ?>
</p>
<div class="clear"></div>
<?php ?>