<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
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
                <?php 
                // Check if it's the blog posts index page and not the front page
                if ( is_home() && ! is_front_page() ) {
                    $posts_page_id = get_option( 'page_for_posts' );
                    if ( $posts_page_id ) {
                        // If a static page is set for posts, display its title
                        echo '<header class="mb-5">';
                        echo '<h1 class="page-title">' . esc_html( get_the_title( $posts_page_id ) ) . '</h1>';
                        echo '</header>';
                    } else {
                        // If no static page is set, use a default title
                        echo '<header class="mb-5">';
                        echo '<h1 class="page-title">' . esc_html__( 'Blog', 'lumora' ) . '</h1>';
                        echo '</header>';
                    }
                }
                ?>

                <div class="row">
                    <?php 
                    while ( have_posts() ) : the_post(); 
                        // Include the content template part
                        get_template_part( 'template-parts/content', get_post_format() ); 
                    endwhile; 
                    ?>
                </div>

                <?php
                // Pagination
                the_posts_pagination( array(
                    'mid_size'  => 2,
                    'prev_text' => __( '« Previous', 'lumora' ),
                    'next_text' => __( 'Next »', 'lumora' ),
                ) );
                ?>
            </div>
        <?php else : ?>
            <div class="container">
                <?php 
                // Include the content-none template part
                get_template_part( 'template-parts/content', 'none' ); 
                ?>
            </div>
        <?php endif; ?>
    </main>
</div>

<?php get_footer(); ?>
