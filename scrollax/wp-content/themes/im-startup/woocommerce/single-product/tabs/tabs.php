<?php
/**
 * Single Product tabs
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Filter tabs and allow third parties to add their own
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
 
 global $product;
 
 echo '<div class="span8 second_info"><div class="wrapper">';
 echo '<h1 class="product_name" itemprop="name">';
 the_title();
 echo '</h1>';
 echo '<div class="sku">SKU: ' . $product->sku . '</div>';
 echo '<div class="price_and_cart_holder">';
	do_action( 'miss_woocommerce_price_and_cart_holder' );
	echo '<div class="clearboth"></div>';
	echo '</div><!--.price_and_cart_holder-->';
$tabs = apply_filters( 'woocommerce_product_tabs', array() );
woocommerce_product_description_tab();
woocommerce_product_additional_information_tab();
?>
</div></div>