<?php

/*
Plugin Name: X Shortcodes
Plugin URL: http://theme.co/
Description: Includes all shortcode functionality for X.
Version: 2.0.7
Author: Themeco
Author URI: http://theme.co/
*/

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Define Constants
//   02. Require Files
//   03. Enqueue Site Scripts
//   04. Enqueue Site Styles
//   05. Add Admin Shortcode Button
// =============================================================================

// Define Constants
// =============================================================================

define( 'X_SHORTCODES_URL', plugins_url( '', __FILE__ ) );



// Require Files
// =============================================================================

function x_shortcodes_init() {
  require_once( 'functions/has-shortcode.php' );
  require_once( 'functions/shortcodes.php' );
}

add_action( 'init', 'x_shortcodes_init' );



// Enqueue Site Scripts
// =============================================================================

function x_shortcodes_enqueue_site_scripts() {

  if ( ! is_admin() ) {

    wp_register_script( 'x-shortcodes',         X_SHORTCODES_URL . '/js/x-shortcodes.min.js',                      array( 'jquery' ),                                                             NULL, true );
    wp_register_script( 'vend-caroufredsel',    X_SHORTCODES_URL . '/js/vendor/caroufredsel-6.2.1.min.js',         array( 'jquery' ),                                                             NULL, true );
    wp_register_script( 'vend-fittext',         X_SHORTCODES_URL . '/js/vendor/fittext-1.1.0.min.js',              array( 'jquery' ),                                                             NULL, false );
    wp_register_script( 'vend-flexslider',      X_SHORTCODES_URL . '/js/vendor/flexslider-2.1.0.min.js',           array( 'jquery' ),                                                             NULL, true );
    wp_register_script( 'vend-ilightbox',       X_SHORTCODES_URL . '/js/vendor/ilightbox-2.1.5.min.js',            array( 'jquery' ),                                                             NULL, true );
    wp_register_script( 'vend-waypoints',       X_SHORTCODES_URL . '/js/vendor/waypoints-2.0.3.min.js',            array( 'jquery' ),                                                             NULL, true );
    wp_register_script( 'vend-boot-alert',      X_SHORTCODES_URL . '/js/vendor/bootstrap/alert-2.3.0.min.js',      array( 'jquery' ),                                                             NULL, true );
    wp_register_script( 'vend-boot-collapse',   X_SHORTCODES_URL . '/js/vendor/bootstrap/collapse-2.3.0.min.js',   array( 'jquery' ),                                                             NULL, true );
    wp_register_script( 'vend-boot-popover',    X_SHORTCODES_URL . '/js/vendor/bootstrap/popover-2.3.0.min.js',    array( 'jquery', 'vend-boot-tooltip' ),                                        NULL, true );
    wp_register_script( 'vend-boot-tab',        X_SHORTCODES_URL . '/js/vendor/bootstrap/tab-2.3.0.min.js',        array( 'jquery' ),                                                             NULL, true );
    wp_register_script( 'vend-boot-tooltip',    X_SHORTCODES_URL . '/js/vendor/bootstrap/tooltip-2.3.0.min.js',    array( 'jquery', 'vend-boot-alert', 'vend-boot-tab', 'vend-boot-transition' ), NULL, true );
    wp_register_script( 'vend-boot-transition', X_SHORTCODES_URL . '/js/vendor/bootstrap/transition-2.3.0.min.js', array( 'jquery' ),                                                             NULL, true );

    wp_enqueue_script( 'x-shortcodes' );
    wp_enqueue_script( 'vend-flexslider' );
    wp_enqueue_script( 'vend-boot-collapse' );
    wp_enqueue_script( 'vend-boot-popover' );
    wp_enqueue_script( 'vend-boot-tab' );
    wp_enqueue_script( 'vend-boot-tooltip' );
    wp_enqueue_script( 'vend-boot-transition' );
    if ( x_has_shortcode( 'responsive_text' ) ) {
      wp_enqueue_script( 'vend-fittext' );
    }
    if ( x_has_shortcode( 'lightbox' ) ) {
      wp_enqueue_script( 'vend-ilightbox' );
    }
    if ( x_has_shortcode( 'column' ) || x_has_shortcode( 'vc_column' ) || x_has_shortcode( 'recent_posts' ) || x_has_shortcode( 'skill_bar' ) ) {
      wp_enqueue_script( 'vend-waypoints' );
    }
    if ( x_has_shortcode( 'alert' ) ) {
      wp_enqueue_script( 'vend-boot-alert' );
    }

  }

}

add_action( 'wp_enqueue_scripts', 'x_shortcodes_enqueue_site_scripts' );



// Enqueue Site Styles
// =============================================================================

function x_shortcodes_enqueue_site_styles() {

  if ( ! is_admin() ) {

    $stack            = ( get_theme_mod( 'x_stack' )            ) ? get_theme_mod( 'x_stack' )            : 'integrity';
    $integrity_design = ( get_theme_mod( 'x_integrity_design' ) ) ? get_theme_mod( 'x_integrity_design' ) : 'light';

    wp_register_style( 'x-shortcodes-integrity-light', X_SHORTCODES_URL . '/css/integrity-light.css', NULL, '1.0.0', 'all' );
    wp_register_style( 'x-shortcodes-integrity-dark',  X_SHORTCODES_URL . '/css/integrity-dark.css',  NULL, '1.0.0', 'all' );
    wp_register_style( 'x-shortcodes-renew',           X_SHORTCODES_URL . '/css/renew.css',           NULL, '1.0.0', 'all' );
    wp_register_style( 'x-shortcodes-icon',            X_SHORTCODES_URL . '/css/icon.css',            NULL, '1.0.0', 'all' );

    switch ( $stack ) {
      case 'integrity':
        if ( $integrity_design == 'dark' ) {
          wp_enqueue_style( 'x-shortcodes-integrity-dark' );
        } else {
          wp_enqueue_style( 'x-shortcodes-integrity-light' );
        }
        break;
      case 'renew':
        wp_enqueue_style( 'x-shortcodes-renew' );
        break;
      case 'icon':
        wp_enqueue_style( 'x-shortcodes-icon' );
        break;
    }

  }

}

add_action( 'wp_enqueue_scripts', 'x_shortcodes_enqueue_site_styles' );



// Add Admin Shortcode Button
// =============================================================================

class x_shortcodes_add_buttons {

  function __construct() {
    add_action( 'init', array( &$this, 'init' ) );
  }
  
  function init() {
    if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) ) {
      return;
    }

    if ( get_user_option( 'rich_editing' ) == 'true' ) {
      add_filter( 'mce_external_plugins', array( &$this, 'x_shortcodes_plugin' ) );
      add_filter( 'mce_buttons', array( &$this,'x_shortcodes_register' ) );
    }  
  }

  function x_shortcodes_plugin( $plugin_array ) {
    $tinymce_js = X_SHORTCODES_URL .'/js/admin/tinymce.min.js';
    $plugin_array['x_shortcodes'] = $tinymce_js;
    return $plugin_array;
  }

  function x_shortcodes_register( $buttons ) {
    array_push( $buttons, 'x_shortcodes_button' );
    return $buttons;
  }

}

$x_shortcodes = new x_shortcodes_add_buttons;