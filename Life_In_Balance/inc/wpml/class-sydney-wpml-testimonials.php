<?php

/**
 * Integration with WPML for aThemes: Testimonials block
 */
class Life_In_Balance_Pro_WPML_Elementor_Testimonials extends WPML_Elementor_Module_With_Items {
	
 
	/**
	 * @return string
	 */
	public function get_items_field() {
	   return 'testimonials_list';
	}
   
	/**
	 * @return array
	 */
	public function get_fields() {
	   return array( 'name', 'position', 'testimonial' );
	}
   
	/**
	 * @param string $field
	 *
	 * @return string
	 */
	protected function get_title( $field ) {
	   switch( $field ) {
			case 'name':
				return esc_html__( '[aThemes Testimonials] Name', 'life_in_balance' );
   
		  	case 'position':
				return esc_html__( '[aThemes Testimonials] Position', 'life_in_balance' );
   
			case 'testimonial':
				return esc_html__( '[aThemes Testimonials] Testimonial', 'life_in_balance' );
   
			default:
				return '';
	   }
	}
   
	/**
	 * @param string $field
	 *
	 * @return string
	 */
	protected function get_editor_type( $field ) {
	   switch( $field ) {
			case 'name':
			case 'position':
				return 'LINE';
   
			case 'testimonial':
				return 'VISUAL';
   
			default:
				return '';
	   }
	}

}