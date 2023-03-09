<?php
$welcome_text               = brator_get_options( 'welcome_text' );
$right_content_top          = brator_get_options( 'right_content_top' );
$header_user                = brator_get_options( 'header_user' );
$header_user_text           = brator_get_options( 'header_user_text' );
$header_cart                = brator_get_options( 'header_cart' );
$header_phone               = brator_get_options( 'header_phone' );
$header_phone_title         = brator_get_options( 'header_phone_title' );
$header_order_track         = brator_get_options( 'header_order_track' );
$header_order_track_url     = brator_get_options( 'header_order_track_url' );
$header_recently_viewed     = brator_get_options( 'header_recently_viewed' );
$header_recently_viewed_url = brator_get_options( 'header_recently_viewed_url' );
$header_quick_search        = brator_get_options( 'header_quick_search' );
$header_wishlist_url        = brator_get_options( 'header_wishlist_url' );
$sticky_header_on_off       = brator_get_options( 'sticky_header_on_off' );
$header_search              = brator_get_options( 'header_search' );
$header_search_placeholder  = brator_get_options( 'header_search_placeholder' );
?>
<div class="brator-header-four">
<div class="brator-header-top-bar-area design-one dark-bg">
	<div class="container-xxxl container-xxl container">
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
<div class="brator-header-area header-three header-one brator-header-menu-area cat-header">
	<div class="container-xxxl container-xxl container relative">
	<div class="row">
		<div class="col-xxl-2 col-xl-2">
			<div class="brator-logo-area">
				<div class="brator-logo">
				<?php do_action( 'brator_header_logo' ); ?>
				<button>
					<svg class="bi bi-pause" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path d="M6 3.5a.5.5 0 0 1 .5.5v8a.5.5 0 0 1-1 0V4a.5.5 0 0 1 .5-.5zm4 0a.5.5 0 0 1 .5.5v8a.5.5 0 0 1-1 0V4a.5.5 0 0 1 .5-.5z"></path></svg>
				</button>
				</div>
			</div>
		</div>
		<div class="col-xxl-7 col-xl-7 lg-dextop-none brator-header-menu-area">
			<div class="brator-header-menu">
			<?php do_action( 'brator_header_menu' ); ?>
			</div>
		</div>
		<div class="col-xxl-3 col-xl-3">
		<div class="brator-info-right">
			<?php if ( ! empty( $header_wishlist_url ) ) { ?>
			<div class="brator-icon-link-text heart-icon">
			<a href="<?php echo esc_url( $header_wishlist_url ); ?>">
				<div class="click-item-count">
				<svg fill="#000000" width="52" height="52" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 64 64" xml:space="preserve"><g><path d="M32,59.4c-1.2,0-2.5-0.4-3.4-1.3c-2.3-2-4.6-3.9-6.6-5.6c-5.9-5-11-9.3-14.6-13.6c-4.2-5-6.2-9.8-6.2-15.1c0-5.2,1.8-10,5.1-13.5c3.3-3.6,7.9-5.6,12.9-5.6c3.7,0,7.2,1.2,10.2,3.5c0.9,0.7,1.8,1.5,2.6,2.4c0.8-0.9,1.7-1.7,2.6-2.4c3-2.3,6.4-3.5,10.2-3.5c5,0,9.5,2,12.9,5.6c3.3,3.5,5.1,8.3,5.1,13.5c0,5.3-2,10.1-6.2,15.1C53,43.2,47.9,47.5,42,52.5c-2,1.7-4.3,3.6-6.6,5.6C34.5,58.9,33.2,59.4,32,59.4z M19.2,8.1c-4,0-7.7,1.6-10.3,4.5c-2.7,2.9-4.1,6.8-4.1,11.1c0,4.4,1.7,8.5,5.3,12.9c3.4,4.1,8.4,8.3,14.2,13.2c2,1.7,4.3,3.6,6.6,5.7c0.6,0.5,1.6,0.5,2.2,0c2.4-2,4.6-4,6.6-5.7c5.8-4.9,10.8-9.1,14.2-13.2c3.6-4.4,5.3-8.5,5.3-12.9c0-4.3-1.5-8.2-4.1-11.1c-2.7-2.9-6.3-4.5-10.3-4.5c-3,0-5.7,0.9-8,2.8c-1,0.7-1.8,1.6-2.7,2.6c-0.5,0.6-1.3,1-2.1,1c0,0,0,0,0,0c-0.8,0-1.6-0.4-2.1-1c-0.8-1-1.7-1.9-2.7-2.6C24.9,9.1,22.2,8.1,19.2,8.1z"></path></g></svg>
				</div>
			</a>
			</div>
			<?php } ?>
			<?php if ( $header_cart == '1' ) { ?>
			<div class="brator-cart-link">
			<a href="<?php echo esc_js( 'javascript:void(0)' ); ?>">
				<div class="brator-cart-icon click-item-count">
				<svg fill="#000000" width="52" height="52" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 64 64"><g><path d="M40.9,48.2c-3.9,0-7.1,3.3-7.1,7.3c0,4,3.2,7.3,7.1,7.3s7.1-3.3,7.1-7.3C48.1,51.5,44.9,48.2,40.9,48.2z M40.9,59.3c-2,0-3.6-1.7-3.6-3.8c0-2.1,1.6-3.8,3.6-3.8s3.6,1.7,3.6,3.8C44.6,57.6,42.9,59.3,40.9,59.3z"></path><path d="M18.2,48.2c-3.9,0-7.1,3.3-7.1,7.3c0,4,3.2,7.3,7.1,7.3s7.1-3.3,7.1-7.3C25.4,51.5,22.2,48.2,18.2,48.2z M18.2,59.3c-2,0-3.6-1.7-3.6-3.8c0-2.1,1.6-3.8,3.6-3.8s3.6,1.7,3.6,3.8C21.9,57.6,20.2,59.3,18.2,59.3z"></path><path d="M57.8,1.3h-6.4c-1.5,0-2.8,1.1-3,2.6l-1.8,13.2H7.3c-0.9,0-1.7,0.4-2.2,1.1c-0.5,0.7-0.7,1.6-0.5,2.4c0,0,0,0.1,0,0.1l6.1,18.9c0.3,1.2,1.4,2.1,2.8,2.1h29.5c2.2,0,4-1.6,4.3-3.8l4.6-33.2h6c1,0,1.8-0.8,1.8-1.8S58.8,1.3,57.8,1.3z M43.7,37.4c-0.1,0.4-0.4,0.8-0.9,0.8h-29L8.1,20.6h37.9L43.7,37.4z"></path></g></svg>
				<span class="header-cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
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
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"></path></svg>
				</button>
				</div>
				<div class="widget_shopping_cart_content"><?php woocommerce_mini_cart(); ?></div>
			</div>
			</div>
			<?php } ?>
			<?php if ( $header_user == '1' ) { ?>
			<div class="brator-icon-link-text">
			<a href="<?php echo esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ); ?>" class="header-user-btn">
				<div class="click-item-count">
				<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 64 64" xml:space="preserve">
					<g><g><path d="M32.1,37.3c-8.8,0-16-7.2-16-16s7.2-16,16-16s16,7.2,16,16S40.9,37.3,32.1,37.3z M32.1,10.7c-5.9,0-10.7,4.8-10.7,10.7S26.3,32,32.1,32s10.7-4.8,10.7-10.7S38,10.7,32.1,10.7z"></path></g><g><path d="M2.8,58.7c-0.8,0-1.6-0.3-2.1-1.1c-1.1-1.1-0.8-2.9,0.3-3.7c8.8-7.2,19.7-11.2,31.2-11.2s22.4,4,30.9,11.2c1.1,1.1,1.3,2.7,0.3,3.7c-1.1,1.1-2.7,1.3-3.7,0.3C52.1,51.5,42.3,48,32.1,48s-20,3.5-27.7,10.1C4.1,58.4,3.3,58.7,2.8,58.7z"></path></g></g>
				</svg>
				</div><b><?php echo esc_html( $header_user_text ); ?></b>
			</a>
			</div>
			<?php } ?>
		</div>
		</div>
	</div>
	</div>
</div>
<div class="brator-header-menu-area dark-bg cat-header brator-header-area header-three header-one lg-dextop-none">
	<div class="close-menu-bg"></div>
	<div class="brator-mega-menu-close">
	<svg class="bi bi-x" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
		<path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"></path>
	</svg>
	</div>
	<div class="container-xxxl container-xxl container">
	<div class="flex header-bottom">
		<div class="menu-cat-list-area"><span class="icon">
			<svg fill="#000000" width="52" height="52" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 64 64" xml:space="preserve"><g><path d="M61,30.3H3c-1,0-1.8,0.8-1.8,1.8S2,33.8,3,33.8h58c1,0,1.8-0.8,1.8-1.8S62,30.3,61,30.3z"></path><path d="M61,47.9H3c-1,0-1.8,0.8-1.8,1.8S2,51.4,3,51.4h58c1,0,1.8-0.8,1.8-1.8S62,47.9,61,47.9z"></path><path d="M3,16.1h58c1,0,1.8-0.8,1.8-1.8S62,12.6,61,12.6H3c-1,0-1.8,0.8-1.8,1.8S2,16.1,3,16.1z"></path></g>
			</svg></span><span class="text"><?php esc_html_e( 'Shop By Category', 'brator' ); ?></span>
			<div class="dropdown-icon-cat">
			<svg fill="#000000" width="52" height="52" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 64 64" xml:space="preserve"><g><path d="M32,46.8c-1.2,0-2.4-0.4-3.4-1.3L1.8,20.3c-0.7-0.7-0.7-1.8-0.1-2.5c0.7-0.7,1.8-0.7,2.5-0.1L31,42.9c0.5,0.5,1.4,0.5,2,0l26.8-25.2c0.7-0.7,1.8-0.6,2.5,0.1c0.7,0.7,0.6,1.8-0.1,2.5L35.4,45.4C34.4,46.3,33.2,46.8,32,46.8z"></path></g>
			</svg>
			</div>
			<?php brator_product_category_list(); ?>
		</div>
		<?php if ( $header_search == '1' ) { ?>
			<div class="brator-search-area">
				<div class="search-form">
				<div class="search-field-wrap relative">
					<span class="search-field-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"><path d="M 19 3 C 13.488281 3 9 7.488281 9 13 C 9 15.394531 9.839844 17.589844 11.25 19.3125 L 3.28125 27.28125 L 4.71875 28.71875 L 12.6875 20.75 C 14.410156 22.160156 16.605469 23 19 23 C 24.511719 23 29 18.511719 29 13 C 29 7.488281 24.511719 3 19 3 Z M 19 5 C 23.429688 5 27 8.570313 27 13 C 27 17.429688 23.429688 21 19 21 C 14.570313 21 11 17.429688 11 13 C 11 8.570313 14.570313 5 19 5 Z"/></svg></span>
					<input class="search-field" id="prosearch" type="search" placeholder="<?php echo esc_attr( $header_search_placeholder ); ?>" autocomplete="off"/>
					<?php if ( ! empty( $header_quick_search ) && is_array( $header_quick_search ) ) { ?>
					<div class="select-search">
						<select id="header-cat-search">
						<option value=""><?php esc_html_e( 'All Categories', 'brator' ); ?></option>
						<?php
						foreach ( $header_quick_search as $cat ) {
							$cat_data = get_term_by( 'slug', $cat, 'product_cat' );
							if ( isset( $cat_data->name ) ) {
								echo '<option value="' . esc_attr( $cat_data->name ) . '">' . esc_html( $cat_data->name ) . '</option>';
							}
						}
						?>
						</select>
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"><path d="M 4.21875 10.78125 L 2.78125 12.21875 L 15.28125 24.71875 L 16 25.40625 L 16.71875 24.71875 L 29.21875 12.21875 L 27.78125 10.78125 L 16 22.5625 Z"/></svg>
					</div>
					<?php } ?>
					<div id="productdatasearch"></div>
				</div>
				<button type="submit">
					<?php esc_html_e( 'Search', 'brator' ); ?>
				</button>
				</div>
			</div>
			<?php } ?>
		<div class="cat-menu-info-s">
			<?php if ( ! empty( $header_recently_viewed_url ) && ! empty( $header_recently_viewed ) ) { ?>
			<a class="cat-menu-info-s-item" href="<?php echo esc_url( $header_recently_viewed_url ); ?>">
			<svg id="lni_lni-reload" fill="#000000" width="52" height="52" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 64 64" xml:space="preserve"><g><path d="M7.4,28.5c0.3,0,0.6,0,0.8-0.1l11.1-3.9c0.9-0.3,1.4-1.3,1.1-2.2c-0.3-0.9-1.3-1.4-2.2-1.1l-6.7,2.4c3.3-9.1,12-15.3,22.1-15.3c10.7,0,20.1,7.1,22.7,17.4c0.2,0.9,1.2,1.5,2.1,1.3c0.9-0.2,1.5-1.2,1.3-2.1c-3-11.8-13.8-20-26.1-20c-12,0-22.4,7.7-25.8,18.9l-3.1-8.7c-0.3-0.9-1.3-1.4-2.2-1.1c-0.9,0.3-1.4,1.3-1.1,2.2l3.8,10.9C5.5,27.9,6.5,28.5,7.4,28.5z"></path><path d="M62.6,49.9l-4.1-10.8c-0.2-0.6-0.7-1.1-1.3-1.3c-0.6-0.2-1.2-0.3-1.8,0l-11,4.2c-0.9,0.3-1.4,1.4-1,2.3c0.3,0.9,1.4,1.4,2.3,1l6.8-2.6c-3.8,7.9-11.9,13.1-21.1,13.1c-10.1,0-19-6.3-22.1-15.7C8.9,39.2,7.9,38.7,7,39c-0.9,0.3-1.4,1.3-1.1,2.2C9.5,52,19.7,59.3,31.3,59.3c11,0,20.8-6.5,24.8-16.4l3.2,8.3c0.3,0.7,0.9,1.1,1.6,1.1c0.2,0,0.4,0,0.6-0.1C62.5,51.8,63,50.8,62.6,49.9z"></path></g></svg>
			<span><?php echo esc_html( $header_recently_viewed ); ?></span>
			</a>
			<?php } ?>
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
				<div class="brator-header-menu-info"><a href="<?php echo esc_url( $header_order_track_url ); ?>"><?php echo esc_html( $header_order_track ); ?></a></div>
				<?php } ?>

			</div>
		</div>
	</div>
	</div>
</div>
	<?php
}
?>
</div>
