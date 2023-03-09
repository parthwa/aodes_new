<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package brator
 */

?>
<section class="no-results not-found sidebar-widget">
	<?php
	if ( is_home() && current_user_can( 'publish_posts' ) ) :
		printf(
			'<p>' . wp_kses(
				/* translators: 1: link to WP admin new post page. */
				__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'brator' ),
				array(
					'a' => array(
						'href' => array(),
					),
				)
			) . '</p>',
			esc_url( admin_url( 'post-new.php' ) )
		);
	elseif ( is_search() ) :
		?>
		<p class="no-found-text"><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'brator' ); ?></p>
		<div class="nothing-found-search">
		<?php get_search_form(); ?>
		</div>
		<?php
	else :
		?>
		<p class="no-found-text"><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'brator' ); ?></p>
		<div class="nothing-found-search">
		<?php get_search_form(); ?>
		</div>
		<?php
	endif;
	?>
</section>
