
 <?php
 /**
  * The template for displaying all single posts
  *
  * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
  *
  * @package auaha
   * Template Name: produto
  */
 get_header(); ?>

<div class="container showcase--full">
     <div class="row">
         <div class="showcase--header">
            <div>
                <img src="<?php bloginfo('template_directory'); ?>/img/icon-categoria.png">
            </div>
            <span><?php the_title(); ?> </span> 
         </div>
            <div class="show-case--content">
            <ul class="show-case-ul">
                <?php
                $category = get_the_title();
                $args = array(
                    'category_name' => $category,
                    'posts_per_page' => 6,
                    'order' => 'desc',
                    'post_type' => 'post',
                    'post__not_in' => array(44, 42)
                );
                $wp_query = new WP_Query($args);
                if ($wp_query->have_posts()) {
                    while ($wp_query->have_posts()) {
                        $wp_query->the_post();
                        $texto = get_the_content();
                        $texto = mb_strimwidth($texto, 0, 200, "...");

                ?>

                    <li class="">
                        <div class="postimage__cotegoria">
                            <div class="post__image"><?php the_post_thumbnail(); ?></div>
                            <div class="post__category"><?php the_category(); ?>
                                <!-- Go to www.addthis.com/dashboard to customize your tools -->
                                <div class="addthis_inline_share_toolbox">compartilhar</div>
                            </div>
                        </div>
                        <div class="right__post">
                            <div class="post__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
                            <div class="post__content"><?php echo $texto; ?></div>
                            <div class="post__footer">
                                <div class="dados-post">
                                    <span><?php the_time('d/m/Y') ?> </span>
                                    <span class="qtd__coments"> - <?php comments_number('0', '1', '%'); ?> comentários </span>
                                </div>
                                <a href="<?php the_permalink(); ?>">Continue lendo ></a>
                            </div>
                        </div>
                    </li>

                <?php } } ?>
            </ul>
        
            <a class="mais__postagens" href="<?php echo get_home_url(); ?>/posts">VER MAIS POSTAGENS</a>

        </div>
    </div>
</div>

 <?php get_footer(); ?>
