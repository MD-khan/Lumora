<?php 
/**
 * Theme sidebars
 */

namespace Lumora\Inc;
use Lumora\Inc\Traits\Singleton;

class Sidebars {

    use Singleton;

    
   protected function __construct() {

    $this->setup_hooks();

   }

   protected function setup_hooks() { 
    /**
     * Actions
     */
    add_action('widgets_init', [ $this, 'register_sidebars' ] );
   }

   public function register_sidebars() {

    register_sidebar( [
        'name'          => __( 'Primary Sidebar', 'lumora' ),
        'id'            => 'primary-sidebar',
        'description'   => __( 'This is the main sidebar that appears on the right.', 'lumora' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ] ) ;

    register_sidebar( [
        'name'          => __( 'Footer Widget Area', 'lumora' ),
        'id'            => 'footer-widget',
        'description'   => __( 'This widget area appears in the footer.', 'lumora' ),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ] );
   }


}