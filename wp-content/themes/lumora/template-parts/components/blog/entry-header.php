<?php 
/**
 * Template part for displaying the entry header with featured image
 *
 * @package Lumora
 */
$the_post_id = get_the_ID();
$has_post_thumbnail = get_the_post_thumbnail( $the_post_id );
?>

<header class="entry-header">
    <?php 
    if ( $has_post_thumbnail ) : ?>
        <div class="entry-image mb-3">
            <a href="<?php echo esc_url( get_permalink() ); ?>">
                <?php 
                the_post_custom_thumbnail(
                    $the_post_id,
                    'featured-thumbnail',
                    [
                        'sizes' => '(max-width: 350px) 350px 223px',
                        'class' => 'attachment-featured-large size-featured-image img-fluid', // Added 'img-fluid' for responsiveness
                        // 'alt' is automatically set in the function if not provided
                    ]
                );
                ?>
            </a>
        </div>
    <?php endif;  ?>
</header>
