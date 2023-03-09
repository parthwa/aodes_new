<?php
/**
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.8.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Filter tabs and allow third parties to add their own.
 *
 * Each tab is an array containing title, callback and priority.
 *
 * @see woocommerce_default_product_tabs()
 */
$product_tabs = apply_filters( 'woocommerce_product_tabs', array() );

$product_layout = brator_get_product_options();
if($product_layout == '2'){
	$style_class = 'side-tabbar';
}else{
	$style_class = '';
}

if ( ! empty( $product_tabs ) ) : ?>
<div class="brator-product-single-tab-list js-tabs <?php echo esc_attr($style_class);?>" id="tabs-product-content">
		<div class="brator-product-single-tab-header js-tabs__header">
			<ul> 
				<?php
				foreach ( $product_tabs as $key => $product_tab ) :
					?>
					<li><a class="js-tabs__title" href="#"><?php echo wp_kses_post( apply_filters( 'woocommerce_product_' . $key . '_tab_title', $product_tab['title'], $key ) ); ?></a></li>
				<?php endforeach; ?>
			</ul>
		</div>
		<?php
		foreach ( $product_tabs as $key => $product_tab ) :
			?>
			<div class="js-tabs__content brator-product-single-tab-item">
				<?php
				if ( isset( $product_tab['callback'] ) ) {
					call_user_func( $product_tab['callback'], $key, $product_tab );
				}
				?>
			</div>
		<?php endforeach; ?>

		<?php do_action( 'woocommerce_product_after_tabs' ); ?>

	</div>
<?php endif; ?>
