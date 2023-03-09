<?php
$welcome_text              = brator_get_options( 'welcome_text' );
$right_content_top         = brator_get_options( 'right_content_top' );
$header_sidebar            = brator_get_options( 'header_sidebar' );
$header_search             = brator_get_options( 'header_search' );
$header_vehicle_onoff      = brator_get_options( 'header_vehicle_onoff' );
$header_vehicle_text       = brator_get_options( 'header_vehicle_text' );
$header_wishlist_url       = brator_get_options( 'header_wishlist_url' );
$header_user               = brator_get_options( 'header_user' );
$header_cart               = brator_get_options( 'header_cart' );
$header_phone              = brator_get_options( 'header_phone' );
$header_phone_title        = brator_get_options( 'header_phone_title' );
$header_order_track        = brator_get_options( 'header_order_track' );
$header_order_track_url    = brator_get_options( 'header_order_track_url' );
$sticky_header_on_off      = brator_get_options( 'sticky_header_on_off' );
$header_search_placeholder = brator_get_options( 'header_search_placeholder' );
?>
<div class="brator-header-top-bar-area design-one">
	<div class="container-lg-c container">
		<div class="row">
			<?php if ( ! empty( $welcome_text ) ) { ?>
				<div class="col-lg-6 col-12">
					<div class="brator-header-top-bar-info-left">
						<p><?php echo wp_kses( $welcome_text, 'code_contxt' ); ?></p>
					</div>
				</div>
				<?php } ?>
				<?php if ( ! empty( $right_content_top ) ) { ?>
				<div class="col-lg-6 col-12">
					<div class="brator-header-top-bar-info-right">
						<div class="brator-header-top-bar-info-right-content">
							<?php echo wp_kses( $right_content_top, 'code_contxt' ); ?>
							<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"></path></svg>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
</div>
<div class="brator-header-area header-three header-one">
	<div class="container-lg-c container">
	<div class="row">
		<div class="col-lg-12 col-xl-4 col-xxl-3">
		<div class="brator-logo-area">
			<div class="brator-logo">
			<?php do_action( 'brator_header_logo' ); ?>
			<button class="mobile-menu-icon">
				<svg class="bi bi-pause" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
				<path d="M6 3.5a.5.5 0 0 1 .5.5v8a.5.5 0 0 1-1 0V4a.5.5 0 0 1 .5-.5zm4 0a.5.5 0 0 1 .5.5v8a.5.5 0 0 1-1 0V4a.5.5 0 0 1 .5-.5z"></path>
				</svg>
			</button>
			</div>
		</div>
		</div>
		<div class="col-lg-2 xl-dextop-none">
			<!-- <div class="header-support-info">
			  <h6><?php echo esc_html( $header_phone_title ); ?></h6><?php echo wp_kses( $header_phone, 'code_contxt' ); ?>
			</div> -->
		  </div>
		<?php if ( $header_search == '1' ) { ?>
		<div class="col-xxl-4 col-xl-4 lg-dextop-none">
		<div class="brator-search-area">
			<div class="search-form">
			<input class="search-field" id="prosearch" type="search" placeholder="<?php echo esc_attr( $header_search_placeholder ); ?>"/>
			<button type="submit">
				<svg fill="#000000" width="52" height="52" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 64 64">
				<path d="M62.1,57L44.6,42.8c3.2-4.2,5-9.3,5-14.7c0-6.5-2.5-12.5-7.1-17.1v0c-9.4-9.4-24.7-9.4-34.2,0C3.8,15.5,1.3,21.6,1.3,28c0,6.5,2.5,12.5,7.1,17.1c4.7,4.7,10.9,7.1,17.1,7.1c6.1,0,12.1-2.3,16.8-6.8l17.7,14.3c0.3,0.3,0.7,0.4,1.1,0.4 c0.5,0,1-0.2,1.4-0.6C63,58.7,62.9,57.6,62.1,57z M10.8,42.7C6.9,38.8,4.8,33.6,4.8,28s2.1-10.7,6.1-14.6c4-4,9.3-6,14.6-6c5.3,0,10.6,2,14.6,6c3.9,3.9,6.1,9.1,6.1,14.6S43.9,38.8,40,42.7C32,50.7,18.9,50.7,10.8,42.7z"></path>
				</svg>
			</button>
			<div id="productdatasearch"></div>
			</div>
		</div>
		</div>
		<?php } ?>
		<div class="col-xl-4 col-xxl-3">
		<div class="brator-info-right">
			<?php if ( $header_vehicle_onoff == '1' ) { ?>
			<div class="brator-icon-link-text relation">
				<a href="<?php echo esc_js( 'javascript:void(0)' ); ?>">
					<div class="">
						<svg fill="#000000" width="52" height="52" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 64 64"><g><path d="M14.6,38h6.6c1,0,1.8-0.8,1.8-1.8s-0.8-1.8-1.8-1.8h-6.6c-1,0-1.8,0.8-1.8,1.8S13.6,38,14.6,38z"></path><path d="M41.9,38h6.6c1,0,1.8-0.8,1.8-1.8s-0.8-1.8-1.8-1.8h-6.6c-1,0-1.8,0.8-1.8,1.8S41,38,41.9,38z"></path><path d="M61,21.6h-3.4l-5-12.7C52,7.2,50.3,6,48.5,6H15.1c-1.8,0-3.4,1.1-4.1,2.8L6,21.6H3c-1,0-1.8,0.8-1.8,1.8S2,25.1,3,25.1h1.4    v17.8c0,2.6,2.1,4.7,4.6,4.7v5.6c0,2.6,2.1,4.8,4.8,4.8h4.4c2.6,0,4.8-2.1,4.8-4.8v-5.6h17.3v5.6c0,2.6,2.1,4.8,4.8,4.8h4.4c2.6,0,4.8-2.1,4.8-4.8v-5.6h0.4c2.6,0,4.8-2.1,4.8-4.8V25.1H61c1,0,1.8-0.8,1.8-1.8S62,21.6,61,21.6z M14.3,10.1c0.1-0.4,0.5-0.6,0.8-0.6h33.4c0.4,0,0.7,0.2,0.8,0.6l5.6,14.1H8.7L14.3,10.1z M19.4,53.3c0,0.7-0.6,1.3-1.3,1.3h-4.4c-0.7,0-1.3-0.6-1.3-1.3v-5.6h6.9V53.3z M50.6,53.3c0,0.7-0.6,1.3-1.3,1.3h-4.4c-0.7,0-1.3-0.6-1.3-1.3v-5.6h6.9V53.3z M55.8,42.9c0,0.7-0.6,1.3-1.3,1.3h-0.4H40.2H22.9H9.1c-0.7,0-1.3-0.6-1.3-1.3V27.6h47.9V42.9z"></path></g></svg>
					</div>
				</a>
				<div class="vehicle-list-wapper">
					<?php echo do_shortcode( '[brator_auto_parts_vehicle_ready]' ); ?>
				</div>
			</div>
			<?php } ?>
			<?php if ( ! empty( $header_wishlist_url ) ) { ?>
			<div class="brator-icon-link-text">
				<!-- <a href="<?php echo esc_url( $header_wishlist_url ); ?>">
					<div class="click-item-count">
						<svg fill="#000000" width="52" height="52" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 64 64" xml:space="preserve"><g><path d="M32,59.4c-1.2,0-2.5-0.4-3.4-1.3c-2.3-2-4.6-3.9-6.6-5.6c-5.9-5-11-9.3-14.6-13.6c-4.2-5-6.2-9.8-6.2-15.1c0-5.2,1.8-10,5.1-13.5c3.3-3.6,7.9-5.6,12.9-5.6c3.7,0,7.2,1.2,10.2,3.5c0.9,0.7,1.8,1.5,2.6,2.4c0.8-0.9,1.7-1.7,2.6-2.4c3-2.3,6.4-3.5,10.2-3.5c5,0,9.5,2,12.9,5.6c3.3,3.5,5.1,8.3,5.1,13.5c0,5.3-2,10.1-6.2,15.1C53,43.2,47.9,47.5,42,52.5c-2,1.7-4.3,3.6-6.6,5.6C34.5,58.9,33.2,59.4,32,59.4z M19.2,8.1c-4,0-7.7,1.6-10.3,4.5c-2.7,2.9-4.1,6.8-4.1,11.1c0,4.4,1.7,8.5,5.3,12.9c3.4,4.1,8.4,8.3,14.2,13.2c2,1.7,4.3,3.6,6.6,5.7c0.6,0.5,1.6,0.5,2.2,0c2.4-2,4.6-4,6.6-5.7c5.8-4.9,10.8-9.1,14.2-13.2c3.6-4.4,5.3-8.5,5.3-12.9c0-4.3-1.5-8.2-4.1-11.1c-2.7-2.9-6.3-4.5-10.3-4.5c-3,0-5.7,0.9-8,2.8c-1,0.7-1.8,1.6-2.7,2.6c-0.5,0.6-1.3,1-2.1,1c0,0,0,0,0,0c-0.8,0-1.6-0.4-2.1-1c-0.8-1-1.7-1.9-2.7-2.6C24.9,9.1,22.2,8.1,19.2,8.1z"></path></g></svg>
					</div>
				</a> -->
				<div class="login-buton">
					<a href="/my-account/" class="login">Dealer Login</a>
				</div>
			</div>
			<?php } ?>
			<?php if ( $header_cart == '1' ) { ?>
			<div class="brator-cart-link">
				<a href="<?php echo esc_js( 'javascript:void(0)' ); ?>">
					<div class="brator-cart-icon click-item-count">
						<svg fill="#000000" width="52" height="52" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 64 64">
						<g><path d="M40.9,48.2c-3.9,0-7.1,3.3-7.1,7.3c0,4,3.2,7.3,7.1,7.3s7.1-3.3,7.1-7.3C48.1,51.5,44.9,48.2,40.9,48.2z M40.9,59.3c-2,0-3.6-1.7-3.6-3.8c0-2.1,1.6-3.8,3.6-3.8s3.6,1.7,3.6,3.8C44.6,57.6,42.9,59.3,40.9,59.3z"></path><path d="M18.2,48.2c-3.9,0-7.1,3.3-7.1,7.3c0,4,3.2,7.3,7.1,7.3s7.1-3.3,7.1-7.3C25.4,51.5,22.2,48.2,18.2,48.2z M18.2,59.3c-2,0-3.6-1.7-3.6-3.8c0-2.1,1.6-3.8,3.6-3.8s3.6,1.7,3.6,3.8C21.9,57.6,20.2,59.3,18.2,59.3z"></path><path d="M57.8,1.3h-6.4c-1.5,0-2.8,1.1-3,2.6l-1.8,13.2H7.3c-0.9,0-1.7,0.4-2.2,1.1c-0.5,0.7-0.7,1.6-0.5,2.4c0,0,0,0.1,0,0.1l6.1,18.9c0.3,1.2,1.4,2.1,2.8,2.1h29.5c2.2,0,4-1.6,4.3-3.8l4.6-33.2h6c1,0,1.8-0.8,1.8-1.8S58.8,1.3,57.8,1.3z M43.7,37.4 c-0.1,0.4-0.4,0.8-0.9,0.8h-29L8.1,20.6h37.9L43.7,37.4z"></path>
						</g>
						</svg><span class="header-cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
					</div>
				</a>
				<div class="brator-cart-item-list">
					<div class="brator-cart-item-list-header">
					<h2><?php esc_html_e( 'Cart', 'brator' ); ?>
						<span class="header-cart-count2"> (
						<?php
						if ( WC()->cart->get_cart_contents_count() == 1 ) {
							echo WC()->cart->get_cart_contents_count() . esc_html__( ' item', 'brator' );
						} else {
							echo WC()->cart->get_cart_contents_count() . esc_html__( ' items', 'brator' );
						}
						?>
						)</span>
					</h2>
					<button class="brator-cart-close">
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
						<path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"></path>
						</svg>
					</button>
					</div>
					<div class="widget_shopping_cart_content"><?php woocommerce_mini_cart(); ?></div>
				</div>
			</div>
			<?php } ?>
			<?php if ( $header_user == '1' ) { ?>
			<div class="brator-icon-link-text">
				<a href="<?php echo esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ); ?>">
				<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 64 64" xml:space="preserve">
					<g><g><path d="M32.1,37.3c-8.8,0-16-7.2-16-16s7.2-16,16-16s16,7.2,16,16S40.9,37.3,32.1,37.3z M32.1,10.7c-5.9,0-10.7,4.8-10.7,10.7S26.3,32,32.1,32s10.7-4.8,10.7-10.7S38,10.7,32.1,10.7z"></path>
					</g><g><path d="M2.8,58.7c-0.8,0-1.6-0.3-2.1-1.1c-1.1-1.1-0.8-2.9,0.3-3.7c8.8-7.2,19.7-11.2,31.2-11.2s22.4,4,30.9,11.2c1.1,1.1,1.3,2.7,0.3,3.7c-1.1,1.1-2.7,1.3-3.7,0.3C52.1,51.5,42.3,48,32.1,48s-20,3.5-27.7,10.1C4.1,58.4,3.3,58.7,2.8,58.7z"></path></g></g>
				</svg>
				</a>
			</div>
			<?php } ?>
		</div>
		</div>
	</div>
	</div>
</div>
<div class="brator-plan-pixel-area">
	<div class="container-xxxl container-xxl container">
	<div class="col-12">
		<div class="plan-pixel-area"></div>
	</div>
	</div>
</div>
<div class="brator-header-menu-area red-variant">
	<div class="close-menu-bg"></div>
	<div class="brator-mega-menu-close">
	<svg class="bi bi-x" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
		<path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"></path>
	</svg>
	</div>
	<div class="container-lg-c container">
	<div class="row">
		<div class="col-lg-12">
		<div class="brator-header-menu-with-info">
			<div class="brator-header-menu">
				<?php do_action( 'brator_header_menu' ); ?>
			</div>
			<div class="brator-header-menu-info">
			<?php if ( ! empty( $header_order_track_url ) && ! empty( $header_order_track ) ) { ?>
				<!-- <a href="<?php echo esc_url( $header_order_track_url ); ?>"><?php echo esc_html( $header_order_track ); ?></a> -->
				<?php } ?>
			</div>
		</div>
		</div>
	</div>
	</div>
</div>
<div class="brator-slide-menu-area">
	<div class="brator-slide-menu-bg"></div>
	<div class="brator-slide-menu-content">
		<div class="brator-slide-menu-close">
			<svg class="bi bi-x" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
			<path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"></path>
			</svg>
		</div>
		<div class="brator-slide-logo-items"></div>
		<div class="brator-slide-menu-items"></div>
	</div>
</div>
<?php if ( $sticky_header_on_off == '1' ) { ?>
<div class="brator-header-menu-area scroll-menu">
	<div class="close-menu-bg"></div>
	<div class="brator-mega-menu-close">
		<svg class="bi bi-x" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"></path></svg>
	</div>
	<div class="container-xxxl container-xxl container">
	<div class="row">
		<div class="col-lg-12">
			<div class="brator-header-menu-with-info">
				<div class="brator-logo-area">
					<div class="brator-logo">
					<?php do_action( 'brator_header_logo' ); ?>
					<button>
						<svg class="bi bi-pause" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path d="M6 3.5a.5.5 0 0 1 .5.5v8a.5.5 0 0 1-1 0V4a.5.5 0 0 1 .5-.5zm4 0a.5.5 0 0 1 .5.5v8a.5.5 0 0 1-1 0V4a.5.5 0 0 1 .5-.5z"></path></svg>
					</button>
					</div>
				</div>
				<div class="brator-header-menu sticky-menu"></div>
				<?php if ( ! empty( $header_order_track_url ) && ! empty( $header_order_track ) ) { ?>
				<!-- <div class="brator-header-menu-info"><a href="<?php echo esc_url( $header_order_track_url ); ?>"><?php echo esc_html( $header_order_track ); ?></a></div> -->
				<?php } ?>

			</div>
		</div>
	</div>
	</div>
</div>
	<?php
}
