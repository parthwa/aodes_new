<?php
/**
 * Plugin Name: UPS Live Rates and Access Points
 * Plugin URI: https://wordpress.org/plugins/flexible-shipping-ups/
 * Description: UPS WooCommerce shipping methods with real-time calculated shipping rates based on the established UPS API connection.
 * Version: 1.20.1
 * Author: Octolize
 * Author URI: https://octol.io/ups-author
 * Text Domain: flexible-shipping-ups
 * Domain Path: /lang/
 * Requires at least: 5.7
 * Tested up to: 6.1
 * WC requires at least: 6.7
 * WC tested up to: 7.1
 * Requires PHP: 7.2
 *
 * Copyright 2017 WP Desk Ltd.
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 *
 * @package Flexible_Shipping_UPS
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

$_dummy_plugin_name = __( 'UPS Live Rates and Access Points', 'flexible-shipping-ups' );
$dummy_plugin_description = __( 'UPS WooCommerce shipping methods with real-time calculated shipping rates based on the established UPS API connection.', 'flexible-shipping-ups' );


/* THIS VARIABLE CAN BE CHANGED AUTOMATICALLY */
$plugin_version = '1.20.1';

$plugin_name        = 'Flexible Shipping UPS';
$plugin_class_name  = '\WPDesk\FlexibleShippingUps\Plugin';
$plugin_text_domain = 'flexible-shipping-ups';
$product_id         = 'Flexible Shipping UPS';
$plugin_file        = __FILE__;
$plugin_dir         = dirname( __FILE__ );

define( 'FLEXIBLE_SHIPPING_UPS_VERSION', $plugin_version );
define( $plugin_class_name, $plugin_version );

$requirements = array(
	'php'     => '5.5',
	'wp'      => '4.5',
	'plugins' => array(
		array(
			'name'      => 'woocommerce/woocommerce.php',
			'nice_name' => 'WooCommerce',
		),
	),
);

require __DIR__ . '/vendor_prefixed/wpdesk/wp-plugin-flow-common/src/plugin-init-php52-free.php';

require_once __DIR__ . '/vendor_prefixed/guzzlehttp/guzzle/src/functions_include.php';
require_once __DIR__ . '/vendor_prefixed/guzzlehttp/promises/src/functions_include.php';
require_once __DIR__ . '/vendor_prefixed/guzzlehttp/psr7/src/functions_include.php';
