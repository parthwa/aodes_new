<?php
class Brator_Act {
	public function __construct() {
		$this->brator_register_action();
	}
	private function brator_register_action() {
		add_action( 'brator_preloader', array( 'Brator_Int', 'brator_preloader' ) );
		add_action( 'brator_back_to_top', array( 'Brator_Int', 'brator_back_to_top' ) );
		add_action( 'brator_header_logo', array( 'Brator_Int', 'brator_header_logo' ) );
		add_action( 'brator_header_logo_white', array( 'Brator_Int', 'brator_header_logo_white' ) );
		add_action( 'brator_header_menu', array( 'Brator_Int', 'brator_header_menu' ) );
		add_action( 'brator_breadcrumb', array( 'Brator_Int', 'brator_breadcrumb' ) );
		add_action( 'brator_authore_box', array( 'Brator_Int', 'brator_authore_box' ) );
		add_action( 'brator_posts_nav', array( 'Brator_Int', 'brator_posts_nav' ) );
		add_action( 'brator_related_posts', array( 'Brator_Int', 'brator_related_posts' ) );
		add_action( 'brator_related_products', array( 'Brator_Int', 'brator_related_products' ) );
		add_action( 'brator_product_page_posts', array( 'Brator_Int', 'brator_product_page_posts' ) );
		add_filter( 'wp_kses_allowed_html', array( 'Brator_Int', 'brator_kses_allowed_html' ), 10, 2 );
	}
}
$brator_act = new Brator_Act();
