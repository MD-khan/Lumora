<?php
/**
 * Template part for displaying page content.
 *
 * @package Lumora
 */
?>
 
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    
    <header class="entry-header">
        <?php if ( ! is_front_page() ) : ?>
            <h1 class="entry-title"><?php the_title(); ?></h1>
        <?php endif; ?>
    </header><!-- .entry-header -->

    <div class="entry-content">
        <?php
        the_content();

        wp_link_pages( array(
            'before' => '<div class="page-links">' . __( 'Pages:', 'lumora' ),
            'after'  => '</div>',
        ) );
        ?>
    </div><!-- .entry-content -->

    <?php if ( get_edit_post_link() ) : ?>
        <footer class="entry-footer">
            <?php
            edit_post_link(
                sprintf(
                    /* translators: %s: Name of current post */
                    __( 'Edit <span class="screen-reader-text">%s</span>', 'lumora' ),
                    get_the_title()
                ),
                '<span class="edit-link">',
                '</span>'
            );
            ?>
        </footer><!-- .entry-footer -->
    <?php endif; ?>

</article><!-- #post-<?php the_ID(); ?> -->
