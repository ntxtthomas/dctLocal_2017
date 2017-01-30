<?php

// =============================================================================
// WOOCOMMERCE/SINGLE-PRODUCT-REVIEWS.PHP
// -----------------------------------------------------------------------------
// Product reviews.
// =============================================================================

global $woocommerce, $product;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$stack         = get_theme_mod( 'x_stack' );
$stack_comment = 'x_' . $stack . '_comment';

?>

<?php if ( comments_open() ) : ?><div id="reviews"><?php

  echo '<div id="comments" class="x-comments-area">';

  if ( get_option('woocommerce_enable_review_rating') == 'yes' ) {

    $count = $product->get_rating_count();

    if ( $count > 0 ) {

      $average = $product->get_average_rating();

      echo '<div itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">';
      echo '<div class="star-rating-container aggregate"><div class="star-rating" title="' . sprintf(__( 'Rated %s out of 5', '__x__' ), $average ) . '"><span style="width:' . ( ( $average / 5 ) * 100 ) . '%"><strong itemprop="ratingValue" class="rating">' . $average . '</strong> ' . __( 'out of 5', '__x__' ) . '</span></div></div>';
      echo '<h2>' . sprintf( _n('%s review for %s', '%s reviews for %s', $count, 'woocommerce'), '<span itemprop="ratingCount" class="count">' . $count . '</span>', wptexturize($post->post_title) ) . '</h2>';
      echo '</div>';

    } else {

      echo '<h2>' . __( 'Reviews', '__x__' ) . '</h2>';

    }

  } else {

    echo '<h2>' . __( 'Reviews', '__x__' ) . '</h2>';

  }

  $title_reply = '';

  if ( have_comments() ) :

    echo '<ol class="x-comments-list">';

      wp_list_comments( array( 'callback' => $stack_comment ) );

    echo '</ol>';

    if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
      <div class="navigation">
        <div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Previous', '__x__' ) ); ?></div>
        <div class="nav-next"><?php next_comments_link( __( 'Next <span class="meta-nav">&rarr;</span>', '__x__' ) ); ?></div>
      </div>
    <?php endif;

    echo '<p class="add_review"><a href="#review_form" class="inline show_review_form button" title="' . __( 'Add Your Review', '__x__' ) . '">' . __( 'Add Review', '__x__' ) . '</a></p>';

    $title_reply = __( 'Add a review', '__x__' );

  else :

    $title_reply = __( 'Be the first to review', '__x__' ) . ' &ldquo;' . $post->post_title . '&rdquo;';

    echo '<p class="noreviews">'.__( 'There are no reviews yet, would you like to <a href="#review_form" class="inline show_review_form">submit yours</a>?', '__x__' ).'</p>';

  endif;

  $commenter = wp_get_current_commenter();

  echo '</div><div id="review_form_wrapper"><div id="review_form">';

  $comment_form = array(
    'title_reply' => $title_reply,
    'comment_notes_before' => '',
    'comment_notes_after' => '',
    'fields' => array(
      'author' => '<p class="comment-form-author">' . '<label for="author">' . __( 'Name', '__x__' ) . '</label> ' . '<span class="required">*</span>' .
                  '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true" /></p>',
      'email'  => '<p class="comment-form-email"><label for="email">' . __( 'Email', '__x__' ) . '</label> ' . '<span class="required">*</span>' .
                  '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" aria-required="true" /></p>',
    ),
    'label_submit' => __( 'Submit Review', '__x__' ),
    'logged_in_as' => '',
    'comment_field' => ''
  );

  if ( get_option('woocommerce_enable_review_rating') == 'yes' ) {

    $comment_form['comment_field'] = '<p class="comment-form-rating"><label for="rating">' . __( 'Rating', '__x__' ) . '</label><select name="rating" id="rating">
      <option value="">' . __( 'Rate&hellip;', '__x__' ) . '</option>
      <option value="5">' . __( 'Perfect', '__x__' ) . '</option>
      <option value="4">' . __( 'Good', '__x__' ) . '</option>
      <option value="3">' . __( 'Average', '__x__' ) . '</option>
      <option value="2">' . __( 'Not that bad', '__x__' ) . '</option>
      <option value="1">' . __( 'Very Poor', '__x__' ) . '</option>
    </select></p>';

  }

  $comment_form['comment_field'] .= '<p class="comment-form-comment"><label for="comment">' . __( 'Your Review', '__x__' ) . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>' . $woocommerce->nonce_field('comment_rating', true, false);

  comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );

  echo '</div></div>';

?><div class="clear"></div></div>
<?php endif; ?>