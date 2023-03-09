<?php
/**
 * Plugin Name: Infinite Notification
 * Plugin URI: https://smartdatasoft.com/infinite-notification
 * Description: Sales Notification Plugin
 * Author: SmartDataSoft
 * Version: 1.0.2
 * Author URI: https://smartdatasoft.com/
 * Text Domain: infinite-notification
 * Domain Path: /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'INFINITE_NOTIFICATION_VERSION', '1.0.2' );
define( 'INFINITE_NOTIFICATION_CORE_URL', plugin_dir_url( __FILE__ ) );
define( 'INFINITE_NOTIFICATION_PLUGIN_ROOT', __FILE__ );
define( 'INFINITE_NOTIFICATION_PLUGIN_DIR', __DIR__ );
define( 'INFINITE_NOTIFICATION_PLUGIN_URL', plugins_url( '/', INFINITE_NOTIFICATION_PLUGIN_ROOT ) );
define( 'INFINITE_NOTIFICATION_PLUGIN_PATH', plugin_dir_path( INFINITE_NOTIFICATION_PLUGIN_ROOT ) );
define( 'INFINITE_NOTIFICATION_PLUGIN_BASE', plugin_basename( INFINITE_NOTIFICATION_PLUGIN_ROOT ) );
define( 'INFINITE_NOTIFICATION_CORE_ASSETS', INFINITE_NOTIFICATION_CORE_URL );

require_once INFINITE_NOTIFICATION_PLUGIN_DIR . '/include/settings.php';

$notification_switch = get_option( 'notification-switch' );
if ( isset( $notification_switch ) && $notification_switch == '1' ) {

	require_once INFINITE_NOTIFICATION_PLUGIN_DIR . '/include/functions.php';
	add_action( 'wp_enqueue_scripts', 'infinite_notification_assets_scripts' );

}


function infinite_notification_assets_scripts() {
	wp_enqueue_style( 'infinite-notification-style', INFINITE_NOTIFICATION_PLUGIN_URL . 'assets/css/infinite-nitification.css', '', time(), false );
	wp_enqueue_script( 'infinite-notification-js', INFINITE_NOTIFICATION_PLUGIN_URL . 'assets/js/infinite-nitification.min.js', array( 'jquery' ), time(), true );
}


