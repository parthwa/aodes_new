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
?>
<?php
$review_count = $product->get_review_count();
if ( $review_count == 0 || $review_count > 1 ) {
	$review_count_var = $review_count . esc_html__( ' Reviews', 'brator' );
} else {
	$review_count_var = $review_count . esc_html__( ' Review', 'brator' );
}
$newness_days = 30; // Number of days the badge is shown
$created      = strtotime( $product->get_date_created() );

$stock_quantity = $product->get_stock_quantity();

$sale_stock_quantity = get_post_meta( $product->get_id(), 'total_sales', true );
?>
<div class="splide__slide">
	<div <?php wc_product_class( 'brator-product-single-item-area design-one design-one-with-three style-four', $product ); ?>>
		<div class="brator-product-single-item-info content-flex">
			<div class="brator-product-single-item-info-left">
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
			</div>
			<div class="brator-product-single-item-info-right">
				<?php if ( function_exists( 'activation_tinv_wishlist' ) ) { ?>
				<div class="brator-product-wishlist">
					<?php echo do_shortcode( '[ti_wishlists_addtowishlist loop=yes]' ); ?>
				</div>
				<?php } ?>
			</div>
		</div>
		<div class="brator-product-single-item-img">
			<a href="<?php esc_url( the_permalink() ); ?>"><?php echo brator_the_product_thumbnail(); ?></a>
		</div>
		<div class="brator-product-single-item-mini">
			<?php if ( $price_html = $product->get_price_html() ) : ?>
			<div class="brator-product-single-item-price">
				<p><?php echo wp_kses( $price_html, 'code_contxt' ); ?></p>
			</div>
			<?php endif; ?>
			<div class="brator-product-single-item-title">
				<h5><a href="<?php esc_url( the_permalink() ); ?>"> <?php the_title(); ?></a></h5>
			</div>
			<?php if ( $product->get_average_rating() ) : ?>
			<div class="brator-product-single-item-review">
				<div class="brator-review">
					<?php echo wc_get_rating_html( $product->get_average_rating() ); ?>
				</div>
				<div class="brator-review-text">
					<p><?php echo esc_html( $review_count_var ); ?></p>
				</div>
			</div>
			<?php endif; ?>
			<?php
			if ( $stock_quantity ) :
				$sale_percentage = ( $sale_stock_quantity / $stock_quantity ) * 100;
				if ( $sale_percentage < 50 ) {
					$bar_class = 'border-green';
				} elseif ( $sale_percentage >= 75 ) {
					$bar_class = 'border-red';
				} elseif ( $sale_percentage >= 50 ) {
					$bar_class = 'border-yellow';
				}
				?>
			<div class="brator-product-single-item-bar"><span class="<?php echo esc_attr( $bar_class ); ?>" style="width: <?php echo esc_attr( $sale_percentage ); ?>%"></span></div>
			<div class="brator-product-single-item-sold">
				<p><?php esc_html_e( 'sold:', 'brator' ); ?><span><?php echo esc_html( $sale_stock_quantity ); ?>/<?php echo esc_html( $stock_quantity ); ?></span></p>
			</div>
			<?php endif; ?>
			<div class="brator-product-single-item-btn">
				<?php woocommerce_template_loop_add_to_cart(); ?>
				<a class="icon-btn" href="#"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"><path d="M 16 4 C 10.886719 4 6.617188 7.160156 4.875 11.625 L 6.71875 12.375 C 8.175781 8.640625 11.710938 6 16 6 C 19.242188 6 22.132813 7.589844 23.9375 10 L 20 10 L 20 12 L 27 12 L 27 5 L 25 5 L 25 8.09375 C 22.808594 5.582031 19.570313 4 16 4 Z M 25.28125 19.625 C 23.824219 23.359375 20.289063 26 16 26 C 12.722656 26 9.84375 24.386719 8.03125 22 L 12 22 L 12 20 L 5 20 L 5 27 L 7 27 L 7 23.90625 C 9.1875 26.386719 12.394531 28 16 28 C 21.113281 28 25.382813 24.839844 27.125 20.375 Z"/></svg></a>
				<a class="icon-btn" href="<?php esc_url( the_permalink() ); ?>"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"><path d="M 16 8 C 7.664063 8 1.25 15.34375 1.25 15.34375 L 0.65625 16 L 1.25 16.65625 C 1.25 16.65625 7.097656 23.324219 14.875 23.9375 C 15.246094 23.984375 15.617188 24 16 24 C 16.382813 24 16.753906 23.984375 17.125 23.9375 C 24.902344 23.324219 30.75 16.65625 30.75 16.65625 L 31.34375 16 L 30.75 15.34375 C 30.75 15.34375 24.335938 8 16 8 Z M 16 10 C 18.203125 10 20.234375 10.601563 22 11.40625 C 22.636719 12.460938 23 13.675781 23 15 C 23 18.613281 20.289063 21.582031 16.78125 21.96875 C 16.761719 21.972656 16.738281 21.964844 16.71875 21.96875 C 16.480469 21.980469 16.242188 22 16 22 C 15.734375 22 15.476563 21.984375 15.21875 21.96875 C 11.710938 21.582031 9 18.613281 9 15 C 9 13.695313 9.351563 12.480469 9.96875 11.4375 L 9.9375 11.4375 C 11.71875 10.617188 13.773438 10 16 10 Z M 16 12 C 14.34375 12 13 13.34375 13 15 C 13 16.65625 14.34375 18 16 18 C 17.65625 18 19 16.65625 19 15 C 19 13.34375 17.65625 12 16 12 Z M 7.25 12.9375 C 7.09375 13.609375 7 14.285156 7 15 C 7 16.753906 7.5 18.394531 8.375 19.78125 C 5.855469 18.324219 4.105469 16.585938 3.53125 16 C 4.011719 15.507813 5.351563 14.203125 7.25 12.9375 Z M 24.75 12.9375 C 26.648438 14.203125 27.988281 15.507813 28.46875 16 C 27.894531 16.585938 26.144531 18.324219 23.625 19.78125 C 24.5 18.394531 25 16.753906 25 15 C 25 14.285156 24.90625 13.601563 24.75 12.9375 Z"/></svg></a>
			</div>
		</div>
	</div>
</div>
