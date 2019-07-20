<?php
/* The template for displaying Comments.
 * @package wiles */
if ( post_password_required() )
	return;
?>
<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
		<h4 class="comments-title">
			<?php comments_number(__('No Comments', 'wiles'), __('1 Comment', 'wiles'), __( '% Comments', 'wiles') )?>
		</h4>

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-above" class="comment-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'wiles' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'wiles' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'wiles' ) ); ?></div>
		</nav><!-- #comment-nav-above -->
	<?php endif; // check for comment navigation ?>

	<ol class="comment-list"><?php wp_list_comments( array( 'callback' => 'wiles_comment' ) ); ?></ol><!-- .comment-list -->

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below" class="comment-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'wiles' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'wiles' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'wiles' ) ); ?></div>
		</nav><!-- #comment-nav-below -->
	<?php endif; // check for comment navigation ?>
	<?php endif; // have_comments() ?>

	<?php if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'wiles' ); ?></p>
	<?php endif; ?>
	<?php comment_form(); ?>
</div><!-- #comments -->