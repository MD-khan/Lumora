<?php
/**
 * Manages theme block patterns.
 */

namespace Lumora\Inc;

use Lumora\Inc\Traits\Singleton;

class Block_Patterns {

    use Singleton;

    protected function __construct() {
        $this->setup_hooks();
    }

    protected function setup_hooks() {
        /**
         * Actions
         */
        add_action('init', [$this, 'register_block_patterns']);
    }

    /**
     * Registers custom block patterns.
     */
    public function register_block_patterns() {
        // Ensure function exists
        if ( ! function_exists( 'register_block_pattern' ) ) {
            return;
        }

        // Define block pattern category
        register_block_pattern_category(
            'lumora-category',
            [ 'label' => __( 'Lumora Patterns', 'lumora' ) ]
        );

        // Register individual block patterns
        register_block_pattern(
            'lumora/hero-section',
            [
                'title'       => __( 'Hero Section', 'lumora' ),
                'description' => _x( 'A full-width hero section with a heading, subheading, and call-to-action button.', 'Pattern description', 'lumora' ),
                'content'     => '<!-- wp:cover {"url":"example.jpg","align":"full"} -->
                    <div class="wp-block-cover alignfull">
                        <div class="wp-block-cover__inner-container">
                            <!-- wp:heading -->
                            <h2>Your Hero Heading</h2>
                            <!-- /wp:heading -->

                            <!-- wp:paragraph -->
                            <p>Your hero subheading goes here.</p>
                            <!-- /wp:paragraph -->

                            <!-- wp:button -->
                            <div class="wp-block-button"><a class="wp-block-button__link">Call to Action</a></div>
                            <!-- /wp:button -->
                        </div>
                    </div>
                    <!-- /wp:cover -->',
                'categories'  => [ 'lumora-category' ],
                'keywords'    => [ 'hero', 'full-width', 'banner' ],
            ]
        );
    }
}
