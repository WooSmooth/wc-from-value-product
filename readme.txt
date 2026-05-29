=== WooCommerce From Value Product ===
Contributors: woosmooth, collisioncourse
Tags: woocommerce, product, from, to, value, custom link
Requires at least: 6.0
Tested up to: 7.0
Requires PHP: 7.4
Stable tag: 1.1.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Adds "From Value Product" functionality to WooCommerce products, allowing products to redirect to external design tools or custom URLs.

== Description ==

WooCommerce From Value Product allows WooCommerce products to redirect customers to external configurators, design tools, custom builders, or landing pages instead of using the default WooCommerce add-to-cart flow.

Perfect for:
* Product configurators
* Design tools
* Quote-based products
* External checkout flows
* Lead generation products

= Product-level controls =

Each WooCommerce product can be configured individually.

Features include:
* Enable or disable "From Value Product" mode
* Set a custom external URL
* Set custom button text
* Use global fallback settings

= Global settings =

A dedicated settings page is available under:

Settings → From Value Products

Available global options:
* Default design URL
* Default button text
* Open links in same tab or new tab
* Redirect single product pages
* Enable functionality on:
  * Shop page
  * Category/tag archives
  * Related products
  * Upsells and cross-sells
  * Single product pages

= Frontend behavior =

The plugin can:
* Replace add-to-cart buttons
* Replace view product buttons
* Redirect product pages
* Display custom button text
* Add "Starts from" price prefix
* Handle sale prices correctly

= Price display =

Regular prices:
Starts from €99

Sale prices:
Starts from ~~€149~~ €99

WooCommerce native price formatting is preserved.

= Translation ready =

The plugin is translation-ready and supports:
* WPML
* Polylang
* Loco Translate

Text domain:
wc-from-value-product

== Installation ==

1. Upload the plugin folder to:
`/wp-content/plugins/`

2. Activate the plugin via:
Plugins → Installed Plugins

3. Configure global settings:
Settings → From Value Products

4. Edit WooCommerce products and enable:
From Value Product

== Frequently Asked Questions ==

= Does this replace WooCommerce checkout? =

No. It redirects product interactions to external URLs when enabled.

= Can I still use normal WooCommerce products? =

Yes. Only products with "From Value Product" enabled are affected.

= Can I use different links per product? =

Yes. Each product can have its own custom URL and button text.

= What happens if no custom link is set? =

The global default link is used automatically.

= Can links open in a new tab? =

Yes. This can be configured globally.

== Changelog ==

= 1.1.0 =
* Price has now a price range
* Display choises for verbose or range
* Button for add to cart can be hidden on shop (overview) pages

= 1.0.2 =
* Improved logic in css files.

= 1.0.1 =
* Removed unused code blocks
* Improved WordPress.org compatibility
* Improved admin styling

= 1.0.0 =
* Initial release
* Product-level custom links
* Global settings
* Custom button texts
* Redirect support
* Price customization
* Frontend location controls

== Upgrade Notice ==

