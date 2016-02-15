<?php
/* woocomerce functions */
function miss_woocommerce_before_single_product_summary(){
	echo '<div class="first_info span4">';
    echo '<div class="wrapper">';
	do_action( 'miss_woocommerce_before_single_product_summary' );
}
/* woocomerce functions */
function miss_woocommerce_after_single_product_summary(){
    echo '</div>';
	echo '</div><!--.span5 .first_info-->';
}
function miss_woocommerce_price_and_cart_holder($args=array()) {
	
}

?>