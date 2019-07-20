<?php /* The template for displaying Author Bio. */ ?>
<section>
	<div class="authorbox mb">
		<div class="authorleft">
			<div class="authorimg"><?php  echo get_avatar( get_the_author_meta( 'email' ), '136' ); ?></div>
       		<div class="authorbio">
				<a class="author-title" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
                       <?php _e('By', 'wiles'); ?><?php echo get_the_author(); ?></a>
			
				
				<?php if ( get_the_author_meta( 'url' ) != '' ) { ?>
				  
				<?php } ?>
				<p class=""><?php the_author_meta( 'description' ); ?></p>
                <a class="author-site" href="<?php the_author_meta('url'); ?>" title="<?php _e('Visit my Website', 'wiles'); ?>" target="_blank"><?php the_author_meta('url'); ?></a>
            </div>
   		</div>
	</div>
</section>

			