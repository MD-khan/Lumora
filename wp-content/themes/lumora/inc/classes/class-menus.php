<?php
/**
 * Register Menue
 * @package Lumora
 */

namespace Lumora\Inc;
use Lumora\Inc\Traits\Singleton;

class Menus {

    use Singleton;

    
   protected function __construct() {

    $this->setup_hooks();

   }

   protected function setup_hooks() { 
    /**
     * Actions
     */
    add_action( hook_name: 'init', callback: [$this, 'register_menus'] );
   
   }

   public function register_menus() {
     register_nav_menus([
        'lumora-header-menu' => esc_html__('Header Menu', 'lumora'),
        'lumora-footer-menu' => esc_html__('Footer', 'lumora'),
     ]);
   }

   public function get_menu_id( $location){
        $locations = get_nav_menu_locations();
        // Get object id by location
        $menu_id = $locations[$location];
        return ! empty( $menu_id ) ? $menu_id : '';

   }

   public function get_child_menu_items( $menu_array, $parent_it ) {
        $child_menus = [];
        if ( !empty( $menu_array )  && is_array( $menu_array ) ) {
            foreach ( $menu_array as $menu_item ) {
                if (intval( $menu_item->menu_item_parent ) ===  $parent_it) {
                    array_push( $child_menus, $menu_item );
                }
            }
        }
        return $child_menus;
        
   }


}