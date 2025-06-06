<?php
/**
 * Admin page for Filter Elem plugin.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Class Filter_Elem_Admin
 */
class Filter_Elem_Admin {

    /**
     * Hook into admin actions.
     */
    public function hooks() {
        add_action( 'admin_menu', array( $this, 'add_menu' ) );
    }

    /**
     * Register plugin menu page.
     */
    public function add_menu() {
        add_menu_page(
            __( 'Filter Elem', 'filter-elem' ),
            __( 'Filter Elem', 'filter-elem' ),
            'manage_options',
            'filter-elem',
            array( $this, 'render_page' ),
            'dashicons-filter'
        );
    }

    /**
     * Render admin page.
     */
    public function render_page() {
        echo '<div class="wrap">';
        echo '<h1>' . esc_html__( 'Filter Elem Dashboard', 'filter-elem' ) . '</h1>';
        echo '<p>' . esc_html__( 'Configure your filter settings here.', 'filter-elem' ) . '</p>';
        echo '</div>';
    }
}
