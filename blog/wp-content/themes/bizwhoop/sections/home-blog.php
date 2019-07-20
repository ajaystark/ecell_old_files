<?php $bizwhoop_news_enable = get_theme_mod('bizwhoop_news_enable');
	if($bizwhoop_news_enable)
	{ $bizwhoop_total_posts = get_option('posts_per_page'); /* number of latest posts to show */
	
	if( !empty($bizwhoop_total_posts) && ($bizwhoop_total_posts > 0) ):

    $bizwhoop_news_background = get_theme_mod('bizwhoop_news_background');
    $bizwhoop_news_overlay_color = get_theme_mod('bizwhoop_news_overlay_color');
    $bizwhoop_news_text_color = get_theme_mod('bizwhoop_news_text_color'); 
	   $bizwhoop_new_slider_category = get_theme_mod('slider_category'); ?>
<style>
.ta-blog-section .ta-heading h3.ta-heading-inner {
color: <?php echo $bizwhoop_news_text_color ?>;
}
.ta-blog-section .ta-heading .ta-heading-inner::before {
border-color: <?php echo $bizwhoop_news_text_color ?>;
}
</style>
<!--==================== BLOG SECTION ====================-->
<?php if($bizwhoop_news_background != '') { ?>

<section id="blog" class="bizwhoop-section text-center" style="background-image:url('<?php echo $bizwhoop_news_background;?>');">
<?php } else { ?>
<section id="blog" class="bizwhoop-section text-center">
  <?php } ?>
  <div class="overlay" style="background-color: <?php echo esc_attr($bizwhoop_news_overlay_color);?>;">
    <div class="container">
      <div class="row">
        <div class="row padding-bottom-80">
			<div class="ta-heading">
            <?php $bizwhoop_news_title = get_theme_mod('bizwhoop_news_title',__('Latest <span>News</span>','bizwhoop'));
          
            if( !empty($bizwhoop_news_title) ):
              echo '<h1 class="ta-heading-inner">'.$bizwhoop_news_title.'</h1>';
            endif; ?>
          
          <?php  $bizwhoop_news_subtitle = get_theme_mod('bizwhoop_news_subtitle',__('laoreet ipsum eu laoreet. ugiignissimat Vivamus dignissim feugiat erat sit amet convallis.','bizwhoop'));

            if( !empty($bizwhoop_news_subtitle) ): ?>
          <p style="color: <?php echo $bizwhoop_news_text_color ?>;"><?php echo $bizwhoop_news_subtitle ?> </p>
          <?php endif; ?>
        </div>
		</div>
      </div>
      <div class="clear"></div>
      <div class="row">
        <?php $news_select = get_theme_mod('news_select',3);
			   $news_setting = get_theme_mod('slider_post_enable',true);
			
			   if( $news_setting == false )
			   {
			     $bizwhoop_latest_loop = new WP_Query(array( 'post_type' => 'post', 'posts_per_page' => $news_select, 'order' => 'DESC',  'ignore_sticky_posts' => true , 'category__not_in'=>$bizwhoop_new_slider_category));
			   }
			   else
			   {
			     $bizwhoop_latest_loop = new WP_Query(array( 'post_type' => 'post', 'posts_per_page' => $news_select, 'order' => 'DESC','ignore_sticky_posts' => true, ''));
			   }
			    if ( $bizwhoop_latest_loop->have_posts() ) :
			     while ( $bizwhoop_latest_loop->have_posts() ) : $bizwhoop_latest_loop->the_post();?>
        <div class="col-md-4 wow pulse animated">
          <div class="ta-blog-post-box">
            <?php if(has_post_thumbnail()): ?>
            <a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>" class="ta-blog-thumb"> 
              <?php $defalt_arg =array('class' => "img-responsive"); ?>
              <?php the_post_thumbnail('', $defalt_arg); ?>
            </a>  
            <?php endif; ?>
            <article class="small">
              <span class="ta-blog-date"> 
                <span class="h3"><?php echo get_the_date('j'); ?></span> 
                <span><?php echo get_the_date('M'); ?></span> 
              </span>
              <h2> <a href="<?php echo get_permalink() ?>" title="<?php echo get_the_title() ?>"><?php echo get_the_title() ?></a> </h2>
              <div class="ta-blog-category"> <i class="fa fa-folder"></i>&nbsp;
                <?php $cat_list = get_the_category_list();
								if(!empty($cat_list)) { ?>
                <?php the_category(', '); ?>
                <?php } ?>
                <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) );?>"> <i class="fa fa-user"></i>&nbsp;by
                <?php the_author(); ?>
                </a> 
              </div>
            </article>
          </div>
        </div>
        <?php endwhile; endif;	wp_reset_postdata(); ?>
      </div>
      <?php $view_button_label = get_theme_mod('view_button_label','View More');
			$view_button_link = get_theme_mod('view_button_link','#');
			$view_button_link_target = get_theme_mod('view_button_link_target',true); ?>
      <div class="text-center margin-top-50"><a href="<?php echo $view_button_link; ?>" <?php if( $view_button_link_target == true) { echo "target='_blank'"; } ?>  class="btn btn-theme"><?php echo $view_button_label; ?></a></div>
    </div>
    <!-- /.container --> 
  </div>
</section>
<?php endif; ?>
<?php } ?>