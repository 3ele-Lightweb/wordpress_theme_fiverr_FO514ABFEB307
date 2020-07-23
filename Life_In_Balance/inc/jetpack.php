<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package Life_In_Balance
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function life_in_balance_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'footer'    => 'page',
	) );
}
add_action( 'after_setup_theme', 'life_in_balance_jetpack_setup' );
