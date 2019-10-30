<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package auaha
 */

get_header(); ?>
	<div class="portfolio">
		<div class="portfolio__container">
			<div class="portfolio__topo">
				<?php
					$args = array(
						'p' => 86
					);
					$wp_query = new WP_Query($args);
					if ($wp_query->have_posts()) {
						while ($wp_query->have_posts()) {
							$wp_query->the_post();
					?>
						<h1 class="portfolio__titulo"><?php the_title(); ?></h1>
						<div class="portfolio__divisor"></div>
						<span class="portfolio__texto"><?php the_content(); ?></span>
				<?php } } ?>
			</div>

			<div class="portfolio__certificados">
				<ul class="portfolio__listacertificados">

					<?php
					$args = array(
						'posts_per_page' => -1,  
						'order' => 'ASC',
						'post_type' => 'certificados'
					);
					$wp_query = new WP_Query($args);
					if ($wp_query->have_posts()) {
						while ($wp_query->have_posts()) {
							$wp_query->the_post();
					?>
						<li class="portfolio__itemcertificados">
							<div class="portfolio__imagemcertificados"><?php the_post_thumbnail(); ?></div>
							<h3 class="portfolio__nomecertificados"><?php the_title(); ?></h3>
							<div class="portfolio__textocertificados"><?php the_content(); ?></div>
						</li>
					<?php } } ?>

				</ul>
			</div>

			<div class="portfolio__depoimentos">
				<ul class="portfolio__listadepoimentos">

					<?php
					$args = array(
						'posts_per_page' => -1,  
						'order' => 'ASC',
						'post_type' => 'depoimentos'
					);
					$wp_query = new WP_Query($args);
					if ($wp_query->have_posts()) {
						while ($wp_query->have_posts()) {
							$wp_query->the_post();
					?>
						<li class="portfolio__itemdepoimentos">
							<div class="portfolio__imagemdepoimentos">
								<?php the_post_thumbnail(); ?>
							</div>
							<div class="portfolio__conteudodepoimentos">
								<h3 class="portfolio__nomedepoimentos"><?php the_title(); ?></h3>
								<div class="portfolio__subdepoimentos"><?php the_excerpt(); ?></div>
								<div class="portfolio__textodepoimentos"><?php the_content(); ?></div>
							</div>
						</li>
					<?php } } ?>

				</ul>
			</div>

		</div>
		<div class="portfolio__obrastitulo">
			<h2>Obra Civil e Layout Executado</h2>
		</div>
		<div class="portfolio__container portfolio__container--pad">
			<?php

                $args = array(
                    'order' => 'asc',
                    'taxonomy' => 'portfolio-category'
				);
                $categories = get_categories($args);

                foreach ($categories as $category) {

					echo '<div class="portfolio__tituloobra">'.$category->name.'</div>';
					echo '<div class="portfolio__divisorobra"></div>';

					$idQuery = $category->term_id;
                       
					$argsPost = array(
					'posts_per_page' => -1, 
					'orderby' => 'desc',
					'tax_query' => array(
						array(
						'taxonomy' => 'portfolio-category',
						'field' => 'term_id',
						'terms' => $idQuery
							)
						)
					);

					$wp_queryNew = new WP_Query($argsPost);
					if ($wp_queryNew->have_posts()) {
					?>	
					<ul class="portfolio__listaobras">
					<?php 
					while ($wp_queryNew->have_posts()) {
						$wp_queryNew->the_post();
					?>
						<li class="portfolio__itemobras">
							<a href="<?php echo get_the_post_thumbnail_url(); ?>"><img src="<?php echo get_the_post_thumbnail_url(); ?>"></a>
						</li>
					<?php 
					} 
					?>
					</ul>
					<?php 
					}};
				?>				
		</div>
	</div>

	<script>
		$('.portfolio__listaobras').slick({
			dots: false,
			infinite: true,
			speed: 300,
			slidesToShow: 4,
			slidesToScroll: 4,
			responsive: [
				{
				breakpoint: 1024,
				settings: {
					slidesToShow: 3,
					slidesToScroll: 3,
					infinite: true,
					dots: false
				}
				},
				{
				breakpoint: 768,
				settings: {
					slidesToShow: 2,
					slidesToScroll: 2
				}
				},
				{
				breakpoint: 480,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1
				}
				}
			]
		});
	</script>

<?php
get_sidebar();
get_footer();
