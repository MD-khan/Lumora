<?php
/**
 * Handles the Theme Customizer settings and controls.
 */

namespace Lumora\Inc;

use WP_Customize_Manager;
use Lumora\Inc\Traits\Singleton;

class Customizer {

    use Singleton;

    protected function __construct() {
        $this->setup_hooks();
    }

    protected function setup_hooks() {
        // Add customizer settings and controls
        add_action( 'customize_register', [ $this, 'register_customizer_options' ] );
    }

    public function register_customizer_options( WP_Customize_Manager $wp_customize ) {
        // Add a section for theme options
        $wp_customize->add_section( 'lumora_theme_options', [
            'title'    => __( 'Lumora Theme Options', 'lumora' ),
            'priority' => 30,
        ]);

        // Add setting for Hero Section Title
        $wp_customize->add_setting( 'lumora_hero_title', [
            'default'           => __( 'Welcome to Lumora', 'lumora' ),
            'sanitize_callback' => 'sanitize_text_field',
        ]);

        // Add control for Hero Section Title
        $wp_customize->add_control( 'lumora_hero_title', [
            'label'    => __( 'Hero Section Title', 'lumora' ),
            'section'  => 'lumora_theme_options',
            'type'     => 'text',
        ]);

        // Add setting for Hero Section Background Image
        $wp_customize->add_setting( 'lumora_hero_bg', [
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ]);

        // Add control for Hero Section Background Image
        $wp_customize->add_control( new \WP_Customize_Image_Control( $wp_customize, 'lumora_hero_bg', [
            'label'    => __( 'Hero Background Image', 'lumora' ),
            'section'  => 'lumora_theme_options',
            'settings' => 'lumora_hero_bg',
        ]));
    }
}
