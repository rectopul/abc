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
	<div class="projeto">
		<div class="projeto__container">
			<div class="projeto__topo">
				<?php
					$args = array(
						'p' => 115
					);
					$wp_query = new WP_Query($args);
					if ($wp_query->have_posts()) {
						while ($wp_query->have_posts()) {
							$wp_query->the_post();
					?>
						<h1 class="projeto__titulo"><?php the_title(); ?></h1>
						<div class="projeto__divisor"></div>
						<span class="projeto__texto"><?php the_content(); ?></span>
				<?php } } ?>
			</div>

			<div class="projeto__postagens">
				<?php

					$args = array(
						'order' => 'asc',
						'taxonomy' => 'projetos-category'
					);
					$categories = get_categories($args);

					foreach ($categories as $category) {

						echo '<div class="projeto__tituloprojeto">'.$category->name.'</div>';
						echo '<div class="projeto__divisorprojeto"></div>';
						echo '<div class="projeto__slugprojeto">'.$category->slug.'</div>';

						$idQuery = $category->term_id;
						
						$argsPost = array(
						'posts_per_page' => -1, 
						'orderby' => 'desc',
						'tax_query' => array(
							array(
							'taxonomy' => 'projetos-category',
							'field' => 'term_id',
							'terms' => $idQuery
								)
							)
						);

						$wp_queryNew = new WP_Query($argsPost);
						if ($wp_queryNew->have_posts()) {
						?>	
						<ul class="projeto__listaprojeto">
						<?php 
						while ($wp_queryNew->have_posts()) {
							$wp_queryNew->the_post();
						?>
							<li class="projeto__itemprojeto">
								<a data-fancybox="gallery" href="<?php echo get_the_post_thumbnail_url(); ?>">
									<img src="<?php echo get_the_post_thumbnail_url(); ?>">
								</a>
								<h3><?php the_title(); ?></h3>
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
	</div>
	<script>
		if(jQuery(window).width() < 993) {
			$('.projeto__listaprojeto').slick({
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
		}
	</script>
<?php
get_sidebar();
get_footer();
