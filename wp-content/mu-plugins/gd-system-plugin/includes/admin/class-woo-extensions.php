<?php

namespace WPaaS\Admin;

use WC_Helper_Options;
use \WPaaS\Plugin;

if ( ! defined( 'ABSPATH' ) ) {

	exit;

}

final class Woo_Extensions {

	/**
	 * WPNUX API URL.
	 *
	 * @var string
	 */
	public static $wpnux_api_url;

	/**
	 * Class constructor.
	 */
	public function __construct() {

		/**
		 * Filter the wpnux API URL.
		 *
		 * @param string WPNUX site URL
		 */
		self::$wpnux_api_url = (string) apply_filters( 'wpaas_wpnux_api_url', 'https://wpnux.godaddy.com/v2/api' );

		add_action( 'init', [ $this, 'init' ] );

	}

	/**
	 * Initialize the script.
	 *
	 * @action init
	 */
	public function init() {

		if ( ! Plugin::has_plan( 'eCommerce Managed WordPress' ) || ! is_plugin_active( 'woocommerce/woocommerce.php' ) ) {

			return;

		}

		add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_scripts' ] );
		add_action( 'admin_footer',          [ $this, 'woocommerce_extensions_dialog' ] );

		add_action( 'wp_ajax_render_woocommerce_extensions',  [ $this, 'render_woocommerce_extensions' ] );
		add_action( 'wp_ajax_install_woocommerce_extensions', [ $this, 'install_woocommerce_extensions' ] );

	}

	/**
	 * Enqueue the WooCommerce extensions scripts.
	 *
	 * @return null
	 */
	public function enqueue_scripts() {

		$suffix = SCRIPT_DEBUG ? '' : '.min';

		wp_enqueue_script( 'wpaas-woocommerce-extensions', Plugin::assets_url( "js/wpaas-woocommerce-extensions{$suffix}.js" ), [ 'jquery' ], Plugin::version(), true );

		wp_localize_script(
			'wpaas-woocommerce-extensions',
			'wpaasWooCommerceExtensions',
			[
				'dialogTitle' => __( 'WooCommerce Extensions', 'gd-system-plugin' ),
				'preloader'   => sprintf(
					'<img src="%s" class="loader" />',
					esc_url( admin_url( 'images/wpspin_light.gif' ) )
				),
			]
		);

	}

	/**
	 * Markup for the WooCommerce extensions dialog
	 */
	public function woocommerce_extensions_dialog() {

		?>

		<div id="mwp_woocommerce_extensions_dialog" style="display: none;">
			<?php

			printf(
				'<p class="header-msg">%s</p>',
				esc_html__( 'Here is a list of free WooCommerce extensions that come with your site. Install the ones you would like to use.', 'gd-system-plugin' )
			);

			?>

				<form class="extensions">
					<img src="<?php echo esc_url( admin_url( 'images/wpspin_light-2x.gif' ) ); ?>" class="preloader" />
				</form>

				<br />

			<?php

			printf(
				'<div class="actions">
					<button href="#" class="js-install-wc-extensions button button-primary button-large" disabled data-nonce="%1$s">%2$s</button>&nbsp;
					<button href="#" class="js-cancel-wc-extensions button button-secondary button-large">%3$s</button>
				</div>',
				wp_create_nonce( 'updates' ),
				esc_html__( 'Install', 'gd-system-plugin' ),
				esc_html__( 'Cancel', 'gd-system-plugin' )
			)

			?>
		</div>

		<?php

	}

	private function has_wc_auth() {

		return ( is_callable( [ 'WC_Helper_Options', 'get' ] ) && WC_Helper_Options::get( 'auth' ) );

	}

	/**
	 * Render the WooCommerce extensions.
	 */
	public function render_woocommerce_extensions() {

		$api_url = sprintf( '%s/woocommerce/extensions/%s', self::$wpnux_api_url, get_option( 'woocommerce_default_country', 'US:CA' ) );

		$response = wp_remote_get(
			add_query_arg( 'premium', (int) $this->has_wc_auth(), esc_url_raw( $api_url ) ),
			[ 'timeout' => 30 ]
		);

		if ( 200 !== wp_remote_retrieve_response_code( $response ) || is_wp_error( $response ) ) {

			wp_send_json_error( $response );

		}

		$extensions = json_decode( wp_remote_retrieve_body( $response ), true );

		if ( empty( $extensions ) || ! is_array( $extensions ) ) {

			wp_send_json_success();

		}

		$markup = '<ul>';

		ob_start();

		foreach ( $extensions as $extension ) {

			if ( empty( $extension['slug'] ) || empty( $extension['name'] ) ) {

				continue;

			}

			$checkbox = file_exists( WP_PLUGIN_DIR . '/' . $extension['slug'] ) ? '<span class="dashicons dashicons-yes install-success"></span>' : sprintf(
				'<input type="checkbox" class="js-extension-checkbox" data-plugin-slug="%s" />',
				esc_attr( $extension['slug'] )
			);

			?>
			<li class="plugin">
				<?php echo $checkbox; ?>
				<div class="content">
					<strong><?php echo esc_html( $extension['name'] ); ?></strong>
					<p class="description">
						<?php echo ! empty( $extension['description'] ) ? esc_html( $extension['description'] ) : null; ?>
						<?php if ( ! empty( $extension['homepage'] ) ) : ?>
							<a href="<?php echo esc_url( $extension['homepage'] ); ?>" target="_blank"><?php esc_html_e( 'View More', 'gd-system-plugin' ); ?></a>
						<?php endif; ?>
					</p>
				</div>
			</li>
			<?php

		}

		$markup .= ob_get_clean();
		$markup .= '</ul>';

		wp_send_json_success( $markup );

	}

	/**
	 * Install WooCommerce extensions.
	 */
	public function install_woocommerce_extensions() {

		$extension_slug = filter_input( INPUT_POST, 'slug', FILTER_SANITIZE_STRING );

		if ( ! $extension_slug ) {

			wp_send_json_error();

		}

		$api_url = sprintf( '%s/woocommerce/extensions/%s', self::$wpnux_api_url, get_option( 'woocommerce_default_country', 'US:CA' ) );

		$response = wp_remote_get(
			add_query_arg( 'premium', (int) $this->has_wc_auth(), esc_url_raw( $api_url ) ),
			[ 'timeout' => 30 ]
		);

		if ( 200 !== wp_remote_retrieve_response_code( $response ) || is_wp_error( $response ) ) {

			wp_send_json_error(
				[
					'slug'         => $extension_slug,
					'errorMessage' => $download->get_error_message(),
				]
			);

		}

		$extensions = json_decode( wp_remote_retrieve_body( $response ), true );

		if ( empty( $extensions ) || ! is_array( $extensions ) ) {

			wp_send_json_error(
				[
					'slug'         => $extension_slug,
					'errorMessage' => __( 'Error retreiving extension data. Please try again.', 'gd-system-plugin' ),
				]
			);

		}

		$index = array_search( $extension_slug, array_column( $extensions, 'slug' ), true );

		if ( false === $index ) {

			wp_send_json_error(
				[
					'slug'         => $extension_slug,
					'errorMessage' => __( 'Extension slug not found in list of available plugins.', 'gd-system-plugin' ),
				]
			);

		}

		// Free WooCommerce extension.
		if ( ! isset( $extensions[ $index ]['download_link'] ) ) {

			$extensions[ $index ]['download_link'] = sprintf( 'https://downloads.wordpress.org/plugin/%s.latest-stable.zip', $extension_slug );

		}

		$download = $this->download_extension( $extensions[ $index ]['download_link'], $extension_slug );

		if ( is_wp_error( $download ) ) {

			wp_send_json_error(
				[
					'slug'         => $extension_slug,
					'errorMessage' => $download->get_error_message(),
				]
			);

		}

		$activate = $this->activate_extension( $extension_slug . '/' . $extension_slug . '.php' );

		if ( is_wp_error( $activate ) ) {

			wp_send_json_error(
				[
					'slug'         => $extension_slug,
					'errorMessage' => sprintf(
						/* Translators: 1. The name of the extension. 2. Link to the plugins page. */
						__( '%1$s was installed but encountered an error during activation. Manually activate the plugin on the %2$s.', 'gd-system-plugin' ),
						$extensions[ $index ]['name'],
						sprintf(
							'<a href="%1$s">%2$s</a>',
							esc_url( admin_url( 'plugins.php' ) ),
							esc_html__( 'plugins page', 'gd-system-plugin' )
						)
					),
				]
			);

		}

		wp_send_json_success( [ 'slug' => $extension_slug ] );

	}

	/**
	 * Download an extension.
	 *
	 * @param  string $download_link  URL where the extension can be downloaded from.
	 * @param  string $extension_slug Slug of the extension being installed.
	 *
	 * @return bool|WP_Error True when the extension is installed, else WP_Error.
	 */
	private function download_extension( $download_link, $extension_slug ) {

		$download = download_url( $download_link );

		if ( is_wp_error( $download ) ) {

			return $download;

		}

		WP_Filesystem();

		unzip_file( $download, WP_PLUGIN_DIR );

		@unlink( $download );

		return is_readable( trailingslashit( WP_PLUGIN_DIR ) . $extension_slug );

	}

	/**
	 * Activate a plugin.
	 * Note: Required since we need to reset the plugins cache.
	 *
	 * @param string $plugin_path Path to main the plugin file.
	 *
	 * @return bool True when plugin is activated, else false.
	 */
	private function activate_extension( $plugin_path ) {

		$plugin_header = get_plugin_data( WP_PLUGIN_DIR . '/' . $plugin_path );
		$cache_plugins = wp_cache_get( 'plugins', 'plugins' );

		if ( ! empty( $cache_plugins ) && ! empty( $plugin_header ) ) {

			$cache_plugins[''][ $plugin_path ] = $plugin_header;

			wp_cache_set( 'plugins', $cache_plugins, 'plugins' );

		}

		return is_wp_error( activate_plugin( $plugin_path ) );

	}

}
