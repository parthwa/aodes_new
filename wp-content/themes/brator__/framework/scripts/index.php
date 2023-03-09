<?php
class Brator_Scripts {

	public function __construct() {
		add_action( 'wp_enqueue_scripts', array( $this, 'brator_enqueue_scripts' ) );
	}
	public function brator_enqueue_scripts() {
		wp_enqueue_script( 'waypoints', BRATOR_JS_URL . 'waypoints.min.js', array( 'jquery' ), time(), true );
		wp_enqueue_script( 'counterup', BRATOR_JS_URL . 'counterup.min.js', array( 'jquery' ), time(), true );
		wp_enqueue_script( 'nouislider', BRATOR_JS_URL . 'nouislider.js', array( 'jquery' ), time(), true );
		wp_enqueue_script( 'splide', BRATOR_JS_URL . 'splide.min.js', array( 'jquery' ), time(), true );
		wp_enqueue_script( 'tab', BRATOR_JS_URL . 'tab.js', array( 'jquery' ), time(), true );
		wp_enqueue_script( 'gsap-core', BRATOR_JS_URL . 'gsap-core.js', array( 'jquery' ), time(), true );
		wp_enqueue_script( 'scroll-trigger', BRATOR_JS_URL . 'scroll-trigger.js', array( 'jquery' ), time(), true );
		wp_enqueue_script( 'addindicators', BRATOR_JS_URL . 'addIndicators.js', array( 'jquery' ), time(), true );
		wp_enqueue_script( 'animation-gsap', BRATOR_JS_URL . 'animation.gsap.js', array( 'jquery' ), time(), true );
		wp_enqueue_script( 'lazysizes', BRATOR_JS_URL . 'lazysizes.min.js', array( 'jquery' ), time(), true );
		wp_enqueue_script( 'ls-bgset', BRATOR_JS_URL . 'ls.bgset.min.js', array( 'jquery' ), time(), true );
		wp_enqueue_script( 'select2', BRATOR_JS_URL . 'select2.min.js', array( 'jquery' ), time(), true );
		wp_enqueue_script( 'brator-script', BRATOR_JS_URL . 'brator-script.js', array( 'jquery' ), time(), true );

		$loading   = esc_html__( 'Loading...', 'brator' );
		$no_result = esc_html__( 'No Result Found.', 'brator' );
		wp_localize_script(
			'brator-script',
			'brator_ajax_localize',
			array(
				'ajax_url'                            => admin_url( 'admin-ajax.php' ),
				'loading'                             => $loading,
				'no_result'                           => $no_result,
				'woocommerce_cart_redirect_after_add' => get_option( 'woocommerce_cart_redirect_after_add' ),
			)
		);

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
}
$brator_scripts = new Brator_Scripts();
