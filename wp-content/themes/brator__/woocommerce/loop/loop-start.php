<?php
/**
 * Product Loop Start
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-start.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$shop_layout = get_query_var( 'shop_layout' );
if ( ! $shop_layout ) {
	$shop_layout = brator_get_options( 'shop_layout' );
}
if($shop_layout == 'list'){
	$class = 'type-list';
}else{
	$class = '';
}
?>
<div class="products columns-<?php echo esc_attr( wc_get_loop_prop( 'columns' ) ); ?>">
<div class="product-list-items <?php echo esc_attr($class);?>">