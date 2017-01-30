<?php

// =============================================================================
// VIEWS/GLOBAL/_SLIDER-REVOLUTION-ABOVE.PHP
// -----------------------------------------------------------------------------
// Slider Revolution output above all page content.
// =============================================================================

?>

<?php

if ( class_exists( 'RevSlider' ) ) :

  $i          = 1;
  $slider     = new RevSlider();
  $arrSliders = $slider->getArrSliders();
  foreach ( $arrSliders as $revSlider ) :

    ${"slider_enable_"                    . $i} = get_theme_mod( 'x_slider_enable_'                    . $i );
    ${"slider_"                           . $i} = get_theme_mod( 'x_slider_'                           . $i );
    ${"slider_page_"                      . $i} = get_theme_mod( 'x_slider_include_page_'              . $i );
    ${"slider_location_"                  . $i} = get_theme_mod( 'x_slider_location_'                  . $i );
    ${"slider_video_"                     . $i} = get_theme_mod( 'x_slider_video_'                     . $i );
    ${"slider_video_poster_"              . $i} = get_theme_mod( 'x_slider_video_poster_'              . $i );
    ${"slider_scroll_bottom_enable_"      . $i} = get_theme_mod( 'x_slider_scroll_bottom_enable_'      . $i );
    ${"slider_scroll_bottom_alignment_"   . $i} = get_theme_mod( 'x_slider_scroll_bottom_alignment_'   . $i );
    ${"slider_scroll_bottom_color_"       . $i} = get_theme_mod( 'x_slider_scroll_bottom_color_'       . $i );
    ${"slider_scroll_bottom_color_hover_" . $i} = get_theme_mod( 'x_slider_scroll_bottom_color_hover_' . $i );

    if ( ${"slider_enable_" . $i} == 1 && is_page( ${"slider_page_" . $i} ) && ${"slider_location_" . $i} == 'above' ) : ?>

      <div class="x-slider-revolution-container above <?php if ( ${"slider_video_" . $i} != '' ) { echo 'bg-video'; } ?>">
        <?php putRevSlider( ${"slider_" . $i} ); ?>
        <?php if ( ${"slider_scroll_bottom_enable_" . $i} == 1 ) : ?>
          <style type="text/css">
            .x-slider-scroll-bottom-<?php echo $i; ?> {
              color: <?php echo ${"slider_scroll_bottom_color_" . $i}; ?>;
              border-color: <?php echo ${"slider_scroll_bottom_color_" . $i}; ?>;
            }
            .x-slider-scroll-bottom-<?php echo $i; ?>:hover {
              color: <?php echo ${"slider_scroll_bottom_color_hover_" . $i}; ?>;
              border-color: <?php echo ${"slider_scroll_bottom_color_hover_" . $i}; ?>;
            }
          </style>
          <a href="#" class="x-slider-scroll-bottom x-slider-scroll-bottom-<?php echo $i; ?> <?php echo ${"slider_scroll_bottom_alignment_" . $i}; ?>"><i class="x-icon-angle-down"></i></a>
        <?php endif; ?>
      </div>      

      <?php if ( ${"slider_video_" . $i} != '' ) : ?>

        <script>

        jQuery(function(){
          var BV = new jQuery.BigVideo(); BV.init();
          if ( Modernizr.touch ) {
            BV.show('<?php echo ${"slider_video_poster_" . $i}; ?>');
          } else {
            BV.show('<?php echo ${"slider_video_" . $i}; ?>', { ambient : true });
          }
        });

        </script>

      <?php endif; ?>
    <?php endif;
    $i++;
  endforeach;

endif;

?>