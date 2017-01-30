<?php

// =============================================================================
// FUNCTIONS/GLOBAL/COMMENT.PHP
// -----------------------------------------------------------------------------
// Comment structure for X.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Individual Comment Output
// =============================================================================

// Individual Comment Output
// =============================================================================

//
// 1. Pingbacks and trackbacks.
// 2. Normal Comments.
//

if ( ! function_exists( 'x_comment' ) ) :
  function x_comment( $comment, $args, $depth ) {

    $GLOBALS['comment'] = $comment;
    switch ( $comment->comment_type ) :
      case 'pingback' :  // 1
      case 'trackback' : // 1
    ?>
    <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
      <p><?php _e( 'Pingback:', '__x__' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', '__x__' ), '<span class="edit-link">', '</span>' ); ?></p>
    <?php
        break;
      default : // 2
      GLOBAL $post;
    ?>
    <li id="li-comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
      <?php
      printf( '<div class="x-comment-img">%1$s %2$s</div>',
        '<span class="avatar-wrap cf">' . get_avatar( $comment, 120 ) . '</span>',
        ( $comment->user_id === $post->post_author ) ? '<span class="bypostauthor">' . __( 'Post<br>Author', '__x__' ) . '</span>' : ''
      );
      ?>
      <article id="comment-<?php comment_ID(); ?>" class="comment">
        <header class="x-comment-header">
          <?php
          printf( '<cite class="x-comment-author">%1$s</cite>',
            get_comment_author_link()
          );
          printf( '<div><a href="%1$s" class="x-comment-time"><time datetime="%2$s">%3$s</time></a></div>',
            esc_url( get_comment_link( $comment->comment_ID ) ),
            get_comment_time( 'c' ),
            sprintf( __( '%1$s at %2$s', '__x__' ),
              get_comment_date(),
              get_comment_time()
            )
          );
          edit_comment_link( __( 'Edit', '__x__' ) );
          ?>
        </header>
        <?php if ( '0' == $comment->comment_approved ) : ?>
          <p class="x-comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', '__x__' ); ?></p>
        <?php endif; ?>
        <section class="x-comment-content">
          <?php comment_text(); ?>
        </section>
        <div class="x-reply">
          <?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply <span class="comment-reply-link-after"><i class="x-icon-reply"></i></span>', '__x__' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
        </div>
      </article>
    <?php
        break;
    endswitch;

  }
endif;