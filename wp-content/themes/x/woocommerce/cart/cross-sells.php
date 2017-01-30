<?php

// =============================================================================
// WOOCOMMERCE/CART/CROSS-SELLS.PHP
// -----------------------------------------------------------------------------
// Cross sell products loop.
// =============================================================================

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce_loop, $woocommerce, $product;

$crosssells = $woocommerce->cart->get_cross_sells();

if ( sizeof( $crosssells ) == 0 ) return;

$meta_query = $woocommerce->query->get_meta_query();

$enable  = get_theme_mod( 'x_woocommerce_cart_cross_sells_enable' );
$count   = get_theme_mod( 'x_woocommerce_cart_cross_sells_count' );
$columns = get_theme_mod( 'x_woocommerce_cart_cross_sells_columns' );

$args = array(
	'post_type'           => 'product',
	'ignore_sticky_posts' => 1,
	'posts_per_page'      => apply_filters( 'woocommerce_cross_sells_total', $count ),
	'no_found_rows'       => 1,
	'orderby'             => 'rand',
	'post__in'            => $crosssells,
	'meta_query'          => $meta_query
);

$products = new WP_Query( $args );

$woocommerce_loop['columns'] = apply_filters( 'woocommerce_cross_sells_columns', $columns );

if ( $products->have_posts() && $enable == 1 ) :

  ?>

  <div class="cross-sells cols-<?php echo $columns; ?>">

    <h2><?php _e( 'You May Be Interested In&hellip;', '__x__' ) ?></h2>

    <?php woocommerce_product_loop_start(); ?>

      <?php while ( $products->have_posts() ) : $products->the_post(); ?>

        <?php woocommerce_get_template_part( 'content', 'product' ); ?>

      <?php endwhile; // end of the loop. ?>

    <?php woocommerce_product_loop_end(); ?>

  </div>

<?php

endif;

wp_reset_query();