# WooCommerce From Value Product

Adds "From Value Product" functionality to WooCommerce products.

This plugin allows you to:

- Mark products as "From Value Products"
- Replace Add to Cart/View More buttons with a custom design link
- Add global fallback design links
- Show "Starts from" pricing
- Support sale pricing
- Work independently from the active theme

---

# Features

## Product Settings

Each WooCommerce product gets:

- A checkbox:
  - **From Value Product**
- A custom URL field:
  - **Custom Design Link**

If enabled:
- Product buttons change to:
  - **Start designing**
- Buttons link to:
  - Product custom URL
  - OR fallback global URL

---

## Global Settings

Adds a setting in:

Settings → Reading

Field:
- **Default Design Link**

Used as fallback when a product-specific URL is empty.

---

## Frontend Behavior

### Product Archives

Buttons become:

Start designing

Instead of:
- Add to cart
- View more

---

### Single Product Page

The add to cart button becomes:

Start designing

And links to the design URL.

---

## Price Display

Enabled products show:

Starts from €99

Sale products show:

Starts from ~~€149~~ €99

Uses native WooCommerce price formatting.

---

# Installation

## 1. Upload Plugin

Upload the folder:

wp-content/plugins/wc-from-value-product/

---

## 2. Activate Plugin

Go to:

Plugins → Installed Plugins

Activate:

WooCommerce From Value Product

---

# Usage

## Configure Default Link

Go to:

Settings → Reading

Set:
- Default Design Link

Example:

https://example.com/design

---

## Configure Product

Edit a WooCommerce product.

Under the General product tab:

- Enable:
  - From Value Product
- Optional:
  - Custom Design Link

If the custom link is empty:
- The global default link is used.

---

# Translation

Text domain:

wc-from-value-product

Compatible with:
- WPML
- Loco Translate
- Polylang

---

# Requirements

- WordPress 6+
- WooCommerce 7+
- PHP 7.4+

---

# Hooks Used

## Admin

- woocommerce_product_options_general_product_data
- woocommerce_process_product_meta
- admin_init

## Frontend

- woocommerce_loop_add_to_cart_link
- woocommerce_product_single_add_to_cart_text
- woocommerce_single_product_summary
- woocommerce_get_price_html

---

# Future Improvements

Possible future upgrades:

- Open in new tab option
- Variable product support
- Product-specific button text
- Elementor compatibility helpers
- WooCommerce Blocks support
- Per-language URLs
