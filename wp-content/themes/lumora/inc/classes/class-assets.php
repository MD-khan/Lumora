<?php
/**
 * Manages theme assets (styles and scripts).
 */

namespace Lumora\Inc;

use Lumora\Inc\Traits\Singleton;

class Assets {

    use Singleton;

    protected function __construct() {
        $this->setup_hooks();
    }

    protected function setup_hooks() {
        /**
         * Actions
         */
        add_action('wp_enqueue_scripts', [$this, 'register_styles']);
        add_action('wp_enqueue_scripts', [$this, 'register_scripts']);
    }

    public function register_styles() {
        // Enqueue fonts.css if it exists
        if (file_exists(LUMORA_DIR_PATH . '/assets/src/library/fonts/fonts.css')) {
            wp_register_style(
                'lumora-fonts-css',
                LUMORA_DIR_URI . '/assets/src/library/fonts/fonts.css',
                [],
                filemtime(LUMORA_DIR_PATH . '/assets/src/library/fonts/fonts.css')
            );
            wp_enqueue_style('lumora-fonts-css');
        }

        // Enqueue Bootstrap CSS
        wp_register_style(
            'bootstrap-css',
            LUMORA_DIR_URI . '/assets/src/library/css/bootstrap.min.css',
            [],
            '5.3.3'
        );
        wp_enqueue_style('bootstrap-css');

        // Enqueue theme's main CSS file (main.css from the build folder)
        if (file_exists(LUMORA_DIR_PATH . '/build/css/main.css')) {
            wp_register_style(
                'lumora-main-style',
                LUMORA_DIR_URI . '/build/css/main.css',
                [],
                filemtime(LUMORA_DIR_PATH . '/build/css/main.css') // Version based on file modification time
            );
            wp_enqueue_style('lumora-main-style');
        }

        // Enqueue WordPress default stylesheet (optional)
        wp_register_style(
            'lumora-style',
            get_stylesheet_uri(),
            [],
            filemtime(LUMORA_DIR_PATH . '/style.css')
        );
        wp_enqueue_style('lumora-style');
        // Enqueue customizer styles
    wp_register_style(
        'lumora-customizer-style',
        LUMORA_DIR_URI . '/assets/css/customizer.css',
        [],
        filemtime(LUMORA_DIR_PATH . '/assets/css/customizer.css')
    );
    wp_enqueue_style('lumora-customizer-style');
    }

    public function register_scripts() {
        // Enqueue main.js script with versioning
        wp_register_script(
            'lumora-main-js',
            LUMORA_DIR_URI . '/assets/js/main.js',
            [],
            filemtime(LUMORA_DIR_PATH . '/assets/js/main.js'),
            true // Load script in the footer
        );

        // Enqueue Bootstrap JS
        wp_register_script(
            'bootstrap-js',
            LUMORA_DIR_URI . '/assets/src/library/js/bootstrap.bundle.min.js',
            ['jquery'], // Bootstrap JS depends on jQuery
            '5.3.3', // Bootstrap version
            true // Load in footer
        );

         // Enqueue customizer scripts
    wp_register_script(
        'lumora-customizer-script',
        LUMORA_DIR_URI . '/assets/js/customizer.js',
        ['jquery', 'customize-preview'],
        filemtime(LUMORA_DIR_PATH . '/assets/js/customizer.js'),
        true // Load in footer
    );
        wp_enqueue_script('lumora-customizer-script');

        wp_enqueue_script('lumora-main-js');
        wp_enqueue_script('bootstrap-js');
    }

    
}
