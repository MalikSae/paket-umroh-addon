<?php
add_action('woocommerce_before_calculate_totals', function($cart) {
    if (is_admin() && !defined('DOING_AJAX')) return;
    foreach ($cart->get_cart() as $cart_item_key => $cart_item) {
        if (!isset($cart_item['kamar_tipe'])) continue;
        $product_id = $cart_item['product_id'];
        $harga = get_post_meta($product_id, '_harga_quad', true);
        if ($cart_item['kamar_tipe'] === 'triple') {
            $harga = get_post_meta($product_id, '_harga_triple', true);
        } elseif ($cart_item['kamar_tipe'] === 'double') {
            $harga = get_post_meta($product_id, '_harga_double', true);
        }
        $product = $cart_item['data'];
        $product->set_price(floatval($harga));
    }
}, 99);

add_action('save_post_product', function($post_id) {
    $product = wc_get_product($post_id);
    if ($product && $product->is_type('simple')) {
        if ($product->get_price() === '') {
            update_post_meta($post_id, '_price', '0');
            update_post_meta($post_id, '_regular_price', '0');
        }
    }
});
