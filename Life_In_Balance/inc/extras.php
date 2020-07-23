<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Life_In_Balance
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function life_in_balance_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}
add_filter( 'body_class', 'life_in_balance_body_classes' );

/**
 * Support for Yoast SEO breadcrumbs
 */
function life_in_balance_yoast_seo_breadcrumbs() {
	if ( function_exists('yoast_breadcrumb') ) {
		yoast_breadcrumb('
		<p class="life_in_balance-breadcrumbs">','</p>
		');
	}
}