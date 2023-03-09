<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package brator
 */

get_header();
	$blog_style = get_query_var( 'blog_style' );
if ( ! $blog_style ) {
	$blog_style = brator_get_options( 'blog_style' );
}
if ( $blog_style == 1 ) :
	$blog_style_name = 'standard';
elseif ( $blog_style == 2 ) :
	$blog_style_name = 'grid';
elseif ( $blog_style == 3 ) :
	$blog_style_name = 'grid-2';
else :
	$blog_style_name = 'standard';
endif;
get_template_part( 'template-parts/blog-layout/blog-' . $blog_style_name );
get_footer();
