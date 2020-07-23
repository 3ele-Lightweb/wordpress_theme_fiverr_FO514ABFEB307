<?php

/**
 * Integration with WPML for aThemes: Testimonials block
 */
class Life_In_Balance_Pro_WPML_Elementor_Portfolio extends WPML_Elementor_Module_With_Items {
	
 
	/**
	 * @return string
	 */
	public function get_items_field() {
	   return 'portfolio_list';
	}
   
	/**
	 * @return array
	 */
	public function get_fields() {
	   return array( 'title', 'term', 'link' => array( 'url' ), );
	}
   
	/**
	 * @param string $field
	 *
	 * @return string
	 */
	protected function get_title( $field ) {
	   switch( $field ) {
			case 'title':
				return esc_html__( '[aThemes Portfolio] Title', 'life_in_balance' );
   
		  	case 'term':
				return esc_html__( '[aThemes Portfolio] Term', 'life_in_balance' );
   
			case 'link':
				return esc_html__( '[aThemes Portfolio] Link', 'life_in_balance' );
   
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
			case 'title':
			case 'term':
			case 'link':	
				return 'LINE';
   
			default:
				return '';
	   }
	}

}