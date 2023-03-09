﻿=== USPS Simple Shipping for Woocommerce ===
Contributors: dangoodman
Tags: USPS, WooCommerce USPS Shipping, Live USPS rates
Requires PHP: 7.2
Requires at least: 4.0
Tested up to: 6.1
WC requires at least: 2.6
WC tested up to: 7.0


The USPS Simple plugin calculates rates for domestic shipping dynamically using USPS API during cart/checkout.


== Description ==

The USPS Simple plugin adds a new delivery option to WooCommerce - US postal service. Each item is packed individually, then items' delivery prices are summed up. Regular-sized items can be grouped by their weight. The USPS API is used for the delivery price calculation. USPS Simple allows to calculate rates for domestic shipping only. WooCommerce currency must be set to US dollars and base country/region must be the USA.

= USPS Simple supports the following services: =
<ul>
<li>Priority Mail Express</li>
<li>Priority Mail Express, Hold for Pickup</li>
<li>Priority Mail Express, Sunday/Holiday</li>
<li>Priority Mail</li>
<li>Priority Mail, Hold For Pickup</li>
<li>Priority Mail Keys and IDs</li>
<li>Priority Mail Regional Rate Box A</li>
<li>Priority Mail Regional Rate Box A, Hold For Pickup</li>
<li>Priority Mail Regional Rate Box B</li>
<li>Priority Mail Regional Rate Box B, Hold For Pickup</li>
<li>First-Class Mail Parcel</li>
<li>First-Class Postcard Stamped</li>
<li>First-Class Large Postcards</li>
<li>First-Class Keys and IDs</li>
<li>First-Class Package Service – Retail</li>
<li>First-Class Package Service</li>
<li>First-Class Package Service, Hold For Pickup</li>
<li>First-Class Mail Metered Letter</li>
<li>USPS Retail Ground</li>
<li>Media Mail Parcel</li>
<li>Library Mail Parcel</li>
</ul>


== Installation ==

1. Upload the plugin folder to the '/wp-content/plugins/' directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Now you need configure the plugin: Enter your postcode and check option "Enable this shipping method". You can use the default User ID or enter yours.


== Screenshots ==

1. Configuration
2. Cart


== Changelog ==

= 1.7.3 =
* Tested with WooCommerce 7.0, WordPress 6.1.

= 1.7.2 =
* Tested with WooCommerce 6.9.

= 1.7.1 =
* Fix an error when item quantity is fractional.

= 1.7.0 =
* Workaround a USPS API error for items less than 0.25 inch.
* Check shipped items dimensions against the First-Class Mail size constraints (if 'Quote regular items by weight' is disabled).
* Avoid an additional call to the USPS API if Retail Ground is disabled.
* Fill the shipping origin postcode from Store Address by default.
* Enable the plugin upon install.
* Remove the '(USPS Simple)' delivery option label suffix.
* Require PHP 7.2+.
* Tested with WooCommerce 6.7.

= 1.6.2 =
* Tested with WooCommerce 6.5, WordPress 6.0.

= 1.6.1 =
* Tested with WooCommerce 6.3.

= 1.6.0 =
* Add the 'First-Class Package Service – Retail' service.
* Small backend cosmetic changes.

= 1.5.7 =
* Avoid 'Non-numeric value encountered' PHP warnings on missing product dimensions or weight.
* Tested with WordPress 5.9, WooCommerce 6.1.

= 1.5.6 =
* Replace the default USPS API user id to fix the authorization issue.
* Tested with WooCommerce 5.6.
* Fix the debug info drawer won't expand after cart update.

= 1.5.5 =
* Tested with WooCommerce 5.6.

= 1.5.4 =
* Tested with WordPress 5.8, WooCommerce 5.5.

= 1.5.3 =
* Tested with WooCommerce 5.3.

= 1.5.2 =
* Tested with WooCommerce 5.1, WordPress 5.7.

= 1.5.1 =
* Reword commercial rates description.
* Refactor USPS API response handling a bit.

= 1.5.0 =
* Check prerequisites on load, in a user-friendly way.

= 1.4.0 =
* Replace the deprecated WC_Product->length/width/height properties access with get_XXX() calls.
* Switch to the HTTPS USPS API endpoint.
* Disable cache and show debug data on the cart and checkout pages if the WooCommerce shipping debug mode is enabled.
* Tested with WooCommerce 4.8, WordPress 5.6.

= 1.3.1.1 =
* Tested with WooCommerce 4.7.

= 1.3.1 =
* Tested with WooCommerce 4.6.
* Minor changes for better USPS API response parsing.

= 1.3 =
* Tested with WordPress 5.5 and WooCommerce 4.5.
* Refresh the settings page look a bit.

= 1.2.6 =
* Compatible with woocommerce 2.6

= 1.2.5 =
* Fix First-Class Mail Parcel price calculator.
* Added First-Class Mail Large Envelope, Letter and Postcards.

= 1.2.4 =
* API Request updated

= 1.2.3 =
* Fix - Incorrect work of "Quote regular items by weight" with zero size items.

= 1.2.2 =
* Removed deprecated USPS services: 
  Priority Mail Regional Rate Box C;
  Priority Mail Regional Rate Box C, Hold For Pickup;
* Added First-Class Mail Metered Letter;
* Rebranding of Standard Post as Retail Ground.

= 1.2.1 =
* Fix - warning message in cart.

= 1.2.0 =
* Added services:
  Priority Mail, Hold For Pickup;
  Priority Mail Regional Rate Box A, Hold For Pickup;
  Priority Mail Regional Rate Box B, Hold For Pickup;
  Priority Mail Regional Rate Box C, Hold For Pickup.

= 1.1.1 =
* Added mail class id

= 1.1.0 =
* Added grouping by weight.

= 1.0.1 =
* Fix - Standard Post really works.

= 1.0 =
* Supported services: Priority Mail Express, Priority Mail, First-Class Mail, Standard Post, Media Mail, Library Mail
