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

	<div class="sobrenos">
		<div class="sobrenos__container">
			<?php
			$args = array(
				'p' => 45
			);
			$wp_query = new WP_Query($args);
			if ($wp_query->have_posts()) {
				while ($wp_query->have_posts()) {
					$wp_query->the_post();
			?>
				<div class="sobrenos__post">
					<h2 class="sobrenos__titulo">Sobre nós</h2>
					<h3 class="sobrenos__subtitulo"><?php the_title(); ?></h3>
					<div class="sobrenos__divisor"></div>
					<div class="sobrenos__conteudo">
						<span class="sobrenos__texto"><?php the_content(); ?></span>
						<div class="sobrenos__imagem"><?php the_post_thumbnail(); ?></div>
					</div>
				</div>
			<?php } } ?>
		</div>
	</div>

	<div class="equipe">
		<div class="equipe__container">
			<ul class="equipe__lista">
				<?php
				$args = array(
					'posts_per_page' => 3,  
					'order' => 'ASC',
					'post_type' => 'equipe'
				);
				$wp_query = new WP_Query($args);
				if ($wp_query->have_posts()) {
					while ($wp_query->have_posts()) {
						$wp_query->the_post();
				?>
					<li class="equipe__item">
						<div class="equipe__img"><?php the_post_thumbnail(); ?></div>
						<div class="equipe__conteudo">
							<div class="equipe__titulo">
								<span class="equipe__nome"><?php the_title(); ?> - </span>
								<span class="equipe__cargo"><?php the_excerpt(); ?></span>
							</div>
							<div class="equipe__texto">
								<?php the_content(); ?>
							</div>
						</div>
					</li>
				<?php } } ?>
			</ul>
		</div>
	</div>

	<div class="parceiros">
		<div class="parceiros__container">
			<h2 class="parceiros__titulo">Parceiros</h2>
			<div class="parceiros__divisor"></div>
			<ul class="parceiros__lista">
				<?php
				$args = array(
					'posts_per_page' => -1,  
					'order' => 'ASC',
					'post_type' => 'parceiros'
				);
				$wp_query = new WP_Query($args);
				if ($wp_query->have_posts()) {
					while ($wp_query->have_posts()) {
						$wp_query->the_post();
				?>
					<li class="parceiros__item">
						<?php the_post_thumbnail(); ?>
					</li>
				<?php } } ?>
			</ul>
		</div>
	</div>

<?php
get_sidebar();
get_footer();