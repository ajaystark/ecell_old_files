<?php
/**
 * The template for displaying search results pages.
 *
 * @package bizwhoop
 */

get_header(); ?>
<!--==================== Breadcrumb ====================-->
<div class="bizwhoop-breadcrumb-section">
  <div class="overlay"> 
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-sm-6">
          <div class="bizwhoop-breadcrumb-title">
            <h1>
              <?php the_title(); ?>
            </h1>
          </div>
        </div>
        <div class="col-md-6">
          <ul class="bizwhoop-page-breadcrumb">
            <?php if (function_exists('bizwhoop_custom_breadcrumbs')) bizwhoop_custom_breadcrumbs();?>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="clearfix"></div>
<main id="content">
  <div class="container">
    <div class="row">
      <div class="<?php echo ( !is_active_sidebar( 'sidebar_primary' ) ? '12' :'9' ); ?> col-md-9">
                 <?php 
		global $i;
		if ( have_posts() ) : ?>
		<h2 class="margin-bottom-30"><?php printf( __( "Search Results for: %s", 'bizwhoop' ), '<span>' . get_search_query() . '</span>' ); ?></h2>
		<?php while ( have_posts() ) : the_post();  
		 get_template_part('content','');
		 endwhile; else : ?>
		<h2><?php _e( "Not Found", 'bizwhoop' ); ?></h2>
		<div class="">
		<p><?php _e( "Sorry, Do Not match.", 'bizwhoop' ); ?>
		</p>
		<?php get_search_form(); ?>
		</div><!-- .blog_con_mn -->
		<?php endif; ?>
      </div>
	  <aside class="col-md-3">
        <?php get_sidebar(); ?>
      </aside>
    </div>
  </div>
</main>
<?php
get_footer();
?>