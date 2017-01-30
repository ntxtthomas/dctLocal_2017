<?php
 
// =============================================================================
// FUNCTIONS/GLOBAL/ADMIN/CUSTOMIZER/REGISTER.PHP
// -----------------------------------------------------------------------------
// Sets up the options to be used in the Customizer.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Register Options
// =============================================================================

// Register Options
// =============================================================================

function x_register_customizer_options( $wp_customize ) {

  //
  // Pull pages, fonts, and sliders into arrays.
  // 1. Page and post args.
  // 2. Pages.
  // 3. Fonts.
  // 4. Font weights.
  // 5. All font weights.
  // 6. Sliders.
  //

  $page_post_args = array( 'posts_per_page' => -1, 'orderby' => 'title', 'order'=> 'ASC' ); // 1

  $list_pages_select     = array(); // 2
  $list_pages_select[0]  = 'Select a Page:';
  $list_pages_select_obj = get_pages( $page_post_args );
  foreach ( $list_pages_select_obj as $page ) {
    $list_pages_select[$page->ID] = $page->post_title;
  }

  $list_fonts        = array(); // 3
  $list_font_weights = array(); // 4
  $webfonts_array    = file( get_template_directory() . '/framework/functions/global/admin/customizer/fonts.json' );
  $webfonts          = implode( '', $webfonts_array );
  $list_fonts_decode = json_decode( $webfonts, true );
  foreach ( $list_fonts_decode['items'] as $key => $value ) {
    $item_family                     = $list_fonts_decode['items'][$key]['family'];
    $list_fonts[$item_family]        = $item_family; 
    $list_font_weights[$item_family] = $list_fonts_decode['items'][$key]['variants'];
  }

  $list_all_font_weights = array( // 5
    '100'       => __( 'Ultra Light', '__x__' ),
    '100italic' => __( 'Ultra Light Italic', '__x__' ),
    '200'       => __( 'Light', '__x__' ),
    '200italic' => __( 'Light Italic', '__x__' ),
    '300'       => __( 'Book', '__x__' ),
    '300italic' => __( 'Book Italic', '__x__' ),
    '400'       => __( 'Regular', '__x__' ),
    '400italic' => __( 'Regular Italic', '__x__' ),
    '500'       => __( 'Medium', '__x__' ),
    '500italic' => __( 'Medium Italic', '__x__' ),
    '600'       => __( 'Semi-Bold', '__x__' ),
    '600italic' => __( 'Semi-Bold Italic', '__x__' ),
    '700'       => __( 'Bold', '__x__' ),
    '700italic' => __( 'Bold Italic', '__x__' ),
    '800'       => __( 'Extra Bold', '__x__' ),
    '800italic' => __( 'Extra Bold Italic', '__x__' ),
    '900'       => __( 'Ultra Bold', '__x__' ),
    '900italic' => __( 'Ultra Bold Italic', '__x__' )
  );

  $list_sliders_select    = array(); // 6
  $list_sliders_select[0] = 'Select a Slider:';
  if ( class_exists( 'RevSlider' ) ) {
    $slider     = new RevSlider();
    $arrSliders = $slider->getArrSliders();
    foreach ( $arrSliders as $revSlider ) { 
      $list_sliders_select[$revSlider->getAlias()] = $revSlider->getAlias();
    }
  }


  //
  // Stack.
  //

  $wp_customize->add_section( 'x_customizer_section_global_styles', array(
    'title'    => __( 'Stack', '__x__' ),
    'priority' => 1
  ));

  $wp_customize->add_setting( 'x_integrity_description_stack' );

  $wp_customize->add_control(
    new X_Customize_Description( $wp_customize, 'x_integrity_description_stack', array(
      'label'    => __( 'Select the Stack you would like to use and wait a brief moment to view it in the preview area to the right. Each Stack functions like a unique WordPress theme, and thus comes with its own set of options, features, layouts, and more.', '__x__' ),
      'section'  => 'x_customizer_section_global_styles',
      'settings' => 'x_integrity_description_stack',
      'priority' => 10
    ))
  );

  $wp_customize->add_setting( 'x_stack', array(
    'default' => 'integrity'
  ));

  $wp_customize->add_control( 'x_stack', array(
    'type'     => 'radio',
    'label'    => __( 'Select', '__x__' ),
    'section'  => 'x_customizer_section_global_styles',
    'priority' => 20,
    'choices'  => array(
      'integrity' => __( 'Integrity', '__x__' ),
      'renew'     => __( 'Renew', '__x__' ),
      'icon'      => __( 'Icon', '__x__' )
    )
  ));


  //
  // Integrity styles.
  //

  $wp_customize->add_section( 'x_customizer_section_integrity_styles', array(
    'title'    => __( 'Integrity', '__x__' ),
    'priority' => 2
  ));

  $wp_customize->add_setting( 'x_integrity_description_overview' );
   
  $wp_customize->add_control(
    new X_Customize_Description( $wp_customize, 'x_integrity_description_overview', array(
      'label'    => __( 'Integrity is a beautiful design geared towards businesses and individuals desiring a site with a more traditional layout, yet with plenty of modern touches.', '__x__' ),
      'section'  => 'x_customizer_section_integrity_styles',
      'settings' => 'x_integrity_description_overview',
      'priority' => 10
    ))
  );

  $wp_customize->add_setting( 'x_integrity_layout_site', array(
    'default' => 'full-width'
  ));

  $wp_customize->add_control( 'x_integrity_layout_site', array(
    'type'     => 'radio',
    'label'    => __( 'Site Layout', '__x__' ),
    'section'  => 'x_customizer_section_integrity_styles',
    'priority' => 20,
    'choices'  => array(
      'full-width' => __( 'Fullwidth', '__x__' ),
      'boxed'      => __( 'Boxed', '__x__' )
    )
  ));

  $wp_customize->add_setting( 'x_integrity_sizing_site_max_width', array(
    'default' => '1200'
  ));

  $wp_customize->add_control( 'x_integrity_sizing_site_max_width', array(
    'type'     => 'text',
    'label'    => __( 'Site Max Width (px)', '__x__' ),
    'section'  => 'x_customizer_section_integrity_styles',
    'priority' => 30
  ));

  $wp_customize->add_setting( 'x_integrity_sizing_site_width', array(
    'default' => '88'
  ));

  $wp_customize->add_control( 'x_integrity_sizing_site_width', array(
    'type'     => 'text',
    'label'    => __( 'Site Width (%)', '__x__' ),
    'section'  => 'x_customizer_section_integrity_styles',
    'priority' => 40
  ));

  $wp_customize->add_setting( 'x_integrity_layout_content', array(
    'default' => 'content-sidebar'
  ));

  $wp_customize->add_control( 'x_integrity_layout_content', array(
    'type'     => 'radio',
    'label'    => __( 'Content Layout', '__x__' ),
    'section'  => 'x_customizer_section_integrity_styles',
    'priority' => 50,
    'choices'  => array(
      'content-sidebar' => __( 'Content Left, Sidebar Right', '__x__' ),
      'sidebar-content' => __( 'Sidebar Left, Content Right', '__x__' ),
      'full-width'      => __( 'Fullwidth', '__x__' )
    )
  ));

  $wp_customize->add_setting( 'x_integrity_sizing_content_width', array(
    'default' => '72'
  ));

  $wp_customize->add_control( 'x_integrity_sizing_content_width', array(
    'type'     => 'text',
    'label'    => __( 'Content Width (%)', '__x__' ),
    'section'  => 'x_customizer_section_integrity_styles',
    'priority' => 60
  ));

  $wp_customize->add_setting( 'x_integrity_sub_title_design_options' );

  $wp_customize->add_control(
    new X_Customize_Sub_Title( $wp_customize, 'x_integrity_sub_title_design_options', array(
      'label'    => __( 'Design Options', '__x__' ),
      'section'  => 'x_customizer_section_integrity_styles',
      'settings' => 'x_integrity_sub_title_design_options',
      'priority' => 70
    ))
  );

  $wp_customize->add_setting( 'x_integrity_description_design_options' );

  $wp_customize->add_control(
    new X_Customize_Description( $wp_customize, 'x_integrity_description_design_options', array(
      'label'    => __( 'The greatness of Integrity\'s design is in its simplicity. The look and feel of your site will change dramatically based on the choices selected for a couple options.', '__x__' ),
      'section'  => 'x_customizer_section_integrity_styles',
      'settings' => 'x_integrity_description_design_options',
      'priority' => 80
    ))
  );

  $wp_customize->add_setting( 'x_integrity_design', array(
    'default' => 'light'
  ));

  $wp_customize->add_control( 'x_integrity_design', array(
    'type'     => 'radio',
    'label'    => __( 'Design', '__x__' ),
    'section'  => 'x_customizer_section_integrity_styles',
    'priority' => 90,
    'choices'  => array(
      'light' => __( 'Light', '__x__' ),
      'dark'  => __( 'Dark', '__x__' )
    )
  ));

  $wp_customize->add_setting( 'x_integrity_topbar_transparency_enable', array(
    'default' => 0
  ));

  $wp_customize->add_control( 'x_integrity_topbar_transparency_enable', array(
    'type'     => 'checkbox',
    'label'    => __( 'Enable Topbar Transparency', '__x__' ),
    'section'  => 'x_customizer_section_integrity_styles',
    'priority' => 100
  ));

  $wp_customize->add_setting( 'x_integrity_navbar_transparency_enable', array(
    'default' => 0
  ));

  $wp_customize->add_control( 'x_integrity_navbar_transparency_enable', array(
    'type'     => 'checkbox',
    'label'    => __( 'Enable Navbar Transparency', '__x__' ),
    'section'  => 'x_customizer_section_integrity_styles',
    'priority' => 110
  ));

  $wp_customize->add_setting( 'x_integrity_footer_transparency_enable', array(
    'default' => 0
  ));

  $wp_customize->add_control( 'x_integrity_footer_transparency_enable', array(
    'type'     => 'checkbox',
    'label'    => __( 'Enable Footer Transparency', '__x__' ),
    'section'  => 'x_customizer_section_integrity_styles',
    'priority' => 120
  ));

  $wp_customize->add_setting( 'x_integrity_sub_title_background_options' );

  $wp_customize->add_control(
    new X_Customize_Sub_Title( $wp_customize, 'x_integrity_sub_title_background_options', array(
      'label'    => __( 'Background Options', '__x__' ),
      'section'  => 'x_customizer_section_integrity_styles',
      'settings' => 'x_integrity_sub_title_background_options',
      'priority' => 130
    ))
  );

  $wp_customize->add_setting( 'x_integrity_description_background_options' );

  $wp_customize->add_control(
    new X_Customize_Description( $wp_customize, 'x_integrity_description_background_options', array(
      'label'    => __( 'The "Background Pattern" setting will override the "Background Color" unless the image used is transparent, and the "Background Image" option will take precedence over both. The "Background Image Fade (ms)" option allows you to set a time in milliseconds for your image to fade in. To disable this feature, set the value to "0."', '__x__' ),
      'section'  => 'x_customizer_section_integrity_styles',
      'settings' => 'x_integrity_description_background_options',
      'priority' => 140
    ))
  );

  $wp_customize->add_setting( 'x_integrity_light_bg_color', array(
    'default' => '#f3f3f3'
  ));

  $wp_customize->add_control(
    new WP_Customize_Color_Control( $wp_customize, 'x_integrity_light_bg_color', array(
      'label'    => __( 'Background Color', '__x__' ),
      'section'  => 'x_customizer_section_integrity_styles',
      'settings' => 'x_integrity_light_bg_color',
      'priority' => 150
    ))
  );

  $wp_customize->add_setting( 'x_integrity_light_bg_image_pattern' );

  $wp_customize->add_control(
    new WP_Customize_Image_Control( $wp_customize, 'x_integrity_light_bg_image_pattern', array(
      'label'    => __( 'Background Pattern', '__x__' ),
      'section'  => 'x_customizer_section_integrity_styles',
      'settings' => 'x_integrity_light_bg_image_pattern',
      'priority' => 160
    ))
  );

  $wp_customize->add_setting( 'x_integrity_light_bg_image_full' );

  $wp_customize->add_control(
    new WP_Customize_Image_Control( $wp_customize, 'x_integrity_light_bg_image_full', array(
      'label'    => __( 'Background Image', '__x__' ),
      'section'  => 'x_customizer_section_integrity_styles',
      'settings' => 'x_integrity_light_bg_image_full',
      'priority' => 170
    ))
  );

  $wp_customize->add_setting( 'x_integrity_light_bg_image_full_fade', array(
    'default' => '750'
  ));

  $wp_customize->add_control( 'x_integrity_light_bg_image_full_fade', array(
    'type'     => 'text',
    'label'    => __( 'Background Image Fade (ms)', '__x__' ),
    'section'  => 'x_customizer_section_integrity_styles',
    'priority' => 180
  ));

  $wp_customize->add_setting( 'x_integrity_dark_bg_color', array(
    'default' => '#1c1c1c'
  ));

  $wp_customize->add_control(
    new WP_Customize_Color_Control( $wp_customize, 'x_integrity_dark_bg_color', array(
      'label'    => __( 'Background Color', '__x__' ),
      'section'  => 'x_customizer_section_integrity_styles',
      'settings' => 'x_integrity_dark_bg_color',
      'priority' => 190
    ))
  );

  $wp_customize->add_setting( 'x_integrity_dark_bg_image_pattern' );

  $wp_customize->add_control(
    new WP_Customize_Image_Control( $wp_customize, 'x_integrity_dark_bg_image_pattern', array(
      'label'    => __( 'Background Pattern', '__x__' ),
      'section'  => 'x_customizer_section_integrity_styles',
      'settings' => 'x_integrity_dark_bg_image_pattern',
      'priority' => 200
    ))
  );

  $wp_customize->add_setting( 'x_integrity_dark_bg_image_full' );

  $wp_customize->add_control(
    new WP_Customize_Image_Control( $wp_customize, 'x_integrity_dark_bg_image_full', array(
      'label'    => __( 'Background Image', '__x__' ),
      'section'  => 'x_customizer_section_integrity_styles',
      'settings' => 'x_integrity_dark_bg_image_full',
      'priority' => 210
    ))
  );

  $wp_customize->add_setting( 'x_integrity_dark_bg_image_full_fade', array(
    'default' => '750'
  ));

  $wp_customize->add_control( 'x_integrity_dark_bg_image_full_fade', array(
    'type'     => 'text',
    'label'    => __( 'Background Image Fade (ms)', '__x__' ),
    'section'  => 'x_customizer_section_integrity_styles',
    'priority' => 220
  ));

  $wp_customize->add_setting( 'x_integrity_sub_title_blog_options' );

  $wp_customize->add_control(
    new X_Customize_Sub_Title( $wp_customize, 'x_integrity_sub_title_blog_options', array(
      'label'    => __( 'Blog Options', '__x__' ),
      'section'  => 'x_customizer_section_integrity_styles',
      'settings' => 'x_integrity_sub_title_blog_options',
      'priority' => 230
    ))
  );

  $wp_customize->add_setting( 'x_integrity_description_blog_options' );

  $wp_customize->add_control(
    new X_Customize_Description( $wp_customize, 'x_integrity_description_blog_options', array(
      'label'    => __( 'Enabling the blog header will turn on the area above your posts on the index page that contains your title and subtitle. Disabling it will result in more content being visible above the fold.', '__x__' ),
      'section'  => 'x_customizer_section_integrity_styles',
      'settings' => 'x_integrity_description_blog_options',
      'priority' => 240
    ))
  );

  $wp_customize->add_setting( 'x_integrity_blog_header_enable', array(
    'default' => 1
  ));

  $wp_customize->add_control( 'x_integrity_blog_header_enable', array(
    'type'     => 'checkbox',
    'label'    => __( 'Enable Blog Header', '__x__' ),
    'section'  => 'x_customizer_section_integrity_styles',
    'priority' => 250
  ));

  $wp_customize->add_setting( 'x_integrity_blog_title', array(
    'default' => 'The Blog'
  ));

  $wp_customize->add_control( 'x_integrity_blog_title', array(
    'type'     => 'text',
    'label'    => __( 'Blog Title', '__x__' ),
    'section'  => 'x_customizer_section_integrity_styles',
    'priority' => 260
  ));

  $wp_customize->add_setting( 'x_integrity_blog_subtitle', array(
    'default' => 'Welcome to our little corner of the Internet. Kick your feet up and stay a while.'
  ));

  $wp_customize->add_control( 'x_integrity_blog_subtitle', array(
    'type'     => 'text',
    'label'    => __( 'Blog Subtitle', '__x__' ),
    'section'  => 'x_customizer_section_integrity_styles',
    'priority' => 270
  ));

  $wp_customize->add_setting( 'x_integrity_sub_title_portfolio_options' );

  $wp_customize->add_control(
    new X_Customize_Sub_Title( $wp_customize, 'x_integrity_sub_title_portfolio_options', array(
      'label'    => __( 'Portfolio Options', '__x__' ),
      'section'  => 'x_customizer_section_integrity_styles',
      'settings' => 'x_integrity_sub_title_portfolio_options',
      'priority' => 280
    ))
  );

  $wp_customize->add_setting( 'x_integrity_description_portfolio_options' );

  $wp_customize->add_control(
    new X_Customize_Description( $wp_customize, 'x_integrity_description_portfolio_options', array(
      'label'    => __( 'Enabling portfolio index sharing will turn on social sharing links for each post on the portfolio index page. Activate and deactivate individual sharing links underneath the main Portfolio section.', '__x__' ),
      'section'  => 'x_customizer_section_integrity_styles',
      'settings' => 'x_integrity_description_portfolio_options',
      'priority' => 290
    ))
  );

  $wp_customize->add_setting( 'x_integrity_portfolio_archive_sort_button_text', array(
    'default' => 'Sort Portfolio'
  ));

  $wp_customize->add_control( 'x_integrity_portfolio_archive_sort_button_text', array(
    'type'     => 'text',
    'label'    => __( 'Sort Button Text', '__x__' ),
    'section'  => 'x_customizer_section_integrity_styles',
    'priority' => 300
  ));

  $wp_customize->add_setting( 'x_integrity_portfolio_archive_post_sharing_enable', array(
    'default' => 0
  ));

  $wp_customize->add_control( 'x_integrity_portfolio_archive_post_sharing_enable', array(
    'type'     => 'checkbox',
    'label'    => __( 'Enable Portfolio Index Sharing', '__x__' ),
    'section'  => 'x_customizer_section_integrity_styles',
    'priority' => 310
  ));

  if ( class_exists( 'WC_API' ) ) {

    $wp_customize->add_setting( 'x_integrity_sub_title_shop_options' );

    $wp_customize->add_control(
      new X_Customize_Sub_Title( $wp_customize, 'x_integrity_sub_title_shop_options', array(
        'label'    => __( 'Shop Options', '__x__' ),
        'section'  => 'x_customizer_section_integrity_styles',
        'settings' => 'x_integrity_sub_title_shop_options',
        'priority' => 320
      ))
    );

    $wp_customize->add_setting( 'x_integrity_description_shop_options' );

    $wp_customize->add_control(
      new X_Customize_Description( $wp_customize, 'x_integrity_description_shop_options', array(
        'label'    => __( 'Enabling the shop header will turn on the area above your posts on the index page that contains your title and subtitle. Disabling it will result in more content being visible above the fold.', '__x__' ),
        'section'  => 'x_customizer_section_integrity_styles',
        'settings' => 'x_integrity_description_shop_options',
        'priority' => 330
      ))
    );

    $wp_customize->add_setting( 'x_integrity_shop_header_enable', array(
      'default' => 1
    ));

    $wp_customize->add_control( 'x_integrity_shop_header_enable', array(
      'type'     => 'checkbox',
      'label'    => __( 'Enable Shop Header', '__x__' ),
      'section'  => 'x_customizer_section_integrity_styles',
      'priority' => 340
    ));

    $wp_customize->add_setting( 'x_integrity_shop_title', array(
      'default' => 'The Shop'
    ));

    $wp_customize->add_control( 'x_integrity_shop_title', array(
      'type'     => 'text',
      'label'    => __( 'Shop Title', '__x__' ),
      'section'  => 'x_customizer_section_integrity_styles',
      'priority' => 350
    ));

    $wp_customize->add_setting( 'x_integrity_shop_subtitle', array(
      'default' => 'Welcome to our online store. Take some time to browse through our items.'
    ));

    $wp_customize->add_control( 'x_integrity_shop_subtitle', array(
      'type'     => 'text',
      'label'    => __( 'Shop Subtitle', '__x__' ),
      'section'  => 'x_customizer_section_integrity_styles',
      'priority' => 360
    ));

  }


  //
  // Renew styles.
  //

  $wp_customize->add_section( 'x_customizer_section_renew_styles', array(
    'title'    => __( 'Renew', '__x__' ),
    'priority' => 3
  ));

  $wp_customize->add_setting( 'x_renew_description_overview' );
   
  $wp_customize->add_control(
    new X_Customize_Description( $wp_customize, 'x_renew_description_overview', array(
      'label'    => __( 'Renew features a gorgeous look and feel that lends a clean, modern look to your site. All of your content will take center stage with Renew in place.', '__x__' ),
      'section'  => 'x_customizer_section_renew_styles',
      'settings' => 'x_renew_description_overview',
      'priority' => 10
    ))
  );

  $wp_customize->add_setting( 'x_renew_layout_site', array(
    'default' => 'full-width'
  ));

  $wp_customize->add_control( 'x_renew_layout_site', array(
    'type'     => 'radio',
    'label'    => __( 'Site Layout', '__x__' ),
    'section'  => 'x_customizer_section_renew_styles',
    'priority' => 20,
    'choices'  => array(
      'full-width' => __( 'Fullwidth', '__x__' ),
      'boxed'      => __( 'Boxed', '__x__' )
    )
  ));

  $wp_customize->add_setting( 'x_renew_sizing_site_max_width', array(
    'default' => '1200'
  ));

  $wp_customize->add_control( 'x_renew_sizing_site_max_width', array(
    'type'     => 'text',
    'label'    => __( 'Site Max Width (px)', '__x__' ),
    'section'  => 'x_customizer_section_renew_styles',
    'priority' => 30
  ));

  $wp_customize->add_setting( 'x_renew_sizing_site_width', array(
    'default' => '88'
  ));

  $wp_customize->add_control( 'x_renew_sizing_site_width', array(
    'type'     => 'text',
    'label'    => __( 'Site Width (%)', '__x__' ),
    'section'  => 'x_customizer_section_renew_styles',
    'priority' => 40
  ));

  $wp_customize->add_setting( 'x_renew_layout_content', array(
    'default' => 'content-sidebar'
  ));

  $wp_customize->add_control( 'x_renew_layout_content', array(
    'type'     => 'radio',
    'label'    => __( 'Content Layout', '__x__' ),
    'section'  => 'x_customizer_section_renew_styles',
    'priority' => 50,
    'choices'  => array(
      'content-sidebar' => __( 'Content Left, Sidebar Right', '__x__' ),
      'sidebar-content' => __( 'Sidebar Left, Content Right', '__x__' ),
      'full-width'      => __( 'Fullwidth', '__x__' )
    )
  ));

  $wp_customize->add_setting( 'x_renew_sizing_content_width', array(
    'default' => '72'
  ));

  $wp_customize->add_control( 'x_renew_sizing_content_width', array(
    'type'     => 'text',
    'label'    => __( 'Content Width (%)', '__x__' ),
    'section'  => 'x_customizer_section_renew_styles',
    'priority' => 60
  ));

  $wp_customize->add_setting( 'x_renew_sub_title_design_options' );

  $wp_customize->add_control(
    new X_Customize_Sub_Title( $wp_customize, 'x_renew_sub_title_design_options', array(
      'label'    => __( 'Design Options', '__x__' ),
      'section'  => 'x_customizer_section_renew_styles',
      'settings' => 'x_renew_sub_title_design_options',
      'priority' => 70
    ))
  );

  $wp_customize->add_setting( 'x_renew_description_design_options' );

  $wp_customize->add_control(
    new X_Customize_Description( $wp_customize, 'x_renew_description_design_options', array(
      'label'    => __( 'Renew\'s flat design is built around a simple interface and bold colors. Use your palette to set the colors for some main structural elements of your site below.', '__x__' ),
      'section'  => 'x_customizer_section_renew_styles',
      'settings' => 'x_renew_description_design_options',
      'priority' => 80
    ))
  );

  $wp_customize->add_setting( 'x_renew_topbar_background', array(
    'default' => '#1f2c39'
  ));

  $wp_customize->add_control(
    new WP_Customize_Color_Control( $wp_customize, 'x_renew_topbar_background', array(
      'label'    => __( 'Topbar Background', '__x__' ),
      'section'  => 'x_customizer_section_renew_styles',
      'settings' => 'x_renew_topbar_background',
      'priority' => 90
    ))
  );

  $wp_customize->add_setting( 'x_renew_navbar_background', array(
    'default' => '#2c3e50'
  ));

  $wp_customize->add_control(
    new WP_Customize_Color_Control( $wp_customize, 'x_renew_navbar_background', array(
      'label'    => __( 'Navbar Background', '__x__' ),
      'section'  => 'x_customizer_section_renew_styles',
      'settings' => 'x_renew_navbar_background',
      'priority' => 100
    ))
  );

  $wp_customize->add_setting( 'x_renew_navbar_button_color', array(
    'default' => '#ffffff'
  ));

  $wp_customize->add_control(
    new WP_Customize_Color_Control( $wp_customize, 'x_renew_navbar_button_color', array(
      'label'    => __( 'Mobile Button Color', '__x__' ),
      'section'  => 'x_customizer_section_renew_styles',
      'settings' => 'x_renew_navbar_button_color',
      'priority' => 110
    ))
  );

  $wp_customize->add_setting( 'x_renew_navbar_button_background', array(
    'default' => '#3e5771'
  ));

  $wp_customize->add_control(
    new WP_Customize_Color_Control( $wp_customize, 'x_renew_navbar_button_background', array(
      'label'    => __( 'Mobile Button Background', '__x__' ),
      'section'  => 'x_customizer_section_renew_styles',
      'settings' => 'x_renew_navbar_button_background',
      'priority' => 120
    ))
  );

  $wp_customize->add_setting( 'x_renew_navbar_button_background_hover', array(
    'default' => '#476481'
  ));

  $wp_customize->add_control(
    new WP_Customize_Color_Control( $wp_customize, 'x_renew_navbar_button_background_hover', array(
      'label'    => __( 'Mobile Button Background Hover', '__x__' ),
      'section'  => 'x_customizer_section_renew_styles',
      'settings' => 'x_renew_navbar_button_background_hover',
      'priority' => 130
    ))
  );

  $wp_customize->add_setting( 'x_renew_footer_background', array(
    'default' => '#2c3e50'
  ));

  $wp_customize->add_control(
    new WP_Customize_Color_Control( $wp_customize, 'x_renew_footer_background', array(
      'label'    => __( 'Footer Background', '__x__' ),
      'section'  => 'x_customizer_section_renew_styles',
      'settings' => 'x_renew_footer_background',
      'priority' => 140
    ))
  );

  $wp_customize->add_setting( 'x_renew_sub_title_background_options' );

  $wp_customize->add_control(
    new X_Customize_Sub_Title( $wp_customize, 'x_renew_sub_title_background_options', array(
      'label'    => __( 'Background Options', '__x__' ),
      'section'  => 'x_customizer_section_renew_styles',
      'settings' => 'x_renew_sub_title_background_options',
      'priority' => 150
    ))
  );

  $wp_customize->add_setting( 'x_renew_description_background_options' );

  $wp_customize->add_control(
    new X_Customize_Description( $wp_customize, 'x_renew_description_background_options', array(
      'label'    => __( 'The "Background Pattern" setting will override the "Background Color" unless the image used is transparent, and the "Background Image" option will take precedence over both. The "Background Image Fade (ms)" option allows you to set a time in milliseconds for your image to fade in. To disable this feature, set the value to "0."', '__x__' ),
      'section'  => 'x_customizer_section_renew_styles',
      'settings' => 'x_renew_description_background_options',
      'priority' => 160
    ))
  );

  $wp_customize->add_setting( 'x_renew_bg_color', array(
    'default' => '#f5f5f5'
  ));

  $wp_customize->add_control(
    new WP_Customize_Color_Control( $wp_customize, 'x_renew_bg_color', array(
      'label'    => __( 'Background Color', '__x__' ),
      'section'  => 'x_customizer_section_renew_styles',
      'settings' => 'x_renew_bg_color',
      'priority' => 170
    ))
  );

  $wp_customize->add_setting( 'x_renew_bg_image_pattern' );

  $wp_customize->add_control(
    new WP_Customize_Image_Control( $wp_customize, 'x_renew_bg_image_pattern', array(
      'label'    => __( 'Background Pattern', '__x__' ),
      'section'  => 'x_customizer_section_renew_styles',
      'settings' => 'x_renew_bg_image_pattern',
      'priority' => 180
    ))
  );

  $wp_customize->add_setting( 'x_renew_bg_image_full' );

  $wp_customize->add_control(
    new WP_Customize_Image_Control( $wp_customize, 'x_renew_bg_image_full', array(
      'label'    => __( 'Background Image', '__x__' ),
      'section'  => 'x_customizer_section_renew_styles',
      'settings' => 'x_renew_bg_image_full',
      'priority' => 190
    ))
  );

  $wp_customize->add_setting( 'x_renew_bg_image_full_fade', array(
    'default' => '750'
  ));

  $wp_customize->add_control( 'x_renew_bg_image_full_fade', array(
    'type'     => 'text',
    'label'    => __( 'Background Image Fade (ms)', '__x__' ),
    'section'  => 'x_customizer_section_renew_styles',
    'priority' => 200
  ));

  $wp_customize->add_setting( 'x_renew_sub_title_typography_options' );

  $wp_customize->add_control(
    new X_Customize_Sub_Title( $wp_customize, 'x_renew_sub_title_typography_options', array(
      'label'    => __( 'Typography Options', '__x__' ),
      'section'  => 'x_customizer_section_renew_styles',
      'settings' => 'x_renew_sub_title_typography_options',
      'priority' => 210
    ))
  );

  $wp_customize->add_setting( 'x_renew_description_typography_options' );

  $wp_customize->add_control(
    new X_Customize_Description( $wp_customize, 'x_renew_description_typography_options', array(
      'label'    => __( 'Here you can set the colors for your topbar and footer. Get creative, the possibilities are endless.', '__x__' ),
      'section'  => 'x_customizer_section_renew_styles',
      'settings' => 'x_renew_description_typography_options',
      'priority' => 220
    ))
  );

  $wp_customize->add_setting( 'x_renew_topbar_text_color', array(
    'default' => '#ffffff'
  ));

  $wp_customize->add_control(
    new WP_Customize_Color_Control( $wp_customize, 'x_renew_topbar_text_color', array(
      'label'    => __( 'Topbar Links and Text', '__x__' ),
      'section'  => 'x_customizer_section_renew_styles',
      'settings' => 'x_renew_topbar_text_color',
      'priority' => 230
    ))
  );

  $wp_customize->add_setting( 'x_renew_topbar_link_color_hover', array(
    'default' => '#959baf'
  ));

  $wp_customize->add_control(
    new WP_Customize_Color_Control( $wp_customize, 'x_renew_topbar_link_color_hover', array(
      'label'    => __( 'Topbar Links Hover', '__x__' ),
      'section'  => 'x_customizer_section_renew_styles',
      'settings' => 'x_renew_topbar_link_color_hover',
      'priority' => 240
    ))
  );

  $wp_customize->add_setting( 'x_renew_footer_text_color', array(
    'default' => '#ffffff'
  ));

  $wp_customize->add_control(
    new WP_Customize_Color_Control( $wp_customize, 'x_renew_footer_text_color', array(
      'label'    => __( 'Footer Links and Text', '__x__' ),
      'section'  => 'x_customizer_section_renew_styles',
      'settings' => 'x_renew_footer_text_color',
      'priority' => 250
    ))
  );

  $wp_customize->add_setting( 'x_renew_sub_title_blog_options' );

  $wp_customize->add_control(
    new X_Customize_Sub_Title( $wp_customize, 'x_renew_sub_title_blog_options', array(
      'label'    => __( 'Blog Options', '__x__' ),
      'section'  => 'x_customizer_section_renew_styles',
      'settings' => 'x_renew_sub_title_blog_options',
      'priority' => 260
    ))
  );

  $wp_customize->add_setting( 'x_renew_description_blog_options' );

  $wp_customize->add_control(
    new X_Customize_Description( $wp_customize, 'x_renew_description_blog_options', array(
      'label'    => __( 'The entry icon color is for the post icons to the left of each title. Selecting "Creative" under the "Entry Icon Position" setting will allow you to align your entry icons in a different manner on your posts index page when "Content Left, Sidebar Right" or "Fullwidth" are selected as your "Content Layout" and when your blog "Style" is set to "Standard." This feature is intended to be paired with a "Boxed" layout.', '__x__' ),
      'section'  => 'x_customizer_section_renew_styles',
      'settings' => 'x_renew_description_blog_options',
      'priority' => 270
    ))
  );

  $wp_customize->add_setting( 'x_renew_blog_title', array(
    'default' => 'The Blog'
  ));

  $wp_customize->add_control( 'x_renew_blog_title', array(
    'type'     => 'text',
    'label'    => __( 'Blog Title', '__x__' ),
    'section'  => 'x_customizer_section_renew_styles',
    'priority' => 280
  ));

  $wp_customize->add_setting( 'x_renew_entry_icon_color', array(
    'default' => '#dddddd'
  ));

  $wp_customize->add_control(
    new WP_Customize_Color_Control( $wp_customize, 'x_renew_entry_icon_color', array(
      'label'    => __( 'Entry Icons', '__x__' ),
      'section'  => 'x_customizer_section_renew_styles',
      'settings' => 'x_renew_entry_icon_color',
      'priority' => 290
    ))
  );

  $wp_customize->add_setting( 'x_renew_entry_icon_position', array(
    'default' => 'standard'
  ));

  $wp_customize->add_control( 'x_renew_entry_icon_position', array(
    'type'     => 'radio',
    'label'    => __( 'Entry Icon Position', '__x__' ),
    'section'  => 'x_customizer_section_renew_styles',
    'priority' => 300,
    'choices'  => array(
      'standard' => __( 'Standard', '__x__' ),
      'creative' => __( 'Creative', '__x__' )
    )
  ));

  $wp_customize->add_setting( 'x_renew_entry_icon_position_horizontal', array(
    'default' => '18'
  ));

  $wp_customize->add_control( 'x_renew_entry_icon_position_horizontal', array(
    'type'     => 'text',
    'label'    => __( 'Entry Icon Horizontal Alignment (%)', '__x__' ),
    'section'  => 'x_customizer_section_renew_styles',
    'priority' => 310
  ));

  $wp_customize->add_setting( 'x_renew_entry_icon_position_vertical', array(
    'default' => '25'
  ));

  $wp_customize->add_control( 'x_renew_entry_icon_position_vertical', array(
    'type'     => 'text',
    'label'    => __( 'Entry Icon Vertical Alignment (px)', '__x__' ),
    'section'  => 'x_customizer_section_renew_styles',
    'priority' => 320
  ));

  if ( class_exists( 'WC_API' ) ) {

    $wp_customize->add_setting( 'x_renew_sub_title_shop_options' );

    $wp_customize->add_control(
      new X_Customize_Sub_Title( $wp_customize, 'x_renew_sub_title_shop_options', array(
        'label'    => __( 'Shop Options', '__x__' ),
        'section'  => 'x_customizer_section_renew_styles',
        'settings' => 'x_renew_sub_title_shop_options',
        'priority' => 330
      ))
    );

    $wp_customize->add_setting( 'x_renew_description_shop_options' );

    $wp_customize->add_control(
      new X_Customize_Description( $wp_customize, 'x_renew_description_shop_options', array(
        'label'    => __( 'Provide a title you would like to use for your shop. This will show up on the index page as well as in your breadcrumbs.', '__x__' ),
        'section'  => 'x_customizer_section_renew_styles',
        'settings' => 'x_renew_description_shop_options',
        'priority' => 340
      ))
    );

    $wp_customize->add_setting( 'x_renew_shop_title', array(
      'default' => 'The Shop'
    ));

    $wp_customize->add_control( 'x_renew_shop_title', array(
      'type'     => 'text',
      'label'    => __( 'Shop Title', '__x__' ),
      'section'  => 'x_customizer_section_renew_styles',
      'priority' => 350
    ));

  }


  //
  // Icon styles.
  //

  $wp_customize->add_section( 'x_customizer_section_icon_styles', array(
    'title'    => __( 'Icon', '__x__' ),
    'priority' => 4
  ));

  $wp_customize->add_setting( 'x_icon_description_overview' );

  $wp_customize->add_control(
    new X_Customize_Description( $wp_customize, 'x_icon_description_overview', array(
      'label'    => __( 'Icon features a stunning, modern, fullscreen design with a unique fixed sidebar layout that scolls with users on larger screens as you move down the page. The end result is attractive, app-like, and intuitive.', '__x__' ),
      'section'  => 'x_customizer_section_icon_styles',
      'settings' => 'x_icon_description_overview',
      'priority' => 10
    ))
  );

  $wp_customize->add_setting( 'x_icon_layout_site', array(
    'default' => 'full-width'
  ));

  $wp_customize->add_control( 'x_icon_layout_site', array(
    'type'     => 'radio',
    'label'    => __( 'Site Layout', '__x__' ),
    'section'  => 'x_customizer_section_icon_styles',
    'priority' => 20,
    'choices'  => array(
      'full-width' => __( 'Fullwidth', '__x__' ),
      'boxed'      => __( 'Boxed', '__x__' )
    )
  ));

  $wp_customize->add_setting( 'x_icon_sizing_site_max_width', array(
    'default' => '1200'
  ));

  $wp_customize->add_control( 'x_icon_sizing_site_max_width', array(
    'type'     => 'text',
    'label'    => __( 'Site Max Width (px)', '__x__' ),
    'section'  => 'x_customizer_section_icon_styles',
    'priority' => 30
  ));

  $wp_customize->add_setting( 'x_icon_sizing_site_width', array(
    'default' => '88'
  ));

  $wp_customize->add_control( 'x_icon_sizing_site_width', array(
    'type'     => 'text',
    'label'    => __( 'Site Width (%)', '__x__' ),
    'section'  => 'x_customizer_section_icon_styles',
    'priority' => 40
  ));

  $wp_customize->add_setting( 'x_icon_layout_content', array(
    'default' => 'content-sidebar'
  ));

  $wp_customize->add_control( 'x_icon_layout_content', array(
    'type'     => 'radio',
    'label'    => __( 'Content Layout', '__x__' ),
    'section'  => 'x_customizer_section_icon_styles',
    'priority' => 50,
    'choices'  => array(
      'content-sidebar' => __( 'Content Left, Sidebar Right', '__x__' ),
      'sidebar-content' => __( 'Sidebar Left, Content Right', '__x__' ),
      'full-width'      => __( 'Fullwidth', '__x__' )
    )
  ));

  $wp_customize->add_setting( 'x_icon_sidebar_width', array(
    'default' => '250'
  ));

  $wp_customize->add_control( 'x_icon_sidebar_width', array(
    'type'     => 'text',
    'label'    => __( 'Set Sidebar Width (px)', '__x__' ),
    'section'  => 'x_customizer_section_icon_styles',
    'priority' => 60
  ));

  $wp_customize->add_setting( 'x_icon_sub_title_background_options' );

  $wp_customize->add_control(
    new X_Customize_Sub_Title( $wp_customize, 'x_icon_sub_title_background_options', array(
      'label'    => __( 'Background Options', '__x__' ),
      'section'  => 'x_customizer_section_icon_styles',
      'settings' => 'x_icon_sub_title_background_options',
      'priority' => 70
    ))
  );

  $wp_customize->add_setting( 'x_icon_description_background_options' );

  $wp_customize->add_control(
    new X_Customize_Description( $wp_customize, 'x_icon_description_background_options', array(
      'label'    => __( 'The "Background Pattern" setting will override the "Background Color" unless the image used is transparent, and the "Background Image" option will take precedence over both. The "Background Image Fade (ms)" option allows you to set a time in milliseconds for your image to fade in. To disable this feature, set the value to "0."', '__x__' ),
      'section'  => 'x_customizer_section_icon_styles',
      'settings' => 'x_icon_description_background_options',
      'priority' => 80
    ))
  );

  $wp_customize->add_setting( 'x_icon_bg_color', array(
    'default' => '#ffffff'
  ));

  $wp_customize->add_control(
    new WP_Customize_Color_Control( $wp_customize, 'x_icon_bg_color', array(
      'label'    => __( 'Background Color', '__x__' ),
      'section'  => 'x_customizer_section_icon_styles',
      'settings' => 'x_icon_bg_color',
      'priority' => 90
    ))
  );

  $wp_customize->add_setting( 'x_icon_bg_image_pattern' );

  $wp_customize->add_control(
    new WP_Customize_Image_Control( $wp_customize, 'x_icon_bg_image_pattern', array(
      'label'    => __( 'Background Pattern', '__x__' ),
      'section'  => 'x_customizer_section_icon_styles',
      'settings' => 'x_icon_bg_image_pattern',
      'priority' => 100
    ))
  );

  $wp_customize->add_setting( 'x_icon_bg_image_full' );

  $wp_customize->add_control(
    new WP_Customize_Image_Control( $wp_customize, 'x_icon_bg_image_full', array(
      'label'    => __( 'Background Image', '__x__' ),
      'section'  => 'x_customizer_section_icon_styles',
      'settings' => 'x_icon_bg_image_full',
      'priority' => 110
    ))
  );

  $wp_customize->add_setting( 'x_icon_bg_image_full_fade', array(
    'default' => '750'
  ));

  $wp_customize->add_control( 'x_icon_bg_image_full_fade', array(
    'type'     => 'text',
    'label'    => __( 'Background Image Fade (ms)', '__x__' ),
    'section'  => 'x_customizer_section_icon_styles',
    'priority' => 120
  ));

  $wp_customize->add_setting( 'x_icon_sub_title_blog_options' );

  $wp_customize->add_control(
    new X_Customize_Sub_Title( $wp_customize, 'x_icon_sub_title_blog_options', array(
      'label'    => __( 'Blog Options', '__x__' ),
      'section'  => 'x_customizer_section_icon_styles',
      'settings' => 'x_icon_sub_title_blog_options',
      'priority' => 130
    ))
  );

  $wp_customize->add_setting( 'x_icon_description_blog_options' );

  $wp_customize->add_control(
    new X_Customize_Description( $wp_customize, 'x_icon_description_blog_options', array(
      'label'    => __( 'Set unique colors for each blog post type if you so desire. You can enable or disable any combination of colors you want to fit your design style.', '__x__' ),
      'section'  => 'x_customizer_section_icon_styles',
      'settings' => 'x_icon_description_blog_options',
      'priority' => 140
    ))
  );

  $wp_customize->add_setting( 'x_icon_post_standard_colors_enable', array(
    'default' => 0
  ));

  $wp_customize->add_control( 'x_icon_post_standard_colors_enable', array(
    'type'     => 'checkbox',
    'label'    => __( 'Enable Standard Post Custom Colors', '__x__' ),
    'section'  => 'x_customizer_section_icon_styles',
    'priority' => 150
  ));

  $wp_customize->add_setting( 'x_icon_post_standard_color', array(
    'default' => '#d1f2eb'
  ));

  $wp_customize->add_control(
    new WP_Customize_Color_Control( $wp_customize, 'x_icon_post_standard_color', array(
      'label'    => __( 'Standard Post Text', '__x__' ),
      'section'  => 'x_customizer_section_icon_styles',
      'settings' => 'x_icon_post_standard_color',
      'priority' => 160
    ))
  );

  $wp_customize->add_setting( 'x_icon_post_standard_background', array(
    'default' => '#16a085'
  ));

  $wp_customize->add_control(
    new WP_Customize_Color_Control( $wp_customize, 'x_icon_post_standard_background', array(
      'label'    => __( 'Standard Post Background', '__x__' ),
      'section'  => 'x_customizer_section_icon_styles',
      'settings' => 'x_icon_post_standard_background',
      'priority' => 170
    ))
  );

  $wp_customize->add_setting( 'x_icon_post_image_colors_enable', array(
    'default' => 0
  ));

  $wp_customize->add_control( 'x_icon_post_image_colors_enable', array(
    'type'     => 'checkbox',
    'label'    => __( 'Enable Image Post Custom Colors', '__x__' ),
    'section'  => 'x_customizer_section_icon_styles',
    'priority' => 180
  ));

  $wp_customize->add_setting( 'x_icon_post_image_color', array(
    'default' => '#d1eedd'
  ));

  $wp_customize->add_control(
    new WP_Customize_Color_Control( $wp_customize, 'x_icon_post_image_color', array(
      'label'    => __( 'Image Post Text', '__x__' ),
      'section'  => 'x_customizer_section_icon_styles',
      'settings' => 'x_icon_post_image_color',
      'priority' => 190
    ))
  );

  $wp_customize->add_setting( 'x_icon_post_image_background', array(
    'default' => '#27ae60'
  ));

  $wp_customize->add_control(
    new WP_Customize_Color_Control( $wp_customize, 'x_icon_post_image_background', array(
      'label'    => __( 'Image Post Background', '__x__' ),
      'section'  => 'x_customizer_section_icon_styles',
      'settings' => 'x_icon_post_image_background',
      'priority' => 200
    ))
  );

  $wp_customize->add_setting( 'x_icon_post_gallery_colors_enable', array(
    'default' => 0
  ));

  $wp_customize->add_control( 'x_icon_post_gallery_colors_enable', array(
    'type'     => 'checkbox',
    'label'    => __( 'Enable Gallery Post Custom Colors', '__x__' ),
    'section'  => 'x_customizer_section_icon_styles',
    'priority' => 210
  ));

  $wp_customize->add_setting( 'x_icon_post_gallery_color', array(
    'default' => '#d0e7f7'
  ));

  $wp_customize->add_control(
    new WP_Customize_Color_Control( $wp_customize, 'x_icon_post_gallery_color', array(
      'label'    => __( 'Gallery Post Text', '__x__' ),
      'section'  => 'x_customizer_section_icon_styles',
      'settings' => 'x_icon_post_gallery_color',
      'priority' => 220
    ))
  );

  $wp_customize->add_setting( 'x_icon_post_gallery_background', array(
    'default' => '#2980b9'
  ));

  $wp_customize->add_control(
    new WP_Customize_Color_Control( $wp_customize, 'x_icon_post_gallery_background', array(
      'label'    => __( 'Gallery Post Background', '__x__' ),
      'section'  => 'x_customizer_section_icon_styles',
      'settings' => 'x_icon_post_gallery_background',
      'priority' => 230
    ))
  );

  $wp_customize->add_setting( 'x_icon_post_video_colors_enable', array(
    'default' => 0
  ));

  $wp_customize->add_control( 'x_icon_post_video_colors_enable', array(
    'type'     => 'checkbox',
    'label'    => __( 'Enable Video Post Custom Colors', '__x__' ),
    'section'  => 'x_customizer_section_icon_styles',
    'priority' => 240
  ));

  $wp_customize->add_setting( 'x_icon_post_video_color', array(
    'default' => '#e9daef'
  ));

  $wp_customize->add_control(
    new WP_Customize_Color_Control( $wp_customize, 'x_icon_post_video_color', array(
      'label'    => __( 'Video Post Text', '__x__' ),
      'section'  => 'x_customizer_section_icon_styles',
      'settings' => 'x_icon_post_video_color',
      'priority' => 250
    ))
  );

  $wp_customize->add_setting( 'x_icon_post_video_background', array(
    'default' => '#8e44ad'
  ));

  $wp_customize->add_control(
    new WP_Customize_Color_Control( $wp_customize, 'x_icon_post_video_background', array(
      'label'    => __( 'Video Post Background', '__x__' ),
      'section'  => 'x_customizer_section_icon_styles',
      'settings' => 'x_icon_post_video_background',
      'priority' => 260
    ))
  );

  $wp_customize->add_setting( 'x_icon_post_audio_colors_enable', array(
    'default' => 0
  ));

  $wp_customize->add_control( 'x_icon_post_audio_colors_enable', array(
    'type'     => 'checkbox',
    'label'    => __( 'Enable Audio Post Custom Colors', '__x__' ),
    'section'  => 'x_customizer_section_icon_styles',
    'priority' => 270
  ));

  $wp_customize->add_setting( 'x_icon_post_audio_color', array(
    'default' => '#cfd4d9'
  ));

  $wp_customize->add_control(
    new WP_Customize_Color_Control( $wp_customize, 'x_icon_post_audio_color', array(
      'label'    => __( 'Audio Post Text', '__x__' ),
      'section'  => 'x_customizer_section_icon_styles',
      'settings' => 'x_icon_post_audio_color',
      'priority' => 280
    ))
  );

  $wp_customize->add_setting( 'x_icon_post_audio_background', array(
    'default' => '#2c3e50'
  ));

  $wp_customize->add_control(
    new WP_Customize_Color_Control( $wp_customize, 'x_icon_post_audio_background', array(
      'label'    => __( 'Audio Post Background', '__x__' ),
      'section'  => 'x_customizer_section_icon_styles',
      'settings' => 'x_icon_post_audio_background',
      'priority' => 290
    ))
  );

  $wp_customize->add_setting( 'x_icon_post_quote_colors_enable', array(
    'default' => 0
  ));

  $wp_customize->add_control( 'x_icon_post_quote_colors_enable', array(
    'type'     => 'checkbox',
    'label'    => __( 'Enable Quote Post Custom Colors', '__x__' ),
    'section'  => 'x_customizer_section_icon_styles',
    'priority' => 300
  ));

  $wp_customize->add_setting( 'x_icon_post_quote_color', array(
    'default' => '#fcf2c8'
  ));

  $wp_customize->add_control(
    new WP_Customize_Color_Control( $wp_customize, 'x_icon_post_quote_color', array(
      'label'    => __( 'Quote Post Text', '__x__' ),
      'section'  => 'x_customizer_section_icon_styles',
      'settings' => 'x_icon_post_quote_color',
      'priority' => 310
    ))
  );

  $wp_customize->add_setting( 'x_icon_post_quote_background', array(
    'default' => '#f1c40f'
  ));

  $wp_customize->add_control(
    new WP_Customize_Color_Control( $wp_customize, 'x_icon_post_quote_background', array(
      'label'    => __( 'Quote Post Background', '__x__' ),
      'section'  => 'x_customizer_section_icon_styles',
      'settings' => 'x_icon_post_quote_background',
      'priority' => 320
    ))
  );

  $wp_customize->add_setting( 'x_icon_post_link_colors_enable', array(
    'default' => 0
  ));

  $wp_customize->add_control( 'x_icon_post_link_colors_enable', array(
    'type'     => 'checkbox',
    'label'    => __( 'Enable Link Post Custom Colors', '__x__' ),
    'section'  => 'x_customizer_section_icon_styles',
    'priority' => 330
  ));

  $wp_customize->add_setting( 'x_icon_post_link_color', array(
    'default' => '#f9d0cc'
  ));

  $wp_customize->add_control(
    new WP_Customize_Color_Control( $wp_customize, 'x_icon_post_link_color', array(
      'label'    => __( 'Link Post Text', '__x__' ),
      'section'  => 'x_customizer_section_icon_styles',
      'settings' => 'x_icon_post_link_color',
      'priority' => 340
    ))
  );

  $wp_customize->add_setting( 'x_icon_post_link_background', array(
    'default' => '#c0392b'
  ));

  $wp_customize->add_control(
    new WP_Customize_Color_Control( $wp_customize, 'x_icon_post_link_background', array(
      'label'    => __( 'Link Post Background', '__x__' ),
      'section'  => 'x_customizer_section_icon_styles',
      'settings' => 'x_icon_post_link_background',
      'priority' => 350
    ))
  );

  if ( class_exists( 'WC_API' ) ) {

    $wp_customize->add_setting( 'x_icon_sub_title_shop_options' );

    $wp_customize->add_control(
      new X_Customize_Sub_Title( $wp_customize, 'x_icon_sub_title_shop_options', array(
        'label'    => __( 'Shop Options', '__x__' ),
        'section'  => 'x_customizer_section_icon_styles',
        'settings' => 'x_icon_sub_title_shop_options',
        'priority' => 360
      ))
    );

    $wp_customize->add_setting( 'x_icon_description_shop_options' );

    $wp_customize->add_control(
      new X_Customize_Description( $wp_customize, 'x_icon_description_shop_options', array(
        'label'    => __( 'Provide a title you would like to use for your shop. This will show up on the index page as well as in your breadcrumbs.', '__x__' ),
        'section'  => 'x_customizer_section_icon_styles',
        'settings' => 'x_icon_description_shop_options',
        'priority' => 370
      ))
    );

    $wp_customize->add_setting( 'x_icon_shop_title', array(
      'default' => 'The Shop'
    ));

    $wp_customize->add_control( 'x_icon_shop_title', array(
      'type'     => 'text',
      'label'    => __( 'Shop Title', '__x__' ),
      'section'  => 'x_customizer_section_icon_styles',
      'priority' => 380
    ));

  }


  //
  // Typography.
  //

  $wp_customize->add_section( 'x_customizer_section_typography', array(
    'title'    => __( 'Typography', '__x__' ),
    'priority' => 5
  ));

  $wp_customize->add_setting( 'x_list_font_weights', array(
    'default' => $list_font_weights
  ));

  $wp_customize->add_setting( 'x_typography_description_overview' );

  $wp_customize->add_control(
    new X_Customize_Description( $wp_customize, 'x_typography_description_overview', array(
      'label'    => __( 'X provides you with full control over your site\'s typography. Remember to check the box for "Enable Custom Fonts" to set your own individual fonts for headings, body copy, et cetera.', '__x__' ),
      'section'  => 'x_customizer_section_typography',
      'settings' => 'x_typography_description_overview',
      'priority' => 10
    ))
  );

  $wp_customize->add_setting( 'x_custom_fonts', array(
    'default' => 0
  ));

  $wp_customize->add_control( 'x_custom_fonts', array(
    'type'     => 'checkbox',
    'label'    => __( 'Enable Custom Fonts', '__x__' ),
    'section'  => 'x_customizer_section_typography',
    'priority' => 20
  ));

  $wp_customize->add_setting( 'x_custom_font_subsets', array(
    'default' => 0
  ));

  $wp_customize->add_control( 'x_custom_font_subsets', array(
    'type'     => 'checkbox',
    'label'    => __( 'Enable Subsets', '__x__' ),
    'section'  => 'x_customizer_section_typography',
    'priority' => 30
  ));

  $wp_customize->add_setting( 'x_custom_font_subset_cyrillic', array(
    'default' => 0
  ));

  $wp_customize->add_control( 'x_custom_font_subset_cyrillic', array(
    'type'     => 'checkbox',
    'label'    => __( 'Cyrillic', '__x__' ),
    'section'  => 'x_customizer_section_typography',
    'priority' => 40
  ));

  $wp_customize->add_setting( 'x_custom_font_subset_greek', array(
    'default' => 0
  ));

  $wp_customize->add_control( 'x_custom_font_subset_greek', array(
    'type'     => 'checkbox',
    'label'    => __( 'Greek', '__x__' ),
    'section'  => 'x_customizer_section_typography',
    'priority' => 50
  ));

  $wp_customize->add_setting( 'x_custom_font_subset_vietnamese', array(
    'default' => 0
  ));

  $wp_customize->add_control( 'x_custom_font_subset_vietnamese', array(
    'type'     => 'checkbox',
    'label'    => __( 'Vietnamese', '__x__' ),
    'section'  => 'x_customizer_section_typography',
    'priority' => 60
  ));

  $wp_customize->add_setting( 'x_typography_sub_title_logo' );

  $wp_customize->add_control(
    new X_Customize_Sub_Title( $wp_customize, 'x_typography_sub_title_logo', array(
      'label'    => __( 'Logo', '__x__' ),
      'section'  => 'x_customizer_section_typography',
      'settings' => 'x_typography_sub_title_logo',
      'priority' => 70
    ))
  );

  $wp_customize->add_setting( 'x_logo_font_family', array(
    'default' => 'Lato'
  ));

  $wp_customize->add_control( 'x_logo_font_family', array(
    'type'     => 'select',
    'label'    => __( 'Logo Font', '__x__' ),
    'section'  => 'x_customizer_section_typography',
    'priority' => 80,
    'choices'  => $list_fonts
  ));

  $wp_customize->add_setting( 'x_logo_font_color_enable', array(
    'default' => 0
  ));

  $wp_customize->add_control( 'x_logo_font_color_enable', array(
    'type'     => 'checkbox',
    'label'    => __( 'Enable Logo Font Color', '__x__' ),
    'section'  => 'x_customizer_section_typography',
    'priority' => 90
  ));

  $wp_customize->add_setting( 'x_logo_font_color', array(
    'default' => '#999999'
  ));

  $wp_customize->add_control(
    new WP_Customize_Color_Control( $wp_customize, 'x_logo_font_color', array(
      'label'    => __( 'Logo Font Color', '__x__' ),
      'section'  => 'x_customizer_section_typography',
      'settings' => 'x_logo_font_color',
      'priority' => 100
    ))
  );

  $wp_customize->add_setting( 'x_logo_font_size', array(
    'default' => '54'
  ));

  $wp_customize->add_control( 'x_logo_font_size', array(
    'type'     => 'text',
    'label'    => __( 'Logo Font Size (px)', '__x__' ),
    'section'  => 'x_customizer_section_typography',
    'priority' => 110
  ));

  $wp_customize->add_setting( 'x_logo_font_weight', array(
    'default' => '400'
  ));

  $wp_customize->add_control( 'x_logo_font_weight', array(
    'type'     => 'radio',
    'label'    => __( 'Logo Font Weight', '__x__' ),
    'section'  => 'x_customizer_section_typography',
    'priority' => 120,
    'choices'  => $list_all_font_weights
  ));

  $wp_customize->add_setting( 'x_logo_letter_spacing', array(
    'default' => '-3'
  ));

  $wp_customize->add_control( 'x_logo_letter_spacing', array(
    'type'     => 'text',
    'label'    => __( 'Logo Letter Spacing (px)', '__x__' ),
    'section'  => 'x_customizer_section_typography',
    'priority' => 130
  ));

  $wp_customize->add_setting( 'x_logo_uppercase_enable', array(
    'default' => 0
  ));

  $wp_customize->add_control( 'x_logo_uppercase_enable', array(
    'type'     => 'checkbox',
    'label'    => __( 'Enable Uppercase', '__x__' ),
    'section'  => 'x_customizer_section_typography',
    'priority' => 140
  ));

  $wp_customize->add_setting( 'x_typography_sub_title_navbar' );

  $wp_customize->add_control(
    new X_Customize_Sub_Title( $wp_customize, 'x_typography_sub_title_navbar', array(
      'label'    => __( 'Navbar', '__x__' ),
      'section'  => 'x_customizer_section_typography',
      'settings' => 'x_typography_sub_title_navbar',
      'priority' => 150
    ))
  );

  $wp_customize->add_setting( 'x_navbar_font_family', array(
    'default' => 'Lato'
  ));

  $wp_customize->add_control( 'x_navbar_font_family', array(
    'type'     => 'select',
    'label'    => __( 'Navbar Font', '__x__' ),
    'section'  => 'x_customizer_section_typography',
    'priority' => 160,
    'choices'  => $list_fonts
  ));

  $wp_customize->add_setting( 'x_navbar_link_color', array(
    'default' => '#b7b7b7'
  ));

  $wp_customize->add_control(
    new WP_Customize_Color_Control( $wp_customize, 'x_navbar_link_color', array(
      'label'    => __( 'Navbar Links', '__x__' ),
      'section'  => 'x_customizer_section_typography',
      'settings' => 'x_navbar_link_color',
      'priority' => 170
    ))
  );

  $wp_customize->add_setting( 'x_navbar_link_color_hover', array(
    'default' => '#272727'
  ));

  $wp_customize->add_control(
    new WP_Customize_Color_Control( $wp_customize, 'x_navbar_link_color_hover', array(
      'label'    => __( 'Navbar Links Hover', '__x__' ),
      'section'  => 'x_customizer_section_typography',
      'settings' => 'x_navbar_link_color_hover',
      'priority' => 180
    ))
  );

  $wp_customize->add_setting( 'x_navbar_font_size', array(
    'default' => '12'
  ));

  $wp_customize->add_control( 'x_navbar_font_size', array(
    'type'     => 'text',
    'label'    => __( 'Navbar Font Size (px)', '__x__' ),
    'section'  => 'x_customizer_section_typography',
    'priority' => 190
  ));

  $wp_customize->add_setting( 'x_navbar_font_weight', array(
    'default' => '400'
  ));

  $wp_customize->add_control( 'x_navbar_font_weight', array(
    'type'     => 'radio',
    'label'    => __( 'Navbar Font Weight', '__x__' ),
    'section'  => 'x_customizer_section_typography',
    'priority' => 200,
    'choices'  => $list_all_font_weights
  ));

  $wp_customize->add_setting( 'x_navbar_uppercase_enable', array(
    'default' => 0
  ));

  $wp_customize->add_control( 'x_navbar_uppercase_enable', array(
    'type'     => 'checkbox',
    'label'    => __( 'Enable Uppercase', '__x__' ),
    'section'  => 'x_customizer_section_typography',
    'priority' => 210
  ));

  $wp_customize->add_setting( 'x_typography_sub_title_headings' );

  $wp_customize->add_control(
    new X_Customize_Sub_Title( $wp_customize, 'x_typography_sub_title_headings', array(
      'label'    => __( 'Headings', '__x__' ),
      'section'  => 'x_customizer_section_typography',
      'settings' => 'x_typography_sub_title_headings',
      'priority' => 220
    ))
  );

  $wp_customize->add_setting( 'x_headings_font_family', array(
    'default' => 'Lato'
  ));

  $wp_customize->add_control( 'x_headings_font_family', array(
    'type'     => 'select',
    'label'    => __( 'Headings Font', '__x__' ),
    'section'  => 'x_customizer_section_typography',
    'priority' => 230,
    'choices'  => $list_fonts
  ));

  $wp_customize->add_setting( 'x_headings_font_color_enable', array(
    'default' => 0
  ));

  $wp_customize->add_control( 'x_headings_font_color_enable', array(
    'type'     => 'checkbox',
    'label'    => __( 'Enable Headings Font Color', '__x__' ),
    'section'  => 'x_customizer_section_typography',
    'priority' => 240
  ));

  $wp_customize->add_setting( 'x_headings_font_color', array(
    'default' => '#999999'
  ));

  $wp_customize->add_control(
    new WP_Customize_Color_Control( $wp_customize, 'x_headings_font_color', array(
      'label'    => __( 'Headings Font Color', '__x__' ),
      'section'  => 'x_customizer_section_typography',
      'settings' => 'x_headings_font_color',
      'priority' => 250
    ))
  );

  $wp_customize->add_setting( 'x_headings_font_weight', array(
    'default' => '400'
  ));

  $wp_customize->add_control( 'x_headings_font_weight', array(
    'type'     => 'radio',
    'label'    => __( 'Headings Font Weight', '__x__' ),
    'section'  => 'x_customizer_section_typography',
    'priority' => 260,
    'choices'  => $list_all_font_weights
  ));

  $wp_customize->add_setting( 'x_headings_letter_spacing', array(
    'default' => '-1'
  ));

  $wp_customize->add_control( 'x_headings_letter_spacing', array(
    'type'     => 'text',
    'label'    => __( 'Headings Letter Spacing (px)', '__x__' ),
    'section'  => 'x_customizer_section_typography',
    'priority' => 270
  ));

  $wp_customize->add_setting( 'x_headings_uppercase_enable', array(
    'default' => 0
  ));

  $wp_customize->add_control( 'x_headings_uppercase_enable', array(
    'type'     => 'checkbox',
    'label'    => __( 'Enable Uppercase', '__x__' ),
    'section'  => 'x_customizer_section_typography',
    'priority' => 280
  ));

  $wp_customize->add_setting( 'x_headings_widget_icons_enable', array(
    'default' => 0
  ));

  $wp_customize->add_control( 'x_headings_widget_icons_enable', array(
    'type'     => 'checkbox',
    'label'    => __( 'Enable Widget Icons', '__x__' ),
    'section'  => 'x_customizer_section_typography',
    'priority' => 290
  ));

  $wp_customize->add_setting( 'x_typography_sub_title_body_content' );

  $wp_customize->add_control(
    new X_Customize_Sub_Title( $wp_customize, 'x_typography_sub_title_body_content', array(
      'label'    => __( 'Body and Content', '__x__' ),
      'section'  => 'x_customizer_section_typography',
      'settings' => 'x_typography_sub_title_body_content',
      'priority' => 300
    ))
  );

  $wp_customize->add_setting( 'x_typography_description_body_content' );

  $wp_customize->add_control(
    new X_Customize_Description( $wp_customize, 'x_typography_description_body_content', array(
      'label'    => __( '"Body Font Size (px)" will affect the sizing of all copy outside of a post or page content area. "Content Font Size (px)" will affect the sizing of all copy inside a post or page content area. Headings are set with percentages and sized proportionally to these settings.', '__x__' ),
      'section'  => 'x_customizer_section_typography',
      'settings' => 'x_typography_description_body_content',
      'priority' => 310
    ))
  );

  $wp_customize->add_setting( 'x_body_font_family', array(
    'default' => 'Lato'
  ));

  $wp_customize->add_control( 'x_body_font_family', array(
    'type'     => 'select',
    'label'    => __( 'Body Font', '__x__' ),
    'section'  => 'x_customizer_section_typography',
    'priority' => 320,
    'choices'  => $list_fonts
  ));

  $wp_customize->add_setting( 'x_body_font_color_enable', array(
    'default' => 0
  ));

  $wp_customize->add_control( 'x_body_font_color_enable', array(
    'type'     => 'checkbox',
    'label'    => __( 'Enable Body Font Color', '__x__' ),
    'section'  => 'x_customizer_section_typography',
    'priority' => 330
  ));

  $wp_customize->add_setting( 'x_body_font_color', array(
    'default' => '#999999'
  ));

  $wp_customize->add_control(
    new WP_Customize_Color_Control( $wp_customize, 'x_body_font_color', array(
      'label'    => __( 'Body Font Color', '__x__' ),
      'section'  => 'x_customizer_section_typography',
      'settings' => 'x_body_font_color',
      'priority' => 340
    ))
  );

  $wp_customize->add_setting( 'x_body_font_size', array(
    'default' => '14'
  ));

  $wp_customize->add_control( 'x_body_font_size', array(
    'type'     => 'text',
    'label'    => __( 'Body Font Size (px)', '__x__' ),
    'section'  => 'x_customizer_section_typography',
    'priority' => 350
  ));

  $wp_customize->add_setting( 'x_content_font_size', array(
    'default' => '14'
  ));

  $wp_customize->add_control( 'x_content_font_size', array(
    'type'     => 'text',
    'label'    => __( 'Content Font Size (px)', '__x__' ),
    'section'  => 'x_customizer_section_typography',
    'priority' => 360
  ));

  $wp_customize->add_setting( 'x_body_font_weight', array(
    'default' => '400'
  ));

  $wp_customize->add_control( 'x_body_font_weight', array(
    'type'     => 'radio',
    'label'    => __( 'Body Font Weight', '__x__' ),
    'section'  => 'x_customizer_section_typography',
    'priority' => 370,
    'choices'  => $list_all_font_weights
  ));

  $wp_customize->add_setting( 'x_typography_sub_title_site_links' );

  $wp_customize->add_control(
    new X_Customize_Sub_Title( $wp_customize, 'x_typography_sub_title_site_links', array(
      'label'    => __( 'Site Links', '__x__' ),
      'section'  => 'x_customizer_section_typography',
      'settings' => 'x_typography_sub_title_site_links',
      'priority' => 380
    ))
  );

  $wp_customize->add_setting( 'x_typography_description_site_links' );

  $wp_customize->add_control(
    new X_Customize_Description( $wp_customize, 'x_typography_description_site_links', array(
      'label'    => __( 'Site link colors are also used as accents for various elements throughout your site, so make sure to select something you really enjoy and keep an eye out for how it affects your design.', '__x__' ),
      'section'  => 'x_customizer_section_typography',
      'settings' => 'x_typography_description_site_links',
      'priority' => 390
    ))
  );

  $wp_customize->add_setting( 'x_site_link_color', array(
    'default' => '#ff2a13'
  ));

  $wp_customize->add_control(
    new WP_Customize_Color_Control( $wp_customize, 'x_site_link_color', array(
      'label'    => __( 'Site Links', '__x__' ),
      'section'  => 'x_customizer_section_typography',
      'settings' => 'x_site_link_color',
      'priority' => 400
    ))
  );

  $wp_customize->add_setting( 'x_site_link_color_hover', array(
    'default' => '#d80f0f'
  ));

  $wp_customize->add_control(
    new WP_Customize_Color_Control( $wp_customize, 'x_site_link_color_hover', array(
      'label'    => __( 'Site Links Hover', '__x__' ),
      'section'  => 'x_customizer_section_typography',
      'settings' => 'x_site_link_color_hover',
      'priority' => 410
    ))
  );


  //
  // Buttons.
  //

  $wp_customize->add_section( 'x_customizer_section_buttons', array(
    'title'    => __( 'Buttons', '__x__' ),
    'priority' => 6
  ));

  $wp_customize->add_setting( 'x_buttons_description_overview' );

  $wp_customize->add_control(
    new X_Customize_Description( $wp_customize, 'x_buttons_description_overview', array(
      'label'    => __( 'Retina ready, limitless colors, and multiple shapes. The buttons available in X are fun to use, simple to implement, and look great on all devices no matter the size.', '__x__' ),
      'section'  => 'x_customizer_section_buttons',
      'settings' => 'x_buttons_description_overview',
      'priority' => 10
    ))
  );

  $wp_customize->add_setting( 'x_button_style', array(
    'default' => 'real'
  ));

  $wp_customize->add_control( 'x_button_style', array(
    'type'     => 'radio',
    'label'    => __( 'Button Style', '__x__' ),
    'section'  => 'x_customizer_section_buttons',
    'priority' => 20,
    'choices'  => array(
      'real'        => __( '3D', '__x__' ),
      'flat'        => __( 'Flat', '__x__' ),
      'transparent' => __( 'Transparent', '__x__' )
    )
  ));

  $wp_customize->add_setting( 'x_button_shape', array(
    'default' => 'rounded'
  ));

  $wp_customize->add_control( 'x_button_shape', array(
    'type'     => 'radio',
    'label'    => __( 'Button Shape', '__x__' ),
    'section'  => 'x_customizer_section_buttons',
    'priority' => 30,
    'choices'  => array(
      'square'  => __( 'Square', '__x__' ),
      'rounded' => __( 'Rounded', '__x__' ),
      'pill'    => __( 'Pill', '__x__' )
    )
  ));

  $wp_customize->add_setting( 'x_button_size', array(
    'default' => 'regular'
  ));

  $wp_customize->add_control( 'x_button_size', array(
    'type'     => 'radio',
    'label'    => __( 'Button Size', '__x__' ),
    'section'  => 'x_customizer_section_buttons',
    'priority' => 40,
    'choices'  => array(
      'mini'    => __( 'Mini', '__x__' ),
      'small'   => __( 'Small', '__x__' ),
      'regular' => __( 'Regular', '__x__' ),
      'large'   => __( 'Large', '__x__' ),
      'x-large' => __( 'Extra Large', '__x__' ),
      'jumbo'   => __( 'Jumbo', '__x__' )
    )
  ));

  $wp_customize->add_setting( 'x_button_sub_title_colors' );

  $wp_customize->add_control(
    new X_Customize_Sub_Title( $wp_customize, 'x_button_sub_title_colors', array(
      'label'    => __( 'Colors', '__x__' ),
      'section'  => 'x_customizer_section_buttons',
      'settings' => 'x_button_sub_title_colors',
      'priority' => 50
    ))
  );

  $wp_customize->add_setting( 'x_button_color', array(
    'default' => '#ffffff'
  ));

  $wp_customize->add_control(
    new WP_Customize_Color_Control( $wp_customize, 'x_button_color', array(
      'label'    => __( 'Button Text', '__x__' ),
      'section'  => 'x_customizer_section_buttons',
      'settings' => 'x_button_color',
      'priority' => 60
    ))
  );

  $wp_customize->add_setting( 'x_button_background_color', array(
    'default' => '#ff2a13'
  ));

  $wp_customize->add_control(
    new WP_Customize_Color_Control( $wp_customize, 'x_button_background_color', array(
      'label'    => __( 'Button Background', '__x__' ),
      'section'  => 'x_customizer_section_buttons',
      'settings' => 'x_button_background_color',
      'priority' => 70
    ))
  );

  $wp_customize->add_setting( 'x_button_border_color', array(
    'default' => '#ac1100'
  ));

  $wp_customize->add_control(
    new WP_Customize_Color_Control( $wp_customize, 'x_button_border_color', array(
      'label'    => __( 'Button Border', '__x__' ),
      'section'  => 'x_customizer_section_buttons',
      'settings' => 'x_button_border_color',
      'priority' => 80
    ))
  );

  $wp_customize->add_setting( 'x_button_bottom_color', array(
    'default' => '#a71000'
  ));

  $wp_customize->add_control(
    new WP_Customize_Color_Control( $wp_customize, 'x_button_bottom_color', array(
      'label'    => __( 'Button Bottom', '__x__' ),
      'section'  => 'x_customizer_section_buttons',
      'settings' => 'x_button_bottom_color',
      'priority' => 90
    ))
  );

  $wp_customize->add_setting( 'x_button_sub_title_hover_colors' );

  $wp_customize->add_control(
    new X_Customize_Sub_Title( $wp_customize, 'x_button_sub_title_hover_colors', array(
      'label'    => __( 'Hover Colors', '__x__' ),
      'section'  => 'x_customizer_section_buttons',
      'settings' => 'x_button_sub_title_hover_colors',
      'priority' => 100
    ))
  );

  $wp_customize->add_setting( 'x_button_color_hover', array(
    'default' => '#ffffff'
  ));

  $wp_customize->add_control(
    new WP_Customize_Color_Control( $wp_customize, 'x_button_color_hover', array(
      'label'    => __( 'Button Text', '__x__' ),
      'section'  => 'x_customizer_section_buttons',
      'settings' => 'x_button_color_hover',
      'priority' => 110
    ))
  );

  $wp_customize->add_setting( 'x_button_background_color_hover', array(
    'default' => '#ef2201'
  ));

  $wp_customize->add_control(
    new WP_Customize_Color_Control( $wp_customize, 'x_button_background_color_hover', array(
      'label'    => __( 'Button Background', '__x__' ),
      'section'  => 'x_customizer_section_buttons',
      'settings' => 'x_button_background_color_hover',
      'priority' => 120
    ))
  );

  $wp_customize->add_setting( 'x_button_border_color_hover', array(
    'default' => '#600900'
  ));

  $wp_customize->add_control(
    new WP_Customize_Color_Control( $wp_customize, 'x_button_border_color_hover', array(
      'label'    => __( 'Button Border', '__x__' ),
      'section'  => 'x_customizer_section_buttons',
      'settings' => 'x_button_border_color_hover',
      'priority' => 130
    ))
  );

  $wp_customize->add_setting( 'x_button_bottom_color_hover', array(
    'default' => '#a71000'
  ));

  $wp_customize->add_control(
    new WP_Customize_Color_Control( $wp_customize, 'x_button_bottom_color_hover', array(
      'label'    => __( 'Button Bottom', '__x__' ),
      'section'  => 'x_customizer_section_buttons',
      'settings' => 'x_button_bottom_color_hover',
      'priority' => 140
    ))
  );


  //
  // Header.
  //

  $wp_customize->add_section( 'x_customizer_section_header', array(
    'title'    => __( 'Header', '__x__' ),
    'priority' => 7
  ));

  $wp_customize->add_setting( 'x_navbar_description_overview' );

  $wp_customize->add_control(
    new X_Customize_Description( $wp_customize, 'x_navbar_description_overview', array(
      'label'    => __( 'Never before has such flexibility been offered to WordPress users for their site\'s header. It\'s one of the first things your visitors see when they come to your site, now you can make it look exactly how you want.', '__x__' ),
      'section'  => 'x_customizer_section_header',
      'settings' => 'x_navbar_description_overview',
      'priority' => 10
    ))
  );

  $wp_customize->add_setting( 'x_navbar_positioning', array(
    'default' => 'static-top'
  ));

  $wp_customize->add_control( 'x_navbar_positioning', array(
    'type'     => 'radio',
    'label'    => __( 'Navbar Position', '__x__' ),
    'section'  => 'x_customizer_section_header',
    'priority' => 20,
    'choices'  => array(
      'static-top'  => __( 'Static Top', '__x__' ),
      'fixed-top'   => __( 'Fixed Top', '__x__' ),
      'fixed-left'  => __( 'Fixed Left', '__x__' ),
      'fixed-right' => __( 'Fixed Right', '__x__' )
    )
  ));

  $wp_customize->add_setting( 'x_header_sub_title_navbar' );

  $wp_customize->add_control(
    new X_Customize_Sub_Title( $wp_customize, 'x_header_sub_title_navbar', array(
      'label'    => __( 'Navbar', '__x__' ),
      'section'  => 'x_customizer_section_header',
      'settings' => 'x_header_sub_title_navbar',
      'priority' => 30
    ))
  );

  $wp_customize->add_setting( 'x_header_description_navbar_width_height' );

  $wp_customize->add_control(
    new X_Customize_Description( $wp_customize, 'x_header_description_navbar_width_height', array(
      'label'    => __( '"Navbar Top Height (px)" must still be set even when using "Fixed Left" or "Fixed Right" positioning because on tablet and mobile devices, the menu is pushed to the top.', '__x__' ),
      'section'  => 'x_customizer_section_header',
      'settings' => 'x_header_description_navbar_width_height',
      'priority' => 40
    ))
  );

  $wp_customize->add_setting( 'x_navbar_height', array(
    'default' => '90'
  ));

  $wp_customize->add_control( 'x_navbar_height', array(
    'type'     => 'text',
    'label'    => __( 'Navbar Top Height (px)', '__x__' ),
    'section'  => 'x_customizer_section_header',
    'priority' => 50
  ));

  $wp_customize->add_setting( 'x_navbar_width', array(
    'default' => '235'
  ));

  $wp_customize->add_control( 'x_navbar_width', array(
    'type'     => 'text',
    'label'    => __( 'Navbar Side Width (px)', '__x__' ),
    'section'  => 'x_customizer_section_header',
    'priority' => 60
  ));

  $wp_customize->add_setting( 'x_header_sub_title_logo' );

  $wp_customize->add_control(
    new X_Customize_Sub_Title( $wp_customize, 'x_header_sub_title_logo', array(
      'label'    => __( 'Logo', '__x__' ),
      'section'  => 'x_customizer_section_header',
      'settings' => 'x_header_sub_title_logo',
      'priority' => 70
    ))
  );

  $wp_customize->add_setting( 'x_header_description_logo' );

  $wp_customize->add_control(
    new X_Customize_Description( $wp_customize, 'x_header_description_logo', array(
      'label'    => __( 'To make your logo retina ready, enter in the width of your uploaded image in the "Logo Width (px)" field and we\'ll take care of all the calculations for you. If you want your logo to stay the original size that was uploaded, leave the field blank.', '__x__' ),
      'section'  => 'x_customizer_section_header',
      'settings' => 'x_header_description_logo',
      'priority' => 80
    ))
  );

  $wp_customize->add_setting( 'x_logo' );

  $wp_customize->add_control(
    new WP_Customize_Image_Control( $wp_customize, 'x_logo', array(
      'label'    => __( 'Upload Your Logo', '__x__' ),
      'section'  => 'x_customizer_section_header',
      'settings' => 'x_logo',
      'priority' => 90
    ))
  );

  $wp_customize->add_setting( 'x_logo_width', array(
    'default' => ''
  ));

  $wp_customize->add_control( 'x_logo_width', array(
    'type'     => 'text',
    'label'    => __( 'Logo Width (px)', '__x__' ),
    'section'  => 'x_customizer_section_header',
    'priority' => 100
  ));

  $wp_customize->add_setting( 'x_header_sub_title_alignment' );

  $wp_customize->add_control(
    new X_Customize_Sub_Title( $wp_customize, 'x_header_sub_title_alignment', array(
      'label'    => __( 'Alignment', '__x__' ),
      'section'  => 'x_customizer_section_header',
      'settings' => 'x_header_sub_title_alignment',
      'priority' => 110
    ))
  );

  $wp_customize->add_setting( 'x_header_description_navbar_adjust' );

  $wp_customize->add_control(
    new X_Customize_Description( $wp_customize, 'x_header_description_navbar_adjust', array(
      'label'    => __( '"Navbar Top Logo Alignment (px)" and "Navbar Top Link Alignment (px)" must still be set even when using "Fixed Left" or "Fixed Right" positioning because on tablet and mobile devices, the menu is pushed to the top.', '__x__' ),
      'section'  => 'x_customizer_section_header',
      'settings' => 'x_header_description_navbar_adjust',
      'priority' => 120
    ))
  );

  $wp_customize->add_setting( 'x_logo_adjust_navbar_top', array(
    'default' => '13'
  ));

  $wp_customize->add_control( 'x_logo_adjust_navbar_top', array(
    'type'     => 'text',
    'label'    => __( 'Navbar Top Logo Alignment (px)', '__x__' ),
    'section'  => 'x_customizer_section_header',
    'priority' => 130
  ));

  $wp_customize->add_setting( 'x_navbar_adjust_links_top', array(
    'default' => '34'
  ));

  $wp_customize->add_control( 'x_navbar_adjust_links_top', array(
    'type'     => 'text',
    'label'    => __( 'Navbar Top Link Alignment (px)', '__x__' ),
    'section'  => 'x_customizer_section_header',
    'priority' => 140
  ));

  $wp_customize->add_setting( 'x_logo_adjust_navbar_side', array(
    'default' => '30'
  ));

  $wp_customize->add_control( 'x_logo_adjust_navbar_side', array(
    'type'     => 'text',
    'label'    => __( 'Navbar Side Logo Alignment (px)', '__x__' ),
    'section'  => 'x_customizer_section_header',
    'priority' => 150
  ));

  $wp_customize->add_setting( 'x_navbar_adjust_links_side', array(
    'default' => '50'
  ));

  $wp_customize->add_control( 'x_navbar_adjust_links_side', array(
    'type'     => 'text',
    'label'    => __( 'Navbar Side Link Alignment (px)', '__x__' ),
    'section'  => 'x_customizer_section_header',
    'priority' => 160
  ));

  $wp_customize->add_setting( 'x_navbar_adjust_button', array(
    'default' => '20'
  ));

  $wp_customize->add_control( 'x_navbar_adjust_button', array(
    'type'     => 'text',
    'label'    => __( 'Mobile Navbar Button Alignment (px)', '__x__' ),
    'section'  => 'x_customizer_section_header',
    'priority' => 170
  ));

  $wp_customize->add_setting( 'x_header_sub_title_widget_areas', array(
    'default' => ''
  ));

  $wp_customize->add_setting( 'x_navbar_adjust_button_size', array(
    'default' => '24'
  ));

  $wp_customize->add_control( 'x_navbar_adjust_button_size', array(
    'type'     => 'text',
    'label'    => __( 'Mobile Navbar Button Size (px)', '__x__' ),
    'section'  => 'x_customizer_section_header',
    'priority' => 180
  ));

  $wp_customize->add_setting( 'x_header_sub_title_widget_areas' );

  $wp_customize->add_control(
    new X_Customize_Sub_Title( $wp_customize, 'x_header_sub_title_widget_areas', array(
      'label'    => __( 'Widgetbar', '__x__' ),
      'section'  => 'x_customizer_section_header',
      'settings' => 'x_header_sub_title_widget_areas',
      'priority' => 190
    ))
  );

  $wp_customize->add_setting( 'x_header_widget_areas', array(
    'default' => 2
  ));

  $wp_customize->add_control( 'x_header_widget_areas', array(
    'type'     => 'radio',
    'label'    => 'Header Widget Areas',
    'section'  => 'x_customizer_section_header',
    'priority' => 200,
    'choices'  => array(
      0 => __( 'None (Disables the Widgetbar)', '__x__' ),
      1 => __( 'One', '__x__' ),
      2 => __( 'Two', '__x__' ),
      3 => __( 'Three', '__x__' ),
      4 => __( 'Four', '__x__' )
    )
  ));

  $wp_customize->add_setting( 'x_widgetbar_button_background', array(
    'default' => '#000000'
  ));

  $wp_customize->add_control(
    new WP_Customize_Color_Control( $wp_customize, 'x_widgetbar_button_background', array(
      'label'    => __( 'Widgetbar Button Background', '__x__' ),
      'section'  => 'x_customizer_section_header',
      'settings' => 'x_widgetbar_button_background',
      'priority' => 210
    ))
  );

  $wp_customize->add_setting( 'x_widgetbar_button_background_hover', array(
    'default' => '#444444'
  ));

  $wp_customize->add_control(
    new WP_Customize_Color_Control( $wp_customize, 'x_widgetbar_button_background_hover', array(
      'label'    => __( 'Widgetbar Button Background Hover', '__x__' ),
      'section'  => 'x_customizer_section_header',
      'settings' => 'x_widgetbar_button_background_hover',
      'priority' => 220
    ))
  );

  $wp_customize->add_setting( 'x_header_sub_title_misc' );

  $wp_customize->add_control(
    new X_Customize_Sub_Title( $wp_customize, 'x_header_sub_title_misc', array(
      'label'    => __( 'Miscellaneous', '__x__' ),
      'section'  => 'x_customizer_section_header',
      'settings' => 'x_header_sub_title_misc',
      'priority' => 230
    ))
  );

  $wp_customize->add_setting( 'x_topbar_display', array(
    'default' => 1
  ));

  $wp_customize->add_control( 'x_topbar_display', array(
    'type'     => 'checkbox',
    'label'    => __( 'Enable Topbar', '__x__' ),
    'section'  => 'x_customizer_section_header',
    'priority' => 240
  ));

  $wp_customize->add_setting( 'x_topbar_content', array(
    'default' => ''
  ));

  $wp_customize->add_control(
    new X_Customize_Control_Textarea( $wp_customize, 'x_topbar_content', array(
      'label'    => __( 'Topbar Content', '__x__' ),
      'section'  => 'x_customizer_section_header',
      'settings' => 'x_topbar_content',
      'priority' => 250
    ))
  );

  $wp_customize->add_setting( 'x_breadcrumb_display', array(
    'default' => 1
  ));

  $wp_customize->add_control( 'x_breadcrumb_display', array(
    'type'     => 'checkbox',
    'label'    => __( 'Enable Breadcrumbs', '__x__' ),
    'section'  => 'x_customizer_section_header',
    'priority' => 260
  ));


  //
  // Footer.
  //

  $wp_customize->add_section( 'x_customizer_section_footer', array(
    'title'    => __( 'Footer', '__x__' ),
    'priority' => 8
  ));

  $wp_customize->add_setting( 'x_footer_description_overview' );

  $wp_customize->add_control(
    new X_Customize_Description( $wp_customize, 'x_footer_description_overview', array(
      'label'    => __( 'Easily adjust your site\'s footer by setting your widget areas to the specific number desired and turning on or off various parts as needed. You\'re never forced to use a layout you don\'t need with X.', '__x__' ),
      'section'  => 'x_customizer_section_footer',
      'settings' => 'x_footer_description_overview',
      'priority' => 10
    ))
  );

  $wp_customize->add_setting( 'x_footer_widget_areas', array( // 1
    'default' => 3
  ));

  $wp_customize->add_control( 'x_footer_widget_areas', array(
    'type'     => 'radio',
    'label'    => __( 'Footer Widget Areas', '__x__' ),
    'section'  => 'x_customizer_section_footer',
    'priority' => 20,
    'choices'  => array(
      0 => __( 'None (Disables the Top Footer)', '__x__' ),
      1 => __( 'One', '__x__' ),
      2 => __( 'Two', '__x__' ),
      3 => __( 'Three', '__x__' ),
      4 => __( 'Four', '__x__' )
    )
  ));

  $wp_customize->add_setting( 'x_footer_bottom_display', array(
    'default' => 1
  ));

  $wp_customize->add_control( 'x_footer_bottom_display', array(
    'type'     => 'checkbox',
    'label'    => __( 'Enable Bottom Footer', '__x__' ),
    'section'  => 'x_customizer_section_footer',
    'priority' => 30
  ));

  $wp_customize->add_setting( 'x_footer_menu_display', array(
    'default' => 1
  ));

  $wp_customize->add_control( 'x_footer_menu_display', array(
    'type'     => 'checkbox',
    'label'    => __( 'Enable Footer Menu', '__x__' ),
    'section'  => 'x_customizer_section_footer',
    'priority' => 40
  ));

  $wp_customize->add_setting( 'x_footer_social_display', array(
    'default' => 1
  ));

  $wp_customize->add_control( 'x_footer_social_display', array(
    'type'     => 'checkbox',
    'label'    => __( 'Enable Footer Social', '__x__' ),
    'section'  => 'x_customizer_section_footer',
    'priority' => 50
  ));

  $wp_customize->add_setting( 'x_footer_content_display', array(
    'default' => 1
  ));

  $wp_customize->add_control( 'x_footer_content_display', array(
    'type'     => 'checkbox',
    'label'    => __( 'Enable Footer Content', '__x__' ),
    'section'  => 'x_customizer_section_footer',
    'priority' => 60
  ));

  $wp_customize->add_setting( 'x_footer_content', array(
    'default' => '<p style="letter-spacing: 2px; text-transform: uppercase; opacity: 0.5; filter: alpha(opacity=50);">Proudly Powered By The<br><a href="http://theme.co/x/" title="X WordPress Theme">X WordPress Theme</a></p>'
  ));

  $wp_customize->add_control(
    new X_Customize_Control_Textarea( $wp_customize, 'x_footer_content', array(
      'label'    => __( 'Footer Content', '__x__' ),
      'section'  => 'x_customizer_section_footer',
      'settings' => 'x_footer_content',
      'priority' => 70
    ))
  );

  $wp_customize->add_setting( 'x_footer_sub_title_scroll_top' );

  $wp_customize->add_control(
    new X_Customize_Sub_Title( $wp_customize, 'x_footer_sub_title_scroll_top', array(
      'label'    => __( 'Scroll Top Anchor', '__x__' ),
      'section'  => 'x_customizer_section_footer',
      'settings' => 'x_footer_sub_title_scroll_top',
      'priority' => 80
    ))
  );

  $wp_customize->add_setting( 'x_footer_scroll_top_description_overview' );

  $wp_customize->add_control(
    new X_Customize_Description( $wp_customize, 'x_footer_scroll_top_description_overview', array(
      'label'    => __( 'Activating the scroll top anchor will output a link that appears in the bottom corner of your site for users to click on that will return them to the top of your website. Once activated, set the value (as a percentage) for how far down the page your users will need to scroll for it to appear. For example, if you want the scroll top anchor to appear once your users have scrolled halfway down your page, you would enter "50" into the field.', '__x__' ),
      'section'  => 'x_customizer_section_footer',
      'settings' => 'x_footer_scroll_top_description_overview',
      'priority' => 90
    ))
  );

  $wp_customize->add_setting( 'x_footer_scroll_top_display', array(
    'default' => 0
  ));

  $wp_customize->add_control( 'x_footer_scroll_top_display', array(
    'type'     => 'checkbox',
    'label'    => __( 'Enable the Scroll Top Anchor', '__x__' ),
    'section'  => 'x_customizer_section_footer',
    'priority' => 100
  ));

  $wp_customize->add_setting( 'x_footer_scroll_top_position', array(
    'default' => 'right'
  ));

  $wp_customize->add_control( 'x_footer_scroll_top_position', array(
    'type'     => 'radio',
    'label'    => __( 'Scroll Top Anchor Position', '__x__' ),
    'section'  => 'x_customizer_section_footer',
    'priority' => 110,
    'choices'  => array(
      'left'  => __( 'Left', '__x__' ),
      'right' => __( 'Right', '__x__' )
    )
  ));

  $wp_customize->add_setting( 'x_footer_scroll_top_display_unit', array(
    'default' => '75'
  ));

  $wp_customize->add_control( 'x_footer_scroll_top_display_unit', array(
    'type'     => 'text',
    'label'    => __( 'When to Display the Scroll Top Anchor (%)', '__x__' ),
    'section'  => 'x_customizer_section_footer',
    'priority' => 120
  ));


  //
  // Blog.
  //

  $wp_customize->add_section( 'x_customizer_section_blog', array(
    'title'    => __( 'Blog', '__x__' ),
    'priority' => 9
  ));

  $wp_customize->add_setting( 'x_blog_description_overview' );

  $wp_customize->add_control(
    new X_Customize_Description( $wp_customize, 'x_blog_description_overview', array(
      'label'    => __( 'Adjust the style and layout of your blog using the settings below. This will only affect the posts index page of your blog and will not alter any archive or search results pages. The "Layout" option allows you to keep your sidebar on your posts index page if you have already selected "Content Left, Sidebar Right" or "Sidebar Left, Content Right" for you "Content Layout" option, or remove the sidebar completely if desired.', '__x__' ),
      'section'  => 'x_customizer_section_blog',
      'settings' => 'x_blog_description_overview',
      'priority' => 10
    ))
  );

  $wp_customize->add_setting( 'x_blog_style', array(
    'default' => 'standard'
  ));

  $wp_customize->add_control( 'x_blog_style', array(
    'type'     => 'radio',
    'label'    => __( 'Style', '__x__' ),
    'section'  => 'x_customizer_section_blog',
    'priority' => 20,
    'choices' => array(
      'standard' => __( 'Standard', '__x__' ),
      'masonry'  => __( 'Masonry', '__x__' )
    )
  ));

  $wp_customize->add_setting( 'x_blog_layout', array(
    'default' => 'full-width'
  ));

  $wp_customize->add_control( 'x_blog_layout', array(
    'type'     => 'radio',
    'label'    => __( 'Layout', '__x__' ),
    'section'  => 'x_customizer_section_blog',
    'priority' => 30,
    'choices'  => array(
      'sidebar'    => __( 'Keep Sidebar', '__x__' ),
      'full-width' => __( 'Fullwidth', '__x__' )
    )
  ));

  $wp_customize->add_setting( 'x_blog_sub_title_blog_masonry' );

  $wp_customize->add_control(
    new X_Customize_Sub_Title( $wp_customize, 'x_blog_sub_title_blog_masonry', array(
      'label'    => __( 'Blog Masonry', '__x__' ),
      'section'  => 'x_customizer_section_blog',
      'settings' => 'x_blog_sub_title_blog_masonry',
      'priority' => 40
    ))
  );

  $wp_customize->add_setting( 'x_blog_description_blog_masonry' );

  $wp_customize->add_control(
    new X_Customize_Description( $wp_customize, 'x_blog_description_blog_masonry', array(
      'label'    => __( 'Select how many columns you would like for your masonry layout. It is strongly recommended that you remove the sidebar for your blog if you plan on using the three column layout due to size constraints.', '__x__' ),
      'section'  => 'x_customizer_section_blog',
      'settings' => 'x_blog_description_blog_masonry',
      'priority' => 50
    ))
  );

  $wp_customize->add_setting( 'x_blog_masonry_columns', array(
    'default' => '2'
  ));

  $wp_customize->add_control( 'x_blog_masonry_columns', array(
    'type'     => 'radio',
    'label'    => __( 'Columns', '__x__' ),
    'section'  => 'x_customizer_section_blog',
    'priority' => 60,
    'choices' => array(
      2 => __( 'Two', '__x__' ),
      3 => __( 'Three', '__x__' )
    )
  ));

  $wp_customize->add_setting( 'x_blog_sub_title_archives' );

  $wp_customize->add_control(
    new X_Customize_Sub_Title( $wp_customize, 'x_blog_sub_title_archives', array(
      'label'    => __( 'Archives', '__x__' ),
      'section'  => 'x_customizer_section_blog',
      'settings' => 'x_blog_sub_title_archives',
      'priority' => 70
    ))
  );

  $wp_customize->add_setting( 'x_blog_description_archives' );

  $wp_customize->add_control(
    new X_Customize_Description( $wp_customize, 'x_blog_description_archives', array(
      'label'    => __( 'Adjust the style and layout of your archive pages using the settings below. The "Layout" option allows you to keep your sidebar on your posts index page if you have already selected "Content Left, Sidebar Right" or "Sidebar Left, Content Right" for you "Content Layout" option, or remove the sidebar completely if desired.', '__x__' ),
      'section'  => 'x_customizer_section_blog',
      'settings' => 'x_blog_description_archives',
      'priority' => 80
    ))
  );

  $wp_customize->add_setting( 'x_archive_style', array(
    'default' => 'standard'
  ));

  $wp_customize->add_control( 'x_archive_style', array(
    'type'     => 'radio',
    'label'    => __( 'Style', '__x__' ),
    'section'  => 'x_customizer_section_blog',
    'priority' => 90,
    'choices' => array(
      'standard' => __( 'Standard', '__x__' ),
      'masonry'  => __( 'Masonry', '__x__' )
    )
  ));

  $wp_customize->add_setting( 'x_archive_layout', array(
    'default' => 'full-width'
  ));

  $wp_customize->add_control( 'x_archive_layout', array(
    'type'     => 'radio',
    'label'    => __( 'Layout', '__x__' ),
    'section'  => 'x_customizer_section_blog',
    'priority' => 100,
    'choices'  => array(
      'sidebar'    => __( 'Keep Sidebar', '__x__' ),
      'full-width' => __( 'Fullwidth', '__x__' )
    )
  ));

  $wp_customize->add_setting( 'x_blog_sub_title_archive_masonry' );

  $wp_customize->add_control(
    new X_Customize_Sub_Title( $wp_customize, 'x_blog_sub_title_archive_masonry', array(
      'label'    => __( 'Archive Masonry', '__x__' ),
      'section'  => 'x_customizer_section_blog',
      'settings' => 'x_blog_sub_title_archive_masonry',
      'priority' => 110
    ))
  );

  $wp_customize->add_setting( 'x_blog_description_archive_masonry' );

  $wp_customize->add_control(
    new X_Customize_Description( $wp_customize, 'x_blog_description_archive_masonry', array(
      'label'    => __( 'Select how many columns you would like for your masonry layout. It is strongly recommended that you remove the sidebar for your blog if you plan on using the three column layout due to size constraints.', '__x__' ),
      'section'  => 'x_customizer_section_blog',
      'settings' => 'x_blog_description_archive_masonry',
      'priority' => 120
    ))
  );

  $wp_customize->add_setting( 'x_archive_masonry_columns', array(
    'default' => '2'
  ));

  $wp_customize->add_control( 'x_archive_masonry_columns', array(
    'type'     => 'radio',
    'label'    => __( 'Columns', '__x__' ),
    'section'  => 'x_customizer_section_blog',
    'priority' => 130,
    'choices' => array(
      2 => __( 'Two', '__x__' ),
      3 => __( 'Three', '__x__' )
    )
  ));

  $wp_customize->add_setting( 'x_blog_sub_title_post_content' );

  $wp_customize->add_control(
    new X_Customize_Sub_Title( $wp_customize, 'x_blog_sub_title_post_content', array(
      'label'    => __( 'Content', '__x__' ),
      'section'  => 'x_customizer_section_blog',
      'settings' => 'x_blog_sub_title_post_content',
      'priority' => 140
    ))
  );

  $wp_customize->add_setting( 'x_blog_description_post_content' );

  $wp_customize->add_control(
    new X_Customize_Description( $wp_customize, 'x_blog_description_post_content', array(
      'label'    => __( 'Selecting the "Enable Full Post Content on Index" option below will allow the entire contents of your posts to be shown on the post index pages for all stacks. Deselecting this option will allow you to set the length of your excerpt.', '__x__' ),
      'section'  => 'x_customizer_section_blog',
      'settings' => 'x_blog_description_post_content',
      'priority' => 150
    ))
  );

  $wp_customize->add_setting( 'x_blog_enable_post_meta', array(
    'default' => 0
  ));

  $wp_customize->add_control( 'x_blog_enable_post_meta', array(
    'type'     => 'checkbox',
    'label'    => __( 'Enable Post Meta', '__x__' ),
    'section'  => 'x_customizer_section_blog',
    'priority' => 160
  ));

  $wp_customize->add_setting( 'x_blog_enable_full_post_content', array(
    'default' => 0
  ));

  $wp_customize->add_control( 'x_blog_enable_full_post_content', array(
    'type'     => 'checkbox',
    'label'    => __( 'Enable Full Post Content on Index', '__x__' ),
    'section'  => 'x_customizer_section_blog',
    'priority' => 170
  ));

  $wp_customize->add_setting( 'x_blog_excerpt_length', array(
    'default' => '60'
  ));

  $wp_customize->add_control( 'x_blog_excerpt_length', array(
    'type'     => 'text',
    'label'    => __( 'Excerpt Length', '__x__' ),
    'section'  => 'x_customizer_section_blog',
    'priority' => 180
  ));


  //
  // Portfolio.
  //

  $wp_customize->add_section( 'x_customizer_section_portfolio', array(
    'title'    => __( 'Portfolio', '__x__' ),
    'priority' => 10
  ));

  $wp_customize->add_setting( 'x_portfolio_description_overview' );

  $wp_customize->add_control(
    new X_Customize_Description( $wp_customize, 'x_portfolio_description_overview', array(
      'label'    => __( 'Setting your custom portfolio slug allows you to create a unique URL structure that fits your needs. When you update it, remember to save your Permalinks again to avoid any potential errors. Finally, go to "Appearance" > "Menus" and write a custom link to the new slug to take people to your portfolio.', '__x__' ),
      'section'  => 'x_customizer_section_portfolio',
      'settings' => 'x_portfolio_description_overview',
      'priority' => 10
    ))
  );

  $wp_customize->add_setting( 'x_custom_portfolio_slug', array(
    'default' => 'my-portfolio'
  ));

  $wp_customize->add_control( 'x_custom_portfolio_slug', array(
    'type'     => 'text',
    'label'    => __( 'Custom URL Slug', '__x__' ),
    'section'  => 'x_customizer_section_portfolio',
    'priority' => 20
  ));

  $wp_customize->add_setting( 'x_portfolio_title', array(
    'default' => 'My Portfolio'
  ));

  $wp_customize->add_control( 'x_portfolio_title', array(
    'type'     => 'text',
    'label'    => __( 'Title', '__x__' ),
    'section'  => 'x_customizer_section_portfolio',
    'priority' => 30
  ));

  $wp_customize->add_setting( 'x_portfolio_sub_title_layout' );

  $wp_customize->add_control(
    new X_Customize_Sub_Title( $wp_customize, 'x_portfolio_sub_title_layout', array(
      'label'    => __( 'Layout', '__x__' ),
      'section'  => 'x_customizer_section_portfolio',
      'settings' => 'x_portfolio_sub_title_layout',
      'priority' => 40
    ))
  );

  $wp_customize->add_setting( 'x_portfolio_description_layout' );

  $wp_customize->add_control(
    new X_Customize_Description( $wp_customize, 'x_portfolio_description_layout', array(
      'label'    => __( 'The "Layout" option allows you to keep your sidebar on your portfolio listing page if you have already selected "Content Left, Sidebar Right" or "Sidebar Left, Content Right" for you "Content Layout" option, or remove the sidebar completely if desired.', '__x__' ),
      'section'  => 'x_customizer_section_portfolio',
      'settings' => 'x_portfolio_description_layout',
      'priority' => 50
    ))
  );

  $wp_customize->add_setting( 'x_portfolio_columns', array(
    'default' => '2'
  ));

  $wp_customize->add_control( 'x_portfolio_columns', array(
    'type'     => 'radio',
    'label'    => __( 'Columns', '__x__' ),
    'section'  => 'x_customizer_section_portfolio',
    'priority' => 60,
    'choices' => array(
      1 => __( 'One', '__x__' ),
      2 => __( 'Two', '__x__' ),
      3 => __( 'Three', '__x__' ),
      4 => __( 'Four', '__x__' )
    )
  ));

  $wp_customize->add_setting( 'x_portfolio_layout', array(
    'default' => 'full-width'
  ));

  $wp_customize->add_control( 'x_portfolio_layout', array(
    'type'     => 'radio',
    'label'    => __( 'Layout', '__x__' ),
    'section'  => 'x_customizer_section_portfolio',
    'priority' => 70,
    'choices'  => array(
      'sidebar'    => __( 'Keep Sidebar', '__x__' ),
      'full-width' => __( 'Fullwidth', '__x__' )
    )
  ));

  $wp_customize->add_setting( 'x_portfolio_sub_title_content' );

  $wp_customize->add_control(
    new X_Customize_Sub_Title( $wp_customize, 'x_portfolio_sub_title_content', array(
      'label'    => __( 'Content', '__x__' ),
      'section'  => 'x_customizer_section_portfolio',
      'settings' => 'x_portfolio_sub_title_content',
      'priority' => 80
    ))
  );

  $wp_customize->add_setting( 'x_portfolio_count', array(
    'default' => '6'
  ));

  $wp_customize->add_control( 'x_portfolio_count', array(
    'type'     => 'text',
    'label'    => __( 'Posts Per Page', '__x__' ),
    'section'  => 'x_customizer_section_portfolio',
    'priority' => 90
  ));

  $wp_customize->add_setting( 'x_portfolio_enable_cropped_thumbs', array(
    'default' => 0
  ));

  $wp_customize->add_control( 'x_portfolio_enable_cropped_thumbs', array(
    'type'     => 'checkbox',
    'label'    => __( 'Enable Cropped Featured Images', '__x__' ),
    'section'  => 'x_customizer_section_portfolio',
    'priority' => 100
  ));

  $wp_customize->add_setting( 'x_portfolio_enable_post_meta', array(
    'default' => 1
  ));

  $wp_customize->add_control( 'x_portfolio_enable_post_meta', array(
    'type'     => 'checkbox',
    'label'    => __( 'Enable Post Meta', '__x__' ),
    'section'  => 'x_customizer_section_portfolio',
    'priority' => 110
  ));

  $wp_customize->add_setting( 'x_portfolio_sub_title_labels' );

  $wp_customize->add_control(
    new X_Customize_Sub_Title( $wp_customize, 'x_portfolio_sub_title_labels', array(
      'label'    => __( 'Labels', '__x__' ),
      'section'  => 'x_customizer_section_portfolio',
      'settings' => 'x_portfolio_sub_title_labels',
      'priority' => 120
    ))
  );

  $wp_customize->add_setting( 'x_portfolio_tag_title', array(
    'default' => 'Skills'
  ));

  $wp_customize->add_control( 'x_portfolio_tag_title', array(
    'type'     => 'text',
    'label'    => __( 'Tag List Title', '__x__' ),
    'section'  => 'x_customizer_section_portfolio',
    'priority' => 130
  ));

  $wp_customize->add_setting( 'x_portfolio_launch_project_title', array(
    'default' => 'Launch Project'
  ));

  $wp_customize->add_control( 'x_portfolio_launch_project_title', array(
    'type'     => 'text',
    'label'    => __( 'Launch Project Title', '__x__' ),
    'section'  => 'x_customizer_section_portfolio',
    'priority' => 140
  ));

  $wp_customize->add_setting( 'x_portfolio_launch_project_button_text', array(
    'default' => 'See it Live!'
  ));

  $wp_customize->add_control( 'x_portfolio_launch_project_button_text', array(
    'type'     => 'text',
    'label'    => __( 'Launch Project Button Text', '__x__' ),
    'section'  => 'x_customizer_section_portfolio',
    'priority' => 150
  ));

  $wp_customize->add_setting( 'x_portfolio_share_project_title', array(
    'default' => 'Share this Project'
  ));

  $wp_customize->add_control( 'x_portfolio_share_project_title', array(
    'type'     => 'text',
    'label'    => __( 'Share Project Title', '__x__' ),
    'section'  => 'x_customizer_section_portfolio',
    'priority' => 160
  ));

  $wp_customize->add_setting( 'x_portfolio_sub_title_sharing' );

  $wp_customize->add_control(
    new X_Customize_Sub_Title( $wp_customize, 'x_portfolio_sub_title_sharing', array(
      'label'    => __( 'Sharing', '__x__' ),
      'section'  => 'x_customizer_section_portfolio',
      'settings' => 'x_portfolio_sub_title_sharing',
      'priority' => 170
    ))
  );

  $wp_customize->add_setting( 'x_portfolio_enable_facebook_sharing', array(
    'default' => 1
  ));

  $wp_customize->add_control( 'x_portfolio_enable_facebook_sharing', array(
    'type'     => 'checkbox',
    'label'    => __( 'Enable Facebook Sharing Link', '__x__' ),
    'section'  => 'x_customizer_section_portfolio',
    'priority' => 180
  ));

  $wp_customize->add_setting( 'x_portfolio_enable_twitter_sharing', array(
    'default' => 1
  ));

  $wp_customize->add_control( 'x_portfolio_enable_twitter_sharing', array(
    'type'     => 'checkbox',
    'label'    => __( 'Enable Twitter Sharing Link', '__x__' ),
    'section'  => 'x_customizer_section_portfolio',
    'priority' => 190
  ));

  $wp_customize->add_setting( 'x_portfolio_enable_google_plus_sharing', array(
    'default' => 0
  ));

  $wp_customize->add_control( 'x_portfolio_enable_google_plus_sharing', array(
    'type'     => 'checkbox',
    'label'    => __( 'Enable Google+ Sharing Link', '__x__' ),
    'section'  => 'x_customizer_section_portfolio',
    'priority' => 200
  ));

  $wp_customize->add_setting( 'x_portfolio_enable_linkedin_sharing', array(
    'default' => 0
  ));

  $wp_customize->add_control( 'x_portfolio_enable_linkedin_sharing', array(
    'type'     => 'checkbox',
    'label'    => __( 'Enable LinkedIn Sharing Link', '__x__' ),
    'section'  => 'x_customizer_section_portfolio',
    'priority' => 210
  ));

  $wp_customize->add_setting( 'x_portfolio_enable_pinterest_sharing', array(
    'default' => 0
  ));

  $wp_customize->add_control( 'x_portfolio_enable_pinterest_sharing', array(
    'type'     => 'checkbox',
    'label'    => __( 'Enable Pinterest Sharing Link', '__x__' ),
    'section'  => 'x_customizer_section_portfolio',
    'priority' => 220
  ));

  $wp_customize->add_setting( 'x_portfolio_enable_reddit_sharing', array(
    'default' => 0
  ));

  $wp_customize->add_control( 'x_portfolio_enable_reddit_sharing', array(
    'type'     => 'checkbox',
    'label'    => __( 'Enable Reddit Sharing Link', '__x__' ),
    'section'  => 'x_customizer_section_portfolio',
    'priority' => 230
  ));

  $wp_customize->add_setting( 'x_portfolio_enable_email_sharing', array(
    'default' => 0
  ));

  $wp_customize->add_control( 'x_portfolio_enable_email_sharing', array(
    'type'     => 'checkbox',
    'label'    => __( 'Enable Email Sharing Link', '__x__' ),
    'section'  => 'x_customizer_section_portfolio',
    'priority' => 240
  ));


  //
  // Sliders.
  //

  if ( class_exists( 'RevSlider' ) ) {

    $wp_customize->add_section( 'x_customizer_section_sliders', array(
      'title'    => __( 'Sliders', '__x__' ),
      'priority' => 11
    ));

    $wp_customize->add_setting( 'x_sliders_description_overview' );

    $wp_customize->add_control(
      new X_Customize_Description( $wp_customize, 'x_sliders_description_overview', array(
        'label'    => __( 'All sliders and their locations are managed here. The options available in this section are dynamically generated based on the sliders you have created. If you have not yet done so, go to the "Revolution Slider" tab and create a slider to assign to a page.', '__x__' ),
        'section'  => 'x_customizer_section_sliders',
        'settings' => 'x_sliders_description_overview',
        'priority' => 10
      ))
    );

    $i          = 1;
    $slider     = new RevSlider();
    $arrSliders = $slider->getArrSliders();
    foreach ( $arrSliders as $revSlider ) {

      $wp_customize->add_setting( 'x_slider_sub_title_' . $i );

      $wp_customize->add_control(
        new X_Customize_Sub_Title( $wp_customize, 'x_slider_sub_title_' . $i, array(
          'label'    => __( 'Slider #' . $i, '__x__' ),
          'section'  => 'x_customizer_section_sliders',
          'settings' => 'x_slider_sub_title_' . $i,
          'priority' => (20 * $i) + 1
        ))
      );

      $wp_customize->add_setting( 'x_slider_enable_' . $i, array(
        'default' => 0
      ));

      $wp_customize->add_control( 'x_slider_enable_' . $i, array(
        'type'     => 'checkbox',
        'label'    => __( 'Enable Slider', '__x__' ),
        'section'  => 'x_customizer_section_sliders',
        'priority' => (20 * $i) + 2
      ));

      $wp_customize->add_setting( 'x_slider_' . $i, array(
        'default' => $list_sliders_select[0]
      ));

      $wp_customize->add_control( 'x_slider_' . $i, array(
        'type'     => 'select',
        'label'    => __( 'Select Slider to Include', '__x__' ),
        'section'  => 'x_customizer_section_sliders',
        'priority' => (20 * $i) + 3,
        'choices'  => $list_sliders_select
      ));

      $wp_customize->add_setting( 'x_slider_include_page_' . $i, array(
        'default' => $list_pages_select[0]
      ));

      $wp_customize->add_control( 'x_slider_include_page_' . $i, array(
        'type'     => 'select',
        'label'    => __( 'Select Page to Include', '__x__' ),
        'section'  => 'x_customizer_section_sliders',
        'priority' => (20 * $i) + 4,
        'choices'  => $list_pages_select
      ));

      $wp_customize->add_setting( 'x_slider_location_' . $i, array(
        'default' => 'below'
      ));

      $wp_customize->add_control( 'x_slider_location_' . $i, array(
        'type'     => 'radio',
        'label'    => __( 'Display Location', '__x__' ),
        'section'  => 'x_customizer_section_sliders',
        'priority' => (20 * $i) + 5,
        'choices'  => array(
          'above' => __( 'Header (Before All Content)', '__x__' ),
          'below' => __( 'Body (After Topbar and Navbar)', '__x__' )
        )
      ));

      $wp_customize->add_setting( 'x_slider_video_' . $i, array(
        'default' => ''
      ));

      $wp_customize->add_control( 'x_slider_video_' . $i, array(
        'type'     => 'text',
        'label'    => __( 'Optional Video Background', '__x__' ),
        'section'  => 'x_customizer_section_sliders',
        'priority' => (20 * $i) + 6
      ));

      $wp_customize->add_setting( 'x_slider_video_poster_' . $i );

      $wp_customize->add_control(
        new WP_Customize_Image_Control( $wp_customize, 'x_slider_video_poster_' . $i, array(
          'label'    => __( 'Video Poster Image (For Mobile)', '__x__' ),
          'section'  => 'x_customizer_section_sliders',
          'settings' => 'x_slider_video_poster_' . $i,
          'priority' => (20 * $i) + 7
        ))
      );

      $wp_customize->add_setting( 'x_slider_scroll_bottom_enable_' . $i, array(
        'default' => 0
      ));

      $wp_customize->add_control( 'x_slider_scroll_bottom_enable_' . $i, array(
        'type'     => 'checkbox',
        'label'    => __( 'Enable Scroll Bottom Anchor', '__x__' ),
        'section'  => 'x_customizer_section_sliders',
        'priority' => (20 * $i) + 8
      ));

      $wp_customize->add_setting( 'x_slider_scroll_bottom_alignment_' . $i, array(
        'default' => 'bottom center'
      ));

      $wp_customize->add_control( 'x_slider_scroll_bottom_alignment_' . $i, array(
        'type'     => 'select',
        'label'    => __( 'Scroll Bottom Anchor Alignment', '__x__' ),
        'section'  => 'x_customizer_section_sliders',
        'priority' => (20 * $i) + 9,
        'choices'  => array(
          'top left'      => __( 'Top, Left', '__x__' ),
          'top center'    => __( 'Top, Center', '__x__' ),
          'top right'     => __( 'Top, Right', '__x__' ),
          'bottom left'   => __( 'Bottom, Left', '__x__' ),
          'bottom center' => __( 'Bottom, Center', '__x__' ),
          'bottom right'  => __( 'Bottom, Right', '__x__' )
        )
      ));

      $wp_customize->add_setting( 'x_slider_scroll_bottom_color_' . $i, array(
        'default' => '#ffffff'
      ));

      $wp_customize->add_control(
        new WP_Customize_Color_Control( $wp_customize, 'x_slider_scroll_bottom_color_' . $i, array(
          'label'    => __( 'Scroll Bottom Anchor Color', '__x__' ),
          'section'  => 'x_customizer_section_sliders',
          'settings' => 'x_slider_scroll_bottom_color_' . $i,
          'priority' => (20 * $i) + 10
        ))
      );

      $wp_customize->add_setting( 'x_slider_scroll_bottom_color_hover_' . $i, array(
        'default' => '#ff2a13'
      ));

      $wp_customize->add_control(
        new WP_Customize_Color_Control( $wp_customize, 'x_slider_scroll_bottom_color_hover_' . $i, array(
          'label'    => __( 'Scroll Bottom Anchor Color Hover', '__x__' ),
          'section'  => 'x_customizer_section_sliders',
          'settings' => 'x_slider_scroll_bottom_color_hover_' . $i,
          'priority' => (20 * $i) + 11
        ))
      );

      $i++;

    }

  }


  //
  // WooCommerce.
  //

  if ( class_exists( 'WC_API' ) ) {

    $wp_customize->add_section( 'x_customizer_section_woocommerce', array(
      'title'    => __( 'WooCommerce', '__x__' ),
      'priority' => 12
    ));

    $wp_customize->add_setting( 'x_woocommerce_description_overview' );

    $wp_customize->add_control(
      new X_Customize_Description( $wp_customize, 'x_woocommerce_description_overview', array(
        'label'    => __( 'This section handles all options regarding your WooCommerce setup. Select your content layout, product columns, along with plenty of other options to get your shop up and running. The "Shop Layout" option allows you to keep your sidebar on your shop page if you have already selected "Content Left, Sidebar Right" or "Sidebar Left, Content Right" for you "Content Layout" option, or remove the sidebar completely if desired.', '__x__' ),
        'section'  => 'x_customizer_section_woocommerce',
        'settings' => 'x_woocommerce_description_overview',
        'priority' => 10
      ))
    );

    $wp_customize->add_setting( 'x_woocommerce_shop_layout_content', array(
      'default' => 'full-width'
    ));

    $wp_customize->add_control( 'x_woocommerce_shop_layout_content', array(
      'type'     => 'radio',
      'label'    => __( 'Shop Layout', '__x__' ),
      'section'  => 'x_customizer_section_woocommerce',
      'priority' => 20,
      'choices'  => array(
        'sidebar'    => __( 'Keep Sidebar', '__x__' ),
        'full-width' => __( 'Fullwidth', '__x__' )
      )
    ));

    $wp_customize->add_setting( 'x_woocommerce_shop_columns', array(
      'default' => '3'
    ));

    $wp_customize->add_control( 'x_woocommerce_shop_columns', array(
      'type'     => 'radio',
      'label'    => __( 'Shop Columns', '__x__' ),
      'section'  => 'x_customizer_section_woocommerce',
      'priority' => 30,
      'choices' => array(
        1 => __( 'One', '__x__' ),
        2 => __( 'Two', '__x__' ),
        3 => __( 'Three', '__x__' ),
        4 => __( 'Four', '__x__' )
      )
    ));

    $wp_customize->add_setting( 'x_woocommerce_shop_count', array(
      'default' => '12'
    ));

    $wp_customize->add_control( 'x_woocommerce_shop_count', array(
      'type'     => 'text',
      'label'    => __( 'Posts Per Page', '__x__' ),
      'section'  => 'x_customizer_section_woocommerce',
      'priority' => 40
    ));

    $wp_customize->add_setting( 'x_woocommerce_sub_title_product' );

    $wp_customize->add_control(
      new X_Customize_Sub_Title( $wp_customize, 'x_woocommerce_sub_title_product', array(
        'label'    => __( 'Single Product', '__x__' ),
        'section'  => 'x_customizer_section_woocommerce',
        'settings' => 'x_woocommerce_sub_title_product',
        'priority' => 50
      ))
    );

    $wp_customize->add_setting( 'x_woocommerce_description_single_product' );

    $wp_customize->add_control(
      new X_Customize_Description( $wp_customize, 'x_woocommerce_description_single_product', array(
        'label'    => __( 'All options available in this section pertain to the layout of your individual product pages. Simply enable or disable the sections you want to use to achieve the layout you want.', '__x__' ),
        'section'  => 'x_customizer_section_woocommerce',
        'settings' => 'x_woocommerce_description_single_product',
        'priority' => 60
      ))
    );

    $wp_customize->add_setting( 'x_woocommerce_product_tabs_enable', array(
      'default' => 1
    ));

    $wp_customize->add_control( 'x_woocommerce_product_tabs_enable', array(
      'type'     => 'checkbox',
      'label'    => __( 'Enable Product Tabs', '__x__' ),
      'section'  => 'x_customizer_section_woocommerce',
      'priority' => 70
    ));

    $wp_customize->add_setting( 'x_woocommerce_product_tab_description_enable', array(
      'default' => 1
    ));

    $wp_customize->add_control( 'x_woocommerce_product_tab_description_enable', array(
      'type'     => 'checkbox',
      'label'    => __( 'Enable Description Tab', '__x__' ),
      'section'  => 'x_customizer_section_woocommerce',
      'priority' => 80
    ));

    $wp_customize->add_setting( 'x_woocommerce_product_tab_additional_info_enable', array(
      'default' => 1
    ));

    $wp_customize->add_control( 'x_woocommerce_product_tab_additional_info_enable', array(
      'type'     => 'checkbox',
      'label'    => __( 'Enable Additional Information Tab', '__x__' ),
      'section'  => 'x_customizer_section_woocommerce',
      'priority' => 90
    ));

    $wp_customize->add_setting( 'x_woocommerce_product_tab_reviews_enable', array(
      'default' => 1
    ));

    $wp_customize->add_control( 'x_woocommerce_product_tab_reviews_enable', array(
      'type'     => 'checkbox',
      'label'    => __( 'Enable Reviews Tab', '__x__' ),
      'section'  => 'x_customizer_section_woocommerce',
      'priority' => 100
    ));

    $wp_customize->add_setting( 'x_woocommerce_product_related_enable', array(
      'default' => 1
    ));

    $wp_customize->add_control( 'x_woocommerce_product_related_enable', array(
      'type'     => 'checkbox',
      'label'    => __( 'Enable Related Products', '__x__' ),
      'section'  => 'x_customizer_section_woocommerce',
      'priority' => 110
    ));

    $wp_customize->add_setting( 'x_woocommerce_product_related_columns', array(
      'default' => '4'
    ));

    $wp_customize->add_control( 'x_woocommerce_product_related_columns', array(
      'type'     => 'radio',
      'label'    => __( 'Related Product Columns', '__x__' ),
      'section'  => 'x_customizer_section_woocommerce',
      'priority' => 120,
      'choices' => array(
        1 => __( 'One', '__x__' ),
        2 => __( 'Two', '__x__' ),
        3 => __( 'Three', '__x__' ),
        4 => __( 'Four', '__x__' )
      )
    ));

    $wp_customize->add_setting( 'x_woocommerce_product_related_count', array(
      'default' => '4'
    ));

    $wp_customize->add_control( 'x_woocommerce_product_related_count', array(
      'type'     => 'text',
      'label'    => __( 'Related Product Post Count', '__x__' ),
      'section'  => 'x_customizer_section_woocommerce',
      'priority' => 130
    ));

    $wp_customize->add_setting( 'x_woocommerce_product_upsells_enable', array(
      'default' => 1
    ));

    $wp_customize->add_control( 'x_woocommerce_product_upsells_enable', array(
      'type'     => 'checkbox',
      'label'    => __( 'Enable Upsells', '__x__' ),
      'section'  => 'x_customizer_section_woocommerce',
      'priority' => 140
    ));

    $wp_customize->add_setting( 'x_woocommerce_product_upsell_columns', array(
      'default' => '4'
    ));

    $wp_customize->add_control( 'x_woocommerce_product_upsell_columns', array(
      'type'     => 'radio',
      'label'    => __( 'Upsell Columns', '__x__' ),
      'section'  => 'x_customizer_section_woocommerce',
      'priority' => 150,
      'choices' => array(
        1 => __( 'One', '__x__' ),
        2 => __( 'Two', '__x__' ),
        3 => __( 'Three', '__x__' ),
        4 => __( 'Four', '__x__' )
      )
    ));

    $wp_customize->add_setting( 'x_woocommerce_product_upsell_count', array(
      'default' => '4'
    ));

    $wp_customize->add_control( 'x_woocommerce_product_upsell_count', array(
      'type'     => 'text',
      'label'    => __( 'Upsell Post Count', '__x__' ),
      'section'  => 'x_customizer_section_woocommerce',
      'priority' => 160
    ));

    $wp_customize->add_setting( 'x_woocommerce_sub_title_cart' );

    $wp_customize->add_control(
      new X_Customize_Sub_Title( $wp_customize, 'x_woocommerce_sub_title_cart', array(
        'label'    => __( 'Cart', '__x__' ),
        'section'  => 'x_customizer_section_woocommerce',
        'settings' => 'x_woocommerce_sub_title_cart',
        'priority' => 170
      ))
    );

    $wp_customize->add_setting( 'x_woocommerce_description_cart' );

    $wp_customize->add_control(
      new X_Customize_Description( $wp_customize, 'x_woocommerce_description_cart', array(
        'label'    => __( 'All options available in this section pertain to the layout of your cart page. Simply enable or disable the sections you want to use to achieve the layout you want.', '__x__' ),
        'section'  => 'x_customizer_section_woocommerce',
        'settings' => 'x_woocommerce_description_cart',
        'priority' => 180
      ))
    );

    $wp_customize->add_setting( 'x_woocommerce_cart_cross_sells_enable', array(
      'default' => 1
    ));

    $wp_customize->add_control( 'x_woocommerce_cart_cross_sells_enable', array(
      'type'     => 'checkbox',
      'label'    => __( 'Enable Cross Sells', '__x__' ),
      'section'  => 'x_customizer_section_woocommerce',
      'priority' => 190
    ));

    $wp_customize->add_setting( 'x_woocommerce_cart_cross_sells_columns', array(
      'default' => '4'
    ));

    $wp_customize->add_control( 'x_woocommerce_cart_cross_sells_columns', array(
      'type'     => 'radio',
      'label'    => __( 'Cross Sell Columns', '__x__' ),
      'section'  => 'x_customizer_section_woocommerce',
      'priority' => 200,
      'choices' => array(
        1 => __( 'One', '__x__' ),
        2 => __( 'Two', '__x__' ),
        3 => __( 'Three', '__x__' ),
        4 => __( 'Four', '__x__' )
      )
    ));

    $wp_customize->add_setting( 'x_woocommerce_cart_cross_sells_count', array(
      'default' => '4'
    ));

    $wp_customize->add_control( 'x_woocommerce_cart_cross_sells_count', array(
      'type'     => 'text',
      'label'    => __( 'Cross Sell Post Count', '__x__' ),
      'section'  => 'x_customizer_section_woocommerce',
      'priority' => 210
    ));

    $wp_customize->add_setting( 'x_woocommerce_sub_title_widgets' );

    $wp_customize->add_control(
      new X_Customize_Sub_Title( $wp_customize, 'x_woocommerce_sub_title_widgets', array(
        'label'    => __( 'Widgets', '__x__' ),
        'section'  => 'x_customizer_section_woocommerce',
        'settings' => 'x_woocommerce_sub_title_widgets',
        'priority' => 220
      ))
    );

    $wp_customize->add_setting( 'x_woocommerce_description_widgets' );

    $wp_customize->add_control(
      new X_Customize_Description( $wp_customize, 'x_woocommerce_description_widgets', array(
        'label'    => __( 'Select the placement of your product images in the various WooCommerce widgets that provide them. Right alignment is better if your items have longer titles to avoid staggered word wrapping.', '__x__' ),
        'section'  => 'x_customizer_section_woocommerce',
        'settings' => 'x_woocommerce_description_widgets',
        'priority' => 230
      ))
    );

    $wp_customize->add_setting( 'x_woocommerce_widgets_image_alignment', array(
      'default' => 'left'
    ));

    $wp_customize->add_control( 'x_woocommerce_widgets_image_alignment', array(
      'type'     => 'radio',
      'label'    => __( 'Image Alignment', '__x__' ),
      'section'  => 'x_customizer_section_woocommerce',
      'priority' => 240,
      'choices' => array(
        'left'  => __( 'Left', '__x__' ),
        'right' => __( 'Right', '__x__' )
      )
    ));

  }


  //
  // Social.
  //

  $wp_customize->add_section( 'x_customizer_section_social', array(
    'title'    => __( 'Social', '__x__' ),
    'priority' => 13
  ));

  $wp_customize->add_setting( 'x_social_description_overview' );

  $wp_customize->add_control(
    new X_Customize_Description( $wp_customize, 'x_social_description_overview', array(
      'label'    => __( 'Set the URLs for your social media profiles here to be used in the topbar and bottom footer. Adding in a link will make its respective icon show up without needing to do anything else. Keep in mind that these sections are not necessarily intended for a lot of items, so adding all icons could create some layout issues. It is typically best to keep your selections here to a minimum for structural purposes and for usability purposes so you do not overwhelm your visitors.', '__x__' ),
      'section'  => 'x_customizer_section_social',
      'settings' => 'x_social_description_overview',
      'priority' => 10
    ))
  );

  $wp_customize->add_setting( 'x_social_facebook', array(
    'default' => ''
  ));

  $wp_customize->add_control( 'x_social_facebook', array(
    'type'     => 'text',
    'label'    => __( 'Facebook Profile URL', '__x__' ),
    'section'  => 'x_customizer_section_social',
    'priority' => 20
  ));

  $wp_customize->add_setting( 'x_social_twitter', array(
    'default' => ''
  ));

  $wp_customize->add_control( 'x_social_twitter', array(
    'type'     => 'text',
    'label'    => __( 'Twitter Profile URL', '__x__' ),
    'section'  => 'x_customizer_section_social',
    'priority' => 30
  ));

  $wp_customize->add_setting( 'x_social_googleplus', array(
    'default' => ''
  ));

  $wp_customize->add_control( 'x_social_googleplus', array(
    'type'     => 'text',
    'label'    => __( 'Google+ Profile URL', '__x__' ),
    'section'  => 'x_customizer_section_social',
    'priority' => 40
  ));

  $wp_customize->add_setting( 'x_social_linkedin', array(
    'default' => ''
  ));

  $wp_customize->add_control( 'x_social_linkedin', array(
    'type'     => 'text',
    'label'    => __( 'LinkedIn Profile URL', '__x__' ),
    'section'  => 'x_customizer_section_social',
    'priority' => 50
  ));

  $wp_customize->add_setting( 'x_social_foursquare', array(
    'default' => ''
  ));

  $wp_customize->add_control( 'x_social_foursquare', array(
    'type'     => 'text',
    'label'    => __( 'Foursquare Profile URL', '__x__' ),
    'section'  => 'x_customizer_section_social',
    'priority' => 60
  ));

  $wp_customize->add_setting( 'x_social_youtube', array(
    'default' => ''
  ));

  $wp_customize->add_control( 'x_social_youtube', array(
    'type'     => 'text',
    'label'    => __( 'YouTube Profile URL', '__x__' ),
    'section'  => 'x_customizer_section_social',
    'priority' => 70
  ));

  $wp_customize->add_setting( 'x_social_vimeo', array(
    'default' => ''
  ));

  $wp_customize->add_control( 'x_social_vimeo', array(
    'type'     => 'text',
    'label'    => __( 'Vimeo Profile URL', '__x__' ),
    'section'  => 'x_customizer_section_social',
    'priority' => 80
  ));

  $wp_customize->add_setting( 'x_social_instagram', array(
    'default' => ''
  ));

  $wp_customize->add_control( 'x_social_instagram', array(
    'type'     => 'text',
    'label'    => __( 'Instagram Profile URL', '__x__' ),
    'section'  => 'x_customizer_section_social',
    'priority' => 90
  ));

  $wp_customize->add_setting( 'x_social_pinterest', array(
    'default' => ''
  ));

  $wp_customize->add_control( 'x_social_pinterest', array(
    'type'     => 'text',
    'label'    => __( 'Pinterest Profile URL', '__x__' ),
    'section'  => 'x_customizer_section_social',
    'priority' => 100
  ));

  $wp_customize->add_setting( 'x_social_dribbble', array(
    'default' => ''
  ));

  $wp_customize->add_control( 'x_social_dribbble', array(
    'type'     => 'text',
    'label'    => __( 'Dribbble Profile URL', '__x__' ),
    'section'  => 'x_customizer_section_social',
    'priority' => 110
  ));

  $wp_customize->add_setting( 'x_social_behance', array(
    'default' => ''
  ));

  $wp_customize->add_control( 'x_social_behance', array(
    'type'     => 'text',
    'label'    => __( 'Behance Profile URL', '__x__' ),
    'section'  => 'x_customizer_section_social',
    'priority' => 120
  ));

  $wp_customize->add_setting( 'x_social_rss', array(
    'default' => ''
  ));

  $wp_customize->add_control( 'x_social_rss', array(
    'type'     => 'text',
    'label'    => __( 'RSS Feed URL', '__x__' ),
    'section'  => 'x_customizer_section_social',
    'priority' => 130
  ));


  //
  // Site icons.
  //

  $wp_customize->add_section( 'x_customizer_section_icons', array(
    'title'    => __( 'Site Icons', '__x__' ),
    'priority' => 14
  ));

  $wp_customize->add_setting( 'x_icons_description_overview' );

  $wp_customize->add_control(
    new X_Customize_Description( $wp_customize, 'x_icons_description_overview', array(
      'label'    => __( 'Easily manage your favicon for desktop, touch icon for mobile devices, and tile icon for the Windows 8 Metro interface in this section. If an image is not set, nothing will be output for that particular icon type. When setting the path to your favicon, make sure you are using the ".ico" format. A 152x152 PNG should be used for your touch icon, and a 144x144 PNG should be used for your tile icon. The color you set for your tile icon will be used behind your image.', '__x__' ),
      'section'  => 'x_customizer_section_icons',
      'settings' => 'x_icons_description_overview',
      'priority' => 10
    ))
  );

  $wp_customize->add_setting( 'x_icon_favicon', array(
    'default' => ''
  ));

  $wp_customize->add_control( 'x_icon_favicon', array(
    'type'     => 'text',
    'label'    => __( 'Favicon (Set Path to Image Below)', '__x__' ),
    'section'  => 'x_customizer_section_icons',
    'priority' => 20
  ));

  $wp_customize->add_setting( 'x_icon_touch' );

  $wp_customize->add_control(
    new WP_Customize_Image_Control( $wp_customize, 'x_icon_touch', array(
      'label'    => __( 'Touch Icon (iOS and Android)', '__x__' ),
      'section'  => 'x_customizer_section_icons',
      'settings' => 'x_icon_touch',
      'priority' => 30
    ))
  );

  $wp_customize->add_setting( 'x_icon_tile' );

  $wp_customize->add_control(
    new WP_Customize_Image_Control( $wp_customize, 'x_icon_tile', array(
      'label'    => __( 'Tile Icon (Microsoft)', '__x__' ),
      'section'  => 'x_customizer_section_icons',
      'settings' => 'x_icon_tile',
      'priority' => 40
    ))
  );

  $wp_customize->add_setting( 'x_icon_tile_bg_color', array(
    'default' => '#ffffff'
  ));

  $wp_customize->add_control(
    new WP_Customize_Color_Control( $wp_customize, 'x_icon_tile_bg_color', array(
      'label'    => __( 'Tile Icon Background Color', '__x__' ),
      'section'  => 'x_customizer_section_icons',
      'settings' => 'x_icon_tile_bg_color',
      'priority' => 50
    ))
  );


  //
  // Custom styles and scripts.
  //

  $wp_customize->add_section( 'x_customizer_section_custom_styles_and_scripts', array(
    'title'    => __( 'Custom', '__x__' ),
    'priority' => 15
  ));

  $wp_customize->add_setting( 'x_custom_styles_and_scripts_description_overview' );

  $wp_customize->add_control(
    new X_Customize_Description( $wp_customize, 'x_custom_styles_and_scripts_description_overview', array(
      'label'    => __( 'Quickly add custom CSS or JavaScript without having to use any complicated setups. Ideal for minor style alterations or small snippets like Google Analytics.', '__x__' ),
      'section'  => 'x_customizer_section_custom_styles_and_scripts',
      'settings' => 'x_custom_styles_and_scripts_description_overview',
      'priority' => 10
    ))
  );

  $wp_customize->add_setting( 'x_custom_styles', array(
    'default' => ''
  ));

  $wp_customize->add_control(
    new X_Customize_Control_Textarea( $wp_customize, 'x_custom_styles', array(
      'label'    => __( 'CSS', '__x__' ),
      'section'  => 'x_customizer_section_custom_styles_and_scripts',
      'settings' => 'x_custom_styles',
      'priority' => 20
    ))
  );

  $wp_customize->add_setting( 'x_custom_scripts', array(
    'default' => ''
  ));

  $wp_customize->add_control(
    new X_Customize_Control_Textarea( $wp_customize, 'x_custom_scripts', array(
      'label'    => __( 'JavaScript', '__x__' ),
      'section'  => 'x_customizer_section_custom_styles_and_scripts',
      'settings' => 'x_custom_scripts',
      'priority' => 30
    ))
  );

}

add_action( 'customize_register', 'x_register_customizer_options' );