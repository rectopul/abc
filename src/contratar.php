
 <?php
 /**
  * The template for displaying all single posts
  *
  * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
  *
  * @package auaha
   * Template Name: contratar
  */
 get_header(); ?>

<?php if (have_posts()) : the_post(); ?>
<div class="topheader">
    <h2>Que tipo de porssisional vocês deseja contartar?</h2>

    <ul class="list__service">
        <li data-layer="babas" class="active__aba">Babás</li>
        <li data-layer="domesticas">Domésticas</li>
    </ul>


</div>

<div class="wrapper__content">
        <h2>Ótimo! Temos algumas opções. Escolha abaixo a melhor para você.</h2>

        <ul class="abas__require">
            <li class="active__aba">Folguista</li>
            <li>Ir e vir</li>
            <li>Noturna</li>
            <li>Arrumadeira</li>
        </div>
    </div>

    <div class="list__post">
        <div data-layer="babas" class="babas"> 
 
            <ul class="list__profissionais"> 
                <?php
                    $args = array(
                        'posts_per_page' => -1,  
                        'order' => 'desc',
                        'post_type' => 'baba'
                    );
                    $wp_query = new WP_Query($args);
                    if ($wp_query->have_posts()) {
                        while ($wp_query->have_posts()) {
                            $wp_query->the_post();
                ?>
                <li class="item__list">
                    
                    <figure><?php the_post_thumbnail() ?></figure>
                    <span class="item__attr"><?php the_field('atributo');?></span>
                    <span class="item__title"><?php the_title(); ?></span>
                    <span class="item__desc"><?php the_field('descricao_curta');?></span>
                    <span class="item__salario"><strong>Prentensão salarial</strong><?php the_field('salario'); ?></span>
                    <span class="button--contratar" data-id="<?php get_the_ID() ?>">Contratar</span>
                </li>
                <?php } } ?>
            </ul>
        </div>

        <div data-layer="domesticas" class="domesticas" style="display: none"> 
            <ul class="list__profissionais">
                <?php
                $args = array(
                    'posts_per_page' => -1,  
                    'order' => 'desc',
                    'post_type' => 'domestica'
                );
                $wp_query = new WP_Query($args);
                if ($wp_query->have_posts()) {
                    while ($wp_query->have_posts()) {
                        $wp_query->the_post();
                ?>
                <li class="item__list">
                    
                    <figure><?php the_post_thumbnail() ?></figure>
                    <span class="item__attr"><?php the_field('atributo');?></span>
                    <span class="item__title"><?php the_title(); ?></span>
                    <span class="item__desc"><?php the_field('descricao_curta');?></span>
                    <span class="item__salario"><strong>Prentensão salarial</strong><?php the_field('salario'); ?></span>
                    <span class="button--contratar" data-id="<?php get_the_ID() ?>">Contratar</span>
                </li>
                <?php } } ?>
            </ul>
        </div>
    </div>

    

<?php  endif; ?>
<?php get_footer(); ?>
