<?php

// =============================================================================
// FUNCTIONS.PHP
// -----------------------------------------------------------------------------
// Theme functions for X.
// 
// Do not edit anything in this file unless you have some understanding of how
// all these funny looking lines of code work. Messing up something in here has
// been known to make personal computers spontaneously combust. Seriously.
// We've seen it happen. ;)
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Set Paths
//   02. Require Files
// =============================================================================

// Set Paths
// =============================================================================

$func_path = get_template_directory() . '/framework/functions';
$glob_path = get_template_directory() . '/framework/functions/global';
$admn_path = get_template_directory() . '/framework/functions/global/admin';
$wdgt_path = get_template_directory() . '/framework/functions/global/widgets';



// Require Files
// =============================================================================

//
// Get view and stack.
//
// 1. Get view.
// 2. Get stack.
//

require_once( $glob_path . '/get-view.php' );  // 1
require_once( $glob_path . '/get-stack.php' ); // 2


//
// Admin panel.
//
// 1. Calculate entry thumbnail sizes.
// 2. Theme setup.
// 3. Entry meta boxes.
// 4. Sidebar generator.
// 5. Widget areas.
// 6. Custom post types.
// 7. TMG plugin activation.
// 8. TMG plugin registration.
// 9. Customizer setup.
// 10. Visual Composer.
// 11. Miscellaneous functions.
//

require_once( $admn_path . '/thumbnails.php' );              // 1
require_once( $admn_path . '/setup.php' );                   // 2
require_once( $admn_path . '/meta.php' );                    // 3
require_once( $admn_path . '/sidebars.php' );                // 4
require_once( $admn_path . '/widgets.php' );                 // 5
require_once( $admn_path . '/custom-post-types.php' );       // 6
require_once( $admn_path . '/tmg-plugin-activation.php' );   // 7
require_once( $admn_path . '/tmg-plugin-registration.php' ); // 8
require_once( $admn_path . '/customizer/setup.php' );        // 9
require_once( $admn_path . '/visual-composer.php' );         // 10
require_once( $admn_path . '/miscellaneous.php' );           // 11


//
// Global functions.
//
// 1. Enqueue styles.
// 2. Enqueue scripts.
// 3. Featured content.
// 4. Pagination.
// 5. Breadcrumbs.
// 6. Content classes.
// 7. WooCommerce compatibility.
// 8. Miscellaneous functions.
//

require_once( $glob_path . '/enqueue-styles.php' );   // 1
require_once( $glob_path . '/enqueue-scripts.php' );  // 2
require_once( $glob_path . '/featured-content.php' ); // 3
require_once( $glob_path . '/pagination.php' );       // 4
require_once( $glob_path . '/breadcrumbs.php' );      // 5
require_once( $glob_path . '/content-classes.php' );  // 6
require_once( $glob_path . '/woocommerce.php' );      // 7
require_once( $glob_path . '/miscellaneous.php' );    // 8


//
// Stack specific functions.
//
// 1. Integrity.
// 2. Renew.
// 3. Icon.
//

require_once( $func_path . '/integrity.php' ); // 1
require_once( $func_path . '/renew.php' );     // 2
require_once( $func_path . '/icon.php' );      // 3


//
// Widgets.
//
// 1. Dribbble.
// 2. Flickr.
//

require_once( $wdgt_path . '/dribbble.php' ); // 1
require_once( $wdgt_path . '/flickr.php' );   // 2