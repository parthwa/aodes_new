<?php
class Brator_Style {
	public function __construct() {
		add_action( 'wp_enqueue_scripts', array( $this, 'brator_enqueue_style' ) );
	}
	public function brator_enqueue_style() {
		wp_enqueue_style( 'bootstrap-grid', BRATOR_CSS_URL . 'bootstrap-grid.min.css', false, time() );
		wp_enqueue_style( 'nouislider', BRATOR_CSS_URL . 'nouislider.css', false, time() );
		wp_enqueue_style( 'splide', BRATOR_CSS_URL . 'splide.min.css', false, time() );
		wp_enqueue_style( 'splide-core', BRATOR_CSS_URL . 'splide-core.min.css', array( 'splide' ), time() );
		wp_enqueue_style( 'select2', BRATOR_CSS_URL . 'select2.min.css', false, time() );
		wp_enqueue_style( 'brator-url', BRATOR_CSS_URL . 'url.css', false, time() );
		wp_enqueue_style( 'brator-theme-style', BRATOR_CSS_URL . 'theme-style.css', false, time() );
		wp_enqueue_style( 'brator-theme-style-home-one', BRATOR_CSS_URL . 'theme-style-home-one.css', false, time() );
		wp_enqueue_style( 'brator-unittest-style', BRATOR_CSS_URL . 'unittest-style.css', false, time() );
		wp_enqueue_style( 'brator-style', get_stylesheet_uri(), null, time() );

		if ( function_exists( 'brator_daynamic_styles' ) ) {
			wp_add_inline_style( 'brator-style', brator_daynamic_styles() );
		}

		if ( function_exists( 'brator_get_custom_color' ) ) {
			wp_add_inline_style( 'brator-style', brator_get_custom_color() );
		}
		wp_enqueue_style( 'brator-electronics-style', BRATOR_CSS_URL . 'sass/electronics/electronics-theme.css', false, time() );
	}
}
$brator_style = new Brator_Style();
