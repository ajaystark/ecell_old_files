<?php

$themename = "wiles";
$themefolder = "wiles";

// Constants for the theme name, folder and remote XML url
define( 'MTHEME_NOTIFIER_THEME_NAME', $themename );
define( 'MTHEME_NOTIFIER_THEME_FOLDER_NAME', $themefolder );

if ( ! function_exists( 'wiles_setup' ) ) :

/** Sets up theme defaults and registers support for various WordPress features. */
function wiles_setup() {
	/* Make theme available for translation
	  Translations can be filed in the /languages/ directory	 */
	load_theme_textdomain( 'wiles', get_template_directory() . '/languages' );
	/* Add default posts and comments RSS feed links to head */
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'custom-background' );
	 add_theme_support( 'title-tag' ); 
	/* Add callback for custom TinyMCE editor stylesheets. (editor-style.css) */
     add_editor_style();
	/* Enable support for Post Thumbnails on posts and pages */
	add_theme_support( 'post-thumbnails' );
	/* This theme uses wp_nav_menu() in one location. */
	register_nav_menus( array(
		
		'primary' => __( 'Primary Menu', 'wiles' ),
		'social' => __( 'Social Menu', 'wiles' ),
		'footer-menu' => __( 'Footer Menu', 'wiles' ),
	) );

   global $content_width;
  if ( ! isset( $content_width ) ) { $content_width = 800; /* pixels */ }
	
	}
endif; // wiles_setup
add_action( 'after_setup_theme', 'wiles_setup' );

// Theme Functions 

require( get_template_directory() . '/functions/theme-functions.php');
require( get_template_directory() . '/functions/widgetize-theme.php');

/* Custom template tags for this theme. */
require( get_template_directory() . '/inc/paginatelinks.php'); 

/* Theme customizer */
include 'admin/settings.php';

?>