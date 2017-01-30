<?php

// =============================================================================
// FUNCTIONS/GLOBAL/ADMIN/MISCELLANEOUS.PHP
// -----------------------------------------------------------------------------
// Miscellaneous functions.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Remove Unused Submenu Pages
// =============================================================================

// Remove Unused Submenu Pages
// =============================================================================

//
// 1. Custom header.
// 2. Custom background.
//

if ( ! function_exists( 'x_remove_menus' ) ) :
  function x_remove_menus () {

    remove_submenu_page( 'themes.php', 'custom-header' );     // 1
    remove_submenu_page( 'themes.php', 'custom-background' ); // 2

  }
  add_action( 'admin_menu', 'x_remove_menus', 9999 );
endif;