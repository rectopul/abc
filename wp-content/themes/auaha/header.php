<?php

/**
 * Header file for the Twenty Twenty WordPress default theme.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

?>
<!DOCTYPE html>

<html class="no-js" <?php language_attributes(); ?>>

<head>

    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="profile" href="https://gmpg.org/xfn/11">

    <?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

    <?php
    wp_body_open();
    ?>

    <header class="headerFull" style="background-image: url(<?php header_image(); ?>);">
        <div class="container">
            <nav class="navbar navbar-expand-md navbar-dark" role="navigation">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-controls="bs-example-navbar-collapse-1" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo home_url(); ?>">
                        <?php if (function_exists('the_custom_logo')) the_custom_logo(); ?>
                    </a>
                    <?php
                    if (has_nav_menu('primary')) {

                        wp_nav_menu(array(
                            'theme_location' => 'primary',
                            'depth' => 2,
                            'container' => 'div',
                            'container_class' => 'collapse navbar-collapse text-white',
                            'container_id' => 'bs-example-navbar-collapse-1',
                            'menu_class' => 'nav navbar-nav ml-md-auto',
                            'walker' => new WP_Bootstrap_Navwalker()
                        ));
                    } elseif (!has_nav_menu('expanded')) {

                        wp_list_pages(
                            array(
                                'match_menu_classes' => true,
                                'show_sub_menu_icons' => true,
                                'title_li' => false,
                            )
                        );
                    }

                    ?>
                </div>
            </nav>

            <div class="headerTitle col mt-5">
                <?php get_header_message(); ?>
            </div>
        </div>
    </header>