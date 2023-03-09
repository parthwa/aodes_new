<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package brator
 */

?>
<div class="page-content">
<?php
the_content();
wp_link_pages(
	array(
		'before' => '<div class="page-links">',
		'after'  => '</div>',
	)
);
?>
</div>
<div class="row">
	<div class="col-lg-10 col-sm-12">
	<?php
	// If comments are open or we have at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) :
		comments_template();
	endif;
	?>
	</div>
</div>
