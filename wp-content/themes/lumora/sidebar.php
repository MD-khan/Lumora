<?php
/**
 * The template for displaying the sidebar.
 *
 * @package Lumora
 */
?>
<aside id="secondary" role="complementary">
    <?php 
    if ( ! dynamic_sidebar( 'primary-sidebar' ) ) {
        echo '<p>' . __( 'No widgets added yet. Add some from the Widgets panel in WordPress.', 'lumora' ) . '</p>';
    }
    ?>
</aside>
