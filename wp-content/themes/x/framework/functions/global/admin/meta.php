<?php

// =============================================================================
// FUNCTIONS/GLOBAL/ADMIN/META.PHP
// -----------------------------------------------------------------------------
// Sets up and includes the meta boxes for WordPress Custom Post Formats.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Setup Entry Meta
//   02. Add Entry Meta
//   03. Create Entry Meta
//   04. Save Entry Meta
//   05. Add Taxonomy Meta
//   06. Edit Taxonomy Meta
//   07. Save Taxonomy Meta
//   08. Taxonomy Actions
// =============================================================================

// Setup Entry Meta
// =============================================================================
 
function x_metabox_posts() {

  //
  // Quote
  //

  $meta_box = array(
    'id'          => 'x-meta-box-quote',
    'title'       => __( 'Quote Settings', '__x__' ),
    'description' => __( 'Input your quote.', '__x__' ),
    'page'        => 'post',
    'context'     => 'normal',
    'priority'    => 'high',
    'fields'      => array(
      array(
        'name' => __( 'The Quote', '__x__' ),
        'desc' => __( 'Input your quote.', '__x__' ),
        'id'   => '_x_quote_quote',
        'type' => 'textarea',
        'std'  => ''
      ),
      array(
        'name' => __( 'Citation', '__x__' ),
        'desc' => __( 'Specify who originally said the quote.', '__x__' ),
        'id'   => '_x_quote_cite',
        'type' => 'text',
        'std'  => ''
      )
    )
  );

  x_add_meta_box( $meta_box );


  //
  // Link
  //

  $meta_box = array(
    'id'          => 'x-meta-box-link',
    'title'       => __( 'Link Settings', '__x__' ),
    'description' => __( 'Input your link.', '__x__' ),
    'page'        => 'post',
    'context'     => 'normal',
    'priority'    => 'high',
    'fields'      => array(
      array(
        'name' => __( 'The Link', '__x__' ),
        'desc' => __( 'Insert your link URL, e.g. http://www.themeforest.net.', '__x__' ),
        'id'   => '_x_link_url',
        'type' => 'text',
        'std'  => ''
      )
    )
  );

  x_add_meta_box( $meta_box );


  //
  // Video
  //

  $meta_box = array(
    'id'          => 'x-meta-box-video',
    'title'       => __( 'Video Settings', '__x__' ),
    'description' => __( 'These settings enable you to embed videos into your posts.', '__x__' ),
    'page'        => 'post',
    'context'     => 'normal',
    'priority'    => 'high',
    'fields'      => array(
      array(
        'name'    => __( 'Aspect Ratio', '__x__' ),
        'desc'    => __( 'Select the aspect ratio for your video.', '__x__' ),
        'id'      => '_x_video_aspect_ratio',
        'type'    => 'select',
        'std'     => '',
        'options' => array( '16:9', '5:3', '5:4', '4:3', '3:2' )
      ),
      array(
        'name' => __( 'M4V File URL', '__x__' ),
        'desc' => __( 'The URL to the .m4v video file.', '__x__' ),
        'id'   => '_x_video_m4v',
        'type' => 'text',
        'std'  => ''
      ),
      array(
        'name' => __( 'OGV File URL', '__x__' ),
        'desc' => __( 'The URL to the .ogv video file.', '__x__' ),
        'id'   => '_x_video_ogv',
        'type' => 'text',
        'std'  => ''
      ),
      array(
        'name' => __( 'Embedded Video Code', '__x__' ),
        'desc' => __( 'If you are using something other than self hosted video such as YouTube, Vimeo, or Wistia, paste the embed code here. This field will override the above.', '__x__' ),
        'id'   => '_x_video_embed',
        'type' => 'textarea',
        'std'  => ''
      )
    )
  );

  x_add_meta_box( $meta_box );


  //
  // Audio
  //

  $meta_box = array(
    'id'          => 'x-meta-box-audio',
    'title'       => __( 'Audio Settings', '__x__' ),
    'description' => __( 'These settings enable you to embed audio into your posts. You must provide both .mp3 and .agg/.oga file formats in order for self hosted audio to function accross all browsers.', '__x__' ),
    'page'        => 'post',
    'context'     => 'normal',
    'priority'    => 'high',
    'fields'      => array(
      array(
        'name' => __( 'MP3 File URL', '__x__' ),
        'desc' => __( 'The URL to the .mp3 audio file.', '__x__' ),
        'id'   => '_x_audio_mp3',
        'type' => 'text',
        'std'  => ''
      ),
      array(
        'name' => __( 'OGA File URL', '__x__' ),
        'desc' => __( 'The URL to the .oga or .ogg audio file.', '__x__' ),
        'id'   => '_x_audio_ogg',
        'type' => 'text',
        'std'  => ''
      ),
      array(
        'name' => __( 'Embedded Audio Code', '__x__' ),
        'desc' => __( 'If you are using something other than self hosted audio such as Soundcloud paste the embed code here. This field will override the above.', '__x__' ),
        'id'   => '_x_audio_embed',
        'type' => 'textarea',
        'std'  => ''
      )
    )
  );

  x_add_meta_box( $meta_box );


  //
  // Posts
  //

  $meta_box = array(
    'id'          => 'x-meta-box-post',
    'title'       => __( 'Post Settings', '__x__' ),
    'description' => __( 'Here you will find various options you can use to create different page styles.', '__x__' ),
    'page'        => 'post',
    'context'     => 'normal',
    'priority'    => 'high',
    'fields'      => array(
      array(
        'name' => __( 'Body CSS Class(es)', '__x__' ),
        'desc' => __( 'Add a custom CSS class to the &lt;body&gt; element. Separate multiple class names with a space.', '__x__' ),
        'id'   => '_x_entry_body_css_class',
        'type' => 'text',
        'std'  => ''
      ),
      array(
        'name'    => __( 'Fullwidth Post Layout', '__x__' ),
        'desc'    => __( 'If your global content layout includes a sidebar, selecting this option will remove the sidebar for this post.', '__x__' ),
        'id'      => '_x_post_layout',
        'type'    => 'checkbox',
        'std'     => ''
      ),
      array(
        'name' => __( 'Background Image(s)', '__x__' ),
        'desc' => __( 'Click the button to upload your background image(s), or enter them in manually using the text field above. Loading multiple background images will create a slideshow effect. To clear, delete the image URLs from the text field and save your page.', '__x__' ),
        'id'   => '_x_entry_bg_image_full',
        'type' => 'uploader',
        'std'  => ''
      ),
      array(
        'name' => __( 'Background Image(s) Fade', '__x__' ),
        'desc' => __( 'Set a time in milliseconds for your image(s) to fade in. To disable this feature, set the value to "0."', '__x__' ),
        'id'   => '_x_entry_bg_image_full_fade',
        'type' => 'text',
        'std'  => '750'
      ),
      array(
        'name' => __( 'Background Images Duration', '__x__' ),
        'desc' => __( 'Only applicable if multiple images are selected, creating a background image slider. Set a time in milliseconds for your images to remain on screen.', '__x__' ),
        'id'   => '_x_entry_bg_image_full_duration',
        'type' => 'text',
        'std'  => '7500'
      )
    )
  );

  x_add_meta_box( $meta_box );


  //
  // Portfolio
  //

  $meta_box = array(
    'id'          => 'x-meta-box-portfolio',
    'title'       => __( 'Portfolio Settings', '__x__' ),
    'description' => __( 'Select the appropriate options for your portfolio output.', '__x__' ),
    'page'        => 'x-portfolio',
    'context'     => 'normal',
    'priority'    => 'high',
    'fields'      => array(
      array(
        'name' => __( 'Body CSS Class(es)', '__x__' ),
        'desc' => __( 'Add a custom CSS class to the &lt;body&gt; element. Separate multiple class names with a space.', '__x__' ),
        'id'   => '_x_entry_body_css_class',
        'type' => 'text',
        'std'  => ''
      ),
      array(
        'name'    => __( 'Media Type', '__x__' ),
        'desc'    => __( 'Select which kind of media you want to display for your portfolio. If selecting a "Gallery," simply upload your images to this post and organize them in the order you want them to display.', '__x__' ),
        'id'      => '_x_portfolio_media',
        'type'    => 'radio',
        'std'     => 'Image',
        'options' => array( 'Image', 'Gallery', 'Video' )
      ),
      array(
        'name'    => __( 'Featured Content', '__x__' ),
        'desc'    => __( 'Select "Media" if you would like to show your video or gallery on the index page in place of the featured image.', '__x__' ),
        'id'      => '_x_portfolio_index_media',
        'type'    => 'radio',
        'std'     => 'Thumbnail',
        'options' => array( 'Thumbnail', 'Media' )
      ),
      array(
        'name'    => __( 'Video Aspect Ratio', '__x__' ),
        'desc'    => __( 'If selecting "Video," choose the aspect ratio you would like for your video.', '__x__' ),
        'id'      => '_x_portfolio_aspect_ratio',
        'type'    => 'select',
        'std'     => '16:9',
        'options' => array( '16:9', '5:3', '5:4', '4:3', '3:2' )
      ),
      array(
        'name' => __( 'M4V File URL', '__x__' ),
        'desc' => __( 'If selecting "Video," place the URL to your .m4v video file here.', '__x__' ),
        'id'   => '_x_portfolio_m4v',
        'type' => 'text',
        'std'  => ''
      ),
      array(
        'name' => __( 'OGV File URL', '__x__' ),
        'desc' => __( 'If selecting "Video," place the URL to your .ogv video file here.', '__x__' ),
        'id'   => '_x_portfolio_ogv',
        'type' => 'text',
        'std'  => ''
      ),
      array(
        'name' => __( 'Embedded Video Code', '__x__' ),
        'desc' => __( 'If you are using something other than self hosted video such as YouTube, Vimeo, or Wistia, paste the embed code here. This field will override the above.', '__x__' ),
        'id'   => '_x_portfolio_embed',
        'type' => 'textarea',
        'std'  => ''
      ),
      array(
        'name' => __( 'Project Link', '__x__' ),
        'desc' => __( 'Provide an external link to the project you worked on if one is available.', '__x__' ),
        'id'   => '_x_portfolio_project_link',
        'type' => 'text',
        'std'  => ''
      ),
      array(
        'name' => __( 'Background Image(s)', '__x__' ),
        'desc' => __( 'Click the button to upload your background image(s), or enter them in manually using the text field above. Loading multiple background images will create a slideshow effect. To clear, delete the image URLs from the text field and save your page.', '__x__' ),
        'id'   => '_x_entry_bg_image_full',
        'type' => 'uploader',
        'std'  => ''
      ),
      array(
        'name' => __( 'Background Image(s) Fade', '__x__' ),
        'desc' => __( 'Set a time in milliseconds for your image(s) to fade in. To disable this feature, set the value to "0."', '__x__' ),
        'id'   => '_x_entry_bg_image_full_fade',
        'type' => 'text',
        'std'  => '750'
      ),
      array(
        'name' => __( 'Background Images Duration', '__x__' ),
        'desc' => __( 'Only applicable if multiple images are selected, creating a background image slider. Set a time in milliseconds for your images to remain on screen.', '__x__' ),
        'id'   => '_x_entry_bg_image_full_duration',
        'type' => 'text',
        'std'  => '7500'
      )
    )
  );

  x_add_meta_box( $meta_box );


  //
  // Page
  //

  $meta_box = array(
    'id'          => 'x-meta-box-page',
    'title'       => __( 'Page Settings', '__x__' ),
    'description' => __( 'Here you will find various options you can use to create different page layouts and styles.', '__x__' ),
    'page'        => 'page',
    'context'     => 'normal',
    'priority'    => 'high',
    'fields'      => array(
      array(
        'name' => __( 'Body CSS Class(es)', '__x__' ),
        'desc' => __( 'Add a custom CSS class to the &lt;body&gt; element. Separate multiple class names with a space.', '__x__' ),
        'id'   => '_x_entry_body_css_class',
        'type' => 'text',
        'std'  => ''
      ),
      array(
        'name'    => __( 'Disable Page Title', '__x__' ),
        'desc'    => __( 'Select to disable the page title. Disabling the page title provides greater stylistic flexibility.', '__x__' ),
        'id'      => '_x_entry_disable_page_title',
        'type'    => 'checkbox',
        'std'     => ''
      ),
      array(
        'name' => __( 'One Page Navigation', '__x__' ),
        'desc' => __( 'To activate your one page navigation, select a menu from the dropdown. To deactivate one page navigation, set the dropdown back to "Deactivated."', '__x__' ),
        'id'   => '_x_page_one_page_navigation',
        'type' => 'menus',
        'std'  => 'Deactivated'
      ),
      array(
        'name' => __( 'Background Image(s)', '__x__' ),
        'desc' => __( 'Click the button to upload your background image(s), or enter them in manually using the text field above. Loading multiple background images will create a slideshow effect. To clear, delete the image URLs from the text field and save your page.', '__x__' ),
        'id'   => '_x_entry_bg_image_full',
        'type' => 'uploader',
        'std'  => ''
      ),
      array(
        'name' => __( 'Background Image(s) Fade', '__x__' ),
        'desc' => __( 'Set a time in milliseconds for your image(s) to fade in. To disable this feature, set the value to "0."', '__x__' ),
        'id'   => '_x_entry_bg_image_full_fade',
        'type' => 'text',
        'std'  => '750'
      ),
      array(
        'name' => __( 'Background Images Duration', '__x__' ),
        'desc' => __( 'Only applicable if multiple images are selected, creating a background image slider. Set a time in milliseconds for your images to remain on screen.', '__x__' ),
        'id'   => '_x_entry_bg_image_full_duration',
        'type' => 'text',
        'std'  => '7500'
      )
    )
  );

  x_add_meta_box( $meta_box );


  if ( x_get_stack() == 'icon' ) :

    //
    // Icon Page
    //

    $meta_box = array(
      'id'          => 'x-meta-box-page-icon',
      'title'       => __( 'Icon Page Settings', '__x__' ),
      'description' => __( 'Here you will find some options specific to Icon that you can use to create different page layouts.', '__x__' ),
      'page'        => 'page',
      'context'     => 'normal',
      'priority'    => 'high',
      'fields'      => array(
        array(
          'name'    => __( 'Blank Template Sidebar', '__x__' ),
          'desc'    => __( 'Because of Icon\'s unique layout, there may be times where you wish to show a sidebar on your blank templates. If that is the case, select "Yes" to activate your sidebar.', '__x__' ),
          'id'      => '_x_icon_blank_template_sidebar',
          'type'    => 'radio',
          'std'     => 'No',
          'options' => array( 'No', 'Yes' )
        )
      )
    );

    x_add_meta_box( $meta_box );

  endif;

}

add_action( 'add_meta_boxes', 'x_metabox_posts' );



// Add Entry Meta
// =============================================================================

function x_add_meta_box( $meta_box ) {

  if ( ! is_array( $meta_box ) )
    return false;
    
  // Create a callback function
  $callback = create_function( '$post,$meta_box', 'x_create_meta_box( $post, $meta_box["args"] );' );

  add_meta_box( $meta_box['id'], $meta_box['title'], $callback, $meta_box['page'], $meta_box['context'], $meta_box['priority'], $meta_box );

}



// Create Entry Meta
// =============================================================================

function x_create_meta_box( $post, $meta_box ) {
  
  if ( ! is_array( $meta_box ) )
    return false;
    
  if ( isset( $meta_box['description'] ) && $meta_box['description'] != '' )
    echo '<p>' . $meta_box['description'] . '</p>';
    
  wp_nonce_field( basename(__FILE__), 'x_meta_box_nonce' );

  echo '<table class="form-table x-form-table">';
 
  foreach( $meta_box['fields'] as $field ) {

    $meta = get_post_meta( $post->ID, $field['id'], true );

    echo '<tr><th><label for="' . $field['id'] . '"><strong>' . $field['name'] . '</strong>
        <span>' . $field['desc'] . '</span></label></th>';
    
    switch( $field['type'] ) {  
      case 'text':
        echo '<td><input type="text" name="x_meta[' . $field['id'] . ']" id="' . $field['id'] . '" value="' . ( $meta ? $meta : $field['std'] ) . '" size="30" /></td>';
        break;  
        
      case 'textarea':
        echo '<td><textarea name="x_meta[' . $field['id'] . ']" id="' . $field['id'] . '" rows="8" cols="5">' . ( $meta ? $meta : $field['std'] ) . '</textarea></td>';
        break;
        
      case 'file':
        echo '<td><input type="text" name="x_meta[' . $field['id'] . ']" id="' . $field['id'] . '" value="' . ( $meta ? $meta : $field['std'] ) . '" size="30" class="file" /> <input type="button" class="button" name="'. $field['id'] .'_button" id="'. $field['id'] .'_button" value="Browse" /></td>';
        break;

      case 'images':
        echo '<td><input type="button" class="button" name="' . $field['id'] . '" id="x_images_upload" value="' . $field['std'] .'" /></td>';
        break;

      case 'uploader':
        global $post;
        $output = '';
        if ( $meta != '' ) {
          $thumb = explode( ',', $meta );
          foreach ( $thumb as $thumb_image ) {
            $output .= '<div class="x-uploader-image"><img src="' . $thumb_image . '" alt="" /></div>';
          }
        }
        echo '<td>'
             . '<input type="text" name="x_meta[' . $field['id'] . ']" id="' . $field['id'] . '" value="' . ( $meta ? $meta : $field['std'] ) . '" class="file" />'
             . '<input data-id="' . get_the_ID() . '"  type="button" class="button" name="' . $field['id'] . '_button" id="' . $field['id'] . '_upload" value="Select Background Image(s)" />'
             // . '<input data-id="' . get_the_ID() . '"  type="button" class="button" name="' . $field['id'] . '_button_clear" id="' . $field['id'] . '_clear" value="Clear Images" />'
             . '<div class="x-meta-box-img-thumb-wrap">' . $output . '</div>'
           . '</td>';
        ?>

        <script> 
          jQuery(document).ready(function($) {

            // image uploader
            var x_uploader;
            var wp_media_post_id = wp.media.model.settings.post.id;

            $('#<?php echo $field["id"] ?>_upload').on('click', function(event) {
              event.preventDefault();

              var x_button   = $(this);
              set_to_post_id = x_button.data('id')
              var target     = x_button.prev();
              
              // if media frame exists, reopen
              if(x_uploader) {
                // set post id
                x_uploader.uploader.uploader.param('post_id', set_to_post_id);
                x_uploader.open();
                return;
              } else {
                // set the wp.media post id so the uploader grabs the id we want when initialised
                wp.media.model.settings.post.id = set_to_post_id;
              }

              // create media frame
              x_uploader = wp.media.frames.x_uploader = wp.media({
                title: x_button.data('title'),
                button: { text: x_button.data('text') },
                multiple: true
              });

              // when image selected, run callback
              x_uploader.on('select', function(){
                var selection = x_uploader.state().get('selection');
                var files     = [];
                selection.map( function( attachment ) {
                  attachment = attachment.toJSON();
                  files.push(attachment.url);
                  x_button.prev().val(files);
                });

                x_button.next().html('');

                for (var i=0; i<files.length; i++){
                  var ext = files[i].substr(files[i].lastIndexOf(".") + 1, files[i].length);
                  x_button.next().append('<div class="row-image"><img src="' + files[i] + '" alt="" /></div>');
                }
            
                // restore main post id
                wp.media.model.settings.post.id = wp_media_post_id;
              });

              // open our awesome media frame
              x_uploader.open();
            });

            // restore main id when media button is pressed
            jQuery('a.add_media').on('click', function() {
              wp.media.model.settings.post.id = wp_media_post_id;
            });

            // $('#<?php echo $field["id"] ?>_clear').on('click', function(event) {
            //   var x_button = $(this);
            //   x_button.css('display', 'none');
            //   x_button.parent('td').find('input[name="x_meta[<?php echo $field['id']; ?>]"]').val('');
            //   x_button.siblings('.x-meta-box-img-thumb-wrap').html('');
            // });
          });  
        </script>

        <?php
        break;
        
      case 'select':
        echo'<td><select name="x_meta[' . $field['id'] . ']" id="' . $field['id'] . '">';
        foreach( $field['options'] as $option ) {
          echo'<option';
          if ( $meta ) { 
            if ( $meta == $option ) echo ' selected="selected"'; 
          } else {
            if ( $field['std'] == $option ) echo ' selected="selected"'; 
          }
          echo'>' . $option . '</option>';
        }
        echo '</select></td>';
        break;

      case 'menus':
        $menus = get_terms( 'nav_menu', array( 'hide_empty' => true ) );
        echo '<td><select name="x_meta[' . $field['id'] . ']" id="' . $field['id'] . '">';
        echo '<option>Deactivated</option>';
        foreach ( $menus as $menu ) {
          echo'<option';
          if ( $meta ) { 
            if ( $meta == $menu->name ) echo ' selected="selected"'; 
          } else {
            if ( $field['std'] == $menu->name ) echo ' selected="selected"'; 
          }
          echo'>' . $menu->name . '</option>';
        }
        echo '</select></td>';
        break;
        
      case 'radio':
        echo '<td>';
        foreach( $field['options'] as $option ) {
          echo '<label class="radio-label"><input type="radio" name="x_meta[' . $field['id'] . ']" value="' . $option . '" class="radio"';
          if ( $meta ) {
            if ( $meta == $option ) echo ' checked="yes"'; 
          } else {
            if ( $field['std'] == $option ) echo ' checked="yes"';
          }
          echo ' /> ' . $option . '</label> ';
        }
        echo '</td>';
        break;
        
      case 'checkbox':
        echo '<td>';
        $val = '';
        if ( $meta ) {
          if ( $meta == 'on' )
            $val = ' checked="yes"';
        } else {
          if( $field['std'] == 'on' )
            $val = ' checked="yes"';
        }
        echo '<input type="hidden" name="x_meta[' . $field['id'] . ']" value="off" />
              <input type="checkbox" id="' . $field['id'] . '" name="x_meta[' . $field['id'] . ']" value="on"' . $val . ' /> ';
        echo '</td>';
        break;

    }
    echo '</tr>';
  }
  echo '</table>';
}



// Save Entry Meta
// =============================================================================

function x_save_meta_box( $post_id ) {

  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
    return;
  
  if ( ! isset( $_POST['x_meta'] ) || ! isset( $_POST['x_meta_box_nonce'] ) || ! wp_verify_nonce( $_POST['x_meta_box_nonce'], basename( __FILE__ ) ) )
    return;
  
  if ( 'page' == $_POST['post_type'] ) {
    if ( ! current_user_can( 'edit_page', $post_id ) ) return;
  } else {
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;
  }
 
  foreach( $_POST['x_meta'] as $key=>$val ){
    update_post_meta( $post_id, $key, stripslashes( htmlspecialchars( $val ) ) );
  }

}

add_action( 'save_post', 'x_save_meta_box' );



// Add Taxonomy Meta
// =============================================================================

function x_taxonomy_add_new_meta_field() {
  ?>
  <div class="form-field">
    <label for="term_meta[archive-title]"><?php _e( 'Archive Title', '__x__' ); ?></label>
    <input type="text" name="term_meta[archive-title]" id="term_meta[archive-title]" value="">
    <p class="description"><?php _e( 'Enter in a value to overwrite the default title of the archive page.', '__x__' ); ?></p>
  </div>
  <div class="form-field">
    <label for="term_meta[archive-subtitle]"><?php _e( 'Archive Subtitle', '__x__' ); ?></label>
    <input type="text" name="term_meta[archive-subtitle]" id="term_meta[archive-subtitle]" value="">
    <p class="description"><?php _e( 'Enter in a value to overwrite the default subtitle of the archive page. Note that not all Stacks display the subtitle on their archive pages.', '__x__' ); ?></p>
  </div>
  <?php
}



// Edit Taxonomy Meta
// =============================================================================

function x_taxonomy_edit_meta_field( $term ) {

  $t_id      = $term->term_id;
  $term_meta = get_option( 'taxonomy_' . $t_id );

  ?>
  <tr class="form-field">
    <th scope="row" valign="top"><label for="term_meta[archive-title]"><?php _e( 'Archive Title', '__x__' ); ?></label></th>
    <td>
      <input type="text" name="term_meta[archive-title]" id="term_meta[archive-title]" value="<?php echo esc_attr( $term_meta['archive-title'] ) ? esc_attr( $term_meta['archive-title'] ) : ''; ?>">
      <p class="description"><?php _e( 'Enter in a value to overwrite the default title of the archive page.', '__x__' ); ?></p>
    </td>
  </tr>
  <tr class="form-field">
    <th scope="row" valign="top"><label for="term_meta[archive-subtitle]"><?php _e( 'Archive Subitle', '__x__' ); ?></label></th>
    <td>
      <input type="text" name="term_meta[archive-subtitle]" id="term_meta[archive-subtitle]" value="<?php echo esc_attr( $term_meta['archive-subtitle'] ) ? esc_attr( $term_meta['archive-subtitle'] ) : ''; ?>">
      <p class="description"><?php _e( 'Enter in a value to overwrite the default subtitle of the archive page. Note that not all Stacks display the subtitle on their archive pages.', '__x__' ); ?></p>
    </td>
  </tr>
  <?php
}



// Save Taxonomy Meta
// =============================================================================

function x_taxonomy_save_custom_meta( $term_id ) {
  if ( isset( $_POST['term_meta'] ) ) {
    $t_id      = $term_id;
    $term_meta = get_option( "taxonomy_$t_id" );
    $cat_keys  = array_keys( $_POST['term_meta'] );
    foreach ( $cat_keys as $key ) {
      if ( isset ( $_POST['term_meta'][$key] ) ) {
        $term_meta[$key] = $_POST['term_meta'][$key];
      }
    }
    update_option( "taxonomy_$t_id", $term_meta );
  }
}



// Taxonomy Actions
// =============================================================================

$x_taxonomies = array( 'category', 'post_tag', 'portfolio-category', 'portfolio-tag', 'product_cat', 'product_tag' );

foreach ( $x_taxonomies as $x_taxonomy ) {
  add_action( $x_taxonomy . '_add_form_fields',  'x_taxonomy_add_new_meta_field', 10, 2 );
  add_action( $x_taxonomy . '_edit_form_fields', 'x_taxonomy_edit_meta_field',    10, 2 );
  add_action( 'edited_' . $x_taxonomy,           'x_taxonomy_save_custom_meta',   10, 2 );
  add_action( 'create_' . $x_taxonomy,           'x_taxonomy_save_custom_meta',   10, 2 );
}