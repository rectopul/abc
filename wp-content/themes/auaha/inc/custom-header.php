<?php

/**
 * Sample implementation of the Custom Header feature
 *
 * You can add an optional custom header image to header.php like so ...
 *
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package auaha
 */

/**
 *  Insert Scripts (Java Script) and Styles
 */

function auaha_scripts_and_styles()
{
	if (!is_admin()) {
		/**
		 *  Styles
		 */

		// 	owl
		// wp_register_style('owl-css', get_stylesheet_directory_uri() . '/assets/css/owl.carousel.css', array(), '', 'all');
		// wp_enqueue_style( 'owl-css' );

		// 	style
		wp_register_style('theme-stylesheet', get_stylesheet_directory_uri() . '/assets/css/app.css', array(), '', 'all');
		wp_enqueue_style('theme-stylesheet');
	}
}


add_action('wp_enqueue_scripts', 'auaha_scripts_and_styles', 999);

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses auaha_header_style()
 */
function auaha_custom_header_setup()
{
	add_theme_support('custom-header', apply_filters('auaha_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => '000000',
		'width'                  => 1000,
		'height'                 => 250,
		'flex-height'            => true,
		'wp-head-callback'       => 'auaha_header_style',
	)));
}
add_action('after_setup_theme', 'auaha_custom_header_setup');
