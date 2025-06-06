<?php
/**
 * Filter Elem Widget for Elementor.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

/**
 * Class Filter_Elem_Widget
 */
class Filter_Elem_Widget extends Widget_Base {

    /**
     * Get widget name.
     *
     * @return string
     */
    public function get_name() {
        return 'filter_elem_widget';
    }

    /**
     * Get widget title.
     *
     * @return string
     */
    public function get_title() {
        return __( 'Filter Elem', 'filter-elem' );
    }

    /**
     * Get widget icon.
     *
     * @return string
     */
    public function get_icon() {
        return 'eicon-filter';
    }

    /**
     * Register widget controls.
     */
    protected function register_controls() {
        $this->start_controls_section(
            'section_content',
            array(
                'label' => __( 'Content', 'filter-elem' ),
            )
        );

        $this->add_control(
            'filter_type',
            array(
                'label'   => __( 'Filter Type', 'filter-elem' ),
                'type'    => Controls_Manager::SELECT,
                'options' => array(
                    'category' => __( 'Category', 'filter-elem' ),
                    'taxonomy' => __( 'Taxonomy', 'filter-elem' ),
                ),
                'default' => 'category',
            )
        );

        $this->add_control(
            'category',
            array(
                'label'     => __( 'Category', 'filter-elem' ),
                'type'      => Controls_Manager::SELECT2,
                'options'   => $this->get_categories(),
                'condition' => array( 'filter_type' => 'category' ),
            )
        );

        $this->add_control(
            'taxonomy',
            array(
                'label'     => __( 'Taxonomy', 'filter-elem' ),
                'type'      => Controls_Manager::SELECT2,
                'options'   => $this->get_taxonomies(),
                'condition' => array( 'filter_type' => 'taxonomy' ),
            )
        );

        $this->add_control(
            'term',
            array(
                'label'     => __( 'Term', 'filter-elem' ),
                'type'      => Controls_Manager::SELECT2,
                'options'   => $this->get_terms(),
                'condition' => array( 'filter_type' => 'taxonomy' ),
            )
        );

        $this->end_controls_section();
    }

    /**
     * Render widget output on the frontend.
     */
    protected function render() {
        $settings = $this->get_settings_for_display();
        $args     = array(
            'post_type' => 'post',
        );

        if ( 'category' === $settings['filter_type'] ) {
            $args['cat'] = $settings['category'];
        } else {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => $settings['taxonomy'],
                    'field'    => 'term_id',
                    'terms'    => $settings['term'],
                ),
            );
        }

        $query = new WP_Query( $args );

        if ( $query->have_posts() ) {
            echo '<ul class="filter-elem-posts">';
            while ( $query->have_posts() ) {
                $query->the_post();
                echo '<li><a href="' . esc_url( get_permalink() ) . '">' . esc_html( get_the_title() ) . '</a></li>';
            }
            echo '</ul>';
            wp_reset_postdata();
        } else {
            esc_html_e( 'No posts found', 'filter-elem' );
        }
    }

    /**
     * Helper to retrieve categories list.
     *
     * @return array
     */
    private function get_categories() {
        $cats   = get_categories();
        $result = array();
        foreach ( $cats as $cat ) {
            $result[ $cat->term_id ] = $cat->name;
        }
        return $result;
    }

    /**
     * Retrieve available taxonomies.
     *
     * @return array
     */
    private function get_taxonomies() {
        $taxes   = get_taxonomies( array( 'public' => true ), 'objects' );
        $options = array();
        foreach ( $taxes as $tax ) {
            $options[ $tax->name ] = $tax->label;
        }
        return $options;
    }

    /**
     * Retrieve all terms for selection.
     *
     * @return array
     */
    private function get_terms() {
        $terms   = get_terms( array( 'hide_empty' => false ) );
        $options = array();

        if ( ! is_wp_error( $terms ) ) {
            foreach ( $terms as $term ) {
                $options[ $term->term_id ] = sprintf( '%s: %s', $term->taxonomy, $term->name );
            }
        }

        return $options;
    }
}

