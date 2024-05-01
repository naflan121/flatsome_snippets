<?php

/**
 * WooCommerce Redirect to Single Product if Category has Only One Product
 *
 * This code snippet redirects users to the single product page if a WooCommerce category
 * contains only one product.
 *
 * @author Naflan


add_action( 'template_redirect', 'redirect_to_single_product' );
function redirect_to_single_product() {
    if ( is_product_category() ) {
        global $wp_query;
        $cat = $wp_query->get_queried_object();
        $term_id = $cat->term_id;
        
        // Get the number of products in the category
        $product_count = $cat->count;
        
        // If the category has only one product
        if ( $product_count === 1 ) {
            // Get the single product ID
            $args = array(
                'post_type'      => 'product',
                'posts_per_page' => 1,
                'tax_query'      => array(
                    array(
                        'taxonomy' => 'product_cat',
                        'field'    => 'term_id',
                        'terms'    => $term_id,
                    ),
                ),
            );
            $single_product = new WP_Query( $args );
            if ( $single_product->have_posts() ) {
                $single_product->the_post();
                $product_id = get_the_ID();
                wp_redirect( get_permalink( $product_id ) );
                exit;
            }
        }
    }
}
