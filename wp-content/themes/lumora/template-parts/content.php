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
             get_template_part('template-parts/components/blog/entry','meta');
             get_template_part('template-parts/components/blog/entry','content');
             get_template_part('template-parts/components/blog/entry','footer');

            ?>
            
        </div>
    </article>
</div>
