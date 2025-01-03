<?php  
/**
 * Entry Footer Template Part
 *
 * Displays categories and tags for the current post.
 */

$the_post_id = get_the_ID();

// Get terms for the post from 'category' and 'post_tag'
$article_terms = wp_get_post_terms( $the_post_id, [ 'category', 'post_tag' ] );

// Exit early if no terms are found or the result is not an array
if ( empty( $article_terms ) || ! is_array( $article_terms ) ) {
    return;
}
?>

<div class="entry-footer mt-4">
    <?php 
    foreach ( $article_terms as $article_term ) : ?>
        <a class="btn border border-secondary mb-2 mr-2 entry-footer-link text-black-50" href="<?php echo esc_url( get_term_link( $article_term ) ); ?>">
            <?php echo esc_html( $article_term->name ); ?>
        </a>
    <?php endforeach; ?>
</div>
