<?php
/**
 * Your_Package_Name
 *
 * Your widget description.
 *
 * @package   Your_Package_Name
 * @link      https://github.com/your/repo
 * @author    Firstname Lastname <your@email.com>
 *
 * @copyright 2020 Company Name
 * @license   GPL-2.0-or-later
 * @since     0.0.1
 *
 * @wordpress-plugin
 * Plugin Name:       Your widget name
 * Plugin URI:        https://github.com/your/repo
 * Description:       Your widget description.
 * Version:           0.0.1
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Firstname Lastname
 * Author URI:        https://www.yourWebsite.com/
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       yourTextDomain
 * Domain Path:       /languages
 */

namespace YourPrefix;

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'YOURPREFIX_VERSION', '0.0.1' );

/**
 * Class used to implement a Your_Package_Name widget.
 *
 * @since 0.0.1
 *
 * @see WP_Widget
 */
class Your_Package_Name extends \WP_Widget {
	/**
	 * Set up a new Your_Package_Name widget instance with id, name & description.
	 *
	 * @since 0.0.1
	 */
	public function __construct() {
		$widget_options = array(
			'classname'   => 'yourprefix',
			'description' => __( 'Your widget description.', 'yourTextDomain' ),
		);

		parent::__construct(
			'yourprefix',
			__( 'Your widget name', 'yourTextDomain' ),
			$widget_options
		);

		add_action(
			'widgets_init',
			function() {
				register_widget( 'YourPrefix\Your_Package_Name' );
			}
		);

		add_action( 'plugins_loaded', array( $this, 'yourprefix_load_plugin_textdomain' ) );

		if ( is_active_widget( false, false, $this->id_base ) ) {
			add_action( 'wp_enqueue_scripts', array( $this, 'yourprefix_enqueue_public_styles' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'yourprefix_enqueue_public_scripts' ) );
		}

		if ( is_admin() ) {
			add_action( 'admin_enqueue_scripts', array( $this, 'yourprefix_enqueue_admin_styles' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'yourprefix_enqueue_admin_scripts' ) );
		}
	}

	/**
	 * Load text domain files
	 *
	 * @since 0.0.1
	 */
	public function yourprefix_load_plugin_textdomain() {
		load_plugin_textdomain( 'yourTextDomain', false, basename( dirname( __FILE__ ) ) . '/languages/' );
	}

	/**
	 * Register and enqueue styles needed by the public view of
	 * Your_Package_Name widget.
	 *
	 * @since 0.0.1
	 */
	public function yourprefix_enqueue_public_styles() {
		$styles_url  = plugins_url( 'public/css/style.min.css', __FILE__ );
		$styles_path = plugin_dir_path( __FILE__ ) . 'public/css/style.min.css';

		if ( file_exists( $styles_path ) ) {
			wp_register_style( 'yourprefix', $styles_url, array(), YOURPREFIX_VERSION );

			wp_enqueue_style( 'yourprefix' );
			wp_style_add_data( 'yourprefix', 'rtl', 'replace' );
		}
	}

	/**
	 * Register and enqueue scripts needed by the public view of
	 * Your_Package_Name widget.
	 *
	 * @since 0.0.1
	 */
	public function yourprefix_enqueue_public_scripts() {
		$scripts_url  = plugins_url( 'public/js/scripts.min.js', __FILE__ );
		$scripts_path = plugin_dir_path( __FILE__ ) . 'public/js/scripts.min.js';

		if ( file_exists( $scripts_path ) ) {
			wp_register_script( 'yourprefix-scripts', $scripts_url, array(), YOURPREFIX_VERSION, true );
			wp_enqueue_script( 'yourprefix-scripts' );
		}
	}

	/**
	 * Register and enqueue styles needed by the admin view of
	 * Your_Package_Name widget.
	 *
	 * @since 0.0.1
	 *
	 * @param string $hook_suffix The current admin page.
	 */
	public function yourprefix_enqueue_admin_styles( $hook_suffix ) {
		$styles_url  = plugins_url( 'admin/css/style.min.css', __FILE__ );
		$styles_path = plugin_dir_path( __FILE__ ) . 'admin/css/style.min.css';

		if ( file_exists( $styles_path ) && 'widgets.php' === $hook_suffix ) {
			wp_register_style( 'yourprefix', $styles_url, array(), YOURPREFIX_VERSION );

			wp_enqueue_style( 'yourprefix' );
			wp_style_add_data( 'yourprefix', 'rtl', 'replace' );
		}
	}

	/**
	 * Register and enqueue scripts needed by the admin view of
	 * Your_Package_Name widget.
	 *
	 * @since 0.0.1
	 *
	 * @param string $hook_suffix The current admin page.
	 */
	public function yourprefix_enqueue_admin_scripts( $hook_suffix ) {
		$scripts_url  = plugins_url( 'admin/js/scripts.min.js', __FILE__ );
		$scripts_path = plugin_dir_path( __FILE__ ) . 'admin/js/scripts.min.js';

		if ( file_exists( $scripts_path && 'widgets.php' === $hook_suffix ) ) {
			wp_register_script( 'yourprefix-scripts', $scripts_url, array(), YOURPREFIX_VERSION, true );
			wp_enqueue_script( 'yourprefix-scripts' );
		}
	}

	/**
	 * Outputs the content for the current Your_Package_Name widget instance.
	 *
	 * @since 0.0.1
	 *
	 * @param array $args HTML to display the widget title class and widget content class.
	 * @param array $instance Settings for the current widget instance.
	 */
	public function widget( $args, $instance ) {
		include 'public/partials/your-package-name-public-display.php';
	}

	/**
	 * Outputs the settings form for the Your_Package_Name widget.
	 *
	 * @since 0.0.1
	 *
	 * @param array $instance Current settings.
	 */
	public function form( $instance ) {
		include 'admin/partials/your-package-name-admin-display.php';
	}

	/**
	 * Handles updating settings for the current Your_Package_Name widget instance.
	 *
	 * @since 0.0.1
	 *
	 * @param array $new_instance New settings for this instance as input by the user.
	 * @param array $old_instance Old settings for this instance.
	 *
	 * @return array Updated settings to save.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance          = $old_instance;
		$instance['title'] = sanitize_text_field( $new_instance['title'] );

		return $instance;
	}
}

$yourprefix = new Your_Package_Name();
