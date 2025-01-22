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
        add_action('init',[$this, 'register_block_pattern_categories'] );
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
                'categories'  => [ 'lumora-hero' ],
                'keywords'    => [ 'hero', 'full-width', 'banner' ],
            ]
        );
    }

    public function register_block_pattern_categories() {
        // Ensure function exists
        if ( ! function_exists( 'register_block_pattern_category' ) ) {
            return;
        }
    
        // Define block pattern categories
        $pattern_categories = [
            'lumora-general' => [
                'label' => __( 'Lumora General', 'lumora' ),
            ],
            'lumora-hero' => [
                'label' => __( 'Lumora Hero Sections', 'lumora' ),
            ],
            'lumora-footers' => [
                'label' => __( 'Lumora Footers', 'lumora' ),
            ],
        ];
    
        // Register each block pattern category
        foreach ( $pattern_categories as $category_name => $category_properties ) {
            register_block_pattern_category( $category_name, $category_properties );
        }
    }
    
}
