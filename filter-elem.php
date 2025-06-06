<?php
/**
 * Plugin Name: Filter Elem
 * Description: Adds filtering capabilities for an Elementor widget.
 * Version: 1.0.0
 * Author: Sulfamique
 * Text Domain: filter-elem
 * Domain Path: /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Main plugin class.
 */
class Filter_Elem {

    /**
     * Plugin instance.
     *
     * @var Filter_Elem
     */
    private static $instance = null;

    /**
     * Admin handler instance.
     *
     * @var Filter_Elem_Admin
     */
    private $admin;

    /**
     * Plugin version.
     */
    const VERSION = '1.0.0';

    /**
     * Get singleton instance.
     *
     * @return Filter_Elem
     */
    public static function get_instance() {
        if ( null === self::$instance ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Constructor.
     */
    private function __construct() {
        add_action( 'init', array( $this, 'load_textdomain' ) );
        add_action( 'elementor/widgets/register', array( $this, 'register_widgets' ) );

        require_once __DIR__ . '/includes/class-filter-elem-admin.php';
        $this->admin = new Filter_Elem_Admin();
        $this->admin->hooks();
    }

    /**
     * Load plugin textdomain for translations.
     */
    public function load_textdomain() {
        load_plugin_textdomain( 'filter-elem', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
    }

    /**
     * Register Elementor widgets.
     *
     * @param \Elementor\Widgets_Manager $widgets_manager Widgets manager instance.
     */
    public function register_widgets( $widgets_manager ) {
        require_once __DIR__ . '/widgets/class-filter-elem-widget.php';
        $widgets_manager->register( new Filter_Elem_Widget() );
    }
}

// Initialize the plugin.
Filter_Elem::get_instance();
