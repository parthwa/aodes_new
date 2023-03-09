jQuery(document).ready(function () {
	jQuery('#woocommerce_flexible_shipping_fedex_fallback').change(function(){
		if ( jQuery(this).is(':checked') && jQuery(this).is(':visible') ) {
			jQuery('#woocommerce_flexible_shipping_fedex_fallback_cost').closest('tr').show();
			jQuery('#woocommerce_flexible_shipping_fedex_fallback_cost').attr('required',true);
		}
		else {
			jQuery('#woocommerce_flexible_shipping_fedex_fallback_cost').closest('tr').hide();
			jQuery('#woocommerce_flexible_shipping_fedex_fallback_cost').attr('required',false);
		}
	});
	if ( jQuery('#woocommerce_flexible_shipping_fedex_fallback').length ) {
		jQuery('#woocommerce_flexible_shipping_fedex_fallback').change();
	}
});
