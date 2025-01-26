<?php
/**
 * The template for displaying front page.
 *
 * @package Lumora
 */

get_header(); 
?>



<div id="primary">
	<main id="main" class="site-main mt-5" role="main">
		<div class="container">
			<?php 
            if ( have_posts() ):
                while ( have_posts() ): the_post();
                get_template_part( 'template-parts/content', 'page');
                endwhile;
            else :
                get_template_part( 'template-parts/content-none');
            endif;
            
            ?>
		</div>
		
	</main>
</div>

<?php
get_footer();
?>
