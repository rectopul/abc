<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package auaha
 */

?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?> 
    <script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.2/dist/jquery.fancybox.min.css" />
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.2/dist/jquery.fancybox.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.6/ScrollMagic.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.6/plugins/debug.addIndicators.min.js"></script>
    
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.9.0/slick/slick.min.js"></script>
    
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/owl/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/owl/owl.theme.default.min.css">
    <link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/img/favico.png" type="image/x-icon">
    <link rel="icon" href="<?php bloginfo('template_directory'); ?>/img/favico.png" type="image/x-icon">
    
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css"/>
</head>

<body <?php body_class(); ?>>
    <header class="header-full">
        <div class="menu-header">
            <div class="container">
                <div class="menu__topo">
                    <div class="social-menu">
                        <?php wp_nav_menu(array('menu' => 'menu', 'container' => 'nav', 'container_class' => 'nav_menu', 'menu_class' => 'menu')); ?>
                    </div>
                    <a class="logo_img" href="<?php echo get_home_url(); ?>"><img src="<?php bloginfo('template_directory'); ?>/img/logo.jpg"></a>
                    <div class="social-menu second">
                        <?php wp_nav_menu(array('menu' => 'menu2', 'container' => 'nav', 'container_class' => 'nav_menu', 'menu_class' => 'menu')); ?>
                    </div>
                </div>
                <div class="menu-resp">
                    <div class="menu-resp-pic">
                        <a href="#" class="slide-menu-open">
                            <svg id="icon-line-menu" viewBox="0 0 32 32">
                                <title>line-menu</title>
                                <path fill="#7f7f7f" style="fill: var(--color1, #7f7f7f)" d="M2.642 6.717c-1.509 0-2.642-1.132-2.642-2.641s1.132-2.717 2.642-2.717h26.642c1.509 0 2.717 1.208 2.717 2.717s-1.208 2.642-2.717 2.642h-26.642z"></path>
                                <path fill="#7f7f7f" style="fill: var(--color1, #7f7f7f)" d="M29.283 13.283c1.509 0 2.717 1.208 2.717 2.717s-1.208 2.642-2.717 2.642h-26.642c-1.509 0-2.642-1.132-2.642-2.642s1.132-2.717 2.642-2.717h26.642z"></path>
                                <path fill="#7f7f7f" style="fill: var(--color1, #7f7f7f)" d="M29.283 25.283c1.509 0 2.717 1.132 2.717 2.642s-1.208 2.717-2.717 2.717h-26.642c-1.509 0-2.642-1.208-2.642-2.717s1.132-2.642 2.642-2.642h26.642z"></path>
                            </svg>
                        </a>
                        <a class="logo_img" href="<?php echo get_home_url(); ?>"><img src="<?php bloginfo('template_directory'); ?>/img/logo.jpg"></a>
                    </div>
                    <div class="side-menu-overlay" style="width: 0px; opacity: 0;"></div>
                    <div class="side-menu-wrapper">
                        <a href="#" class="menu-close">&times;</a>
                        <div class="social-menu">
                            <?php wp_nav_menu(array('menu' => 'menu', 'container' => 'nav', 'container_class' => 'nav_menu', 'menu_class' => 'menu')); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
