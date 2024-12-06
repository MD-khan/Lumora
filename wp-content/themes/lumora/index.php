<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 *
 * @package Lumora
 * @since Lumora 1.0
 */
?>

<?php get_header(); ?>


<div id="primary">
    <main id="main" class="site-main mt-5" role="main">
        <?php if ( have_posts() ) : ?>
            <div class="container">
                <?php if ( is_home() && ! is_front_page() ) : ?>
                    <header class="mb-5">
                        <h1 class="page-title screen-reader-text">
                            <?php single_post_title(); ?>
                        </h1>
                    </header>
                <?php endif; ?>

                <div class="row">
                    <?php while ( have_posts() ) : the_post(); ?>
                        <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                            <?php 
                            // Include content.php for rendering each post
                            get_template_part( 'template-parts/content' ); 
                            ?>
                        </div>
                    <?php endwhile; ?>
                    
                </div>

                <?php
                // Pagination
                the_posts_pagination(
                    array(
                        'mid_size'  => 2,
                        'prev_text' => __( '« Previous', 'lumora' ),
                        'next_text' => __( 'Next »', 'lumora' ),
                    )
                );
                ?>
            </div>
        <?php else : ?>
            <div class="container">
                <?php get_template_part( 'template-parts/content', 'none' ); ?>
            </div>
        <?php endif; ?>
    </main>
</div>

<?php get_footer(); ?>
