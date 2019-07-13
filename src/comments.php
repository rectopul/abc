<?php
/**
* The template for displaying Comments
*
* The area of the page that contains both current comments
* and the comment form. The actual display of comments is
* handled by a callback to twentytwelve_comment() which is
* located in the functions.php file.
*
* @package WordPress
* @subpackage Twenty_Twelve
* @since Twenty Twelve 1.0
*/

/*
* If the current post is protected by a password and
* the visitor has not yet entered the password we will
* return early without loading the comments.
*/
if ( post_password_required() )
    return;
?>

<div id="comments" class="comments-area">

   <?php // You can start editing here -- including this comment! ?>

   <?php if ( have_comments() ) : ?>
       <h2 class="comments-title">
           <?php
               printf( _n( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'twentytwelve' ),
                   number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
           ?>
       </h2>

       <ol class="commentlist">
           <?php wp_list_comments( array( 'callback' => 'twentytwelve_comment', 'style' => 'ol' ) ); ?>
       </ol><!-- .commentlist -->

       <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
       <nav id="comment-nav-below" class="navigation" role="navigation">
           <h1 class="assistive-text section-heading"><?php _e( 'Comment navigation', 'twentytwelve' ); ?></h1>
           <div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'twentytwelve' ) ); ?></div>
           <div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'twentytwelve' ) ); ?></div>
       </nav>
       <?php endif; // check for comment navigation ?>

       <?php
       /* If there are no comments and comments are closed, let's leave a note.
        * But we only want the note on posts and pages that had comments in the first place.
        */
       if ( ! comments_open() && get_comments_number() ) : ?>
       <p class="nocomments"><?php _e( 'Comments are closed.' , 'twentytwelve' ); ?></p>
       <?php endif; ?>

   <?php endif; // have_comments() ?>

   <?php //comment_form(); ?>
   <?php if ('open' == $post->comment_status) : ?>
   <div id="respond" class="comment-respond">
       <h3 id="reply-title" class="comment-reply-title"><?php comment_form_title( 'Leave a Reply', 'Leave a Reply to %s' ); ?></h3>
       <div id="cancel-comment-reply">
       <p class="small"><?php cancel_comment_reply_link( __("Cancel Reply", "bonestheme") ); ?></p>
       </div>
       <div class="cancel-comment-reply">
           <?php cancel_comment_reply_link(); ?>
       </div>
       <?php if ( get_option('comment_registration') && !$user_ID ) : ?>
       <p>You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">logged in</a> to post a comment.</p>
       <?php else : ?>

           <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

               <?php if ( $user_ID ) : ?>

                   <p>Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">Log out &raquo;</a></p>

                   <?php else : ?>
                   <p class="comment-notes">Your email address will not be published. Required fields are marked <span class="required">*</span></p>

                   <p class="comment-form-author"><label for="author">Name <?php if ($req) echo '<span class="required">*</span>'; ?></label>
                   <input type="text" name="author" id="author" value="<?php //echo $comment_author; ?>" size="22" tabindex="1" /></p>

                   <p class="comment-form-email"><label for="email">Mail <?php if ($req) echo '<span class="required">*</span>'; ?></label>
                   <input type="text" name="email" id="email" value="<?php //echo $comment_author_email; ?>" size="22" tabindex="2" /></p>

                   <p class="comment-form-url"><label for="url">Website</label>
                   <input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" /></p>

               <?php endif; ?>

               <!-- <p class="form-allowed-tags"><small><strong>XHTML:</strong> You can use these tags: <code><?php echo allowed_tags(); ?></code></small></p> -->

                   <p class="comment-form-comment"><p><label for="comment">Comment <?php if ($req) echo '<span class="required">*</span>'; ?></label>
                   <textarea name="comment" id="comment" cols="100%" rows="10" tabindex="4"></textarea></p>

                   <p class="form-submit"><input name="submit" type="submit" id="submit" tabindex="5" value="Post Comment" />
                   <?php comment_id_fields(); ?>
                   </p>
                   <?php do_action('comment_form', $post->ID); ?>
           </form>
       <?php endif; // If registration required and not logged in ?>
   </div>
<?php endif; // if you delete this the sky will fall on your head ?>



</div><!-- #comments .comments-area -->
