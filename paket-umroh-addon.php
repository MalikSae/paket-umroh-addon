<?php
/**
 * Plugin Name: Paket Umroh Add-on for WooCommerce
 * Description: Tambahkan fitur pemesanan Paket Umroh berbasis tipe kamar, hotel, dan fasilitas.
 * Version: 1.0.1
 * Author: MalikSae.com
 * Text Domain: paket-umroh-addon
 */

if (!defined('ABSPATH')) exit;

define('PUA_PATH', plugin_dir_path(__FILE__));
define('PUA_URL', plugin_dir_url(__FILE__));

// Load admin hooks
if (is_admin()) {
    require_once PUA_PATH . 'includes/admin/class-admin-fields.php';
    require_once PUA_PATH . 'includes/admin/class-admin-styler.php';
}

add_action('plugins_loaded', function () {
    if (class_exists('WC_Settings_Page')) {
        require_once PUA_PATH . 'includes/admin/class-settings-page.php';
    }
});


// Load frontend hooks
require_once PUA_PATH . 'includes/frontend/class-frontend-fields.php';
require_once PUA_PATH . 'includes/frontend/class-price-handler.php';

