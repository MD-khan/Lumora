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
		<div class="container">
			<div class="row">
				<!-- Main Content Area -->
				<div class="col-lg-8 col-md-8 col-sm-12">
					<?php
					if ( have_posts() ) :
					?>
						<div class="post-wrap">
						<?php
						// Display the title for single post pages.
						if ( is_home() && ! is_front_page() ) {
							?>
							<header class="mb-5">
								<h1 class="page-title screen-reader-text">
									<?php single_post_title(); ?>
								</h1>
							</header>
							<?php
						}

						// Loop through posts.
						while ( have_posts() ) : the_post();

							// Include the content template part.
							get_template_part( 'template-parts/content' );

						endwhile;
						?>
						</div>
					<?php
					else :

						// Include the "no content" template part if no posts are found.
						get_template_part( 'template-parts/content-none' );

					endif;
					?>

					<!-- Post Navigation -->
					<div class="prev-link"><?php previous_post_link(); ?></div>
					<div class="next-link"><?php next_post_link(); ?></div>
				</div>

				<!-- Sidebar Area -->
				<div class="col-lg-4 col-md-4 col-sm-12">
					<?php get_sidebar(); ?>
				</div>
			</div>
		</div>
		<!-- Comments Template -->
		<?php comments_template(); ?>
	</main>
</div>

<?php
get_footer();
?>
