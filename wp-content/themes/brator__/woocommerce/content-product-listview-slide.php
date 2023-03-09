<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || false === wc_get_loop_product_visibility( $product->get_id() ) || ! $product->is_visible() ) {
	return;
}

$review_count = $product->get_review_count();
if ( $review_count == 0 || $review_count > 1 ) {
	$review_count_var = $review_count . esc_html__( ' Reviews', 'brator' );
} else {
	$review_count_var = $review_count . esc_html__( ' Review', 'brator' );
}
?>
<div class="splide__slide">
	<div class="list-product-item">
		<div class="list-product-item-img">
			<?php
			if ( $product->is_on_sale() ) {
				$prices   = brator_get_product_prices( $product );
				$returned = brator_product_special_price_calc( $prices );
				if ( isset( $returned['percent'] ) && $returned['percent'] ) {
					?>
				<div class="off-batch"><?php echo sprintf( esc_html__( '%d%% Off', 'brator' ), $returned['percent'] ); ?></div>
					<?php
				}
			}
			?>
			<?php the_post_thumbnail( 'brator-sidebar-post-90' ); ?>
		</div>
		<div class="list-product-item-text">
			<?php if ( $price_html = $product->get_price_html() ) : ?>
				<div class="price"><?php echo wp_kses( $price_html, 'code_contxt' ); ?></div>
			<?php endif; ?>
			<h6><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
		</div>
	</div>
</div>
