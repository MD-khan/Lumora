<?php
/**
 * Template part for displaying posts in a grid layout
 *
 * @package Lumora
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('mb-5' ); ?>>

    <?php 
        get_template_part('template-parts/components/blog/entry-header') ;
        get_template_part('template-parts/components/blog/entry-meta') ;
        get_template_part('template-parts/components/blog/entry-content') ;
        get_template_part('template-parts/components/blog/entry-footer') ;
    ?>

</article>

<div class="col-lg-4 col-md-6 col-sm-12 mb-4">
    <article id="post-<?php the_ID(); ?>" <?php post_class( 'h-100' ); ?>>
        <div class="card h-100">
            <?php if ( has_post_thumbnail() ) : ?>
                <a href="<?php the_permalink(); ?>" aria-label="<?php the_title_attribute(); ?>">
                    <?php the_post_thumbnail( 'medium_large', array( 'class' => 'card-img-top img-fluid' ) ); ?>
                </a>
            <?php endif; ?>
            <div class="card-body d-flex flex-column">
                <h2 class="card-title">
                    <a href="<?php the_permalink(); ?>" class="text-decoration-none text-dark">
                        <?php the_title(); ?>
                    </a>
                </h2>
                <div class="card-text">
                    <?php 
                        // Display an excerpt with a 'Read More' link
                        the_excerpt(); 
                    ?>
                </div>
                <a href="<?php the_permalink(); ?>" class="mt-auto btn btn-primary">
                    <?php esc_html_e( 'Read More', 'lumora' ); ?>
                </a>
            </div>
        </div>
    </article>
</div>
