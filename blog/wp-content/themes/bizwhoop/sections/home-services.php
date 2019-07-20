<?php
$bizwhoop_service_enable = get_theme_mod('bizwhoop_service_enable');
if($bizwhoop_service_enable){
$service_post_one = array(get_theme_mod('service_post_one'));
$service_post_two = array(get_theme_mod('service_post_two'));
$service_post_three = array(get_theme_mod('service_post_three'));
?>
<!--==================== SERVICE SECTION ====================-->
<section id="service" class="bizwhoop-section text-center">
  <div class="container">
    <div class="row padding-bottom-80 text-left">
      <div class="col-md-4 col-sm-6 fadeInDown animated">
        <?php $bizwhoop_service_title = esc_attr(get_theme_mod('bizwhoop_service_title'));
          if( !empty($bizwhoop_service_title) ):
          echo '<h1>'.$bizwhoop_service_title.'</h1>';
          endif; ?>
      </div>
      <div class="col-md-6 padding-top-20 col-sm-6 col-md-offset-1 fadeInDown animated text-left">
        <?php $bizwhoop_service_subtitle = esc_attr(get_theme_mod('bizwhoop_service_subtitle'));
          if( !empty($bizwhoop_service_subtitle) ):
          echo '<p>'.$bizwhoop_service_subtitle.'</p>';
        endif; ?>
      </div>
    </div>
    <div class="row">
      <?php if($service_post_one){ 
			  $ads_query = new WP_Query( array( 'post_type' => 'page','post__in' => $service_post_one));
            if( $ads_query->have_posts() ){                
                while( $ads_query->have_posts() ){
                    $ads_query->the_post(); ?>
      <div class="col-md-4">
        <div class="bizwhoop-service">
          <div class="bizwhoop-service-inner">
            <div class="bizwhoop-service-inner-img">
              <?php if(has_post_thumbnail()){ $defalt_arg =array('class' => "img-responsive"); the_post_thumbnail('', $defalt_arg); }  ?>
            </div>
            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            <p><?php echo get_service_excerpt(); ?></p>
          </div>
        </div>
      </div>
      <?php } } wp_reset_query(); }
		if($service_post_two){ 
			$ads_query = new WP_Query( array( 'post_type' => 'page','post__in' => $service_post_two));
            if( $ads_query->have_posts() ){                
                while( $ads_query->have_posts() ){
                    $ads_query->the_post(); ?>
      <div class="col-md-4">
        <div class="bizwhoop-service">
          <div class="bizwhoop-service-inner">
            <div class="bizwhoop-service-inner-img">
              <?php if(has_post_thumbnail()){  
					  $defalt_arg =array('class' => "img-responsive");  
					  the_post_thumbnail('', $defalt_arg); 
					  }  ?>
            </div>
            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            <p><?php echo get_service_excerpt(); ?></p>
          </div>
        </div>
      </div>
      <?php } } wp_reset_query(); }
	  if($service_post_three){ 
			$ads_query = new WP_Query( array( 'post_type' => 'page','post__in' => $service_post_three));
            if( $ads_query->have_posts() ){                
                while( $ads_query->have_posts() ){
                    $ads_query->the_post(); ?>
      <div class="col-md-4">
        <div class="bizwhoop-service">
          <div class="bizwhoop-service-inner">
            <div class="bizwhoop-service-inner-img">
              <?php if(has_post_thumbnail()){  
					  $defalt_arg =array('class' => "img-responsive");  
					  the_post_thumbnail('', $defalt_arg); 
					  }  ?>
            </div>
            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            <p><?php echo get_service_excerpt(); ?></p>
          </div>
        </div>
      </div>
      <?php } } wp_reset_query(); } ?>
    </div>
  </div>
</section>
<?php } ?>