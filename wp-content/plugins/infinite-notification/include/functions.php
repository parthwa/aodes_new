<?php
function infinite_notification_sales_product_price( $price ) {
	if ( empty( $price ) ) {
		$price = 0;
	}

	return sprintf(
		get_woocommerce_price_format(),
		get_woocommerce_currency_symbol(),
		number_format( $price, wc_get_price_decimals(), wc_get_price_decimal_separator(), wc_get_price_thousand_separator() )
	);
}

function infinite_notification_product_sales_buyer_data( $order ) {
	$address = $order->get_address( 'billing' );
	if ( ! isset( $address['city'] ) || strlen( $address['city'] ) == 0 ) {
		$address = $order->get_address( 'shipping' );
	}

	$buyer = array(
		'name'    => isset( $address['first_name'] ) && strlen( $address['first_name'] ) > 0 ? ucfirst( $address['first_name'] ) : $this->t( 'someone' ),
		'city'    => isset( $address['city'] ) && strlen( $address['city'] ) > 0 ? ucfirst( $address['city'] ) : 'N/A',
		'state'   => isset( $address['state'] ) && strlen( $address['state'] ) > 0 ? ucfirst( $address['state'] ) : 'N/A',
		'country' => isset( $address['country'] ) && strlen( $address['country'] ) > 0 ? WC()->countries->countries[ $address['country'] ] : 'N/A',
	);

	return $buyer;
}

function infinite_notification_get_newest_purchased_products() {

	global $wpdb;
	$notification_limit = get_option( 'notification-limit' );

	$args = array(
		'post_type'      => 'shop_order',
		'post_status'    => 'wc-on-hold, wc-completed, wc-pending, wc-processing',
		'orderby'        => 'ID',
		'order'          => 'DESC',
		'posts_per_page' => $notification_limit,
		'date_query'     => array(
			'after' => date( 'Y-m-d', strtotime( '-84 days' ) ),
		),
	);

	$posts    = get_posts( $args );
	$products = array();

	foreach ( $posts as $post ) {

		$order       = new WC_Order( $post->ID );
		$order_items = $order->get_items();

		if ( ! empty( $order_items ) ) {
			$first_item = array_values( $order_items )[0];
			$product_id = $first_item['product_id'];
			$product    = wc_get_product( $product_id );
			if ( ! empty( $product ) ) {
				preg_match( '/src="(.*?)"/', $product->get_image( 'thumbnail' ), $imgurl );

				$post_date_gmt = human_time_diff( get_the_time( 'U', $post->ID ), current_time( 'timestamp' ) ) . esc_html__( ' ago ', 'infinite-notification' ) . get_the_time( '', $post->ID ) . ' from ';
				$prd           = array(
					'id'    => $first_item['order_id'],
					'name'  => $product->get_title(),
					'url'   => $product->get_permalink(),
					'date'  => $post_date_gmt,
					'image' => count( $imgurl ) === 2 ? $imgurl[1] : null,
					'price' => infinite_notification_sales_product_price( wc_get_price_to_display( $product ) ),
					'buyer' => infinite_notification_product_sales_buyer_data( $order ),
				);

				array_push( $products, $prd );
			}
		}
	}
	?>

	<?php
	$notification_position = get_option( 'notification-position' );
	$notification_switch   = get_option( 'notification-switch' );
	if ( isset( $notification_switch ) && $notification_switch == '1' ) {
		?>
		<audio id="notify-sound" controls autoplay muted>
			<source src="<?php echo INFINITE_NOTIFICATION_PLUGIN_URL . 'assets/sound/notification.mp3'; ?>" type="audio/mpeg">
		</audio>
		<div class="recent-order-product-notice <?php echo esc_attr( $notification_position ); ?>">

		</div>
		<?php
	}
	$cookie_limit  = get_option( 'notification-cookie-limit' );
	$time_interval = get_option( 'time-interval' );

	$timeinterval = 1000 * $time_interval;

	$poweredbyswitch = get_option( 'powered-by-switch' );

	if ( isset( $poweredbyswitch ) && $poweredbyswitch == '1' ) {
		$poweredbytext = '<div class="sd-promo-products-info-power-by-text"><span class="sd-promo-products-info-check-icon"><svg data-v-f9ea57e0="" width="12px" height="12px" viewBox="0 0 12 12" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="proof-factor-system-branding-icon"><g data-v-f9ea57e0="" id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g data-v-f9ea57e0="" fill="#000" class="proof-factor-system-branding-icon-image-path"><path data-v-f9ea57e0="" d="M6,12 C2.6862915,12 4.05812251e-16,9.3137085 0,6 C-4.05812251e-16,2.6862915 2.6862915,6.08718376e-16 6,0 C9.3137085,2.02906125e-16 12,2.6862915 12,6 C12,9.3137085 9.3137085,12 6,12 Z M8.706,3.375 L5.212,6.869 L3.294,4.951 L2.25,5.996 L5.212,8.957 L9.75,4.42 L8.706,3.375 Z" id="Shape"></path></g></g></svg></span><a href="' . esc_url( 'https://smartdatasoft.com' ) . '"><span>' . esc_html__( 'Powered by', 'infinite-notification' ) . '</span> ' . esc_html__( 'Infinite Notification', 'infinite-notification' ) . '</a></div>';
	} else {
		$poweredbytext = '';
	}

	$toptext = esc_html__( 'Someone purchsed a', 'infinite-notification' );
	$sound   = INFINITE_NOTIFICATION_PLUGIN_URL . 'assets/sound/notification.mp3';

	$data = json_encode( $products );
	wp_localize_script(
		'infinite-notification-js',
		'notification_ajax_object',
		array(
			'ajaxurl'            => esc_url( admin_url( 'admin-ajax.php' ) ),
			'data'               => $data,
			'cookie_limit'       => $cookie_limit,
			'notification_limit' => $notification_limit,
			'timeinterval'       => $timeinterval,
			'sound'              => $sound,
			'toptext'            => $toptext,
			'poweredbytext'      => $poweredbytext,
		)
	);

}
add_action( 'wp_footer', 'infinite_notification_get_newest_purchased_products' );

