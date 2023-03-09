<?php
/**
 * Plugin Name: USPS Simple Shipping for Woocommerce
 * Plugin URI: http://wordpress.org/plugins/woo-usps-simple-shipping
 * Description: The USPS Simple plugin calculates rates for domestic shipping dynamically using USPS API during checkout.
 * Version: 1.7.3
 * Author: dangoodman
 * Requires PHP: 7.2
 * Requires at least: 4.0
 * Tested up to: 6.1
 * WC requires at least: 2.6
 * WC tested up to: 7.0
 */

if (!class_exists('Dgm_UspsSimple_Vendors_DgmWpPluginBootstrapGuard', false)) {
    require_once(__DIR__ .'/vendor/dangoodman/wp-plugin-bootstrap-guard/DgmWpPluginBootstrapGuard.php');
}

Dgm_UspsSimple_Vendors_DgmWpPluginBootstrapGuard::checkPrerequisitesAndBootstrap(
    'USPS Simple Shipping for Woocommerce', '7.2', '4.0', '2.6', __DIR__ .'/bootstrap.php', ['SimpleXML', 'libxml']);
