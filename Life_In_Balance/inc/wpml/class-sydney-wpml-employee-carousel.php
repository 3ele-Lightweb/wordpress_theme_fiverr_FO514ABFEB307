<?php

/**
 * Integration with WPML for aThemes: Testimonials block
 */
class Life_In_Balance_Pro_WPML_Elementor_Employees extends WPML_Elementor_Module_With_Items {
	
 
	/**
	 * @return string
	 */
	public function get_items_field() {
	   return 'employee_list';
	}
   
	/**
	 * @return array
	 */
	public function get_fields() {
	   return array( 'person', 'position', 'link' => array( 'url' ), );
	}
   
	/**
	 * @param string $field
	 *
	 * @return string
	 */
	protected function get_title( $field ) {
	   switch( $field ) {
			case 'person':
				return esc_html__( '[aThemes Employees] Name', 'life_in_balance' );
   
		  	case 'position':
				return esc_html__( '[aThemes Employees] Position', 'life_in_balance' );
   
			case 'link':
				return esc_html__( '[aThemes Employees] Link', 'life_in_balance' );
   
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
			case 'person':
			case 'position':
			case 'link':	
				return 'LINE';
   
			default:
				return '';
	   }
	}

}