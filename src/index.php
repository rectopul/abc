<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package auaha
 */

get_header(); ?>

<section class="fullbanner">
    <ul class="fullbanner__lista">
        <?php
        $args = array(
            'posts_per_page' => -1,  
            'order' => 'desc',
            'post_type' => 'fullbanner'
        );
        $wp_query = new WP_Query($args);
        if ($wp_query->have_posts()) {
            while ($wp_query->have_posts()) {
                $wp_query->the_post();
        ?>
            
            <li class="fullbanner__item">
                <?php if(get_field('link')): $link = get_field('link'); ?>
                    <a href="<?php echo $link['url']; ?>"><div class="post__image"><?php the_post_thumbnail(); ?></div></a>
                <?php else: ?>
                <div class="post__image"><?php the_post_thumbnail(); ?></div>
                 <?php endif; ?>
            </li>

        <?php } } ?>
    </ul>
</section>

<section class="como__funciona">
    <hr>
    <div class="wrapper">
        <span>Como funciona</span>
        <ul class="funciona__list">
        <?php
        $args = array(
            'posts_per_page' => 5,  
            'order' => 'desc',
            'post_type' => 'funciona'
        );
        $wp_query = new WP_Query($args);
        if ($wp_query->have_posts()) {
            while ($wp_query->have_posts()) {
                $wp_query->the_post();
        ?>

            <li class="funciona__list-item">
                <div class="funciona__list-image"><?php the_post_thumbnail(); ?></div>
                <div class="funciona__list-title"><?php the_title(); ?></div>
                <div class="funciona__list-text"><?php the_content(); ?></div>
            </li>

        <?php } } ?>
    </ul>
    </div>
</section>


<section class="sobre">
    <div class="wrapper">
        <div class="sobre__left">
            <span>Sobre nós</span>
            
            <?php
                $args = array(
                    'posts_per_page' =>1,  
                    'order' => 'desc',
                    'post_type' => 'sobre',
                    'p' => array(63)
                );
                $wp_query = new WP_Query($args);
                if ($wp_query->have_posts()) {
                    while ($wp_query->have_posts()) {
                        $wp_query->the_post();
                ?>
                    <?php the_content(); ?> 
                <?php } } ?>
        </div>
        <div class="sobre__right">
            <ul>
            <?php
                $args = array(
                    'posts_per_page' => 4,  
                    'order' => 'desc',
                    'post_type' => 'sobre',
                    'post__not_in' => array(63)
                );
                $wp_query = new WP_Query($args);
                if ($wp_query->have_posts()) {
                    while ($wp_query->have_posts()) {
                        $wp_query->the_post();
                ?>

                <li class="sobre__list-item">
                    <div class="sobre__list-image"><?php the_post_thumbnail(); ?></div>
                    <div class="sobre__list-title"><?php the_title(); ?></div>
                    <div class="sobre__list-text"><?php the_content(); ?></div>
                </li>

                <?php } } ?>
            </ul>
        </div>
    </div>
</section>

<section class="depoimentos">
    <div class="wrapper">
        <ul class="depoimentos__list">
            <?php
                $args = array(
                    'posts_per_page' => 5,  
                    'order' => 'desc',
                    'post_type' => 'depoimentos'
                );
                $wp_query = new WP_Query($args);
                if ($wp_query->have_posts()) {
                    while ($wp_query->have_posts()) {
                        $wp_query->the_post();
            ?>
                <li class="depoimentos__list-item">
                    <div class="depoimentos__list-text"><?php the_content(); ?></div>
                    <div class="depoimentos__list-image"><?php the_post_thumbnail(); ?></div>
                    <div class="depoimentos__list-title"><?php the_title(); ?></div>
                    <div class="depoimentos__list-profissao"><?php the_field('profissao'); ?></div>
                </li>
            <?php } } ?>
        <ul>
    </div>
</section>

<section class="servicos">
    <div class="wrapper">
        <span>Serviços</span>
    </div> 

    <ul class="servicos__list">
        <?php
            $args = array(
                'posts_per_page' => 2,  
                'order' => 'desc',
                'post_type' => 'servicos'
            );
            $wp_query = new WP_Query($args);
            if ($wp_query->have_posts()) {
                while ($wp_query->have_posts()) {
                    $wp_query->the_post();
        ?>
            <li class="servicos__list-item" style="background: url('<?php echo get_the_post_thumbnail_url(); ?>');">
                <div class="wrapper">
                    <div class="servicos__list-info">
                        <div class="servicos__list-title"><?php the_title(); ?></div>
                        <div class="servicos__list-descricao"><?php the_field('descricao_curta'); ?></div>
                        <div class="servicos__list-link"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" alt="<?php the_title(); ?>">Conheça as opções de contratação</a></div>
                    </div>
                </div>
            </li>
        <?php } } ?>
    <ul>

</section>

<section class="contrate">
    <a href="<?php echo get_permalink( get_page_by_path( 'contratar' ) ); ?>">Contrate agora</a>
</section>

 
<?php get_footer(); ?>
