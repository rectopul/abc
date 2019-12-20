<?php

namespace WPaaS\Admin;

if ( ! defined( 'ABSPATH' ) ) {

	exit;

}

use \WPaaS\Plugin;

final class Block_Editor {

	/**
	 * Class constructor.
	 */
	public function __construct() {

		if ( ! Plugin::use_simple_ux() ) {

			return;

		}

		add_action( 'enqueue_block_editor_assets', [ $this, 'block_editor_defaults' ] );

	}

	/**
	 * Set the block editor default features
	 */
	public function block_editor_defaults() {

		ob_start();

		?>

		jQuery( document ).ready( function() {
			if ( null === JSON.parse( window.localStorage.getItem( 'WP_DATA_USER_<?php echo get_current_user_id(); ?>' ) ) ) {
				wp.data.dispatch( 'core/edit-post' ).toggleFeature( 'fullscreenMode' );
				wp.data.dispatch( 'core/edit-post' ).toggleFeature( 'fixedToolbar' );
			}
		} );

		<?php

		wp_add_inline_script( 'wp-blocks', ob_get_clean() );

	}

}
