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
	<div class="pgcontato">
		<div class="pgcontato__container">
			<div class="pgcontato__informacoes">
				<h1 class="pgcontato__nome">Contato</h1>
				<div class="pgcontato__divisor"></div>
				<h2 class="pgcontato__titulo">Vamos definir um projeto juntos?</h2>
				<h3 class="pgcontato__subtitulo">Quer bater um papo, tirar dúvidas e pedir sugestões?</h3>
				<span class="pgcontato__text">Você pode nos ligar</span>
				<p class="pgcontato__telefone"><?php echo get_theme_mod( 'telefone' ); ?></p>
				<span class="pgcontato__text pgcontato__text--icon">ou enviar um Whatsapp</span>
				<p class="pgcontato__telefone"><?php echo get_theme_mod( 'telefone2' ); ?></p>
				<ul class="pgcontato__social">
					<li class="pgcontato__item">
						<a href="<?php echo get_theme_mod( 'facebook' ); ?>">
							<svg id="icon-facebook" viewBox="0 0 18 32">
								<title>facebook</title>
								<path d="M16.937 0.007l-4.221-0.007c-4.743 0-7.808 3.091-7.808 7.875v3.631h-4.244c-0.367 0-0.664 0.292-0.664 0.653v5.261c0 0.361 0.297 0.652 0.664 0.652h4.244v13.275c0 0.361 0.297 0.653 0.664 0.653h5.538c0.367 0 0.664-0.292 0.664-0.652v-13.275h4.963c0.367 0 0.664-0.292 0.664-0.652l0.002-5.261c0-0.173-0.070-0.339-0.194-0.461s-0.294-0.191-0.47-0.191h-4.964v-3.078c0-1.479 0.359-2.23 2.319-2.23l2.844-0.001c0.366 0 0.663-0.292 0.663-0.652v-4.885c0-0.36-0.297-0.652-0.663-0.652z"></path>
							</svg>
						</a>
					</li>
					<li class="pgcontato__item">
						<a href="<?php echo get_theme_mod( 'instagram' ); ?>">
							<svg id="icon-instagram" viewBox="0 0 34 32">
								<title>instagram</title>
								<path d="M23.229 0h-12.934c-5.256 0-9.533 4.276-9.533 9.533v12.934c0 5.256 4.276 9.533 9.533 9.533h12.934c5.256 0 9.533-4.276 9.533-9.533v-12.934c-0-5.256-4.277-9.533-9.533-9.533zM29.543 22.467c0 3.487-2.827 6.314-6.314 6.314h-12.934c-3.487 0-6.314-2.827-6.314-6.314v-12.934c0-3.487 2.827-6.314 6.314-6.314h12.934c3.487 0 6.314 2.827 6.314 6.314v12.934z"></path>
								<path d="M16.762 7.619c-4.621 0-8.381 3.76-8.381 8.381s3.76 8.381 8.381 8.381c4.621 0 8.381-3.76 8.381-8.381s-3.76-8.381-8.381-8.381zM16.762 21.121c-2.828 0-5.121-2.293-5.121-5.121s2.293-5.121 5.121-5.121c2.828 0 5.121 2.293 5.121 5.121s-2.293 5.121-5.121 5.121z"></path>
								<path d="M26.667 8.381c0 1.262-1.023 2.286-2.286 2.286s-2.286-1.023-2.286-2.286c0-1.262 1.023-2.286 2.286-2.286s2.286 1.023 2.286 2.286z"></path>
							</svg>
						</a>
					</li>
					<li class="pgcontato__item">
						<a href="<?php echo get_theme_mod( 'linkedin' ); ?>">
							<svg id="icon-linkedin" viewBox="0 0 34 32">
								<title>linkedin</title>
								<path d="M33.684 19.619v12.381h-7.22v-11.552c0-2.902-1.044-4.882-3.657-4.882-1.995 0-3.182 1.335-3.704 2.626-0.19 0.462-0.239 1.104-0.239 1.75v12.058h-7.222c0 0 0.097-19.565 0-21.592h7.221v3.061c-0.015 0.023-0.034 0.048-0.047 0.070h0.047v-0.070c0.959-1.469 2.673-3.568 6.508-3.568 4.752-0 8.314 3.086 8.314 9.718zM4.087 0c-2.471 0-4.087 1.611-4.087 3.73 0 2.072 1.569 3.733 3.991 3.733h0.048c2.518 0 4.085-1.66 4.085-3.733-0.047-2.119-1.566-3.73-4.037-3.73zM0.429 32h7.219v-21.592h-7.219v21.592z"></path>
							</svg>
						</a>
					</li>
				</ul>
			</div>
			<div class="pgcontato__formulario">
				<?php
					echo do_shortcode('[contact-form-7 id="4" title="Formulário de contato 1"]')
				?>
			</div>
		</div>
	</div>
<?php
get_sidebar();
get_footer();
