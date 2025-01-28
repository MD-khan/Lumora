<?php 
/**
 * Bootstrap : the enty of the all classess
 * @package Lumora 
 */

namespace Lumora\Inc;

 use Lumora\Inc\Traits\Singleton;
 
 class LUMORA_THEME {

   use Singleton;

   protected function __construct() {

    // Load classes
    Assets::get_instance();
    Menus::get_instance();
    Meta_Boxes::get_instance();
    Sidebars::get_instance();
    Block_Patterns::get_instance();
    Customizer::get_instance();

    $this->setup_hooks();

   }

   protected function setup_hooks() { 
    /**
     * Actions
     */
    add_action('after_setup_theme', [ $this, 'setup_theme']);
    
   }

   public function setup_theme() {

    add_theme_support( 'title-tag' );

    // Add support for Custom Logo
    add_theme_support( 'custom-logo', [
      'height'      => 100, // Set the desired logo height
      'width'       => 400, // Set the desired logo width
      'flex-height' => true, // Allow flexible height
      'flex-width'  => true, // Allow flexible width
      'header-text' => [ 'site-title', 'site-description' ], // Elements to hide when logo is displayed
    ]);

    add_theme_support( 'custom-background', [
      'default-color' => '#ffffff',
      'default-image' => '',
      'default-repeat' => 'no-repeat'
    ] );
    
    add_theme_support( 'post-thumbnails' ); 

    add_image_size('featured-large',width: 359,height: 233, crop: true );  


    add_theme_support( 'custom-selective-refresh-widgets');

    add_theme_support( 'automatic-feed-links' );

    add_theme_support( 'html5', 
        [
          'comment-list', 
          'comment-form', 
          'search-form', 
          'gallery',
          'caption', 
          'style',
          'script' 
        ] );
   
    #add__editor_style();
    add_theme_support( 'wp-block-style' );

    add_theme_support( 'align-wide');

    add_editor_style();

    // Remove the core block patterns
    #remove_theme_support('core-block-patterns');
     

    global $content_width;
    if ( ! isset( $content_width ) ) {
        $content_width = 1240;
    }
   }

 }
 