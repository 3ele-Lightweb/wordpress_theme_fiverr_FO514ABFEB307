<?php
/**
 * Page builder support
 *
 * @package Life_In_Balance
 */


/* Defaults */
add_theme_support( 'siteorigin-panels', array( 
	'margin-bottom' => 0,
) );

/* Theme widgets */
function life_in_balance_theme_widgets($widgets) {
	$theme_widgets = array(
		'Life_In_Balance_Services_Type_A',
		'Life_In_Balance_Services_Type_B',
		'Life_In_Balance_List',
		'Life_In_Balance_Facts',
		'Life_In_Balance_Clients',
		'Life_In_Balance_Testimonials',
		'Life_In_Balance_Skills',
		'Life_In_Balance_Action',
		'Life_In_Balance_Video_Widget',
		'Life_In_Balance_Social_Profile',
		'Life_In_Balance_Employees',
		'Life_In_Balance_Latest_News',
		'Life_In_Balance_Portfolio'
	);
	foreach($theme_widgets as $theme_widget) {
		if( isset( $widgets[$theme_widget] ) ) {
			$widgets[$theme_widget]['groups'] = array('life_in_balance-theme');
			$widgets[$theme_widget]['icon'] = 'dashicons dashicons-schedule';
		}
	}
	return $widgets;
}
add_filter('siteorigin_panels_widgets', 'life_in_balance_theme_widgets');

/* Add a tab for the theme widgets in the page builder */
function life_in_balance_theme_widgets_tab($tabs){
	$tabs[] = array(
		'title' => __('Life_In_Balance Theme Widgets', 'life_in_balance'),
		'filter' => array(
			'groups' => array('life_in_balance-theme')
		)
	);
	return $tabs;
}
add_filter('siteorigin_panels_widget_dialog_tabs', 'life_in_balance_theme_widgets_tab', 20);

/* Replace default row options */
function life_in_balance_row_styles($fields) {

	$fields['bottom_border'] = array(
		'name' => __('Bottom Border Color', 'life_in_balance'),
		'type' => 'color',
		'priority' => 3,
		'group'	   => 'design'		
	);
	$fields['padding'] = array(
		'name' => __('Top/bottom padding', 'life_in_balance'),
		'type' => 'measurement',
		'description' => __('Add a value in the field to change the top/bottom row padding, otherwise 100px will be applied by default', 'life_in_balance'),
		'priority' => 4,
		'group'	   => 'layout'
	);
	$fields['align'] = array(
		'name' => __('Center align the content?', 'life_in_balance'),
		'type' => 'checkbox',
		'description' => __('This may or may not work. It depends on the widget styles.', 'life_in_balance'),
		'priority' => 5,
		'group'	   => 'design'		
	);		

	$fields['color'] = array(
		'name' => __('Color', 'life_in_balance'),
		'type' => 'color',
		'description' => __('Color of the row.', 'life_in_balance'),
		'priority' => 7,
		'group'	   => 'design'	
	);	
	$fields['background_image'] = array(
		'name' => __('Background Image', 'life_in_balance'),
		'type' => 'image',
		'description' => __('Background image of the row.', 'life_in_balance'),
		'priority' => 8,
		'group'		=> 'design'
	);

	$fields['mobile_padding'] = array(
		'name' 		  => __('Mobile padding', 'life_in_balance'),
		'type' 		  => 'select',
		'description' => __('Here you can select a top/bottom row padding for screen sizes < 1024px', 'life_in_balance'),		
		'options' 	  => array(
			'' 				=> __('Default', 'life_in_balance'),
			'mob-pad-0' 	=> __('0', 'life_in_balance'),
			'mob-pad-15'    => __('15px', 'life_in_balance'),
			'mob-pad-30'    => __('30px', 'life_in_balance'),
			'mob-pad-45'    => __('45px', 'life_in_balance'),
		),
		'priority'    => 21,
		'group'	   => 'layout'		
	);
	$fields['overlay'] = array(
	    'name'        => __('Disable row overlay?', 'life_in_balance'),
	    'type'        => 'checkbox',
	    'group'       => 'design',
	    'priority'    => 14,
	);
	$fields['overlay_color'] = array(
	    'name'        => __('Overlay color', 'life_in_balance'),
	    'type'        => 'color',
	    'default'	  => '#000000',
	    'group'       => 'design',
	    'priority'    => 15,
	);

	return $fields;
}
//remove_filter('siteorigin_panels_row_style_fields', array('SiteOrigin_Panels_Default_Styling', 'row_style_fields' ) );
add_filter('siteorigin_panels_row_style_fields', 'life_in_balance_row_styles');

/* Filter for the styles */
function life_in_balance_row_styles_output($attr, $style) {
	//$attr['style'] = '';

	if(!empty($style['bottom_border'])) $attr['style'] .= 'border-bottom: 1px solid '. esc_attr($style['bottom_border']) . ';';
	
	if(!empty($style['color'])) {
		$attr['style'] .= 'color: ' . esc_attr($style['color']) . ';';
		$attr['data-hascolor'] = 'hascolor';
	}
	
	if(!empty($style['align'])) $attr['style'] .= 'text-align: center;';
	if(!empty( $style['background_image'] )) {
		$url = wp_get_attachment_image_src( $style['background_image'], 'full' );
		if( !empty($url) ) {
			$attr['style'] .= 'background-image: url(' . esc_url($url[0]) . ');';
			$attr['data-hasbg'] = 'hasbg';
		}
	}
	if(!empty($style['padding'])) {
		$attr['style'] .= 'padding: ' . esc_attr($style['padding']) . ' 0; ';
	} else {
		$attr['style'] .= 'padding: 100px 0; ';
	}

	if( !empty( $style['mobile_padding'] ) ) {
		$attr['class'][] = esc_attr($style['mobile_padding']);
	}
    if( !empty( $style['column_padding'] ) ) {
       $attr['class'][] = 'no-col-padding';
    }
    
	if ( empty($style['overlay']) ) {
    	$attr['data-overlay'] = 'true';
	}
	if ( !empty($style['overlay_color']) ) {
    	$attr['data-overlay-color'] = esc_attr($style['overlay_color']);		
	}

	if(empty($attr['style'])) unset($attr['style']);
	return $attr;
}
add_filter('siteorigin_panels_row_style_attributes', 'life_in_balance_row_styles_output', 10, 2);

/**
 * Page builder widget options
 */
function life_in_balance_custom_widget_style_fields($fields) {
	$fields['content_alignment'] = array(
	    'name'        => __('Content alignment', 'life_in_balance'),
		'type' 		  => 'select',
	    'group'       => 'design',
		'options' => array(
			'left' => __('Left', 'life_in_balance'),
			'center' => __('Center', 'life_in_balance'),
			'right' => __('Right', 'life_in_balance'),
		),
		'default'	  => 'left',
	    'description' => __('This setting depends on the content, it may or may not work', 'life_in_balance'),
	    'priority'    => 10,
	);	
	$fields['title_color'] = array(
	    'name'        => __('Widget title color', 'life_in_balance'),
	    'type'        => 'color',
	    'default'	  => '#443f3f',
	    'group'       => 'design',
	    'priority'    => 11,
	);	
	$fields['headings_color'] = array(
	    'name'        => __('Headings color', 'life_in_balance'),
	    'type'        => 'color',
	    'default'	  => '#443f3f',
	    'group'       => 'design',
	    'description' => __('This applies to all headings in the widget, except the widget title', 'life_in_balance'),
	    'priority'    => 12,
	);

  return $fields;
}
add_filter( 'siteorigin_panels_widget_style_fields', 'life_in_balance_custom_widget_style_fields');

/**
 * Output page builder widget options
 */
function life_in_balance_custom_widget_style_attributes( $attributes, $args ) {

	if ( !empty($args['title_color']) ) {
    	$attributes['data-title-color'] = esc_attr($args['title_color']);		
	}
	if ( !empty($args['headings_color']) ) {
    	$attributes['data-headings-color'] = esc_attr($args['headings_color']);		
	}
	if ( !empty($args['content_alignment']) ) {
		$attributes['style'] .= 'text-align: ' . esc_attr($args['content_alignment']) . ';';
	}	
    return $attributes;
}
add_filter('siteorigin_panels_widget_style_attributes', 'life_in_balance_custom_widget_style_attributes', 10, 2);

/**
 * Remove defaults
 */
function life_in_balance_remove_default_so_row_styles( $fields ) {
	unset( $fields['background_image_attachment'] );
	unset( $fields['background_display'] );
	unset( $fields['border_color'] );	
	return $fields;
}
add_filter('siteorigin_panels_row_style_fields', 'life_in_balance_remove_default_so_row_styles' );
add_filter('siteorigin_premium_upgrade_teaser', '__return_false');