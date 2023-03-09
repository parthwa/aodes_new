<?php
namespace Brator\Helper\Posttype;

class ProductTexonomy {


		/**
		 * Initialize the class
		 */
	function __construct() {

		// add_action( 'woocommerce_init', array( $this, 'make_year_func' ), 0 );
		// add_action( 'woocommerce_init', array( $this, 'make_brand_func' ), 0 );
		// add_action( 'woocommerce_init', array( $this, 'make_model_func' ), 0 );
		// add_action( 'woocommerce_init', array( $this, 'make_engine_func' ), 0 );
		// add_action( 'woocommerce_init', array( $this, 'make_fuel_type_func' ), 0 );
		add_action( 'woocommerce_init', array( $this, 'make_fuel_type_func' ), 0 );
		add_action( 'woocommerce_init', array( $this, 'make_engine_func' ), 0 );
		add_action( 'woocommerce_init', array( $this, 'make_model_func' ), 0 );
		add_action( 'woocommerce_init', array( $this, 'make_brand_func' ), 0 );
		add_action( 'woocommerce_init', array( $this, 'make_year_func' ), 0 );

	}

	function make_fuel_type_func() {
		$labels = array(
			'name'                       => _x( 'Fuel Type', 'taxonomy general name', 'brator-core' ),
			'singular_name'              => _x( 'Fuel Type', 'taxonomy singular name', 'brator-core' ),
			'search_items'               => __( 'Search Fuel Type', 'brator-core' ),
			'all_items'                  => __( 'All Fuel Type', 'brator-core' ),
			'parent_item'                => __( 'Parent Fuel Type', 'brator-core' ),
			'parent_item_colon'          => __( 'Parent Fuel Type:', 'brator-core' ),
			'edit_item'                  => __( 'Edit Fuel Type', 'brator-core' ),
			'update_item'                => __( 'Update Fuel Type', 'brator-core' ),
			'add_new_item'               => __( 'Add New Fuel Type', 'brator-core' ),
			'new_item_name'              => __( 'New Fuel Type', 'brator-core' ),
			'menu_name'                  => __( 'Fuel Type', 'brator-core' ),
			'separate_items_with_commas' => __( 'Separate fuel type with commas', 'brator-core' ),
			'not_found'                  => __( 'No fuel types found.', 'brator-core' ),
		);
		$args   = array(
			'show_in_rest'      => true,
			'hierarchical'      => false,
			'labels'            => $labels,
			'show_ui'           => false,
			'show_admin_column' => false,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'product-fuel-type' ),
		);
		if ( function_exists( 'brator_core_get_options' ) ) {
			$demo_select = brator_core_get_options( 'demo_select' );
			if ( $demo_select != 'electro' ) {
				register_taxonomy( 'make_fuel_type', array( 'product' ), $args );
			}
		}
	}

	function make_engine_func() {
		$labels = array(
			'name'                       => _x( 'Engines', 'taxonomy general name', 'brator-core' ),
			'singular_name'              => _x( 'Engine', 'taxonomy singular name', 'brator-core' ),
			'search_items'               => __( 'Search Engine', 'brator-core' ),
			'all_items'                  => __( 'All Engine', 'brator-core' ),
			'parent_item'                => __( 'Parent Engine', 'brator-core' ),
			'parent_item_colon'          => __( 'Parent Engine:', 'brator-core' ),
			'edit_item'                  => __( 'Edit Engine', 'brator-core' ),
			'update_item'                => __( 'Update Engine', 'brator-core' ),
			'add_new_item'               => __( 'Add New Engine', 'brator-core' ),
			'new_item_name'              => __( 'New Engine', 'brator-core' ),
			'menu_name'                  => __( 'Engines', 'brator-core' ),
			'separate_items_with_commas' => __( 'Separate engine with commas', 'brator-core' ),
			'not_found'                  => __( 'No engines found.', 'brator-core' ),
		);
		$args   = array(
			'hierarchical'      => false,
			'labels'            => $labels,
			'show_ui'           => false,
			'show_admin_column' => false,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'product-engine' ),
		);
		if ( function_exists( 'brator_core_get_options' ) ) {
			$demo_select = brator_core_get_options( 'demo_select' );
			if ( $demo_select != 'electro' ) {
				register_taxonomy( 'make_engine', array( 'product' ), $args );
			}
		}
	}

	function make_model_func() {
		$labels = array(
			'name'                       => _x( 'Models', 'taxonomy general name', 'brator-core' ),
			'singular_name'              => _x( 'Model', 'taxonomy singular name', 'brator-core' ),
			'search_items'               => __( 'Search Model', 'brator-core' ),
			'all_items'                  => __( 'All Model', 'brator-core' ),
			'parent_item'                => __( 'Parent Model', 'brator-core' ),
			'parent_item_colon'          => __( 'Parent Model:', 'brator-core' ),
			'edit_item'                  => __( 'Edit Model', 'brator-core' ),
			'update_item'                => __( 'Update Model', 'brator-core' ),
			'add_new_item'               => __( 'Add New Model', 'brator-core' ),
			'new_item_name'              => __( 'New Model', 'brator-core' ),
			'menu_name'                  => __( 'Models', 'brator-core' ),
			'separate_items_with_commas' => __( 'Separate model with commas', 'brator-core' ),
			'not_found'                  => __( 'No models found.', 'brator-core' ),
		);
		$args   = array(
			'show_in_rest'      => true,
			'hierarchical'      => false,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => false,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'product-model' ),
		);
		if ( function_exists( 'brator_core_get_options' ) ) {
			$demo_select = brator_core_get_options( 'demo_select' );
			if ( $demo_select != 'electro' ) {
				register_taxonomy( 'make_model', array( 'product' ), $args );
			}
		}
	}

	public function make_brand_func() {
		$labels = array(
			'name'                       => _x( 'Brands', 'taxonomy general name', 'brator-core' ),
			'singular_name'              => _x( 'Brand', 'taxonomy singular name', 'brator-core' ),
			'search_items'               => __( 'Search Brand', 'brator-core' ),
			'all_items'                  => __( 'All Brand', 'brator-core' ),
			'parent_item'                => __( 'Parent Brand', 'brator-core' ),
			'parent_item_colon'          => __( 'Parent Brand:', 'brator-core' ),
			'edit_item'                  => __( 'Edit Brand', 'brator-core' ),
			'update_item'                => __( 'Update Brand', 'brator-core' ),
			'add_new_item'               => __( 'Add New Brand', 'brator-core' ),
			'new_item_name'              => __( 'New Brand', 'brator-core' ),
			'menu_name'                  => __( 'Brands', 'brator-core' ),
			'separate_items_with_commas' => __( 'Separate brand with commas', 'brator-core' ),
			'not_found'                  => __( 'No brands found.', 'brator-core' ),
		);
		$args   = array(
			'show_in_rest'      => true,
			'hierarchical'      => false,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => false,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'product-brand' ),
		);
		if ( function_exists( 'brator_core_get_options' ) ) {
			$demo_select = brator_core_get_options( 'demo_select' );
			if ( $demo_select != 'electro' ) {
				register_taxonomy( 'make_brand', array( 'product' ), $args );
			}
		}
	}

	function make_year_func() {
		$labels = array(
			'name'                       => _x( 'Years', 'taxonomy general name', 'brator-core' ),
			'singular_name'              => _x( 'Year', 'taxonomy singular name', 'brator-core' ),
			'search_items'               => __( 'Search Year', 'brator-core' ),
			'all_items'                  => __( 'All Year', 'brator-core' ),
			'parent_item'                => __( 'Parent Year', 'brator-core' ),
			'parent_item_colon'          => __( 'Parent Year:', 'brator-core' ),
			'edit_item'                  => __( 'Edit Year', 'brator-core' ),
			'update_item'                => __( 'Update Year', 'brator-core' ),
			'add_new_item'               => __( 'Add New Year', 'brator-core' ),
			'new_item_name'              => __( 'New Year', 'brator-core' ),
			'menu_name'                  => __( 'Years', 'brator-core' ),
			'separate_items_with_commas' => __( 'Separate year with commas', 'brator-core' ),
			'not_found'                  => __( 'No years found.', 'brator-core' ),
		);
		$args   = array(
			'show_in_rest'          => true,
			'hierarchical'          => false,
			'public'                => true,
			'labels'                => $labels,
			'show_ui'               => true,
			'show_admin_column'     => false,
			'update_count_callback' => '_update_post_term_count',
			'query_var'             => true,
			'rewrite'               => array( 'slug' => 'product-year' ),
		);
		if ( function_exists( 'brator_core_get_options' ) ) {
			$demo_select = brator_core_get_options( 'demo_select' );
			if ( $demo_select != 'electro' ) {
				register_taxonomy( 'make_year', array( 'product' ), $args );
			}
		}

	}

	public function get_all_models() {
		$models = array();
		$terms  = get_terms(
			array(
				'taxonomy'   => 'make_model',
				'hide_empty' => false,
			)
		);

		if ( ! empty( $terms ) ) {
			foreach ( $terms as $term ) {
				$models[ $term->slug ] = $term->name;
			}
		}
		return $models;
	}
	public function get_all_engines() {
		$engines = array();
		$terms   = get_terms(
			array(
				'taxonomy'   => 'make_engine',
				'hide_empty' => false,
			)
		);

		if ( ! empty( $terms ) ) {
			foreach ( $terms as $term ) {
				$engines[ $term->slug ] = $term->name;
			}
		}
		return $engines;
	}

	public function get_all_fuel_type() {
		$fuel_type = array();
		$terms     = get_terms(
			array(
				'taxonomy'   => 'make_fuel_type',
				'hide_empty' => false,
			)
		);

		if ( ! empty( $terms ) ) {
			foreach ( $terms as $term ) {
				$fuel_type[ $term->slug ] = $term->name;
			}
		}
		return $fuel_type;
	}

}

