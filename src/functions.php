<?php
/**
 * auaha functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package auaha
 */

 define('WP_SITEURL', 'http://' . $_SERVER['HTTP_HOST'] );
 define('WP_HOME', 'http://' . $_SERVER['HTTP_HOST'] );

 add_filter('wp_calculate_image_sizes', 'lc_content_archive_thumbnail_image_sizes', 10, 5);
/**
 * Change the default "sizes" attribute created by WordPress
 * for the content archive thumbnails
 */
function lc_content_archive_thumbnail_image_sizes($sizes, $size, $image_src, $image_meta, $attachment_id)
{
    if (is_archive() && is_main_query() || is_home()) {
        $sizes = '(max-width: 320px) 280px, (max-width: 480px) 440px';
    }
    return $sizes;
}

if ( ! function_exists( 'auaha_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function auaha_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on auaha, use a find and replace
	 * to change 'auaha' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'auaha', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
    add_theme_support( 'title-tag' );
    add_theme_support('post-thumbnails');

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
    add_image_size( 'profile', 480, 350, true ); 

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Primary', 'auaha' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'auaha_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support( 'custom-logo', array(
		'height'      => 250,
		'width'       => 250,
		'flex-width'  => true,
		'flex-height' => true,
	) );
}
endif;
add_action( 'after_setup_theme', 'auaha_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function auaha_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'auaha_content_width', 640 );
}
add_action( 'after_setup_theme', 'auaha_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function auaha_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'auaha' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'auaha' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'auaha_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function auaha_scripts() {
	wp_enqueue_style( 'auaha-style', get_stylesheet_uri() );
	//
    wp_enqueue_script( 'scripts-theme', get_template_directory_uri() . '/js/app.js', array('jquery'), '0.0.1', true );
    /**
     * Bootstrap 
     * */
    wp_enqueue_style('bootstrap-css', get_template_directory_uri() . '/frameworks/bootstrap/bootstrap.min.css', false, '4.2.1', 'all');
    wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/frameworks/bootstrap/bootstrap.min.js', array('jquery'), '4.2.1', true );
	// //
	// // wp_enqueue_script( 'auaha-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'auaha_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';


//Modificar los campos Autor, Email y Sitio web del formulario de comentarios
function apk_modify_comment_fields( $fields ) {

    //Variables necesarias para que esto funcione
    $commenter = wp_get_current_commenter();
    $aria_req = ( $req ? " aria-required='true'" : '' );

    $fields =  array(
        'name' =>
            '<input id="author" name="author" type="text" value="" size="30"' . $aria_req . ' placeholder="' . __('Nome', 'apk') . '" />',
		'email' =>
			'<input id="email" name="email" type="text" value="" size="30"' . $aria_req . ' placeholder="' . __('E-mail', 'apk') . '" />',
        'message' =>
            '<textarea id="comment1" name="comment" cols="45" rows="5" maxlength="65525"'. $aria_req . ' placeholder="' . __('Escreva seu comentário...', 'apk') . '"></textarea>',
    );

    return $fields;

}
add_filter('comment_form_default_fields', 'apk_modify_comment_fields');

function lkz_info_extra($customizer) {
   
   $customizer->add_setting('telefone',
       array(
           'default' => ''
       )
   );

   $customizer->add_control('control_telefone',
       array(
           'label'     => 'Telefone',
           'type'        => 'text',
           'section'    => 'title_tagline',
           'settings'    => 'telefone'
       )
   );

   $customizer->add_setting('telefone2',
       array(
           'default' => ''
       )
   );

   $customizer->add_control('control_telefone2',
       array(
           'label'     => 'Telefone 2',
           'type'        => 'text',
           'section'    => 'title_tagline',
           'settings'    => 'telefone2'
       )
   );
   
   $customizer->add_setting('facebook',
       array(
           'default' => ''
       )
   );

   $customizer->add_control('control_facebook',
       array(
           'label'     => 'Facebook',
           'type'        => 'text',
           'section'    => 'title_tagline',
           'settings'    => 'facebook'
       )
   );

   $customizer->add_setting('instagram',
       array(
           'default' => ''
       )
   );

   $customizer->add_control('control_instagram',
       array(
           'label'     => 'Instagram',
           'type'        => 'text',
           'section'    => 'title_tagline',
           'settings'    => 'instagram'
       )
   );

   $customizer->add_setting('youtube',
       array(
           'default' => ''
       )
   );

   $customizer->add_control('control_youtube',
       array(
           'label'     => 'Youtube',
           'type'        => 'text',
           'section'    => 'title_tagline',
           'settings'    => 'youtube'
       )
   );

   $customizer->add_setting('email',
       array(
           'default' => ''
       )
   );

   $customizer->add_control('control_email',
       array(
           'label'     => 'E-mail',
           'type'        => 'text',
           'section'    => 'title_tagline',
           'settings'    => 'email'
       )
   );


   $customizer->add_setting('diferencial',
       array(
           'default' => ''
       )
   );

   $customizer->add_control('control_diferencial',
       array(
           'label'     => 'Nosso Diferencial',
           'type'        => 'textarea',
           'section'    => 'title_tagline',
           'settings'    => 'diferencial'
       )
   );

   $customizer->add_setting('visao',
       array(
           'default' => ''
       )
   );

   $customizer->add_control('control_visao',
       array(
           'label'     => 'Visão',
           'type'        => 'textarea',
           'section'    => 'title_tagline',
           'settings'    => 'visao'
       )
   );

   $customizer->add_setting('missao',
       array(
           'default' => ''
       )
   );

   $customizer->add_control('control_missao',
       array(
           'label'     => 'Missão',
           'type'        => 'textarea',
           'section'    => 'title_tagline',
           'settings'    => 'missao'
       )
   );

   $customizer->add_setting('copyright',
       array(
           'default' => ''
       )
   );

   $customizer->add_control('control_copyright',
       array(
           'label'     => 'Copyright',
           'type'        => 'textarea',
           'section'    => 'title_tagline',
           'settings'    => 'copyright'
       )
   );
}

add_action( 'customize_register', 'lkz_info_extra' );

function wordpress_pagination() {
	global $wp_query;

	$big = 999999999;

	echo paginate_links( array(
		  'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		  'format' => '?paged=%#%',
		  'current' => max( 1, get_query_var('paged') ),
		  'total' => $wp_query->max_num_pages
	) );
}

add_action( 'init', 'create_post_type_fullbanner' );
function create_post_type_fullbanner() {
    register_post_type( 'fullbanner',
        array(
            'labels' => array(
                'name' => __( 'Fullbanner' ),
                'singular_name' => __( 'fullbanner' )
            ),
            'public' => true,
			'supports'  => array( 'title', 'thumbnail')
        )
    );
}
 
add_action( 'init', 'create_post_type_funciona' );
function create_post_type_funciona() {
    register_post_type( 'funciona',
        array(
            'labels' => array(
                'name' => __( 'Como funciona' ),
                'singular_name' => __( 'Como funciona' )
            ),
            'public' => true,
			'supports'  => array( 'title', 'thumbnail', 'editor')
        )
    );
}

add_action( 'init', 'create_post_type_sobre' );
function create_post_type_sobre() {
    register_post_type( 'sobre',
        array(
            'labels' => array(
                'name' => __( 'Sobre' ),
                'singular_name' => __( 'Sobre' )
            ),
            'public' => true,
			'supports'  => array( 'title', 'thumbnail', 'editor')
        )
    );
}

add_action( 'init', 'create_post_type_depoimentos' );
function create_post_type_depoimentos() {
    register_post_type( 'depoimentos',
        array(
            'labels' => array(
                'name' => __( 'Depoimentos' ),
                'singular_name' => __( 'Depoimentos' )
            ),
            'public' => true,
			'supports'  => array( 'title', 'thumbnail', 'editor')
        )
    );
}

add_action( 'init', 'create_post_type_servicos' );
function create_post_type_servicos() {
    register_post_type( 'servicos',
        array(
            'labels' => array(
                'name' => __( 'Serviços' ),
                'singular_name' => __( 'Serviços' )
            ),
            'public' => true,
			'supports'  => array( 'title', 'thumbnail', 'editor')
        )
    );
}





function custom_types(){
    /**
     * Post Type Babá
     */
    $baba = array(
        'labels' => array(
            'name' => __('Babás'),
            'singular_name' => __('Babá')
        ),
        'has_archive' => true,
        'public' => true,
        'rewrite' => array('slug' => 'baba'),
        'menu_icon' => 'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHg9IjBweCIgeT0iMHB4IiB3aWR0aD0iNTEyIiBoZWlnaHQ9IjUxMiIgdmlld0JveD0iMCAwIDMxLjk4IDMxLjk4IiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCAzMS45OCAzMS45ODsiIHhtbDpzcGFjZT0icHJlc2VydmUiIGNsYXNzPSJob3ZlcmVkLXBhdGhzIj48Zz48Zz4KCTxnPgoJCTxwYXRoIGQ9Ik0yNy4yMywxOS45MjNjMS4zOTksMCwyLjUzNS0xLjEzNSwyLjUzNS0yLjUzOWMwLTAuODc0LDAuMzA4LTEuNjc2LTAuMzY5LTIuMTNjLTAuNDAyLTAuMjc1LTIuMTg0LTAuNDA2LTIuNzA5LTAuNDA2ICAgIGMtMC42MjUsMC0xLjQzOCwwLjUxLTEuODgxLDAuODg1Yy0wLjU1LDAuNDY1LTAuMTE1LDAuODc0LTAuMTE1LDEuNjVDMjQuNjkxLDE4Ljc4OSwyNS44MjYsMTkuOTIzLDI3LjIzLDE5LjkyM3ogTTI1LjQ2MiwxNy4xMzYgICAgYzAuNDY1LTAuMDg1LDAuNzgzLDAuMDY4LDAuNzgzLDAuMDY4bDAuNzc2LTAuMzc5YzAsMC0wLjM5NiwwLjU3NC0wLjAzOSwwLjM3OWMwLjc5MS0wLjI2OSwxLjY4MS0wLjE1NSwyLjEzMS0wLjA2NiAgICBjMC4wMTcsMC4xLDAuMDI5LDAuMiwwLjAyOSwwLjMwNWMwLDEuMDQ1LTAuODI4LDEuODkxLTEuODU2LDEuODkxYy0xLjAyNCwwLTEuODU0LTAuODQ2LTEuODU0LTEuODkxICAgIEMyNS40MzIsMTcuMzM4LDI1LjQ0NSwxNy4yMzgsMjUuNDYyLDE3LjEzNnoiIGRhdGEtb3JpZ2luYWw9IiMwMDAwMDAiIGNsYXNzPSJhY3RpdmUtcGF0aCIgc3R5bGU9ImZpbGw6IzAwMDAwMCI+PC9wYXRoPgoJCTxwYXRoIGQ9Ik0zMS45NjQsMjMuOTY0bC0yLjk0OC0zLjYyNWgtMy4yODNsLTEuNzAxLTEuNDhjMC4wMDMtMC4wMDksMC4wMDctMC4wMTcsMC4wMS0wLjAyNUwyMy4wNzMsMTggICAgYy0wLjAwMywwLjAwNC0wLjAwOSwwLjAwOC0wLjAxMywwLjAxM2wtMS4xNzQtMS4wMjFsMC4zMjctMC4xMzFsLTIuODk3LTguMzQzaDEuMDI5aDAuNjkzbC0wLjMyNS0wLjYxNCAgICBjLTAuMDA4LTAuMDE1LTAuNzM3LTEuNDExLTEuMDIyLTIuNzM2YzAtMC4wMTksMC4wMDYtMC4wMzQsMC4wMDYtMC4wNTRjMC0wLjI1Ny0wLjA0LTAuNTA2LTAuMDk4LTAuNzQ4ICAgIGMtMC4wMDQtMC4wNzUtMC4wMS0wLjE0OC0wLjAxMy0wLjIyN2MtMC4wNDItMS4yMTQtMC4xMDEtMi44NzgtMi45OTktMi44NzhjLTEuMTI4LDAtMS45ODMsMC4yOTMtMi41NDUsMC44NzIgICAgYy0wLjc5MywwLjgxMy0wLjg2MSwyLjAyOC0wLjgzNCwyLjk5NWMwLjA0NCwxLjU1Ny0wLjkwMSwyLjY5LTAuOTA5LDIuNzAzTDExLjcxNSw4LjUyaDEuNjkybC0yLjg4MSw4LjM1MUwxMC44NDksMTcgICAgbC0xLjE0MywwLjk5NGMtMC4zLTAuMzY1LTAuNzg5LTAuNjY2LTEuNTAxLTAuNzk3Yy0wLjAxOS0wLjM0My0wLjA4Ni0wLjY3NC0wLjIxLTAuOTc3Yy0wLjE1OC0wLjkxMy0wLjY4MS0yLjE1OS0yLjQ4NS0yLjIwMSAgICBjLTIuMzE1LTAuMDU2LTMuMTE1LDEuODAyLTMuMjA4LDIuNjk2Yy0wLjAyOSwwLjEzNC0wLjAzNywwLjI3NC0wLjA0NywwLjQxNGMtMS43NDUsMC4zMDYtMi45NzcsMy4xNjctMC40ODksMy4xODggICAgYy0wLjEwMS0wLjk1MywwLjMxOC0xLjg0MywwLjU1OC0yLjI2NGMwLjMxOSwxLjMxMSwxLjQ5NiwyLjI5MiwyLjkwMiwyLjI5MmMxLjQ2NywwLDIuNjg1LTEuMDYzLDIuOTQtMi40NTkgICAgYzAuMTQ4LDAuMTY1LDAuMzg4LDAuNDg4LDAuNTU5LDAuOTYzbC0xLjgwNiwxLjU3MUg1Ljg2Mkg0LjYwNEgzLjQzOEwwLDI0LjQ0OXYwLjY4NWwwLjExMi0wLjAyOGwwLjY0LDAuMTU5bDIuODI2LTMuMDk3ICAgIGwwLjEwMiwxLjI4N0wxLjc5MiwyNy4xNGgxLjkxNnYzLjIwNEgzLjM4NHYwLjM3NUg0Ljg2di0wLjM3NVYyNy4xNGgwLjU1NHYzLjIwNGgwLjAwM3YwLjM3NWgxLjQ3N3YtMC4zNzVINi41NjhWMjcuMTRIOS4wNCAgICBsLTIuMTQzLTMuNjg2bDAuMTE5LTEuNTYzbDEuODc4LTEuODA4Yy0wLjAwNCwwLjA3OCwwLjAwMiwwLjE1LTAuMDA4LDAuMjM0YzAuNzc5LTAuMDIxLDEuMjM5LTAuNjc2LDEuMTk5LTEuMzg2bDEuNjM4LTEuNTggICAgbC0wLjM1OC0wLjE0NmwwLjc2MywwLjMwNWwxLjc5Ny00LjkzbDAuMTgsMi4yODVsLTIuOTAzLDguMDM4aDMuMzUxdjYuOTk4SDE0LjExdjAuODE2aDIuMDAzdi0wLjgxNnYtNi45OThoMC43NXY2Ljk5OHYwLjgxNiAgICBoMi4wMDR2LTAuODE2aC0wLjQzOXYtNi45OThoMi42bC0yLjU2Mi04LjAzOGwwLjE0LTIuODEzbDEuOTg4LDUuNDU4bDAuMjc0LTAuMTA5bDAuMTU3LTAuMDYzbDQuMjUsNC44MTJsMC4xMjMsNC44MmgwLjUwNHYzLjE2MyAgICBoLTAuMzE5djAuMzcxaDEuNDU5di0wLjM3MVYyNi45N2gwLjU0NnYzLjE2M3YwLjM3MWgxLjQ1OHYtMC4zNzFoLTAuMzE5VjI2Ljk3aDAuNjExdi00LjA4M2wyLjAxMiwyLjA2NWwwLjYzMS0wLjE1N3YtMC44NDkgICAgTDMxLjk2NCwyMy45NjR6IE01LjIyNywxOS40OThjLTEuMTg0LDAtMi4xNDctMC45NjMtMi4xNDctMi4xNDljMC0wLjAyMiwwLjAwNi0wLjA0MywwLjAwNi0wLjA2N2wwLjA0Ni0wLjAzNyAgICBjMCwwLDEuNTI2LDAuMTc3LDIuMDExLDAuMDQ1di0xLjE0MmMwLDAsMC43NjQsMS40NDksMS4yMDMsMS4yOTZjMC0wLjgzNCwwLjI1NC0wLjkyMiwwLjI1NC0wLjkyMnMwLjMyNiwwLjc3NywwLjc2OSwwLjkwNSAgICBDNy4zMjQsMTguNTc0LDYuMzg0LDE5LjQ5OCw1LjIyNywxOS40OTh6IE0xNy4yMTksNy4zMzZsLTAuMDA0LDAuODcxbC0wLjAwMSwwLjE0OWwtMC44NDgsMS4yODZsLTAuODUzLTEuMjA3VjguMTA4VjcuNjcydi0wLjQ2ICAgIGMtMC43OC0wLjM3OS0xLjMyMy0xLjE3Mi0xLjMyMy0yLjA5N2MwLTAuMzg5LDAuMTA0LTAuNzUxLDAuMjczLTEuMDc0bDEuMjMzLTAuMTE3bDIuOTc2LDAuMjc0ICAgIGMwLjEyLDAuMjgxLDAuMTg4LDAuNTkyLDAuMTg4LDAuOTE3QzE4Ljg2MSw2LjE2MSwxOC4xNjYsNy4wMzgsMTcuMjE5LDcuMzM2eiIgZGF0YS1vcmlnaW5hbD0iIzAwMDAwMCIgY2xhc3M9ImFjdGl2ZS1wYXRoIiBzdHlsZT0iZmlsbDojMDAwMDAwIj48L3BhdGg+Cgk8L2c+CjwvZz48L2c+IDwvc3ZnPg==',
        'show_in_rest' => true,
        'supports' => array('author', 'title', 'excerpt', 'thumbnail')
    );
    register_post_type('baba', $baba);
    /**
     * Post Type Domestica
    */
    $domestica = array(
        'labels' => array(
            'name' => __('Domésticas'),
            'singular_name' => __('Doméstica')
        ),
        'has_archive' => true,
        'public' => true,
        'rewrite' => array('slug' => 'domestica'),
        'menu_icon' => 'dashicons-businesswoman',
        'show_in_rest' => true,
        'supports' => array('author', 'title', 'excerpt', 'thumbnail')
    );
    register_post_type('domestica', $domestica);
}

add_action('init', 'custom_types');

/**
 * Taxonomias
 */
function reg_cat(){
    /**
     * Tipos de Babás
     */
    $domestic = array(
        'name' => _x('Tipos de Domésticas', 'taxonomy general name'),
        'singular_name' => _x('Tipo de Doméstica', 'taxonomy singular name'),
        'search_items' =>  __('Search Tipos de Domésticas'),
        'popular_items' => __('Popular Tipos de Domésticas'),
        'all_items' => __('Todos os Tipos de Domésticas'),
        'parent_item' => null,
        'parent_item_colon' => null,
        'edit_item' => __('Editar Tipo de Doméstica'),
        'update_item' => __('Atualizar Tipo de Doméstica'),
        'add_new_item' => __('Adicionar Novo Tipo de Doméstica'),
        'new_item_name' => __('Novo Tipo de Doméstica'),
        'separate_items_with_commas' => __('Separate Tipos de Domésticas with commas'),
        'add_or_remove_items' => __('Add or remove Tipos de Domésticas'),
        'choose_from_most_used' => __('Choose from the most used Tipos de Domésticas'),
        'menu_name' => __('Tipo de Doméstica'),
    );
    register_taxonomy('type__domestica', array('domestica'), array(
        'hierarchical' => true,
        'labels' => $domestic,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'show_in_rest' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => true,
        'rewrite' => array('slug' => 'tipos'),
    ));

    $baba = array(
        'name' => _x('Tipos de Babás', 'taxonomy general name'),
        'singular_name' => _x('Tipo de Baba', 'taxonomy singular name'),
        'search_items' =>  __('Search Tipos de Babás'),
        'popular_items' => __('Popular Tipos de Babás'),
        'all_items' => __('Todos os Tipos de Babás'),
        'parent_item' => null,
        'parent_item_colon' => null,
        'edit_item' => __('Editar Tipo de Babá'),
        'update_item' => __('Atualizar Tipo de Babá'),
        'add_new_item' => __('Adicionar Novo Tipo de Babá'),
        'new_item_name' => __('Novo Tipo de Babá'),
        'separate_items_with_commas' => __('Separate Tipos de Babás with commas'),
        'add_or_remove_items' => __('Add or remove Tipos de Babás'),
        'choose_from_most_used' => __('Choose from the most used Tipos de Babás'),
        'menu_name' => __('Tipo de Babá'),
    );
    register_taxonomy('type__baba', array('baba'), array(
        'hierarchical' => true,
        'labels' => $baba,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'show_in_rest' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => true,
        'rewrite' => array('slug' => 'tipos'),
    ));
}
add_action('init', 'reg_cat');