<?php

namespace WPaaS;

if ( ! defined( 'ABSPATH' ) ) {

	exit;

}

final class WooCommerce {

	public function __construct() {

		add_filter( 'woocommerce_show_admin_notice', [ $this, 'suppress_notices' ], 10, 2 );

	}

	/**
	 * Suppress WooCommerce admin notices.
	 *
	 * @param  bool   $bool   Boolean value to show/suppress the notice.
	 * @param  string $notice The notice name being displayed.
	 *
	 * @since 3.11.0
	 *
	 * @return bool True to show the notice, false to suppress it.
	 */
	public function suppress_notices( $bool, $notice ) {

		// Suppress the SSL notice when using a temp domain.
		if ( 'no_secure_connection' === $notice && Plugin::is_temp_domain() ) {

			return false;

		}

		// Suppress the "Install WooCommerce Admin" notice when the Setup Wizard notice is visible.
		if ( 'wc_admin' === $notice && in_array( 'install', (array) get_option( 'woocommerce_admin_notices', [] ), true ) ) {

			return false;

		}

		return $bool;

	}

}
