<?php
function to_bool( $bool ) {
	return ( is_bool( $bool ) ? $bool : ( is_numeric( $bool ) ? ( (bool) intval( $bool ) ) : $bool !== 'false' ) );
}

add_action( 'init', 'brator_register_vehicle_session' );
function brator_register_vehicle_session() {
	if (!headers_sent() && session_id() == '') {
		session_start();
	}
}

add_shortcode( 'brator_auto_parts_vehicle_ready', 'brator_auto_parts_vehicle_ready_func' );
function brator_auto_parts_vehicle_ready_func() {
	$engine = brator_core_get_options( 'engine_onof_switch' );
	?>
	<form method="post" id="advanced-searchform" class="brator-parts-search-box-form">
		<select class="select-year-parts brator-select-active" name="makeyear">
			<option value=""><?php esc_html_e( 'Year', 'brator-core' ); ?></option>
			<?php
			$make_year = get_terms(
				array(
					'taxonomy'   => 'make_year',
					'hide_empty' => false,
				)
			);
			if ( ! empty( $make_year ) ) {
				foreach ( $make_year as $single ) {
					echo '<option value="' . $single->slug . '">' . $single->name . '</option>';
				}
			}
			?>
		</select>
		<select class="select-make-parts brator-select-active" name="brand" >
			<option value=""><?php esc_html_e( 'Make', 'brator-core' ); ?></option>
			<?php
				$make_brand = get_terms(
					array(
						'taxonomy'   => 'make_brand',
						'hide_empty' => false,
					)
				);

			if ( ! empty( $make_brand ) ) {
				foreach ( $make_brand as $single ) {
					echo '<option value="' . $single->slug . '">' . $single->name . '</option>';
				}
			}
			?>
		</select>
		<select class="select-model-parts brator-select-active" name="model" >
			<option value=""><?php esc_html_e( 'Model', 'brator-core' ); ?></option>
			<?php
			$make_model = get_terms(
				array(
					'taxonomy'   => 'make_model',
					'hide_empty' => false,
				)
			);
			if ( ! empty( $make_model ) ) {
				foreach ( $make_model as $single ) {
					echo '<option value="' . $single->slug . '">' . $single->name . '</option>';
				}
			}
			?>
		</select>
		<?php if ( $engine ) { ?>
		<select class="select-engine-parts brator-select-active" name="engine" >
			<option value=""><?php esc_html_e( 'Engine', 'brator-core' ); ?></option>
			<?php
			$make_engine = get_terms(
				array(
					'taxonomy'   => 'make_engine',
					'hide_empty' => false,
				)
			);
			if ( ! empty( $make_engine ) ) {
				foreach ( $make_engine as $single ) {
					echo '<option value="' . $single->slug . '">' . $single->name . '</option>';
				}
			}
			?>
		</select>
		<select class="select-fueltype-parts brator-select-active" id="makecategory" name="category" >
			<option value=""><?php esc_html_e( 'Fuel Type', 'brator-core' ); ?></option>
			<?php
			$make_category = get_terms(
				array(
					'taxonomy'   => 'product_cat',
					'hide_empty' => false,
				)
			);
			foreach ( $make_category as $category ) {
				echo '<option value="' . $category->slug . '">' . $category->name . '</option>';
			}
			?>
		</select>
		<?php } ?>
		<button name="adv_brator_form" type="submit"><?php esc_html_e( 'Add Vehicle', 'brator-core' ); ?></button>
	  </form>
	<?php
	if ( isset( $_POST['adv_brator_form'] ) ) {
		// $_SESSION['makeyear'] = $_POST['makeyear'];
		// $_SESSION['brand']    = $_POST['brand'];
		// $_SESSION['model']    = $_POST['model'];
		// $_SESSION['engine']   = $_POST['engine'];

		$engine = '';
		if ( isset( $_GET['engine'] ) && ! empty( $_GET['engine'] ) ) {
			$engine = $_POST['engine'];
		}

		$_SESSION['vehicle_items'][] = array(
			'makeyear' => $_POST['makeyear'],
			'brand'    => $_POST['brand'],
			'model'    => $_POST['model'],
			'engine'   => $engine,
		);
	}

	if ( ! empty( $_SESSION['vehicle_items'] ) ) {
		?>
		<ul class="vehicle-list">
		<?php foreach ( $_SESSION['vehicle_items'] as $val ) { ?>
			<li><?php echo $val['makeyear'] . ' ' . $val['brand'] . ' ' . $val['model'] . '<span>' . $val['engine'] . '</span>'; ?></li>
		<?php } ?>
			<li id="clearvehicle"><?php esc_html_e( 'Clear History', 'brator-core' ); ?></li>
		</ul>
		<?php
	}
}

// add_action( 'init', 'brator_register_vehicle_end_session' );
function brator_register_vehicle_end_session() {
	if ( session_id() ) {
		session_write_close();
	}
}

add_action( 'wp_ajax_brator_clearvehicle', 'brator_clearvehicle' );
add_action( 'wp_ajax_nopriv_brator_clearvehicle', 'brator_clearvehicle' );
function brator_clearvehicle() {
	unset( $_SESSION['vehicle_items'] );
}

add_shortcode( 'brator_auto_parts_search', 'brator_auto_parts_search_func' );
function brator_auto_parts_search_func() {
	$shop_page_url = get_permalink( wc_get_page_id( 'shop' ) );
	$engine        = brator_core_get_options( 'engine_onof_switch' );
	$fuel_type     = brator_core_get_options( 'fuel_type_onoff_switch' );
	?>
	<form method="get" id="advanced-searchform" class="brator-parts-search-box-form" role="search" action="<?php echo $shop_page_url; ?>">
		<input type="hidden" name="search" value="advanced">
		<select class="select-year-parts brator-select-active" id="makeyear" name="makeyear">
			<option value=""><?php esc_html_e( 'Year', 'brator-core' ); ?></option>
			<?php
			$make_year = get_terms(
				array(
					'taxonomy'   => 'make_year',
					'hide_empty' => false,
				)
			);
			if ( ! empty( $make_year ) ) {
				foreach ( $make_year as $year ) {
					echo '<option value="' . $year->slug . '">' . $year->name . '</option>';
				}
			}
			?>
		</select>
		<select class="select-make-parts brator-select-active" id="makebrand" name="brand" >
			<option value=""><?php esc_html_e( 'Brand', 'brator-core' ); ?></option>
			<?php
				$make_brand = get_terms(
					array(
						'taxonomy'   => 'make_brand',
						'hide_empty' => false,
					)
				);
			if ( ! empty( $make_brand ) ) {
				foreach ( $make_brand as $brand ) {
					echo '<option value="' . $brand->slug . '">' . $brand->name . '</option>';
				}
			}
			?>
		</select>
		<select class="select-model-parts brator-select-active" id="makemodel" name="model" >
			<option value=""><?php esc_html_e( 'Model', 'brator-core' ); ?></option>
			<?php
			$make_model = get_terms(
				array(
					'taxonomy'   => 'make_model',
					'hide_empty' => false,
				)
			);
			if ( ! empty( $make_model ) ) {
				foreach ( $make_model as $model ) {
					echo '<option value="' . $model->slug . '">' . $model->name . '</option>';
				}
			}
			?>
		</select>
		<?php if ( $engine ) { ?>
		<select class="select-engine-parts brator-select-active" id="makeengine" name="engine" >
			<option value=""><?php esc_html_e( 'Engine', 'brator-core' ); ?></option>
			<?php
			$make_engine = get_terms(
				array(
					'taxonomy'   => 'make_engine',
					'hide_empty' => false,
				)
			);
			foreach ( $make_engine as $engine ) {
				echo '<option value="' . $engine->slug . '">' . $engine->name . '</option>';
			}
			?>
		</select>
		<?php } ?>
		<?php if ( $fuel_type ) { ?>
		<select class="select-fueltype-parts brator-select-active" id="makefueltype" name="fueltype" >
			<option value=""><?php esc_html_e( 'Fuel Type', 'brator-core' ); ?></option>
			<?php
			$make_fueltype = get_terms(
				array(
					'taxonomy'   => 'make_fuel_type',
					'hide_empty' => false,
				)
			);
			foreach ( $make_fueltype as $fuel ) {
				echo '<option value="' . $fuel->slug . '">' . $fuel->name . '</option>';
			}
			?>
		</select>
		<?php } ?>
		<select class="select-fueltype-parts brator-select-active" id="makecategory" name="category" >
			<option value=""><?php esc_html_e( 'Select Category', 'brator-core' ); ?></option>
			<?php
			$make_category = get_terms(
				array(
					'taxonomy'   => 'product_cat',
					'hide_empty' => false,
				)
			);
			foreach ( $make_category as $category ) {
				echo '<option value="' . $category->slug . '">' . $category->name . '</option>';
			}
			?>
		</select>
		<input name="product_name" type="text" placeholder="Product name">
		<button type="submit"><?php esc_html_e( 'Search', 'brator-core' ); ?></button>
	  </form>
	<?php
}


add_action( 'wp_ajax_brator_makemodel_name_select', 'brator_makemodel_name_select' );
add_action( 'wp_ajax_nopriv_brator_makemodel_name_select', 'brator_makemodel_name_select' );
function brator_makemodel_name_select() {
	$selected_brand = $_POST['makebrand'];
	$cat_data       = get_term_by( 'slug', $selected_brand, 'make_brand' );
	$get_models     = get_term_meta( $cat_data->term_id, 'brator_core_get_models', false );
	if ( ! empty( $get_models ) ) {
		echo '<option value="">' . esc_html__( 'Select Model', 'brator-core' ) . '</option>';
		foreach ( $get_models as $term ) {
			$term = get_term_by( 'slug', $term, 'make_model' );
			echo '<option value="' . $term->slug . '">' . $term->name . '</option>';
		}
	} else {
		?>
	<option value=""><?php esc_html_e( 'Model Not Found', 'brator-core' ); ?></option>
		<?php
	}
	die();
}


add_action( 'wp_ajax_brator_engine_name_select', 'brator_engine_name_select' );
add_action( 'wp_ajax_nopriv_brator_engine_name_select', 'brator_engine_name_select' );
function brator_engine_name_select() {
	$selected_model = $_POST['makemodel'];
	$cat_data       = get_term_by( 'slug', $selected_model, 'make_model' );
	$get_engines    = get_term_meta( $cat_data->term_id, 'brator_core_get_engines', false );
	if ( ! empty( $get_engines ) ) {
		echo '<option value="">' . esc_html__( 'Select Engine', 'brator-core' ) . '</option>';
		foreach ( $get_engines as $term ) {
			$term = get_term_by( 'slug', $term, 'make_engine' );
			echo '<option value="' . $term->slug . '">' . $term->name . '</option>';
		}
	} else {
		?>
		<option value=""><?php esc_html_e( 'Engine Not Found', 'brator-core' ); ?></option>
		<?php
	}
	die();
}

add_action( 'wp_ajax_brator_fueltype_name_select', 'brator_fueltype_name_select' );
add_action( 'wp_ajax_nopriv_brator_fueltype_name_select', 'brator_fueltype_name_select' );
function brator_fueltype_name_select() {
	$selected_engine = $_POST['engine'];
	$cat_data        = get_term_by( 'slug', $selected_engine, 'make_engine' );
	$get_fueltype    = get_term_meta( $cat_data->term_id, 'brator_core_get_fueltype', false );
	if ( ! empty( $get_fueltype ) ) {
		echo '<option value="">' . esc_html__( 'Select Fuel Type', 'brator-core' ) . '</option>';
		foreach ( $get_fueltype as $term ) {
			$term = get_term_by( 'slug', $term, 'make_fuel_type' );
			echo '<option value="' . $term->slug . '">' . $term->name . '</option>';
		}
	} else {
		?>
	<option value=""><?php esc_html_e( 'Fuel Type Not Found', 'brator-core' ); ?></option>
		<?php
	}
	die();
}

add_filter( 'woocommerce_product_query', 'brator_advanced_search_query' );
function brator_advanced_search_query( $query ) {
	$makeyear = '';
	$brand    = '';
	$model    = '';
	$engine   = '';
	$fueltype = '';
	$tax_query = array();
	if ( isset( $_REQUEST['search'] ) == 'advanced' && ! is_admin() ) {
		if ( $query->query_vars['post_type'] == 'product' ) {
			$query->set( 'post_type', 'product' );

			if ( isset( $_GET['makeyear'] ) && ! empty( $_GET['makeyear'] ) ) {
				$makeyear = array(
					'taxonomy' => 'make_year',
					'terms'    => $_GET['makeyear'],
					'field'    => 'slug',
				);
			}

			if ( isset( $_GET['brand'] ) && ! empty( $_GET['brand'] ) ) {
				$brand = array(
					'taxonomy' => 'make_brand',
					'terms'    => $_GET['brand'],
					'field'    => 'slug',
				);
			}

			if ( isset( $_GET['model'] ) && ! empty( $_GET['model'] ) ) {
				$model = array(
					'taxonomy' => 'make_model',
					'terms'    => $_GET['model'],
					'field'    => 'slug',
				);
			}

			// if ( isset( $_GET['engine'] ) && ! empty( $_GET['engine'] ) ) {
			// 	$engine = array(
			// 		'taxonomy' => 'make_engine',
			// 		'terms'    => $_GET['engine'],
			// 		'field'    => 'slug',
			// 	);
			// }

			// if ( isset( $_GET['fueltype'] ) && ! empty( $_GET['fueltype'] ) ) {
			// 	$fueltype = array(
			// 		'taxonomy' => 'make_fuel_type',
			// 		'terms'    => $_GET['fueltype'],
			// 		'field'    => 'slug',
			// 	);
			// }

			if ( isset( $_GET['category'] ) && ! empty( $_GET['category'] ) ) {
				$producttype = array(
					'taxonomy' => 'product_cat',
					'terms'    => $_GET['category'],
					'field'    => 'slug',
				);
			}
			$flag_cat = 0;
			
			
			if(!empty( $makeyear )){
				$flag_cat = 1;
				$tax_query[] = array('relation' => 'AND',$makeyear);
			}
			if(!empty( $brand )){
				$flag_cat = 1;
				$tax_query[] = array('relation' => 'AND',$brand);
			}
			if(!empty( $model )){
				$flag_cat = 1;
				$tax_query[] = array('relation' => 'AND',$model);
			}
			if(!empty( $producttype )){
				$flag_cat = 1;
				$tax_query[] = array('relation' => 'AND',$producttype);
			}
			if(!empty( $makeyear )){
				$flag_cat = 1;
				$tax_query[] = array('relation' => 'AND',$makeyear);
			}
			if($flag_cat == 1){
				// $tax_query = array(
				// 	'relation' => 'AND',
				// );
			}

			// if ( ! empty( $makeyear ) && ! empty( $brand ) && ! empty( $model )  && !empty($producttype)) {
			// 	$tax_query = array(
			// 		'relation' => 'AND',
			// 		$makeyear,
			// 		$brand,
			// 		$model,
			// 		$engine,
					
			// 		$producttype
			// 	);
			// } elseif ( ! empty( $makeyear ) && ! empty( $brand ) && ! empty( $model ) ) {
			// 	$tax_query = array(
			// 		'relation' => 'AND',
			// 		$makeyear,
			// 		$brand,
			// 		$model,
			// 	);
			// } elseif ( ! empty( $makeyear ) && ! empty( $brand ) && ! empty( $model ) ) {
			// 	$tax_query = array(
			// 		'relation' => 'AND',
			// 		$makeyear,
			// 		$brand,
			// 		$model,
			// 	);
			// } elseif ( ! empty( $makeyear ) && ! empty( $brand ) ) {
			// 	$tax_query = array(
			// 		'relation' => 'AND',
			// 		$makeyear,
			// 		$brand,
			// 	);
			// } elseif ( ! empty( $model ) ) {
			// 	$tax_query = array(
			// 		'relation' => 'AND',
			// 		$model,
			// 	);
			// } elseif ( ! empty( $brand ) ) {
			// 	$tax_query = array(
			// 		'relation' => 'AND',
			// 		$brand,
			// 	);
			// } elseif ( ! empty( $makeyear ) ) {
			// 	$tax_query = array(
			// 		'relation' => 'AND',
			// 		$makeyear,
			// 	);
			// }
			if(!empty($_GET['product_name'])){
				$query->set('s',$_GET['product_name']);
			}
			// echo "<pre>";
			// print_r($tax_query);
			// echo "</pre>";
			if(isset($tax_query) && !empty($tax_query)){
				$query->set( 'tax_query', $tax_query );
			}
			
		}
	}
	remove_filter( 'woocommerce_product_query', 'brator_advanced_search_query' );

}

add_shortcode( 'brator_recently_viewed_products', 'brator_recently_viewed_products_func' );
function brator_recently_viewed_products_func( $atts ) {
	$atts            = shortcode_atts(
		array(
			'style' => '',
			'items' => '5',
		),
		$atts
	);
	$viewed_products = ! empty( $_COOKIE['brator_recently_viewed'] ) ? (array) explode( '|', wp_unslash( $_COOKIE['brator_recently_viewed'] ) ) : array(); // @codingStandardsIgnoreLine
	$viewed_products = array_reverse( array_filter( array_map( 'absint', $viewed_products ) ) );
	if ( ! empty( $viewed_products ) ) {
		?>
		<?php if ( $atts['style'] == '2' ) { ?>
	<div class="brator-plan-pixel-area">
		<div class="container-xxxl container-xxl container">
		<div class="col-12">
			<div class="plan-pixel-area"></div>
		</div>
		</div>
	</div>
	<?php } ?>
<div class="brator-deal-product-slider recently-view woocommerce">
	<div class="container-xxxl container-xxl container">
		<div class="row">
			<div class="col-12">
				<div class="brator-section-header">
					<div class="brator-section-header-title">
						<h2><?php esc_html_e( 'Recent Viewed Product', 'brator-core' ); ?></h2>
					</div>
				</div>
			</div>
			<div class="col-12">
				<div class="brator-product-slider splide js-splide p-splide" data-splide='{"pagination":false,"type":"slide","perPage":5,"perMove":"1","gap":30, "breakpoints":{ "520" :{ "perPage": "1" },"746" :{ "perPage": "2" }, "768" :{ "perPage" : "3" }, "1090":{ "perPage" : "3" }, "1366":{ "perPage" : "4" }, "1500":{ "perPage" : "4" }, "1920":{ "perPage" : <?php echo $atts['items']; ?> }}}'>
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
			<?php

			$args = array(
				'post_status'    => array( 'publish' ),
				'post_type'      => 'product',
				'posts_per_page' => -1,
				'order'          => 'DESC',
				'post__in'       => $viewed_products,
				'orderby'        => 'post__in',
			);

			$query = new WP_Query( $args );

			if ( $query->have_posts() ) :

				while ( $query->have_posts() ) :
					$query->the_post();
					if ( $atts['style'] == '2' ) {
						wc_get_template_part( 'content', 'product-slidetwo' );
					} else {
						wc_get_template_part( 'content', 'product-slide' );
					}
					endwhile;
				else :
					echo '<p>' . esc_html__( 'Product No Found', 'brator-core' ) . '</p>';
					endif;
				wp_reset_postdata();
				?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
		<?php
	}
}

add_filter(
	'woocommerce_product_data_tabs',
	function( $tabs ) {
		$tabs['brator_frequently_bought'] = array(
			'label'    => esc_html__( 'Frequently Bought', 'brator-core' ),
			'target'   => 'additional_product_data',
			'class'    => array( 'hide_if_external' ),
			'priority' => 25,
		);
		return $tabs;
	}
);


add_action(
	'woocommerce_product_data_panels',
	function() {
		global $post;
		?>
		<div id="additional_product_data" class="panel woocommerce_options_panel hidden">
			<?php
			$heading_text = get_post_meta( get_the_ID(), 'brator_fb_heading_text', true );
			woocommerce_wp_text_input(
				array(
					'id'          => 'brator_fb_heading_text',
					'label'       => esc_html__( 'Heading Text', 'brator-core' ),
					'value'       => $heading_text,
					'placeholder' => esc_html__( 'Frequently Bought Together', 'brator-core' ),
				)
			);

			$discount_price = get_post_meta( get_the_ID(), 'brator_fb_discount_price', true );
			woocommerce_wp_text_input(
				array(
					'id'          => 'brator_fb_discount_price',
					'label'       => esc_html__( 'Discount Price', 'brator-core' ),
					'value'       => $discount_price,
					'type'        => 'number',
					'placeholder' => esc_html__( '30', 'brator-core' ),
				)
			);
			?>
			<p class="form-field hide_if_grouped hide_if_external">
				<label for="frequently_bought_ids"><?php esc_html_e( 'Frequently Bought', 'brator-core' ); ?></label>
				<select class="wc-product-search" multiple="multiple" style="width: 50%;" id="frequently_bought_ids" name="frequently_bought_ids[]" data-placeholder="<?php esc_attr_e( 'Search for a product&hellip;', 'brator-core' ); ?>" data-action="woocommerce_json_search_products_and_variations" data-exclude="<?php echo intval( $post->ID ); ?>">
					<?php
					$product_ids = get_post_meta( get_the_ID(), 'frequently_bought_ids', true );
					if ( ! empty( $product_ids ) ) {
						foreach ( $product_ids as $product_id ) {
							$product = wc_get_product( $product_id );
							if ( is_object( $product ) ) {
								echo '<option value="' . esc_attr( $product_id ) . '"' . selected( true, true, false ) . '>' . esc_html( wp_strip_all_tags( $product->get_formatted_name() ) ) . '</option>';
							}
						}
					}
					?>
				</select> <?php echo wc_help_tip( __( 'Frequently Bought are products which you promote in the cart, based on the current product.', 'brator-core' ) ); // WPCS: XSS ok. ?>
			</p>
		</div>
		<?php
	}
);

add_action(
	'woocommerce_process_product_meta',
	function( $post_id ) {
		$product = wc_get_product( $post_id );
		$product->update_meta_data( 'brator_fb_heading_text', sanitize_text_field( $_POST['brator_fb_heading_text'] ) );
		$product->update_meta_data( 'brator_fb_discount_price', sanitize_text_field( $_POST['brator_fb_discount_price'] ) );
		$product->update_meta_data( 'frequently_bought_ids', $_POST['frequently_bought_ids'] );
		$product->save();
	}
);

function brator_track_product_view() {
	if ( ! is_singular( 'product' ) ) {
		return;
	}

	global $post;

	if ( empty( $_COOKIE['brator_recently_viewed'] ) ) { // @codingStandardsIgnoreLine.
		$viewed_products = array();
	} else {
		$viewed_products = wp_parse_id_list( (array) explode( '|', wp_unslash( $_COOKIE['brator_recently_viewed'] ) ) ); // @codingStandardsIgnoreLine.
	}

	// Unset if already in viewed products list.
	$keys = array_flip( $viewed_products );

	if ( isset( $keys[ $post->ID ] ) ) {
		unset( $viewed_products[ $keys[ $post->ID ] ] );
	}

	$viewed_products[] = $post->ID;

	if ( count( $viewed_products ) > 15 ) {
		array_shift( $viewed_products );
	}

	// Store for session only.
	wc_setcookie( 'brator_recently_viewed', implode( '|', $viewed_products ) );
}

add_action( 'template_redirect', 'brator_track_product_view', 20 );
