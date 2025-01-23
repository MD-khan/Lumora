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
        add_action( 'init', [ $this, 'register_block_patterns' ] );
        add_action( 'init', [ $this, 'register_block_pattern_categories' ] );
    }

    /**
     * Registers custom block patterns.
     */
    public function register_block_patterns() {
        // Ensure function exists
        if ( ! function_exists( 'register_block_pattern' ) ) {
            return;
        }

        // Define block pattern paths and register them
        $patterns = [
            'hero-section' => 'template-parts/patterns/hero.php',
            'footer-section' => 'template-parts/patterns/footer.php', // Example of another pattern
        ];

        foreach ( $patterns as $pattern_name => $pattern_path ) {
            $content = $this->get_pattern_content( $pattern_path );

            if ( $content ) {
                register_block_pattern(
                    "lumora/{$pattern_name}",
                    [
                        'title'       => __( ucwords( str_replace( '-', ' ', $pattern_name ) ), 'lumora' ),
                        'description' => __( "The {$pattern_name} block pattern.", 'lumora' ),
                        'content'     => $content,
                        'categories'  => [ 'lumora-general' ],
                        'keywords'    => explode( '-', $pattern_name ),
                    ]
                );
            }
        }
    }

    /**
     * Registers custom block pattern categories.
     */
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

    /**
     * Loads block pattern content from a file.
     *
     * @param string $relative_path Path to the pattern file relative to the theme directory.
     * @return string|false The content of the pattern file or false on failure.
     */
    private function get_pattern_content( $relative_path ) {
        $absolute_path = get_template_directory() . '/' . $relative_path;

        if ( file_exists( $absolute_path ) ) {
            return file_get_contents( $absolute_path );
        }

        return false;
    }
}
