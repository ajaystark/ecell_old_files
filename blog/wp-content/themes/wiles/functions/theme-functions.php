<?php
# Get Theme Options
/*-------------------------------*/
function wiles_get_option( $name ) {
	$get_options = get_option( 'wiles_options' );
	
	if( !empty( $get_options[$name] ))
		return $get_options[$name];
		
	return false ;
}

# Get Other Templates 
/*-----------------------------*/
function wiles_include($template){
	get_template_part ( get_template_directory() . '/inc/'.$template.'.php' );
}

#Excerpt Length
function wiles_custom_excerpt_length( $length ) {
	return 25;
}
add_filter( 'excerpt_length', 'wiles_custom_excerpt_length', 999 );



# No Title
function wiles_the_title ( $title ) {

	if ( in_the_loop() && ! is_page() ) {
		if ( ! $title )
			$title = __( 'Untitled', 'wiles' );
	}
	return $title;

}
add_filter( 'the_title', 'wiles_the_title' );

# Comments Function (Do not Edit)  
/*-------------------------- */
if ( ! function_exists( 'wiles_comment' ) ) :

function wiles_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;

	if ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) : ?>
	<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
		<div class="comment-body">
			<?php _e( 'Pingback:', 'wiles' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( 'Edit', 'wiles' ), '<span class="edit-link">', '</span>' ); ?>
		</div>

	<?php else : ?>
	<li id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>>
		
			<div class="comment-meta">
				<figure class="comment-avatar">
    	            <?php echo get_avatar( $comment, 48 ); ?>
                </figure>	
				
				<div class="comment-metadata">
				    <?php comment_author_link(); ?>
                    <span class="datetime"><?php comment_date('F j, Y'); ?></span>					
					<?php edit_comment_link( __( 'Edit', 'wiles' ), '<span class="edit-link">', '</span>' ); ?>
				</div><!-- .comment-metadata -->

				<?php if ( '0' == $comment->comment_approved ) : ?>
       				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'wiles' ); ?></p>
				<?php endif; ?>
		        <div class="comment-content">
				    <?php comment_text(); ?>
			    </div><!-- .comment-content ends -->
                 
				<div class="reply">
				    <?php comment_reply_link( array_merge( $args, array( 'add_below' => 'div-comment', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			    </div><!-- .reply --> 
            </div><!-- .comment-meta ends-->
		<!-- .comment-body -->
	<?php
	endif;
}
endif; // ends check for wiles_comment()

# Breadcrumbs
/* ------------------------- */
function wiles_breadcrumbs() {

  $delimiter = wiles_get_option('breadcrumbs_delimiter') ? wiles_get_option('breadcrumbs_delimiter') : '&raquo;';
  $before = '<span class="current">';
  $after = '</span>';
 
  if ( !is_home() && !is_front_page() || is_paged() ) {
 
    echo '<div itemscope itemtype="http://schema.org/WebPage" id="crumbs">'.__( 'You are here:' , 'wiles' );
 
    global $post;
    $homeLink = home_url();
    echo ' <a itemprop="breadcrumb" href="' . $homeLink . '">' . __( 'Home' , 'wiles' ) . '</a> ' . $delimiter . ' ';
 
    if ( is_category() ) {
      global $wp_query;
      $cat_obj = $wp_query->get_queried_object();
      $thisCat = $cat_obj->term_id;
      $thisCat = get_category($thisCat);
      $parentCat = get_category($thisCat->parent);
      if ($thisCat->parent != 0){
		$cat_code = get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' ');
		echo $cat_code = str_replace ('<a','<a itemprop="breadcrumb"', $cat_code );
	  }
      echo $before . '' . single_cat_title('', false) . '' . $after;
 
    } elseif ( is_day() ) {
      echo '<a itemprop="breadcrumb" href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo '<a itemprop="breadcrumb"  href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
      echo $before . get_the_time('d') . $after;
 
    } elseif ( is_month() ) {
      echo '<a itemprop="breadcrumb" href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo $before . get_the_time('F') . $after;
 
    } elseif ( is_year() ) {
      echo $before . get_the_time('Y') . $after;
 
    } elseif ( is_single() && !is_attachment() ) {
      if ( get_post_type() != 'post' ) {
        $post_type = get_post_type_object(get_post_type());
        $slug = $post_type->rewrite;
        echo '<a itemprop="breadcrumb" href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a> ' . $delimiter . ' ';
        echo $before . get_the_title() . $after;
      } else {
        $cat = get_the_category(); $cat = $cat[0];
        $cat_code = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
		echo $cat_code = str_replace ('<a','<a itemprop="breadcrumb"', $cat_code );

        echo $before . get_the_title() . $after;
      }
 
    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' ) {
      $post_type = get_post_type_object(get_post_type());
      echo $before . $post_type->labels->singular_name . $after;
 
    } elseif ( is_attachment() ) {
      $parent = get_post($post->post_parent);
      $cat = get_the_category($parent->ID); 
	  if(isset($cat[0])){
	  $cat = $cat[0];}
      echo '<a itemprop="breadcrumb" href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> ' . $delimiter . ' ';
      echo $before . get_the_title() . $after;
 
    } elseif ( is_page() && !$post->post_parent ) {
      echo $before . get_the_title() . $after;
 
    } elseif ( is_page() && $post->post_parent ) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_post($parent_id);
        $breadcrumbs[] = '<a itemprop="breadcrumb" href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
      echo $before . get_the_title() . $after;
 
    } elseif ( is_search() ) {
      echo $before ;
	  printf( __( 'Search Results for: %s', 'wiles' ),  get_search_query() );
	  echo  $after;
 
    } elseif ( is_tag() ) {
	  echo $before ;
	  printf( __( 'Tag Archives: %s', 'wiles' ), single_tag_title( '', false ) );
	  echo  $after;
 
    } elseif ( is_author() ) {
       global $author;
      $userdata = get_userdata($author);
      echo $before ;
	  printf( __( 'Author Archives: %s', 'wiles' ),  $userdata->display_name );
	  echo  $after;
 
    } elseif ( is_404() ) {
      echo $before;
	  _e( 'Not Found', 'wiles' );
	  echo  $after;
    }
 
    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo __('page ' , 'wiles') . ' ' . get_query_var('paged');
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }
 
    echo '</div>';
   } }

# Queue Comments Reply
/*-------------------------*/
function wiles_comments_queue_js(){
if ( (!is_admin()) && is_singular() && comments_open() )
  wp_enqueue_script( 'comment-reply' );
}
add_action('wp_enqueue_scripts', 'wiles_comments_queue_js');

# Theme Scripts
/*-------------------------*/
function wiles_scripts() {
    wp_enqueue_style( 'wiles-style', get_stylesheet_uri() );
    wp_enqueue_style( 'font-awesome', get_stylesheet_directory_uri() . '/fa/css/font-awesome.min.css' );
	wp_enqueue_script( 'wiles-common-scripts', get_template_directory_uri() . '/js/common-scripts.js', array( 'jquery' ) );	 
    wp_enqueue_script( 'wiles-dtl', get_template_directory_uri() . '/js/doubletaptogo.min.js', array( 'jquery' ) );
	wp_enqueue_script( 'flex-slider', get_template_directory_uri() . '/js/flexslider.min.js', array( 'jquery' ) );
	wp_enqueue_script( 'wiles-global', get_template_directory_uri() . '/js/global.js', array( 'jquery' ) );
  //wp_enqueue_script( 'wiles-tc', get_template_directory_uri() . '/js/theme-customizer.js', array( 'jquery' ) );	

	}
add_action( 'wp_enqueue_scripts', 'wiles_scripts' );

function wiles_live_preview() {
      wp_enqueue_script( 
           'wiles-themecustomizer', // Give the script a unique ID
           get_template_directory_uri() . '/js/theme-customizer.js', // Define the path to the JS file
           array(  'jquery', 'customize-preview' ), // Define dependencies
           '', // Define a version (optional) 
           true // Specify whether to put in footer (leave this true)
      );
   }
 //Enqueue live preview javascript in Theme Customizer admin screen
add_action( 'customize_preview_init' , 'wiles_live_preview'  );

#
function wiles_slug_fonts_url() {
    $fonts_url = '';
 
    /* Translators: If there are characters in your language that are not
    * supported by Lato, translate this to 'off'. Do not translate
    * into your own language.
    */
    $lato = _x( 'on', 'Lato font: on or off', 'wiles' );
 
    /* Translators: If there are characters in your language that are not
    * supported by Open Sans, translate this to 'off'. Do not translate
    * into your own language.
    */
    $open_sans = _x( 'on', 'Open Sans font: on or off', 'wiles' );
 
    if ( 'off' !== $lato || 'off' !== $open_sans ) {
        $font_families = array();
 
        if ( 'off' !== $lato ) {
            $font_families[] = 'Lato:400,700,400italic';
        }
 
        if ( 'off' !== $open_sans ) {
            $font_families[] = 'Open Sans:700italic,400,800,600';
        }
 
        $query_args = array(
            'family' => urlencode( implode( '|', $font_families ) ),
            'subset' => urlencode( 'latin,latin-ext' ),
        );
 
        $fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
    }
 
    return $fonts_url;
}

function wiles_slug_scripts_styles() {
    wp_enqueue_style( 'wiles-fonts', wiles_slug_fonts_url(), array(), null );
}
add_action( 'wp_enqueue_scripts', 'wiles_slug_scripts_styles' );

# Get Most Recent posts from Category
/*-------------------------*/
function wiles_last_posts_cat($numberOfPosts = 5 , $cats = 1){
	global $post;
	$orig_post = $post;

	$lastPosts = get_posts('category='.$cats.'&numberposts='.$numberOfPosts);
	foreach($lastPosts as $post): setup_postdata($post);
?>
<li class="mbottom">
	<?php if ( has_post_thumbnail() ) : ?>			
		<div class="post-thumbnail mright">
			<a href="<?php the_permalink(); ?>" title="<?php printf( __( 'Permalink to %s', 'wiles' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_post_thumbnail('thumbnail'); ?></a>
		</div><!-- post-thumbnail /-->
	<?php endif; ?>
	<p><a href="<?php the_permalink(); ?>"><?php the_title();?></a></p>
</li>
<?php endforeach;
	$post = $orig_post;
}
?>