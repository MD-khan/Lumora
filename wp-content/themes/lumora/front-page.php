<?php
/**
 * The template for displaying front page.
 *
 * @package Lumora
 */

get_header(); 
?>

<?php 
$hero_bg_image = get_theme_mod('hero_bg_image', '');
echo '<!-- Debug: Hero Background Image URL: ' . esc_url($hero_bg_image) . ' -->';
?>


<div id="primary">
    <main id="main" class="site-main mt-5" role="main">
        <!-- Hero Section -->
        <section class="hero-section" style="background-image: url('<?php echo get_theme_mod('hero_bg_image', ''); ?>');">
            <div class="hero-content">
                <h1 class="hero-title"><?php echo get_theme_mod('hero_title', 'Welcome to Lumora!'); ?></h1>
                <p class="hero-description"><?php echo get_theme_mod('hero_description', 'Your tagline or description goes here.'); ?></p>
                <a class="hero-button" href="<?php echo get_theme_mod('hero_button_url', '#'); ?>">
                    <?php echo get_theme_mod('hero_button_text', 'Learn More'); ?>
                </a>
            </div>
        </section>
        
        <!-- Page Content -->
        <div class="container">
            <?php 
            if ( have_posts() ):
                while ( have_posts() ): the_post();
                    get_template_part( 'template-parts/content', 'page' );
                endwhile;
            else :
                get_template_part( 'template-parts/content-none' );
            endif;
            ?>
        </div>
    </main>
</div>

<?php
get_footer();
?>
