<?php
/**
 * Lumora Theme Functions
 *
 * @package Lumora
 */

// Define theme directory path constant.
if ( ! defined( 'LUMORA_DIR_PATH' ) ) {
    define( 'LUMORA_DIR_PATH', untrailingslashit(  get_template_directory() ) );
}

if ( ! defined( 'LUMORA_DIR_URI' ) ) {
    define( 'LUMORA_DIR_URI', untrailingslashit(  get_template_directory_uri() ) );
}

// Include the autoloader.
require_once LUMORA_DIR_PATH . '/inc/helpers/autoloader.php';
require_once LUMORA_DIR_PATH . '/inc/helpers/template-tags.php';

function lumora_get_theme_instance() {
    \Lumora\Inc\LUMORA_THEME::get_instance();
}

lumora_get_theme_instance();

function dd( $value ) {

    echo "<pre>";
    print_r($value);
    wp_die();
    echo "</pre>";
}
