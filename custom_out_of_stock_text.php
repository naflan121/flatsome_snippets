<?php 

// Function to change the "Out of Stock" text to "Coming Soon"
function custom_out_of_stock_text( $availability, $product ) {
    if ( !$product->is_in_stock() ) {
        $availability['availability'] = __( 'Coming Soon', 'woocommerce' );
    }
    return $availability;
}
add_filter( 'woocommerce_get_availability', 'custom_out_of_stock_text', 10, 2 );
