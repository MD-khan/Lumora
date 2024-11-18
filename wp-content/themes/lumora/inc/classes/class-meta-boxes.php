<?php
/**
 * Register Meta boxes
 * @package Lumora
 */ 

namespace Lumora\Inc;

use Lumora\Inc\Traits\Singleton;

class Meta_Boxes {

    use Singleton;

    /**
     * Constructor.
     */
    protected function __construct() {
        $this->setup_hooks();
    }

    /**
     * Setup WordPress hooks.
     */
    protected function setup_hooks() { 
        /**
         * Actions
         */
        add_action( 'add_meta_boxes', [ $this, 'add_custom_meta_boxes' ] );
        add_action( 'save_post', [ $this, 'save_post_meta_data' ] );
    }

    /**
     * Add custom meta boxes to specified post types.
     */
    public function add_custom_meta_boxes()  {
        // Define the post types where the meta box should appear.
        // Change 'post' to 'page' if you intend to use this on pages.
        $screens = [ 'post' ];

        foreach ( $screens as $screen ) {
            add_meta_box( 
                'hide-page-title', // ID of the meta box
                __( 'Hide Page Title', 'lumora' ), // Title of the meta box
                [ $this, 'custom_meta_box_html' ], // Callback function
                $screen, // Post type
                'side', // Context: 'side', 'normal', or 'advanced'
                'high' // Priority: 'high', 'default', or 'low'
            );
        }
    }

    /**
     * Render the meta box HTML.
     *
     * @param WP_Post $post Current post object.
     */
    public function custom_meta_box_html( $post ) {

        // Add a nonce field for security.
        wp_nonce_field( 
            'hide_page_title_nonce_action', // Action name
            'hide_page_title_nonce' // Nonce field name
        );

        // Retrieve the current value of the meta field.
        $value = get_post_meta( $post->ID, '_hide-page-title', true );
        ?>
        <label for="lumora_hide_title_field"><?php esc_html_e( 'Hide the page title', 'lumora' ); ?></label>
        <select name="lumora_hide_title_field" id="lumora_hide_title_field" class="postbox mt-2">
            <option value=""><?php esc_html_e( 'Select', 'lumora' ); ?></option>
            <option value="yes" <?php selected( $value, 'yes' ); ?>> 
                <?php esc_html_e( 'Yes', 'lumora' ); ?>
            </option>
            <option value="no" <?php selected( $value, 'no' ); ?>><?php esc_html_e( 'No', 'lumora' ); ?></option>
        </select>
        <?php
    }

    /**
     * Save the meta box data.
     *
     * @param int $post_id The ID of the post being saved.
     */
    public function save_post_meta_data( $post_id ) {

        // Check if our nonce is set.
        if ( ! isset( $_POST['hide_page_title_nonce'] ) ) {
            return;
        }

        // Verify that the nonce is valid.
        if ( ! wp_verify_nonce( $_POST['hide_page_title_nonce'], 'hide_page_title_nonce_action' ) ) {
            return;
        }

        // If this is an autosave, our form has not been submitted, so we don't want to do anything.
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return;
        }

        // Check the user's permissions.
        // Change 'edit_post' to 'edit_page' if you're adding this meta box to pages.
        if ( isset( $_POST['post_type'] ) && 'post' === $_POST['post_type'] ) {
            if ( ! current_user_can( 'edit_post', $post_id ) ) {
                return;
            }
        } else {
            if ( ! current_user_can( 'edit_post', $post_id ) ) { // Adjust capability if needed
                return;
            }
        }

        // Make sure that the field is set.
        if ( ! isset( $_POST['lumora_hide_title_field'] ) ) {
            return;
        }

        // Sanitize user input.
        $my_data = sanitize_text_field( $_POST['lumora_hide_title_field'] );

        // Update the meta field in the database.
        update_post_meta( $post_id, '_hide-page-title', $my_data );
    }

}
