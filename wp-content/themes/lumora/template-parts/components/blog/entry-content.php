<?php
/**
 * Template for displaying the entry content.
 *
 * @package Lumora
 */
?>

<div class="entry-content">
    <?php 
    if ( is_single() ) {
        // Display full content for single posts and pages
        the_content(
            sprintf(
                /* translators: %s: Post title */
                wp_kses(
                    __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'lumora' ),
                    [
                        'span' => [
                            'class' => [],
                        ],
                    ]
                ),
                '<span class="screen-reader-text">' . get_the_title() . '</span>'
            )
        );

        // Display pagination for paginated posts
        wp_link_pages(
            [
                'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'lumora' ),
                'after'  => '</div>',
            ]
        );
    } else {
        // Display excerpt for non-single views
        if ( function_exists( 'lumora_the_excerpt' ) ) {
            lumora_the_excerpt( 100 ); // Trims to 100 characters if lumora_the_excerpt exists
        } else {
            the_excerpt();
            echo lumora_excerp_more();
        }
    }
    ?>
</div>
