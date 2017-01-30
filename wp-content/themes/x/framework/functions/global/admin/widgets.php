<?php

// =============================================================================
// FUNCTIONS/GLOBAL/ADMIN/WIDGETS.PHP
// -----------------------------------------------------------------------------
// Sets up the default widget areas for X.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Widget Areas
// =============================================================================

// Widget Areas
// =============================================================================

//
// 1. Default sidebar.
// 2. Widgetbar.
// 3. Footer.
//

if ( ! function_exists( 'x_widgets_init' ) ) :
  function x_widgets_init() {

    register_sidebar( array( // 1
      'name'          => __( 'Main Sidebar', '__x__' ),
      'id'            => 'sidebar-main',
      'description'   => __( 'Appears on posts and pages that include the sidebar.', '__x__' ),
      'before_widget' => '<div id="%1$s" class="widget %2$s">',
      'after_widget'  => '</div>',
      'before_title'  => '<h4 class="h-widget">',
      'after_title'   => '</h4>',
    ) );

    $num = ( get_theme_mod( 'x_header_widget_areas' ) == '' ) ? 2 : get_theme_mod( 'x_header_widget_areas' ); // 2
    $i   = 0;
    while ( $i < $num ) : $i ++;
      register_sidebar( array(
        'name'          => __( 'Header Widget Area #', '__x__' ) . $i,
        'id'            => 'header-' . $i,
        'description'   => __( 'Widgetized header area.', '__x__' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="h-widget">',
        'after_title'   => '</h4>',
      ) );
    endwhile;

    $num = ( get_theme_mod( 'x_footer_widget_areas' ) == '' ) ? 3 : get_theme_mod( 'x_footer_widget_areas' ); // 3
    $i   = 0;
    while ( $i < $num ) : $i ++;
      register_sidebar( array(
        'name'          => __( 'Footer Widget Area #', '__x__' ) . $i,
        'id'            => 'footer-' . $i,
        'description'   => __( 'Widgetized footer area.', '__x__' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="h-widget">',
        'after_title'   => '</h4>',
      ) );
    endwhile;

  }
  add_action( 'widgets_init', 'x_widgets_init' );
endif;