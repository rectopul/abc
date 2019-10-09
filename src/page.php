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
	<?php if( get_field('imagem_de_cabecalho') ): 
		$headerimage = get_field('imagem_de_cabecalho'); ?>
	<div class="page__thumb" style="background-image: url('<?php echo $headerimage['url']; ?>');"></div>
	<?php endif; ?>
	<?php if(get_field('mensagem_da_pagina')): ?>
	<div class="page__sobre-descript">
		<div class="page__sobre-container">
		<?php echo get_field('mensagem_da_pagina'); ?>
		</div>
	</div>
	<?php endif; ?>
	
	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
