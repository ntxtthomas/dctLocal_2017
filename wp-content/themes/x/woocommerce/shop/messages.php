<?php

// =============================================================================
// WOOCOMMERCE/SHOP/MESSAGES.PHP
// -----------------------------------------------------------------------------
// Shop messages.
// =============================================================================

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! $messages ) return;

?>

<?php foreach ( $messages as $message ) : ?>
  <div class="woocommerce-message x-alert x-alert-info x-alert-block"><?php echo wp_kses_post( $message ); ?></div>
<?php endforeach; ?>