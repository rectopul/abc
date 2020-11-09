<?php
function custom_types()
{

    /**
     * Post Type Videos
     * custom post specific from this theme
     */
    $shop = array(
        'labels' => array(
            'name' => __('Lojas'),
            'singular_name' => __('Loja')
        ),
        'has_archive' => true,
        'public' => true,
        'rewrite' => array('slug' => 'shops'),
        'menu_icon' => 'dashicons-youtube',
        'show_in_rest' => true,
        'taxonomies' => array('post_tag'),
        'supports' => array('title', 'editor', 'author', 'excerpt', 'thumbnail')
    );

    register_post_type('shop', $shop);
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
    $labels = array(
        'name' => _x('Localização de Lojas', 'taxonomy general name'),
        'singular_name' => _x('Localização de Loja', 'taxonomy singular name'),
        'search_items' =>  __('Search Localização de Lojas'),
        'popular_items' => __('Popular Localização de Lojas'),
        'all_items' => __('Todas as Localização de Lojas'),
        'parent_item' => null,
        'parent_item_colon' => null,
        'edit_item' => __('Editar Localização de Loja'),
        'update_item' => __('Atualizar Localização de Loja'),
        'add_new_item' => __('Adicionar Nova Localização de Loja'),
        'new_item_name' => __('Nova Localização de Loja'),
        'separate_items_with_commas' => __('Separate Localização de Lojas with commas'),
        'add_or_remove_items' => __('Add or remove Localização de Lojas'),
        'choose_from_most_used' => __('Choose from the most used Localização de Lojas'),
        'menu_name' => __('Localização de Loja'),
    );
    register_taxonomy('shop_location', array('shop'), array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'show_in_rest' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => true,
        'rewrite' => array('slug' => 'shop_location'),
    ));
}

add_action('init', 'reg_cat');
