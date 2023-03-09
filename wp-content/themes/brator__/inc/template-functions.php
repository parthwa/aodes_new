<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package brator
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function brator_body_classes( $classes ) {

	$theme_base_css       = brator_get_options( 'theme_base_css' );
	$theme_base_css_class = 'base-theme';
	if ( $theme_base_css) :
		$theme_base_css_class = '';
	endif;

	$classes[] = $theme_base_css_class;

	return $classes;
}
add_filter( 'body_class', 'brator_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function brator_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'brator_pingback_header' );
