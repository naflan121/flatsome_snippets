<?php

// Move Variation Description to Product Description Tab
add_action( 'wp_footer', 'move_variation_description_to_product_tab' );

function move_variation_description_to_product_tab() {
    ?>
    <script>
    (function($) {
        $(document).on('found_variation', function() {
            // Get the variation description content
            var variationDescription = $('.woocommerce-variation.single_variation').find('.woocommerce-variation-description').html();

            // Get the product description tab
            var $productDescriptionTab = $('#tab-description');
            var $variationDescriptionContainer = $productDescriptionTab.find('.woocommerce-variation-description');

            // If product description tab doesn't contain variation description, add it
            if ($variationDescriptionContainer.length === 0) {
                $productDescriptionTab.append('<div class="woocommerce-variation-description"></div>');
            }

            // Update product description tab with variation description content
            $variationDescriptionContainer.html(variationDescription);
        });
    })(jQuery);
    </script>

    <style>
    form.variations_form .woocommerce-variation-description {
        display: none;
    }
    </style>
    <?php
}
