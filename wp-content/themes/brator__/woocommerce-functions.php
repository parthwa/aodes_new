<?php
/**
 * @abstract get product price
 * @param type $product
 * @return boolean
 */


function brator_the_product_thumbnail( $size = 'shop_catalog' ) {
	global $post;
	$image_size = apply_filters( 'single_product_archive_thumbnail_size', $size );
	if ( has_post_thumbnail() ) {
		return get_the_post_thumbnail( $post->ID, $image_size );
	} else {
		return sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', esc_url( wc_placeholder_img_src( 'woocommerce_single' ) ), esc_html__( 'Awaiting product image', 'brator' ) );
	}

}

function brator_get_product_prices( $product ) {

	$saleargs = array(
		'qty'   => '1',
		'price' => $product->get_sale_price(),
	);
	$args     = array(
		'qty'   => '1',
		'price' => $product->get_regular_price(),
	);

	$tax_display_mode      = get_option( 'woocommerce_tax_display_shop' );
	$display_price         = $tax_display_mode == 'incl' ? wc_get_price_including_tax( $product ) : wc_get_price_excluding_tax( $product );
	$display_regular_price = $tax_display_mode == 'incl' ? wc_get_price_including_tax( $product, $args ) : wc_get_price_excluding_tax( $product, $args );
	$display_sale_price    = $tax_display_mode == 'incl' ? wc_get_price_including_tax( $product, $saleargs ) : wc_get_price_excluding_tax( $product, $saleargs );
	switch ( $product->get_type() ) {
		case 'variable':
			$price = $product->get_variation_regular_price( 'min', true );
			$sale  = $display_price;
			break;
		case 'simple':
			$price = $display_regular_price;
			$sale  = $display_sale_price;
			break;
	}
	if ( isset( $sale ) && ! empty( $sale ) && isset( $price ) && ! empty( $price ) ) {
		return array(
			'sale'  => $sale,
			'price' => $price,
		);
	}
	return false;
}

/**
 * @abstract return save percent with prefix
 * @param type $data
 * @return boolean
 */
function brator_product_special_price_calc( $data ) {
	// sale and price
	if ( ! empty( $data ) ) {
		extract( $data );
	}
	$prefix = '';
	if ( isset( $sale ) && ! empty( $sale ) && isset( $price ) && ! empty( $price ) ) {
		if ( $price > $sale ) {
			$prefix  = '-';
			$dval    = $price - $sale;
			$percent = ( $dval / $price ) * 100;
		}
	}

	if ( isset( $percent ) && ! empty( $percent ) ) {
		return array(
			'prefix'  => $prefix,
			'percent' => round( $percent ),
		);
	}
	return false;
}

// remove default woo hooks
add_action( 'init', 'brator_remove_hooks_woocommerce' );
function brator_remove_hooks_woocommerce() {
	remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10 );
	remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
	remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
	remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
	remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 10 );
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
	remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );
	remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar' );
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart' );
	remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
	remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
	remove_action( 'woocommerce_no_products_found', 'wc_no_products_found', 10 );

}

// remove default woo hooks

add_filter( 'woocommerce_template_loop_price', '__return_false' );
add_filter( 'woocommerce_show_page_title', '__return_false' );

add_filter( 'woocommerce_template_loop_product_title', '__return_false' );


add_filter( 'woocommerce_sale_flash', 'brator_custom_hide_sales_flash' );
function brator_custom_hide_sales_flash() {
	return false;
}
add_action( 'woocommerce_no_products_found', 'brator_woocommerce_no_products_found' );
function brator_woocommerce_no_products_found() {
	if ( is_active_sidebar( 'woo_sideber' ) ) {
		$col_class = 'col-xxl-9 col-12';
	} else {
		$col_class = 'col-xxl-12 col-12';
	}
	?>
	<?php do_action( 'brator_search_result_banner' ); ?>
	<div class="brator-product-shop-page-area">
		<div class="container-xxxl container-xxl container">
			<div class="row">
				<?php if ( is_active_sidebar( 'woo_sideber' ) ) { ?>
				<div class="col-xxl-3 lg-display-none">
					<div class="brator-sidebar-area design-one">
						<div class="close-fillter">
							<svg class="bi bi-x" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
							<path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"></path>
							</svg>
						</div>
						<?php dynamic_sidebar( 'woo_sideber' ); ?>
					</div>
				</div>
				<?php } ?>
				<div class="<?php echo esc_attr( $col_class ); ?>">
					<p class="brator-not-found"><?php esc_html_e( 'No products were found matching your selection.', 'brator' ); ?></p>
				</div>
			</div>
		</div>
	</div>
	<?php
}
add_action( 'woocommerce_before_shop_loop', 'brator_before_shop_loop' );
function brator_before_shop_loop() {
	?>
	<?php do_action( 'brator_search_result_banner' ); ?>
<div class="brator-product-shop-page-area">
	<div class="container-xxxl container-xxl container">
		<div class="row">
			<?php if ( is_active_sidebar( 'woo_sideber' ) ) { ?>
			<div class="col-xxl-3 lg-display-none">
				<div class="brator-sidebar-area design-one">
						<div class="close-fillter">
							<svg class="bi bi-x" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
							<path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"></path>
							</svg>
						</div>
					<?php dynamic_sidebar( 'woo_sideber' ); ?>
				</div>
			</div>
			<?php } ?>
			<?php if ( is_active_sidebar( 'woo_sideber' ) ) { ?>
			<div class="col-xxl-9 col-12">
			<?php } else { ?>
				<div class="col-lg-12 col-xl-12">
			<?php } ?>
			<?php
			if ( ! isset( $_REQUEST['search'] ) ) {
				brator_best_seller_products_query();
			}
			?>
				<div class="brator-inline-product-filter-area">
					<div class="brator-inline-product-filter-left">
						<?php woocommerce_result_count(); ?>
					</div>
					<div class="brator-inline-product-filter-right">
						<div class="brator-filter-short-by"> 
							<p><?php esc_html_e( 'Sort by', 'brator' ); ?></p>
							<div class="brator-filter-show-items-count">
								<?php woocommerce_catalog_ordering(); ?>
							</div>
						</div>
						<?php
						$theme_base_css = brator_get_options( 'theme_base_css' );
						if ( $theme_base_css != '' ) {
							global $wp;
							$current_page_url = home_url( $wp->request );
							$shop_layout      = get_query_var( 'shop_layout' );
							if ( ! $shop_layout ) {
								$shop_layout = brator_get_options( 'shop_layout' );
							}

							if ( $shop_layout == 'list' ) {
								$listclass = 'list-view current';
								$gridclass = '';
							} else {
								$listclass = '';
								$gridclass = 'grid-view current';
							}
							?>
							<div class="brator-filter-view-type">
								<a class="<?php echo esc_attr( $gridclass ); ?>" data-type="grid" href="<?php echo esc_url( $current_page_url ); ?>?shop_layout=grid">
									<svg class="bi bi-grid" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
									<path d="M1 2.5A1.5 1.5 0 0 1 2.5 1h3A1.5 1.5 0 0 1 7 2.5v3A1.5 1.5 0 0 1 5.5 7h-3A1.5 1.5 0 0 1 1 5.5v-3zM2.5 2a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zm6.5.5A1.5 1.5 0 0 1 10.5 1h3A1.5 1.5 0 0 1 15 2.5v3A1.5 1.5 0 0 1 13.5 7h-3A1.5 1.5 0 0 1 9 5.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zM1 10.5A1.5 1.5 0 0 1 2.5 9h3A1.5 1.5 0 0 1 7 10.5v3A1.5 1.5 0 0 1 5.5 15h-3A1.5 1.5 0 0 1 1 13.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zm6.5.5A1.5 1.5 0 0 1 10.5 9h3a1.5 1.5 0 0 1 1.5 1.5v3a1.5 1.5 0 0 1-1.5 1.5h-3A1.5 1.5 0 0 1 9 13.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3z"></path>
									</svg>
								</a>
								<a class="<?php echo esc_attr( $listclass ); ?>" data-type="list" href="<?php echo esc_url( $current_page_url ); ?>?shop_layout=list">
									<svg class="bi bi-list-task" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
									<path fill-rule="evenodd" d="M2 2.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5V3a.5.5 0 0 0-.5-.5H2zM3 3H2v1h1V3z"></path>
									<path d="M5 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM5.5 7a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1h-9zm0 4a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1h-9z"></path>
									<path fill-rule="evenodd" d="M1.5 7a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H2a.5.5 0 0 1-.5-.5V7zM2 7h1v1H2V7zm0 3.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5H2zm1 .5H2v1h1v-1z"></path>
									</svg>
								</a>
								<button class="filter-enable"><?php esc_html_e( 'fillter', 'brator' ); ?> </button>
							</div>
						<?php } ?>
					</div>
				</div>
	<?php
}

add_action( 'woocommerce_after_shop_loop', 'brator_after_shop_loop' );
function brator_after_shop_loop() {
	$pagination_blog          = get_the_posts_pagination();
	$recently_viewed_porducts = brator_get_options( 'recently_viewed_porducts' );
	$slide_items              = brator_get_options( 'recently_viewed_porducts_slide_items' );
	?>
			<?php if ( $pagination_blog ) : ?>
				<div class="brator-pagination-box brator-product-pagination">
				<?php
				the_posts_pagination(
					array(
						'type'      => 'plane',
						'mid_size'  => 4,
						'prev_text' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
						<path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"></path>
					  </svg>' . esc_html__( 'Prev', 'brator' ),
						'next_text' => esc_html__( 'Next', 'brator' ) . ' <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
						<path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"></path></svg>',
					)
				);
				?>
				</div>
			<?php endif; ?>
			</div>
			</div>
			<?php
			if ( ! isset( $_REQUEST['search'] ) ) {
				if ( $recently_viewed_porducts ) {
					do_shortcode( '[brator_recently_viewed_products style="2" items="' . $slide_items . '"]' );
				}
			}
			?>
		</div>
	</div>
	<?php
}

add_action( 'woocommerce_before_shop_loop_item_title', 'brator_before_shop_loop_item_title' );
function brator_before_shop_loop_item_title() {
	global $product;

	$link2 = apply_filters( 'woocommerce_loop_product_link', get_the_permalink(), $product );

	$newness_days = 30; // Number of days the badge is shown
	$created      = strtotime( $product->get_date_created() );
	do_action( 'brator_product_check_for_vehicle_check' );
	?>
	<div class="brator-product-single-item-info info-content-left">
		<div class="brator-product-single-item-info-right">
			<?php
			if ( $product->is_on_sale() ) {
				$prices   = brator_get_product_prices( $product );
				$returned = brator_product_special_price_calc( $prices );
				if ( isset( $returned['percent'] ) && $returned['percent'] ) {
					?>
				<div class="off-batch"><?php echo esc_html( $returned['percent'] ) . '% ' . esc_html__( 'Off', 'brator' ); ?></div>
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
		<a href="<?php echo esc_url( $link2 ); ?>">
		<?php echo brator_the_product_thumbnail(); ?>
		</a>
	</div>
	<?php
}

add_action( 'woocommerce_after_shop_loop_item_title', 'brator_after_shop_loop_item_title' );
function brator_after_shop_loop_item_title() {
	global $product;
	$link         = apply_filters( 'woocommerce_loop_product_link', get_the_permalink(), $product );
	$title        = apply_filters( 'woocommerce_loop_product_title', get_the_title(), $product );
	$review_count = $product->get_review_count();
	if ( $review_count == 0 || $review_count > 1 ) {
		$review_count_var = $review_count . esc_html__( ' Reviews', 'brator' );
	} else {
		$review_count_var = $review_count . esc_html__( ' Review', 'brator' );
	}
	?>
	<div class="brator-product-single-item-mini">
		<?php
		$product_cat = get_the_terms( $product->get_id(), 'product_cat' );
		if ( $product_cat ) {
			?>
		<div class="brator-product-single-item-cat">
			<a href="<?php echo esc_url( get_term_link( $product_cat[0]->slug, 'product_cat' ) ); ?>"><?php echo esc_html( $product_cat[0]->name ); ?></a>
		</div>
	  <?php } ?>
	  <div class="brator-product-single-item-title">
		<h5><a href="<?php echo esc_url( $link ); ?>"> <?php echo esc_html( $title ); ?></a></h5>
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
	  <?php if ( $price_html = $product->get_price_html() ) : ?>
	  <div class="brator-product-single-item-price">
		<p><?php echo wp_kses( $price_html, 'code_contxt' ); ?></p>
	  </div>
	  <?php endif; ?>

	<?php
}
add_filter( 'woocommerce_after_shop_loop_item', 'brator_woocommerce_after_shop_loop_item' );
function brator_woocommerce_after_shop_loop_item() {
	?>
	<div class="brator-product-single-item-btn"><?php woocommerce_template_loop_add_to_cart(); ?></div>
	</div>
	<?php
}

/**
 * Change several of the breadcrumb defaults
 */
add_filter( 'woocommerce_breadcrumb_defaults', 'brator_woocommerce_breadcrumbs' );
function brator_woocommerce_breadcrumbs() {
	if ( is_product() ) {
		$class = 'gray-bg';
	} else {
		$class = '';
	}
	return array(
		'delimiter'   => '',
		'wrap_before' => '<section class="brator-breadcrumb-area ' . $class . '"><div class="container-xxxl container-xxl container"><div class="row"><div class="col-lg-12"><div class="brator-breadcrumb"><ul>',
		'wrap_after'  => '</ul></div></div></div></div></section>',
		'before'      => '<li>',
		'after'       => '</li>',
		'home'        => _x( 'Home', 'breadcrumb', 'brator' ),
	);

}

add_action( 'woocommerce_before_main_content', 'brator_woocommerce_category_banner', 15 );

function brator_woocommerce_category_banner() {
	if ( is_product_taxonomy() && 0 === absint( get_query_var( 'paged' ) ) ) {
		$term = get_queried_object();
		if ( $term ) {
			$thumbnail_id = get_term_meta( $term->term_id, 'thumbnail_id', true );
			$image_url    = wp_get_attachment_url( $thumbnail_id );
			?>
			<div class="brator-banner-slider-area">
				<div class="container-xxxl container-xxl container">
				<div class="row">
					<div class="col-md-12">
					<div class="brator-banner-area design-four">
						<?php if ( isset( $image_url ) && ! empty( $image_url ) ) { ?>
							<picture class="tt-pagetitle__img">
								<img src="<?php echo esc_url( $image_url ); ?>" alt="<?php esc_attr_e( 'Page Title BG', 'brator' ); ?>">
							</picture>
						<?php } ?>
						<div class="brator-banner-content">
							<h2><?php echo esc_html( $term->name ); ?></h2>
							<p><?php echo esc_html( $term->description ); ?></p>
						</div>
					</div>
					</div>
				</div>
				</div>
			</div>
			<?php
		}
	} elseif ( ! is_product() ) {
		$breadcrumb_bg = brator_get_options( 'breadcrumb_bg' );
		?>
		<div class="brator-banner-slider-area">
			<div class="container-xxxl container-xxl container">
			<div class="row">
				<div class="col-md-12">
				<div class="brator-banner-area design-four shop-bg">
					<?php if ( ! empty( $breadcrumb_bg ) ) { ?>
					<picture class="tt-pagetitle__img">
						<img src="<?php echo esc_url( $breadcrumb_bg ); ?>" alt="<?php esc_attr_e( 'Shop Title BG', 'brator' ); ?>">
					</picture>
					<?php } ?>
					<div class="brator-banner-content">
						<h2><?php woocommerce_page_title(); ?></h2>
					</div>
				</div>
				</div>
			</div>
			</div>
		</div>
		<?php
	}
}


function brator_best_seller_products_query() {
	$best_seller_porducts      = brator_get_options( 'best_seller_porducts' );
	$best_seller_porducts_show = brator_get_options( 'best_seller_porducts_show' );
	if ( $best_seller_porducts ) {
		?>
		<div class="brator-best-product-slider">
			<div class="brator-section-header">
				<div class="brator-section-header-title">
					<h2><?php esc_html_e( 'Best Seller', 'brator' ); ?></h2>
				</div>
			</div>
			<div class="brator-product-slider splide js-splide p-splide" data-splide='{"pagination":false,"type":"slide","perPage":4,"perMove":"1","gap":30, "breakpoints":{ "576" :{ "perPage": "1" },"746" :{ "perPage": "2" }, "768" :{ "perPage" : "2" }, "991":{ "perPage" : "3" }, "1399":{ "perPage" : "4" }, "1500":{ "perPage" : "4" }, "1920":{ "perPage" : "4" }}}'>
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
					<?php
						$argsbest  = array(
							'post_status'    => array( 'publish' ),
							'post_type'      => 'product',
							'posts_per_page' => $best_seller_porducts_show,
							'order'          => 'DESC',
							'meta_key'       => 'total_sales',
							'orderby'        => 'meta_value_num',
						);
						$querybest = new WP_Query( $argsbest );
						if ( $querybest->have_posts() ) :

							while ( $querybest->have_posts() ) :
								$querybest->the_post();
								wc_get_template_part( 'content', 'product-slidetwo' );
							endwhile;
						else :
							echo '<p>' . esc_html__( 'Product No Found', 'brator' ) . '</p>';
						endif;
						wp_reset_postdata();
						?>
					</div>
				</div>
			</div>
		</div>
		<div class="brator-plan-pixel-area">
			<div class="plan-pixel-area"></div>
		</div>
		<?php
	}
}


add_filter( 'woocommerce_add_to_cart_fragments', 'brator_cart_count_fragments', 10, 1 );
function brator_cart_count_fragments( $fragments ) {
	$fragments['span.header-cart-count'] = '<span class="header-cart-count">' . WC()->cart->get_cart_contents_count() . '</span>';
	return $fragments;
}

add_filter( 'woocommerce_add_to_cart_fragments', 'brator_cart_count_fragments2', 10, 1 );
function brator_cart_count_fragments2( $fragments ) {
	if ( WC()->cart->get_cart_contents_count() == 1 ) {
		$fragments['span.header-cart-count2'] = '<span class="header-cart-count2">(' . WC()->cart->get_cart_contents_count() . esc_html__( ' item', 'brator' ) . ')</span>';
	} else {
		$fragments['span.header-cart-count2'] = '<span class="header-cart-count2">(' . WC()->cart->get_cart_contents_count() . esc_html__( ' items', 'brator' ) . ')</span>';
	}
	return $fragments;
}

add_filter( 'woocommerce_add_to_cart_fragments', 'brator_woocommerce_header_add_to_cart_fragment' );
function brator_woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;
	ob_start();
	?>
	<b class="header-cart-total"><?php echo wp_kses( $woocommerce->cart->get_cart_total(), 'code_contxt' ); ?></b>
	<?php
	$fragments['b.header-cart-total'] = ob_get_clean();
	return $fragments;
}

// the ajax function
add_action( 'wp_ajax_brator_products_search', 'brator_products_search' );
add_action( 'wp_ajax_nopriv_brator_products_search', 'brator_products_search' );
function brator_products_search() {

	$header_search_by = brator_get_options( 'header_search_by' );

	$cat_search    = isset( $_POST['cat_search'] ) && $_POST['cat_search'] != '' ? sanitize_text_field( $_POST['cat_search'] ) : '';
	$keyword_title = isset( $_POST['pro_search'] ) && $_POST['pro_search'] != '' ? sanitize_text_field( $_POST['pro_search'] ) : '';
	if ( $cat_search ) {
		$the_query = new WP_Query(
			array(
				'post_type'      => 'product',
				'posts_per_page' => -1,
				'product_cat'    => $cat_search,
			)
		);
	} elseif ( $header_search_by == '3' ) {
		$the_query = new WP_Query(
			array(
				'post_type'      => 'product',
				'posts_per_page' => -1,
				'tax_query'      => array(
					'relation' => 'OR',
					array(
						'taxonomy' => 'make_brand',
						'field'    => 'slug',
						'terms'    => $keyword_title,
					),
					array(
						'taxonomy' => 'make_model',
						'field'    => 'slug',
						'terms'    => $keyword_title,
					),
					array(
						'taxonomy' => 'make_year',
						'field'    => 'slug',
						'terms'    => $keyword_title,
					),
					array(
						'taxonomy' => 'make_engine',
						'field'    => 'slug',
						'terms'    => $keyword_title,
					),
				),
			)
		);
	} elseif ( $header_search_by == '2' ) {
		$the_query = new WP_Query(
			array(
				'post_type'      => 'product',
				'posts_per_page' => -1,
				'meta_query'     => array(
					array(
						'key'   => '_sku',
						'value' => $keyword_title,
					),
				),
			)
		);
	} else {

		$the_query = new WP_Query(
			array(
				'post_type'      => 'product',
				'posts_per_page' => -1,
				's'              => $keyword_title,
				// 'meta_query'     => array(
				// 'relation' => 'OR',
				// 'name' => array(
				// 'key'     => 's',
				// 'value'   => $keyword_title,
				// 'compare' => 'LIKE',
				// ),
				// 'sku'      => array(
				// 'key'     => '_sku',
				// 'value'   => $keyword_title,
				// 'compare' => 'LIKE',
				// ),
				// ),
			)
		);
	}

	if ( $the_query->have_posts() ) :
		while ( $the_query->have_posts() ) :
			$the_query->the_post();
			global $product;
			?>
			<div class="listing-search-item woocommerce">
				<a href="<?php echo esc_url( the_permalink() ); ?>">
					<?php the_post_thumbnail( 'brator-search-pro-size' ); ?>
				</a>
				<div class="pro-content">
					<h5><a href="<?php echo esc_url( the_permalink() ); ?>"><?php the_title(); ?></a></h5>
					<?php if ( ! empty( $product->get_sku() ) ) { ?>
					<span><strong><?php esc_html_e( 'Sku:', 'brator' ); ?></strong> <?php echo esc_html( $product->get_sku() ); ?></span>
					<?php } ?>
					<?php if ( $price_html = $product->get_price_html() ) : ?>
					<div class="pro-price"><?php echo wp_kses( $price_html, 'code_contxt' ); ?></div>
					<?php endif; ?>
				</div>
				<div class="pro-cart">
					<?php
					if ( $product->is_type( 'simple' ) && ! empty( $product->get_price_html() ) ) {
						echo apply_filters(
							'woocommerce_loop_add_to_cart_link', // WPCS: XSS ok.
							sprintf(
								'<a href="%s" data-quantity="%s" class="%s" data-product_id="%s" %s>%s</a>',
								esc_url( $product->add_to_cart_url() ),
								esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
								esc_attr( isset( $args['class'] ) ? $args['class'] : 'add_to_cart_button ajax_add_to_cart' ),
								esc_attr( isset( $args['product_id'] ) ? $args['product_id'] : $product->get_id() ),
								isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
								'<svg fill="#000000" width="52" height="52" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 64 64"><g><path d="M40.9,48.2c-3.9,0-7.1,3.3-7.1,7.3c0,4,3.2,7.3,7.1,7.3s7.1-3.3,7.1-7.3C48.1,51.5,44.9,48.2,40.9,48.2z M40.9,59.3c-2,0-3.6-1.7-3.6-3.8c0-2.1,1.6-3.8,3.6-3.8s3.6,1.7,3.6,3.8C44.6,57.6,42.9,59.3,40.9,59.3z"></path><path d="M18.2,48.2c-3.9,0-7.1,3.3-7.1,7.3c0,4,3.2,7.3,7.1,7.3s7.1-3.3,7.1-7.3C25.4,51.5,22.2,48.2,18.2,48.2z M18.2,59.3c-2,0-3.6-1.7-3.6-3.8c0-2.1,1.6-3.8,3.6-3.8s3.6,1.7,3.6,3.8C21.9,57.6,20.2,59.3,18.2,59.3z"></path><path d="M57.8,1.3h-6.4c-1.5,0-2.8,1.1-3,2.6l-1.8,13.2H7.3c-0.9,0-1.7,0.4-2.2,1.1c-0.5,0.7-0.7,1.6-0.5,2.4c0,0,0,0.1,0,0.1l6.1,18.9c0.3,1.2,1.4,2.1,2.8,2.1h29.5c2.2,0,4-1.6,4.3-3.8l4.6-33.2h6c1,0,1.8-0.8,1.8-1.8S58.8,1.3,57.8,1.3z M43.7,37.4c-0.1,0.4-0.4,0.8-0.9,0.8h-29L8.1,20.6h37.9L43.7,37.4z"></path></g></svg>'
							),
							$product
						);
					} else {
						?>
					<a href="<?php echo esc_url( the_permalink() ); ?>"><svg fill="#000000" width="52" height="52" version="1.1" id="lni_lni-eye" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 64 64" xml:space="preserve"><g><path d="M32,25c-3.9,0-7,3.2-7,7s3.2,7,7,7s7-3.2,7-7S35.9,25,32,25z M32,35.5c-1.9,0-3.5-1.6-3.5-3.5c0-1.9,1.6-3.5,3.5-3.5c1.9,0,3.5,1.6,3.5,3.5C35.5,33.9,33.9,35.5,32,35.5z"/><path d="M62.4,30.8c-6.6-10.4-18-16.6-30.4-16.6c-12.4,0-23.8,6.2-30.4,16.6c-0.4,0.7-0.4,1.6,0,2.3c6.6,10.4,18,16.6,30.4,16.6c12.4,0,23.8-6.2,30.4-16.6l0,0C62.9,32.4,62.9,31.5,62.4,30.8z M32,46.2c-10.9,0-21-5.3-27-14.3c6-8.9,16.1-14.2,27-14.2c10.9,0,21,5.3,27,14.2C53,40.9,42.9,46.2,32,46.2z"/></g></svg></a>
				<?php } ?>
				</div>
			</div>
				<?php
		endwhile;
		wp_reset_postdata();
	else :
		echo '<p class="not-found-pro">' . esc_html__( 'Product Not Found', 'brator' ) . '</p>';
	endif;
	wp_die();
}
