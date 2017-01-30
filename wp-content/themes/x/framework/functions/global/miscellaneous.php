<?php

// =============================================================================
// FUNCTIONS/GLOBAL/MISCELLANEOUS.PHP
// -----------------------------------------------------------------------------
// Miscellaneous functions.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Site Icons
//   02. Google Authorship Meta
//   03. Google Authorship Author
//   04. Global Social Output
//   05. Remove Tag Cloud Inline Style
//   06. Custom Title
//   07. Excerpt Length
//   08. Excerpt More String
//   09. Content More String
//   10. Remove Recent Comments Style
//   11. Remove Gallery Style
//   12. Remove Gallery <br> Tags
//   13. User Contact Information
//   14. Link Pages
//   15. Clean Up Shortcodes
// =============================================================================

// Site Icons
// =============================================================================

if ( ! function_exists( 'x_site_icons' ) ) :
  function x_site_icons() {

    $icon_favicon       = get_theme_mod( 'x_icon_favicon' );
    $icon_touch         = get_theme_mod( 'x_icon_touch' );
    $icon_tile          = get_theme_mod( 'x_icon_tile' );
    $icon_tile_bg_color = get_theme_mod( 'x_icon_tile_bg_color' );

    if ( $icon_favicon != '' ) {
      echo '<link rel="shortcut icon" href="' . $icon_favicon . '">';
    }

    if ( $icon_touch != '' ) {
      echo '<link rel="apple-touch-icon-precomposed" href="' . $icon_touch . '">';
    }

    if ( $icon_tile != '' ) {
      echo '<meta name="msapplication-TileColor" content="' . $icon_tile_bg_color . '">';
      echo '<meta name="msapplication-TileImage" content="' . $icon_tile . '">';
    }

  }
  add_action( 'wp_head', 'x_site_icons' );
endif;



// Google Authorship Meta
// =============================================================================

if ( ! function_exists( 'x_google_authorship_meta' ) ) :
  function x_google_authorship_meta() {

    $author = sprintf( '%s', get_the_author() );

    $title = sprintf( '%s', get_the_title() );

    $date = sprintf( '<time class="entry-date updated" datetime="%1$s">%2$s</time>',
      esc_attr( get_the_date( 'c' ) ),
      esc_html( get_the_date( 'm.d.Y' ) )
    );

    printf( '<span class="visually-hidden">%1$s%2$s%3$s</span>',
      '<span class="author vcard"><span class="fn">' . $author . '</span></span>',
      '<span class="entry-title">' . $title . '</span>',
      $date
    );

  }
endif;



// Google Authorship Author
// =============================================================================

if ( ! function_exists( 'x_google_authorship_author' ) ) :
  function x_google_authorship_author() {

    GLOBAL $post;

    $show_author_link   = is_front_page() || is_home() || is_singular();
    $google_author_link = get_the_author_meta( 'googleplus', $post->post_author );

    if ( $show_author_link ) :
      if ( $google_author_link ) :
        echo '<link rel="author" href="' . $google_author_link . '">';
      endif;
    endif;

  }
  add_action( 'wp_head', 'x_google_authorship_author' );
endif;



// Global Social Output
// =============================================================================

if ( ! function_exists( 'x_social_global' ) ) :
  function x_social_global( $position = 'topbar' ) {

    $facebook    = get_theme_mod( 'x_social_facebook' );
    $twitter     = get_theme_mod( 'x_social_twitter' );
    $google_plus = get_theme_mod( 'x_social_googleplus' );
    $linkedin    = get_theme_mod( 'x_social_linkedin' );
    $foursquare  = get_theme_mod( 'x_social_foursquare' );
    $youtube     = get_theme_mod( 'x_social_youtube' );
    $vimeo       = get_theme_mod( 'x_social_vimeo' );
    $instagram   = get_theme_mod( 'x_social_instagram' );
    $pinterest   = get_theme_mod( 'x_social_pinterest' );
    $dribbble    = get_theme_mod( 'x_social_dribbble' );
    $behance     = get_theme_mod( 'x_social_behance' );
    $rss         = get_theme_mod( 'x_social_rss' );

    if ( $position == 'topbar' ) {
      $tooltip = 'data-toggle="tooltip" data-placement="bottom" data-trigger="hover"';
    } else {
      $tooltip = 'data-toggle="tooltip" data-placement="top" data-trigger="hover"';
    }

    $output = '<div class="x-social-global">';

      if ( $facebook )    : $output .= '<a ' . $tooltip . ' href="' . $facebook    . '" class="facebook" title="Facebook" target="_blank"><i class="x-social-facebook"></i></a>'; endif;
      if ( $twitter )     : $output .= '<a ' . $tooltip . ' href="' . $twitter     . '" class="twitter" title="Twitter" target="_blank"><i class="x-social-twitter"></i></a>'; endif;
      if ( $google_plus ) : $output .= '<a ' . $tooltip . ' href="' . $google_plus . '" class="google-plus" title="Google+" target="_blank"><i class="x-social-google-plus"></i></a>'; endif;
      if ( $linkedin )    : $output .= '<a ' . $tooltip . ' href="' . $linkedin    . '" class="linkedin" title="LinkedIn" target="_blank"><i class="x-social-linkedin"></i></a>'; endif;
      if ( $foursquare )  : $output .= '<a ' . $tooltip . ' href="' . $foursquare  . '" class="foursquare" title="Foursquare" target="_blank"><i class="x-social-foursquare"></i></a>'; endif;
      if ( $youtube )     : $output .= '<a ' . $tooltip . ' href="' . $youtube     . '" class="youtube" title="YouTube" target="_blank"><i class="x-social-youtube"></i></a>'; endif;
      if ( $vimeo )       : $output .= '<a ' . $tooltip . ' href="' . $vimeo       . '" class="vimeo" title="Vimeo" target="_blank"><i class="x-social-vimeo"></i></a>'; endif;
      if ( $instagram )   : $output .= '<a ' . $tooltip . ' href="' . $instagram   . '" class="instagram" title="Instagram" target="_blank"><i class="x-social-instagram"></i></a>'; endif;
      if ( $pinterest )   : $output .= '<a ' . $tooltip . ' href="' . $pinterest   . '" class="pinterest" title="Pinterest" target="_blank"><i class="x-social-pinterest"></i></a>'; endif;
      if ( $dribbble )    : $output .= '<a ' . $tooltip . ' href="' . $dribbble    . '" class="dribbble" title="Dribbble" target="_blank"><i class="x-social-dribbble"></i></a>'; endif;
      if ( $behance )     : $output .= '<a ' . $tooltip . ' href="' . $behance     . '" class="behance" title="Behance" target="_blank"><i class="x-social-behance"></i></a>'; endif;
      if ( $rss )         : $output .= '<a ' . $tooltip . ' href="' . $rss         . '" class="rss" title="RSS" target="_blank"><i class="x-social-rss"></i></a>'; endif;

    $output .= '</div>';

    echo $output;

  }
endif;



// Remove Tag Cloud Inline Style
// =============================================================================

if ( ! function_exists( 'x_custom_tag_cloud_widget' ) ) :
  function x_custom_tag_cloud_widget( $tag_string ) {
    return preg_replace( "/style='font-size:.+pt;'/", '', $tag_string );
  }
  add_filter( 'wp_generate_tag_cloud', 'x_custom_tag_cloud_widget' );
endif;



// Custom Title
// =============================================================================

if ( ! function_exists( 'x_wp_title' ) ) :
  function x_wp_title( $title ) {

    if ( is_front_page() ) {
      return get_bloginfo( 'name' ) . ' | ' . get_bloginfo( 'description' );
    } else {
      return trim( $title ) . ' | ' . get_bloginfo( 'name' ); 
    }

    return $title;

  }
  add_filter( 'wp_title', 'x_wp_title' );
endif;



// Excerpt Length
// =============================================================================

if ( ! function_exists( 'x_excerpt_length' ) ) :
  function x_excerpt_length( $length ) {

    $the_length = get_theme_mod( 'x_blog_excerpt_length' );
    $the_output = ( $the_length == '' ) ? 60 : $the_length;

    return $the_output;

  }
  add_filter( 'excerpt_length', 'x_excerpt_length' );
endif;



// Excerpt More String
// =============================================================================

if ( ! function_exists( 'x_excerpt_string' ) ) :
  function x_excerpt_string( $more ) {
    
    $stack = x_get_stack();

    if ( $stack == 'integrity' ) {
      return ' ... <div><a href="' . get_permalink() . '" class="more-link">' . __( 'Read More', '__x__' ) . '</a></div>';
    } else if ( $stack == 'renew' ) {
      return ' ... <a href="' . get_permalink() . '" class="more-link">' . __( 'Read More', '__x__' ) . '</a>';
    } else if ( $stack == 'icon' ) {
      return ' ...';
    }

  }
  add_filter( 'excerpt_more', 'x_excerpt_string' );
endif;



// Content More String
// =============================================================================

if ( ! function_exists( 'x_content_string' ) ) :
  function x_content_string( $more ) {
    
    $stack = x_get_stack();

    if ( $stack == 'integrity' ) {
      return '<a href="' . get_permalink() . '" class="more-link">' . __( 'Read More', '__x__' ) . '</a>';
    } else if ( $stack == 'renew' ) {
      return '<a href="' . get_permalink() . '" class="more-link">' . __( 'Read More', '__x__' ) . '</a>';
    } else if ( $stack == 'icon' ) {
      return '<a href="' . get_permalink() . '" class="more-link">' . __( 'Read More', '__x__' ) . '</a>';
    }

  }
  add_filter( 'the_content_more_link', 'x_content_string' );
endif;



// Remove Recent Comments Style
// =============================================================================

if ( ! function_exists( 'x_remove_recent_comments_style' ) ) :
  function x_remove_recent_comments_style() {  
    GLOBAL $wp_widget_factory;  
    remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
  }  
  add_action( 'widgets_init', 'x_remove_recent_comments_style' );
endif;



// Remove Gallery Style
// =============================================================================

if ( ! function_exists( 'x_remove_gallery_style' ) ) :
  function x_remove_gallery_style() {
    add_filter( 'use_default_gallery_style', '__return_false' );
  }  
  add_action( 'init', 'x_remove_gallery_style' );
endif;



// Remove Gallery <br> Tags
// =============================================================================

if ( ! function_exists( 'x_remove_gallery_br_tags' ) ) :
  function x_remove_gallery_br_tags( $output ) {
    return preg_replace( '/<br style=(.*?)>/mi', '', $output );
  }
  add_filter( 'the_content', 'x_remove_gallery_br_tags', 11, 2 );
endif;



// User Contact Information
// =============================================================================

if ( ! function_exists( 'x_modify_contact_methods' ) ) :
  function x_modify_contact_methods( $user_contactmethods ) {

    unset( $user_contactmethods['yim'] );
    unset( $user_contactmethods['aim'] );
    unset( $user_contactmethods['jabber'] );

    $user_contactmethods['facebook']   = 'Facebook Profile';
    $user_contactmethods['twitter']    = 'Twitter Profile';
    $user_contactmethods['googleplus'] = 'Google+ Profile';

    return $user_contactmethods;

  }
  add_filter( 'user_contactmethods', 'x_modify_contact_methods' );
endif;



// Link Pages
// =============================================================================

if ( ! function_exists( 'x_link_pages' ) ) :
  function x_link_pages() {

    wp_link_pages( array(
      'before' => '<div class="page-links">' . __( 'Pages:', '__x__' ),
      'after'  => '</div>'
    ) );

  }
endif;



// Clean Up Shortcodes
// =============================================================================

//
// Remove empty <p> and <br> tags from shortcodes.
//

if ( ! function_exists( 'x_clean_shortcodes' ) ) :
  function x_clean_shortcodes( $content ) {

    $array = array (
      '<p>['    => '[',
      ']</p>'   => ']',
      ']<br />' => ']'
    );

    $content = strtr( $content, $array );

    return $content;

  }
  add_filter( 'the_content', 'x_clean_shortcodes' );
endif;