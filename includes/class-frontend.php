<?php

if (!defined('ABSPATH')) {
    exit;
}

class WCFVP_Frontend {

    public function __construct() {

        add_filter(
            'woocommerce_loop_add_to_cart_link',
            [$this, 'replace_loop_button'],
            10,
            3
        );

        add_filter(
            'woocommerce_product_single_add_to_cart_text',
            [$this, 'replace_single_button_text']
        );

        add_action(
            'woocommerce_single_product_summary',
            [$this, 'replace_single_product_button'],
            1
        );

        add_filter(
            'woocommerce_get_price_html',
            [$this, 'custom_price_html'],
            10,
            2
        );

        add_action(
            'template_redirect',
            [$this, 'redirect_product_page']
        );
    }

    /**
     * Check if product is enabled
     */
    private function is_from_value_product($product_id) {

        return get_post_meta(
            $product_id,
            '_wcfvp_enabled',
            true
        ) === 'yes';
    }

    /**
     * Get enabled locations
     */
    private function get_enabled_locations() {

        $locations = get_option(
            'wcfvp_enabled_locations',
            []
        );

        if (!is_array($locations)) {
            return [];
        }

        return $locations;
    }

    /**
     * Check if functionality enabled for location
     */
    private function is_location_enabled($location) {

        return in_array(
            $location,
            $this->get_enabled_locations(),
            true
        );
    }

    /**
     * Get design URL
     */
    private function get_design_url($product_id) {

        $custom = get_post_meta(
            $product_id,
            '_wcfvp_custom_link',
            true
        );

        if (!empty($custom)) {
            return esc_url($custom);
        }

        return esc_url(
            get_option('wcfvp_default_link', '#')
        );
    }

    /**
     * Get button text
     */
    private function get_button_text($product_id) {

        $custom_text = get_post_meta(
            $product_id,
            '_wcfvp_custom_button_text',
            true
        );

        if (!empty($custom_text)) {
            return esc_html($custom_text);
        }

        $default_text = get_option(
            'wcfvp_default_button_text',
            __('Start designing', 'wc-from-value-product')
        );

        return esc_html($default_text);
    }

    /**
     * Link target
     */
    private function get_link_target() {

        $new_tab = get_option(
            'wcfvp_open_in_new_tab',
            0
        );

        return $new_tab
            ? ' target="_blank" rel="noopener noreferrer" '
            : '';
    }

    /**
     * Replace archive/shop buttons
     */
    public function replace_loop_button($html, $product, $args) {

        if (!$this->is_from_value_product($product->get_id())) {
            return $html;
        }

        /**
         * Detect WooCommerce loop context
         */
        $location = 'shop';

        if (is_product_category() || is_product_tag()) {
            $location = 'archives';
        }

        /**
         * Related products
         */
        global $woocommerce_loop;

        if (
            isset($woocommerce_loop['name']) &&
            $woocommerce_loop['name'] === 'related'
        ) {
            $location = 'related';
        }

        /**
         * Upsells/cross-sells
         */
        if (
            isset($woocommerce_loop['name']) &&
            in_array(
                $woocommerce_loop['name'],
                ['up-sells', 'cross-sells'],
                true
            )
        ) {
            $location = 'upsells';
        }

        if (!$this->is_location_enabled($location)) {
            return $html;
        }

        $url = $this->get_design_url($product->get_id());

        return sprintf(
            '<a href="%s" class="button"%s>%s</a>',
            esc_url($url),
            $this->get_link_target(),
            $this->get_button_text($product->get_id())
        );
    }

    /**
     * Replace single product button text
     */
    public function replace_single_button_text($text) {

        global $product;

        if (!$product) {
            return $text;
        }

        if (!$this->is_location_enabled('single')) {
            return $text;
        }

        if (!$this->is_from_value_product($product->get_id())) {
            return $text;
        }

        return $this->get_button_text($product->get_id());
    }

    /**
     * Replace single product add to cart button
     */
    public function replace_single_product_button() {

        if (!$this->is_location_enabled('single')) {
            return;
        }

        global $product;

        if (!$product) {
            return;
        }

        if (!$this->is_from_value_product($product->get_id())) {
            return;
        }

        remove_action(
            'woocommerce_single_product_summary',
            'woocommerce_template_single_add_to_cart',
            30
        );

        add_action(
            'woocommerce_single_product_summary',
            function () use ($product) {

                $url = $this->get_design_url($product->get_id());

                echo sprintf(
                    '<a href="%s" class="single_add_to_cart_button wc_single_link_button button alt"%s>%s</a>',
                    esc_url($url),
                    $this->get_link_target(),
                    $this->get_button_text($product->get_id())
                );
            },
            30
        );
    }

    /**
     * Custom price display
     */
    public function custom_price_html($price, $product) {

        if (!$this->is_from_value_product($product->get_id())) {
            return $price;
        }

        $min = get_post_meta($product->get_id(), '_wcfvp_price_min', true);
        $max = get_post_meta($product->get_id(), '_wcfvp_price_max', true);

        if (empty($min) && empty($max)) {
            return $price;
        }

        $min_price = wc_price($min);
        $max_price = wc_price($max);

        $format = get_option('wcfvp_price_format', 'verbose');

        $vat_label = '';

        if (get_option('wcfvp_show_vat_label', 1)) {
            $vat_label = ' ' . esc_html(get_option(
                'wcfvp_vat_label_text',
                __('Incl. VAT', 'wc-from-value-product')
            ));
        }

        if ($format === 'compact') {
            return $min_price . ' - ' . $max_price . $vat_label;
        }

        return sprintf(
            '%s %s %s %s',
            esc_html__('From', 'wc-from-value-product'),
            $min_price,
            esc_html__('to', 'wc-from-value-product'),
            $max_price
        ) . $vat_label;
    }

    /**
     * Redirect single product pages
     */
    public function redirect_product_page() {

        /**
         * Never redirect admin
         */
        if (is_admin()) {
            return;
        }

        /**
         * Prevent AJAX issues
         */
        if (wp_doing_ajax()) {
            return;
        }

        /**
         * Only product pages
         */
        if (!is_product()) {
            return;
        }

        /**
         * Redirect disabled
         */
        if (!get_option('wcfvp_redirect_product_page', 0)) {
            return;
        }

        global $post;

        if (!$post) {
            return;
        }

        /**
         * Product not enabled
         */
        if (!$this->is_from_value_product($post->ID)) {
            return;
        }

        $url = $this->get_design_url($post->ID);

        /**
         * Prevent empty redirects
         */
        if (empty($url)) {
            return;
        }

        /**
         * Allow external redirects
         */
        wp_redirect($url);

        exit;
    }
}