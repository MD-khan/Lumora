<?php

/**
 * Template Tags for Lumora Theme
 *
 * Functions to display custom elements like post thumbnails, meta information, etc.
 *
 * @package Lumora
 */

/**
 * Retrieves the custom post thumbnail with additional attributes.
 *
 * @param int|null $post_id                Post ID. Defaults to current post ID if null.
 * @param string   $size                   Image size. Default 'featured-thumbnail'.
 * @param array    $additional_attributes  Additional HTML attributes for the image.
 * @return string HTML image tag or empty string.
 */
function get_the_post_custom_thumbnail( $post_id = null, $size = 'featured-thumbnail', $additional_attributes = array() ) { 

    // Initialize the custom thumbnail variable
    $custom_thumbnail = '';

    // Use current post ID if none provided
    if ( is_null( $post_id ) ) {
        $post_id = get_the_ID();
    }    

    // Check if the post has a featured image
    if ( has_post_thumbnail( $post_id ) ) {

        // Set default attributes
        $default_attributes = array(
            'loading' => 'lazy',
            'class'   => 'custom-thumbnail',
        );

        // Concatenate additional classes if provided
        if ( isset( $additional_attributes['class'] ) ) {
            $default_attributes['class'] .= ' ' . sanitize_html_class( $additional_attributes['class'] );
            unset( $additional_attributes['class'] );
        }

        // Set default 'alt' attribute to post title if not provided
        if ( ! isset( $additional_attributes['alt'] ) ) {
            $additional_attributes['alt'] = get_the_title( $post_id );
        }

        // Merge default attributes with additional attributes
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
 * Echoes the custom post thumbnail.
 *
 * @param int|null $post_id                Post ID. Defaults to current post ID if null.
 * @param string   $size                   Image size. Default 'featured-thumbnail'.
 * @param array    $additional_attributes  Additional HTML attributes for the image.
 * @return void
 */
function the_post_custom_thumbnail( $post_id = null, $size = 'featured-thumbnail', $additional_attributes = array() ): void { 
    echo get_the_post_custom_thumbnail( $post_id, $size, $additional_attributes );
}


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


/**
 * Retrieves HTML with meta information for the current post author.
 *
 * @return string HTML string with post author.
 */
function lumora_get_posted_by() {
    $author_name = get_the_author();
    $author_url  = get_author_posts_url( get_the_author_meta( 'ID' ) );
    $author_id   = get_the_author_meta( 'ID' );

    $author_link = sprintf(
        /* translators: %s: post author */
        esc_html_x( 'by %s', 'post author', 'lumora' ),
        '<span class="author vcard" itemprop="author" itemscope itemtype="https://schema.org/Person">' . 
            '<a class="url fn n" href="' . esc_url( $author_url ) . '" rel="author" itemprop="url" aria-label="' . esc_attr( sprintf( __( 'View all posts by %s', 'lumora' ), $author_name ) ) . '">' . 
                '<span itemprop="name">' . esc_html( $author_name ) . '</span>' . 
            '</a>' . 
        '</span>'
    );

    return '<span class="byline"> ' . $author_link . ' </span>';
}



/**
 * Displays the post excerpt with optional trimming.
 *
 * @param int $trim_character_count Number of characters to trim the excerpt to. Defaults to 100.
 * @return void
 */
function lumora_the_excerpt( $trim_character_count = 100 ) {
    // Check if the post has an excerpt and if trimming is requested
    if ( ! has_excerpt() || 0 === $trim_character_count ) {
        the_excerpt();
        return;
    }

    // Allow modification of trim character count via filters
    $trim_character_count = apply_filters( 'lumora_trim_excerpt_length', $trim_character_count );

    // Retrieve the excerpt and strip all HTML tags
    $excerpt = wp_strip_all_tags( get_the_excerpt() );

    // Use multibyte string functions for better language support
    if ( function_exists( 'mb_strlen' ) && function_exists( 'mb_substr' ) && function_exists( 'mb_strrpos' ) ) {
        $excerpt_length = mb_strlen( $excerpt );

        // If the excerpt is shorter than or equal to the trim limit, display it as is
        if ( $trim_character_count >= $excerpt_length ) {
            echo esc_html( $excerpt );
            return;
        }

        // Trim the excerpt to the specified character count
        $trimmed_excerpt = mb_substr( $excerpt, 0, $trim_character_count );

        // Find the position of the last space within the trimmed excerpt to avoid cutting words
        $last_space = mb_strrpos( $trimmed_excerpt, ' ' );

        if ( false !== $last_space ) {
            // Trim to the last space
            $trimmed_excerpt = mb_substr( $trimmed_excerpt, 0, $last_space );
        }

        // Display the trimmed excerpt with an ellipsis
        echo esc_html( $trimmed_excerpt ) . ' [&hellip;]';
    } else {
        // Fallback for environments without multibyte string support
        $excerpt_length = strlen( $excerpt );

        if ( $trim_character_count >= $excerpt_length ) {
            echo esc_html( $excerpt );
            return;
        }

        $trimmed_excerpt = substr( $excerpt, 0, $trim_character_count );
        $last_space = strrpos( $trimmed_excerpt, ' ' );

        if ( false !== $last_space ) {
            $trimmed_excerpt = substr( $trimmed_excerpt, 0, $last_space );
        }

        echo esc_html( $trimmed_excerpt ) . ' [&hellip;]';
    }
}

function lumora_excerpt_more( $more = '' ) {
    if ( ! is_single() ) {
        $more = sprintf( '<button class="mt-4 btn btn-info"><a class="lumora-read-more text-white" href="%1$s">%2$s</a></button>',
        get_permalink( get_the_ID() ),
        __('Read more','lumora')
        );
    }
    return $more;
}