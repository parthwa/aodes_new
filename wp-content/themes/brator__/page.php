<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package brator
 */
get_header();
$page_single_col               = '12';
$brator_theme_metabox_page_col = get_post_meta( get_the_ID(), 'brator_theme_metabox_page_col', true );
if ( $brator_theme_metabox_page_col == 'on' ) :
	$page_single_col = '8';
endif;
$brator_theme_metabox_page_extra_class = get_post_meta( get_the_ID(), 'brator_theme_metabox_page_extra_class', true );
?>
<section class="brator-blog-post-area <?php echo esc_attr( $brator_theme_metabox_page_extra_class ); ?>">
	<div class="container-xxxl container-xxl container">
		<div class="row">
			<?php
			if ( $brator_theme_metabox_page_col == 'on' ) :
				do_action( 'page_advance_content_left' );
			endif;
			?>
			<div class="col-lg-<?php echo esc_attr( $page_single_col ); ?> col-md-12 col-sm-12 content-side">
				<div class="blog-details-content">
					<?php
					if ( have_posts() ) :
						while ( have_posts() ) :
							the_post();
							get_template_part( 'template-parts/content', 'page' );
						endwhile;
					endif;
					?>
				</div>
			</div>
			<?php
			if ( $brator_theme_metabox_page_col == 'on' ) :
				do_action( 'page_advance_content_right' );
			endif;
			?>
		</div>
	</div>
</section>
<?php
get_footer();
