<?php
namespace Brator\Helper\Elementor;

/**
 * The Menu handler class
 */

class Scripts {

	public function __construct() {
		add_action( 'elementor/frontend/after_register_scripts', array( $this, 'brator_core_required_script' ) );
		add_action( 'wp_head', array( $this, 'widget_assets_css' ) );
		add_action( 'wp_footer', array( $this, 'widget_scripts' ) );
		add_action( 'elementor/editor/after_enqueue_scripts', array( $this, 'widget_editor_scripts' ) );
	}

	public function brator_core_required_script() {
		wp_enqueue_script( 'brator-edit-items-carousel', BRATOR_CORE_ASSETS . '/elementor/js/items-carousel.js', array( 'jquery' ), time(), true );
	}
	public function widget_assets_css() {
		// wp_enqueue_style( 'elementor-custom-style', BRATOR_CORE_ASSETS . '/elementor/css/style.css', true );
	}

	public function widget_scripts() {
		wp_enqueue_script( 'brator-edit-splide', BRATOR_CORE_ASSETS . '/elementor/js/splide.min.js', array( 'jquery' ), time(), true );
	}

	public function widget_editor_scripts() {

	}
}
