<?php

// =============================================================================
// WOOCOMMERCE/LOOP/LOOP-START.PHP
// -----------------------------------------------------------------------------
// Begin the product loop.
// =============================================================================

?>

<?php $columns      = get_theme_mod( 'x_woocommerce_shop_columns' ); ?>
<?php $column_class = ( is_shop() || is_product_category() || is_product_tag() ) ? 'cols-' . $columns : ''; ?>

<ul class="products <?php echo $column_class; ?>">