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
	<div class="servicos">
		<div class="servicos__container">

			<?php
				$args = array(
					'p' => 83
				);
				$wp_query = new WP_Query($args);
				if ($wp_query->have_posts()) {
					while ($wp_query->have_posts()) {
						$wp_query->the_post();
				?>
					<h1 class="servicos__titulo"><?php the_title(); ?></h1>
					<div class="servicos__divisor"></div>
					<span class="servicos__texto"><?php the_content(); ?></span>
					<div class="servicos__img"><?php the_post_thumbnail(); ?></div>
			<?php } } ?>
			
			<div class="servicos__posts">
				<ul class="servicos__lista">

					<?php
					$args = array(
						'posts_per_page' => -1,  
						'order' => 'ASC',
						'post_type' => 'servicos'
					);
					$wp_query = new WP_Query($args);
					if ($wp_query->have_posts()) {
						while ($wp_query->have_posts()) {
							$wp_query->the_post();
					?>
						<li class="servicos__item">
							<div class="servicos__imagem"><?php the_post_thumbnail(); ?></div>
							<h3 class="servicos__nome"><?php the_title(); ?></h3>
						</li>
					<?php } } ?>

				</ul>
			</div>
		</div>
	</div>
<?php
get_sidebar();
get_footer();
