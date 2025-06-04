<?php
// Hook untuk menambahkan tab
add_filter('woocommerce_product_data_tabs', function($tabs) {
    $tabs['detail_paket'] = [
        'label'    => __('Detail Paket', 'paket-umroh-addon'),
        'target'   => 'detail_paket_options',
        'class'    => ['show_if_simple'],
        'priority' => 21,
    ];
    unset($tabs['shipping'], $tabs['linked_product'], $tabs['attribute'], $tabs['advanced']);
    return $tabs;
});

// Hook untuk menampilkan panel input
add_action('woocommerce_product_data_panels', function() {
    global $post;
    $selected_hotel = get_post_meta($post->ID, '_hotel', true);
    ?>
    <div id="detail_paket_options" class="panel woocommerce_options_panel">
        <div class="options_group">
            <?php
            woocommerce_wp_text_input(['id' => '_harga_quad','label' => 'Harga Quad (per orang)','type' => 'number']);
            woocommerce_wp_text_input(['id' => '_harga_triple','label' => 'Harga Triple (per orang)','type' => 'number']);
            woocommerce_wp_text_input(['id' => '_harga_double','label' => 'Harga Double (per orang)','type' => 'number']);
            woocommerce_wp_text_input(['id' => '_tanggal_berangkat','label' => 'Tanggal Keberangkatan','type' => 'date']);
            woocommerce_wp_text_input(['id' => '_maskapai','label' => 'Maskapai','type' => 'text']);

            woocommerce_wp_radio([
                'id' => '_hotel',
                'label' => 'Hotel',
                'options' => [
                    'Bintang 3' => 'Bintang 3',
                    'Bintang 4' => 'Bintang 4',
                    'Bintang 5' => 'Bintang 5',
                ],
                'value' => $selected_hotel ?: 'Bintang 5',
            ]);

            woocommerce_wp_textarea_input(['id' => '_include', 'label' => 'Include']);
            woocommerce_wp_textarea_input(['id' => '_exclude', 'label' => 'Exclude']);
            ?>
        </div>
    </div>
    <?php
});

// Simpan data
add_action('woocommerce_process_product_meta', function($post_id) {
    foreach (['_harga_quad','_harga_triple','_harga_double','_tanggal_berangkat','_maskapai','_include','_exclude','_hotel'] as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, $field, sanitize_text_field($_POST[$field]));
        }
    }
});
