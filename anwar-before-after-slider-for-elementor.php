<?php
/**
 * Plugin Name: Anwar Before After Slider for Elementor
 * Description: Create responsive before and after image comparison sliders in Elementor for cleaning, renovation, landscaping, beauty, fitness, photography, and other transformation showcases.
 * Version:     1.0.6
 * Author:      Anwar
 * Author URI:  https://anwarhossanrony.com
 * License:     GPL-2.0-or-later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: anwar-before-after-slider-for-elementor
 * Domain Path: /languages
 * Requires at least: 5.8
 * Requires PHP: 7.4
 * Elementor tested up to: 3.25.0
 * Requires Plugins: elementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'BASFE_VERSION', '1.0.6' );
define( 'BASFE_FILE', __FILE__ );
define( 'BASFE_PATH', plugin_dir_path( __FILE__ ) );
define( 'BASFE_URL', plugin_dir_url( __FILE__ ) );

final class BASFE_Plugin {

	/**
	 * Singleton instance.
	 *
	 * @var BASFE_Plugin|null
	 */
	private static $instance = null;

	/**
	 * Get singleton instance.
	 *
	 * @return BASFE_Plugin
	 */
	public static function instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Constructor.
	 */
	private function __construct() {
		add_action( 'plugins_loaded', array( $this, 'init' ) );
	}


	/**
	 * Initialize plugin.
	 *
	 * @return void
	 */
	public function init() {
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', array( $this, 'notice_missing_elementor' ) );
			return;
		}

		if ( version_compare( ELEMENTOR_VERSION, '3.20.0', '<' ) ) {
			add_action( 'admin_notices', array( $this, 'notice_minimum_elementor_version' ) );
			return;
		}

		add_action( 'wp_enqueue_scripts', array( $this, 'register_assets' ) );
		add_action( 'elementor/widgets/register', array( $this, 'register_widgets' ) );
	}

	/**
	 * Register frontend assets.
	 *
	 * @return void
	 */
	public function register_assets() {
		wp_register_style(
			'basfe-widget',
			BASFE_URL . 'assets/css/before-after.css',
			array(),
			BASFE_VERSION
		);

		wp_register_script(
			'basfe-widget',
			BASFE_URL . 'assets/js/before-after.js',
			array(),
			BASFE_VERSION,
			true
		);
	}

	/**
	 * Register Elementor widgets.
	 *
	 * @param \Elementor\Widgets_Manager $widgets_manager Widget manager.
	 * @return void
	 */
	public function register_widgets( $widgets_manager ) {
		require_once BASFE_PATH . 'includes/class-basfe-widget.php';
		$widgets_manager->register( new \BASFE_Widget() );
	}

	/**
	 * Show dependency notice.
	 *
	 * @return void
	 */
	public function notice_missing_elementor() {
		if ( isset( $_GET['activate'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
			unset( $_GET['activate'] ); // phpcs:ignore WordPress.Security.NonceVerification.Recommended
		}

		printf(
			'<div class="notice notice-warning is-dismissible"><p>%s</p></div>',
			esc_html__( 'Anwar Before After Slider for Elementor requires Elementor to be installed and activated.', 'anwar-before-after-slider-for-elementor' )
		);
	}

	/**
	 * Show Elementor version notice.
	 *
	 * @return void
	 */
	public function notice_minimum_elementor_version() {
		printf(
			'<div class="notice notice-warning is-dismissible"><p>%s</p></div>',
			esc_html__( 'Anwar Before After Slider for Elementor requires Elementor version 3.20.0 or greater.', 'anwar-before-after-slider-for-elementor' )
		);
	}
}

BASFE_Plugin::instance();
