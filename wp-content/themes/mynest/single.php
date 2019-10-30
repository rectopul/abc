<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package auaha
 */

get_header(); ?>

<?php if (have_posts()) : the_post(); ?>
<div class="container">
    <div class="data__coments">
        <div class="data__coments--filho">
            <div class="post__category"><?php the_category(); ?></div>
            <div class="dados-post">
                <span><?php the_time('d/m/Y') ?> </span>
                <span class="qtd__coments"> - <?php comments_number('0', '1', '%'); ?> comentários </span>
            </div>
        </div>
        <!-- Go to www.addthis.com/dashboard to customize your tools -->
        <div class="addthis_inline_share_toolbox">compartilhar</div>
    </div>

    <div class="title__post"><?php the_title(); ?></div>
    <div class="content__post"><?php the_content(); ?></div>

    <div class="curtir__facebook">
        <iframe src="https://www.facebook.com/plugins/like.php?href=<?php echo esc_url( get_permalink() );?>&width=450&layout=standard&action=like&size=small&show_faces=true&share=true&height=80&appId" width="450" height="80" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
    </div>

    <div class="comentarios">
                <div class="title__coment">
                    <h2>Comentários</h2>
                    <span class="qtd__coments"><?php comments_number('0', '1', '%'); ?> Comentários </span>
                </div>

                <?php
                    $postID = $post->ID;

                    $comment_array = get_approved_comments($postID);

                    foreach ($comment_array as $comment) {
                        echo('<p class="coments-p">
                        <span class="comentario-autor">
                            <span class="autor-coment">' . $comment->comment_author . '</span>
                            <span class="date-coment">' . date('d.m.y - h:m', strtotime($comment->comment_date)) . 'h</span> 
                        </span>
                        <span class="comentario-autor_text">' . $comment->comment_content . '</span></p>');
                    }
                ?>

				<?php comment_form(); ?>

    </div>
    <a class="mais__postagens" href="<?php echo get_home_url(); ?>/posts">VER MAIS POSTAGENS</a>
</div>
<?php  endif; ?>

<?php get_footer(); ?>
