<?php
namespace Brator\Helper;

/**
 * The admin class
 */
class Admin {

	/**
	 * Initialize the class
	 */
	
	function __construct() {
		new Admin\Metabox\Metabox();
	}
}
