
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
        <li data-layer="baba" class="active__aba">Babás</li>
        <li data-layer="domestica">Domésticas</li>
    </ul>
</div>

<div class="wrapper__content professionals__wrapper">
    <h2>Ótimo! Temos algumas opções. Escolha abaixo a melhor para você.</h2>

    <ul class="abas__require">
        <li class="active__aba" data-atrib="Folguista">Folguista</li>
        <li data-atrib="Ir e vir">Ir e vir</li>
        <li data-atrib="Noturna">Noturna</li>
        <li data-atrib="Arrumadeira">Arrumadeira</li>
    </ul>
    
    <div class="prices__container">
        <h2>Por favor selecione uma faixa salarial:</h2>
        <ul class="list__price">
            <li data-price-in="1000" data-price-out="1500" class="active">R$1.000,00 a R$1.500,00</li>
            <li data-price-in="1500" data-price-out="2000">R$1.500,00 a R$2.000,00</li>
            <li data-price-in="2000" data-price-out="2500">R$2.000,00 a R$2.500,00</li>
            <li data-price-in="2500" data-price-out="3000">R$2.500,00 a R$3.000,00</li>
            <li data-price-in="3000" data-price-out="1000000">Acima de R$3.000,00</li>
        </ul>
    </div>

    <div class="list__post">
        <div data-layer="babas" class="babas post__type-baba"> 
 
            <ul class="list__profissionais"> 
                <?php
                    $args = array(
                        'posts_per_page' => 12,  
                        'order' => 'desc',
                        'post_type' => 'baba'
                    );
                    $wp_query = new WP_Query($args);
                    if ($wp_query->have_posts()) {
                        while ($wp_query->have_posts()) {
                            $wp_query->the_post();
                ?>
                <li class="item__list">
                    
                    <figure><?php the_post_thumbnail('profile', ['class' => 'thumb__funcionary']); ?></figure>
                    <span class="item__attr"><?php the_field('atributo');?></span>
                    <span class="item__title"><?php the_title(); ?></span>
                    <span class="item__desc"><?php the_field('descricao_curta');?></span>
                    <span class="item__salario"><strong>Prentensão salarial</strong><?php echo 'R$' . number_format(get_field('salario'), 2); // retorna R$100,000.50 ?></span>
                    <span class="button--contratar" data-id="<?php get_the_ID() ?>">Contratar</span>
                </li>
                <?php } } wp_reset_postdata(); ?>
            </ul>
        </div>
        
        <div data-layer="domesticas" class="domesticas post__type-domestica" style="display: none"> 
            <ul class="list__profissionais">
                <?php
                $args2 = array(
                    'posts_per_page' => 12,  
                    'order' => 'desc',
                    'post_type' => 'domestica'
                );
                $wp_query2 = new WP_Query($args2);
                if ($wp_query2->have_posts()) {
                    while ($wp_query2->have_posts()) {
                        $wp_query2->the_post();
                ?>
                <li class="item__list">
                    <figure><?php the_post_thumbnail('profile', ['class' => 'thumb__funcionary']); ?></figure>
                    <span class="item__attr"><?php the_field('atributo');?></span>
                    <span class="item__title"><?php the_title(); ?></span>
                    <span class="item__desc"><?php the_field('descricao_curta');?></span>
                    <span class="item__salario"><strong>Prentensão salarial</strong><?php echo 'R$' . number_format(get_field('salario'), 2); // retorna R$100,000.50 ?></span>
                    <span class="button--contratar" data-id="<?php get_the_ID() ?>">Contratar</span>
                </li>
                <?php } } wp_reset_postdata(); ?>
            </ul>
        </div>
    </div>
</div>

    

<?php  endif; ?>
<?php get_footer(); ?>
