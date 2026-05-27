=== WooCommerce From Value Product ===
Contributors: woosmooth, collisioncourse
Tags: woocommerce, product, redirect, custom link, add to cart, external link, design tool
Requires at least: 7.0
Tested up to: 7.0
Requires PHP: 7.4
Stable tag: 1.0.1
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Adds "From Value Product" functionality to WooCommerce products, allowing products to redirect to external design tools or custom URLs instead of the default add-to-cart flow.

== Description ==

WooCommerce From Value Product is a lightweight WooCommerce extension that allows you to turn standard WooCommerce products into "From Value Products".

Instead of sending customers directly to the cart or checkout flow, products can redirect users to external configurators, product builders, or custom landing pages.

This makes it ideal for:
- Product configurators
- Custom design tools
- Quote-based products
- External checkout flows
- Lead-generation product pages

---

== Features ==

= Product-level controls =
- Enable/disable "From Value Product" mode per product
- Set a custom external design/configurator link
- Set custom button text per product

= Global settings =
- Default design link fallback
- Default button text fallback
- Choose whether links open in the same tab or new tab
- Enable redirect of single product pages
- Select where functionality is active:
  - Shop page
  - Category & tag archives
  - Related products
  - Upsells & cross-sells
  - Single product pages

= Frontend behavior =
- Replace WooCommerce add-to-cart buttons
- Replace shop loop buttons
- Replace single product purchase button
- Optional redirect of single product pages
- Custom price display with "Starts from" prefix
- Sale price formatting support

---

== How it works ==

When a product is marked as a "From Value Product", WooCommerce behavior changes:

1. The product button is replaced with a custom button.
2. The button links to:
   - Product-specific custom URL (if set)
   - Otherwise the global default URL
3. Button text is resolved in this order:
   - Product custom button text
   - Global default button text
   - Fallback: "Start designing"
4. Prices are displayed with a "Starts from" prefix.

If enabled, users visiting single product pages are redirected directly to the configured URL.

---

== Installation ==

1. Upload the plugin folder to:
   /wp-content/plugins/

2. Activate the plugin through the WordPress admin:
   Plugins → Installed Plugins

3. Configure global settings:
   Settings → From Value Products

4. Edit products and enable:
   Product data → From Value Product

---

== Frequently Asked Questions ==

= Does this replace WooCommerce checkout? =
No. It redirects product interactions to external URLs when enabled, but does not modify WooCommerce checkout itself.

= Can I still use normal WooCommerce products? =
Yes. Only products with "From Value Product" enabled are affected.

= Can I use different links per product? =
Yes. Each product can have its own custom design URL.

= What happens if no custom link is set? =
The global default link is used.

= Can I open links in a new tab? =
Yes, this can be configured in the global settings.

---

== Changelog ==

= 1.0.0 =
* Initial release
* Product-level custom links
* Global fallback settings
* Button text customization
* Shop + single product integration
* Price modification ("Starts from")
* Optional product page redirect
* Location-based enable/disable system

---

== Upgrade Notice ==

= 1.0.1 =
Remove unused code blocks.

= 1.0.0 =
Initial stable release of WooCommerce From Value Product.