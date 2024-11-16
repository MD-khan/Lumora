<?php

/**
 * Get the custom post thumbnail with additional attributes.
 *
 * @param int|null $post_id Post ID. Defaults to current post ID if null.
 * @param string   $size Image size. Default 'featured-thumbnail'.
 * @param array    $additional_attributes Additional HTML attributes for the image.
 * @return string HTML image tag or empty string.
 */
function get_the_post_custom_thumbnail( $post_id = null, $size = 'featured-thumbnail', $additional_attributes = array() ) { 

    // Initialize the custom thumbnail variable
    $custom_thumbnail = '';

    // If no post ID is provided, use the current post's ID
    if ( is_null( $post_id ) ) {
        $post_id = get_the_ID();
    }    

    // Check if the post has a featured image
    if ( has_post_thumbnail( $post_id ) ) {

        // Set default attributes
        $default_attributes = array(
            'loading' => 'lazy',
            'class'   => 'custom-thumbnail' // 
        );

        // Handle 'class' attribute: concatenate default and additional classes
        if ( isset( $additional_attributes['class'] ) ) {
            $default_attributes['class'] .= ' ' . $additional_attributes['class'];
            unset( $additional_attributes['class'] );
        }

        // Set default 'alt' attribute if not provided
        if ( ! isset( $additional_attributes['alt'] ) ) {
            $additional_attributes['alt'] = get_the_title( $post_id );
        }

        // Merge default attributes with additional attributes
        // Additional attributes can override defaults
        $attributes = array_merge( $default_attributes, $additional_attributes );

        // Generate the image HTML
        $custom_thumbnail = wp_get_attachment_image(
            get_post_thumbnail_id( $post_id ),
            $size,
            false,
            $attributes
        );

    }

    return $custom_thumbnail;

}

/**
 * Echo the custom post thumbnail.
 *
 * @param int|null $post_id Post ID. Defaults to current post ID if null.
 * @param string   $size Image size. Default 'featured-large'.
 * @param array    $additional_attributes Additional HTML attributes for the image.
 */
function the_post_custom_thumbnail( $post_id = null, $size = 'featured-thumbnail', $additional_attributes = array() ): void { 
    echo get_the_post_custom_thumbnail( $post_id, $size, $additional_attributes );
}
?>
