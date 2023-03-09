<?php
namespace Brator\Helper;

class Widgets {

	/**
	 * Initialize the class
	 */
	function __construct() {
		// Register the post type
		add_action( 'widgets_init', array( $this, 'widgets_registered' ) );
	}

	public function widgets_registered() {
		register_widget( new Widgets\Recent_Posts() );
		if ( class_exists( 'woocommerce' ) ) {
			register_widget( new Widgets\Brator_Widget_Layered_Nav() );
		}
	}
}
