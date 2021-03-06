<?php

// =============================================================================
// VIEWS/INTEGRITY/TEMPLATE-LAYOUT-FULL-WIDTH.PHP
// -----------------------------------------------------------------------------
// Full width page output for Integrity.
// =============================================================================

?>

<?php get_header(); ?>

  <div class="x-main x-container-fluid max width offset" role="main">

    <?php if ( have_posts() ) : ?>
      <?php while ( have_posts() ) : the_post(); ?>
        <?php x_get_view( 'integrity', 'content', 'page' ); ?>
      <?php endwhile; ?>
      <?php if ( comments_open() ) : ?>
        <?php comments_template( '', true ); ?>
      <?php endif; ?>
    <?php endif; ?>

  </div> <!-- end .x-main.x-container-fluid.max.width.offset -->

<?php get_footer(); ?>