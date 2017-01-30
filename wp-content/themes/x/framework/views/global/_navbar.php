<?php

// =============================================================================
// VIEWS/GLOBAL/_NAVBAR.PHP
// -----------------------------------------------------------------------------
// Includes navbar output.
// =============================================================================

$get_name          = get_bloginfo( 'name' );
$get_description   = get_bloginfo( 'description' );
$x_logo            = get_theme_mod( 'x_logo' );
$has_primary_nav   = has_nav_menu( 'primary' );
$one_page_nav_meta = get_post_meta( get_the_ID(), '_x_page_one_page_navigation', true );
$one_page_nav      = ( $one_page_nav_meta == '' ) ? 'Deactivated' : $one_page_nav_meta;

?>

<div class="x-navbar-wrap">
  <div class="<?php x_navbar_class(); ?>">
    <div class="x-navbar-inner x-container-fluid max width">
      <?php if ( is_front_page() ) : echo '<h1 class="visually-hidden">' . $get_name . '</h1>'; endif; ?>
      <a href="<?php echo home_url( '/' ); ?>" class="<?php x_brand_class(); ?>" title="<?php echo $get_description; ?>">
        <?php echo ( $x_logo == '' ) ? $get_name : '<img src="' . $x_logo . '" alt="' . $get_description . '">'; ?>
      </a>
      <a href="#" class="x-btn-navbar collapsed" data-toggle="collapse" data-target=".x-nav-collapse">
        <i class="x-icon-bars"></i>
        <span class="visually-hidden"><?php _e( 'Navigation', '__x__' ); ?></span>
      </a>
      <nav class="x-nav-collapse collapse" role="navigation">

        <?php

        if ( $one_page_nav != 'Deactivated' ) :
          wp_nav_menu( array(
            'menu'       => $one_page_nav,
            'container'  => false,
            'menu_class' => 'x-nav x-nav-scrollspy sf-menu'
          ) );          
        elseif ( $has_primary_nav ) :
          wp_nav_menu( array(
            'theme_location' => 'primary',
            'container'      => false,
            'menu_class'     => 'x-nav sf-menu'
          ) );
        else :
          echo '<ul class="x-nav"><li><a href="' . home_url( '/' ) . 'wp-admin/nav-menus.php">Assign a Menu</a></li></ul>';
        endif;

        ?>

      </nav> <!-- end .x-nav-collapse.collapse -->
    </div> <!-- end .x-navbar-inner -->
  </div> <!-- end .x-navbar -->
</div> <!-- end .x-navbar-wrap -->