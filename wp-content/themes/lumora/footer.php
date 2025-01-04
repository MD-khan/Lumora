<?php
/**
 * The footer template for the Lumora theme.
 *
 * Displays the footer content and widget area.
 *
 * @package Lumora
 * @since Lumora 1.0
 */
?>

<footer id="colophon" role="contentinfo">
    <div class="container">
        <h3>Footer</h3>

        <?php if ( is_active_sidebar( 'footer-widget' ) ) : ?>
            <div class="footer-widgets">
                <?php dynamic_sidebar( 'footer-widget' ); ?>
            </div>
        <?php else : ?>
            <p><?php esc_html_e( 'Add widgets to the footer from the Widgets panel in WordPress.', 'lumora' ); ?></p>
        <?php endif; ?>
    </div>
</footer>

</div><!-- ./site -->
</div><!-- ./site-content -->

<?php wp_footer(); ?>
</body>
</html>
