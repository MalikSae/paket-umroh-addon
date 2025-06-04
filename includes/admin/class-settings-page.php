<?php
// Tambahkan tab pengaturan
add_filter('woocommerce_get_settings_pages', function($settings) {
    $settings[] = new Paket_Umroh_Settings_Page();
    return $settings;
});

if (!class_exists('Paket_Umroh_Settings_Page')) {
    class Paket_Umroh_Settings_Page extends WC_Settings_Page {

        public function __construct() {
            $this->id    = 'paket_umroh';
            $this->label = __('Paket Umroh', 'paket-umroh-addon');
            parent::__construct();
        }

        public function get_settings() {
            $settings = [
                [
                    'title' => __('Pengaturan Tombol', 'paket-umroh-addon'),
                    'type'  => 'title',
                    'id'    => 'paket_umroh_section_title',
                ],
                [
                    'title'    => __('Teks Tombol Add to Cart', 'paket-umroh-addon'),
                    'desc'     => __('Teks ini akan menggantikan tombol “Add to cart” di halaman produk.', 'paket-umroh-addon'),
                    'id'       => 'paket_umroh_custom_button_text',
                    'type'     => 'text',
                    'default'  => 'Konsultasi Sekarang',
                    'desc_tip' => true,
                ],
                [
                    'type' => 'sectionend',
                    'id'   => 'paket_umroh_section_title',
                ],
            ];
            return apply_filters('woocommerce_settings_paket_umroh', $settings);
        }

        public function output() {
            $settings = $this->get_settings();
            WC_Admin_Settings::output_fields($settings);
        }

        public function save() {
            $settings = $this->get_settings();
            WC_Admin_Settings::save_fields($settings);
        }
    }
}
