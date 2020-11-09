<?php
/**
 * Ocean WP integration
 */

add_action( 'elementor/page_templates/canvas/before_content', 'jet_woo_oceanwp_open_site_main_wrap', -999 );
add_action( 'jet-woo-builder/blank-page/before-content', 'jet_woo_oceanwp_open_site_main_wrap', -999 );
add_action( 'elementor/page_templates/header-footer/before_content', 'jet_woo_oceanwp_open_site_main_wrap', -999 );
add_action( 'jet-woo-builder/full-width-page/before-content', 'jet_woo_oceanwp_open_site_main_wrap', -999 );

add_action( 'elementor/page_templates/canvas/after_content', 'jet_woo_oceanwp_close_site_main_wrap', 999 );
add_action( 'jet-woo-builder/blank-page/after_content', 'jet_woo_oceanwp_close_site_main_wrap', 999 );
add_action( 'elementor/page_templates/header-footer/after_content', 'jet_woo_oceanwp_close_site_main_wrap', 999 );
add_action( 'jet-woo-builder/full-width-page/after_content', 'jet_woo_oceanwp_close_site_main_wrap', 999 );

add_action( 'elementor/widgets/widgets_registered', 'jet_woo_oceanwp_fix_wc_hooks' );

add_action( 'wp_enqueue_scripts', 'jet_woo_oceanwp_enqueue_styles' );

add_filter( 'ocean_post_layout_class', 'jet_woo_oceanwp_display_sidebar' );

function jet_woo_oceanwp_display_sidebar( $class ){

	if ( get_post_type() === 'jet-woo-builder' ){
		$class = 'full-width';
	}

	return $class;

}

/**
 * Fix WooCommerce hooks for oceanwp
 *
 * @return [type] [description]
 */
function jet_woo_oceanwp_fix_wc_hooks() {
	remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
	remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
	remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
}

/**
 * Open .site-main wrapper for products
 * @return [type] [description]
 */
function jet_woo_oceanwp_open_site_main_wrap() {
	if ( ! is_singular( array( jet_woo_builder_post_type()->slug(), 'product' ) ) ) {
		return;
	}

	echo '<div class="site-main">';
}

/**
 * Close .site-main wrapper for products
 * @return [type] [description]
 */
function jet_woo_oceanwp_close_site_main_wrap() {

	if ( ! is_singular( array( jet_woo_builder_post_type()->slug(), 'product' ) ) ) {
		return;
	}

	echo '</div>';
}

/**
 * Enqueue Ocean WP integration stylesheets.
 *
 * @since 1.0.0
 * @access public
 * @return void
 */
function jet_woo_oceanwp_enqueue_styles() {
	wp_enqueue_style(
		'jet-woo-builder-oceanwp',
		jet_woo_builder()->plugin_url( 'includes/integrations/themes/oceanwp/assets/css/style.css' ),
		false,
		jet_woo_builder()->get_version()
	);
}