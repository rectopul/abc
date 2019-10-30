<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package auaha
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function auaha_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'auaha_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function auaha_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'auaha_pingback_header' );

//Adiciona um script para o WordPress
add_action('wp_enqueue_scripts', 'secure_enqueue_script');
function secure_enqueue_script()
{
	//Registra o Script
	wp_register_script('secure-ajax-access', esc_url(add_query_arg(array('js_global' => 1), site_url())));
	//Chama o script
    wp_enqueue_script('secure-ajax-access');
}

//Joga o nonce e a url para as requisições para dentro do Javascript criado acima
add_action('template_redirect', 'javascript_variaveis');
function javascript_variaveis()
{
    if (!isset($_GET['js_global'])) return;
	//Cria o Nonce para requisiçoes seguras
    $nonce = wp_create_nonce('filter');
	//joga os valores para o objeto json
    $variaveis_javascript = array(
        'filter_nonce' => $nonce, //Esta função cria um nonce para nossa requisição para buscar mais notícias, por exemplo.
        'xhr_url'             => admin_url('admin-ajax.php') // Forma para pegar a url para as consultas dinamicamente.
    );

    $new_array = array();
    foreach ($variaveis_javascript as $var => $value) $new_array[] = esc_js($var) . " : '" . esc_js($value) . "'";

    header("Content-type: application/x-javascript");
    printf('var %s = {%s};', 'js_global', implode(',', $new_array));
    exit;
}

add_action( 'wp_ajax_filter', 'filter_ajax_handler' );
add_action( 'wp_ajax_nopriv_filter', 'filter_ajax_handler' );
function filter_ajax_handler() {
	//Verify nonce
	if ( !wp_verify_nonce( $_REQUEST['nonce'], "filter")) {
		exit("No naughty business please");
	}

	function in_array_r($needle, $haystack, $strict = false) {
		foreach ($haystack as $item) {
			if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict))) {
				return true;
			}
		}
	
		return false;
	}

	if(isset($_POST['action']) &&  $_POST['action'] == "filter"){
		$args = [
			'posts_per_page' => 12,
			'meta_query' => [
				'relation' => 'AND',
				[
					'key' => 'cep', 
					'value' => $_POST['cepuser'],
					'compare' => '='
				]
			]
		];
		$categories = [];
		if($_POST['cepuser'] && !isset($_POST['type'])){
			$args['post_type'] = ['domestica', 'baba'];
			$query_post = new WP_Query($args);
			$response = [];
			
			if ($query_post->have_posts()) {
				while ($query_post->have_posts()) {
					$query_post->the_post();
					$theterms  = get_the_terms( get_the_ID(), 'type__'.get_post_type( get_the_ID() ));
					$toattrib = [];
					foreach ($theterms as $key => $term) {
						$toattrib[] = $term->name;
						if(!in_array_r($term->slug, $categories)){
							$categories[] = [
								'name' => $term->name,
								'slug' => $term->slug
							];
						}
					}
					
					$response['results'][] = [
						'title' => get_the_title(),
						'ID' => get_the_ID(),
						'atributo' => implode(',', $toattrib),
						'description' => get_field('descricao_curta'),
						'thumbnail' => get_the_post_thumbnail(get_the_ID(), 'profile', ['class' => 'thumb__funcionary']),
						'price' => get_field('salario')
					];
				}
			}else{
				$response['results'][] = [
					'erros' => true,
					'field' => 'cep',
					'message' => 'Não foram encontrados nenhum resultados pelo Cep Formecido!',
					'terms' => [
						'type'=> $_POST['type'],
						'atributo' => $_POST['professional_ttr'],
						'salary' => $_POST['price']
					]
				];
			}
			wp_reset_postdata();
		}else{

			if($_POST['type'])  $args['post_type'] = $_POST['type'];
			if($_POST['professional_ttr']){ 
				$args['tax_query'] = [
					'relation' => 'AND',
					[
						'taxonomy' => 'type__'.$_POST['type'],
						'field' => 'slug',
						'terms' => $_POST['professional_ttr'],
						'operator'	=> 'IN'
					]
				];
			}
			$compare = "BETWEEN";
			$price = $_POST['price'];
			if($_POST['price'][1] > 3001){ $compare = '>'; $price = $price = $_POST['price'][0]; }
			if($_POST['price']){
				$args['meta_query'][] = [
					[
						'key' => 'salario',
						'value' => $price,
						'compare' => $compare
					]
				];
			}

			$query_post = new WP_Query($args);
			$response = [];
			if ($query_post->have_posts()) {
				while ($query_post->have_posts()) {
					$query_post->the_post();
					$theterms  = get_the_terms( get_the_ID(), 'type__'.get_post_type( get_the_ID() ));
					$toattrib = [];
					foreach ($theterms as $key => $term) {
						$toattrib[] = $term->name;
						if(!in_array_r($term->slug, $categories)){
							$categories[] = [
								'name' => $term->name,
								'slug' => $term->slug
							];
						}
					}

					$response['results'][] = [
						'title' => get_the_title(),
						'ID' => get_the_ID(),
						'atributo' => implode(',', $toattrib),
						'description' => get_field('descricao_curta'),
						'thumbnail' => get_the_post_thumbnail(get_the_ID(), 'profile', ['class' => 'thumb__funcionary']),
						'price' => get_field('salario')
					];
				}
			}else{
				$response['results'][] = [
					'erros' => true,
					'message' => 'Não foram encontrados nenhum resultados pelos termos fornecidos!',
					'terms' => [
						'type'=> $_POST['type'],
						'atributo' => $_POST['professional_ttr'],
						'salary' => $_POST['price']
					]
				];
			} 
			wp_reset_postdata();
		}
		//$categories = array_unique($categories);
		$response['categorias'] = $categories;
		echo json_encode($response);
	}
    // Handle the ajax request
    wp_die(); // All ajax handlers die when finished
}

