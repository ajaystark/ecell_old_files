<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @package bizwhoop
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> >
<div class="wrapper">
<!--
<?php esc_html_e( 'Skip to content', 'bizwhoop' ); ?>
<div class="wrapper">
<header class="bizwhoop-trhead">
	<!--==================== Header ====================-->
  <div class="bizwhoop-main-nav">
      <nav class="navbar navbar-default navbar-wp">
        <div class="container">
          <div class="navbar-header">
            <!-- Logo -->
            <?php
            if(has_custom_logo())
            {
            // Display the Custom Logo
            the_custom_logo();
            }
             else { ?>
            <a class="navbar-brand" href="<?php echo esc_url(home_url( '/' )); ?>"><?php bloginfo('name'); ?>
			<br>
            <span class="site-description"><?php echo  get_bloginfo( 'description', 'display' ); ?></span>   
            </a>      
            <?php } ?>
            <!-- Logo -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#wp-navbar"> <span class="sr-only">
			<?php echo 'Toggle Navigation'; ?></span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
            </div>
        <!-- /navbar-toggle --> 
        
        <!-- Navigation -->
        <div class="collapse navbar-collapse" id="wp-navbar">
         <?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => false, 'menu_class' => 'nav navbar-nav navbar-right', 'fallback_cb' => 'bizwhoop_custom_navwalker::fallback' , 'walker' => new bizwhoop_custom_navwalker() ) ); ?>
        </div>
        <!-- /Navigation --> 
      </div>
    </nav>
  </div>
</header>
<!-- #masthead --> 