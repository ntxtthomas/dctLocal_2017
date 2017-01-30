<?php

// =============================================================================
// WOOCOMMERCE/SHOP/ERRORS.PHP
// -----------------------------------------------------------------------------
// Error messages.
// =============================================================================

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! $errors ) return;

?>

<ul class="woocommerce-error x-alert x-alert-danger x-alert-block">
  <?php foreach ( $errors as $error ) : ?>
    <li><?php echo wp_kses_post( $error ); ?></li>
  <?php endforeach; ?>
</ul>