<?php
/**
 * Template part for displaying posts in a grid layout
 *
 * @package Lumora
 */
?>

<div class="col-lg-4 col-md-6 col-sm-12 mb-4">
    <article id="post-<?php the_ID(); ?>" <?php post_class( 'h-100' ); ?>>
        <div class="card h-100">
            <?php 
            // Include the entry header template part
            get_template_part( 'template-parts/components/blog/entry', 'header' ); 
            ?>
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
