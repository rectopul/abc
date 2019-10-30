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
	<div class="container single--page">
		<div class="banner--single_product">

			<div class="left__single">
	            <?php
	                $image = get_field('banner_post');
	                if( !empty($image) ): ?>
	                    <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
	            <?php endif; ?>

	            <span class="title__single"><?php the_title(); ?></span>
	            <div class="data__author"><span class="time"><?php echo "Postado em: "; the_time('d/m/Y') ?> </span><span class="author"><?php $author = get_the_author(); echo "Por: ".$author;?></span></div>
				<div class="conteudo__single_painel">
					<?php the_content(); ?>
				</div>
			</div>

			<div class="right_single">
		        <div class="revistas__div">
		            <span>Revistas</span>
		            <div class="revistas--overflow">
		             <?php
		                $args = array(
		                'posts_per_page' => 2, 
		                'orderby' => 'desc',
		                'post_type' => 'post',
		                'category_name' => 'revistas'
		                );
		                $wp_query = new WP_Query($args);
		                if ($wp_query->have_posts()) {
		                while ($wp_query->have_posts()) {
		                    $wp_query->the_post();
		            ?>
		                <div class="img__revistas">
		                    <?php the_post_thumbnail(); ?>
		                </div>
		            <?php } } ?>
		                </div>
		                <div class="assinar__revista">
		                    <a href="#">
		                        Assinar
		                    </a>
		                </div>
		        </div>
				<div class="banner__home">
					<?php
					$args = array(
					'posts_per_page' => 1, 
					'orderby' => 'desc',
					'post_type' => 'banner',
					'p' => '61'
					);
					$wp_query = new WP_Query($args);
					if ($wp_query->have_posts()) {
					while ($wp_query->have_posts()) {
					    $wp_query->the_post();
					?>
					<?php
					$image = get_field('imagem_banner');
					if( !empty($image) ): ?>
					    <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
					<?php endif; ?>
					<?php } } ?>
				</div>
				<div class="colunista">
				    <span>Colunistas</span>
				        <?php
				            $args = array(
				            'posts_per_page' => 4, 
				            'orderby' => 'desc',
				            'post_type' => 'colunista'
				            );
				            $wp_query = new WP_Query($args);
				            if ($wp_query->have_posts()) {
				            while ($wp_query->have_posts()) {
				                $wp_query->the_post();
				        ?>
				            <div class="colunista__item">
				                <div class="colunista__img">
				                    <?php
				                    $image = get_field('foto_colunista');
				                    if( !empty($image) ): ?>
				                        <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
				                    <?php endif; ?>
				                </div>
				                <div class="colunista__info">
				                    <span class="colunista__nome"><?php the_title(); ?></span>
				                    <div class="colunista__desc"><?php the_field('descricao_colunista'); ?></div>
				                    <a href="#">Ver mais matérias de <?php the_title(); ?></a>
				                </div>
				            </div>  
				        <?php } } ?>
				</div>
			</div>

		</div>
	</div>

<?php  endif; ?>

<div class="leia__tb container">
	<div class="title__leia">
		<span>Leia também</span>
	</div>
 <div class="noticias__div">

             <?php


                $args = array(
                'posts_per_page' => 3, 
                'orderby' => 'desc',
                'post_type' => 'post',
                'cat' => '18'
                );
                $wp_query = new WP_Query($args);
                if ($wp_query->have_posts()) {
                while ($wp_query->have_posts()) {
                    $wp_query->the_post();
            ?>
            <div class="post__geral">
            	<div class="flag__post"><?php the_field('flag_post'); ?></div>
                <div class="title__post"><a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></div>
                <div class="shortdesc__post"><?php the_field('desc_post'); ?></div>
                <div class="author__post"><?php $author = get_the_author(); echo "Por: ".$author;?></div>
            </div>
            <?php } } ?>
    </div>
</div>

<div class="container insta__news">
    <div class="insta">
        <span><img src="<?php bloginfo('template_directory'); ?>/img/insta_footer.png"> Siga nosso Insta</span>
    </div>
    <div class="news">
        <span>Fique por dentro</span>
        <p>Cadastre-se e receba todas as novidades</p>

        <div class="news_form">
            <input type="text" class="news_text" placeholder="Digite o seu e-mail">
            <input type="button" value="OK" class="botao_news">
        </div>

    </div>
</div>

<?php get_footer(); ?>
