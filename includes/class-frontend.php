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
     * Replace archive/shop buttons
     */
    public function replace_loop_button($html, $product, $args) {

        if (!$this->is_from_value_product($product->get_id())) {
            return $html;
        }

        $url = $this->get_design_url($product->get_id());

        return sprintf(
            '<a href="%s" class="button">%s</a>',
            esc_url($url),
            esc_html__('Start designing', 'wc-from-value-product')
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

        if (!$this->is_from_value_product($product->get_id())) {
            return $text;
        }

        return __('Start designing', 'wc-from-value-product');
    }

    /**
     * Replace single product button
     */
    public function replace_single_product_button() {

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
                    '<a href="%s" class="single_add_to_cart_button button alt">%s</a>',
                    esc_url($url),
                    esc_html__('Start designing', 'wc-from-value-product')
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

        $prefix = esc_html__('Starts from ', 'wc-from-value-product');

        /**
         * Sale product
         */
        if ($product->is_on_sale()) {

            $regular_price = wc_price($product->get_regular_price());
            $sale_price    = wc_price($product->get_sale_price());

            return sprintf(
                '%s<del>%s</del> <ins>%s</ins>',
                $prefix,
                $regular_price,
                $sale_price
            );
        }

        /**
         * Normal product
         */
        return sprintf(
            '%s%s',
            $prefix,
            wc_price($product->get_price())
        );
    }
}