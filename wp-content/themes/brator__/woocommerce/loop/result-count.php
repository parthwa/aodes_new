<?php
/**
 * Result Count
 *
 * Shows text: Showing x - x of x results.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/result-count.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.7.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="brator-filter-show-result">
<p class="woocommerce-result-count">
	<?php
	// phpcs:disable WordPress.Security
	if ( 1 === intval( $total ) ) {
		_e( 'The single result', 'brator' );
	} elseif ( $total <= $per_page || -1 === $per_page ) {
		/* translators: %d: total results */
		printf( _n( '<span>Total %d </span>result', '<span> Total %d</span>results', $total, 'brator' ), $total );
	} else {
		$first = ( $per_page * $current ) - $per_page + 1;
		$last  = min( $total, $per_page * $current );
		/* translators: 1: first result 2: last result 3: total results */
		printf( _nx( '<span> %1$d &ndash; %2$d </span> of %3$d result', '<span> %1$d &ndash; %2$d </span> of %3$d results', $total, 'with first and last result', 'brator' ), $first, $last, $total );
	}
	// phpcs:enable WordPress.Security
	?>
</p>
</div>

<?php
$theme_base_css = brator_get_options( 'theme_base_css' );
if ( $theme_base_css != '' ) {
	if ( $total > $per_page ) {
		?>
<div class="brator-filter-show-items">
	<p><?php esc_html_e( 'Show item', 'brator' ); ?></p>
	<div class="brator-filter-show-items-count">
		<a class="current" href="javascript:void(0)" data-count="<?php echo esc_attr( $last ); ?>"><?php echo esc_html( $last ); ?></a><a href="javascript:void(0)" data-count="<?php echo esc_attr( $total ); ?>"><?php echo esc_html( $total ); ?></a>
	</div>
</div>
	<?php } ?>
<?php } ?>
