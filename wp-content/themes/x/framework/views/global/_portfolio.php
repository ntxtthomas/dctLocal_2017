<?php

// =============================================================================
// VIEWS/GLOBAL/_PORTFOLIO.PHP
// -----------------------------------------------------------------------------
// Includes the portfolio output.
// =============================================================================

?>

<?php $cols  = get_theme_mod( 'x_portfolio_columns' ); ?>
<?php $count = get_theme_mod( 'x_portfolio_count' ); ?>

<script>

  jQuery(document).ready(function($){

    var $container   = $('#x-iso-container');
    var $optionSets  = $('.option-set');
    var $optionLinks = $optionSets.find('a');

    $container.before('<span id="x-isotope-loading"><span>');

    $(window).load(function(){
      $container.isotope({
        itemSelector   : '.x-portfolio',
        resizable      : true,
        filter         : '*',
        containerStyle : {
          overflow : 'visible',
          position : 'relative'
        },
        masonry : {
          columnWidth : $container.width() / <?php echo $cols; ?>
        }
      });
      $('#x-isotope-loading').stop(true,true).fadeOut(300);
      $('#x-iso-container .hentry').each(function(i){
        $(this).delay(i*150).animate({'opacity':1},300);
      });
    });

    $(window).smartresize(function(){
      $container.isotope({
        masonry : {
          columnWidth: $container.width() / <?php echo $cols; ?>
        }
      });
    });

    $optionLinks.click(function(){
      var $this = $(this);
      if ( $this.hasClass('selected') ) {
        return false;
      }
      var $optionSet = $this.parents('.option-set');
      $optionSet.find('.selected').removeClass('selected');
      $this.addClass('selected');
      var options = {},
          key   = $optionSet.attr('data-option-key'),
          value = $this.attr('data-option-value');
      value = value === 'false' ? false : value;
      options[ key ] = value;
      if ( key === 'layoutMode' && typeof changeLayoutMode === 'function' ) {
        changeLayoutMode( $this, options );
      } else {
        $container.isotope( options );
      }
      return false;
    });

    $('.x-portfolio-filters').click(function () {
      $(this).parent().find('ul').slideToggle(600, 'easeOutExpo');
    });

  });

</script>

<div id="x-iso-container" class="x-iso-container cols-<?php echo $cols; ?>">

  <?php

  $paged    = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
  $args     = array( 'post_type' => 'x-portfolio', 'posts_per_page' => $count, 'paged' => $paged );
  $wp_query = new WP_Query( $args );

  ?>

  <?php if ( $wp_query->have_posts() ) : ?>
    <?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
      <?php x_get_view( x_get_stack(), 'content', 'portfolio' ); ?>
    <?php endwhile; ?>
  <?php endif; ?>

</div>

<?php pagenavi(); ?>
<?php wp_reset_postdata(); ?>