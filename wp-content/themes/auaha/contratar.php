
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
<div class="modal__service">
    <div class="modal__container">
        <div class="modal__header">
            <div class="modal__close">x</div>
            <div class="modal__title">
                <h1>Seja bem vinda (o)</h1>
                <h3>Digite seu CEP:</h3>
            </div>
        </div>
        <div class="modal__body">
            <label for="cepuser">
                <input type="text" name="cepuser" id="cepuser" placeholder="00000-000">
            </label>
        </div>
        <div class="modal__footer">
            <button>Entrar</button>
        </div>
    </div>
</div>
<?php if (have_posts()) : the_post(); ?>
<div class="topheader">
    <h2>Que tipo de profissional vocês deseja contratar?</h2>

    <ul class="list__service">
        <li data-layer="baba" class="active__aba">Babás</li>
        <li data-layer="domestica" >Domésticas</li>
    </ul>
</div>

<div class="wrapper__content professionals__wrapper">
    <h2>Ótimo! Temos algumas opções. Escolha abaixo a melhor para você.</h2>
    <!--TYPE-SELECT-->
    <div class="select__wrapper">
        <div class="select__inner_wrapper">
        </div>
        <button class="submit">></button>
        <ul class="select__require">
            <li class="active__aba" data-atrib="Folguista">Folguista</li>
            <li data-atrib="Ir e vir">Ir e vir</li>
            <li data-atrib="Noturna">Noturna</li>
            <li data-atrib="Arrumadeira">Arrumadeira</li>
        </ul>
        
    </div>
    <!--TYPE-BUTTON-->
    <!-- <ul class="abas__require">
        <li class="active__aba" data-atrib="Folguista">Folguista</li>
        <li data-atrib="Ir e vir">Ir e vir</li>
        <li data-atrib="Noturna">Noturna</li>
        <li data-atrib="Arrumadeira">Arrumadeira</li>
    </ul> -->
    
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

    <h1 class="idadecr">Qual a idade da (s) criança (s)? </h1>
    <div data-layer="domesticas" class="domestics post__list-idade">
        <div class="idade__item selected" data-idade="0 a 6 meses">0 a 6 meses</div>
        <div class="idade__item" data-idade="6 meses a 1 ano">6 meses a 1 ano</div>
        <div class="idade__item" data-idade="1 a 2 anos">1 a 2 anos</div>
        <div class="idade__item" data-idade="2 a 4 anos">2 a 4 anos</div>
        <div class="idade__item" data-idade="Acima de 4 anos">Acima de 4 anos</div>
    </div>

    <div class="form__contratar">
        <span class="form__personal">
            <h1>Você selecionou <i class="num__personal">0</i> profissionais</h1>
            <div class="list__profsadd"></div>
        </span>
        <?php echo do_shortcode('[contact-form-7 id="227" title="Contratar"]'); ?>
    </div>
</div>

    

<?php  endif; ?>
<?php get_footer(); ?>
