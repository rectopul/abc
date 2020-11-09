<?php
/**
 * Class description
 *
 * @package   package_name
 * @author    Cherry Team
 * @license   GPL-2.0+
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( 'Jet_Woo_Product_Gallery_Settings' ) ) {

	/**
	 * Define Jet_Woo_Product_Gallery_Settings class
	 */
	class Jet_Woo_Product_Gallery_Settings {

		/**
		 * A reference to an instance of this class.
		 *
		 * @since  1.0.0
		 * @access private
		 * @var    object
		 */
		private static $instance = null;

		/**
		 * [$key description]
		 * @var string
		 */
		public $key = 'jet-woo-product-gallery-settings';

		/**
		 * [$settings description]
		 * @var null
		 */
		public $settings = null;

		/**
		 * Init page
		 */
		public function init() {

			add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ), 0 );

			add_action( 'admin_menu', array( $this, 'register_page' ), 99 );
		}

		/**
		 * Initialize page builder module if required
		 *
		 * @return void
		 */
		public function admin_enqueue_scripts() {

			if ( isset( $_REQUEST['page'] ) && $this->key === $_REQUEST['page'] ) {

				$module_data = jet_woo_product_gallery()->module_loader->get_included_module_data( 'cherry-x-vue-ui.php' );
				$ui          = new CX_Vue_UI( $module_data );

				$ui->enqueue_assets();

				wp_enqueue_style(
					'jet-woo-product-gallery-admin-css',
					jet_woo_product_gallery()->plugin_url( 'assets/css/jet-woo-product-gallery-admin.css' ),
					false,
					jet_woo_product_gallery()->get_version()
				);

				wp_enqueue_script(
					'jet-woo-product-gallery-admin-script',
					jet_woo_product_gallery()->plugin_url( 'assets/js/jet-woo-product-gallery-admin.js' ),
					array( 'cx-vue-ui' ),
					jet_woo_product_gallery()->get_version(),
					true
				);

				wp_localize_script(
					'jet-woo-product-gallery-admin-script',
					'JetWooProductGallerySettingsPageConfig',
					apply_filters( 'jet-woo-product-gallery/admin/settings-page-config', $this->get_localize_data() )
				);
			}
		}

		/**
		 * [generate_frontend_config_data description]
		 * @return [type] [description]
		 */
		public function get_localize_data() {

			$product_gallery_available_widgets = [];
			$default_product_gallery_widgets = [];

			foreach ( glob( jet_woo_product_gallery()->plugin_path( 'includes/widgets/' ) . '*.php' ) as $file ) {
				$data = get_file_data( $file, array( 'class'=>'Class', 'name' => 'Name', 'slug'=>'Slug' ) );

				$slug = basename( $file, '.php' );

				$product_gallery_available_widgets[] = array(
					'label' => $data['name'],
					'value' => $slug,
				);

				$default_product_gallery_widgets[ $slug ] = 'true';
			}

			$rest_api_url = apply_filters( 'jet-woo-product-gallery/rest/frontend/url', get_rest_url() );

			return array(
				'messages' => array(
					'saveSuccess' => esc_html__( 'Saved', 'jet-woo-builder' ),
					'saveError'   => esc_html__( 'Error', 'jet-woo-builder' ),
				),
				'settingsApiUrl' => $rest_api_url . 'jet-woo-product-gallery-api/v1/plugin-settings',
				'settingsData' => array(
					'product_gallery_available_widgets' => array(
						'value'   => $this->get( 'product_gallery_available_widgets', $default_product_gallery_widgets ),
						'options' => $product_gallery_available_widgets,
					),
				),
			);
		}

		/**
		 * Return settings page URL
		 *
		 * @return string
		 */
		public function get_settings_page_link() {

			return add_query_arg(
				array(
					'page' => $this->key,
				),
				esc_url( admin_url( 'admin.php' ) )
			);
		}

		/**
		 * [get description]
		 * @param  [type]  $setting [description]
		 * @param  boolean $default [description]
		 * @return [type]           [description]
		 */
		public function get( $setting, $default = false ) {

			if ( null === $this->settings ) {
				$this->settings = get_option( $this->key, array() );
			}

			return isset( $this->settings[ $setting ] ) ? $this->settings[ $setting ] : $default;
		}

		/**
		 * Register add/edit page
		 *
		 * @return void
		 */
		public function register_page() {

			add_submenu_page(
				'jet-dashboard',
				esc_html__( 'JetProductGallery Settings', 'jet-woo-product-gallery' ),
				esc_html__( 'JetProductGallery Settings', 'jet-woo-product-gallery' ),
				'manage_options',
				$this->key,
				array( $this, 'render_page' )
			);
		}

		/**
		 * Render settings page
		 *
		 * @return void
		 */
		public function render_page() {

			include jet_woo_product_gallery()->get_template( 'admin-templates/settings-page.php' );
		}

		/**
		 * Returns the instance.
		 *
		 * @since  1.0.0
		 * @access public
		 * @return object
		 */
		public static function get_instance() {

			// If the single instance hasn't been set, set it now.
			if ( null == self::$instance ) {
				self::$instance = new self;
			}

			return self::$instance;
		}
	}
}

/**
 * Returns instance of Jet_Woo_Product_Gallery_Settings
 *
 * @return object
 */
function jet_woo_product_gallery_settings() {
	return Jet_Woo_Product_Gallery_Settings::get_instance();
}
