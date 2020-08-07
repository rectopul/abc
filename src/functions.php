<?php

/**
 * Theme Setup
 * get all supports and menus for this theme
 * List all functions into this function
 */
if (!function_exists('rmb_theme_setup')) {
    function rmb_theme_setup()
    {
    }
}

function rmb_theme_setup_support()
{

    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');

    // Custom background color.
    add_theme_support(
        'custom-background',
        array(
            'default-color' => 'f5efe0',
        )
    );

    // Set content-width.
    global $content_width;
    if (!isset($content_width)) {
        $content_width = 580;
    }

    /*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
    add_theme_support('post-thumbnails');

    // Set post thumbnail size.
    set_post_thumbnail_size(1200, 9999);

    // Add custom image size used in Cover Template.
    add_image_size('theme-fullscreen', 1980, 9999);

    // Custom logo.
    $logo_width  = 120;
    $logo_height = 90;

    // If the retina setting is active, double the recommended width and height.
    if (get_theme_mod('retina_logo', false)) {
        $logo_width  = floor($logo_width * 2);
        $logo_height = floor($logo_height * 2);
    }

    add_theme_support(
        'custom-logo',
        [
            'height'      => $logo_height,
            'width'       => $logo_width,
            'flex-height' => true,
            'flex-width'  => true,
        ]
    );

    /**
     * Add Support to custom header in pages
     */
    $header = [
        'default-text-color' => 'fff',
        'width'              => 1000,
        'height'             => 250,
        'flex-width'         => true,
        'flex-height'        => true,
    ];

    add_theme_support('custom-header', $header);

    /*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
    add_theme_support('title-tag');

    /*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
    add_theme_support(
        'html5',
        array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'script',
            'style',
        )
    );

    /*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Twenty Twenty, use a find and replace
	 * to change 'twentytwenty' to the name of your theme in all the template files.
	 */
    load_theme_textdomain('auaha');

    // Add support for full and wide align images.
    add_theme_support('align-wide');

    // Add support for responsive embeds.
    add_theme_support('responsive-embeds');

    // Add theme support for selective refresh for widgets.
    add_theme_support('customize-selective-refresh-widgets');
}

add_action('after_setup_theme', 'rmb_theme_setup_support');

/**
 * Register navigation menus uses wp_nav_menu in five places.
 */
function rmb_theme_menus()
{

    $locations = array(
        'primary'  => __('Desktop Horizontal Menu', 'twentytwenty'),
        'expanded' => __('Desktop Expanded Menu', 'twentytwenty'),
        'mobile'   => __('Mobile Menu', 'twentytwenty'),
        'footer'   => __('Footer Menu', 'twentytwenty'),
        'social'   => __('Social Menu', 'twentytwenty'),
    );

    register_nav_menus($locations);
}

add_action('init', 'rmb_theme_menus');

/**
 * Register and Enqueue Scripts.
 */
function rmb_register_scripts()
{

    wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js', array('jquery'), '', true);
    //wp_style_add_data('twentytwenty-style', 'rtl', 'replace');

    // Add output of Bootstrap settings as inline style.
    wp_add_inline_style('bootstrap-style', get_template_directory_uri() . '/vendor/twbs/bootstrap/dist/css/bootstrap.min.css');
}

add_action('wp_enqueue_scripts', 'rmb_register_scripts');
/**
 * Register and Enqueue Styles.
 */
function rmb_register_styles()
{

    //$theme_version = wp_get_theme()->get('Version');

    wp_enqueue_style('theme-style', get_template_directory_uri() . '/assets/css/app.css');
    //wp_style_add_data('twentytwenty-style', 'rtl', 'replace');

    // Add output of Bootstrap settings as inline style.
    wp_enqueue_style('bootstrap-style', get_template_directory_uri() . '/vendor/twbs/bootstrap/dist/css/bootstrap.min.css');

    //add font overpass
    //https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap

    wp_enqueue_style('google-fonts-overpass', 'https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap', false);
}

add_action('wp_enqueue_scripts', 'rmb_register_styles');


/**
 * Implement get theme mods.
 */
require get_template_directory() . '/inc/getThemeMods.php';
// Register Custom Navigation Walker 
require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';
require_once get_template_directory() . '/inc/rmbCustomControls.php';
/**
 * Implement the Custom Controls form madison.
 */
require get_template_directory() . '/inc/madison/functions.php';


function custom_types()
{
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

    $fullBanner = array(
        'labels' => array(
            'name' => __('Full Banners'),
            'singular_name' => __('Full Banner')
        ),
        'has_archive' => true,
        'public' => true,
        'rewrite' => array('slug' => 'fullBanner'),
        'menu_icon' => 'dashicons-images-alt',
        'show_in_rest' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'custom-fields')
    );

    register_post_type('fullBanner', $fullBanner);
}

add_action('init', 'custom_types');

/**
 * Taxonomias
 */
function reg_cat()
{
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
    register_taxonomy('type_domestica', array('domestica'), array(
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

if (!function_exists('wp_body_open')) {

    /**
     * Shim for wp_body_open, ensuring backward compatibility with versions of WordPress older than 5.2.
     */
    function wp_body_open()
    {
        do_action('wp_body_open');
    }
}
