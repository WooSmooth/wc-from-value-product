# WooCommerce From Value Product

WooCommerce From Value Product is a standalone WooCommerce plugin that allows products to redirect users to external configurators, design tools, or custom landing pages instead of using the default WooCommerce purchase flow.

The plugin adds flexible product-level and global settings for custom links, button texts, redirects, and frontend behavior.

---

# Features

## Product-Level Controls

Each WooCommerce product can be configured as a **From Value Product** with:

- Enable/disable checkbox
- Custom design/configurator URL
- Custom button text

---

## Global Settings

A dedicated settings page is available under:

Settings → From Value Products

Global options include:

- Default design link
- Default button text
- Open links in:
  - same tab
  - new tab
- Redirect single product pages
- Enable functionality on specific frontend locations

---

# Frontend Functionality

When enabled for a product, the plugin can:

- Replace WooCommerce add-to-cart buttons
- Replace “View product” buttons
- Redirect single product pages
- Display custom button text
- Use external configurator/design URLs

---

# Supported Frontend Locations

The functionality can be enabled or disabled globally for:

- Shop page
- Product category/tag archives
- Related products
- Upsells
- Cross-sells
- Single product pages

---

# Price Display

For enabled products the plugin automatically adjusts the price display.

Examples:

## Regular Price

Starts from €99

## Sale Price

Starts from ~~€149~~ €99

WooCommerce native pricing formatting is used for:

- Currency symbols
- Decimal settings
- Tax display
- Localization

---

# Link Priority

The plugin uses the following URL priority:

1. Product custom URL
2. Global default URL

---

# Button Text Priority

The plugin uses the following button text priority:

1. Product custom button text
2. Global default button text
3. "Start designing"

---

# Translation Ready

The plugin is fully translation-ready.

Text domain:

wc-from-value-product

Compatible with:

- WPML
- Polylang
- Loco Translate
- WordPress language packs

---

# Requirements

- WordPress
- WooCommerce

---

# Installation

1. Upload the plugin folder to:

wp-content/plugins/

2. Activate the plugin via:

WordPress Admin → Plugins

3. Configure global settings via:

Settings → From Value Products

---

# Plugin Structure

```text
wc-from-value-product/
├── wc-from-value-product.php
├── includes/
│   ├── class-admin.php
│   └── class-frontend.php
└── languages/