<?php

/*
Adds a custom column titled "Sage Order ID" to the WooCommerce Orders page in the WordPress admin panel, 
displaying the value of the custom field "sage_order_id" associated with each order.
*/
function sage_add_order_new_column_header( $columns ) {
    $new_columns = array();

    foreach ( $columns as $column_name => $column_info ) {
        $new_columns[ $column_name ] = $column_info;
    }

    // Add custom column
    $new_columns['sage_order_id'] = __( 'Sage Order ID', 'sage_id' );

    return $new_columns;
}
add_filter( 'manage_edit-shop_order_columns', 'sage_add_order_new_column_header', 20);


add_action( 'manage_shop_order_posts_custom_column', 'sage_add_wc_order_admin_list_column_content');
 
function sage_add_wc_order_admin_list_column_content( $column ) {
    global $post, $the_order;
 
    if ( 'sage_order_id' === $column ) {
        $sage_order_id = get_post_meta($post->ID, 'sage_order_id', true);
        echo $sage_order_id ? $sage_order_id : 'Not Synced';
    }
}
