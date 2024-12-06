<?php
/**
 * Template part for displaying the entry header with featured image.
 *
 * @package Lumora
 */

$the_post_id = get_the_ID();
$hide_title = get_post_meta( $the_post_id, '_hide-page-title', true );
$heading_class = ! empty( $hide_title ) && 'yes' === $hide_title ? 'hide' : '';

$has_post_thumbnail = has_post_thumbnail( $the_post_id );
?>

<header class="entry-header">
    <?php if ( $has_post_thumbnail ) : ?>
        <div class="entry-image mb-3">
            <a href="<?php echo esc_url( get_permalink() ); ?>">
                <?php 
                the_post_custom_thumbnail(
                    $the_post_id,
                    'featured-thumbnail',
                    [
                        'sizes' => '(max-width: 350px) 350px 223px',
                        'class' => 'attachment-featured-large size-featured-image img-fluid',
                    ]
                );
                ?>
            </a>
        </div>
    <?php endif; ?>

    <?php if ( is_single() || is_page() ) : ?>
        <!-- Single page or post title -->
        <h1 class="page-title text-dark <?php echo esc_attr( $heading_class ); ?>">
            <?php echo wp_kses_post( get_the_title() ); ?>
        </h1>
    <?php else : ?>
        <!-- Non-single page (e.g., archive or blog listing) -->
        <h2 class="entry-title mb-3">
            <a class="text-dark" href="<?php echo esc_url( get_the_permalink() ); ?>" rel="bookmark">
                <?php echo wp_kses_post( get_the_title() ); ?>
            </a>
        </h2>
    <?php endif; ?>
</header>
