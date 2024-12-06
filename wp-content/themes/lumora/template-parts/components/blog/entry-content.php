<?php 
/**
 * Template for entry content
 *
 * @package Lumora
 */
?>

<div class="entry-content">
    <?php 
        if ( is_single() ) {
            the_content(
                sprintf(
                    wp_kses(
                        /* translators: %s: post title */
                        __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'lumora' ),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    '<span class="screen-reader-text">' . esc_html( get_the_title() ) . '</span>'
                )
            );
        } else {
            lumora_the_excerpt( 200 ); // Specify trim character count as needed
           echo lumora_excerpt_more('');
        }    
    ?>
</div>
