<?php


// Add checkbox field to product edit page
function add_hide_sold_out_checkbox() {
    global $post;
    
    // Get the current value of the checkbox
    $hide_sold_out = get_post_meta( $post->ID, '_hide_sold_out', true );
    ?>
    <div class="options_group">
        <?php woocommerce_wp_checkbox( array(
            'id'            => '_hide_sold_out',
            'label'         => __( 'Hide Sold Out', 'text-domain' ),
            'description'   => __( 'Check this box to hide sold out text from the front end.', 'text-domain' ),
            'value'         => $hide_sold_out,
        ) ); ?>
    </div>
    <?php
}
add_action( 'woocommerce_product_options_general_product_data', 'add_hide_sold_out_checkbox' );

// Save checkbox field value
function save_hide_sold_out_checkbox( $post_id ) {
    $hide_sold_out = isset( $_POST['_hide_sold_out'] ) ? 'yes' : 'no';
    update_post_meta( $post_id, '_hide_sold_out', $hide_sold_out );
}
add_action( 'woocommerce_process_product_meta', 'save_hide_sold_out_checkbox' );


// Function to check if Hide Sold Out is checked for a product
function is_hide_sold_out_checked( $product_id ) {
    // Get the value of the Hide Sold Out checkbox for the product
    $hide_sold_out = get_post_meta( $product_id, '_hide_sold_out', true );

    // Return true if the checkbox is checked, false otherwise
    return $hide_sold_out === 'yes';
}

// lets do the magic :D
add_action( 'flatsome_woocommerce_shop_loop_images', 'dcwd_add_sold_label' );

function dcwd_add_sold_label() {
	global $product;
	
	if ( ! $product->is_in_stock() ) {
		// Check if hide sold out button is checked
		if ( is_hide_sold_out_checked( $product->get_id() ) ) {
			// Echo CSS style if the "Hide Sold Out" checkbox is checked
			echo '<style>.box-image .out-of-stock-label { opacity:0;}
            .box-image .out-of-stock-label.sold-label { opacity: 0.9; transform: rotate(-20deg); width: 110%; margin-left: -5%; z-index: 10; }
            </style>';
		}
	}
}
