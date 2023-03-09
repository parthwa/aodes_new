<?php
namespace Brator\Helper\Admin\Metabox;

use Brator\Helper\Posttype\ProductTexonomy;

class Metabox {

		/**
		 * Initialize the class
		 */
	function __construct() {
		// Register the post type
		// if ( class_exists( 'ProductTexonomy' ) ) {
			add_filter( 'rwmb_meta_boxes', array( $this, 'brator_register_framework_product_meta_box' ) );
		// }
	}

		/**
		 * Register meta boxes
		 *
		 * Remember to change "your_prefix" to actual prefix in your project
		 *
		 * @return void
		 */
	function brator_register_framework_product_meta_box( $meta_boxes ) {

		$classA = new ProductTexonomy();
		if ( function_exists( 'brator_core_get_options' ) ) {
			$demo_select = brator_core_get_options( 'demo_select' );
			if ( $demo_select != 'electro' ) {

				$prefix     = 'brator_core';
				$posts_page = get_option( 'page_for_posts' );

				$meta_boxes[] = array(
					'title'      => esc_html__( 'Select Models For This Brand', 'brator-core' ),
					'taxonomies' => 'make_brand',
					'fields'     => array(
						array(
							'name'            => esc_html__( 'Models', 'brator-core' ),
							'id'              => "{$prefix}_get_models",
							'type'            => 'select_advanced',
							'options'         => $classA->get_all_models(),
							'multiple'        => true,
							'placeholder'     => esc_html__( 'Select Models', 'brator-core' ),
							'select_all_none' => true,
						),
					),
				);
				$meta_boxes[] = array(
					'title'      => esc_html__( 'Select Engines For This Model', 'brator-core' ),
					'taxonomies' => 'make_model',
					'fields'     => array(
						array(
							'name'            => esc_html__( 'Engines', 'brator-core' ),
							'id'              => "{$prefix}_get_engines",
							'type'            => 'select_advanced',
							'options'         => $classA->get_all_engines(),
							'multiple'        => true,
							'placeholder'     => esc_html__( 'Select Engines', 'brator-core' ),
							'select_all_none' => true,
						),
					),
				);
				$meta_boxes[] = array(
					'title'      => esc_html__( 'Select Fuel Type For This Engine', 'brator-core' ),
					'taxonomies' => 'make_engine',
					'fields'     => array(
						array(
							'name'            => esc_html__( 'Fuel Type', 'brator-core' ),
							'id'              => "{$prefix}_get_fueltype",
							'type'            => 'select_advanced',
							'options'         => $classA->get_all_fuel_type(),
							'multiple'        => true,
							'placeholder'     => esc_html__( 'Select Fuel Type', 'brator-core' ),
							'select_all_none' => true,
						),
					),
				);
			}
		}

		return $meta_boxes;

	}

}

