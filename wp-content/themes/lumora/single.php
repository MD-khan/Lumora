<?php
/**
 * The template for displaying single posts.
 *
 * @package Lumora
 */

get_header(); 
?>

<div id="primary">
    <main id="main" class="site-main mt-5" role="main">
        <?php 
            if (have_posts() ) : ?>
            
            <div class="container">
                <?php if ( is_home() && ! is_front_page() ) { ?>
                    <header class="container">
                        <h1 class="page-ttile screen-reader-text">
                            <?php single_post_title() ?>
                        </h1>
                    </header>

                <?php } ?>
                <?php 
                    while ( have_posts() ) : the_post();
                    get_template_part("template-parts/content");
                    endwhile;
                ?>
            </div>
            <?php else :
                get_template_part('template-parts/content-none'); 
            ?>

           <?php endif;  ?>

    </main>
</div>

<?php get_footer(); ?>
