<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Template Name: Search Shops
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package auaha
 */

get_header(); ?>

<div id="primary" class="search__container">
    <header>
        <div class="search__inputs state">
            <select name="selectState" id="selectState">
                <!-- loop wordpress -->
                <option value="">Selecione o estado</option>
                <?php

                $terms = get_terms(array(
                    'taxonomy' => 'shop_location',
                    'hide_empty' => false,
                ));


                foreach ($terms as $term) {
                    if (!$term->parent) {
                        printf(
                            '<option value="%s">%s</option>',
                            $term->term_id,
                            $term->name
                        );
                    }
                }

                ?>
            </select>
        </div>

        <div class="search__inputs city">
            <select name="selectState" id="selectCity" disabled>
                <option value="">Selecione a cidade</option>
            </select>
        </div>
    </header>

    <article>
        <!-- bloco news list -->
        <div class="local-list">


            <!-- loop -->

            <?php
            $args = array(
                'post_type' => 'shop',
                'posts_per_page' => 12
            );

            $query = new WP_Query($args);

            $cities = [];

            // The Loop
            if ($query->have_posts()) {
                $count = $query->post_count;

                echo  '<p class="col-lg-12 shops__result">' . $count . ' resultados encontrados:</p>';

                echo '<ul class="row">';

                while ($query->have_posts()) {
                    $query->the_post();

                    //Returns All Term Items for "my_taxonomy".
                    $term_list = wp_get_post_terms(get_the_ID(), 'shop_location', array('fields' => 'all'));

                    printf(
                        '<li>
                            <div class="shop__container">
                                <figure>%s</figure>
                                <article>
                                    <h3>%s</h3> 
                                    <aside>%s</aside>
                                    %s
                                </article>
                            </div>
                        </li>',
                        get_the_post_thumbnail(),
                        get_the_title(),
                        $term_list[0]->name,
                        get_the_content()
                    );
                }

                echo '</ul>';
            } else {
                echo 'Nenhuma loja cadastrada';
            }

            wp_reset_postdata();
            ?>
            <!-- /loop -->


        </div>

    </article>
</div>

<?php
get_footer();
