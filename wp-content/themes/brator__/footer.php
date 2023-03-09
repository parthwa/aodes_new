<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package brator
 */

get_template_part( 'components/footer/footer-top' );
$footer_style_meta = get_post_meta( get_the_ID(), 'brator_core_footer_style', true );
if ( $footer_style_meta ) {
	$footer_style = $footer_style_meta;
} else {
	$footer_style = "3";
}

if ( $footer_style == '3' ) {
	get_template_part( 'components/footer/footer-3' );
} elseif ( $footer_style == '2' ) {
	get_template_part( 'components/footer/footer-2' );
} else {
	get_template_part( 'components/footer/footer-1' );
}
do_action( 'brator_back_to_top' );

?>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
    integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
    crossorigin="anonymous"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
    integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
    crossorigin="anonymous"></script>

  <script src="<?php echo get_stylesheet_directory_uri();?>/assets/js/main.js"></script>
</div>
<?php wp_footer(); ?>
</body>
</html>
