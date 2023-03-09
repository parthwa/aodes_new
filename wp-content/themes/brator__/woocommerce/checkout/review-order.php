<?php
/**
 * Review order table
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/review-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 5.2.0
 */

defined( 'ABSPATH' ) || exit;
?>

<div class="payment_list_item">
	<div class="price_single_cost">
		<?php
		do_action( 'woocommerce_review_order_before_cart_contents' );
		foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
			$_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

			if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
				?>
		<h5
			class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
				<?php echo apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;'; ?>
				<?php echo apply_filters( 'woocommerce_checkout_cart_item_quantity', ' <b class="product-quantity">' . sprintf( 'x&nbsp;%s', $cart_item['quantity'] ) . '</b>', $cart_item, $cart_item_key ); ?>
			<span
				class="motodeal-checkout-order-price"><?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); ?></span>
		</h5>
				<?php
			}
		}
		do_action( 'woocommerce_review_order_after_cart_contents' );
		?>
	</div>
</div>
<div class="payment_list_item">
	<div class="count_part">
		<h5><?php esc_html_e( 'Subtotal', 'brator' ); ?> <span class="motodeal-checkout-order-price"><?php wc_cart_totals_subtotal_html(); ?></span></h5>
		<?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
		<h5 class="cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
			<?php wc_cart_totals_coupon_label( $coupon ); ?> <span
				class="green"><?php wc_cart_totals_coupon_html( $coupon ); ?></span></h5>
		<?php endforeach; ?>
		<?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

			<?php do_action( 'woocommerce_review_order_before_shipping' ); ?>

			<?php wc_cart_totals_shipping_html(); ?>

			<?php do_action( 'woocommerce_review_order_after_shipping' ); ?>

		<?php endif; ?>
	</div>
</div>

<?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
<div class="payment_list_item">
	<div class="count_part">
		<h5 class="fee"><?php echo esc_html( $fee->name ); ?> <span class="motodeal-checkout-order-price"><?php wc_cart_totals_fee_html( $fee ); ?></span>
		</h5>
	</div>
</div>
<?php endforeach; ?>

<?php if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) : ?>
	<?php if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) : ?>
<div class="payment_list_item">
	<div class="count_part">
		<?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : // phpcs:ignore WordPress.WP.GlobalVariablesOverride.OverrideProhibited ?>
		<h5><?php echo esc_html( $tax->label ); ?> <span class="motodeal-checkout-order-price"><?php echo wp_kses_post( $tax->formatted_amount ); ?></span>
		</h5>
		<?php endforeach; ?>
	</div>
</div>
	<?php else : ?>
<div class="payment_list_item">
	<div class="count_part">
		<h5 class="tax-total"><?php echo esc_html( WC()->countries->tax_or_vat() ); ?><span class="motodeal-checkout-order-price"><?php wc_cart_totals_taxes_total_html(); ?></span>
		</h5>
	</div>
</div>
	<?php endif; ?>
<?php endif; ?>
<?php do_action( 'woocommerce_review_order_before_order_total' ); ?>
		<div class="payment_list_item">
			<div class="total_count order-total">
				<h4><?php esc_html_e( 'Total', 'brator' ); ?> <span class="motodeal-checkout-order-price"><?php wc_cart_totals_order_total_html(); ?></span></h4>
			</div>
		</div>
<?php do_action( 'woocommerce_review_order_after_order_total' ); ?>
