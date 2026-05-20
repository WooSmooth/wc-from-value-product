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
     * Add product fields
     */
    public function add_product_fields() {

        echo '<div class="options_group">';

        woocommerce_wp_checkbox([
            'id'          => '_wcfvp_enabled',
            'label'       => __('From Value Product', 'wc-from-value-product'),
            'description' => __('Enable From Value Product mode.', 'wc-from-value-product'),
        ]);

        woocommerce_wp_text_input([
            'id'          => '_wcfvp_custom_link',
            'label'       => __('Custom Design Link', 'wc-from-value-product'),
            'placeholder' => 'https://example.com/design',
            'desc_tip'    => true,
            'description' => __('Optional custom link. Falls back to global default link.', 'wc-from-value-product'),
            'type'        => 'url',
        ]);

        woocommerce_wp_text_input([
            'id'          => '_wcfvp_custom_button_text',
            'label'       => __('Custom Button Text', 'wc-from-value-product'),
            'placeholder' => __('Start designing', 'wc-from-value-product'),
            'desc_tip'    => true,
            'description' => __('Optional custom button text. Falls back to global default text.', 'wc-from-value-product'),
            'type'        => 'text',
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

        if (isset($_POST['_wcfvp_custom_button_text'])) {

            update_post_meta(
                $product_id,
                '_wcfvp_custom_button_text',
                sanitize_text_field($_POST['_wcfvp_custom_button_text'])
            );
        }
    }

    /**
     * Register settings
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

        register_setting(
            'reading',
            'wcfvp_default_button_text',
            [
                'type' => 'string',
                'sanitize_callback' => 'sanitize_text_field',
                'default' => __('Start designing', 'wc-from-value-product'),
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

        add_settings_field(
            'wcfvp_default_button_text',
            __('Default Button Text', 'wc-from-value-product'),
            [$this, 'render_default_button_text_field'],
            'reading',
            'wcfvp_section'
        );
    }

    /**
     * Render default link field
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
            <?php esc_html_e('Fallback design link.', 'wc-from-value-product'); ?>
        </p>
        <?php
    }

    /**
     * Render default button text field
     */
    public function render_default_button_text_field() {

        $value = get_option(
            'wcfvp_default_button_text',
            __('Start designing', 'wc-from-value-product')
        );

        ?>
        <input
            type="text"
            name="wcfvp_default_button_text"
            value="<?php echo esc_attr($value); ?>"
            class="regular-text"
            placeholder="<?php esc_attr_e('Start designing', 'wc-from-value-product'); ?>"
        />

        <p class="description">
            <?php esc_html_e('Fallback button text.', 'wc-from-value-product'); ?>
        </p>
        <?php
    }
}