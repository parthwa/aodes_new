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
?>
<div <?php wc_product_class( 'brator-product-single-item-area design-three', $product ); ?>>
	<div class="brator-product-single-item-area-left">
		<div class="brator-product-single-item-info info-content-flex">
			<div class="brator-product-single-item-info-right">
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
				<?php
				if ( ( time() - ( 60 * 60 * 24 * $newness_days ) ) < $created ) {
					echo '<div class="yollow-batch">' . esc_html__( 'New', 'brator' ) . '</div>';
				}
				?>
				<?php if ( ! $product->is_in_stock() ) { ?>
				<div class="stock-out-batch"><?php esc_html_e( 'Out OF stock', 'brator' ); ?></div>
				<?php } ?>
			</div>
		</div>
		<div class="brator-product-single-item-img">
			<a href="<?php esc_url( the_permalink() ); ?>"><?php echo brator_the_product_thumbnail(); ?></a>
		</div>
	</div>
	<div class="brator-product-single-item-area-mdl">
		<div class="brator-product-single-item-mini">
			<div class="brator-product-single-item-cat"><?php echo wc_get_product_category_list( $product->get_id() ); ?></div>
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
			<div class="brator-product-single-item-featu">
				<?php the_excerpt(); ?>
			</div>
		</div>
	</div>
	<div class="brator-product-single-item-area-right">
		<?php if ( $price_html = $product->get_price_html() ) : ?>
		<div class="brator-product-single-item-price">
			<p><?php echo wp_kses( $price_html, 'code_contxt' ); ?></p>
			<span>
				<?php
				if ( wc_prices_include_tax() ) {
					esc_html_e( 'Included Tax', 'brator' );
				} else {
					esc_html_e( 'Excluded Tax', 'brator' );
				}
				?>
			</span>
		</div>
		<?php endif; ?>
		<div class="brator-product-single-item-btn">
			<div class="brator-product-single-item-btn-cart">
			<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
			<div class="brator-product-single-cart-action">
			<?php if ( function_exists( 'activation_tinv_wishlist' ) ) { ?>
			<div class="brator-product-single-cart-wish">
				<?php echo do_shortcode( '[ti_wishlists_addtowishlist loop=yes]' ); ?>
			</div>
			<?php } ?>
			</div>
		</div>
	</div>
</div>
