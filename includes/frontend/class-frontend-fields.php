<?php
add_action('woocommerce_before_add_to_cart_button', function() {
    global $product;
    if ($product->is_type('simple')) {
        $harga_quad = get_post_meta($product->get_id(), '_harga_quad', true);
        $harga_triple = get_post_meta($product->get_id(), '_harga_triple', true);
        $harga_double = get_post_meta($product->get_id(), '_harga_double', true);

        echo '<div class="options_group">';
        echo '<strong>Pilih Tipe Kamar:</strong><br>';
        echo '<label><input type="radio" name="kamar_tipe" value="quad" checked> Quad (Rp' . number_format($harga_quad, 0, ',', '.') . ')</label><br>';
        echo '<label><input type="radio" name="kamar_tipe" value="triple"> Triple (Rp' . number_format($harga_triple, 0, ',', '.') . ')</label><br>';
        echo '<label><input type="radio" name="kamar_tipe" value="double"> Double (Rp' . number_format($harga_double, 0, ',', '.') . ')</label><br>';
        echo '</div>';
    }
});

add_filter('woocommerce_add_cart_item_data', function($cart_item_data, $product_id) {
    if (isset($_POST['kamar_tipe'])) {
        $cart_item_data['kamar_tipe'] = sanitize_text_field($_POST['kamar_tipe']);
    }
    return $cart_item_data;
}, 10, 2);

add_filter('woocommerce_get_item_data', function($item_data, $cart_item) {
    if (isset($cart_item['kamar_tipe'])) {
        $item_data[] = ['key' => 'Tipe Kamar', 'value' => ucfirst($cart_item['kamar_tipe'])];
    }
    return $item_data;
}, 10, 2);

add_filter('woocommerce_product_single_add_to_cart_text', function($text) {
    $custom = get_option('paket_umroh_custom_button_text');
    return $custom ?: $text;
});
