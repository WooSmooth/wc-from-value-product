<?php
/**
 * Plugin Name: WooCommerce From Value Product
 * Plugin URI: https://github.com/WooSmooth/wc-from-value-product
 * Description: Adds "From Value Product" functionality to WooCommerce products.
 * Version: 1.0.0
 * Author: WooSmooth | CollisionCourse
 * Author URI: https://www.collisioncourse.be
 * Text Domain: wc-from-value-product
 * Domain Path: /languages
 * Requires at least: 7.0
 * Requires PHP: 8.2
 */

if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('WC_From_Value_Product')) {

    class WC_From_Value_Product {

        public function __construct() {

            define('WCFVP_PLUGIN_PATH', plugin_dir_path(__FILE__));
            define('WCFVP_PLUGIN_URL', plugin_dir_url(__FILE__));

            add_action('plugins_loaded', [$this, 'init']);

            add_action('admin_enqueue_scripts', [$this, 'admin_assets']);
        }

        public function init() {

            if (!class_exists('WooCommerce')) {
                return;
            }

            load_plugin_textdomain(
                'wc-from-value-product',
                false,
                dirname(plugin_basename(__FILE__)) . '/languages'
            );

            require_once WCFVP_PLUGIN_PATH . 'includes/class-admin.php';
            require_once WCFVP_PLUGIN_PATH . 'includes/class-frontend.php';

            new WCFVP_Admin();
            new WCFVP_Frontend();
        }

        /**
         * Load admin CSS
         */
        public function admin_assets($hook) {

            // Load only on product + settings pages
            if (
                $hook !== 'product' &&
                strpos($hook, 'wcfvp-settings') === false
            ) {
                return;
            }

            wp_enqueue_style(
                'wcfvp-admin',
                WCFVP_PLUGIN_URL . 'assets/css/admin.css',
                [],
                '1.0.0'
            );
        }
    }

    new WC_From_Value_Product();
}