<?php
/**
 *  Register Meta boxes
 * @package Lumora
 */ 

namespace Lumora\Inc;
use Lumora\Inc\Traits\Singleton;

class Meta_Boxes {

    use Singleton;

    
   protected function __construct() {

    $this->setup_hooks();

   }

   protected function setup_hooks() { 
    /**
     * Actions
     */
    add_action("add_meta_boxes", [$this,"add_custom_meta_boxes"] );
    
   }

   public function add_custom_meta_boxes()  {
    $screens = ['post'];
    foreach ( $screens as $screen ) {
        add_meta_box( 
        'hide-page-title',
            __('Hide Page Titile', 'lumora' ),
            [$this, 'custom_meta_box_html'],
            $screen,
            'side'
        );
    }
   }

   public function custom_meta_box_html( $post ) {

    $value = get_post_meta( $post->ID, '_hide-page-title', true );
	?>
	<label for="lumora-field"><?php esc_html_e('Hide the page title','lumora'); ?></label>
	<select name="lumora_field" id="lumora-field" class="postbox">
		<option value=""><?php esc_html_e('Select', 'lumora'); ?></option>
		<option value="yes" <?php selected( $value, 'yes' ); ?>> 
            <?php esc_html_e('Yes', 'lumora'); ?>
        </option>
		<option value="no" <?php selected( $value, 'no' ); ?>><?php esc_html_e('No', 'lumora'); ?></option>
	</select>
	<?php
   }

}