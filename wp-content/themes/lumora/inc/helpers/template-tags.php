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


if ( ! function_exists( 'lumora_get_posted_on' ) ) :
    /**
     * Retrieves HTML with meta information for the current post-date/time.
     *
     * @return string HTML string with post date.
     */
    function lumora_get_posted_on() {
        // Initialize the time string with published date.
        $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';

        // Check if the post has been modified.
        $modified = get_the_time( 'U' ) !== get_the_modified_time( 'U' );
        if ( $modified ) {
            $time_string .= '<time class="updated" datetime="%3$s">%4$s</time>';
        }

        // Prepare the time string with the relevant dates.
        $time_string = sprintf(
            $time_string,
            esc_attr( get_the_date( DATE_W3C ) ),          // %1$s: Published date in W3C format
            esc_html( get_the_date() ),                    // %2$s: Published date display
            esc_attr( get_the_modified_date( DATE_W3C ) ), // %3$s: Modified date in W3C format
            esc_html( get_the_modified_date() )            // %4$s: Modified date display
        );

        // Prepare the posted on string with a link to the post.
        $posted_on = sprintf(
            /* translators: %s: post date */
            esc_html_x( 'Posted on %s', 'post date', 'lumora' ),
            '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
        );

        // Add a parent class if the post has been modified.
        $post_classes = $modified ? 'post-modified' : '';

        // Return the final HTML string.
        return '<span class="posted-on ' . esc_attr( $post_classes ) . '">' . $posted_on . '</span>';
    }
endif;



if ( ! function_exists( 'lumora_get_posted_by' ) ) :
    /**
     * Retrieves HTML with meta information for the current post author.
     *
     * @return string HTML string with post author.
     */
    function lumora_get_posted_by() {
        $author_link = sprintf(
            /* translators: %s: post author */
            esc_html_x( 'by %s', 'post author', 'lumora' ),
            '<span class="author vcard" itemprop="author" itemscope itemtype="https://schema.org/Person">' . 
                '<a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" rel="author" itemprop="url" aria-label="' . esc_attr( sprintf( __( 'View all posts by %s', 'lumora' ), get_the_author() ) ) . '">' . 
                    '<span itemprop="name">' . esc_html( get_the_author() ) . '</span>' . 
                '</a>' . 
            '</span>'
        );
    
        return '<span class="byline"> ' . $author_link . ' </span>';
    }
    
endif;

/**
 * Customize the excerpt "Read More" link.
 *
 * This function replaces the default excerpt's "Read More" text with a styled button.
 * The button links to the full post and is only displayed on non-single post pages.
 *
 * @param string $more The default "Read More" text. Defaults to an empty string.
 * @return string The customized "Read More" link for excerpts.
 */
function lumora_excerp_more( $more = '' ) {
    // Check if the current page is not a single post page
    if ( ! is_single() ) {
        // Format the "Read More" link as a button with a styled anchor tag
        $more = sprintf(
            '<button class="mt-4 btn btn-info"><a class="lumora-read-more text-white" href="%1$s">%2$s</a></button>',
            esc_url( get_permalink( get_the_ID() ) ), // URL of the current post
            esc_html__( 'Read more', 'lumora' ) // Translatable "Read More" text
        );
    }

    return $more;
}


