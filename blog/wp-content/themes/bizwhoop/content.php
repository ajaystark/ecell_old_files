<?php
/**
 * The template for displaying the content.
 * @package bizwhoop
 */

?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="bizwhoop-blog-post-box"> 
		<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>" class="bizwhoop-blog-thumb">
			<?php if(has_post_thumbnail()): ?>
			<?php $defalt_arg =array('class' => "img-responsive"); ?>
			<?php the_post_thumbnail('', $defalt_arg); ?>
			
			<?php endif; ?>
       </a>
		<article class="small"> 
			<span class="bizwhoop-blog-date"><span class="h3"><?php echo get_the_date('j'); ?></span> 
				<span><?php echo get_the_date('M'); ?></span>
			</span> 
			<h2><a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a> </h2>
			<?php the_content(); ?>
			<div class="bizwhoop-blog-category"> 
				<i class="fa fa-folder"></i>
				<?php   $cat_list = get_the_category_list();
				if(!empty($cat_list)) { ?>
				<?php the_category(', '); ?>
				<?php } ?>
				<a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) ));?>"><i class="fa fa-user"></i> <?php _e('by','bizwhoop'); ?>
				<?php the_author(); ?>
				</a> 
			</div>
				<?php wp_link_pages( array( 'before' => '<div class="link">' . __( 'Pages:', 'bizwhoop' ), 'after' => '</div>' ) ); ?>
		</article>
	</div>
</div>