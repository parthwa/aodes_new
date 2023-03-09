<?php
namespace Brator\Helper;

/**
 * The admin class
 */
class Elementor {

	/**
	 * Initialize the class
	 */
	function __construct() {
		new Elementor\Element();
		new Elementor\Icon();
		new Elementor\Scripts();
	}
}
