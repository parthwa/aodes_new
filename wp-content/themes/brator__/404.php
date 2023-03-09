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
?>
<div class="brator-blog-post-area error-section">
	<div class="container-xxxl container-xxl container">
		<div class="content-box">
			<h1><?php esc_html_e( '404', 'brator' ); ?></h1>
			<h2><?php esc_html_e( 'We’re unable to find a page you are looking for, Try later or click the button.', 'brator' ); ?></h2>
			<a href="<?php echo esc_url( get_home_url() ); ?>" class="theme-btn-one"><?php esc_html_e( 'Back to Home', 'brator' ); ?></a>
		</div>
	</div>
</div>
<?php
get_footer();
