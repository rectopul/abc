<?php
/**
 * The template for displaying all single posts- blog
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package auaha
 */

get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<div class="container single-post ">
    <div class="back--blog">
        <a href="<?php echo get_template_directory_uri(); ?>/blog">
            Voltar para o blog
        </a>
    </div>
    <div class="contant--single">
        <div class="content--full">
            <div class="img--single"><?php the_post_thumbnail(); ?></div>
            <div class="right--single">
                <div class="title--right">
                    <?php the_title(); ?>
                </div>
                <div class="dados-post">
                    <div class="data--coments">
                        <span><img src="<?php bloginfo('template_directory'); ?>/img/tempo.png"> <?php the_time('d/m/Y') ?></span>
                        <span class="last"><img src="<?php bloginfo('template_directory'); ?>/img/coments.png"> <?php comments_number('0', '1', '%'); ?> </span>
                        <div class="author"><?php $author = get_the_author(); echo "por ".$author;?></div>
                    </div>
                    <div class="share--single">
                        <?php echo do_shortcode('[addthis tool="addthis_inline_share_toolbox_gqal"]'); ?>
                    </div>
                </div>
                <?php the_content(); ?>
            </div>
        </div>
    </div>
</div>

<?php endwhile; endif; ?>
<!-- Include newsletter -->
<?php include('components/newsletter.php'); ?>
<?php get_footer(); ?>
