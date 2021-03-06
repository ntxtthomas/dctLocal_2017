<?php

// =============================================================================
// VIEWS/RENEW/TEMPLATE-BLANK-3.PHP (Container | No Header, No Footer)
// -----------------------------------------------------------------------------
// A blank page for creating unique layouts.
// =============================================================================

?>

<?php x_get_view( 'global', '_header' ); ?>

  <div class="site">
    <?php x_get_view( 'global', '_slider-revolution-above' ); ?>
    <?php x_get_view( 'global', '_slider-revolution-below' ); ?>
    <div class="x-main x-container-fluid max width offset" role="main">
      <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="entry-content">

          <?php if ( have_posts() ) : ?>
            <?php while ( have_posts() ) : the_post(); ?>
              <?php the_content(); ?>
              <?php x_link_pages(); ?>
            <?php endwhile; ?>
          <?php endif; ?>

        </div> <!-- end .entry-content -->
        <?php x_google_authorship_meta(); ?>
      </article> <!-- end .hentry -->
    </div> <!-- end .x-main.x-container-fluid.max.width.offset -->
  </div> <!-- end .site -->

  <?php x_get_view( 'global', '_footer', 'scroll-top' ); ?>
<?php x_get_view( 'global', '_footer' ); ?>