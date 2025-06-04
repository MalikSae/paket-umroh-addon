<?php
add_action('admin_head', function() {
    echo '<style>
    p._sale_price_field,
    label[for="_downloadable"],
    label[for="_virtual"],
    .show_if_external,
    .product-type-variable,
    .product-type-grouped,
    .product-type-external {
        display: none !important;
    }
    select#product-type option:not([value="simple"]) {
        display: none !important;
    }
    </style>';
});
