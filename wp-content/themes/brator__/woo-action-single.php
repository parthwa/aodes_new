<?php
// Woocommerce Single Page
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_loop_product_thumbnail', 20 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

add_filter( 'woocommerce_quantity_input_max', 'brator_quantity_input_max_callback', 10, 2 );
function brator_quantity_input_max_callback( $max ) {
	$max = 1000;
	return $max;
}

add_action( 'brator_product_check_for_vehicle', 'brator_product_check_for_vehicle_func' );
function brator_product_check_for_vehicle_func() {
	$demo_select = brator_get_options( 'demo_select' );
	if ( $demo_select != 'electro' ) {
		global $product;
		$product_id = $product->get_id();

		$meke_year   = get_the_terms( $product_id, 'make_year' );
		$make_brand  = get_the_terms( $product_id, 'make_brand' );
		$make_model  = get_the_terms( $product_id, 'make_model' );
		$make_engine = get_the_terms( $product_id, 'make_engine' );
		$engine_onof = brator_get_options( 'engine_onof_switch' );

		$year   = array();
		$brand  = array();
		$model  = array();
		$engine = array();
		if ( ! empty( $meke_year ) ) {
			foreach ( $meke_year as $var ) {
				$year[] = $var->slug;
			}
		}
		if ( ! empty( $make_brand ) ) {
			foreach ( $make_brand as $var ) {
				$brand[] = $var->slug;
			}
		}
		if ( ! empty( $make_model ) ) {
			foreach ( $make_model as $var ) {
				$model[] = $var->slug;
			}
		}
		if ( ! empty( $make_engine ) ) {
			foreach ( $make_engine as $var ) {
				$engine[] = $var->slug;
			}
		}

		if ( ! empty( $_SESSION['vehicle_items'] ) ) {
			foreach ( $_SESSION['vehicle_items'] as $val ) {
				if ( $engine_onof ) {
					$key = $val['makeyear'] . '_' . str_replace( '-', '_', $val['brand'] ) . '_' . $val['model'] . '_' . $val['engine'];
				} else {
					$key = $val['makeyear'] . '_' . str_replace( '-', '_', $val['brand'] ) . '_' . $val['model'];
				}
				$count[ $key ] = 0;

				if ( in_array( $val['makeyear'], $year ) ) {
					$count[ $key ]++;
				} else {
					$count[ $key ]--;
				}

				if ( in_array( $val['brand'], $brand ) ) {
					$count[ $key ]++;
				} else {
					$count[ $key ]--;
				}

				if ( in_array( $val['model'], $model ) ) {
					$count[ $key ]++;
				} else {
					$count[ $key ]--;
				}
				if ( $engine_onof ) {
					if ( in_array( $val['engine'], $engine ) ) {
						$count[ $key ]++;
					} else {
						$count[ $key ]--;
					}
				}

				$my_data[] = $count[ $key ];
			}
			if ( $engine_onof ) {
				$match_tax = '4';
			} else {
				$match_tax = '3';
			}

			$matchvehicle = array_search( $match_tax, $count );
			$matchvehicle = str_replace( '_', ' ', $matchvehicle );
			$matchvehicle = str_replace( '-', ' ', $matchvehicle );

			if ( in_array( $match_tax, $my_data ) ) {
				?>
			<h5>
			<svg fill="white" width="20" height="20"  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 64 64" style="enable-background:new 0 0 64 64;" xml:space="preserve"><path d="M62.3,12.7c-0.7-0.7-1.8-0.7-2.5,0L23.3,48.1c-0.3,0.3-0.7,0.3-1,0L4.2,30.5c-0.7-0.7-1.8-0.7-2.5,0c-0.7,0.7-0.7,1.8,0,2.5l18.1,17.6c0.8,0.8,1.9,1.2,2.9,1.2c1.1,0,2.1-0.4,2.9-1.2l36.5-35.4C62.9,14.5,62.9,13.4,62.3,12.7z"/></svg>
				<span><?php echo esc_html__( 'This product fit for your vehicle ', 'brator' ) . '<span>' . $matchvehicle . '</span>'; ?></span>
			</h5>
				<?php
			} else {
				?>
			<h5>
				<svg class="active" fill="#000000" width="52" height="52" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 64 64">
					<path d="M59.7,23.9l-18.1-2.8L33.4,3.9c-0.6-1.2-2.2-1.2-2.8,0l-8.2,17.3L4.4,23.9c-1.3,0.2-1.8,1.9-0.8,2.8l13.1,13.5l-3.1,18.9  c-0.2,1.3,1.1,2.4,2.3,1.6l16.3-8.9l16.2,8.9c1.1,0.6,2.5-0.4,2.2-1.6l-3.1-18.9l13.1-13.5C61.4,25.8,61,24.1,59.7,23.9z"></path>
				</svg><span><?php esc_html_e( 'This product not fit for your vehicle', 'brator' ); ?></span>
			</h5>
				<?php
			}
		}
	}
}

add_action( 'brator_product_check_for_vehicle_check', 'brator_product_check_for_vehicle_check_func' );
function brator_product_check_for_vehicle_check_func() {
	$demo_select = brator_get_options( 'demo_select' );
	if ( $demo_select != 'electro' ) {
		global $product;
		$product_id = $product->get_id();

		$meke_year  = get_the_terms( $product_id, 'make_year' );
		$make_brand = get_the_terms( $product_id, 'make_brand' );
		$make_model = get_the_terms( $product_id, 'make_model' );

		$make_engine = get_the_terms( $product_id, 'make_engine' );
		$engine_onof = brator_get_options( 'engine_onof_switch' );

		$year   = array();
		$brand  = array();
		$model  = array();
		$engine = array();
		if ( ! empty( $meke_year ) ) {
			foreach ( $meke_year as $var ) {
				$year[] = $var->slug;
			}
		}
		if ( ! empty( $make_brand ) ) {
			foreach ( $make_brand as $var ) {
				$brand[] = $var->slug;
			}
		}
		if ( ! empty( $make_model ) ) {
			foreach ( $make_model as $var ) {
				$model[] = $var->slug;
			}
		}

		if ( ! empty( $make_engine ) ) {
			foreach ( $make_engine as $var ) {
				$engine[] = $var->slug;
			}
		}

		if ( ! empty( $_SESSION['vehicle_items'] ) ) {
			foreach ( $_SESSION['vehicle_items'] as $val ) {
				if ( $engine_onof ) {
					$key = $val['makeyear'] . '_' . str_replace( '-', '_', $val['brand'] ) . '_' . $val['model'] . '_' . $val['engine'];
				} else {
					$key = $val['makeyear'] . '_' . str_replace( '-', '_', $val['brand'] ) . '_' . $val['model'];
				}
				$count[ $key ] = 0;

				if ( in_array( $val['makeyear'], $year ) ) {
					$count[ $key ]++;
				} else {
					$count[ $key ]--;
				}

				if ( in_array( $val['brand'], $brand ) ) {
					$count[ $key ]++;
				} else {
					$count[ $key ]--;
				}

				if ( in_array( $val['model'], $model ) ) {
					$count[ $key ]++;
				} else {
					$count[ $key ]--;
				}

				if ( $engine_onof ) {
					if ( in_array( $val['engine'], $engine ) ) {
						$count[ $key ]++;
					} else {
						$count[ $key ]--;
					}
				}

				$my_data[] = $count[ $key ];

			}

			if ( $engine_onof ) {
				$match_tax = '4';
			} else {
				$match_tax = '3';
			}

			if ( in_array( $match_tax, $my_data ) ) {
				?>
			<span class="vehicle-check tool" data-tip="<?php esc_attr_e( 'This product is fit for your added vehicle.', 'brator' ); ?>">
				<svg fill="white" width="20" height="20"  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 64 64" style="enable-background:new 0 0 64 64;" xml:space="preserve"><path d="M62.3,12.7c-0.7-0.7-1.8-0.7-2.5,0L23.3,48.1c-0.3,0.3-0.7,0.3-1,0L4.2,30.5c-0.7-0.7-1.8-0.7-2.5,0c-0.7,0.7-0.7,1.8,0,2.5l18.1,17.6c0.8,0.8,1.9,1.2,2.9,1.2c1.1,0,2.1-0.4,2.9-1.2l36.5-35.4C62.9,14.5,62.9,13.4,62.3,12.7z"/></svg>
			</span>
				<?php
			}
		}
	}
}

add_action( 'woocommerce_before_single_product_summary', 'brator_before_single_product_summery', 10 );
function brator_before_single_product_summery() {
	$product_layout = brator_get_product_options();
	if ( $product_layout == '2' ) {
		$layout_class = 'desing-two';
	} else {
		$layout_class = 'desing-one';
	}
	?>
	<div class="brator-product-header-layout-area <?php echo esc_attr( $layout_class ); ?>">
		<div class="container-xxxl container-xxl container">
			<div class="row">
				<div class="brator-product-header-layout">
	<?php
}

add_action( 'woocommerce_after_single_product_summary', 'brator_after_single_product_summery', 10 );
function brator_after_single_product_summery() {
	$product_layout = brator_get_product_options();
	?>
				</div>
			</div>
		</div>
	</div>
	<?php if ( $product_layout == '2' ) { ?>
	<div class="brator-plan-pixel-area">
	  <div class="container-xxxl container-xxl container">
		<div class="col-12">
		  <div class="plan-pixel-area"></div>
		</div>
	  </div>
	</div>
	<div class="brator-product-single-tab-area design-two">
		<div class="container-xxxl container-xxl container">
			<div class="row">
				<div class="col-md-12">
					<?php woocommerce_output_product_data_tabs(); ?>
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
		<?php
	} else {
		$product_ids      = get_post_meta( get_the_ID(), 'frequently_bought_ids', true );
			$heading_text = get_post_meta( get_the_ID(), 'brator_fb_heading_text', true );
			global $product;
			$review_count = $product->get_review_count();
		if ( $review_count == 0 || $review_count > 1 ) {
			$review_count_var = $review_count . esc_html__( ' Reviews', 'brator' );
		} else {
			$review_count_var = $review_count . esc_html__( ' Review', 'brator' );
		}
		$product_type = $product->get_type();

		$product_id = $product->get_id();
		$product    = new WC_Product_Variable( $product_id );
		$variations = $product->get_available_variations();
		$var_data   = array();
		foreach ( $variations as $variation ) {
			$var_data[] = $variation['display_price'];
		}
		$check = array_unique( $var_data );
		$check = count( $check );

		if ( $product_ids ) {
			?>
	<div class="brator-product-frequently-area">
	  <div class="container-xxxl container-xxl container">
		<div class="row">
		  <div class="col-xxl-9 col-xl-12">
			<div class="brator-product-single-frequently">
			  <h2><?php echo esc_html( $heading_text ); ?></h2>
			  <div class="brator-product-single-frequently-list">
			  <div class="product-list-items check-box-product">
				 <?php if ( $product->get_price_html() ) : ?>
				  <div class="brator-product-single-item-area design-two">
					<div class="brator-product-single-item-img"><a href="<?php esc_url( the_permalink() ); ?>"><?php echo brator_the_product_thumbnail(); ?></a></div>
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
							<h5><a href="<?php esc_url( the_permalink() ); ?>"> <?php echo esc_html( the_title() ); ?></a></h5>
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
						<div class="brator-product-single-item-price">
							<p><?php echo wp_kses( $product->get_price_html(), 'code_contxt' ); ?></p>
						</div>
						<div class="brator-product-single-item-checkbox">
							<input type="checkbox" class="fb_pro_price" value="<?php echo esc_attr( $product->get_id() ); ?>" data-price="<?php echo esc_attr( $product->get_price() ); ?>" checked>
							<div class="arow-check-right"></div>
						</div>
					</div>
				</div>
				<?php endif; ?>
			  <?php
				$product_id_arr    = array();
				$product_price_arr = array();

				foreach ( $product_ids as $product_id ) {

					$fb_product = wc_get_product( $product_id );

					$review_count = $fb_product->get_review_count();
					if ( $review_count == 0 || $review_count > 1 ) {
						$review_count_var = $review_count . esc_html__( ' Reviews', 'brator' );
					} else {
						$review_count_var = $review_count . esc_html__( ' Review', 'brator' );
					}

					$fb_product_type = $fb_product->get_type(); // product Type
					$product_id      = $fb_product->get_id(); // product ID
					$product_name    = $fb_product->get_name(); // product name
					$product_price   = $fb_product->get_price(); // product price

					$product_id_arr[]    = $product_id;
					$product_price_arr[] = $product_price;
					if ( $fb_product->get_price_html() ) {
						?>
						<div class="brator-product-single-item-area design-two">
							<div class="brator-product-single-item-img"><a href="<?php esc_url( the_permalink( $product_id ) ); ?>"><?php echo get_the_post_thumbnail( $product_id, 'brator-shop-pro-size' ); ?></a></div>
							<div class="brator-product-single-item-mini">
							<?php
							$product_cat = get_the_terms( $product_id, 'product_cat' );
							if ( $product_cat ) {
								?>
							<div class="brator-product-single-item-cat">
								<a href="<?php echo esc_url( get_term_link( $product_cat[0]->slug, 'product_cat' ) ); ?>"><?php echo esc_html( $product_cat[0]->name ); ?></a>
							</div>
						<?php } ?>
							<div class="brator-product-single-item-title">
								<h5><a href="<?php esc_url( the_permalink( $product_id ) ); ?>"> <?php echo esc_html( $product_name ); ?></a></h5>
							</div>
							<?php if ( $fb_product->get_average_rating() ) : ?>
							<div class="brator-product-single-item-review">
								<div class="brator-review">
									<?php echo wc_get_rating_html( $fb_product->get_average_rating() ); ?>
								</div>
								<div class="brator-review-text">
									<p><?php echo esc_html( $review_count_var ); ?></p>
								</div>
							</div>
							<?php endif; ?>
							<div class="brator-product-single-item-price">
								<p><?php echo wp_kses( $fb_product->get_price_html(), 'code_contxt' ); ?></p>
							</div>
							<div class="brator-product-single-item-checkbox">
								<input type="checkbox" class="fb_pro_price" value="<?php echo esc_attr( $fb_product->get_id() ); ?>" data-price="<?php echo esc_attr( $fb_product->get_price() ); ?>" checked>
								<div class="arow-check-right"></div>
							</div>
							</div>
						</div>
							<?php
					}
				}

				?>
				</div>
				<div class="brator-product-single-frequently-total">
					<?php
					$brator_fb_discount_price = get_post_meta( get_the_ID(), 'brator_fb_discount_price', true );

					array_push( $product_price_arr, $product->get_price() );
					$product_price_tol = array_sum( $product_price_arr );
					$total             = get_woocommerce_currency_symbol() . $product_price_tol;
					array_push( $product_id_arr, $product->get_id() );
					$product_ids_cart = implode( ',', $product_id_arr );
					?>
				  <h6><?php esc_html_e( 'Total:', 'brator' ); ?></h6><span><?php echo get_woocommerce_currency_symbol(); ?><input id="to_pro_price" type="text" value="<?php echo esc_attr( $product_price_tol ); ?>"/></span>
				  <?php
					if ( ! empty( $brator_fb_discount_price ) ) {
						$after_discount = $product_price_tol - $brator_fb_discount_price;
						?>
				  <h6><?php esc_html_e( 'Discount Total:', 'brator' ); ?></h6><span><del><?php echo get_woocommerce_currency_symbol() . $product_price_tol; ?></del><ins><?php echo get_woocommerce_currency_symbol() . $after_discount; ?></ins></span>

				  <p><?php echo esc_html__( 'Buy these all products together to get ', 'brator' ) . '<b>' . get_woocommerce_currency_symbol() . $brator_fb_discount_price . '</b>' . esc_html__( ' off', 'brator' ); ?></p>
					<?php } ?>
				  <a href="javascript:void(0)" data-quantity="1" class="button add_to_cart_button ajax_add_to_cart_more" data-product_ids="<?php echo esc_attr( $product_ids_cart ); ?>" data-product_sku="" rel="nofollow"><?php esc_html_e( 'Add to cart', 'brator' ); ?></a>
				</div>
			  </div>
			</div>
		  </div>
		  <div class="col-xxl-3 col-xl-12">
			<?php do_action( 'brator_product_page_posts' ); ?>
		  </div>
		</div>
	  </div>
	</div>
	<?php } ?>
	<div class="brator-product-single-tab-area design-one-m">
		<div class="container-xxxl container-xxl container">
			<div class="row">
				<div class="col-xxl-8 col-md-12">
					<?php woocommerce_output_product_data_tabs(); ?>
				</div>
			</div>
		</div>
	</div>
		<?php
	}
}


add_action( 'woocommerce_single_product_summary', 'brator_template_single_title', 5 );
function brator_template_single_title() {
	global $product;

	$newness_days = 30; // Number of days the badge is shown
	$created      = strtotime( $product->get_date_created() );

	$rating_count = $product->get_rating_count();
	$review_count = $product->get_review_count();
	if ( $review_count > 1 ) {
		$review_count_var = $review_count . esc_html__( ' Reviews', 'brator' );
	} else {
		$review_count_var = $review_count . esc_html__( ' Review', 'brator' );
	}
	$product_layout = brator_get_product_options();
	?>
	<div class="brator-product-hero-content-info">
		<div class="brator-product-hero-content-brand">
			<?php the_terms( $product->get_id(), 'make_brand', '', ', ', ' ' ); ?>
		</div>
		<div class="brator-product-hero-content-title">
			<h2><?php the_title(); ?></h2>
		</div>
		<div class="brator-product-hero-content-review">
		<?php
		if ( $product->is_on_sale() ) {
			$prices   = brator_get_product_prices( $product );
			$returned = brator_product_special_price_calc( $prices );
			if ( isset( $returned['percent'] ) && $returned['percent'] ) {
				?>
				<div class="product-batch off-batch"><?php echo sprintf( esc_html__( '%d%% Off', 'brator' ), $returned['percent'] ); ?></div>
				<?php
			}
		}
		?>
			<?php
			if ( ( time() - ( 60 * 60 * 24 * $newness_days ) ) < $created ) {
				echo '<div class="product-batch yollow-batch">' . esc_html__( 'New', 'brator' ) . '</div>';
			}
			?>
			<?php if ( $rating_count > 0 ) { ?>
			<div class="brator-review-product">
				<div class="brator-review">
				<?php echo wc_get_rating_html( $product->get_average_rating() ); ?>
				</div>
				<div class="brator-review-text">
					<p><?php echo esc_html( $review_count_var ); ?></p>
				</div>
			</div>
			<?php } ?>
		</div>
		<?php if ( $product_layout != '2' ) { ?>
		<div class="brator-product-hero-content-price">
			<h6><?php echo wp_kses( $product->get_price_html(), 'code_contxt' ); ?></h6>
		</div>
		<?php } ?>
		<div class="brator-product-hero-content-stock">
			<?php if ( $product->is_in_stock() ) { ?>
			<h6><?php esc_html_e( 'In Stock', 'brator' ); ?></h6>
			<?php } ?>
			<?php do_action( 'brator_product_check_for_vehicle' ); ?>
		</div>
		
		<div class="brator-product-single-item-featu">
		<?php the_excerpt(); ?>
		</div>
	</div>
	<?php if ( $product_layout != '2' ) { ?>
	<div class="brator-product-hero-content-add-to-cart">
		<?php woocommerce_template_single_add_to_cart(); ?>
	</div>
	<div class="brator-product-single-cart-action">
		<?php if ( function_exists( 'activation_tinv_wishlist' ) ) { ?>
		<div class="brator-product-single-cart-wish">
			<?php echo do_shortcode( '[ti_wishlists_addtowishlist]' ); ?>
		</div>
		<?php } ?>
	</div>
	<?php } ?>
	<div class="brator-product-single-light-info-area">
		<div class="brator-product-single-light-info">
			<div class="brator-product-single-light-info-s cat">
				<h5><?php esc_html_e( 'Categories:', 'brator' ); ?> </h5>
				<?php echo wc_get_product_category_list( $product->get_id(), '' ); ?>
			</div>
			<?php
			$current_tags = get_the_terms( get_the_ID(), 'product_tag' );
			if ( ! empty( $current_tags ) && ! is_wp_error( $current_tags ) ) {
				?>
			<div class="brator-product-single-light-info-s">
				<h5><?php esc_html_e( 'Tags:', 'brator' ); ?></h5>
				<?php
				foreach ( $current_tags as $tag ) {
					$tag_title = $tag->name;
					$tag_link  = get_term_link( $tag );
					echo '<a href="' . $tag_link . '">' . $tag_title . '</a>';
				}
				?>
			</div>
			<?php } ?>
			<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) { ?>
			<div class="brator-product-single-light-info-s">
				<h5><?php esc_attr_e( 'SKU:', 'brator' ); ?></h5><span><?php echo esc_html( $product->get_sku() ); ?></span>
			</div>
			<?php } ?>
		</div>
	</div>
	<?php
}

add_action( 'woocommerce_after_single_product_summary', 'brator_related_after_single_product_summary', 10 );
function brator_related_after_single_product_summary() {
	global $product;
	$related                               = wc_get_related_products( $product->get_id() );
	$recently_viewed_porducts_product_page = brator_get_options( 'recently_viewed_porducts_product_page' );
	if ( count( $related ) > 0 ) {
		?>
		<div class="brator-deal-product-slider recently-view">
			  <div class="container-xxxl container-xxl container">
				<div class="row">
					<div class="col-12">
						<div class="brator-section-header">
							<div class="brator-section-header-title">
								<h2><?php esc_html_e( 'You May Also Like', 'brator' ); ?></h2>
							</div>
						</div>
					</div>
					<div class="col-12">
						<div class="brator-product-slider splide js-splide p-splide" data-splide='{"pagination":false,"type":"slide","perPage":5,"perMove":"1","gap":30, "breakpoints":{ "520" :{ "perPage": "1" },"746" :{ "perPage": "2" }, "768" :{ "perPage" : "3" }, "1090":{ "perPage" : "3" }, "1366":{ "perPage" : "4" }, "1500":{ "perPage" : "4" }, "1920":{ "perPage" : "5" }}}'>
							<div class="splide__arrows style-two">
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
								<?php brator_output_related_products(); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
	if ( $recently_viewed_porducts_product_page ) {
		do_shortcode( '[brator_recently_viewed_products style="2"]' );
	}
}

add_filter( 'woocommerce_output_related_products', 'brator_output_related_products', 10, 1 );
function brator_output_related_products() {
	global $product;
	$related_products = array_filter( array_map( 'wc_get_product', wc_get_related_products( $product->get_id(), 10, $product->get_upsell_ids() ) ), 'wc_products_array_filter_visible' );
	foreach ( $related_products as $related_product ) :
		$post_object = get_post( $related_product->get_id() );
		setup_postdata( $GLOBALS['post'] =& $post_object );
		wc_get_template_part( 'content', 'product-slidetwo' );
	endforeach;
}


add_action( 'woocommerce_after_single_product', 'brator_woocommerce_after_single_product', 20 );
function brator_woocommerce_after_single_product() {
}

add_action( 'comment_form_logged_in_after', 'brator_add_review_title_field_on_comment_form' );
add_action( 'comment_form_after_fields', 'brator_add_review_title_field_on_comment_form' );
function brator_add_review_title_field_on_comment_form() {
	if ( is_product() ) {
		echo '<div class="brator-contact-form-field review-title-field"><input type="text" name="title" id="title" placeholder="' . esc_attr__( 'Give your review a tittle (Optional)', 'brator' ) . '"/></div>';
	}
}


add_action( 'comment_post', 'brator_save_comment_review_title_field' );
function brator_save_comment_review_title_field( $comment_id ) {

	if ( isset( $_POST['title'] ) ) {
		update_comment_meta( $comment_id, 'title', esc_attr( $_POST['title'] ) );
	}

}

if ( ! function_exists( 'brator_product_comments' ) ) {
	function brator_product_comments( $comment, $args, $depth ) {
		extract( $args, EXTR_SKIP );
		$args['reply_text'] = esc_html__( 'Reply', 'brator' );

		global $comment;
		$title  = get_comment_meta( $comment->comment_ID, 'title', true );
		$rating = intval( get_comment_meta( $comment->comment_ID, 'rating', true ) );
		?>
		<div class="comment" id="comment-<?php comment_ID(); ?>">
			<div class="brator-review-comment-single-item">
				<div class="brator-review-comment-single-img">
					<?php print get_avatar( $comment, 70, null, null, array( 'class' => array() ) ); ?>
				</div>
				<div class="brator-review-comment-single-content">  
					<div class="brator-review">
					<?php
					if ( $rating && wc_review_ratings_enabled() ) {
						echo wc_get_rating_html( $rating ); // WPCS: XSS ok.
					}
					?>
					</div>
					<div class="brator-review-comment-single-title">
					<h6><?php echo esc_html( $title ); ?></h6>
					<?php comment_text(); ?>
					</div>
					<div class="brator-review-comment-date">
					<h6><?php echo get_comment_author_link(); ?><?php echo esc_html__( 'on ', 'brator' ) . get_comment_date(); ?> </h6>
					</div>
				</div>
			</div>
		<?php
	}
}


add_action( 'brator_woocommerce_single_product_summary_two', 'brator_woocommerce_single_product_summary_two_func' );
function brator_woocommerce_single_product_summary_two_func() {
	global $woocommerce;
	global $product;
	$product_layout = brator_get_product_options();
	if ( $product_layout == '2' ) {
		?>
	<div class="brator-product-add-to-cart">
		<?php if ( $price_html = $product->get_price_html() ) { ?>
		<div class="brator-product-add-to-cart-price">
			<h6><?php echo wp_kses( $product->get_price_html(), 'code_contxt' ); ?></h6>
		</div>
	<?php } ?>
		<div class="brator-product-add-to-cart-button-added">
			<?php woocommerce_template_single_add_to_cart(); ?>
		</div>
		<div class="brator-product-single-cart-action">
			<?php if ( function_exists( 'activation_tinv_wishlist' ) ) { ?>
			<div class="brator-product-single-cart-wish">
				<?php echo do_shortcode( '[ti_wishlists_addtowishlist]' ); ?>
			</div>
			<?php } ?>
		</div>
		<div class="brator-product-add-to-cart-quanty">
			<h6><?php esc_html_e( 'Guaranteed Safe Checkout', 'brator' ); ?></h6><img src="<?php echo BRATOR_IMG_URL; ?>/payment.png" alt="<?php esc_attr_e( 'Payment Gateway', 'brator' ); ?>"/>
		</div>
	</div>
		<?php
	}
}



remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
add_action( 'woocommerce_before_cart_collaterals', 'woocommerce_cross_sell_display' );

add_filter( 'woocommerce_before_cart_collaterals', 'brator_woocommerce_before_cart_collaterals' );
function brator_woocommerce_before_cart_collaterals() {
	$cart_page_template = brator_get_options( 'cart_page_template' );
	if ( class_exists( '\\Elementor\\Plugin' ) ) {
		$pluginElementor          = \Elementor\Plugin::instance();
		$brator_all_save_elements = $pluginElementor->frontend->get_builder_content( $cart_page_template );
		echo do_shortcode( $brator_all_save_elements );
	}
}

add_filter( 'woocommerce_before_cart_totals', 'brator_woocommerce_before_cart_totals' );
function brator_woocommerce_before_cart_totals() {

	foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
		$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
		$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

	}
	?>
	<div class="cart-total-header">
		<h2><?php esc_html_e( 'Order Summary', 'brator' ); ?>
			<span class="header-cart-count2">(
				<?php
				if ( WC()->cart->get_cart_contents_count() == 1 ) {
					echo WC()->cart->get_cart_contents_count() . esc_html__( ' item', 'brator' );
				} else {
					echo WC()->cart->get_cart_contents_count() . esc_html__( ' items', 'brator' );
				}
				?>
			)</span>
		</h2>
	</div>
	<?php
}
add_filter( 'woocommerce_after_cart_totals', 'brator_woocommerce_after_cart_totals' );
function brator_woocommerce_after_cart_totals() {
	?>
	<div class="cart-total-accpect-payment">
		<p><?php esc_html_e( 'Accept Payment Methods', 'brator' ); ?></p>
		<div class="list-img-pay">
			<img src="<?php echo BRATOR_IMG_URL; ?>/payment-cart.png" alt="<?php esc_attr_e( 'Payment Gateway', 'brator' ); ?>"/>
		</div>
	</div>
	<?php
}

function woocommerce_button_proceed_to_checkout() {
	?>
	<div class="cart-total-process">
		<a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="wc-forward">
			<?php esc_html_e( 'Proceed To Checkout', 'brator' ); ?>
		</a>
	</div>
	<?php
}


function woocommerce_maybe_add_multiple_products_to_cart_func() {
	$product_ids = explode( ',', $_POST['product_ids'] );
	$count       = count( $product_ids );
	$number      = 0;
	if ( is_array( $product_ids ) ) {
		foreach ( $product_ids as $product_id ) {

			$product_id = apply_filters( 'woocommerce_add_to_cart_product_id', absint( $product_id ) );

			$was_added_to_cart = false;
			$adding_to_cart    = wc_get_product( $product_id );

			if ( ! $adding_to_cart ) {
				continue;
			}

			$add_to_cart_handler = apply_filters( 'woocommerce_add_to_cart_handler', $adding_to_cart->product_type, $adding_to_cart );

			// /*
			// * Sorry.. if you want non-simple products, you're on your own.
			// *
			// * Related: WooCommerce has set the following methods as private:
			// * WC_Form_Handler::add_to_cart_handler_variable(),
			// * WC_Form_Handler::add_to_cart_handler_grouped(),
			// * WC_Form_Handler::add_to_cart_handler_simple()
			// *
			// * Why you gotta be like that WooCommerce?
			// */
			// if ( 'simple' !== $add_to_cart_handler ) {
			// continue;
			// }

			// For now, quantity applies to all products.. This could be changed easily enough, but I didn't need this feature.
			$quantity          = empty( $_REQUEST['quantity'] ) ? 1 : wc_stock_amount( $_REQUEST['quantity'] );
			$passed_validation = apply_filters( 'woocommerce_add_to_cart_validation', true, $product_id, $quantity );

			if ( $passed_validation && false !== WC()->cart->add_to_cart( $product_id, $quantity ) ) {
				$message = apply_filters( 'wc_add_to_cart_message', $message, $product_id );

				if ( ! empty( $message ) ) {
					$message = '<p>' . esc_html__( 'added all products in the cart', 'brator' ) . '</p>';
					return $message;
				}
			}
		}
	} else {
		$product_id = $_POST['product_ids'];
		$product_id = apply_filters( 'woocommerce_add_to_cart_product_id', absint( $product_id ) );

		$was_added_to_cart = false;
		$adding_to_cart    = wc_get_product( $product_id );

		$add_to_cart_handler = apply_filters( 'woocommerce_add_to_cart_handler', $adding_to_cart->product_type, $adding_to_cart );
	}
	wp_die();
}
add_action( 'wp_ajax_woocommerce_maybe_add_multiple_products_to_cart', 'woocommerce_maybe_add_multiple_products_to_cart_func' );
add_action( 'wp_ajax_nopriv_woocommerce_maybe_add_multiple_products_to_cart', 'woocommerce_maybe_add_multiple_products_to_cart_func' );




add_action( 'woocommerce_cart_calculate_fees', 'add_user_discounts' );
/**
 * Add custom fee if more than three article
 *
 * @param WC_Cart $cart
 */
function add_user_discounts( WC_Cart $cart ) {
	global $woocommerce;

	$fb_products_ids = array();
	$items           = $woocommerce->cart->get_cart();
	foreach ( $items as $item => $values ) {
		$_product                 = wc_get_product( $values['data']->get_id() );
		$brator_fb_discount_price = get_post_meta( $values['data']->get_id(), 'brator_fb_discount_price', true );

		$fb_products_ids[] = $values['data']->get_id();

	}

	$fb_product_ids_count = count( $fb_products_ids );

	if ( ! empty( $brator_fb_discount_price ) && $fb_product_ids_count == 3 ) {

		// $discount = $cart->get_subtotal() * 0.5;
		$discount = $brator_fb_discount_price;

		$cart->add_fee( 'Frequently Bought Discount', -$discount );
	}

}
