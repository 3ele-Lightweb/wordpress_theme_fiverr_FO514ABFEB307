<?php

/**
 * This file registers the Projects custom post type
 *
 * @package    	Life_In_Balance_Toolbox
 * @link        http://athemes.com
 * Author:      aThemes
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */


// Register the Projects custom post type
function life_in_balance_toolbox_register_projects() {

	$slug = apply_filters( 'life_in_balance_projects_rewrite_slug', 'projects' );	

	$labels = array(
		'name'                  => _x( 'Projects', 'Post Type General Name', 'life_in_balance_toolbox' ),
		'singular_name'         => _x( 'Project', 'Post Type Singular Name', 'life_in_balance_toolbox' ),
		'menu_name'             => __( 'Projects', 'life_in_balance_toolbox' ),
		'name_admin_bar'        => __( 'Projects', 'life_in_balance_toolbox' ),
		'archives'              => __( 'Item Archives', 'life_in_balance_toolbox' ),
		'parent_item_colon'     => __( 'Parent Item:', 'life_in_balance_toolbox' ),
		'all_items'             => __( 'All Projects', 'life_in_balance_toolbox' ),
		'add_new_item'          => __( 'Add New Project', 'life_in_balance_toolbox' ),
		'add_new'               => __( 'Add New Project', 'life_in_balance_toolbox' ),
		'new_item'              => __( 'New Project', 'life_in_balance_toolbox' ),
		'edit_item'             => __( 'Edit Project', 'life_in_balance_toolbox' ),
		'update_item'           => __( 'Update Project', 'life_in_balance_toolbox' ),
		'view_item'             => __( 'View Project', 'life_in_balance_toolbox' ),
		'search_items'          => __( 'Search Project', 'life_in_balance_toolbox' ),
		'not_found'             => __( 'Not found', 'life_in_balance_toolbox' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'life_in_balance_toolbox' ),
		'featured_image'        => __( 'Featured Image', 'life_in_balance_toolbox' ),
		'set_featured_image'    => __( 'Set featured image', 'life_in_balance_toolbox' ),
		'remove_featured_image' => __( 'Remove featured image', 'life_in_balance_toolbox' ),
		'use_featured_image'    => __( 'Use as featured image', 'life_in_balance_toolbox' ),
		'insert_into_item'      => __( 'Insert into item', 'life_in_balance_toolbox' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'life_in_balance_toolbox' ),
		'items_list'            => __( 'Items list', 'life_in_balance_toolbox' ),
		'items_list_navigation' => __( 'Items list navigation', 'life_in_balance_toolbox' ),
		'filter_items_list'     => __( 'Filter items list', 'life_in_balance_toolbox' ),
	);
	$args = array(
		'label'                 => __( 'Project', 'life_in_balance_toolbox' ),
		'description'           => __( 'A post type for your projects', 'life_in_balance_toolbox' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
		'taxonomies'            => array( 'category' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 26,
		'menu_icon'             => 'dashicons-desktop',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
		'rewrite' 				=> array( 'slug' => $slug ),		
	);
	register_post_type( 'projects', $args );

}
add_action( 'init', 'life_in_balance_toolbox_register_projects', 0 );