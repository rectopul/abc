<?php

/**
 * Rotas api
 */

add_action('rest_api_init', function () {
    register_rest_route('filter/v1', '/city/(?P<id>\d+)', array(
        'methods' => 'GET',
        'callback' => 'api_get_cities',
    ));
});

function api_get_cities($data)
{
    $terms = get_terms(array(
        'taxonomy' => 'shop_location',
        'hide_empty' => false,
    ));

    $cities = [];

    foreach ($terms as $term) {
        if ($term->parent == $data['id']) $cities[] = $term;
    }

    return $cities;
}

/**
 * Rotas api
 * Get shops by tax id
 */
add_action('rest_api_init', function () {
    register_rest_route('filter/v1', '/shops/(?P<id>\d+)', array(
        'methods' => 'GET',
        'callback' => 'api_get_shops',
    ));
});

/**
 * Grab latest post title by an author!
 *
 * @param array $data Options for the function.
 * @return string|null Post title for the latest,  * or null if none.
 */
function api_get_shops($data)
{

    $args = array(
        'post_type' => 'shop',
        'tax_query' => [
            [
                'taxonomy' => 'shop_location',
                'field' => 'term_id',
                'terms' => $data['id']
            ]
        ]
    );

    $query = new WP_Query($args);

    $cities = [];

    // The Loop
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();

            $cities[] = [
                'title' => get_the_title(),
                'image' => get_the_post_thumbnail(),
                'content' => get_the_content(),
                'link' => get_the_permalink(),
                'ID' => get_the_id()
            ];
        }
    }

    wp_reset_postdata();

    return $cities;
}
