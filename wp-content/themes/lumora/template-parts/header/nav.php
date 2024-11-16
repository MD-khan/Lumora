<?php
/**
 * Navigation template part for Lumora theme
 *
 * @package Lumora
 */

// Fetch the Menus instance
$menu_class = \Lumora\Inc\Menus::get_instance();

// Get the Header Menu ID
$header_menu_id = $menu_class->get_menu_id( 'lumora-header-menu' );

// Get the menu items
$header_menus = wp_get_nav_menu_items( $header_menu_id );

?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <?php 
            // Display Custom Logo if available, else display site title
            if ( has_custom_logo() ) {
                the_custom_logo();
            } else {
                echo '<a class="navbar-brand" href="' . esc_url( home_url( '/' ) ) . '">' . get_bloginfo( 'name' ) . '</a>';
            }
        ?>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#lumoraNavbar" aria-controls="lumoraNavbar" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'lumora' ); ?>">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="lumoraNavbar">
            <?php if ( ! empty( $header_menus ) && is_array( $header_menus ) ) : ?>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <?php 
                        foreach ( $header_menus as $menu_item ) {
                            // Only render top-level menu items
                            if ( ! $menu_item->menu_item_parent ) {
                                // Fetch child menu items
                                $child_menu_items = $menu_class->get_child_menu_items( $header_menus, $menu_item->ID );

                                // Check if the menu item has children
                                $has_children = ! empty( $child_menu_items );

                                // Add dropdown class if there are child items
                                $li_class = 'nav-item' . ( $has_children ? ' dropdown' : '' );

                                // Add appropriate classes and attributes for dropdowns
                                $a_class = 'nav-link' . ( $has_children ? ' dropdown-toggle' : '' );
                                $a_attributes = '';

                                if ( $has_children ) {
                                    $a_attributes .= ' role="button" data-bs-toggle="dropdown" aria-expanded="false"';
                                }

                                // Get the menu item's URL and title
                                $menu_url = ! empty( $menu_item->url ) ? esc_url( $menu_item->url ) : '#';
                                $menu_title = ! empty( $menu_item->title ) ? esc_html( $menu_item->title ) : '';

                                echo '<li class="' . esc_attr( $li_class ) . '">';
                                echo '<a class="' . esc_attr( $a_class ) . '" href="' . $menu_url . '"' . $a_attributes . '>' . $menu_title . '</a>';

                                // If the menu item has children, render the dropdown menu
                                if ( $has_children ) {
                                    echo '<ul class="dropdown-menu">';
                                    foreach ( $child_menu_items as $child_item ) {
                                        $child_url = ! empty( $child_item->url ) ? esc_url( $child_item->url ) : '#';
                                        $child_title = ! empty( $child_item->title ) ? esc_html( $child_item->title ) : '';

                                        echo '<li><a class="dropdown-item" href="' . $child_url . '">' . $child_title . '</a></li>';
                                    }
                                    echo '</ul>';
                                }

                                echo '</li>';
                            }
                        }
                    ?>
                </ul>
            <?php endif; ?>
            <form class="d-flex" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                <input class="form-control me-2" type="search" placeholder="<?php esc_attr_e( 'Search', 'lumora' ); ?>" aria-label="<?php esc_attr_e( 'Search', 'lumora' ); ?>" name="s">
                <button class="btn btn-outline-success" type="submit"><?php esc_attr_e( 'Search', 'lumora' ); ?></button>
            </form>
        </div>
    </div>
</nav>
