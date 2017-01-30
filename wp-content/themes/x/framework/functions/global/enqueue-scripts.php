<?php

// =============================================================================
// FUNCTIONS/GLOBAL/ENQUEUE-SCRIPTS.PHP
// -----------------------------------------------------------------------------
// Enqueue all scripts for X.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Register and Enqueue Site Scripts
//   02. Register and Enqueue Post Meta Scripts
//   03. Register and Enqueue Customizer Scripts
// =============================================================================

// Register and Enqueue Site Scripts
// =============================================================================

//
// Conditionally adds JavaScript to the footer of the site for improved
// performance and loading time. Selectivizr is enqueued via a custom function
// to add conditional loading for legacy versions of Internet Explorer.
//

if ( ! function_exists( 'x_enqueue_site_scripts' ) ) :
  function x_enqueue_site_scripts() {

    //
    // URI variable.
    //

    $get_template_directory_uri = get_template_directory_uri();


    //
    // One page navigation variables.
    //

    $one_page_nav_meta = get_post_meta( get_the_ID(), '_x_page_one_page_navigation', true );
    $one_page_nav      = ( $one_page_nav_meta == '' ) ? 'Deactivated' : $one_page_nav_meta;


    //
    // Register theme scripts.
    //

    // Vendor scripts.
    wp_register_script( 'x',                   $get_template_directory_uri . '/framework/js/x.min.js',                                array( 'jquery' ),                 NULL, false );
    wp_register_script( 'scrollspy-mod',       $get_template_directory_uri . '/framework/js/scrollspy-mod.min.js',                    array( 'jquery' ),                 NULL, true );
    wp_register_script( 'vend-backstretch',    $get_template_directory_uri . '/framework/js/vendor/backstretch-2.0.3.min.js',         array( 'jquery' ),                 NULL, false );
    wp_register_script( 'vend-easing',         $get_template_directory_uri . '/framework/js/vendor/easing-1.3.0.min.js',              array( 'jquery' ),                 NULL, true );
    wp_register_script( 'vend-enquire',        $get_template_directory_uri . '/framework/js/vendor/enquire-2.0.1.min.js',             array( 'jquery' ),                 NULL, true );
    wp_register_script( 'vend-hoverintent',    $get_template_directory_uri . '/framework/js/vendor/hoverintent-7.0.0.min.js',         array( 'jquery' ),                 NULL, true );
    wp_register_script( 'vend-isotope',        $get_template_directory_uri . '/framework/js/vendor/isotope-1.5.25.min.js',            array( 'jquery' ),                 NULL, true );
    wp_register_script( 'vend-jplayer',        $get_template_directory_uri . '/framework/js/vendor/jplayer/jplayer-2.3.0.min.js',     array( 'jquery' ),                 NULL, false );
    wp_register_script( 'vend-modernizr',      $get_template_directory_uri . '/framework/js/vendor/modernizr-2.7.1.min.js',           NULL,                              NULL, false );
    wp_register_script( 'vend-nanoscroller',   $get_template_directory_uri . '/framework/js/vendor/nanoscroller-0.7.2.min.js',        array( 'jquery', 'vend-enquire' ), NULL, true );
    wp_register_script( 'vend-superfish',      $get_template_directory_uri . '/framework/js/vendor/superfish-1.5.1.min.js',           array( 'jquery' ),                 NULL, true );

    // BigVideo scripts.
    wp_register_script( 'vend-bigvideo-jquery-ui',    $get_template_directory_uri . '/framework/js/vendor/bigvideo/jquery-ui-1.8.22.min.js',   array( 'jquery' ),                                                                                 NULL, false );
    wp_register_script( 'vend-bigvideo-imagesloaded', $get_template_directory_uri . '/framework/js/vendor/bigvideo/imagesloaded-3.0.4.min.js', array( 'jquery', 'vend-bigvideo-jquery-ui' ),                                                      NULL, false );
    wp_register_script( 'vend-bigvideo-video',        $get_template_directory_uri . '/framework/js/vendor/bigvideo/video-4.1.0.min.js',        array( 'jquery', 'vend-bigvideo-jquery-ui', 'vend-bigvideo-imagesloaded' ),                        NULL, false );
    wp_register_script( 'vend-bigvideo-bigvideo',     $get_template_directory_uri . '/framework/js/vendor/bigvideo/bigvideo-1.0.0.min.js',     array( 'jquery', 'vend-bigvideo-jquery-ui', 'vend-bigvideo-imagesloaded', 'vend-bigvideo-video' ), NULL, false );

    // Admin scripts.
    wp_register_script( 'customizer-admin-js', $get_template_directory_uri . '/framework/js/admin/customizer-admin.min.js', array( 'jquery' ), NULL, true );


    //
    // Enqueue theme scripts.
    //

    if ( ! is_admin() ) {
      wp_enqueue_script( 'x' );
      wp_enqueue_script( 'vend-backstretch' );
      wp_enqueue_script( 'vend-easing' );
      wp_enqueue_script( 'vend-hoverintent' );
      wp_enqueue_script( 'vend-jplayer' );
      wp_enqueue_script( 'vend-modernizr' );
      wp_enqueue_script( 'vend-superfish' );
      wp_enqueue_script( 'vend-bigvideo-jquery-ui' );
      wp_enqueue_script( 'vend-bigvideo-imagesloaded' );
      wp_enqueue_script( 'vend-bigvideo-video' );
      wp_enqueue_script( 'vend-bigvideo-bigvideo' );
      if ( $one_page_nav != 'Deactivated' ) {
        wp_enqueue_script( 'scrollspy-mod' );
      }
      if ( x_get_stack() == 'icon' ) {
        wp_enqueue_script( 'vend-enquire' );
        wp_enqueue_script( 'vend-nanoscroller' );
      }
      if ( is_singular() ) {
        wp_enqueue_script( 'comment-reply' );
      }
      if ( is_post_type_archive( 'x-portfolio' ) || is_home() && get_theme_mod( 'x_blog_style' ) == 'masonry' || is_archive() && get_theme_mod( 'x_archive_style' ) ) {
        wp_enqueue_script( 'vend-isotope' );
      }
      if ( is_admin_bar_showing() ) {
        wp_enqueue_script( 'customizer-admin-js' );
      }
    }

  }
  add_action( 'wp_enqueue_scripts', 'x_enqueue_site_scripts' );
endif;

if ( ! function_exists( 'x_enqueue_selectivizr' ) ) :
  function x_enqueue_selectivizr() {
    if ( ! is_admin() ) {
      echo '<!--[if lt IE 9]><script type="text/javascript" src="' . get_template_directory_uri() . '/framework/js/vendor/selectivizr-1.0.2.min.js"></script><![endif]-->';
    }
  }
  add_action( 'wp_footer', 'x_enqueue_selectivizr', 9998, NULL );
endif;



// Register and Enqueue Post Meta Scripts
// =============================================================================

if ( ! function_exists( 'x_enqueue_post_meta_scripts' ) ) :
  function x_enqueue_post_meta_scripts( $hook ) {

    GLOBAL $post;

    if ( $hook != 'post.php' && $hook != 'post-new.php' ) {
      return;
    }

    echo '<script type="text/javascript">'
         . 'var x_ajax = {'
           . 'post_id : 0,'
           . 'nonce : ""'
         . '};'
         . 'x_ajax.nonce = "' . wp_create_nonce( 'x-ajax' ) . '";'
         . 'x_ajax.post_id = "' . $post->ID . '";'
       . '</script>';

    wp_register_script( 'post-meta-js', get_template_directory_uri() . '/framework/js/admin/post-meta.js', array( 'jquery', 'media-upload', 'thickbox' ), NULL, true );

    wp_enqueue_script( 'media-upload' );
    wp_enqueue_script( 'thickbox' );
    wp_enqueue_script( 'post-meta-js' );

  }
  add_action( 'admin_enqueue_scripts', 'x_enqueue_post_meta_scripts' );
endif;



// Register and Enqueue Customizer Scripts
// =============================================================================

//
// Admin scripts.
//

if ( ! function_exists( 'x_enqueue_customizer_admin_scripts' ) ) :
  function x_enqueue_customizer_admin_scripts() {

    wp_register_script( 'customizer-admin-js', get_template_directory_uri() . '/framework/js/admin/customizer-admin.min.js', array( 'jquery' ), NULL, true );
    wp_enqueue_script( 'customizer-admin-js' );

  }
  add_action( 'admin_enqueue_scripts', 'x_enqueue_customizer_admin_scripts' );
endif;


//
// App scripts.
//

if ( ! function_exists( 'x_enqueue_customizer_app_scripts' ) ) :
  function x_enqueue_customizer_app_scripts() {

    wp_register_script( 'customizer-app-js', get_template_directory_uri() . '/framework/js/admin/customizer-app.min.js', array( 'jquery' ), NULL, true );
    wp_enqueue_script( 'customizer-app-js' );

  }
  add_action( 'customize_controls_print_footer_scripts', 'x_enqueue_customizer_app_scripts' );
endif;