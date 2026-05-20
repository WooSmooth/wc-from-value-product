<?php

if (!defined('ABSPATH')) {
    exit;
}

class WCFVP_Admin {

    public function __construct() {

        add_action(
            'woocommerce_product_options_general_product_data',
            [$this, 'add_product_fields']
        );

        add_action(
            'woocommerce_process_product_meta',
            [$this, 'save_product_fields']
        );

        add_action(
            'admin_init',
            [$this, 'register_settings']
        );
    }

    /**
     * Add fields to product edit page
     */
    public function add_product_fields() {

        echo '<div class="options_group">';

        woocommerce_wp_checkbox([
            'id'          => '_wcfvp_enabled',
            'label'       => __('From Value Product', 'wc-from-value-product'),
            'description' => __('Enable custom design link for this product.', 'wc-from-value-product'),
        ]);

        woocommerce_wp_text_input([
            'id'          => '_wcfvp_custom_link',
            'label'       => __('Custom Design Link', 'wc-from-value-product'),
            'placeholder' => 'https://example.com/design-product',
            'desc_tip'    => true,
            'description' => __('Optional custom link. Falls back to global default.', 'wc-from-value-product'),
            'type'        => 'url',
        ]);

        echo '</div>';
    }

    /**
     * Save product fields
     */
    public function save_product_fields($product_id) {

        $enabled = isset($_POST['_wcfvp_enabled']) ? 'yes' : 'no';

        update_post_meta(
            $product_id,
            '_wcfvp_enabled',
            $enabled
        );

        if (isset($_POST['_wcfvp_custom_link'])) {

            update_post_meta(
                $product_id,
                '_wcfvp_custom_link',
                esc_url_raw($_POST['_wcfvp_custom_link'])
            );
        }
    }

    /**
     * Register Reading settings
     */
    public function register_settings() {

        register_setting(
            'reading',
            'wcfvp_default_link',
            [
                'type' => 'string',
                'sanitize_callback' => 'esc_url_raw',
                'default' => '',
            ]
        );

        add_settings_section(
            'wcfvp_section',
            __('From Value Product Settings', 'wc-from-value-product'),
            '__return_false',
            'reading'
        );

        add_settings_field(
            'wcfvp_default_link',
            __('Default Design Link', 'wc-from-value-product'),
            [$this, 'render_default_link_field'],
            'reading',
            'wcfvp_section'
        );
    }

    /**
     * Render settings field
     */
    public function render_default_link_field() {

        $value = get_option('wcfvp_default_link', '');

        ?>
        <input
            type="url"
            name="wcfvp_default_link"
            value="<?php echo esc_attr($value); ?>"
            class="regular-text"
            placeholder="https://example.com/design"
        />
        <p class="description">
            <?php esc_html_e('Fallback design link for From Value Products.', 'wc-from-value-product'); ?>
        </p>
        <?php
    }
}