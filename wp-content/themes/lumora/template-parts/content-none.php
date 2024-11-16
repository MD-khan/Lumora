<?php
/**
 * Template part for displaying a message when no posts are found
 *
 * @package Lumora
 */
?>

<div class="col-12">
    <div class="alert alert-warning" role="alert">
        <h2><?php esc_html_e( 'Nothing Found', 'lumora' ); ?></h2>
        <p><?php esc_html_e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'lumora' ); ?></p>
        <?php get_search_form(); ?>
    </div>
</div>
