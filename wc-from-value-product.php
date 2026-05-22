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
    }

    new WC_From_Value_Product();
}