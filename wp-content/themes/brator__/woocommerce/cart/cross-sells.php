<?php
/**
 * Cross-sells
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cross-sells.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.4.0
 */

defined( 'ABSPATH' ) || exit;

if ( $cross_sells ) : ?>
<div class="brator-forget-product-slider">
		<?php
		$heading = apply_filters( 'woocommerce_product_cross_sells_products_heading', __( 'Forgot Something?', 'brator' ) );
		if ( $heading ) :
			?>
	<div class="brator-section-header">
		<div class="brator-section-header-title">
			<h2><?php echo esc_html( $heading ); ?></h2>
		</div>
	</div>
	<?php endif; ?>
	<div class="brator-product-slider splide js-splide p-splide" data-splide="{&quot;pagination&quot;:false,&quot;type&quot;:&quot;slide&quot;,&quot;perPage&quot;:4,&quot;perMove&quot;:&quot;1&quot;,&quot;gap&quot;:30, &quot;breakpoints&quot;:{ &quot;620&quot; :{ &quot;perPage&quot;: &quot;1&quot; },&quot;991&quot; :{ &quot;perPage&quot;: &quot;2&quot; }, &quot;1030&quot; :{ &quot;perPage&quot; : &quot;3&quot; }, &quot;1199&quot;:{ &quot;perPage&quot; : &quot;4&quot; }, &quot;1500&quot;:{ &quot;perPage&quot; : &quot;3&quot; }, &quot;1600&quot;:{ &quot;perPage&quot; : &quot;4&quot; }, &quot;1599&quot;:{ &quot;perPage&quot; : &quot;3&quot; }, &quot;1920&quot;:{ &quot;perPage&quot; : &quot;4&quot; }}}">
		<div class="splide__arrows style-one">
			<button class="splide__arrow splide__arrow--prev">
			<svg class="bi bi-chevron-right" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
				<path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"></path>
			</svg>
			</button>
			<button class="splide__arrow splide__arrow--next">
			<svg class="bi bi-chevron-right" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
				<path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"></path>
			</svg>
			</button>
		</div>
		<div class="splide__track">
			<div class="splide__list">
			<?php foreach ( $cross_sells as $cross_sell ) : ?>

				<?php
					$post_object = get_post( $cross_sell->get_id() );

					setup_postdata( $GLOBALS['post'] =& $post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found

					wc_get_template_part( 'content', 'product-slidetwo' );
				?>

			<?php endforeach; ?>		
			</div>
		</div>
	</div>
</div>
	<?php
endif;

wp_reset_postdata();
?>
