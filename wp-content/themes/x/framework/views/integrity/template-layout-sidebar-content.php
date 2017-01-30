<?php

// =============================================================================
// VIEWS/INTEGRITY/TEMPLATE-LAYOUT-SIDEBAR-CONTENT.PHP
// -----------------------------------------------------------------------------
// Sidebar left, content right page output for Integrity.
// =============================================================================

?>

<?php get_header(); ?>

  <div class="x-container-fluid max width offset cf">
    <div class="x-main right" role="main">

      <?php if ( have_posts() ) : ?>
        <?php while ( have_posts() ) : the_post(); ?>
          <?php x_get_view( 'integrity', 'content', 'page' ); ?>
        <?php endwhile; ?>
        <?php if ( comments_open() ) : ?>
          <?php comments_template( '', true ); ?>
        <?php endif; ?>
      <?php endif; ?>

    </div> <!-- end .x-main -->

    <?php get_sidebar(); ?>

  </div> <!-- end .x-container-fluid.max.width.offset.cf -->

<?php get_footer(); ?>