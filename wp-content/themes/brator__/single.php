<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package brator
 */
get_header();
if ( is_active_sidebar( 'sidebar-1' ) ) :
	$blog_post_list_class = 'col-lg-9';
else :
	$blog_post_list_class = 'col-lg-12';
endif;
?>
<div class="brator-blog-single-post-area">
	<div class="container-xxxl container-xxl container">
		<div class="row">
			<div class="<?php echo esc_attr( $blog_post_list_class ); ?>">
				<?php
				if ( have_posts() ) :
					while ( have_posts() ) :
						the_post();
						get_template_part( 'template-parts/single/content' );
						endwhile;
					endif;
				?>
			</div>
			<?php if ( is_active_sidebar( 'sidebar-1' ) ) { ?>
				<div class="col-lg-3">
					<div class="brator-blog-post-sidebar">
						<?php get_sidebar(); ?>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
</div>
<?php
get_footer();
